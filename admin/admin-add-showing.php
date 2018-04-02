<?php
    include('../session.php');
?>
<html>
	<head>
		<title>Admin - Add Showing | RN Cinemas</title>
		<link rel='stylesheet' type='text/css' href='../assets/css/main.css' />
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
                    
                    if($_SERVER["REQUEST_METHOD"] == "POST") {

                        // MOVIE TABLE
                        $myTitle = mysqli_real_escape_string($db,$_POST['movie']);
                        $myComplex = mysqli_real_escape_string($db,$_POST['complex']);
                        $myTheatreID = mysqli_real_escape_string($db,$_POST['theatreID']);
                        $myDate = mysqli_real_escape_string($db,$_POST['date']);
                        $myStartTime = mysqli_real_escape_string($db,$_POST['startTime']);
                        
                        // GET MAX
                        $maxShowingResult = mysqli_query($db, "SELECT MAX(showingID) AS max FROM `showing`" );
					    $maxShowingRow = mysqli_fetch_assoc($maxShowingResult);
                        $maxShowingID = $maxShowingRow['max'] + 1;

                        // QUERIES
                        $movieIDQuery = "SELECT movieID FROM movie WHERE movieTitle='$myTitle' limit 1";
                        $movieIDResult = mysqli_query($db,$movieIDQuery); 
                        $movieValue = mysqli_fetch_assoc($movieIDResult)['movieID']; 
                        $complexIDQuery = "SELECT complexID FROM complex WHERE complexName='$myComplex' limit 1";
                        $complexIDResult = mysqli_query($db,$complexIDQuery);
                        $complexValue = mysqli_fetch_assoc($complexIDResult)['complexID']; 
                        //$theatreIDQuery = "SELECT theatreID FROM theatre WHERE complexID='$complexIDResult' AND theatreNum='$myTheatreNum' limit 1";
                        //$theatreIDResult = mysqli_query($db,$theatreIDQuery);
                        //$theatreValue = mysqli_fetch_assoc($theatreIDResult)['theatreID']; 

                        $newTime = date('H:i:s', strtotime($myStartTime));
                        $dateTime = $myDate . ' ' . $newTime;

                        $showingQuery = "INSERT INTO showing (showingID, theatreID, startTime, avalSeats, movieID) VALUES ('$maxShowingID', '$myTheatreID', '$dateTime', NULL, '$movieValue')";
                        mysqli_query($db,$showingQuery);

                        header("Location: admin-display-showings.php");
                    }
                
				
			?>
        </ul>
        </div>
            <div class="formOutside">
            <div class="formInside">
            <h1 class="header" align="center">Add New Showing</h1>
                <form action = "" method = "post">
                    <h2>Showing Info</h2>
                    <p>Movie Title: &nbsp;
                    <?php
                        $movieQuery = "SELECT movieTitle FROM movie";
                        $movieResult = mysqli_query($db,$movieQuery);
                        echo "<select name='movie'>";
                        while ($row = mysqli_fetch_array($movieResult)) {
                            echo "<option value='" . $row['movieTitle'] . "'>" . $row['movieTitle'] . "</option>";
                        }
                        echo "</select>";
                    ?>
                    </p>

                    <p>Complex: &nbsp;
                    <?php
                        $complexQuery = "SELECT complexName FROM complex";
                        $complexResult = mysqli_query($db,$complexQuery);
                        echo "<select name='complex'>";
                        while ($row = mysqli_fetch_array($complexResult)) {
                            echo "<option value='" . $row['complexName'] . "'>" . $row['complexName'] . "</option>";
                        }
                        echo "</select>";
                    ?>
                    </p>

                    <p>Theatre ID: &nbsp;
                    <input type = "number" name = "theatreID" placeholder="1" required/><br>
                    </p>

                    <p>Date: &nbsp;
                    <input type = "date" name = "date" required/><br>
                    </p>

                    <p>Time: &nbsp;
                    <input type = 'text' name = 'startTime' placeholder='hh:mm' required/></br>
                    </p>

                    <button type="submit" class="submitButton"><span>Submit Showing</span></button>
                </form>
            </div>
            </div>
    </body>
</html>