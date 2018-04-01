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
			<li><a href="index.php">Home</a></li>
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
                    
                $userQuery = "SELECT * FROM users";
                $userResult = mysqli_query($db,$userQuery);
                
				
			?>
        </ul>
        </div>
            <div style="padding:20px;margin-top:30px;height:1500px;">
            

            
            </div>
    </body>
</html>