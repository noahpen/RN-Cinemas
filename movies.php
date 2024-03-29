<?php
	include('session.php');
	?>
<html>
	<head>
		<title>Movies | RN Cinemas</title>
		<link rel='stylesheet' type='text/css' href='assets/css/main.css' />
		<script src="assets/js/imagesClickJS.js"></script>
	</head>
	<body>
		<div class="navBar">
		<ul>
			<li><a href="index.php">Home</a></li>
            <li><a class="active" href="movies.php">Movies</a></li>
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
        <div class="movieImagesFrame">
            <?php
                $imageCounter = 0;
                $rowCounter = 0;
                
                $maxmovieIDresult = mysqli_query($db, "SELECT MAX(movieID) AS max FROM `movie`" );
				$maxmovieIDrow = mysqli_fetch_assoc($maxmovieIDresult);
				$maxmovieID = $maxmovieIDrow['max'];

                while ($maxmovieID >= 1){
                    if ($imageCounter == 4){
                        echo "<br>";
                        $imageCounter = 0;
                    }
                    echo "<img class='movieImages' src='images/$maxmovieID.jpg' alt='Movie ID: $maxmovieID' onclick='imageMovieDetails($maxmovieID)' >";
                    $maxmovieID = $maxmovieID - 1;
                    $imageCounter = $imageCounter + 1;
                }

            ?>
            </div>
        </div>
    </body>
</html>