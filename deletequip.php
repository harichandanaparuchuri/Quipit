<?php
session_start();
require_once 'dbsql.php';
if(isset($_SESSION['userinfo']))
{  $quipid=$_REQUEST['%%%%'];
//echo"$quipid";
    
    //echo"<script type='text/javascript'>alert('". $_SESSION['userinfo']['userid'] ."')</script>";
 $userid=$_SESSION['userinfo']['userid'];
   $query = <<<STR
Delete
From [dbo].[quip]            
where quipid = $quipid And userid = $userid
STR;
 $results=  executeQuery($query);   
  $query = <<<STR
Delete
From [dbo].[comments]            
where quipid = $quipid 
STR;
 $results=  executeQuery($query);   
 header('location: yourquip.php'); 
}
 else { 
     header('location: signin.php');
 }

?>
