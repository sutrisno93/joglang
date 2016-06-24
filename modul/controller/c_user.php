<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "Login dulu.";  
}

else {
   include "../../config/koneksi.php";
   include "../../config/fungsi_thumbnail.php";
   $module = $_GET['module'];
   $klik   = $_GET['klik'];
 
  
  
	//hapus user
	if($module=='user' AND $klik=='hapus'){
		$query = "DELETE FROM users WHERE id_user='$_GET[id]'";
		mysqli_query($koneksi, $query);
		header("location:../../homes.php?module=".$module);
		}
		
	//tmbah data user
	
	elseif ($module=='user' AND $klik=='tambah'){
	$username		= $_POST['username'];
	$password		= md5($_POST['password']);
	$nama_lengkap	= $_POST['nama_lengkap'];
	$email			= $_POST['email'];
	$alamat			= $_POST['alamat'];
	$kota			= $_POST['kota'];
	$kecamatan		= $_POST['kecamatan'];
	$kabupaten		= $_POST['kabupaten'];
	$provinsi		= $_POST['provinsi'];
	$pos			= $_POST['kode_pos'];
	$telpon			= $_POST['no_telp'];
	
	$input = "INSERT INTO users(username,password,nama_lengkap,email,alamat,kota,kecamatan,kabupaten,provinsi,kode_pos,no_telp)
							VALUES('$username','$password','$nama_lengkap','$email','$alamat','$kota','$kecamatan','$kabupaten','$provinsi','$pos','$telpon')";
	mysqli_query($koneksi,$input);
	header("location:../../homes.php?module=".$module);
}
  //----------------------edit user.
	elseif($module=='user' AND $klik=='edit'){
		
    $id           = $_POST['id'];
    $nama_lengkap = $_POST['nama_lengkap']; 
    $email        = $_POST['email'];
	$alamat		  = $_POST['alamat'];
	$kota		  = $_POST['kota'];
	$kecamatan	  = $_POST['kecamatan'];
	$kabupaten	  = $_POST['kabupaten'];
	$provinsi 	  = $_POST['provinsi'];
	$pos 		  = $_POST['kode_pos'];
	$telpon		  = $_POST['no_telp'];
    $blokir       = $_POST['blokir'];
 
    // Apabila password tidak diubah
    if (empty($_POST['password'])) {
      $update = "UPDATE users SET nama_lengkap 		= '$nama_lengkap',
                                         email 		= '$email',
                                         alamat 	= '$alamat',
                                         kota		= '$kota',
                                         kecamatan	= '$kecamatan',
                                         kabupaten	= '$kabupaten',
                                         provinsi	= '$provinsi',
                                         kode_pos	= '$pos',
                                         no_telp	= '$telpon',
                                        blokir 		= '$blokir'   
                                 WHERE id_user 		= '$id'";
      mysqli_query($koneksi, $update);
    }
    // Apabila password diubah
    else{
      $password = md5($_POST['password']);
      $update = "UPDATE users SET nama_lengkap		= '$nama_lengkap',
                                        email  		= '$email',
										alamat 		= '$alamat',
                                         kota		= '$kota',
                                         kecamatan	= '$kecamatan',
                                         kabupaten	= '$kabupaten',
                                         provinsi	= '$provinsi',
                                         kode_pos	= '$pos',
                                         no_telp	= '$telpon',
                                        blokir 		= '$blokir',
                                      password 		= '$password'    
									WHERE id_user   = '$id'";
      mysqli_query($koneksi, $update);
	
    }
  header("location:../../homes.php?module=".$module);
	
	
	}



}
?>