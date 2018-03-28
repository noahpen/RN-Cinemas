<?php
	include('session.php');
	?>
<html>
	<head>
		<title>Sign Up</title>
		<link rel='stylesheet' type='text/css' href='assets/css/main.css' />
	</head>
	<body>
		<ul>
		<li><a href="/">Home</a></li>
		<?php 
			if(!isset($_SESSION['login_user'])){
				echo "<li style='float:right'><a href = 'login.php'>Login</a></li>";
				echo "<li style='float:right'><a class='active' href = 'sign-up.php'>Sign Up</a></li>";
			}
			else{
				header("location: index.php");
			}	
			?>
		</ul>
		<div style="padding:20px;margin-top:30px;height:1500px;">
			<h1> Cinema Sign Up Page </h1>
			
			<form action = "" method = "post">
                  <label>UserName: </label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password: </label><input type = "password" name = "password" class = "box" /><br/><br />
				  <label>First Name: </label><input type = "text" name = "username" class = "box"/><br /><br />
				  <label>Last Name: </label><input type = "text" name = "username" class = "box"/><br /><br />
				  <label>Street Number: </label><input type = "text" name = "username" class = "box"/><br /><br />
				  <label>Street Name: </label><input type = "text" name = "username" class = "box"/><br /><br />
				  <label>City: </label><input type = "text" name = "username" class = "box"/><br /><br />
				  <label>Province: </label><input type = "text" name = "username" class = "box"/><br /><br />
				  <label>Postal Code: </label><input type = "text" name = "username" class = "box"/><br /><br />
				  <label>E-Mail: </label><input type = "text" name = "username" class = "box"/><br /><br />
				  <label>Credit Card Number: </label><input type = "text" name = "username" class = "box"/><br /><br />
				  <label>Credit Card Expiry: </label><input type = "text" name = "username" class = "box"/><br /><br />
                  <input type = "submit" value = "Submit"/><br />
            </form>
			
		</div>
	</body>
</html>