<!DOCTYPE html>
<html>
<head>  
<!--     PHP Project
        File Name: Register.html
        Authors: Nick Ross, Hari Chandana Paruchuri, Arnesh Koul
    -->
     <meta charset="utf-8" /><!--
-->    <title>Register</title><!--
-->    <link href="Layout.css" rel="stylesheet" />
</head>

    <?php
 require_once 'dbsql.php';
// require_once 'newEmptyPHP1.php';
$firstnameerr = $firstname = $lastnameerr = $lastname = $emailerr = $email = $usernameerr = $username = $passworderr = $password = $repassworderr = $repassword = "";
//getting the user data from form and storing it in php variables
$error=false;
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $dateofmembership=date("Y-m-d h:i:sa");
    
            if (empty($_POST["firstname"]))
            {
               $firstnameerr = "First Name is required";
               $error=true;
            }
            else 
            {
                $firstname = test_input($_POST["firstname"]);
            if (strlen($firstname) < 3) 
            {
                $error = true;
                $nameError = "Name must have atleat 3 characters.";
                
            }
            }
            if (empty($_POST["lastname"]))
            {
               $lastnameerr = "Last Name is required";
               $error=true;
            }else 
            {
               $lastname = test_input($_POST["lastname"]);
              
            }
           if (empty($_POST["email"])) 
            {
               $emailerr = "email is required";
               $error=true;
              if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $emailerr = "Invalid email format";
                    $error=true;
                }               
            }       
            else 
            { 
                $email=test_input($_POST["email"]);
                $query="Select emailid From [dbo].[user] Where emailid='$email'";

               $results=executeQuery($query);
         
               if(count($results)>0)
               {
                   $emailerr ="An Account with this email already exists";
                   echo "<script type='text/javascript'>alert('". $emailerr ."')</script>";
                  $error=true;
               }else{

               $emailid = test_input($_POST["email"]);
               }
            }
            if (empty($_POST["username"])) 
            {
               $usernameerr = "Username is required";
               $error=true;
            }else 
            {
                $uname = test_input($_POST["username"]);
                 $query="Select username From [dbo].[user] Where username='$uname'";
                $results=executeQuery($query);
         
               if(count($results)>0)
               {
                   $unameerr ="This username is already in use";
                   echo "<script type='text/javascript'>alert('". $unameerr ."')</script>";
                  $error=true;
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
               $password = test_input($_POST["password"]);
              
            }
            if (empty($_POST["repassword"])) 
            {
               $repassworderr = "Re-Typing of password is required";
               $error=true;
            }else 
            {
               $repassword = test_input($_POST["repassword"]);
              
            }
            if($password  !== $repassword)
            {
                $samepassworderr="The password in both fields shd be same";
                    $error=true;
            } 
            
           if( !$error )
            {
               $query = <<<ABC
        Insert Into [dbo].[user](username,firstname,lastname,emailid,dateofmembership,password)
        Values('$username','$firstname','$lastname','$emailid','$dateofmembership','$password') 
ABC;
            $results = executeQuery($query);
               $query = <<<ABC
        Select userid From [dbo].[user] Where username='$username' And firstname='$firstname' And lastname='$lastname' And emailid='$emailid' And password='$password';
ABC;
                $results = executeQuery($query);
                
                if(count($results)===1)
                {
                    
                    foreach($results as $res)
                    {
                        
                         $userid=$res['userid'];
                         //status can be Novice,apprentice,practioner,expert,guru
                         $status="Novice";
                         $points=0;
                         $query = <<<ABC
        Insert Into [dbo].[status](status,point,userid)
       Values('$status','$points','$userid') 
ABC;
                     $results = executeQuery($query);
                         //echo " <script type='text/javascript'>alert('". $results['status'] ."')</script>";
                    }
                   
                    
                }
         $sucess="Registered Sucessfully.Log In to access your homepage";
         echo " <script type='text/javascript'>alert('". $sucess ."')</script>";
         header('Location: URL=signin.php');
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
<body class="Register">
    <header>      
        <div class="linkback">
       <a href="home.php" class="Logo"><img src="QuipItLogoWhite.png"></a>
      </div>
    </header> 
    

<!--      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="QuipItLogoWhite.png" alt="QuipIt" class="avatar">
    </div>-->-->
  <div class="Register">
   <aside>
       <div class="regimg">
      <img src="RegTextImage.png" alt="Welcome to QuipIt." class="Welcome" />
      </div>
      <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="registerform" onclick="return Validate()">
      <h1>Register</h1>
      <label><b>First Name:</b></label>
      <input type="text" placeholder="Enter First Name" name="firstname" required pattern="[A-Za-z ]{1,30}" title="First Name cannot be more than 30 chracters.Only letters and white space allowed" >
      <br/>
      <div id="firstname_error" class="val_error"></div>
      <div id="fname_error" class="val_error"></div>
      <br/>
      <label><b>Last Name:</b></label>
      <input type="text" placeholder="Enter Last Name" name="lastname" required pattern="[A-Za-z ]{1,30}" title="First Name cannot be more than 30 characters Only letters and white space allowed" >
      <br/>
      <div> <?php echo $lastnameerr;?></div>
      <div id="lastname_error" class="val_error"></div>
      <br/>
      <label><b>Email:</b></label>
      <input type="text" placeholder="Enter Email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Enter a valid email address">
      <br/>
      <div> <?php echo $emailerr;?></div>
      <div id="email_error" class="val_error"></div>
      <br/>
      <label><b>Username:</b></label>
      <input type="text" placeholder="Enter Username" name="username" required pattern="[A-Za-z ]{1,30}" title="Enter a valid Username" >
      <br/>
      <div> <?php echo $usernameerr;?></div>
      <div id="username_error" class="val_error"></div>
      <br/>
      <label><b>Password:</b></label>
      <input type="password" placeholder="Enter Password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain minimum of 8 characters with atleast one capital letter,small letter and a digit">
      <br/>
      <div> <?php echo $passworderr;?></div>
      <br/>
      <label><b>Re-type Password:</b></label>
      <input type="password" placeholder="Re-Enter Password" name="repassword" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain minimum of 8 characters with atleast one capital letter,small letter and a digit">
      <br/>
      <div id="password_error" class="val_error"></div>
      <div> <?php echo $repassworderr;?></div>
      <div> <?php echo $samepassworderr;?></div>
      <div> <?php echo $registererr; ?></div> 
      <button class="Register" type="submit" name="submit"  title="Click on Register to create a quipit account" onclick="return Validate()" >Register</button>
    </form>
     <div class="reglink">
        <a href="signin.php">Already have an account? Sign In.</a>
     </div>
   </aside>
  </div>
    
<script type="text/javascript">
    // GETTING ALL INPUT TEXT FIELDS
   	var firstname = document.forms["registerform"]["firstname"];
	var lastname = document.forms["registerform"]["lastname"];
	var email = document.forms["registerform"]["email"]; 
	var username = document.forms["registerform"]["username"];
	var password = document.forms["registerform"]["password"];
	var repassword= document.forms["registerform"]["repassword"];
        
    // GETTING ALL ERROR OBJECTS
        var firstname_error = document.getElementById("firstname_error");
	var lastname_error = document.getElementById("lastname_error");
        var email_error = document.getElementById("email_error");
	var username_error = document.getElementById("username_error");
        var password_error = document.getElementById("password_error");
//        var fname_error = <?php echo $firstnameerr;?>;
       // var sucessmsg = <?php echo $sucess;?>;
    
        
        function Validate(){
                //VALIDATE FIRSTNAME
//                function firstnameVerify(){
                if(firstname.value == ""){
                    firstname_error.textContent = "Firstname is required";
			//firstname.style.border = "1px solid red";
			//firstname.focus();
			return false;
                }
            //}
                //VALIDATE LASTNAME
//                function lastnameVerify(){
                if(lastname.value == ""){
                    lastname_error.textContent = "Lastname is required";
			//lastname.style.border = "1px solid red";
			//lastname.focus();
			return false;
                }
               // }
                // VALIDATE EMAIL
		if(email.value == ""){
			email_error.textContent = "Email is required";
			//email.style.border = "1px solid red";
			//email.focus();
			return false;
		}
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
                if (repassword.value == ""){
                    	password_error.textContent = "Password required";
			
			//repassword.style.border = "1px solid red";
			//repassword.focus();
			return false;
		}
                //function passwordVerify(){
		if (password.value != repassword.value) {
			password_error.textContent = "The two passwords do not match";
			//password.style.border = "1px solid red";
			//repassword.style.border = "1px solid red";
                        //password.focus();
			return false;
		}
           // }
	}
	
//			
//        
</script>

<footer>
       <p>Developed by: Hari Chandana Paruchuri, Nick Ross, and Arnesh Koul</p>
   </footer>
</body>
</html>