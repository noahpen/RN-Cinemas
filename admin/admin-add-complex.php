<?php
    include('../session.php');
?>
<html>
	<head>
		<title>Admin - Add Complex | RN Cinemas</title>
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

                        $name = mysqli_real_escape_string($db,$_POST['complexName']);
                        $numTheatres = mysqli_real_escape_string($db,$_POST['numTheatres']);
                        $streetNum = mysqli_real_escape_string($db,$_POST['streetNum']);
                        $streetName = mysqli_real_escape_string($db,$_POST['streetName']);
                        $city = mysqli_real_escape_string($db,$_POST['city']);
                        $province = mysqli_real_escape_string($db,$_POST['province']);
                        $postal = mysqli_real_escape_string($db,$_POST['postalCode']);
                        
                        // GET MAX
                        $maxComplexResult = mysqli_query($db, "SELECT MAX(complexID) AS max FROM `complex`" );
					    $maxComplexRow = mysqli_fetch_assoc($maxComplexResult);
                        $maxComplexID = $maxComplexRow['max'] + 1;

                        $complexQuery = "INSERT INTO complex (complexID, numTheatres, complexName, streetNum, streetName, city, province, postalCode) VALUES ('$maxComplexID', '$numTheatres', '$name', '$streetNum', '$streetName', '$city', '$province', '$postal')";
                        $result = mysqli_query($db,$complexQuery);

                        if($result) {
                            $success = true;
                        }
                    }
                
				
			?>
        </ul>
        </div>
            <div style="padding:20px;margin-top:30px;height:1500px;">
            <h1 class="header" align="center">Add New Complex</h1>
                <form action = "" method = "post">
                    <h2>Complex Info</h2>
                    
                    <p>Complex Name: &nbsp;
                    <input type = "text" name = "complexName" placeholder="Complex"/><br>
                    </p>

                    <p>Number of Theatres: &nbsp;
                    <input type = "number" name = "numTheatres" placeholder="Num Theatres"/><br>
                    </p>

                    <h2>Address Info</h2>

                    <p>Street Number: &nbsp;
                    <input type = "number" name = "streetNum" placeholder="Street Num"/><br>
                    </p>

                    <p>Street Name: &nbsp;
                    <input type = "text" name = "streetName" placeholder="Street Name"/><br>
                    </p>

                    <p>City: &nbsp;
                    <input type = "text" name = "city" placeholder="City"/><br>
                    </p>

                    <p>Province: &nbsp;
                    <input type = "text" name = "province" placeholder="Province"/><br>
                    </p>

                    <p>Postal Code: &nbsp;
                    <input type = "text" name = "postalCode" placeholder="Postal Code"/><br>
                    </p>
                    <input type="submit">
                </form>
                <?php
                    if ($success) {
                        echo "</br>Complex $name created successfully!";
                    }
                ?>
            </div>
    </body>
</html>