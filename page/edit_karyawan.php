<?php  
	$aksi = isset($_GET['aksi'])?$_GET['aksi']:"";
	if ($aksi=='update') {
		extract($_POST);
		if (!empty($password) && !empty($password_konfirm)) {
			if ($password==$password_konfirm) {
				$pass = md5($password);
				$up = "UPDATE karyawan SET nama_karyawan='$nama_karyawan', username='$username', password='$pass', user_level='$user_level' WHERE id_karyawan='$id_karyawan' ";
				$res = $db->prepare($up);
				$res->execute();
				echo "<script>alert('Update Berhasil'); 
					location.href='?hal=karyawan.php'</script>";
			}else{
				echo "<script>alert('Password yang anda masukan tidak cocok'); location.href='?hal=karyawan.php'</script>";
			}
		}else{
			$up = "UPDATE karyawan SET nama_karyawan='$nama_karyawan', username='$username', user_level='$user_level' WHERE id_karyawan='$id_karyawan' ";
			$res = $db->prepare($up);
			$res->execute();
			echo "<script>alert('Update Berhasil');
				location.href='?hal=karyawan.php'</script>";
		}
	}
	if ($aksi=='edit') {
		$id_karyawan = isset($_GET['id'])?$_GET['id']:"";
		$sel = "SELECT * FROM karyawan WHERE id_karyawan ='$id_karyawan'";
		$res = $db->prepare($sel);
		$res->execute();
		$row = $res->fetch();
		if ($res->rowCount()>0) {
			
?>

<form method="post" action="?hal=edit_karyawan.php&aksi=update">
	<table>
		<tr>
			<td>Id_karyawan</td>
			<td>:</td>
			<td><?=$row['id_karyawan']?>
				<input type="hidden" name="id_karyawan" value="<?=$row['id_karyawan']?>">
			</td>
		</tr>
		<tr>
			<td>Nama Karyawan</td>
			<td>:</td>
			<td><input type="text" name="nama_karyawan" value="<?=$row['nama_karyawan']?>"></td>
		</tr>
		<tr>
			<td>Username</td>
			<td>:</td>
			<td><input type="text" name="username" value="<?=$row['username']?>"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><input type="password" name="password" value="">(Kosongkan Jika Password tidak diganti)</td>
		</tr>
		<tr>
			<td>Konfirmasi Password</td>
			<td>:</td>
			<td><input type="password" name="password_konfirm"></td>
		</tr>
		<tr>
			<td>User Level</td>
			<td>:</td>
			<td>
				<select name="user_level">
					<option value="">==Pilih Level==</option>
					<option value="1" <?=$row['user_level']==1?'selected':''?>>Administrator</option>
					<option value="2" <?=$row['user_level']==2?'selected':''?>>Kasir</option>
					<option value="3" <?=$row['user_level']==3?'selected':''?>>Pelayan</option>
					<option value="4" <?=$row['user_level']==4?'selected':''?>>Pemesanan</option>
					<option value="5" <?=$row['user_level']==5?'selected':''?>>Manager</option>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
				<input type="submit" name="update" value="Update">
				<button type="button" onclick="history.back();">Kembali</button>
			</td>
		</tr>
	</table>
</form>
<?php 
	}
}

 ?>