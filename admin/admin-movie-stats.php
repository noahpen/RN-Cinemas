<?php
    include('../session.php');
?>
<html>
	<head>
		<title>Admin - Movie Stats | RN Cinemas</title>
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

        <div style="padding:20px;margin-top:30px;height:1500px;">
        	<h1 class="header" align="center" style='margin-bottom:30px;'>Movie Stats</h1>
			<?php
				$movieQuery = "SELECT movie.movieTitle, COUNT(tickets.showingID) AS ticketCount FROM tickets INNER JOIN showing ON tickets.showingID=showing.showingID
							   INNER JOIN movie ON showing.movieID=movie.movieID GROUP BY movie.movieTitle
							   ORDER BY `ticketCount` DESC";
				$movieResult = mysqli_query($db,$movieQuery);
				$topMovieQuery = $movieQuery . " LIMIT 1";
				$topMovieResult = mysqli_query($db,$topMovieQuery);
				$topMovie = mysqli_fetch_assoc($topMovieResult)['movieTitle']; 
				echo "
                    <div>
                    <table align='center' class='buyTicketsMovieList'>
                    <tr>
                        <th>Movie Title</th>
                        <th>Tickets Sold</th>
                    </tr>
                    ";
                while ($row = mysqli_fetch_array($movieResult)) {
                    echo "
                    <tr>
                        <th>$row[movieTitle]</th>
                        <th>$row[ticketCount]</th>
                    </tr>
                    ";
                }
                echo "</table>
					</div>";
				echo "</br><h3 align='center'>The most popular movie is " . $topMovie;
			?>
        </div>
    </body>
</html> 
