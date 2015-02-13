<?php
require_once('connectvars.php');
$dbc=mysqli_connect(DB_HOST2325,DB_USER2325,DB_PASSWORD2325,DB_NAME2325) or die('could not connect to database.');
$email_success=0;
if(isset($_POST['submit']))
{
    if(isset($_POST['search']))
    {
        if(!empty($_POST['search']))
        {
            $email=mysqli_real_escape_string($dbc,trim($_POST['search']));
            if(isset($_POST['remem']))
            {
                if($_POST['remem']=='okay')
                    setcookie('email',$email);
                    $_COOKIE['email']=$email;
            }
            $query='SELECT * FROM our_travel WHERE email="'.$email.'"';
            $data=mysqli_query($dbc,$query);
            if(mysqli_num_rows($data)>0)
            {
                $email_success=1;
            }
            else
            {
                $email_success=2; //New user
            }
        }
    }
    
}
else if(isset($_COOKIE['email']))
{   
    $email=htmlspecialchars(trim($_COOKIE['email']));
    $email_success=1;
}
    
    
if(isset($_POST['submit_new']))
{
    if(!empty($_POST['search_mail']))
    {
        $email_new=mysqli_real_escape_string($dbc,trim($_POST['search_mail']));
        $rand=rand(2345617638903386387,153781531918602836912631);
        $query='SELECT * FROM our_travel WHERE email="'.$email.'"';
        $data=mysqli_query($dbc,$query);
        if(mysqli_num_rows($data)<1)
        {
            $query='INSERT INTO email_verify (`email`,`rand`) VALUES ("'.$email_new.'","'.$rand.'");';
            mysqli_query($dbc,$query);
            $subject_to='Travel To Track Confirmation';
            $email_to=$email_new;
            $message_to='Hi,<br/> We have recieved your request to sign in for "Travel To Track", ';
            $message_to.='an online competition to travel and collect points through <strong>Mozilla Stumbler</strong>, ';
            $message_to.='an android app(firefox os app also available) and get rewarded.<br/><br/>';
            $message_to.="We have recieved a registration for this email id. Click on the link below to activate the competition. Please ignore this message if you haven't registered for the event.<br/>";
            $message_to.='<a href="http://hashtagofficial.in/travel/login.php?type=verify&email='.$email_new.'&rand='.$rand.'">http://hashtagofficial.in/travel/login.php?type=verify&email='.$email_new.'&rand='.$rand.'</a><br/><br/>';
            $message_to.='For more information <a href="http://hashtagofficial.in/travel/">Click Here</a><br/><br/>';
            $message_to.='Thanks,<br/>Hashtag Online Team<br/><a href="http://hashtagofficial.in/">
            <img src="http://hashtagofficial.in/mail_footer.png" alt="Silver Jubilee Celebration | CSE Dept."></a>';
            require_once('test.php');
            
        }
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

          <!-- For Facebook -->
      <meta property="og:site_name" content="Leaderboard| Travel To Track |hashtag MACE">
      <meta property="og:title" content="Leaderboard| Travel To Track |hashtag MACE">
      <meta property="og:description" content="Leaderboard| Travel To Track |hashtag MACE| Silver Jubilee Celebration|Computer Science and Engineering department| Mar Athanasius College of Engineering, Kothamanglam">
      <meta property="og:image" content="images/ogimage.png">
    <meta property="og:type" content="website" />

      <meta name="description" content="Leaderboard| Travel To Track |hashtag MACE| Silver Jubilee Celebration|Computer Science and Engineering department| Mar Athanasius College of Engineering, Kothamanglam">
    <title>Leaderboard| Travel To Track |hashtag MACE</title>
    <link rel="shortcut icon" href="/sponsor/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/sponsor/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="animation.css">
    <link rel="stylesheet" href="/sponsor/style.css">
    <link rel="stylesheet" href="/sponsor/main.css">
    <link rel="stylesheet" href="main_travel.css">
</head>
<body>
    <div id="navstars">
        <span class="navinside" title="Home"> <a href="index.php">Home</a> |</span>
        <span class="navinside" title="Leaderboard"> <a href="process.php">Leaderboard</a> |</span>
        <span class="navinside" title="How To"> <a href="howto.php">HowTo?</a> </span>
        </div>
            <div id="blurer"></div>
            <div id="one"></div>
            <div id="two"></div>
            <div id="three"></div>
            <div id="four"></div>
            <div id="five"></div>
    <div id="container1">
    <div class="padder">
        <div align="center">
            <form method="post" action="process.php">
                <span class="icon-mail" id="mail_icon"></span> 
                <input type="email" id="search" name="search" placeholder="Your e-mail id." required value="<?php if(isset($email)) echo $email;?>"><br/>
                                <?php
                if(isset($_COOKIE['email']))
                    echo '<a href="emailremove.php?ref=process">Forget "'.htmlspecialchars($_COOKIE['email']).'".</a>';
                else
                    echo '<input type="checkbox" name="remem" value="okay"> Remember this email';
                    ?>
               <br/><input type="submit" id="submit1" name="submit" value="Sign Up/Search with e-mail">
            </form>
                <div id="result_sec">
                    <?php
                        if($email_success==2)
                        {    echo 'Do you want to register as a new user with '.$email.'?<br/>';
                             echo '<form method="post" action="process.php">';
                            echo '<input type="hidden" name="search_mail" value='.$email.'>';
                            echo '<input type="submit" name="submit_new"'.' value="Yes" id="submit1">';
                            echo '<a href="process.php"><button id="submit1">Cancel</button></a>';
                        }
                        else if($email_success==3)
                        {  echo 'Check your mail for further steps. It may take some seconds to reach you. :)';
                           echo '<br/>Please do try different tabs (for gmail users) or the spam folder.';
                        }
                        else if($email_success==1)
                        {
                            $rank=1;
                            $query='SELECT name, college, email, score, globalrank, nick FROM our_travel ORDER BY score DESC';
                            $data=mysqli_query($dbc,$query);
                            while($row=mysqli_fetch_array($data))
                            {
                                if($row['email']==$email)
                                {
                                    $score_print=htmlspecialchars($row['score']);
                                    $name_print=htmlspecialchars($row['name']);
                                    $college_print=htmlspecialchars($row['college']);
                                    $globalrank_print=htmlspecialchars($row['globalrank']);
                                    $nick_print=htmlspecialchars($row['nick']);
                                    break;
                                }
                                $rank++;
                            }
                            echo '<div id="yourdetails" align="center">';
                            if($score_print==0)
                            {
                                echo "Hi, ".$name_print." (Nick Name: <strong>".$nick_print."</strong>)<br/><br/>";
                                echo "Please wait. Your details haven't shown up yet. <br/>KEEP CALM, It may take some time to become 'active' for the first time.<br/> Do check our ";
                                echo '<a href="howto.php?email='.$email.'">how to</a> page to see if you have done something wrong.<br/> <strong>-Have you collected 10 points?</strong><br/>
                            <strong>-Is your nick name given in the app same as that printed above?</strong><br/><br/>
                            <strong>-Your nick name is case sensitive. Give the correct nick name in the app.</strong><br/><br/>';
                            }
                            else
                            {
                            echo '<table>';
                            echo '<tr><td>Name: </td> <td>'.$name_print.'</td</tr>';
                            echo '<tr><td>Rank: </td> <td>'.$rank.'</td</tr>';
                            echo '<tr><td>Nick Name: </td> <td>'.$nick_print.'</td</tr>';
                            echo '<tr><td>Score: </td> <td>'.$score_print.'</td</tr>';
                            echo '<tr><td>College: </td> <td>'.$college_print.'</td</tr>';
                            echo '<tr><td>Global Rank: </td> <td>'.$globalrank_print.'</td</tr>';
                            echo '</table>';
                            }
                            echo '  <strong><a href="update.php">Click here</a> if you want to try updating.</strong>';
                            echo '</div>';
                            
                            
                        }
                    ?>
                </div>
            
            <div id="leaderboard" align="center">
                
                <a href="http://hashtagofficial.in" target="_blank"> <img src="/sponsor/images/logo.png" alt="Hashtag" id="logo" width="200"> </a>
                    <br/><span style="font-size:20px">'Travel To Track'</span>
                <br/>
                <h3>Leaderboard</h3>
                <table id="table">
                  <tr><th>Rank</th> <th>Name</th> <th>College</th> <th>Score</th> <th>Global Rank</th></tr>  
                <?php
              $query="SELECT name, score,college, globalrank FROM our_travel ORDER BY score DESC";
                    $data=mysqli_query($dbc,$query);
                    $rank=1;
                    while($row=mysqli_fetch_array($data))
                    {
                        echo '<tr>';
                        echo '<td>'.$rank.'</td>';
                        echo '<td>'.$row['name'].'</td>';
                        echo '<td>'.$row['college'].'</td>';
                        echo '<td>'.$row['score'].'</td>';
                        if($row['globalrank']==0)
                            echo '<td>Inactive</td>';
                        else
                            echo '<td>'.$row['globalrank'].'</td>';
                        echo '</tr>';
                        
                        $rank++;
                    }

                ?>
                </table>

            </div>
                
        </div>
    </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $(window).load(function(){
            $('#leader_loader').load('cron.php');
        });
    </script>
</body>
</html>

<?php
mysqli_close($dbc);
?>