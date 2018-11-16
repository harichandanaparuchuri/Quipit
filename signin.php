<?php
session_start();
 require_once 'dbsql.php';
$usernameerr = $username = $passworderr = $password = $userid = "";
$error = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
   if (empty($_POST["username"])) 
            {
               $usernameerr = "Invalid Username";
               $error=true;
            }else 
            {
                $uname = test_input($_POST["username"]);
                 $query="Select username From [dbo].[user] Where username='$uname'";
                $results=executeQuery($query);
         
               if(count($results) <= 0)
               {
                   $unameerr ="This username does not exist. Please register before signing in";
                   echo "<script type='text/javascript'>alert('". $unameerr ."')</script>";
                  $error=true;
                   header('Refresh: 1; URL=register.php');
               }else{
                $username = test_input($_POST["username"]);
               }
              
            }
            if (empty($_POST["password"])) 
            {
               $passworderr = "password is required";
                   $error=true;
            }else
            {
               $psswd = test_input($_POST["password"]);
                $query="Select password From [dbo].[user] Where username='$username' And password='$psswd'";
              $results=executeQuery($query);
              if(count($results)<=0)
               {
                   $psswderr ="The password does not match the username";
                   echo "<script type='text/javascript'>alert('". $psswderr ."')</script>";
                  $error=true;
                   
               }else
               {
                   $password=test_input($_POST["password"]);
               }
              
              
            } 
            
            
             if( !$error )
            {
                 $query = <<<ABC
        Select userid,firstname,lastname,emailid,dateofmembership From [dbo].[user] Where username='$username' And password='$password';
ABC;
                $results = executeQuery($query);
               
//                    Select firstname,lastname,email,dateofmembership From [dbo].[user] Where username='$username' And password='$password')
       
                if(count($results)===1)
                {
                    
                    foreach($results as $res)
                    {
                        
                         $userid=$res['userid'];
                         $firstname=$res['firstname'];
                         $lastname=$res['lastname'];
                         $email=$res['emailid'];
                         $dateofmembership=$res['dateofmembership'];
                         
                         //echo " <script type='text/javascript'>alert('". $userid .$firstname .$lastname .$email. $dateofmembership."')</script>";
                         $_SESSION['userinfo']= array('userid'=>$userid, 'username'=>$username, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'email'=>$email, 'dateofmembership'=>$dateofmembership);
                          session_write_close(); 
                           header('Location: homeafterloggin.php');
                          
                         //echo "<script type='text/javascript'>alert('". $_SESSION."')</script>";
//                         echo " <script type='text/javascript'>alert('". $userid ."')</script>";
//                         
                    }
                 //$_SESSION['userinfo']= array('userid'=$userid);
//               $
//         $sucess="Registered Sucessfully.Log In to access your homepage";
//         echo " <script type='text/javascript'>alert('". $sucess ."')</script>";
//        
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
    
     <!--PHP Project
        File Name: SignIn.html
        Authors: Nick Ross, Hari Chandana Paruchuri, Arnesh Koul
    -->
    <meta charset="utf-8" />
    <title>Sign In</title>
    <link href="Layout.css" rel="stylesheet" />
</head>
<body class="SignIn">
    <header>
      <div class="linkback">
       <a href="home.php" class="Logo"><img src="QuipItLogoWhite.png"></a>
      </div>
    </header>
    
    
    
    <div class="SignIn" >
        <aside>
            <div class="signimg">
       <img src="SignInTextImage.png" alt="Welcome back." class="Welcome" />
    </div>
           <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="signinform" onclick="return Validate()">
            <h1>Sign In</h1>
            <label>Username:</label>
            <input type="text" placeholder="Enter Username" name="username" required pattern="[A-Za-z ]{1,30}" title="Enter a valid Username" >  
            <br><div id="username_error" class="val_error"></div><br />
            <label>Password:</label>
            <input type="password" placeholder="Enter Password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain minimum of 8 characters with atleast one capital letter,small letter and a digit">
            <div id="password_error" class="val_error"></div>
            <button type="submit" name="Sign In" value="Sign In" class="signbutton" title= "Click on sign in to go to your account " onclick="return Validate()">Sign In</button>
            </form>
           </div>
            <div class="signlink">
            <a href="register.php">Don't have an account? Create one.</a>
            </div>
        </aside>
    </div> 
    
<script type="text/javascript">
    // GETTING ALL INPUT TEXT FIELDS
   	var username = document.forms["signinform"]["username"];
	var password = document.forms["signinform"]["password"];
        
        var username_error = document.getElementById("username_error");
        var password_error = document.getElementById("password_error");
        
         function Validate(){
            
//             
		// VALIDATE USERNAME
		if(username.value == ""){
			username_error.textContent = "Username is required";
			//username.style.border = "1px solid red";
			//username.focus();
			return false;
		}
		
		// VALIDATE PASSWORD
                if (password.value == "" )  {
			password_error.textContent = "Password required";
			//password.style.border = "1px solid red";
			//password.focus();
			return false;
		}
            }
        
        </script>

   <footer>
       <p>Developed by: Hari Chandana Paruchuri, Nick Ross, and Arnesh Koul</p>
   </footer>
        </body>
</html>
