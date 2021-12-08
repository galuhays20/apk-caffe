<?php  
$aksi = isset($_GET['aksi'])?$_GET['aksi']:"";
// Update data di database 
if ($aksi == 'update') {
	extract($_POST);
	$query = "update kategori set nama_kategori='$nama_kategori' where id_kategori='$id_kategori'";
	$up = $db->prepare($query);
	$up->execute();
	echo "<script>
 			location.href='?hal=kategori.php';
 		</script>";
}

if ($aksi == 'edit') {
	$id_kategori = isset($_GET['id'])?$_GET['id']:"";
	if (is_numeric($id_kategori)) {
		$query = "select * from kategori where id_kategori='$id_kategori'";
		$sel = $db->prepare($query);
		$sel->execute();
		$num = $sel->rowCount();
		if ($num > 0) {
			$row = $sel->fetch();
		}
		?>

		<form method="POST" action="?hal=edit_kategori.php&aksi=update">
			<table>
				<tr>
					<td>Id kategori</td>
					<td>:</td>
					<td>
						<?=$row['id_kategori']?>
						<input type="hidden" name="id_kategori" value="<?=$row['id_kategori']?>">
					</td>
				</tr>
				<tr>
					<td>Nama Kategori</td>
					<td>:</td>
					<td>
						<input type="text" name="nama_kategori" value="<?=$row['nama_kategori']?>">
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="update" value="Update!" class="btn">
						<button type="button" onclick="history.back();" class="btn">Batal!!!!!!</button>
					</td>
				</tr>
			</table>
			
		</form>

		<?php
	}
}

?>