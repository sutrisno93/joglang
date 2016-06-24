<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href=\"../../css/style_login.css\" rel=\"stylesheet\" type=\"text/css\" />
        <div id=\"login\"><h1 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h1>
        <p class=\"fail\"><a href=\"../../index.php\">LOGIN</a></p></div>";  
}
else{
	include "../../config/koneksi.php";
	include "../../config/library.php";
    $module = $_GET['module'];
    $klik   = $_GET['klik'];
	
	
	
if ($module=='cabang' AND $klik=='hapus'){
    $hapus = "DELETE FROM polling WHERE id_pilihan='$_GET[id]'";
    mysqli_query($koneksi, $hapus);
    
    header("location:../../homes.php?module=".$module);
  }
elseif($module=='cabang' AND $klik=='tambah'){
	$pilihan = $_POST['pilihan'];
    $status  = $_POST['status'];
    
    $input = "INSERT INTO polling(pilihan, status) VALUES('$pilihan', '$status')";
    mysqli_query($koneksi, $input);
    
    header("location:../../homes.php?module=".$module);


	}
elseif ($module=='cabang' AND $klik=='edit'){
    $id      = $_POST['id'];
    $pilihan = $_POST['pilihan'];
    $status  = $_POST['status'];
    $aktif   = $_POST['aktif'];
    
    $update = "UPDATE polling SET pilihan='$pilihan', status='$status', aktif='$aktif' WHERE id_pilihan='$id'";
    mysqli_query($koneksi, $update);
    
    header("location:../../homes.php?module=".$module);
  }
  
  

elseif($module=="cabang" and $klik=="pilih") {
		
		if (isset($_COOKIE['polling'])) {
         echo "<script>alert('Anda telah Melakukan Voting untuk hari ini.'); window.location = '../../homes.php?module=beranda'</script>";
		}else{
		
		setcookie("polling", "sudah polling", time() + 3600 * 24);

        $pilihan = $_POST['pilihan'];
        // tambahkan rating untuk polling yang dipilih pengunjung
        $querypolling = "UPDATE polling SET rating=rating+1 WHERE id_pilihan='$pilihan'";
        $updatepolling = mysqli_query($koneksi, $querypolling);
		  header("location:../../homes.php?module=beranda");
				}
		
		
		}		



}
?>