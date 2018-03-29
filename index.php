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
			<li><a class="active" href="index.php">Home</a></li>
			<?php 
				if(!isset($_SESSION['login_user'])){
					echo "<li style='float:right'><a href = 'login.php'>Login</a></li>";
					echo "<li style='float:right'><a href = 'sign-up.php'>Sign Up</a></li>";
				}
				else{
					$adminFlagQuery = "SELECT adminFlag FROM users WHERE username = '$login_session'";
					$adminFlagResult = mysqli_query($db,$adminFlagQuery);
					$row = mysqli_fetch_assoc($adminFlagResult);
					echo "<li style='float:right'><a href = 'logout.php'>Sign Out</a></li>";
					echo "<li style='float:right'><a href = 'account.php'>$login_session</a></li>";
					if($row['adminFlag'] == 1){
						echo "<li style='float:right'><a href = 'admin.php'>Admin</a></li>";
					}
				}	
				?>
		</ul>
			</div>
		<div style="padding:20px;margin-top:30px;height:1500px;">
			<h1 style="text-align:center">RN Cinemas</h1>
			<h2 style="text-align:center">Now Playing</h2>
			<div class="movieImagesFrame">
				<?php

				$maxmovieIDresult = mysqli_query($db, "SELECT MAX(movieID) AS max FROM `movie`" );
				$maxmovieIDrow = mysqli_fetch_assoc($maxmovieIDresult);
				$maxmovieID1 = $maxmovieIDrow['max'];
				$maxmovieID2 = $maxmovieID1 - 1;
				$maxmovieID3 = $maxmovieID1 - 2;
				$maxmovieID4 = $maxmovieID1 - 3;

				echo "<img class='movieImages' src='images/$maxmovieID1.jpg' alt='Movie ID: $maxmovieID1' onclick='imageMovieDetails($maxmovieID1)' >";
				echo "<img class='movieImages' src='images/$maxmovieID2.jpg' alt='Movie ID: $maxmovieID2' onclick='imageMovieDetails($maxmovieID2)' >";
				echo "<img class='movieImages' src='images/$maxmovieID3.jpg' alt='Movie ID: $maxmovieID3' onclick='imageMovieDetails($maxmovieID3)' >";
				echo "<img class='movieImages' src='images/$maxmovieID4.jpg' alt='Movie ID: $maxmovieID4' onclick='imageMovieDetails($maxmovieID4)' >";
				?>
			</div>
		</div>
	</body>
</html>