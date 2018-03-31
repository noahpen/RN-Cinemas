<?php
    include('session.php');
?>
<html>
	<head>
		<title>RN Cinemas</title>
		<link rel='stylesheet' type='text/css' href='assets/css/main.css' />
		<script src="assets/js/imagesClickJS.js"></script>
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
				if($row['adminFlag'] == 1){
					echo "<li style='float:right'><a href = 'admin.php'>Admin</a></li>";
				}
			?>
        </ul>
        </div>
		<?php
			echo "<h2 id='accountHeader'>$login_session_fname's Account</h2>";
		?>
        <div class="userOptions">
            <button type="button" onclick="location.href='purchases.php';" name="view">View or cancel purchases</button>
            <button type="button" onclick="location.href='update-info.php';"name="update">Update account details</button>
            <button type="button" name="browse">Browse past rentals</button>
        </div>
    </div>
</html>