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
			<h1>PHP Account Test</h1>
			
			<div id="login">
				<h2>Login Form</h2>
				<hr>
				<form action="" method="post">
					<label>UserName :</label>
					<input id="name" name="username" placeholder="username" type="text">
					
					<label>Password :</label>
					<input id="password" name="password" placeholder="**********" type="password">
					<hr>
					<input name="submit" type="submit" value=" Login ">
					
					<span><?php echo $error; ?></span>
				</form>
			</div>
			
			<div class="form-group">
				<a href="register.php">Sign up Here...</a>
            </div>
		</div>
	</body>
</html>