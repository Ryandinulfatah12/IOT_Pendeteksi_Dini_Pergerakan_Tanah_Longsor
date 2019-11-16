
<!DOCTYPE html> 
<html> 
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/push.min.js"></script>

	<title>Data Sensor</title>
</head> 
<body>  

<div class="container">
	<h1 class="mt-3">Detail Data dari Sensor</h1><p><b>Data Diambil per-<u>detik</u></b></p>	

	<table class="table">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Getaran Tanah</th>
	      <th scope="col">Kelembaban Tanah</th>
	      <th scope="col">Suhu</th>
	      <th scope="col">Tanggal</th>
	      <th scope="col">Waktu</th>
	    </tr>
	    <?php
			date_default_timezone_set('Asia/Jakarta');
			$date = date("Y-m-d");
			$time = date("H:i:s");
			include('config.php');

			$no=1;
			$sql=mysqli_query($conn,"SELECT * FROM data_web ORDER BY id DESC LIMIT 10");   
			while ($data=mysqli_fetch_assoc($sql)){  
			?>
	  </thead>
	  <tbody>
	    <tr>
	      <th scope="row"><?php echo $no++; ?></th>
	      <td><?php echo $data['getaran_tanah']; ?></td>
	      <td><?php echo $data['kelembapan']; ?></td>
	      <td><?php echo $data['suhu']; ?> C</td>
	      <td><?php echo $date ?></td>
	      <td><?php echo $data['waktu']; ?></td>
	    </tr>
	    <?php   
		}   
		?>
	  </tbody>
	</table>
</div>

</body> 
</html>