<?php
   include("config.php");
   session_start();
   
   if(!isset($_SESSION['login_user'])){
		//echo "<li><a href = 'login.php'>Login</a></li>";
		//echo "<li><a class='active' href = 'sign-up.php'>Sign Up</a></li>";
	}
	else{
		header("location: index.php");
	}	
   
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
	  $error = "";
	  
      $sql = "SELECT accountID FROM users WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         
         header("location: index.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
    <head>
      <title>Login Page</title>
      <link rel='stylesheet' type='text/css' href='assets/css/main.css' />
      <!--
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
        -->
      
    </head>
    <body class="loginBody">

    <div class="login-page">
        <h1 align="center" id="bigHeader">RN CINEMAS</h1>
        <div class="form">
            <form class="login-form" action ="" method="post">
                <input type="text" name="username" placeholder="username"/>
                <input type="password" name="password" placeholder="password"/>
                <button type="submit">login</button>
                <p class="message">Not registered? <a href="sign-up.php">Create an account</a></p>
            </form>
        </div>
    </div>
	<!--
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>
        -->

   </body>
</html>