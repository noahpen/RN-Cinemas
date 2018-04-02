<?php
    include('session.php');
?>
<html>
	<head>
		<title>Admin | RN Cinemas</title>
		<link rel='stylesheet' type='text/css' href='assets/css/main.css' />
		<script src="assets/js/imagesClickJS.js"></script>
	</head>
	<body>
		<div class="navBar">
		<ul>
			<li><a href="index.php">Home</a></li>
            <?php 
				if(!isset($_SESSION['login_user'])){
					echo "<li style='float:right'><a href = 'login.php'>Login</a></li>";
					echo "<li style='float:right'><a href = 'sign-up.php'>Sign Up</a></li>";
					header("location: index.php");
					}
					else{
					$adminFlagQuery = "SELECT adminFlag FROM users WHERE username = '$login_session'";
					$adminFlagResult = mysqli_query($db,$adminFlagQuery);
					$row = mysqli_fetch_assoc($adminFlagResult);
					echo "<li style='float:right'><a href = 'logout.php'>Sign Out</a></li>";
					echo "<li style='float:right'><a href = 'account.php'>$login_session</a></li>";
					if($row['adminFlag'] == 1){
					echo "<li style='float:right'><a class='active' href = 'admin.php'>Admin</a></li>";
                    }
                    else{
                        header("location: index.php");
                    }
					}
			?>
        </ul>
        </div>
            <div style="padding:20px;margin-top:30px;height:1500px;">
				<div class="userOptions">
            		<button type="button" onclick="location.href='admin/admin-list-members.php';" name="listbtn">List Members</button>
            		<button type="button" onclick="location.href='admin/admin-add-movie.php';"name="addmoviebtn">Add Movie</button>
					<button type="button" onclick="location.href='admin/admin-add-complex.php';"name="addcomplexbtn">Add Complex</button>
					<button type="button" onclick="location.href='admin/admin-display-complexes.php';"name="modcomplexbtn">Modify Complex</button>
					<button type="button" onclick="location.href='admin/admin-add-theatre.php';"name="addtheatrebtn">Add Theatre</button>
					<button type="button" onclick="location.href='admin/admin-modify-theatre.php';"name="modtheatrebtn">Modify Theatre</button>
            		<button type="button" onclick="location.href='admin/admin-add-showing.php';"name="addshowingbtn">Add Showing</button>
					<button type="button" onclick="location.href='admin/admin-display-showings.php';"name="displayshowingsbtn">Modify Showing</button>
					<button type="button" onclick="location.href='admin/admin-customer-search.php';"name="customersearchbtn">Customer Search</button>
					<button type="button" onclick="location.href='admin/admin-movie-stats.php';"name="moviestatsbtn">Movie Stats</button>
					<button type="button" onclick="location.href='admin/admin-complex-stats.php';"name="complexstatsbtn">Complex Stats</button>
        		</div>
            </div>
    </body>
</html>