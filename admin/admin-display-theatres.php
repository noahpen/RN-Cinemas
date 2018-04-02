<?php
    include('../session.php');
?>
<html>
	<head>
		<title>Admin - Modify Theatre | RN Cinemas</title>
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
                    
                $theatreQuery = "SELECT theatre.theatreID, theatre.theatreNum, complex.complexName, theatre.numSeats, theatre.screenSize 
                                 FROM theatre INNER JOIN complex ON theatre.complexID=complex.complexID ORDER BY theatreID";
                $theatreResult = mysqli_query($db,$theatreQuery);

                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $sameTheatreID = mysqli_real_escape_string($db,$_POST['sameTheatreID']);
                    $newComplexName = mysqli_real_escape_string($db,$_POST['complex']);
                    $newTheatreNum = mysqli_real_escape_string($db,$_POST['theatreNum']);
                    $newNumSeats = mysqli_real_escape_string($db,$_POST['numSeats']);
                    $newScreenSize = mysqli_real_escape_string($db,$_POST['screenSize']);

                    $newComplexIDQuery = "SELECT complexID FROM complex WHERE complexName='$newComplexName' limit 1";
                    $newComplexIDResult = mysqli_query($db,$newComplexIDQuery);
                    $complexValue = mysqli_fetch_assoc($newComplexIDResult)['complexID']; 
                     
                    $modifiedTheatreQuery = "UPDATE theatre 
                                             SET theatreID='$sametheatreID', theatreNum='$newTheatreNum', complexID='$complexValue', 
                                             numSeats='$newNumSeats', screenSize='$newScreenSize' WHERE theatreID='$sameTheatreID'";
                    mysqli_query($db,$modifiedTheatreQuery);

                    header("Refresh:0");
                }
			?>
        </ul>
        </div>
			<h1 class="header" align="center" style="margin-top:100px;">Modify Theatre</h1>
            <div style="padding:20px;height:1500px;">
            <form method="post" action="admin-modify-theatre.php">
		        <table align="center" class="buyTicketsMovieList">
                    <tr>
                        <th>Theatre ID</th>
                        <th>Theatre Number</th>
                        <th>Complex</th>
                        <th>Number of Seats</th>
                        <th>Screen Size</th>
                    </tr>
                    <?php
                    while($userRow = mysqli_fetch_assoc($theatreResult)){
                    echo "
                    <tr>
                        <td>$userRow[theatreID]</td>
                        <td>$userRow[theatreNum]</td>
                        <td>$userRow[complexName]</td>
                        <td>$userRow[numSeats]</td>
                        <td>$userRow[screenSize]</td>
                        <td><input type='radio' name='theatreID' value='$userRow[theatreID]' /></td>
                    </tr>
                    ";
                    }
                    ?>
                </table>
				<div align="center" style="margin-top:20px;">
                    <button type="submit" name="modifyTheatre" class="submitButton"><span>Modify</span></button>
				</div>
            </form>
            </div>
    </body>
</html>