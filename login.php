<?php
session_start(); // start

$error = ''; // var for error

if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	}
	else {
		// define $username and $password
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		// connectiing with the server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect("localhost", "boiko", "vesko123");
		
		// to protect MySQL injection for security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		
		// selecting database
		$db = mysql_select_db("dbtest", $connection);
		
		// SQL query to fetch information of registerd users and finds user match.
		//$username = "' OR true OR '";
		//$password = md5($password);

		$query = mysql_query("select * from users where userPass='$password' AND userName='$username'", $connection);
		$rows = mysql_num_rows($query);
		if ($rows == 1) {
		
			$_SESSION['login_user']=$username; // starting session
			
			header("location: protected.php"); // redirecting to other page
			exit;
		} 
		else {
			$error = "Username or Password is invalid";
		}
		
		mysql_close($connection); // closing connection
	}
}
?>