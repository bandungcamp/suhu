<?php
	include("koneksi.php");
	$temp	= $_GET["temp"];
	$query	= "INSERT INTO templog (suhu, waktu) VALUES ('$temp',now())"; 
   	mysql_query($query);
?>
