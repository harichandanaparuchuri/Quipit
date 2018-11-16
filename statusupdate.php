<?php
require_once 'dbsql.php';
if(isset($_SESSION['userinfo']))
{
    $userid=$_SESSION['userinfo']['userid'];
$statquery=<<<ABC
        Select point From [dbo].[status] Where userid='$userid'
ABC;
              $stresults = executeQuery($statquery);
               if(count($stresults)===1)
           {
           foreach($stresults as $res1)
           {
               
             $point=$res1['point'];
               //echo "<script type='text/javascript'>alert('".$point."')</script>";  
               
               if($point >150 & $point <=250)
                {//intrmediate
                   $status="Intermediate";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$userid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                
                
                }
                if($point >250 & $point <=550)
                {
                   $status="Practitioner";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$userid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                 //practioner
                }
                if($point >550 & $point <=1000)
                {$status="Expert";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$userid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                    //expert
                }
                if($point>1000)
                {$status="Guru";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$userid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                    //guru
                }
                 
           }
}
header('location: yourquip.php');
                }
?>