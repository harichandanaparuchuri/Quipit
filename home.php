<?php

require_once 'dbsql.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $error=false;
        $searchtext="";
         if(empty($_POST['search']))
        {
            echo "<script type='text/javascript'>alert('search is required')</script>";
            $error=true;
        }
        else 
        {
           $searchtext=test_input($_POST['search']);
           header('location: search.php?%%%%=$searchtext');
            
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
       File Name: Home.html
       Authors: Nick Ross, Hari Chandana Paruchuri, Arnesh Koul
   -->
   
   <meta charset="utf-8" />
   <title>QuipIt</title>
   <link href="Layout.css" rel="stylesheet" />
  
</head>

<body>
   <header>  
       <div class="sign">
           <a href="signin.php">Sign In</a>
       </div>
        <div class="reg">
           <a href="register.php">Register</a>
       </div>
       <div class="linkback">
       <a href="home.php" class="Logo"><img src="QuipItLogoWhite.png"></a>
      </div>
   <form action="" method="post"><input type="search" name="search" value="" placeholder="Search" /><button class='search' type='submit' name='submit'  title='Click on Register to create a quipit account' hidden='hidden' onclick='return Validate()' >Search</button></form>
<!--//$results = getCateogry();-->
   </header>
  


    <div id="welcome">
        <aside>
            <h1>Welcome</h1>
            <div id="welcomemsg">
                <p>
                    QuipIt is a forum service
                    dedicated to unite the user with
                    exciting content. Here, the user
                    may view, comment, or post
                    their ideas freely.
               
                    At QuipIt, posts are called
                    “Quips.” To make your first
                    Quip, simply click register on
                    the top right of your screen.
                
                    There are a world of Quips to
                    explore, and the QuipIt
                    community is ready to hear
                    what you have to say. So what
                    are you waiting for? Begin your
                    QuipIt adventure today.
                </p>

                <p>
                    
                    - The QuipIt Developers
                </p>
            </div>  
        </aside>
    </div>
    <nav>
        <ul>
            <li><button class="nav" onclick="location.href='home.php';">Home</button></li>
            <li><button class="nav" onclick="location.href='createquip.php';">QuipCreate</button></li>
            <li><button class="nav" onclick="location.href='yourquip.php';">YourQuips</button></li>
        </ul>
    </nav>
 
        <div id="HomeContent">
            
            <!--foreach($reustls as $c)-->
            <dl>
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
                        echo "<dd><strong>".$quiptitle."</strong><form action='signin.php' method='post'><input type='submit' name='quipbutton' value='View'></form></dd>";
                        echo"<dd>".$showquiptext."</dd>";
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

   <footer>
       <p>Developed by: Hari Chandana Paruchuri, Nick Ross, and Arnesh Koul</p>
   </footer>

</body>
</html>
