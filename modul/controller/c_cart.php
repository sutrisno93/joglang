<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "Login dulu .";  
}


else {
// ----CONTROLLER INI BERISIKAN MODUL ORDER DAN MODUL CART----
//kekurangan:
//belum ada tombol hapus pesanan
//belum ada tombol ubah jumlah barang
//belum ada program diskon untuk pembelian lebih dari 5.

   include "../../config/koneksi.php";
   include "../../config/library.php";
   $module = $_GET['module'];
   $klik   = $_GET['klik'];
   
	if($module=='order' AND $klik=='cart') {
	
		if(isset($_POST["type"]) && $_POST["type"]=='add'){
		$id 			= filter_var($_POST["p-kode"], FILTER_SANITIZE_STRING); //product code
		$qty_barang 	= filter_var($_POST["p-qty"], FILTER_SANITIZE_NUMBER_INT); //product code
			
			$sql_s="SELECT * FROM stock_barang WHERE id_barang={$id}";
			$query_s=mysqli_query($koneksi, $sql_s);
			
			if(mysqli_num_rows($query_s)!=0){
				$r=mysqli_fetch_array($query_s);

				if($qty_barang > $r['stok']){
					die("<script>alert('Stock tidak mencukupi'); window.location = '../../homes.php?module=$module'</script>");}
				elseif($qty_barang <= 0){
					die("<script>alert('masukan jumlah belanja anda.'); window.location = '../../homes.php?module=$module'</script>");
				}
								
				$_SESSION['produks'][$r['id_barang']]=
				array( "quantity" => $qty_barang, "harga" => $r['harga_jual']);
			header("location:../../homes.php?module=".$module);		
			}else{ echo "gagal";}}
 }
 
 
 
 	elseif($module=='order' AND $klik=='simpan') {
		if(isset($_SESSION['produks'])){		
		$acak        		= rand(1,99);
		$nofaktur			= $acak.$_POST['nofaktur'];
		$iduser	 			= $_POST['id_user'];
		$idbarang		    = $_POST['id_barang'];
		$qty				= $_POST['quantity'];
		$total 				= $_POST['total'];
		$count 				= count($idbarang);
		
		
		for($i=0; $i<$count; $i++){
		$input = "INSERT INTO `pesanan` (no_faktur,`id_barang`,`id_user`,`quantity`,ttl_harga,tgl_pesan)
					VALUES('$nofaktur','$idbarang[$i]','$iduser[$i]','$qty[$i]','$total','$tgl_sekarang')";		
		mysqli_query($koneksi,$input);	
	
		
		$update = "update stock_barang set stok=stok-'$qty[$i]' where id_barang='$idbarang[$i]'";
		mysqli_query($koneksi,$update);
		
		unset($_SESSION['produks']);
		header("location:../../homes.php?module=".$module);
		
	}}else {echo "tidak ad cart";}}
 
 
 
 //ganti jumlah/hapus

 
	//update status belanja
	elseif($module=='cart' and $klik=='update'){
		$id 	= $_POST['id'];
		$update = $_POST['status'];
		
	$update = 	"update pesanan set status= '$update' where no_faktur = '$id'";
	mysqli_query($koneksi, $update);
	
	//update pembayaran konfirm
	$y = "UPDATE status_belanja SET konfirm='Y' WHERE no_faktur='$id'";
	mysqli_query($koneksi, $y); 
	header("location:../../homes.php?module=".$module);
	}
	
	elseif($module=='cart' and $klik=='inputresi'){
		$nofak	= $_POST['no_fak'];
		$insertresi = $_POST['noresi'];
	$insertresi = "update status_belanja set no_resi = '$insertresi' where no_faktur='$nofak'";
	mysqli_query($koneksi,$insertresi);
	header("location:../../homes.php?module=".$module);
	
	}
	
	
	//konfirmasi
	elseif($module=='cart' and $klik=='konfirm'){
	$id			= $_POST['id'];
	$iduser		= $_SESSION['iduser'];
	$nama		= $_POST['nama'];
	$alamat		= $_POST['alamat'];
	$kodepos	= $_POST['kodepos'];
	$tglpesan	= $_POST['tglpesan'];
	$dari		= $_POST['dari'];
	$kepada		= $_POST['kepada'];
	$nominal	= $_POST['nominal'];
	$note		= $_POST['note'];
	
	$input = "insert into status_belanja (no_faktur,id_user,nama,alamat,kode_pos,tgl_pesan,tgl_bayar,trans_dari,trans_kepada,jml_bayar,ket)
		VALUES('$id','$iduser','$nama','$alamat','$kodepos','$tglpesan','$tgl_sekarang','$dari','$kepada','$nominal','$note')";
	
	mysqli_query($koneksi,$input);
	header("location:../../homes.php?module=".$module);
	}
	
	//works..simpan barang ke table pesanan[DONE!]

	
	
	
			

	
		

	

 
		
	
}
?>