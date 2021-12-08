<?php  

	require 'escpos-php/autoload.php';
	use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
	use Mike42\Escpos\Printer;
	$connector = new WindowsPrintConnector("printer pos1");
	$printer = new Printer($connector);
	$printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("ANDIA CAFE\n");
	$printer->initialize();
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("jl. Sukorejo Danyang\n");
	$printer->text("IG : @andiarmdhnptrn\n");
	$printer->initialize();
	$printer->feed();
	$printer->text("================================\n");
	$lbl_nama = str_pad("NAMA MENU",16," ",STR_PAD_BOTH);
	$lbl_jumlah = "JML";
	$lbl_harga = str_pad("HARGA",7," ",STR_PAD_BOTH);
	$lbl_total = str_pad("TOTAL",6," ",STR_PAD_BOTH);
	$printer->text($lbl_nama);
	$printer->text($lbl_jumlah);
	$printer->text($lbl_harga);
	$printer->text($lbl_total."\n");
	$printer->text("================================\n");
	$total = 0;
	foreach ($_SESSION['cart'] as $key => $val) {
		$no++;
		$query = "SELECT*FROM menu WHERE id_menu='$key'";
		$sel = $db->prepare($query);
		$sel->execute();
		$data = $sel->fetch();
		$nama_menu = str_pad($data['nama_menu'],16," ",STR_PAD_RIGHT);
		$jml = str_pad($val,2," ",STR_PAD_LEFT);
		$harga = str_pad($data['harga'],7," ",STR_PAD_LEFT);
		$subtotal = str_pad($val * $data['harga'],7," ",STR_PAD_LEFT);
		$printer->text($nama_menu.$jml.$harga.$subtotal."\n");
		$total += $val * $data['harga'];
			
	}	
	unset($_SESSION['cart']);
	$printer->text("================================\n");
	$printer->text("TOTAL BAYAR : ".$total."\n");
	$printer->text("NO. MEJA : ".$nomor_meja."\n");
	$printer->text("Nama Cust. : ".$nama_customer."\n");

	$printer->text("================================\n");
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("Terimakasih...\n");

	$printer->feed(4);
	$printer->cut();
	$printer->close();
?>