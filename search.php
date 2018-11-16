<?php
ob_start();
session_start();
 require_once 'dbsql.php';
 $username=$firstname=$lastname="";
// $searchtext=$_REQUEST['redirect'];
// echo"<script type='text/javascript'>alert('".$searchtext."')</script>";
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

     header('location : Signin.php');
     
     
     
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
               <button type="submit" onclick="location.href='signout.php';">Sign Out</button>
               <button type="submit" onclick="location.href='yourquip.php';">YourQuips</button>
               
           </div>
       </div> 
       <?php    if($_SERVER["REQUEST_METHOD"] == "POST")
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
    function test_input($inputdata) {
  $inputdata = trim($inputdata);
  $inputdata = stripslashes($inputdata);
    $inputdata = strip_tags($inputdata);
  $inputdata = htmlspecialchars($inputdata);
  return $inputdata;
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
       
   </header>
<script type="text/javascript">
    
    var quipper=<?php echo $quipper ?>
    document.getElementByName("quipper").value= quipper;
    
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
            <li><button class="nav" onclick="location.href='homeafterloggin.php';">Home</button></li>
            <li><button class="nav" onclick="location.href='createquip.php';">QuipCreate</button></li>
            <li><button class="nav" onclick="location.href='yourquip.php';">YourQuips</button></li>
        </ul>
    </nav>
 
     <div id="SearchContent"><dl>
           <?php
           
            $searchtext= $_SESSION['userinfo']['searchterm']; 
             echo  "<dt>Results matching : ".$searchtext."</dt>";
                    //echo"<script type='text/javascript'>alert('".$searchtext."')</script>"; 
                  $query = <<<ABC
                          Select userid,username,firstname,lastname From [dbo].[user] 
                          Where username='$searchtext' or firstname='$searchtext' or lastname='$serachtext'                     
ABC;
                  $results=  executeQuery($query);
                  if(count($results)>0)
                  {
                      foreach($results as $res)
                      {
                          $searchuserid=$res['userid'];
                          $username=$res['username'];
                          $firstname=$res['firstname'];
                          $lastname=$res['lastname'];
                          echo"<dd><strong>".$firstname." ".$lastname."</strong></dd>";
                          $query = <<<ABC
                          Select quiptitle,quiptext,quipid From [dbo].[quip] 
                          Where userid='$searchuserid'                      
ABC;
                            $results1=  executeQuery($query); 
                            $quipcountofsearch=count($results1);
                             echo"<dd>Quips Posted: ".$quipcountofsearch;  
                             $query = "Select status From [dbo].[status] Where userid='$searchuserid'";
       

                     $results = executeQuery($query); 
                     if(count($results)===1)
                     {
                         foreach($results as $res)
                         {
                             $status=$res['status'];
                              echo" &nbsp | &nbsp Quip level: ".$status."</dd>";  
                         }
                     }
                             if($quipcountofsearch>0)
                             {
                                 foreach($results1 as $res)
                                 {
                                     $quiptitle =$res['quiptitle'];
                                     $searchquiptext =$res['quiptext'];
                                     $quiptext=  substr($searchquiptext, 0,100);
                                     $quipid = $res['quipid'];
                                     echo "<form action='viewquip.php?%%%%=".$quipid."' method='post' ><input type='submit' name='quipbutton' value='View' /></form>";
                                     echo "<dd><strong>".$quiptitle."</strong></dd>";
                                     echo "<dd>".$quiptext."</dd>";
                                 }
                             }
                              
                     
                   }
                  }else {
                      $error=true;
                  }
                  $query = <<<ABC
                          Select quiptitle,quiptext,quipid,userid From [dbo].[quip] 
                          Where quiptitle='$searchtext'or quiptext='$searchtext'          
ABC;
                  $results2=executeQuery($query);
                   if(count($results2)>0)
                  {
                       
                    foreach($results2 as $res)
                    {   extract ($res);
                    $searchusername="";
                        $searchquiptitle=$res['quiptitle'];
                        $searchquiptext=$res['quiptext'];
                        $searchquipid=$res['quipid'];
                        $searchuserid=$res['userid'];
                        $searchquery= "Select firstname,lastname From [dbo].[user] Where userid='$searchuserid'";
                        $searchresults= executeQuery($searchquery);
                        foreach ($searchresults as $res)
                        {
                            $searchusername=$res['firstname']." ".$res['lastname'];
                            
                        }
                         echo "<form action='viewquip.php?%%%%=".$searchquipid."' method='post' ><input type='submit' name='quipbutton' value='View' /></form>";
                        echo "<dd>".$searchquiptitle;
                       
                        echo "<dd>Quipped by: ".$searchusername;
                    }
                       
                  }else {
                      $error=true;
                  }
                  $searchquery1 = <<<ABC
                          Select categoryid,category From [dbo].[category] 
                          Where category='$searchtext'         
ABC;
            $searchresult= executeQuery($searchquery1);
            foreach ($searchresult as $res)
            {
            
                $searchcategory=$res['categoryid'];
                $query = <<<ABC
                          Select quiptitle,quiptext,quipid,userid From [dbo].[quip] 
                          Where categoryid='$searchcategory'     
ABC;
                $searchcategoryresults =executeQuery($query);
                if(count($searchcategoryresults)>0)
                {
                    foreach($searchcategoryresults as $res)
                    {
                        $searchquiptitle=$res['quiptitle'];
                        $searchquipid=$res['quipid'];echo "<dd>".$searchquiptitle;
                        echo "<form action='viewquip.php?%%%%=".$searchquipid."' method='post' ><input type='submit' name='searchquipbutton' value='View' /></form></dd>";
                    }
                }  else {
                    
               $error=true;
                    
                }
                
            }
           
                  
                  if($error)
                  {
                      echo "<dd>No More Results</dd>";
                  }
            
           ?>  
         
            </dl>
        </div>
   
   <footer id="home">
       <p>Developed by: Hari Chandana Paruchuri, Nick Ross, and Arnesh Koul</p>
   </footer>

</body>
</html>
