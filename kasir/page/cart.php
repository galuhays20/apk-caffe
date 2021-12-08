<?php  
	$aksi = isset($_GET['aksi'])?$_GET['aksi']:"";
	switch ($aksi) {
		case 'add':
			$id = isset($_POST['id_menu'])?$_POST['id_menu']:"";
			$jumlah = isset($_POST['jumlah'])?$_POST['jumlah']:"";
			if (isset($_SESSION['cart'][$id])) {
				$_SESSION['cart'][$id] += $jumlah;
			}else{
				$_SESSION['cart'][$id] = $jumlah;
			}
			break;
		case 'delete':
			$id = isset($_GET['id'])?$_GET['id']:"";
			if (isset($_SESSION['cart'][$id])) {
				unset($_SESSION['cart'][$id]);
			}
			break;
		case 'clear':
			unset($_SESSION['cart']);
			break;
		
	}
?>
<script>
	location.href='?hal=transaksi.php';
</script>