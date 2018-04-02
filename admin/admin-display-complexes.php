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
                    
                $complexQuery = "SELECT * FROM complex";
                $complexResult = mysqli_query($db,$complexQuery);

                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $sameComplexID = mysqli_real_escape_string($db,$_POST['sameComplexID']);
                    $newComplexName = mysqli_real_escape_string($db,$_POST['complexName']);
                    $newNumTheatres = mysqli_real_escape_string($db,$_POST['numTheatres']);
                    $newStreetNum = mysqli_real_escape_string($db,$_POST['streetNum']);
                    $newStreetName = mysqli_real_escape_string($db,$_POST['streetName']);
                    $newCity = mysqli_real_escape_string($db,$_POST['city']);
                    $newProvince = mysqli_real_escape_string($db,$_POST['province']);
                    $newPostalCode = mysqli_real_escape_string($db,$_POST['postalCode']);
                     
                    $modifiedComplexQuery = "UPDATE complex 
                                             SET complexID='$sameComplexID', numTheatres='$newNumTheatres', complexName='$newComplexName', 
                                             streetNum='$newStreetNum', streetName='$newStreetName', city='$newCity', province='$newProvince',
                                             postalCode='$newPostalCode'
                                             WHERE complexID='$sameComplexID'";
                    mysqli_query($db,$modifiedComplexQuery);

                    header("Refresh:0");
                }
			?>
        </ul>
        </div>
			<h1 class="header" align="center" style="margin-top:100px;">Modify Complex</h1>
            <div style="padding:20px;height:1500px;">
            <form method="post" action="admin-modify-complex.php">
		        <table align="center" class="buyTicketsMovieList">
                    <tr>
                        <th>Complex ID</th>
                        <th>Complex Name</th>
                        <th>Number of Theatres</th>
                        <th>Street Num</th>
                        <th>Street Name</th>
                        <th>City</th>
                        <th>Province</th>
                        <th>Postal Code</th>
                    </tr>
                    <?php
                    while($userRow = mysqli_fetch_assoc($complexResult)){
                    echo "
                    <tr>
                        <td>$userRow[complexID]</td>
                        <td>$userRow[complexName]</td>
                        <td>$userRow[numTheatres]</td>
                        <td>$userRow[streetNum]</td>
                        <td>$userRow[streetName]</td>
                        <td>$userRow[city]</td>
                        <td>$userRow[province]</td>
                        <td>$userRow[postalCode]</td>
                        <td><input type='radio' name='complexID' value='$userRow[complexID]' /></td>
                    </tr>
                    ";
                    }
                    ?>
                </table>
				<div align="center" style="margin-top:20px;">
					<button type='submit' name='modifyComplex' class='submitButton'><span>Modify</span></button>
				</div>
            </form>
            </div>
    </body>
</html>