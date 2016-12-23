<?php
ob_start();
session_start();

require_once 'dbconnect.php';

if (!isset($_SESSION['login_user'])) {
	header('Location: error_log.php'); // redirecting to home page
	exit;
}

$userId = $_SESSION['login_user'];

// select loggedin users detail
$result = mysql_query("SELECT * FROM users WHERE userId = '$userId'");
$userRow = mysql_fetch_array($result);

if (isset($_POST['submit'])) {
	$balance = intval($_POST['withdraw']);
	$error = false;
	//$balance = mysql_real_escape_string($balance);
	
	if (($userRow['balance'] - $balance) < 0) {
		$error = true;
		$balanceError = "You are out of money!";
	}
	
	if (empty($balance)) {
		$error = true;
		$balanceError = "You did not input a sum.";
	}

	if ($balance < 0) {
		$error = true;
		$balanceError = "You can't enter negative digits!";
	}

	if (!$error) {
		$query = "INSERT INTO transaction (userId, amount, text) VALUES ('$userId', -'$balance', 'Withdraw') ";
		$result = mysql_query($query) or trigger_error(mysql_error()." ".$query);
		$transactionId = mysql_insert_id();
		
		$query = 'UPDATE users SET balance = balance - ' . $balance . ' WHERE userId = ' . $userId;
		$result = mysql_query($query) or trigger_error(mysql_error()." ".$query);
		$userRow['balance'] -= $balance;
	}
}
?>