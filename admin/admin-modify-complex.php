<?php
    include('../session.php');
?>
<html>
	<head>
		<title>Admin - Modify Complex | RN Cinemas</title>
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
                    $myComplexID = mysqli_real_escape_string($db,$_POST['complexID']);
                    $sql = "SELECT * FROM complex WHERE complexID=$myComplexID";
                    $result = mysqli_query($db,$sql);
                    $row = mysqli_fetch_assoc($result);
                    echo "<h1 class='header' align='center'>Modify Complex $myComplexID</h1>";
                    if(isset($_POST['modifyComplex'])){
                        echo "<form action='admin-display-complexes.php' method='post'>";
                        echo "<p>Complex ID: &nbsp;
                              <input type='text' name='sameComplexID' value='$myComplexID' readonly='readonly' required/></br>
                              </p>";
                        echo "<p>Complex Name: &nbsp;
                              <input type = 'text' name = 'complexName' placeholder='Complex Name' value='$row[complexName]' size='40' required/></br>
                              </p>";

                        echo "<p>Number of Theatres: &nbsp;";
                        $numTheatreQuery = "SELECT numTheatres FROM complex";
                        $numTheatreResult = mysqli_query($db,$numTheatreQuery);
                        echo "<input type='number' name='numTheatres' placeholder='0' value='$row[numTheatres]' required/></br>";

                        echo "<p>Street Number: &nbsp;
                              <input type = 'number' name = 'streetNum' placeholder='0' value='$row[streetNum]' required/></br>
                              </p>";

                        echo "<p>Street Name: &nbsp;
                              <input type = 'text' name = 'streetName' placeholder='Street Name' value='$row[streetName]' size='25' required/></br>
                              </p>";
          
                        echo "<p>City: &nbsp;
                              <input type = 'text' name = 'city' placeholder='City' value='$row[city]' required/></br>
                              </p>";

                        echo "<p>Province: &nbsp;
                              <input type = 'text' name = 'province' placeholder='Province' value='$row[province]' required/></br>
                              </p>";

                        echo "<p>Postal Code: &nbsp;
                              <input type = 'text' name = 'postalCode' placeholder='Postal Code' value='$row[postalCode]' required/></br>
                              </p>";

                        echo "<button type='submit' class='submitButton'><span>Update Complex $myComplexID</span></button>";
                        echo "</form>";
                    }
 				}
                    //header("location: admin-modify-showing.php");
            ?>
            </div>
            </div>
    </body>
</html>