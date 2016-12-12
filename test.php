<?php

// Setup database connection to mysql
$username = "boiko";
$password = "vesko123";
$hostname = "localhost";

$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");

echo "Connected to MySQL<br>";

// Fetch some rows from the sample database/tables
$selected = mysql_select_db("demo",$dbhandle) or die("Could not select demo");

// Print the rows
$result = mysql_query("SELECT id, name, email FROM testers");
while ($row = mysql_fetch_array($result)) {
	echo "ID:".$row{'id'}."  Name:".$row{'name'}."  E-mail:".$row{'email'}."<br>";
}

$result = mysql_query("SELECT id, name, email FROM developers");
while ($row = mysql_fetch_array($result)) {
        echo "ID:".$row{'id'}." Name:".$row{'name'}."  E-mail:".$row{'email'}."<br>";
}


mysql_close($dbhandle);

// echo 'hello!';
?>
