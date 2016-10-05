<?php
session_start();
$type=$_SESSION["user"];
if(session_destroy()) // Destroying All Sessions
{
	header("Location: index.php"); // Redirecting To Home Page	
}
?>