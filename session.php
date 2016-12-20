<?php
ob_start();
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['login_user'])) {
	header('Location: error_log.php'); // redirecting to home page
	exit;
}

// select loggedin users detail
$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['login_user']);
$userRow=mysql_fetch_array($res);

if (isset($_POST['submit'])) {
	$withdraw = $_POST['withdraw'];
	
	$query = mysql_query(
	"UPDATE users 
	 SET balance = balance - '$withdraw'
	 WHERE userName = '$user_check'", $connection);
}


?>