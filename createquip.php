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
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $error=false;
        $quiptitle=$quiptext=$cid=$cid= "";
        $userid=$_SESSION['userinfo']['userid'];
        $dateofquip=date("Y-m-d h:i:sa");
        
        if(empty($_POST['quiptitle']))
        {
            echo "<script type='text/javascript'>alert('Quip title is required')</script>";
            $error=true;
        }
        else 
        {
            $quiptitle=test_input($_POST['quiptitle']);
            $quiptitle=  str_replace("'","''" , $quiptitle);
        }
        if(empty($_POST['category']))
        {
            echo "<script type='text/javascript'>alert('Please select the category the quip falls into.')</script>";
            $error=true;
        }  
        else if($_POST['category']===0)    
        {
            echo "<script type='text/javascript'>alert('Please select a category ')</script>"; 
            $error=true;
        }
        else
        {
            $cid=test_input($_POST['category']);
            //echo "<script type='text/javascript'>alert('".$cid."')</script>";
        }
        if(empty($_POST['quiptext']))
        {
            echo "<script type='text/javascript'>alert('Please select a category ')</script>";
            $error=true;
        }
        else
        {
            $quiptext=test_input($_POST['quiptext']);
            $quiptext=  str_replace("'","''" , $quiptext);
            //echo "<script type='text/javascript'>alert('".$quiptext.$quiptitle."')</script>";
        }
        if(!$error)
        {
            //echo "<script type='text/javascript'>alert('we can insert the values ".$userid.$quiptitle.$quiptext.$cid."')</script>";
            $query = <<<ABC
        Insert Into [dbo].[quip](userid,quiptitle,quiptext,dateofquip,categoryid)
        Values($userid,'$quiptitle','$quiptext','$dateofquip',$cid)
ABC;
            $results = executeQuery($query);
                              $statusquery=<<<ABC
        Select point,status From [dbo].[status] Where userid='$userid'
ABC;
           $statusresults = executeQuery($statusquery);
           if(count($statusresults)===1)
           {
               
         
           foreach($statusresults as $res)
           {   $userstatus=$res['status'];
               $points=$res['point'];
               //echo "<script type='text/javascript'>alert('".$points."')</script>";
               $points+=5;
              // echo "<script type='text/javascript'>alert('".$points."')</script>";
               $updatequery=<<<ABC
        Update [dbo].[status] Set point='$points' Where userid='$userid'
ABC;
              $stresults = executeQuery($updatequery);
              
               }
           
             }
             header('location: statusupdate.php');
    
               
               
               
               
               
               
          
            header('location: yourquip.php');
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
        <form action='<?php echo searchvalidate();?>' method='post'><input id="search" type='search' name='search' value='' placeholder='Search' /><button class='search' type='submit' name='submit'  title='Click on Register to create a quipit account'  hidden='hidden'onclick='searchvalidate();' >Search</button></form> 
      
       
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
            <li><button class="nav" onclick="location.href='createquip.php';" style="background-color: rgba(65, 105, 225, .8);">QuipCreate</button></li>
            <li><button class="nav" onclick="location.href='yourquip.php';">YourQuips</button></li>
        </ul>
    </nav>
 
    <div id="CreateAside">
        <aside>
            <form name="createquip"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
            <div id="QuipTitle">
                <label>Title: </label> <input type="text" name="quiptitle" required placeholder="Enter the Title of Quip" min="1" max="45"/>
                <br /><div id="quiptitle_error" class="val_error"></div><div id="quiptitlecount_error" class="val_error"></div><br />
            </div>
                 <br />
                <br />
                <br />
                <br />
                <br />  
            <div id="Category">       
            <label>Category: </label><select id="category"name="category">
                    <option value="0">Select</option>
                    <option value="1">Social</option>
                    <option value="2">Sports</option>
                    <option value="3">Movies and Television</option>
                    <option value="4">Politics</option>
                    <option value="5">Science</option>
                    <option value="6">History</option>
                    <option value="7">Literature</option>
                    <option value="8">Economics</option>
                    <option value="9">Education</option>
                    <option value="10">Animals</option>
                    <option value="11">Miscellaneous</option>
                </select>
                <br />   
                <br />  
                <div id="optionvalue_error" class="val_error"></div>    
            </div>
            <div id="QuipContent">            
                <label>Text: </label><textarea name="quiptext" required placeholder="Write your Quip here" minlength="1" maxlength="2500"></textarea>
                <div id="quiptext_error" class="val_error"></div><br />
            </div>
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
            <div id="Button">         
                <br />
                <button type="submit" name="quipbutton" value="QuipIt!" title="Click on 'QuipIt!' to create a quip" onclick="return Validate()" >QuipIt!</button>
                <br />
            </div>
            </form>
        </aside>
    </div>
    <script type="text/javascript">
    var quiptitle=document.forms["createquip"]["quiptitle"];
    var quiptext=document.forms["createquip"]["quiptext"];
    var quiptext_error = document.getElementById("quiptext_error");
    var sel=document.getElementById('category');
   
    var countquip=quiptitle.length;
   
        var quiptitle_error = document.getElementById("quiptitle_error");
        var quiptitlecount_error = document.getElementById("quiptitlecount_error");
var optionvalue_error = document.getElementById("optionvalue_error");
 
    function Validate()
    { 
        //alert(opt);
    if(quiptitle.value == "" ){
                    quiptitle_error.textContent = "Quip title is required";
			//firstname.style.border = "1px solid red";
			//firstname.focus();
			return false;
                }
            if(quiptitle.value.length >=50){
                 
                        quiptitlecount_error.textContent = "Be creative with your quips. let it not be more than 50 characters.";
			//firstname.style.border = "1px solid red";
			//firstname.focus();
			return false;
                } 
                var opt=sel.options[sel.selectedIndex].value;
      if (opt==0)
      {
          optionvalue_error.textContent="Please select the category your quip falls into.";
          return false
      }
       if(quiptext.value == ""){
                    quiptext_error.textContent = "Quip text is required";
			//firstname.style.border = "1px solid red";
			//firstname.focus();
			return false;
                }  
                if(quiptext.value.length > 2500){
                    quiptext_error.textContent = "Be creative with your quips Let it not be more than 2500 characters";
			//firstname.style.border = "1px solid red";
			//firstname.focus();
			return false;
                }
                
    }
     
    
    
    </script>
    
    
    
    
    
   <footer>
       <p>Developed by: Hari Chandana Paruchuri, Nick Ross, and Arnesh Koul</p>
   </footer>

</body>
</html>
