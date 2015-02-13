<?php
require_once('connectvars.php');
$dbc=mysqli_connect(DB_HOST2325,DB_USER2325,DB_PASSWORD2325,DB_NAME2325) or die('could not connect to database.');

$email='The Registered E-mail';// Don't change the value,, Used below
$nick='Your Nickname Provided';
if(isset($_POST['submit']))
{
    if(!empty($_POST['search']))
        $email=htmlspecialchars(trim($_POST['search']));
}
else if(isset($_GET['email']))
{
    if(!empty($_GET['email']))
        $email=htmlspecialchars(trim($_GET['email']));
}

else if(isset($_COOKIE['email']))
{
    $email=$_COOKIE['email'];
}
if($email!='The Registered E-mail')
{   
    $query='SELECT nick,email FROM our_travel WHERE email="'.$email.'" LIMIT 1';
    $data=mysqli_query($dbc,$query);
    if(mysqli_num_rows($data)>0)
    {
        $row=mysqli_fetch_array($data);
        $email=$row['email'];
        $nick=$row['nick'];
        $message='Your nick name :<br/><span style="font-size:20px;">'.$nick.'</span><br/>
        Note: e-mail id is case sensitive.';
    }
    else
    {
        $message='Please register through our <a href="index.php">home page</a> to start playing.<br/>';
        $email='The Registered E-mail';
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
      <meta property="og:site_name" content="How To| Travel To Track |hashtag MACE">
      <meta property="og:title" content="How To| Travel To Track |hashtag MACE">
      <meta property="og:description" content="How To| Travel To Track |hashtag MACE| Silver Jubilee Celebration|Computer Science and Engineering department| Mar Athanasius College of Engineering, Kothamanglam">
      <meta property="og:image" content="images/ogimage.png">
    <meta property="og:type" content="website" />

      <meta name="description" content="How To| Travel To Track |hashtag MACE| Silver Jubilee Celebration|Computer Science and Engineering department| Mar Athanasius College of Engineering, Kothamanglam">
    <title>How To|Travel To Track |hashtag MACE</title>
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
    <div></div>
    <div id="container1">
    <div class="padder">
        <div align="center" style="font-size:30px;">HOW TO 'Travel To Track'?<br/><br/>
            <form method="post" action="howto.php">
                <span class="icon-mail" id="mail_icon"></span> 
                <input type="email" id="search" name="search" placeholder="Your e-mail id." required value="<?php if(isset($email)&& $email!='The Registered E-mail') echo $email;?>"><br/>
               <input type="submit" id="submit1" name="submit" value="Update with this e-mail">
            </form>
            </div>
        </div>
        
        <div id="howto_main">
                <?php
                    if(isset($message))
                        echo $message.'<br/>';
                ?>
            <br/>
            Hi, let's see how you can start with our system :)<br/>
            First you need to have <strong>an Android phone or Firefox OS Phone</strong>
            <h4><span class="icon-arrow-right"></span></span> Mozilla Stumbler for Android</h4>

                <a href="https://play.google.com/store/apps/details?id=org.mozilla.mozstumbler" target="_blank">
                    <img title="Get Mozilla Stumbler on Google Play" src="images/google_play.png"></a>

                <a href="https://f-droid.org/repository/browse/?fdid=org.mozilla.mozstumbler" target="_blank">
                    <img title="Mozilla Stumbler available on F-Droid" src="images/f-droid.png"></a><br/>
        You can find <a href="https://github.com/mozilla/MozStumbler" target="_blank">Mozilla Stumbler on Github</a> to contribute to its development.
        
            <h4><span class="icon-arrow-right"></span></span> FxStumbler for Firefox OS</h4>
            
            Get <a href="https://github.com/clochix/FxStumbler" target="_blank">FxStumbler on github</a>
            <br/><br/><br/>
            Yay! Now you have downloaded the tool to map your way.<br/>By using the app you are contributing to the open source community :)</br> For more details <a href="https://location.services.mozilla.com" target="_blank">click here</a>.<br/><br/>The following are the next steps to be done for android users.<br/><br/>
            <span class="icon-checkmark"></span> Open the app<br/><br/><br/>
            <img src="images/screenshot.jpg" alt="screenshot" id="screenshot"><br/><br/>
            <span class="icon-checkmark"></span> Open up the left panel.<br/><br/>
            <span class="icon-checkmark"></span> Click the settings icon<br/><br/>
            <span class="icon-checkmark"></span><span style="font-weight:bold;"> Change the nick name to "<?php echo $nick; ?>"</span> (You can always find your nick name by searching your email in the home page)<br/><br/>
            <span class="icon-checkmark"></span> Change the email to "<?php echo $email; ?>"<br/><br/>
            <strong>Now you are all set to go. But consider these points too.<br/><br/></strong>
            <span class="icon-checkmark"></span> You don't need internet to collect points.<br/><br/>
            <span class="icon-checkmark"></span> It is adviced to <strong>turn ON 'location'</strong> in Android settings.<br/><br/>
            <span class="icon-checkmark"></span> You can always turn stumbling ON/OFF.<br/><br/>
            <span class="icon-checkmark"></span> You can upload your points through the left panel when there is internet connectivity. Auto upload is also available in the settings.<br/><br/>
            <span class="icon-checkmark"></span> Points collected in the current session will be shown near the binocular image in the main page.<br/><br/>
            <span class="icon-checkmark"></span> <span class="icon-checkmark"></span> Points you have submitted will take some time to appear in the leaderboard. Sometimes hours depending on how Mozilla updates their leaderboard.<br/><br/>
            <span class="icon-checkmark"></span> <span class="icon-checkmark"></span> You won't appear in the leaderboard if you have less than 10 points. Don't worry, a walk around your home can get you 10 points.<br/><br/>
            <span class="icon-checkmark"></span> You can always contact us at <h3>info@hashtagofficial.in</h3><br/><br/>
    <h4 style="padding-bottom:10px;">Check out our <a href="process.php">leaderboard</a> for rank details.</h4>
        </div>
    </div>
</body>
</html>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-57646151-1', 'auto');
  ga('send', 'pageview');

</script>
<?php
mysqli_close($dbc);
?>