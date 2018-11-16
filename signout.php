<?php 
session_start();
if(isset($_SESSION['userinfo']))
{
    session_destroy();
     header('location: home.php');
}
else{
    header('location: signin.php');
}

 ?>