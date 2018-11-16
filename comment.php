<?php
session_start();
 require_once 'dbsql.php';
 $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'yourquip.php';
 //$quipid=$_REQUEST['%%%%'];
 //echo $quipid;
 $length=strlen($redirect);
 $quipid=substr($redirect,41,$length);
 //echo $length;
 //echo $quipid;
 $comment=$dateofcomment="";
if(isset($_SESSION['userinfo']))
{ 
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $userid=$_SESSION['userinfo']['userid'];
$error=false;
if(empty($_POST['commenttext'])){
    header('location: viewquip.php');
    echo "<script type='text/javascript'>alert('The comment of the quip is empty')</script>";
    $error=true;
}
else
{
   $comment=$_POST['commenttext']; 
 $comment=  str_replace("'","''" , $comment);
   $error=false;


       $dateofcomment=date("Y-m-d h:i:sa");
//                  
//            $comment=test_input($_POST['commenttext']);
//                
//            if(!$error)
//        {
//            //echo "<script type='text/javascript'>alert('we can insert the values ".$userid.$quiptitle.$quiptext.$cid."')</script>";
            $query = <<<ABC
      Insert Into comments(comment,dateofcomment,quipid,userid)
      Values('$comment','$dateofcomment','$quipid','$userid') 
                    
ABC;
      
             $results = executeQuery($query);
             
             $userquery= <<<ABC
                     Select userid From [dbo].[quip] Where quipid='$quipid'
ABC;
             $userresults = executeQuery($userquery);
             $statususerid="";
             foreach($userresults as $res)
             {
                 $statususerid=$res['userid'];
             }
          
              $statusquery=<<<ABC
                     Select point,status From [dbo].[status] Where userid='$statususerid'
ABC;
           $statusresults = executeQuery($statusquery);
           if(count($statusresults)===1)
           {
               
         
           foreach($statusresults as $res)
           {   $userstatus=$res['status'];
               $points=$res['point'];
               echo "<script type='text/javascript'>alert('".$points."')</script>";
               $points+=2;
               echo "<script type='text/javascript'>alert('".$points."')</script>";
               $updatequery=<<<ABC
        Update [dbo].[status] Set point='$points' Where userid='$statususerid'
ABC;
              $stresults = executeQuery($updatequery);
              
               }
           
             }
             $statquery=<<<ABC
        Select point From [dbo].[status] Where userid='$statususerid'
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
                   $status="intermediate";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$statususerid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                
                
                }
                if($point >250 & $point <=550)
                {
                   $status="practitioner";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$statususerid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                 //practioner
                }
                if($point >550 & $point <=750)
                {$status="expert";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$statususerid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                    //expert
                }
                if($point>1000)
                {$status="guru";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$statususerid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                    //guru
                }
                else{
                     $status="Novice";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$statususerid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                
                  echo "<script type='text/javascript'>alert('still novice')</script>";
                }
               
           }
               $statusquery=<<<ABC
                     Select point,status From [dbo].[status] Where userid='$userid'
ABC;
           $statusresults = executeQuery($statusquery);
           if(count($statusresults)===1)
           {
               
         
           foreach($statusresults as $res)
           {   $points=0;
               $userstatus=$res['status'];
               $points=$res['point'];
               echo "<script type='text/javascript'>alert('".$points."')</script>";
               $points+=2;
               if($statususerid === $userid)
               {
                   $points+=0;
               }
               echo "<script type='text/javascript'>alert('".$points."')</script>";
               $updatequery=<<<ABC
        Update [dbo].[status] Set point='$points' Where userid='$userid'
ABC;
              $stresults = executeQuery($updatequery);
              
               }
           
             }
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
                   $status="intermediate";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$userid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                
                
                }
                if($point >250 & $point <=550)
                {
                   $status="practitioner";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$userid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                 //practioner
                }
                if($point >550 & $point <=750)
                {$status="expert";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$userid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                    //expert
                }
                if($point>1000)
                {$status="guru";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$userid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                    //guru
                }
                else{
                     $status="Novice";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$userid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                
                  echo "<script type='text/javascript'>alert('still novice')</script>";
                }
               
               
               
           }}
             
             header('location:' . $redirect);
              


}
}
}
}


else
{
    header('location: signin.php');
}
function test_input($inputdata) {
  $inputdata = trim($inputdata);
  $inputdata = stripslashes($inputdata);
    $inputdata = strip_tags($inputdata);
  $inputdata = htmlspecialchars($inputdata);
  return $inputdata;
}

?>
    