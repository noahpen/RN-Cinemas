<?php
include('../session.php');

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

$movieQuery = "INSERT INTO movie (movieID, movieTitle, runningTime, rating, plot, actors, director, productionCompany, supplierID, startDate, endDate) VALUES ('$maxMovieID', '$mytitle', '$myrunningtime', '$myrating', '$myplot', '$myactors', '$mydirector', '$myprodcompany', '$maxSupplierID', '$mystartdate', '$myenddate')";
mysqli_query($db,$movieQuery);

// UPLOAD FILE START
$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../images/$maxMovieID.jpg")) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
header("location: ../index.php");
?>