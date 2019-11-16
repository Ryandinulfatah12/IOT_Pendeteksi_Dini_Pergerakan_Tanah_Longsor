<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db   = "iot";
	$conn = mysqli_connect($host, $user, $pass, $db);
	
	if(mysqli_connect_error()){
		echo "Koneksi Gagal".mysqli_connect_error();
	}
?>