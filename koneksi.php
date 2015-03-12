<?php
$server 	= "localhost";
$username 	= "username";
$password 	= "password";
$database 	= "database";
$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);
?>
