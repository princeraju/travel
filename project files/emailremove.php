<?php
if(isset($_GET['ref']))
{
    if(!empty($_GET['ref']))
        $ref=$_GET['ref'];
}
setcookie('email', '', time() - 3600);
if(isset($ref))
{
    header('Location:'.$ref.'.php');
}
else
{
    header('Location:index.php');
}
?>