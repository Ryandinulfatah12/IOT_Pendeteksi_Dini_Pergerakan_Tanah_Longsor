
<?php
  include('config.php');
  date_default_timezone_set('Asia/Jakarta');
  $date = date("Y-m-d");
  $time = date("H:i:s");  
  $sql = mysqli_query($conn, "SELECT * FROM data_web ORDER BY id DESC");
  $data = mysqli_fetch_assoc($sql);
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/push.min.js"></script>

    <title>IoT</title>
  </head>
  <body>
  <section class="home" id="home">
    <div class="jumbotron text-center">
      <h1>Pendeteksi Dini Getaran Tanah Longsor</h1>
      <p>IoT NodeMCU Project SMK Negeri 1 Padaherang</p>
    </div>
  </section>
  <br>
  <div class="data">
    <h3>Pengiriman Data Terakhir : </h3>
       <h3>Tanggal : <?php echo $date ?></h3>
       <h3>Waktu : <?php echo $data['waktu']; ?></h3>
       <h3>Getaran Tanah : <?php echo $data['getaran_tanah']; ?></h3>
       <h3>Kelembaban Tanah : <?php echo $data['kelembapan']; ?> RH</h3>
       <h3>Suhu Sekitar : <?php echo $data['suhu']; ?> C</h3>
       <br>
       <br>
       <button class="btn btn-primary"><a href="data_sensor.php" style="color: white;">Lihat Detail</a></button>
    </body>
  </div> 
<script>
  Push.create("Siaga Longsor!", {
    body: "Terdapat getaran pada tanah!!!",
    icon: 'icon.png',
    timeout: 1000, 
    onClick: function () {
        window.focus();
        this.close();
    }});

</script> 
<br>
  <!--footer-->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col">
            <p align="center">&copy; Copyright 2019 | PKL STMIK AKAKOM Padaherang</p>
          </div>
        </div>
      </div>
    </footer>
  <!--akhir footer-->

  </body>
</html>