<?php

// this will avoid mysql_connect() deprecation error.
error_reporting( ~E_DEPRECATED & ~E_NOTICE );
// but I strongly suggest you to use PDO or MySQLi.

define('DBHOST', 'localhost');
define('DBUSER', 'boiko');
define('DBPASS', 'vesko123');
define('DBNAME', 'dbtest');

$connection = mysql_connect(DBHOST,DBUSER,DBPASS);
$db = mysql_select_db(DBNAME);

if ( !$connection ) {
	die("Connection failed : " . mysql_error());
}

if ( !$db ) {
	die("Database Connection failed : " . mysql_error());
}