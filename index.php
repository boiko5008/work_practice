<?php
	include('login.php'); 
	
	if(isset($_SESSION['login_user'])) {
	header("location: protected.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP Login</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="main">
			<h1>PHP Login Test</h1>
			<div id="login">
				<h2>Login Form</h2>
				<hr>
				<form action="" method="post">
					<label><strong>UserName :</strong></label>
					<input id="name" name="username" placeholder="username" type="text">
					
					<label><strong>Password :</strong></label>
					<input id="password" name="password" placeholder="**********" type="password">
					<hr>
					<input name="submit" type="submit" value=" Login ">
					
					<span><?php echo $error; ?></span>
				</form>
			</div>
		</div>
	</body>
</html>