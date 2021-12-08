<?php  

$aksi = isset($_GET['aksi'])?$_GET['aksi']:"";
if ($aksi == 'simpan') {
	$detail = serialize($_SESSION['cart']);
	extract($_POST);
	$query = "INSERT INTO transaksi VALUES(null, '$nama_customer', '$nomor_meja', now(), '$detail', '$total', '$diskon', '1')";
	$ins = $db->prepare($query);
	$ins->execute();
}
include 'struk.php';

?>
<script>
	location.href='?hal=transaksi.php';
</script>