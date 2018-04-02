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
            ?>
            </ul>
            
            <div class="formOutside">
            <div class="formInside">          
            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $myTheatreID = mysqli_real_escape_string($db,$_POST['theatreID']);
                    $sql = "SELECT theatre.theatreID, theatre.theatreNum, complex.complexName, theatre.numSeats, theatre.screenSize 
                            FROM theatre INNER JOIN complex ON theatre.complexID=complex.complexID WHERE theatreID=$myTheatreID";
                    $result = mysqli_query($db,$sql);
                    $row = mysqli_fetch_assoc($result);
                    echo "<h2 class='header' align='center'>Modify Theatre $myTheatreID</h2>";
                    if(isset($_POST['modifyTheatre'])){
                        echo "<form action='admin-display-theatres.php' method='post'>";
                        echo "<p>Theatre ID: &nbsp;
                              <input type='text' name='sameTheatreID' value='$myTheatreID' readonly='readonly' required/></br>
                              </p>";
                        echo "<p>Theatre Number: &nbsp;
                              <input type = 'number' name = 'theatreNum' placeholder='Theatre Number' value='$row[theatreNum]' required/></br>
                              </p>";

                        echo "<p>Complex Name: &nbsp;";
                        $complexQuery = "SELECT complexName FROM complex";
                        $complexResult = mysqli_query($db,$complexQuery);
                        echo "<select name='complex'>";
                        while ($row = mysqli_fetch_array($complexResult)) {
                            echo "<option value='" . $row['complexName'] . "'>" . $row['complexName'] . "</option>";
                        }
                        echo "</select>";

                        echo "<p>Number of Seats: &nbsp;
                              <input type = 'number' name = 'numSeats' placeholder='1' value='$row[numSeats]' required/></br>
                              </p>";

                        echo "<p>Screen Size: &nbsp;
                              <select name='screenSize'>
                                <option value='S'>Small</option>
                                <option value='M'>Medium</option>
                                <option value='L'>Large</option>
                              </select>
                              </p>";
          
                        echo "<button type='submit' class='submitButton'><span>Update Theatre $myTheatreID</span></button>";
                        echo "</form>";
                    }
 				}
                    //header("location: admin-modify-showing.php");
            ?>
            </div>
            </div>
    </body>
</html>