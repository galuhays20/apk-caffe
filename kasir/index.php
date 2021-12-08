<?php
	session_start();
	if (empty($_SESSION['id_karyawan'])) {
		header("location:login.php");
	}
	include 'lib/koneksi.php';
	$hal = isset($_GET['hal'])?$_GET['hal']:"";  
?>
<!DOCTYPE html>
<html>
<head>
	<title>RPL Cafe</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.min.css">
</head>
<body>
	<!-- <i class="fas fa-home"></i>
	<span class="fas fa-home"></span> -->
	<div class="wrapper">
		<div class="header"  style="background-image: url('images/hd.jpg');">
			<div class="header-menu">
				<ul>
					<li><a class="fas fa-user text-light" href="profil.php"></a></li>
					<li><a class="fas fa-sign-out-alt text-light" href="logout.php"></a></li>
				</ul>
			</div>
		</div>
		<div class="sidebar">
			<a class="fas fa-home" href="index.php"> Home</a>
			<a href="?hal=transaksi.php">Transaksi</a>
		</div>
		<div class="content">
			<?php  
				if (!empty($hal)) {
					include "page/".$hal;
				}
			?>
			
		</div>
		<div class="footer">
			
		</div>
	</div>

</body>
</html>