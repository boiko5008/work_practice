<?php
	include('session.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Your Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="protected">
			<b id="welcome">Welcome - <?php echo $userRow['userName']; ?></i></b>
			<b id="logout"><a href="logout.php">Log Out</a></b>
		</div>
		
		<div>
			<form>
				<label>Enter desired balance:</label>
				<input type="text" name="withdraw">

				<input type="submit" name="submit" value="Withdraw">
			</form>
		</div>

		<?php
			echo "You are logged in!";
		?>
	</body>
</html>