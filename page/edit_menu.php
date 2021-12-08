<?php 

	$aksi = isset($_GET['aksi'])?$_GET['aksi']:"";
	// Update data di database
	if ($aksi=='update') {
		extract($_POST);
		$query = "UPDATE menu SET nama_menu='$nama_menu', id_kategori='$id_kategori', harga='$harga', stok='$stok', keterangan='$keterangan' where id_menu='$id_menu'";
		$up = $db->prepare($query);
		$up->execute();
		echo "<script>
				location.href='?hal=menu.php';
			</script>";
	}
	// Menampilkan data yang akan di update
	if ($aksi=='edit') {
		$id_menu = isset($_GET['id'])?$_GET['id']:"";
		if (is_numeric($id_menu)) {
			$query = "SELECT * FROM menu WHERE id_menu='$id_menu'";
			$sel = $db->prepare($query);
			$sel->execute();
			$num = $sel->rowCount();
			if ($num>0) {
				$row = $sel->fetch();
			?>

				<form method="post" action="?hal=edit_menu.php&aksi=update">
					<table>
						<tr>
							<td>Id Menu</td>
							<td>:</td>
							<td>
								<?= $row['id_menu'] ?>
								<input type="hidden" name="id_menu" value="<?=$row['id_menu']?>">
							</td>
						</tr>
						<tr>
							<td>Nama Menu</td>
							<td>:</td>
							<td>
								<input type="text" name="nama_menu" value="<?=$row['nama_menu']?>">
							</td>
						</tr>
						<tr>
							<td>Kategori</td>
							<td>:</td>
							<td>
								<select name="id_kategori">
									<option value="">Pilih Kategori</option>
									<?php  

									$k = "SELECT * FROM kategori ORDER BY nama_kategori ASC";
									$res = $db->prepare($k);
									$res->execute();
									while ($baris=$res->fetch()) {
										if ($row['id_kategori']==$baris['id_kategori']) {
											echo "<option value='$baris[id_kategori]' selected>$baris[nama_kategori]</option>";
										}else{
											echo "<option value='$baris[id_kategori]'>$baris[nama_kategori]</option>";
										}
									}

									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Harga</td>
							<td>:</td>
							<td>
								<input type="number" name="harga" value="<?=$row['harga']?>">
							</td>
						</tr>
						<tr>
							<td>Stok</td>
							<td>:</td>
							<td>
								<input type="number" name="stok" value="<?=$row['stok']?>">
							</td>
						</tr>
						<tr>
							<td>Keterangan</td>
							<td>:</td>
							<td>
								<input type="text" name="keterangan" autocomplete="off" value="<?=$row['keterangan']?>">
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td>
								<input type="submit" name="update" value="Update">
								<button type="button" onclick="history.back();">Cancel</button>
							</td>
						</tr>
					</table>
					
				</form>
				<?php  
		}
		}
	}
?>