<?php
	include('session.php');
?>
<html>
	<head>
		<title>Update Account Info</title>
		<link rel='stylesheet' type='text/css' href='assets/css/main.css' />
	</head>
	<body>
        <div class="navBar">
		    <ul>
			<li><a href="index.php">Home</a></li>
            <?php 
				$adminFlagQuery = "SELECT adminFlag FROM users WHERE username = '$login_session'";
				$adminFlagResult = mysqli_query($db,$adminFlagQuery);
				$row = mysqli_fetch_assoc($adminFlagResult);
                echo "<li style='float:right'><a href = 'logout.php'>Sign Out</a></li>";
                echo "<li style='float:right'><a href = 'account.php'>$login_session</a></li>";
				if($row['adminFlag'] == 1){
                    echo "<li style='float:right'><a href = 'admin.php'>Admin</a></li>";
				}
			?>
            </ul>
        </div>

		<?php 
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

				$userQuery = "UPDATE users 
                              SET password='$mypassword', firstName='$myfirstname', lastName='$mylastname', streetNum='$mystreetnum', streetName='$mystreetname', city='$mycity', province='$myprovince', postalCode='$mypostalcode', email='$myemail', creditNum='$mycreditnum', creditExp='$mycreditexp' 
                              WHERE accountID='$login_session_id'";					
                $result = mysqli_query($db,$userQuery);
                if($result) {
                    echo '<script language="javascript">';
                    echo 'alert("Profile updated successfully")';
                    echo '</script>';
                }
                else {
                    echo '<script language="javascript">';
                    echo 'alert("Error updating profile. Please try again.")';
                    echo '</script>';
                }
				//header("location: login.php");
			}
		?>
		<div class="updateForm">
			<h1 style="text-align:center">Update Account Info</h1>
			<form action = "" method = "POST">

				<h2>Login Information</h2>
				<div class="group">
					<label>UserName: </label><br />
                    <?php
                    echo "<input type = 'text' name = 'username' placeholder=$login_session disabled/><br /><br />"
                    ?>
				</div>
				<div class="group">
					<label>Password: </label><br />
					<input type = "password" name = "password" placeholder="" /><br/><br />
				</div>

				<h2>About You</h2>
				<input type = "text" name = "firstName" placeholder="First Name"/>
				<input type = "text" name = "lastName" placeholder="Last Name"/><br /><br />
				<input type = "text" name = "streetNum" placeholder="Street Number"/>
				<input type = "text" name = "streetName" placeholder="Street Name"/><br /><br />
				<input type = "text" name = "city" placeholder="City"/><br /><br />
				<input type = "text" name = "province" placeholder="Province"/><br /><br />
				<input type = "text" name = "postalCode" placeholder="Postal Code"/><br /><br />
				<input type = "email" name = "email" placeholder="E-Mail"/><br /><br />

				<h2>Payment Information</h2>
				<input type = "text" name = "creditNum" placeholder="Credit Card Number"/><br /><br />
				<input type = "text" name = "creditExp" placeholder="Credit Card Expiry"/><br /><br />
				<input type = "submit" value = "Update Profile"/><br />
				
			</form>
		</div>
	</body>
</html>