<?php
ob_start();
session_start(); // start
require_once 'dbconnect.php';

 // it will never let you open index(login) page if session is set
if ( isset($_SESSION['login_user'])!="" ) {
	header("Location: protected.php");
	exit;
}
 
$error = false;

if (isset($_POST['submit'])) {
	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);

	$pass = trim($_POST['pass']);
	$pass = strip_tags($pass);
	$pass = htmlspecialchars($pass);
	// prevent sql injections / clear user invalid inputs

	if(empty($email)){
		$error = true;
		$emailError = "Please enter your email address.";
	} 
	else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
		$error = true;
		$emailError = "Please enter valid email address.";
	}
	  
	if(empty($pass)){
		$error = true;
		$passError = "Please enter your password.";
	}
		//pass hash
	if (!$error) {
		$password = md5($pass);

		$res=mysql_query("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
		$row=mysql_fetch_array($res);
		$count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row

		if( $count == 1 && $row['userPass']==$password ) {
			$_SESSION['login_user'] = $row['userId'];
			header("Location: protected.php");
		} 
		else {
			$errMSG = "Incorrect Credentials, Try again...";
		}
	}
}
?>