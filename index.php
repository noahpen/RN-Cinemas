<?php
   include('session.php');
?>
<html>
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
		<?php 
		if(!isset($_SESSION['login_user'])){
			echo "test";
			echo "<h2><a href = 'login.php'>Login</a></h2>";
		}
		else{
			echo $login_session;
			echo "<h2><a href = 'logout.php'>Sign Out</a></h2>";
		}
		?>
   </body>
   
</html>