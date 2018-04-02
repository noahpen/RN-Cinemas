<?php
    include('../session.php');
?>
<html>
	<head>
		<title>Admin - Complex Stats | RN Cinemas</title>
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
        <h1 class="header" align="center" style='margin-bottom:30px;'>Complex Stats</h1>
			<?php
				$complexQuery = "SELECT complex.complexName, COUNT(showing.showingID) AS ticketCount FROM tickets 
							   INNER JOIN showing ON tickets.showingID=showing.showingID INNER JOIN theatre 
							   ON theatre.theatreID=showing.theatreID INNER JOIN complex ON complex.complexID=theatre.complexID 
							   GROUP BY complex.complexName ORDER BY `ticketCount` DESC";
				$complexResult = mysqli_query($db,$complexQuery);
				$topComplexQuery = $complexQuery . " LIMIT 1";
				$topComplexResult = mysqli_query($db,$topComplexQuery);
				$topComplex = mysqli_fetch_assoc($topComplexResult)['complexName']; 
				echo "
                    <div>
                    <table align='center' class='buyTicketsMovieList table'>
                    <tr>
                        <th>Complex</th>
                        <th>Tickets Sold</th>
                    </tr>
                    ";
                while ($row = mysqli_fetch_array($complexResult)) {
                    echo "
                    <tr>
                        <td>$row[complexName]</td>
                        <td>$row[ticketCount]</td>
                    </tr>
                    ";
                }
                echo "</table>
					</div>";
				echo "</br><h3 align='center'>The most popular complex is " . $topComplex;
			?>
        </div>

    
    </body>
</html> 
