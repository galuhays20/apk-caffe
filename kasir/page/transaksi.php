 <div class="title-page">
	<b>Transaksi</b>
</div>
<div class="body-page">
	<form method="post" action="?hal=cart.php&aksi=add">
		<table>
			<tr>
				<td>Menu</td>
				<td>:</td>
				<td>
					<select name="id_menu">
						<option value="">===Pilih Menu===</option>
						<?php  
							$q = "SELECT * FROM menu ORDER BY nama_menu ASC";
							$res = $db->prepare($q);
							$res->execute();
							while ($row = $res->fetch()) {
								echo "<option value='$row[id_menu]'>$row[nama_menu]</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td>:</td>
				<td><input type="text" name="jumlah" placeholder="Jumlah" autocomplete="off"></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<input type="submit" name="simpan" value="Tambahkan" class="btn btn-success">
				</td>
			</tr>
		</table>
	</form>
	<table border="1" cellpadding="4" cellspacing="0">
		<tr>
			<th>No</th>
			<th>Menu</th>
			<th>Jumlah</th>
			<th>Harga</th>
			<th>Total</th>
			<th>Hapus</th>
		</tr>

		<?php  
			if (isset($_SESSION['cart'])) {
				$no = 0;
				$total = 0;
				foreach ($_SESSION['cart'] as $key => $val) {
					$no++;
					$query = "SELECT*FROM menu WHERE id_menu='$key'";
					$sel = $db->prepare($query);
					$sel->execute();
					$data = $sel->fetch();
					$total += $data['harga']*$val;
		?>
		<tr>
			<td><?=$no?></td>
			<td><?=$data['nama_menu']?></td>
			<td><?=$val?></td>
			<td><?=$data['harga']?></td>
			<td><?=$data['harga']*$val?></td>
			<td>
				<a href="?hal=cart.php&aksi=delete&id=<?=$data['id_menu']?>">Hapus</a>
			</td>
		</tr>
		<?php  
				}
			}
		?>
	</table>
	<?php 
		if (isset($_SESSION['cart'])) {
	 ?>

	<a class="btn btn-danger" href="?hal=cart.php&aksi=clear"onclick="return confirm('Yakin akan membatalkan transaksi?');">Batalkan transaksi</a>

	<form method="post" action="?hal=proses_transaksi.php&aksi=simpan">
		<table>
			<tr>
				<td>Nomor Meja</td>
				<td>:</td>
				<td><input type="number" name="nomor_meja"></td>
			</tr>
			<tr>
				<td>Nama Customer</td>
				<td>:</td>
				<td><input type="text" name="nama_customer" autocomplete="off"></td>
			</tr>
			<tr>
				<td>Total</td>
				<td>:</td>
				<td><input type="hidden" name="total" value="<?=$total?>"><?=$total?></td>
			</tr>
			<tr>
				<td>Diskon</td>
				<td>:</td>
				<td><input type="number" name="diskon"></td>
				
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><input class="btn btn-success" type="submit" name="simpan" value="Selesai"></td>
			</tr>
		</table>
	</form>
	<?php  
		}
	?>
</div>