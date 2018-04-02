<?php
    include('../session.php');
?>
<html>
	<head>
		<title>Admin - Modify Showing | RN Cinemas</title>
		<link rel='stylesheet' type='text/css' href='../assets/css/main.css' />
		<script src="../assets/js/imagesClickJS.js"></script>
	</head>
	<body>
		<div class="navBar">
		<ul>
			<li><a href="../index.php">Home</a></li>
            <?php 
				if(!isset($_SESSION['login_user'])){
					header("location: ../index.php");
					}
					else{
					$adminFlagQuery = "SELECT adminFlag FROM users WHERE username = '$login_session'";
					$adminFlagResult = mysqli_query($db,$adminFlagQuery);
					$row = mysqli_fetch_assoc($adminFlagResult);
					echo "<li style='float:right'><a href = '../logout.php'>Sign Out</a></li>";
					echo "<li style='float:right'><a href = '../account.php'>$login_session</a></li>";
					if($row['adminFlag'] == 1){
					echo "<li style='float:right'><a class='active' href = '../admin.php'>Admin</a></li>";
                    }
                    else{
                        header("location: ../index.php");
                    }
                    }
                    
                $showingQuery = "SELECT showing.showingID, complex.complexName, showing.theatreID, movie.movieTitle, showing.startTime 
                                 FROM `showing` INNER JOIN movie ON showing.movieID=movie.movieID INNER JOIN theatre ON showing.theatreID=theatre.theatreID 
                                 INNER JOIN complex on complex.complexID=theatre.complexID ORDER BY showingID";
                $showingResult = mysqli_query($db,$showingQuery);

                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $sameShowingID = mysqli_real_escape_string($db,$_POST['sameShowingID']);
                    $newComplexName = mysqli_real_escape_string($db,$_POST['complex']);
                    $newMovieTitle = mysqli_real_escape_string($db,$_POST['movie']);
                    $newTheatreID = mysqli_real_escape_string($db,$_POST['theatreID']);
                    $newDate = mysqli_real_escape_string($db,$_POST['date']);
                    $newTime = mysqli_real_escape_string($db,$_POST['startTime']);

                    $newTime = date('H:i:s', strtotime($newTime));
                    $dateTime = $newDate . ' ' . $newTime;
                    $newMovieIDQuery = "SELECT movieID FROM movie WHERE movieTitle='$newMovieTitle' limit 1";
                    $newMovieIDResult = mysqli_query($db,$newMovieIDQuery);
                    $movieValue = mysqli_fetch_assoc($newMovieIDResult)['movieID']; 
                     
                    $modifiedShowingQuery = "UPDATE showing 
                                             SET theatreID='$newTheatreID', startTime='$dateTime', movieID='$movieValue'
                                             WHERE showingID='$sameShowingID'";
                    mysqli_query($db,$modifiedShowingQuery);

                    header("Refresh:0");
                }
			?>
        </ul>
        </div>
			<h1 class="header" align="center" style="margin-top:100px;">Modify Showings</h1>
            <div style="padding:20px;height:1500px;">
            <form method="post" action="admin-modify-showing.php">
		        <table align="center" class="buyTicketsMovieList table">
                    <tr>
                        <th>Showing ID</th>
                        <th>Complex</th>
                        <th>Theatre ID</th>
                        <th>Movie Title</th>
                        <th>Start Time</th>
                    </tr>
                    <?php
                    while($userRow = mysqli_fetch_assoc($showingResult)){
                    echo "
                    <tr>
                        <td>$userRow[showingID]</td>
                        <td>$userRow[complexName]</d>
                        <td>$userRow[theatreID]</td>
                        <td>$userRow[movieTitle]</td>
                        <td>$userRow[startTime]</td>
                        <td><input type='radio' name='showingID' value='$userRow[showingID]' required/>
                    </tr>
                    ";
                    }
                    ?>
                </table>
				<div align="center" style="margin-top:20px;">
                    <button type="submit" name="modifyShowing" class="submitButton"><span>Modify</span></button>
				</div>
            </form>
            </div>
    </body>
</html>