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
            <?php
            if(isset($_GET['complexID']) && !empty($_GET['complexID'])){
                $showingQuery = "SELECT * FROM showing INNER JOIN theatre ON showing.theatreID=theatre.theatreID AND showing.movieID=$getMovieID AND theatre.complexID=$getComplexID";
                $showingResult = mysqli_query($db,$showingQuery);
                while($showingRow = mysqli_fetch_assoc($showingResult)){
                    echo "
                    <tr>
                        <td>$showingRow[startTime]<td>
                        <td>$showingRow[theatreNum]<td>
                        <td>$showingRow[numSeats]<td>
                        <input type='number' name='numTickets'>
                        <input type='button' value='Buy'>
                    <tr>
                    ";
                }
            }
            ?>

        </table>

      </div>
   </body>
</html>