<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/jquery-latest.js"></script>
	<script language = "javascript">
			$(document).ready(function() {
				$(document).ready(function() {
					$("#konten1").load("query2.php");
					var refreshId = setInterval(function() {
					$("#konten1").load('query2.php');
					}, 1000);
					$.ajaxSetup({ cache: false });
				});
			});	
	</script>
</head>
<body>
	<center>
		<div id="konten1"></div>
	</center>
</body>
</html>