<?php
   include('session.php');
?>
<html>
   <head>
      <title>Welcome </title>
	  <link rel='stylesheet' type='text/css' href='assets/css/main.css' />
   </head>
   
   <body><ul>
		<li><a class="active" href="index.php">Home</a></li>
		<?php 
		if(!isset($_SESSION['login_user'])){
			echo "<li style='float:right'><a href = 'login.php'>Login</a></li>";
			echo "<li style='float:right'><a href = 'sign-up.php'>Sign Up</a></li>";
		}
		else{
			echo "<li style='float:right'><a href = 'logout.php'>Sign Out</a></li>";
			
			$adminFlagQuery = "SELECT adminFlag FROM users WHERE username = '$login_session'";
			$adminFlagResult = mysqli_query($db,$adminFlagQuery);
			$row = mysqli_fetch_assoc($adminFlagResult);
			
			if($row['adminFlag'] == 1){
				echo "<li><a href = 'admin.php'>Admin</a></li>";
			}
			
		}	
		?>
		<ul>
		
		
   </body>
   
</html>