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
			<li><a href="index.php">Home</a></li>
			<?php 
				if(!isset($_SESSION['login_user'])){
					echo "<li style='float:right'><a href = 'login.php'>Login</a></li>";
					echo "<li style='float:right'><a class='active' href = 'sign-up.php'>Sign Up</a></li>";
				}
				else{
					header("location: index.php");
				}

				if($_SERVER["REQUEST_METHOD"] == "POST") {
					// username and password sent from form 
					
					$myusername = mysqli_real_escape_string($db,$_POST['username']);
					$mypassword = mysqli_real_escape_string($db,$_POST['password']); 
					$myfirstname = mysqli_real_escape_string($db,$_POST['firstName']);
					$mylastname= mysqli_real_escape_string($db,$_POST['lastName']);
					$mystreetnum = mysqli_real_escape_string($db,$_POST['streetNum']);
					$mystreetname = mysqli_real_escape_string($db,$_POST['streetName']);
					$mycity = mysqli_real_escape_string($db,$_POST['city']);
					$myprovince = mysqli_real_escape_string($db,$_POST['province']);
					$mypostalcode = mysqli_real_escape_string($db,$_POST['postalCode']);
					$myemail = mysqli_real_escape_string($db,$_POST['email']);
					$mycreditnum = mysqli_real_escape_string($db,$_POST['creditNum']);
					$mycreditexp = mysqli_real_escape_string($db,$_POST['creditExp']);

					$maxaccountIDresult = mysqli_query($db, "SELECT MAX(accountID) AS max FROM `users`" );
					$maxaccountIDrow = mysqli_fetch_assoc($maxaccountIDresult);
					$maxaccountID = $maxaccountIDrow['max'] + 1;

					$userQuery = "INSERT INTO users (accountID, username, password, firstName, lastName, streetNum, streetName, city, province, postalCode, email, creditNum, creditExp, adminFlag) VALUES ('$maxaccountID', '$myusername', '$mypassword', '$myfirstname', '$mylastname', '$mystreetnum', '$mystreetname', '$mycity', '$myprovince', '$mypostalcode', '$myemail', '$mycreditnum', '$mycreditexp', '0')";					
					mysqli_query($db,$userQuery);

					header("location: login.php");
				 }


				?>
		</ul>
		<div class="formOutside">
			<div class="formInside">
			<h1 style="text-align:center">Cinema Sign Up Page</h1>
			<form action = "" method = "post">

				<h2>Login Information</h2>
				<div class="group">
					<label>UserName: </label><br />
					<input type = "text" name = "username" placeholder="" required/><br /><br />
				</div>
				<div class="group">
					<label>Password: </label><br />
					<input type = "password" name = "password" placeholder="" required/><br/><br />
				</div>

				<h2>About You</h2>
				<input type = "text" name = "firstName" placeholder="First Name" required/>
				<input type = "text" name = "lastName" placeholder="Last Name" required/><br /><br />
				<input type = "text" name = "streetNum" placeholder="Street Number" required/>
				<input type = "text" name = "streetName" placeholder="Street Name" required/><br /><br />
				<input type = "text" name = "city" placeholder="City" required/><br /><br />
				<input type = "text" name = "province" placeholder="Province" required/><br /><br />
				<input type = "text" name = "postalCode" placeholder="Postal Code" required/><br /><br />
				<input type = "email" name = "email" placeholder="E-Mail" required/><br /><br />

				<h2>Payment Information</h2>
				<input type = "text" name = "creditNum" placeholder="Credit Card Number" required/><br /><br />
				<input type = "text" name = "creditExp" placeholder="Credit Card Expiry" required/><br /><br />
				<button type = 'submit' class='submitButton'><span>Sign Up</span></button><br />
				
			</form>
		</div>
		</div>
	</body>
</html>