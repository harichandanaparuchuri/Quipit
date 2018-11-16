<?php
session_start();
 require_once 'dbsql.php';
 $quipid=$_REQUEST['%%%%'];
 //echo"<script type='text/javascript'>alert('".$quipid."')</script>";
if(isset($_SESSION['userinfo']))
{  //$quipid=$_REQUEST['%%%%'];
    $status="";
    //echo"<script type='text/javascript'>alert('". $_SESSION['userinfo']['userid'] ."')</script>";
 $userid=$_SESSION['userinfo']['userid'];
  $query = "Select quipid From [dbo].[quip] Where userid='$userid'";
                     $results = executeQuery($query);
                     $quipcount= count($results);
                     $query = "Select status From [dbo].[status] Where userid='$userid'";
                     $results = executeQuery($query); 
                     if(count($results)===1)
                     {
                         foreach($results as $res)
                         {
                             $status=$res['status'];
                         }
                     }
    
}
 else { 
     header('location: signin.php');
 }
 
  function searchvalidate(){
      if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      
        
         if(!empty($_POST['search']))
        {
            $searchtext=test_input($_POST['search']);
            $_SESSION['userinfo']['searchterm']=$searchtext;
         header('location: search.php');
            
        }
        
    }
       
    }
 function test_input($inputdata) {
  $inputdata = trim($inputdata);
  $inputdata = stripslashes($inputdata);
    $inputdata = strip_tags($inputdata);
  $inputdata = htmlspecialchars($inputdata);
  return $inputdata;
}
 
?>

<!DOCTYPE html>
<html>
<head>
   <!--
    PHP Project
       File Name: Create.html
       Authors: Nick Ross, Hari Chandana Paruchuri, Arnesh Koul
   -->
   
   <meta charset="utf-8" />
   <title>QuipIt</title>
   <link href="Layout.css" rel="stylesheet" />
  
</head>

<body>
<header> 
        <div class="linkback">
       <a href="homeafterloggin.php" class="Logo"><img src="QuipItLogoWhite.png"></a>
      </div>
       <div class="dropdown">
           <input class="dropbtn" type="button" name="quipper" readonly value="<?php echo $_SESSION['userinfo']['firstname']." ".$_SESSION['userinfo']['lastname'];?>"/>
           <div class="dropdown-content">
               <button type="submit" onclick="location.href='createquip.php';">Create Quip</button>
               <button type="submit" onclick="location.href='yourquip.php';">YourQuips</button>
               <button type="submit" onclick="location.href='signout.php';">Sign Out</button>
            
           </div>
       </div> 
       <form action='<?php echo searchvalidate();?>' method='post'><input id="search" type='search' name='search' value='' placeholder='Search' /><button class='search' type='submit' name='submit'  title='Click on Register to create a quipit account'hidden='hidden' >Search</button></form>"; 
      
   </header>

  <aside>    
     <div id="LoggedIn">
            <input type="text" readonly class="name" value="<?php echo $_SESSION['userinfo']['firstname']." ".$_SESSION['userinfo']['lastname']?>" />
            <nav>
               <ul>
                  <li>Member since: <input type="text" size="7" readonly name="membershipdate" id="membershipdate" value="<?php echo $_SESSION['userinfo']['dateofmembership'] ?>"/></li>
                  <li>Quips posted: <input type="text" size="1" readonly name="membershipdate" id="membershipdate" value="<?php echo $quipcount ?>"/></li>              
                  <li>Quip Level: <input type="text" size="6" readonly name="membershipdate" id="membershipdate" value="<?php echo $status ?>"/></li>            
               </ul> 
            </nav>      
     </div>
  </aside> 
     <nav>
        <ul>
            <li><button class="nav" onclick="location.href='homeafterloggin.php';">Home</button></li>
            <li><button class="nav" onclick="location.href='createquip.php';">QuipCreate</button></li>
            <li><button class="nav" onclick="location.href='yourquip.php';">YourQuips</button></li>
        </ul>
    </nav>
 
 
    <?php
    
  
    //echo"<script type='text/javascript'>alert('".$quipid."')</script>";
          $query = "Select quiptitle,quiptext,dateofquip,categoryid From [dbo].[quip] Where quipid='$quipid'";
                     $results = executeQuery($query);  
                     $category=$usernameofcomment=$comment="";
                     $userid=$_SESSION['userinfo']['userid'];
    if(count($results)>0)                    
    {
        foreach($results as $res)
            {
                $quiptitle=$res['quiptitle'];
                $quiptext=$res['quiptext'];
                $dateofquip=$res['dateofquip'];
                $categoryid=$res['categoryid'];
                
                echo"<div id='ViewContent'><dl><dt>".$quiptitle."</dt>";
                echo"<dd>$quiptext</dd>";
                $query = "Select category From [dbo].[category] Where categoryid='$categoryid'";
                $results0 = executeQuery($query);
                if(count($results0)===1)
                {                               
                    foreach($results0 as $res0)
                    {
                        $category=$res0['category'];
          
                    }
                                                         
                }
                $query = "Select comment,dateofcomment,userid From [dbo].[comments] Where quipid='$quipid'";
                $results1 = executeQuery($query);
                if(count($results1)!=0)                   
                    {
                foreach($results1 as $res1)
                {
                    $commentofquip=$res1['comment'];
                    $dateofcomment=$res1['dateofcomment'];
                    $useridofcomment=$res1['userid'];
                    $query="Select username From [dbo].[user] Where userid='$useridofcomment'";
                    $results=  executeQuery($query);
                    foreach($results as $res)
                    {
                        $usernameofcomment=$res['username'];
                    }
                    //have toi get the username based on the user id.
                    echo"<dd>".$commentofquip."<br/><p style='font-size:0.7em;'> Comment By:".$usernameofcomment."  Date of Comment:".$dateofcomment."</p></dd>";
                }
                
    }
            }
     //header('location: yourquip.php');
 }
     else { 
  
     }
 
?>
<!--    <div id='ViewContent'>
            <dl>
                <dt>Topic</dt>-->
                
<!--                <dd>Comments</dd>
                <dd>Comments</dd>                       
                <dd>Comments</dd> -->

<!--//  if($_SERVER["REQUEST_METHOD"] == "POST")
//    { //$quipid=$_REQUEST['%%%%'];
//      $comment="";  
//      
//      $error=false;
//        $dateofcomment=date("Y-m-d h:i:sa");
//                  
//            $comment=test_input($_POST['commenttext']);
//                
//            if(!$error)
//        {
//            //echo "<script type='text/javascript'>alert('we can insert the values ".$userid.$quiptitle.$quiptext.$cid."')</script>";
//            $query = <<<ABC
//      Insert Into [dbo].[comments](comment,dateofcomment,quipid,userid)
//      Values('$comment','$dateofcomment',$quipid,$userid) 
//ABC;
//            
//            $results = executeQuery($query);
//           // echo "<script type='text/javascript'>alert('".$quipid."comment is required')</script>";
////            if(count($results))
////            {
////                foreach($results as $res)
////                {
////                    echo"<script type='text/javascript'>alert('comment is required')</script>";
////                }
////            }
//header('location: viewquip.php?%%%%=$quipid');
//            
//        }
//        
//       
//    }
////    
// 
//  function test_input($inputdata) {
//  $inputdata = trim($inputdata);
//  $inputdata = stripslashes($inputdata);
//    $inputdata = strip_tags($inputdata);
//  $inputdata = htmlspecialchars($inputdata);
//  return $inputdata;
//}--><!--
//
//-->
           <br/>
            
            <?php    echo" <form name='commentsection' action='comment.php?redirect=".$_SERVER['PHP_SELF']."?%%%%=".$quipid."' method='post'>"; ?>
             <div class='comment'>
                <label >Comment: </label>
              
                <textarea name='commenttext' required  maxlength="400" placeholder='Write your comment here'></textarea>
                <div id="commenttext_error" class="val_error"></div>
             </div>
                <div class="commentbtn"> 
                    <button class="Comment" type="submit" name="submit" value="Comment" title="Click to post a comment" onclick="return ValidateComment()">Comment</button>
                </div>   
            </dl>   
        </div>        <?php echo "</form>"; ?>

        <script type="text/javascript">
            
            var commentonquip=document.forms["commentsection"]["commenttext"];
            var commenttext_error=document.getElementById("commenttext_error");
            
            function ValidateComment()
            {
                if(commentonquip.value == "" ){
                    commenttext_error.textContent = "A comment is required";
			//firstname.style.border = "1px solid red";
			//firstname.focus();
			return false;
                }
                if(commentonquip.value >= 400)
                {
                    commenttext_error.textContent = "Be creative about your comments. Try putting it in 400 chracters";
                    return false ;
                }

            }
            
            </script>
   <footer id="home">
       <p>Developed by: Hari Chandana Paruchuri, Nick Ross, and Arnesh Koul</p>
   </footer>

</body>
</html>
