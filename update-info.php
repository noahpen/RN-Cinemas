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

				// GET ACCOUNT ROW
				$accountQuery = "SELECT * FROM users WHERE accountID = '$login_session_id'";
				$accountResult = mysqli_query($db,$accountQuery);
				$accountRow = mysqli_fetch_assoc($accountResult);

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
		<div class="formOutside">
			<div class="formInside">
			<h1>Update Account Info</h1>
			<form action = "" method = "POST">

				<h2>Login Information</h2>
				<div class="group">
					<label>UserName: </label><br />
                    <?php
                    echo "<input type = 'text' name = 'username' placeholder=$login_session disabled/><br /><br />"
                    ?>
				</div>
				<?php
				echo "
				<div class='group'>
					<label>Password: </label><br />
					<input type = 'password' name = 'password' value='$accountRow[password]' /><br/><br />
				</div>

				<h2>About You</h2>
				<input type = 'text' name = 'firstName' value='$accountRow[firstName]'/>
				<input type = 'text' name = 'lastName' value='$accountRow[lastName]'/><br /><br />
				<input type = 'text' name = 'streetNum' value='$accountRow[streetNum]'/>
				<input type = 'text' name = 'streetName' value='$accountRow[streetName]'/><br /><br />
				<input type = 'text' name = 'city' value='$accountRow[city]'/><br /><br />
				<input type = 'text' name = 'province' value='$accountRow[province]'/><br /><br />
				<input type = 'text' name = 'postalCode' value='$accountRow[postalCode]'/><br /><br />
				<input type = 'email' name = 'email' value='$accountRow[email]'/><br /><br />

				<h2>Payment Information</h2>
				<input type = 'text' name = 'creditNum' value='$accountRow[creditNum]'/><br /><br />
				<input type = 'text' name = 'creditExp' value='$accountRow[creditExp]'/><br /><br />
				<button type = 'submit' class='submitButton'><span>Update Profile</span></button><br />";
				?>
				
			</form>
		</div>
		</div>
	</body>
</html>