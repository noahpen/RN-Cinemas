<?php
    include('../session.php');
?>
<html>
	<head>
		<title>Admin - Add Movie | RN Cinemas</title>
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
                    /*
                    if($_SERVER["REQUEST_METHOD"] == "POST") {
                        //$file = $_FILES['moviePicture']['tmp_name'];

                        //$target_dir = "uploads/";
                        //$target_file = $target_dir . basename($_FILES["moviePicture"]["name"]);

                        //if (move_uploaded_file($_FILES["moviePicture"]["tmp_name"], $target_file)) {
                        //    echo "The file ". basename( $_FILES["moviePicture"]["name"]). " has been uploaded.";
                        //} else {
                        //    echo "Sorry, there was an error uploading your file.";
                        //}

                        // MOVIE TABLE
                        $mytitle = mysqli_real_escape_string($db,$_POST['movieTitle']);
                        $myrunningtime = mysqli_real_escape_string($db,$_POST['runningTime']);
                        $myrating = mysqli_real_escape_string($db,$_POST['rating']);
                        $myplot = mysqli_real_escape_string($db,$_POST['moviePlot']);
                        $myactors = mysqli_real_escape_string($db,$_POST['actors']);
                        $mydirector = mysqli_real_escape_string($db,$_POST['director']);
                        $myprodcompany = mysqli_real_escape_string($db,$_POST['productionCompany']);
                        $mystartdate = mysqli_real_escape_string($db,$_POST['startDate']);
                        $myenddate = mysqli_real_escape_string($db,$_POST['endDate']);

                        // PRODUCER TABLE
                        $mysuppliername = mysqli_real_escape_string($db,$_POST['supplierName']);
                        $mysupplierstreetnum = mysqli_real_escape_string($db,$_POST['supplierStreetNum']);
                        $mysupplierstreetname = mysqli_real_escape_string($db,$_POST['supplierStreetName']);
                        $mysuppliercity = mysqli_real_escape_string($db,$_POST['supplierCity']);
                        $mysupplierprovince = mysqli_real_escape_string($db,$_POST['supplierProvince']);
                        $mysupplierpostalcode = mysqli_real_escape_string($db,$_POST['supplierPostalCode']);
                        $mycontactname = mysqli_real_escape_string($db,$_POST['supplierContactName']);
                        $mySupplierNumber = mysqli_real_escape_string($db,$_POST['supplierNumber']);
                        
                        // GET MAX
                        $maxMovieResult = mysqli_query($db, "SELECT MAX(movieID) AS max FROM `movie`" );
					    $maxMovieRow = mysqli_fetch_assoc($maxMovieResult);
                        $maxMovieID = $maxMovieRow['max'] + 1;
                        
                        $maxSupplierResult = mysqli_query($db, "SELECT MAX(supplierID) AS max FROM `supplier`" );
					    $maxSupplierRow = mysqli_fetch_assoc($maxSupplierResult);
                        $maxSupplierID = $maxSupplierRow['max'] + 1;

                        // Adding
                        $supplierQuery = "INSERT INTO supplier (supplierID, supplierName, streetNum, streetName, city, province, postalCode, contactName) VALUES ('$maxSupplierID', '$mysuppliername', '$mysupplierstreetnum', '$mysupplierstreetname', '$mysuppliercity', '$mysupplierprovince', '$mysupplierpostalcode', '$mysuppliername')";
                        mysqli_query($db,$supplierQuery);
                        $supplierPhoneQuery = "INSERT INTO supplierphonenum (supplierID, phoneNum) VALUE ('$maxSupplierID', '$mySupplierNumber')";
                        mysqli_query($db,$supplierPhoneQuery);

                        $movieQuery = "INSERT INTO movie (movieID, movieTitle, runningTime, rating, plot, actors, director, productionCompany, supplierID, startDate, endDate) VALUES ('$maxMovieID', '$mytitle', '$myrunningtime', '$myrating', '$myplot', '$myactors', '$mydirector', '$myprodcompany', '$maxSupplierID', $mystartdate, $myenddate)";
                        mysqli_query($db,$movieQuery);
                    }*/
                
				
			?>
        </ul>
        </div>
            <div style="padding:20px;margin-top:30px;height:1500px;">
            <h1 class="header" align="center">Add New Movie</h1>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <h2>Movie Info</h2>
                    <input type = "text" name = "movieTitle" placeholder="Movie Title"/><br>
                    <input type = "number" name = "runningTime" placeholder="Running Time (minutes)"/><br>
                    <input type = "text" name = "rating" placeholder="Rating (G/PG/R)"/><br>
                    <textarea id='reviewBox' type='text' name='moviePlot' placeholder='Movie Plot'></textarea><br>
                    <textarea id='reviewBox' type='text' name='actors' placeholder='Actors'></textarea><br>
                    <input type = "text" name = "director" placeholder="Director"/><br>
                    <input type = "text" name = "productionCompany" placeholder="Production Company"/><br>
                    <p>Start Date:</p>
                    <input type = "date" name = "startDate"/><br>
                    <p>End Date:</p>
                    <input type = "date" name = "endDate"/><br><br>
                    <p>Movie Cover</p>
                    <input type="file" name="fileToUpload" id="fileToUpload"><br><br>

                    <h2>Supplier Info</h2>
                    <input type = "text" name = "supplierName" placeholder="Supplier Name"/><br>
                    <input type = "text" name = "supplierStreetNum" placeholder="Street Number"/><br>
                    <input type = "text" name = "supplierStreetName" placeholder="Street Name"/><br>
                    <input type = "text" name = "supplierCity" placeholder="City"/><br>
                    <input type = "text" name = "supplierProvince" placeholder="Province"/><br>
                    <input type = "text" name = "supplierPostalCode" placeholder="Postal Code"/><br>
                    <input type = "text" name = "supplierContactName" placeholder="Contact Name"/><br>
                    <input type = "text" name = "supplierNumber" placeholder="Phone Number"/><br>
                    <br>
                    <input type="submit">
                </form>
            </div>
    </body>
</html>