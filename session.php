<?php
	// connection using mysql
	$connection = mysql_connect("localhost", "boiko", "vesko123");
	
	// database
	$db = mysql_select_db("company", $connection);
	session_start();// Starting Session
	
	// storing session
	$user_check=$_SESSION['login_user'];
	
	// SQL Query To Fetch Complete Information Of The User
	$ses_sql=mysql_query("select username from login where username='$user_check'", $connection);
	$row = mysql_fetch_assoc($ses_sql);
	$login_session =$row['username'];
	
	if(!isset($login_session)){
		mysql_close($connection); // closing connection
		header('Location: error_log.php'); // redirecting to home page
	}
?>