<?php
ob_start();
session_start();
 require_once 'dbsql.php';
if(isset($_SESSION['userinfo']))
{
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
       File Name: Home.html
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
  <?php    
  if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $error=false;
        
         if(empty($_POST['search']))
        {
            echo "<script type='text/javascript'>alert('search is required')</script>";
            $error=true;
        }
        else 
        {
            $searchtext=test_input($_POST['search']);
            $_SESSION['userinfo']['searchterm']=$searchtext;
         header('location: search.php');
            
        }
        
        
        
    }
    ?>
      <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'><div id='searchbox_error' class='val_error'></div><input id="search" type='search' name='search' value='' placeholder='Search' /><button class='search' type='submit' name='submit'  title='Click on Register to create a quipit account' hidden='hidden' onclick='return Validate()' >Search</button></form> 
       
   </header>
<script type="text/javascript">
    
    var quipper=<?php echo $quipper ?>
    document.getElementByName("quipper").value= quipper;
    var searchbox = document.forms["registerform"]["firstname"];
     var searchbox_error = document.getElementById("firstname_error");
    function Validate()
    {
      if(searchbox.value == ""){
                    searchbox_error.textContent = "search is empty";
			//firstname.style.border = "1px solid red";
			//firstname.focus();
			return false;
                }  
    }
    
    </script>
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
<!--    <script type="text/javascript">
    
    var membership=<?php echo $_SESSION['userinfo']['dateofmembership'] ?>;
    document.getElementByName("membershipdate").value= membership;
    var membershipdate_error = document.getElementByName("membershipdate").value;
    </script>-->
     <nav>
        <ul>
            <li><button class="nav" onclick="location.href='homeafterloggin.php';" style="background-color: rgba(65, 105, 225, .8);">Home</button></li>
            <li><button class="nav" onclick="location.href='createquip.php';">QuipCreate</button></li>
            <li><button class="nav" onclick="location.href='yourquip.php';">YourQuips</button></li>
        </ul>
    </nav>
 
     <div id="HomeContent"> <dl>
            
            <?php 
            $cid=1;
            for ($cid; $cid<=11;$cid++)
            {
                
                $query = "Select quipid,quiptitle,quiptext,dateofquip,categoryid From [dbo].[quip] Where categoryid='$cid'";
                $homeresults = executeQuery($query);
                $countofquips= count($homeresults);
                //echo"<dd>".$countofquips."</dd>";
                if($countofquips!=0)
                {
                 $query = "Select category From [dbo].[category] Where categoryid='$cid'";
                $results1 = executeQuery($query);
                if(count($results1)===1)
                {                               
                    foreach($results1 as $res)
                    {
                        $category=$res['category'];
                         echo "<dt>". $category." </dt>  ";
                    }
                    
                                                         
                } 
        
                
                    foreach($homeresults as $res)
                    {
                        $quiptitle=$res['quiptitle'];
                        $quipid=$res['quipid'];
                        $text=$res['quiptext'];
                        $showquiptext=  substr($text, 0,100);
                        $dateofquip=$res['dateofquip'];
                       
                        echo "<dd><strong>".$quiptitle."</strong><form action='viewquip.php?%%%%=".$quipid."' method='post' ><input type='submit' name='quipbutton' value='View' /></form></dd>";
                         echo"<dd>".$showquiptext."</dd>";
                        //echo "<form action='viewquip.php?%%%%=".$quipid."' method='post' ><input type='submit' name='quipbutton' value='View' /></form>";
//                        echo"<dd>".$showquiptext."<form action='viewquip.php?%%%%=".$quipid."' method='post' ><input type='submit' name='quipbutton' value='View' /></form></dd>";
                        $quipquery="Select userid From [dbo].[quip] Where quipid='$quipid'";
                        $useridresults=executeQuery($quipquery);
                         $commentquery="Select commentid From [dbo].[comments] Where quipid='$quipid'";
                        $commentresults=executeQuery($commentquery);
                        $commentcount=count($commentresults);
                        if(count($useridresults)===1)
                        {
                            foreach($useridresults as $res)
                            {
                                $useridofquip=$res['userid'];
                                $userquery="Select username From [dbo].[user] Where userid='$useridofquip'";
                                $usernameresults=executeQuery($userquery);
                                if(count($usernameresults)>0)
                                {
                                    foreach($usernameresults as $res)
                                    {
                                        $usernameofquip=$res['username'];
                                        echo"<dd>Quipped by: ".$usernameofquip." &nbsp | &nbsp "."Posted on: ".$dateofquip." &nbsp | &nbsp ".$commentcount." comments </dd>";
                                    }
                                }
                            }
                        }
                        
                                            
                    }
                    
                    
               
                
                
                
                }
            }
           
               ?>
             
              
            </dl>
        </div>
   
   <footer id="home">
       <p>Developed by: Hari Chandana Paruchuri, Nick Ross, and Arnesh Koul</p>
   </footer>

</body>
</html>
