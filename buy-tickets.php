<?php
   include('session.php');
   ?>
<html>
   <head>
      <title>RN Cinemas</title>
      <link rel='stylesheet' type='text/css' href='assets/css/main.css' />
      <script src="assets/js/imagesClickJS.js"></script>
   </head>
   <body>
      <div class="navBar">
         <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="movies.php">Movies</a></li>
            <?php 
               $getMovieID = $_GET['movieID'];
               if(isset($_GET['complexID']) && !empty($_GET['complexID'])){
                $getComplexID = $_GET['complexID'];
               }

                $movieQuery = "SELECT * FROM movie WHERE movieID = '$getMovieID'";
				$movieResult = mysqli_query($db,$movieQuery);
                $movieRow = mysqli_fetch_assoc($movieResult);
               
               if(!isset($_SESSION['login_user'])){
               echo "<li style='float:right'><a href = 'login.php'>Login</a></li>";
               echo "<li style='float:right'><a href = 'sign-up.php'>Sign Up</a></li>";
               }
               else{
               $adminFlagQuery = "SELECT adminFlag FROM users WHERE username = '$login_session'";
               $adminFlagResult = mysqli_query($db,$adminFlagQuery);
               $row = mysqli_fetch_assoc($adminFlagResult);
               echo "<li style='float:right'><a href = 'logout.php'>Sign Out</a></li>";
               echo "<li style='float:right'><a href = 'account.php'>$login_session</a></li>";
               if($row['adminFlag'] == 1){
               echo "<li style='float:right'><a href = 'admin.php'>Admin</a></li>";
               }
               }
               
               $ticketsBought = false;

               if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $myshowing = mysqli_real_escape_string($db,$_POST['showingID']);
                    $mynumtickets = mysqli_real_escape_string($db,$_POST['numTickets']); 
                    
                    for ($x = 1; $x <= $mynumtickets; $x++){
                        $maxticketIDresult = mysqli_query($db, "SELECT MAX(ticketID) AS max FROM `tickets`" );
                        $maxticketIDrow = mysqli_fetch_assoc($maxticketIDresult);
                        $maxticketID = $maxticketIDrow['max'] + 1;
                        

                        $ticketQuery = "INSERT INTO tickets (ticketID, accountID, seatNum, showingID) VALUES ('$maxticketID', '$login_session_id', 'NULL', '$myshowing')";
                        mysqli_query($db,$ticketQuery);
                    }

                    $ticketsBought = true;
                }
               ?>
         </ul>
      </div>
      <div style="padding:20px;margin-top:30px;height:1500px;">
      <?php echo "<h2>Buying tickets for $movieRow[movieTitle]</h2>"; ?>

         <div class="dropdown">
         <?php
         echo "<form action='buy-tickets.php'>";
            echo "<select name='complexID'>";
               $complexDropdownQuery = "SELECT complexID, complexName FROM complex";
               $complexDropdownResult = mysqli_query($db,$complexDropdownQuery);
               while($complexDropdownRow = mysqli_fetch_assoc($complexDropdownResult)){
                   echo "<option value='$complexDropdownRow[complexID]'>$complexDropdownRow[complexName]</option>";
               }
               echo"</select>";
               echo "<select name='movieID'>";
               echo "<option value='$getMovieID'>$movieRow[movieTitle]</option>";
               echo "</select>";
               ?>
                <input type="submit">
                </form>
         </div>
        <table align="center" class="buyTicketsMovieList">
            <tr>
                <th>Show Time<th>
                <th>Theatre Number<th>
                <th>Avaliable Seats<th>
            <tr>
            <form method="post">
            <?php
            if(isset($_GET['complexID']) && !empty($_GET['complexID'])){
                $showingQuery = "SELECT * FROM showing INNER JOIN theatre ON showing.theatreID=theatre.theatreID AND showing.movieID=$getMovieID AND theatre.complexID=$getComplexID";
                $showingResult = mysqli_query($db,$showingQuery);



                while($showingRow = mysqli_fetch_assoc($showingResult)){
                    if ($showingRow['startTime'] > $current_datetime){
                        $showingTotalSeats = "SELECT showingID, COUNT(showingID) AS ticketsBought FROM tickets WHERE showingID = $showingRow[showingID] GROUP BY showingID";
                        $showingTotalResult = mysqli_query($db,$showingTotalSeats);
                        $showingTotalRow = mysqli_fetch_assoc($showingTotalResult);

                        $avaliableSeats = $showingRow['numSeats'] - $showingTotalRow['ticketsBought'];
                        if ($avaliableSeats > 0){
                            echo "
                            <tr>
                                <td>$showingRow[startTime]<td>
                                <td>$showingRow[theatreNum]<td>
                                <td>$avaliableSeats<td>
                                <td><input type='radio' name='showingID' value='$showingRow[showingID]' />
                            <tr>
                            ";
                        }
                        else{
                            echo "
                            <tr>
                                <td>$showingRow[startTime]<td>
                                <td>$showingRow[theatreNum]<td>
                                <td>$avaliableSeats<td>
                            <tr>
                            ";
                        }
                    }
                }
            }
            ?>
        </table>

            <input type='number' placeholder='Number of Tickets' min='1' name='numTickets'>
            <button type='submit'>Buy</button>
            </form>

        <?php
            if ($ticketsBought){
                echo "<br><br>You have bought $mynumtickets tickets for $movieRow[movieTitle]";

            }
        ?>

      </div>
   </body>
</html>