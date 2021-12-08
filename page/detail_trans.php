<?php  
?>
<div class="title-page">
	Detail Pemesanan
</div>
<div class="body-page" style="font-family: verdana;">
		<?php
			$id = isset($_GET['id'])?$_GET['id']:"";
			if (is_numeric($id)) {
				$query = $db->prepare("SELECT*FROM transaksi WHERE id_transaksi='$id'");
				$query->execute();
				if ($query->rowCount()>0) {
					$row = $query->fetch();
					$detail = unserialize($row['detail_pemesanan']);
					$total = 0;
					$no = 0;
				?>
				Tanggal : <?=$row['tanggal']?><br>
				Nama : <?=$row['nama_customer']?><br>
				No. Meja : <?=$row['nomor_meja']?><br>
				<table border="1" cellpadding="5" cellspacing="0">
					<tr>
						<th>No</th>
						<th>Menu</th>
						<th>Jumlah</th>
						<th>Harga</th>
						<th>Subtotal</th>
						<th>Total</th>
					</tr>
						
					<?php 
						foreach ($detail as $key => $value) {
							$no++;
							$sel = $db->prepare("SELECT * FROM menu WHERE id_menu = '$key'");
							$sel->execute();
							$data = $sel->fetch();
							$subtotal = $data['harga']*$value;
							$total += $data['harga']*$value;
							echo "<tr>
									<td>$no</td>
									<td>$data[nama_menu]</td>
									<td>$value</td>
									<td>$data[harga]</td>
									<td>$subtotal</td>
								</tr>
								";
					}
				}
			}
		?>
	</table>
	<br>
	<button onclick="history.back();" class="btn btn-primary">Kembali</button>


</div>