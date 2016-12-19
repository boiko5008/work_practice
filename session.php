<?php
	// connection using mysql
	$connection = mysql_connect("localhost", "boiko", "vesko123");
	
	// database
	$db = mysql_select_db("dbtest", $connection);
	session_start();// Starting Session
	
	if (!isset($_SESSION['login_user'])) {
		header('Location: error_log.php'); // redirecting to home page
		exit;
	}

	// Secret info

	// storing session
	$user_check = $_SESSION['login_user'];
	
	// SQL Query To Fetch Complete Information Of The User
	$ses_sql=mysql_query("select userName from users where userName='$user_check'", $connection);
	$row = mysql_fetch_assoc($ses_sql);
	$login_session =$row['username'];
	
	if(!isset($login_session)){
		mysql_close($connection); // closing connection
		header('Location: error_log.php'); // redirecting to home page
	}
?>