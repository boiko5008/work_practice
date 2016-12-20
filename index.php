<?php
	include('login.php'); 
	
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
					<label>Email :</label>
					<input type="text" name="email" placeholder="Enter Your Email">

					<label>Password :</label>
					<input id="password" name="pass" placeholder="**********" type="password">
					<hr>
					<input name="submit" type="submit" value=" Login ">
					
					<span>
						<?php 
							echo "$emailError\n";
							echo "$passError\n";
							echo "$errMSG\n";
						?>
					</span>
				</form>
			</div>
			
			<div id="change">
				<a href="register.php">Sign up Here...</a>
            </div>
		</div>
	</body>
</html>