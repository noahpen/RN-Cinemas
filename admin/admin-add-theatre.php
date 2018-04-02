<?php
    include('../session.php');
?>
<html>
	<head>
		<title>Admin - Add Theatre | RN Cinemas</title>
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
                    
                    $success = false;

                    if($_SERVER["REQUEST_METHOD"] == "POST") {

                        $complexID = mysqli_real_escape_string($db,$_POST['complex']);
                        $theatreNum = mysqli_real_escape_string($db,$_POST['theatreNum']);
                        $numSeats = mysqli_real_escape_string($db,$_POST['numSeats']);
                        $screenSize = mysqli_real_escape_string($db,$_POST['screenSize']);
                        
                        // GET MAX
                        $maxTheatreResult = mysqli_query($db, "SELECT MAX(theatreID) AS max FROM `theatre`" );
					    $maxTheatreRow = mysqli_fetch_assoc($maxTheatreResult);
                        $maxTheatreID = $maxTheatreRow['max'] + 1;

                        $theatreQuery = "INSERT INTO theatre (theatreID, theatreNum, complexID, numSeats, screenSize) VALUES ('$maxTheatreID', '$theatreNum', '$complexID', '$numSeats', '$screenSize')";
                        $result = mysqli_query($db,$theatreQuery);

                        if($result) {
                            $success = true;
                        }
                    }
				
			?>
        </ul>
        </div>
            <div class="formOutside">
            <div class="formInside">
            <h1 class="header" align="center">Add New Theatre</h1>
                <form action = "" method = "post">
                    <h2>Theatre Info</h2>

                    <p>Complex: &nbsp;
                    <?php
                        $complexQuery = "SELECT complexName, complexID FROM complex";
                        $complexResult = mysqli_query($db,$complexQuery);
                        echo "<select name='complex'>";
                        while ($row = mysqli_fetch_array($complexResult)) {
                            echo "<option value='" . $row['complexID'] . "'>" . $row['complexName'] . "</option>";
                        }
                        echo "</select>";
                    ?>
                    </p>
                    
                    <p>Theatre Number: &nbsp;
                    <input type = "number" name = "theatreNum" placeholder="Theatre Num" required/><br>
                    </p>

                    <p>Number of Seats: &nbsp;
                    <input type = "number" name = "numSeats" placeholder="Num Seats" required/><br>
                    </p>

                    <p>Screen Size: &nbsp;
                    <select name="screenSize">
                        <option value="S">Small</option>
                        <option value="M">Medium</option>
                        <option value="L">Large</option>
                    </select>
                    </p>

                    <button type="submit" class="submitButton"><span>Submit Theatre</span></button>
                </form>

                <?php
                    if ($success) {
                        echo "</br>Theatre $theatreNum in complex $complexID created successfully!";
                    }
                ?>
            </div>
            </div>
    </body>
</html>