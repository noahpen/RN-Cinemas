<?php
    include('../session.php');
?>
<html>
	<head>
		<title>Admin - Members | RN Cinemas</title>
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
                    
                $userQuery = "SELECT * FROM users";
                $userResult = mysqli_query($db,$userQuery);
                

                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $myuser = mysqli_real_escape_string($db,$_POST['accountID']);
                    
                    if(isset($_POST['deleteUser'])){
                        $userReviewQuery = "DELETE FROM review WHERE accountID = '$myuser'";
                        $userQuery = "DELETE FROM users WHERE accountID = '$myuser'";
                        mysqli_query($db,$userReviewQuery);
                        mysqli_query($db,$userQuery);
                    }
                    elseif(isset($_POST['toggleAdmin'])){
                        $adminUserQuery = "SELECT adminFlag FROM users WHERE accountID = '$myuser'";
					    $adminUserResult = mysqli_query($db,$adminUserQuery);
					    $adminUserRow = mysqli_fetch_assoc($adminUserResult);

                        if($adminUserRow['adminFlag'] == 1){
                            $userQuery = "UPDATE users SET adminFlag = '0' WHERE accountID = $myuser";
                            mysqli_query($db,$userQuery);
                        }
                        else{
                            $userQuery = "UPDATE users SET adminFlag = '1' WHERE accountID = $myuser";
                            mysqli_query($db,$userQuery);
                        }
                    }
                    header("location: admin-list-members.php");

                }
				
			?>
        </ul>
        </div>
            <div style="padding:20px;margin-top:30px;height:1500px;">
            <form method="post">
            <button type='submit' name='deleteUser'>Delete</button>
                <button type='submit' name='toggleAdmin'>Toggle Admin</button>
		        <table align="center" class="buyTicketsMovieList">
                    <tr>
                        <th>AccountID</th>
                        <th>Username</th>
                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>StreetNum</th>
                        <th>StreetName</th>
                        <th>City</th>
                        <th>Province</th>
                        <th>PostalCode</th>
                        <th>Email</th>
                        <th>AdminFlag</th>
                    </tr>
                    <?php
                    while($userRow = mysqli_fetch_assoc($userResult)){
                    echo "
                    <tr>
                        <td>$userRow[accountID]</td>
                        <td>$userRow[username]</td>
                        <td>$userRow[firstName]</td>
                        <td>$userRow[lastName]</td>
                        <td>$userRow[streetNum]</td>
                        <td>$userRow[streetName]</td>
                        <td>$userRow[city]</td>
                        <td>$userRow[province]</td>
                        <td>$userRow[postalCode]</td>
                        <td>$userRow[email]</td>
                        <td>$userRow[adminFlag]</td>
                        <td><input type='radio' name='accountID' value='$userRow[accountID]' />
                    </tr>
                    ";
                    }
                    ?>
                </table>
            </form>
            </div>
    </body>
</html>