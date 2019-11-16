<?php
	date_default_timezone_set('Asia/Jakarta');
	$date = date("Y-m-d");
	$time = date("H:i:s");
	if (isset($_GET)) {
		include ('config.php');
		$getaran_tanah = $_GET['getaran_tanah'];
		$kelembapan = $_GET['kelembapan'];
		$suhu = $_GET['suhu'];

		//$sql = mysqli_query($conn,"UPDATE data_web SET tanggal='$date', waktu='$time', getaran_tanah='$tanah', gyro='$gyroskop', accelerator='$keseimbangan', suhu='$suhu_sekitar'");
		$sql = mysqli_query($conn, "INSERT INTO data_web values ('','$getaran_tanah','$kelembapan','$suhu','$date','$time')");

		echo " Sukses Mengupdate data secara realtime";
		header("location:index.php");
	} else {
		echo "Gagal Mengupdate Data :(";
	}
?>