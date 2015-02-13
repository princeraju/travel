<html>
    <head>
        <meta http-equiv="refresh" content="300">
        <title>Thanks Da :)</title>
    </head>
    <?php
        require_once('cron.php');
        echo 'Done<br/>';
        echo 'Wait, will repeat after 5 minutes';
?>
</html>
<?php
mysqli_close($dbc);
?>