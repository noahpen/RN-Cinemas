<?php
   include('config.php');
   session_start();
   
   if(!isset($_SESSION['login_user'])){
	   
   }
   else{
		$user_check = $_SESSION['login_user'];
   
		$ses_sql = mysqli_query($db,"select * from users where username = '$user_check' ");
   
		$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
        $login_session = $row['username'];
        $login_session_id = $row['accountID'];
        $login_session_fname = $row['firstName'];
   }
   //if(!isset($_SESSION['login_user'])){
   //   header("location:login.php");
   //}
?>