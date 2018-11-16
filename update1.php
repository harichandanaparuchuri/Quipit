<?php
session_start();
 require_once 'dbsql.php';
  require_once 'sql.php';
  
  $quipid=$_REQUEST['%%%%'];
  //$quipid=$_GET['quipid'];
  print_r('quipid='.$quipid);
 $quiptitle=$quiptext=$cid=$cid= "";
if(isset($_SESSION['userinfo']))
{
    $quipid=$_REQUEST['%%%%'];
    print_r('quipid='.$quipid);
    //echo "<script type='text/javascript'>alert('".$quipid."')</script>";
    $status="";
    //echo"<script type='text/javascript'>alert('". $_SESSION['userinfo']['userid'] ."')</script>";
 $userid=$_SESSION['userinfo']['userid'];

  $query = "Select quipid From [dbo].[quip] Where userid=$userid";
                     $results = executeQuery($query);
                     
                    $quipcount= count($results);
                  $query = "Select status From [dbo].[status] Where userid=$userid";

                     $results = executeQuery($query); 
                     if(count($results)===1)
                     {
                         foreach($results as $res)
                         {
                             $status=$res['status'];
                         }
                     }
                     $query="Select quiptitle,quiptext,dateofquip,categoryid From [dbo].[quip] Where quipid= $quipid";
                     
                     $results=  executeQuery($query);
                     foreach($results as $res)
                     {
                         $quiptitle=$res['quiptitle'];
                         $quiptext=$res['quiptext'];
                         $categorynumber=$res['category'];
                         //echo "<script type='text/javascript'>alert('".$quiptext.$quiptitle.$categorynumber."')</script>";
                     }
                    // echo "dnrbosnnosnnorngom";
   
}
 else { 
     header('location: signin.php');
 }
 
 
 
 
  
 

     
     
//        $userid=$_SESSION['userinfo']['userid'];
//        
//        $updatedquiptitle=$_post['quiptitle'];
//        $updatedquiptext=$_post['quiptext'];
//        $dateofquip=date("Y-m-d h:i:sa");
//        $cid=$_post['category'];
//      if($_SERVER["REQUEST_METHOD"] == "POST")
//    {
//          echo "came here";
//            $query ="Update quip Set quiptitle = '$updatedquiptitle', quiptext = '$updatedquiptext', dateofquip ='$dateofquip', categoryid=$cid Where quipid = $quipid";
//
//            $results = executeQuery($query);
//           
//            header('location: yourquip.php');
//        }  
//      
//        
 
//if (isset($_POST['userid']))
//{
//     
//          $userid=$_SESSION['userinfo']['userid'];
//        
        $updatedquiptitle=$_post['quiptitle'];
        $updatedquiptext=$_post['quiptext'];
        $dateofquip=date("Y-m-d h:i:sa");
        $cid=$_post['category'];
        
//        
//        $query ="
//Update [dbo].[quip]
//Set quiptitle = '$updatedquiptitle', quiptext = '$updatedquiptext', categoryid = $cid, dateofquip = '$dateofquip'
//Where userid = $userid";
//
//    executeQuery($query);
//     
//     
//     
//     
// }
        
$qp = getQuipList();

foreach ($qp as $pp){


$p= $pp['quipid']  ;
}

$dateofquip=date("Y-m-d h:i:sa");
    
   ?>
 
    
    
<!DOCTYPE html>
<html>
<head>
   
   
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
               <button type="submit" onclick="location.href='yourquip.php';">YourQuips</button>
               <button type="submit" onclick="location.href='signout.php';">Sign Out</button>
            
           </div>
       </div> 
        <input type="search" name="search" value="" placeholder="Search" />
       
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
 
    <div id="CreateAside">
        <aside>
            
            <form name="createquip" method="post" action="edit1.php">
                <?php echo'<input type="hidden" name="quipid" value="' . $p . '" />';?>
                  <?php echo'<input type="hidden" name="dateofquip" value="' . $dateofquip . '" />';?>
            <div id="QuipTitle">
                <label>Title: </label> <input type="text" name="quiptitle" required placeholder="Enter the Title of Quip" min="1" max="45" value="<?php echo $quiptitle; ?>"/>
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
                <label>Text: </label><textarea name="quiptext" required placeholder="Write your Quip here" minlength="1" maxlength="2500"> <?php echo $quiptext; ?></textarea>
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
                
                <button type="submit" name="quipbutton"  title="Click on 'QuipIt!' to create a quip" onclick="return Validate()" >QuipIt!</button>
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

