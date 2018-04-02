<?php
    include('../session.php');
?>
<html>
	<head>
		<title>Admin - Customer Search | RN Cinemas</title>
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
            ?>
        </ul>
        </div>

        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $accountID = mysqli_real_escape_string($db,$_POST['user']);
                $ticketQuery = "SELECT tickets.ticketID, tickets.showingID, showing.theatreID, showing.startTime, movie.movieTitle
                                FROM tickets INNER JOIN showing ON tickets.showingID=showing.showingID INNER JOIN movie ON showing.movieID=movie.movieID
                                WHERE accountID='$accountID' ORDER BY ticketID";
                $ticketResult = mysqli_query($db,$ticketQuery);
                echo "
                    <div style='margin-top: 100px; margin-bottom: -75px; float:bottom;'>
                    <table align='center' class='buyTicketsMovieList'>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Showing ID</th>
                        <th>Theatre ID</th>
                        <th>Start Time</th>
                        <th>Movie Title</th>
                    </tr>
                    ";
                while ($row = mysqli_fetch_array($ticketResult)) {
                    echo "
                    <tr>
                        <th>$row[ticketID]</th>
                        <th>$row[showingID]</th>
                        <th>$row[theatreID]</th>
                        <th>$row[startTime]</th>
                        <th>$row[movieTitle]</th>
                    </tr>
                    ";
                }
                echo "</table>
                    </div>";
            }    
        ?>

        <div class="formOutside">
        <div class="formInside">
            <h1 class="header" align="center">Customer Search</h1>
            <form action = "" method = "post">
                <h2>Select customer to view past and current tickets bought</h2>
                <p>Customer: &nbsp;
                <?php
                    $userQuery = "SELECT accountID, firstName, lastName FROM users";
                    $userResult = mysqli_query($db,$userQuery);
                    echo "<select name='user'>";
                    while ($row = mysqli_fetch_array($userResult)) {
                        echo "<option value='" . $row['accountID'] . "'>" . "ID #" . $row['accountID'] . " - " . $row['firstName'] . " " . $row['lastName'] . "</option>";
                    }
                    echo "</select>";
                ?>
                </p>
                <button type="submit" class="submitButton"><span>Search</span></button>
            </form>
        </div>
        </div>
    </body>
</html> 
