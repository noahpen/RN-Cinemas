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
                echo "<li style='float:right'><a href = 'account.php'>$login_session</a></li>";
				if($row['adminFlag'] == 1){
                    echo "<li style='float:right'><a href = 'admin.php'>Admin</a></li>";
				}

				// SELECT `showing`.showingID, theatreID, startTime, movieID, accountID, totalTickets FROM `showing` INNER JOIN (SELECT accountID, showingID, COUNT(showingID) AS totalTickets FROM `tickets` WHERE accountID = 1 GROUP BY showingID) AS countedTickets ON (`showing`.showingID = countedTickets.showingID)

				$countedPurchasedQuery = "SELECT `showing`.showingID, theatreID, startTime, movieID, accountID, totalTickets FROM `showing` INNER JOIN (SELECT accountID, showingID, COUNT(showingID) AS totalTickets FROM `tickets` WHERE accountID = $login_session_id GROUP BY showingID) AS countedTickets ON (`showing`.showingID = countedTickets.showingID)";
				$countedPurchasedResult = mysqli_query($db,$countedPurchasedQuery);
				//$countedPurchasedRow = mysqli_fetch_assoc($countedPurchasedResult);

				//$movieQuery = "SELECT movieID, movieTitle FROM `movie` WHERE movieID = $countedPurchasedRow[movieID]";
				//$movieResult = mysqli_query($db,$movieQuery);
				//$movieRow = mysqli_fetch_assoc($movieResult);

				//$theatreQuery = "SELECT theatreID, theatreNum, complexID, NumSeats FROM `theatre` WHERE theatreID = $countedPurchasedRow[theatreID]";
				//$theatreResult = mysqli_query($db,$theatreQuery);
				//$theatreRow = mysqli_fetch_assoc($theatreResult);

				//$complexQuery = "SELECT complexID, complexName FROM `complex` WHERE complexID = $theatreRow[complexID]";
				//$complexResult = mysqli_query($db,$complexQuery);
				//$complexRow = mysqli_fetch_assoc($complexResult);

				//echo "$countedPurchasedRow[movieID]";
				//echo "$movieRow[movieTitle]";
				//echo "$theatreRow[theatreNum]";
				//echo "$complexRow[complexName]";

				if($_SERVER["REQUEST_METHOD"] == "POST") {


					$myshowing = mysqli_real_escape_string($db,$_POST['showingID']);
					$mynumtickets = mysqli_real_escape_string($db,$_POST['numCancel']); 
					
					for ($x = 1; $x <= $mynumtickets; $x++){
						$maxticketIDresult = mysqli_query($db, "SELECT MAX(ticketID) AS max FROM `tickets` WHERE accountID = $login_session_id AND showingID = $myshowing");
                        $maxticketIDrow = mysqli_fetch_assoc($maxticketIDresult);
                        $maxticketID = $maxticketIDrow['max'];

						$ticketQuery = "DELETE FROM tickets WHERE ticketID = $maxticketID";
						mysqli_query($db,$ticketQuery);
					}
				}

			?>
        </ul>
        <div style="padding:20px;margin-top:30px;height:1500px;">
		<?php
			echo "<h2 id='accountHeader'>$login_session_fname's Purchases</h2>";
		?>
		<form method="post">
		<table align="center" class="buyTicketsMovieList table">
		<tr>
			<th>Movie</th>
			<th>Complex</th>
			<th>Theatre</th>
			<th>Time</th>
			<th>Number of Tickets</th>
			<th>Cancel</th>
		</tr>
		<?php
		while($countedPurchasedRow = mysqli_fetch_assoc($countedPurchasedResult)){
			$movieQuery = "SELECT movieID, movieTitle FROM `movie` WHERE movieID = $countedPurchasedRow[movieID]";
			$movieResult = mysqli_query($db,$movieQuery);
			$movieRow = mysqli_fetch_assoc($movieResult);

			$theatreQuery = "SELECT theatreID, theatreNum, complexID, NumSeats FROM `theatre` WHERE theatreID = $countedPurchasedRow[theatreID]";
			$theatreResult = mysqli_query($db,$theatreQuery);
			$theatreRow = mysqli_fetch_assoc($theatreResult);

			$complexQuery = "SELECT complexID, complexName FROM `complex` WHERE complexID = $theatreRow[complexID]";
			$complexResult = mysqli_query($db,$complexQuery);
			$complexRow = mysqli_fetch_assoc($complexResult);
			
			echo "
			<tr>
			<td>$movieRow[movieTitle]</td>
			<td>$complexRow[complexName]</td>
			<td>$theatreRow[theatreNum]</td>
			<td>$countedPurchasedRow[startTime]</td>
			<td>$countedPurchasedRow[totalTickets]</td>
			";
			if ($countedPurchasedRow['startTime'] > $current_datetime){
				echo "<td><input type='radio' name='showingID' value='$countedPurchasedRow[showingID]' />";
			}
			echo "</tr>";

		}


		?>
		<br>
		<input type='number' placeholder='Number of Tickets' name='numCancel' required>
        <button type='submit' class='submitButton'><span>Cancel</span></button>

		</form>

		</table>
        </div>
    </body>
</html>