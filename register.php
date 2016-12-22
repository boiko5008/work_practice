<?php
	ob_start();
	session_start();
	
	if( isset($_SESSION['login_user'])!="" ){
		header("Location: protected.php");
	}
	
	include_once 'dbconnect.php';

	$error = false;

	if ( isset($_POST['Submit']) ) {

		// clean user inputs to prevent sql injections
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);

		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);

		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);

		// basic name validation
		if (empty($name)) {
			$error = true;
			$nameError = "Please enter your username.";
		} else if (strlen($name) < 4) {
			$error = true;
			$nameError = "Username must have atleast 4 characters.";
		}

		//basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		} else {
			// check email exist or not
			$query = "SELECT userEmail FROM users WHERE userEmail='$email'";
			$result = mysql_query($query);
			$count = mysql_num_rows($result);
			if($count!=0) {
				$error = true;
				$emailError = "Provided Email is already in use.";
			}
		}
		// password validation
		if (empty($pass)){
			$error = true;
			$passError = "Please enter password.";
		} else if(strlen($pass) < 6) {
			$error = true;
			$passError = "Password must have atleast 6 characters.";
		}

		// password encrypt using md5();
		$password = md5($pass);

		// if there's no error, continue to signup
		if( !$error ) {

			$query = "INSERT INTO users(userName,userEmail,userPass,balance) VALUES('$name','$email','$password',500)";
			$res = mysql_query($query);

			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully registered, you may login now";
				unset($name);
				unset($email);
				unset($pass);
			} else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later..."; 
			}
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="main">
			<h1>PHP Register Test</h1>
			
			<div id="reg_form">
				<h2>Register Form</h2>
				<hr>
				<form id='register' method='post' accept-charset='UTF-8'>
					<label for='name' >Username: </label>
					<input type='text' name='name' id='name' placeholder="Enter Username" maxlength="50"/>
					
					<label for='email' >Email Address:</label>
					<input type='text' name='email' id='email' placeholder="Enter Your Email" maxlength="40"/>

					<label for='password' >Password:</label>
					<input type='password' name='pass' id='password' placeholder="Enter Password" maxlength="15"/>
					<hr>
					<input type='submit' name='Submit' value='Register'/>

					<span>
						<?php
							echo "$nameError\n";
							echo "$emailError\n";
							echo "$passError\n";
							echo $errMSG; 
						?>
					</span>
				</form>
			</div>

			<div id="change">
				<a href="index.php">Sign in Here...</a>
            </div>
		</div>
	</body>
</html>
<?php ob_end_flush(); ?>