<?php
session_start();

if(session_destroy()) // destroy all sessions
{
	header("Location: index.php"); // redirection to home
}
?> 