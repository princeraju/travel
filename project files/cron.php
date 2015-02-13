<?
require_once('connectvars.php');
$dbc=mysqli_connect(DB_HOST2325,DB_USER2325,DB_PASSWORD2325,DB_NAME2325) or die('could not connect to database.');
ini_set('max_execution_time', 0);
function getSSLPage($url) {
            $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

        $options = array(

            CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
            CURLOPT_POST           =>false,        //set to GET
            CURLOPT_USERAGENT      => $user_agent, //set user agent
            CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
            CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => false,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER =>false,
            CURLOPT_SSL_VERIFYHOST =>false,
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
}


function getTextBetweenTags($tag, $html, $strict=1)
{
    /*** a new dom object ***/
    $dom = new domDocument;

    /*** load the html into the object ***/
    if($strict==1)
    {
        $dom->loadXML($html);
    }
    else
    {
        $dom->loadHTML($html);
    }

    /*** discard white space ***/
    $dom->preserveWhiteSpace = false;

    /*** the tag by its tag name ***/
    $content = $dom->getElementsByTagname($tag);

    /*** the array to return ***/
    $out = array();
    foreach ($content as $item)
    {
        /*** add node value to the out array ***/
        $out[] = $item->nodeValue;
    }
    /*** return the results ***/
    return $out;
}

$contents=getSSLPage("https://location.services.mozilla.com/leaders");
$html=$contents['content'];
$html1=str_replace('&lt;script&gt;','&gt;script&lt;',$html);
$content = getTextBetweenTags('td', $html1);

$query="SELECT * FROM our_travel";  //Getting details of registered users.
$data=mysqli_query($dbc,$query);
$nick_present=array();
while($row=mysqli_fetch_array($data))
{
    array_push($nick_present,$row['nick']);
}

$query="SELECT nick FROM main_leader_travel"; //Adding nicknames from leaderboard to check for pre-usage
$data=mysqli_query($dbc,$query);
$nick_present_main=array();
while($row=mysqli_fetch_array($data))
{
    array_push($nick_present_main,$row['nick']);
}

$flag=0; $i=-1; $global=0; $name=''; $query_names='';
foreach($content as $item)
{
    $i++;
    if($i==0)
    {
        $global=rtrim($item,'.');
    }
    else if($i==1)
    {
        $item=rtrim($item);
        $name=$item;
        if(in_array($name,$nick_present))
            $flag=1;
        else
            $flag=0;
    }
    else if($i==2)
    {
        if($flag==1)
        {
            $query='UPDATE our_travel SET score="'.$item.'", globalrank="'.$global.'" WHERE nick="'.$name.'";';
            mysqli_query($dbc,$query);
        }
      
            if(!in_array($name,$nick_present_main))
            {
                $query_names='INSERT INTO `main_leader_travel`(`nick`) VALUES ("'.$name.'");';
                mysqli_query($dbc,$query_names);
            }
        $i=-1;
    }

}


mysqli_close($dbc);
?>