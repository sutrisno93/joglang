<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "Login dulu .";  
}


else {

   include "../../config/koneksi.php";
   include "../../config/library.php";
   $module = $_GET['module'];
   $klik   = $_GET['klik'];
   
	if($module=='saran' AND $klik=='hapus'){
		
		$query = "DELETE FROM saran WHERE ud_saran='$_GET[id]'";
		mysqli_query($koneksi, $query);
		header("location:../../homes.php?module=".$module);
	
	}
	
	
	elseif($module=='saran' and $klik=='input'){
	
	$nama	=	htmlspecialchars($_POST['nama']);
	$email	=	htmlspecialchars($_POST['email']);
	$pesan	=	htmlspecialchars($_POST['kritiksaran']);
	$pilihan=	htmlspecialchars($_POST['pilih']);
	
	$insert ="insert into saran(nama,email,pesan,pilih)values('$nama','$email','$pesan','$pilihan')";
	mysqli_query($koneksi,$insert);
	header("location:../../homes.php?module=beranda");
	}

}
?>