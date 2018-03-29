<?php
	include('session.php');
	?>
<html>
	<head>
		<title>Movie Details</title>
		<link rel='stylesheet' type='text/css' href='assets/css/main.css' />
		<script src="assets/js/imagesClickJS.js"></script>
	</head>
	<body>
		<div class="navBar">
		<ul>
			<li><a href="index.php">Home</a></li>
			<?php 
				$getMovieID = $_GET['movieID'];
				
				if($_SERVER["REQUEST_METHOD"] == "POST") {

				    //$userIDQuery = "SELECT accountID FROM users WHERE username = '$login_session'";
				    //$userIDResult = mysqli_query($db,$userIDQuery);
                    //$userIDRow = mysqli_fetch_assoc($userIDResult);

				    $myreview = mysqli_real_escape_string($db,$_POST['reviewText']);
				    $reviewQuery = "INSERT INTO review (movieID, accountID, reviewText) VALUES ('$getMovieID', '$login_session_id','$myreview')";
				    mysqli_query($db,$reviewQuery);
				    header("location: movie-details.php?movieID=$getMovieID");
				}
				
				
				if(!isset($_SESSION['login_user'])){
				echo "<li style='float:right'><a href = 'login.php'>Login</a></li>";
				    echo "<li style='float:right'><a href = 'sign-up.php'>Sign Up</a></li>";
				    $loginCheck = false;
				}
				else{
				    $loginCheck = true;
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
		<div style="padding:20px;margin-top:30px;height:1500px;">
			<?php
				$reviewQuery = "SELECT * FROM review WHERE movieID = $getMovieID ORDER BY RAND()";
				$reviewResult = mysqli_query($db,$reviewQuery);
				//$reviewRow = mysqli_fetch_assoc($reviewResult);
				$reviewCounter = 0;
				echo "<table class='reviewTable'>
				    <tr><th style='border-bottom: 1px solid black;'>Reviews</th></tr>";
				    while($reviewRow = mysqli_fetch_assoc($reviewResult)){
				        echo "<tr><td class='reviewTableTD'>$reviewRow[reviewText]</td></tr>";
				        if ($reviewCounter == 8){
				            break;
				        }
				        else{
				            $reviewCounter = $reviewCounter + 1;
				        }
				    }
				    if ($loginCheck){
                echo "<tr>
                        <td>
                            <form action = '' method = 'post'>
				                <textarea id='reviewBox' type='text' name='reviewText' placeholder='Write Review Here!'></textarea>
				                <input style='width: 100%; margin-bottom: -15px;' type='submit' value='Submit'</input>
				            </form>
                        </td>
                </tr>";
				    }
				echo "</table>";
				$movieQuery = "SELECT * FROM movie WHERE movieID = '$getMovieID'";
				$movieResult = mysqli_query($db,$movieQuery);
				$movieRow = mysqli_fetch_assoc($movieResult);
				
				$supplierQuery = "SELECT * FROM supplier WHERE supplierID = '$movieRow[supplierID]'";
				$supplierResult = mysqli_query($db,$supplierQuery);
				$supplierRow = mysqli_fetch_assoc($supplierResult);
				
				echo "<img style='padding-right:15px' src='images/$getMovieID.jpg' alt='Movie ID: $getMovieID' >";
				echo "<div style='display:inline-block;vertical-align:top;'>
				            <h2>$movieRow[movieTitle]</h2>
				            <p>$movieRow[runningTime] minutes &ensp; Rated $movieRow[rating]</p>
				            <p>Director:<br />&ensp; $movieRow[director]</p>
				            <p>Actors:<br />&ensp; $movieRow[actors]</p>
				            <p>Producer:<br />&ensp; $movieRow[productionCompany]</p>
				            <p>Supplier:<br />&ensp; $supplierRow[supplierName]</p>
				            <p>Start Date:<br />&ensp; $movieRow[startDate]</p>
				            <p>End Date:<br />&ensp; $movieRow[endDate]</p>
				    </div>";
				
				echo "<br><br><p style='margin-right: 1200px'>$movieRow[plot]</p>";
				if ($loginCheck){
				    echo "<button onclick='buyTicketMovieDetails($getMovieID)' id='buyButton'>Buy Tickets</button>";
				}
				?>
		</div>
	</body>
</html>