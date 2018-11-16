<?php
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
       <form action='<?php echo searchvalidate();?>' method='post'><input id="search" type='search' name='search' value='' placeholder='Search' /><button class='search' type='submit' name='submit'  title='Click on Register to create a quipit account' hidden='hidden'onclick='searchvalidate();' >Search</button></form> 
      
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
            <li><button class="nav" onclick="location.href='yourquip.php';" style="background-color: rgba(65, 105, 225, .8);">YourQuips</button></li>
        </ul>
    </nav>
 
        <div id="HomeContent"><dl>
           
<?php
if(isset($_SESSION['userinfo']))
{
    $userid=$_SESSION['userinfo']['userid'];
    $query = "Select quipid,quiptitle,quiptext,dateofquip,categoryid From [dbo].[quip] Where userid='$userid'";
    $results = executeQuery($query);
    if(count($results)!=0)
    {
        foreach($results as $res)
        {
            $quiptitle=$res['quiptitle'];
            $quiptext=$res['quiptext'];
            $showquiptext=  substr($quiptext, 0,100);
            $dateofquip=$res['dateofquip'];
            $categoryid=$res['categoryid'];
            $quipid=$res['quipid'];      
            echo "<dt>".$quiptitle."</dt>"; 
            echo "<form method='post' action='deletequip.php?%%%%=".$quipid."'><input type='submit' name='deletebutton' value='Delete'onclick='return confirm('are you sure you want to delete it')'/></form>";
            echo "<form action='update1.php?%%%%=".$quipid."' method='post'><input type='submit' name='deletebutton' value='Update'/></form>";
            echo "<form action='viewquip.php?%%%%=".$quipid."' method='post' ><input type='submit' name='quipbutton' value='View' /></form>";
            echo"<dd>".$showquiptext."</dd>";           
            $query = "Select category From [dbo].[category] Where categoryid='$categoryid'";
            $results0 = executeQuery($query);
            if(count($results0)===1)
            {                               
                foreach($results0 as $res0)
                {
                    $category=$res0['category'];
                    echo "<dd></dd><dd>Category: ".$category." &nbsp | &nbsp ";             
                }
            } // ending category  if   
            $query = "Select comment,dateofcomment,userid From [dbo].[comments] Where quipid=$quipid";
            $results1 = executeQuery($query);
            //$commentcount=count($results1);
            echo  count($results1)." Comments</dd>";          
               
    }}else
         {
             echo"<dt>There are no quips posted</dt>";
         }
//    
             //ending if of session        
            }else
            {
                header('location: signin.php');
            }
    
            ?>
            
  <script type="text/javascript">
            
                      
            function confirmdelete()
            {
                if(confirm("Are you sure you want to delete this quip?")){
                 
                }
                
            }
            
            </script>             
            </dl>
        </div>
    
   <footer id="home">
       <p>Developed by: Hari Chandana Paruchuri, Nick Ross, and Arnesh Koul</p>
   </footer>

</body>
</html>
