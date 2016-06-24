<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "Login dulu.";  
}
//baru mau buat input dan update kategori... 00.10 26/10/2015

else {
	  include "../../config/koneksi.php";
	  include "../../config/fungsi_thumbnail.php";
	  $module = $_GET['module'];
      $klik   = $_GET['klik'];
	
	//tmbah data barang blm ada
 if ($module=='barang' AND $klik=='tambah'){
	$lokasi_file = $_FILES['fupload']['tmp_name'];
    $tipe_file   = $_FILES['fupload']['type'];
    $nama_file   = $_FILES['fupload']['name'];
    $acak        = rand(1,99);
    $nama_gambar = $acak.$nama_file; 
	//value
	$kode_barang	= $_POST['kode_barang'];
	$kategori		= $_POST['kategori'];
    $nama     		= $_POST['nama'];
    $harga_beli		= $_POST['harga_beli'];
	$harga_jual		= $_POST['harga_jual'];
	$stock			= $_POST['stok'];
	$ket			= $_POST['ket'];
	
	//jika gambar tidak ada.
	if(empty($lokasi_file)){
    $input = "INSERT INTO stock_barang(kode_barang, nama, harga_beli, harga_jual, stok, ket,id_kategori)
									VALUES('$kode_barang','$nama','$harga_beli','$harga_jual','$stock','$ket','$kategori')";
									
	mysqli_query($koneksi, $input);
	header("location:../../homes.php?module=".$module);
	}
	
	//jika gambar ada
	else{
		if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
			echo "<script>window.alert('Upload Gagal! Pastikan file yang di upload bertipe *.JPG');
				window.location=('../../homes.php?module=barang')</script>";
	
		}
		else{
			$folder = "../../gambar_barang/"; // folder untuk foto berita
			$ukuran = 200;                     // foto diperkecil jadi 200px (thumb)
			UploadFoto($nama_gambar, $folder, $ukuran);
			
			$input = "INSERT INTO stock_barang(kode_barang, nama, harga_beli, harga_jual, stok, gambar, ket,id_kategori)
									VALUES('$kode_barang','$nama','$harga_beli','$harga_jual','$stock','$nama_gambar','$ket','$kategori')";
			
			
		mysqli_query($koneksi, $input);
		header("location:../../homes.php?module=".$module);
		}
	}
 }
 
 
 
	
elseif($module=='barang' and $klik=='edit'){
	
	$lokasi_file = $_FILES['fupload']['tmp_name'];
    $tipe_file   = $_FILES['fupload']['type'];
    $nama_file   = $_FILES['fupload']['name'];
    $acak        = rand(1,99);
    $nama_gambar = $acak.$nama_file; 
	
	$id           = $_POST['id'];
	$kategori     = $_POST['kategori'];
    $kode		  = $_POST['kodebarang']; 
    $nama         = $_POST['nama'];
	$beli		  = $_POST['hargabeli'];
	$jual		  = $_POST['hargajual'];
	$stok		  = $_POST['stok'];
	$ket	 	  = $_POST['ket'];
	if(empty($lokasi_file)){
		$edit = "update stock_barang set 
									kode_barang	= '$kode',
									nama		= '$nama',
									harga_beli	= '$beli',
									harga_jual	= '$jual',
									stok		= '$stok',
									ket			= '$ket',
									id_kategori	= '$kategori'
							where	id_barang	= '$id'";
		mysqli_query($koneksi, $edit);
		if($edit){
		header("location:../../homes.php?module=".$module);}else{ echo"gagal";}
	}else{
	if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
			echo "<script>window.alert('Upload Gagal! Pastikan file yang di upload bertipe *.JPG');
				window.location=('../../homes.php?module=barang')</script>";
	
		}
		else{
        $folder = "../../gambar_barang/"; // folder untuk foto berita
        $ukuran = 200;                     // foto diperkecil jadi 200px (thumb)
        UploadFoto($nama_gambar, $folder, $ukuran);
        $update = "UPDATE stock_barang SET 
                                     kode_barang	= '$kode', 
                                     nama			= '$nama',
                                     harga_beli		= '$harga_beli',
                                     harga_jual		= '$harga_jual',
                                     stok			= '$stok', 
									 gambar     	= '$nama_gambar',									 
                                     ket			= '$ket',
                                     id_kategori	= '$id_kategori'
                               WHERE id_barang		= '$id'";
        mysqli_query($koneksi, $update);

        header("location:../../homes.php?module=".$module);
      }
	}
	}


	
	
elseif($module=='barang' and $klik=='hapus'){
	$query = "SELECT gambar FROM stock_barang WHERE id_barang='$_GET[id]'";
    $hapus = mysqli_query($koneksi, $query);
    $r     = mysqli_fetch_array($hapus);
    
    if ($r['gambar']!=''){
      $namafile = $r['gambar'];
      // hapus file gambar yang berhubungan dengan berita tersebut
      unlink("../../gambar_barang/$namafile");   
      unlink("../../gambar_barang/small_$namafile");   
      
      // hapus
      mysqli_query($koneksi, "DELETE FROM stock_barang WHERE id_barang='$_GET[id]'");      
    }
    else{
      mysqli_query($koneksi, "DELETE FROM stock_barang WHERE id_barang='$_GET[id]'");
    }
    header("location:../../homes.php?module=".$module);


	}
	
	elseif($module=='barang' and $klik=='tambahstok'){

		$barango         = $_POST['idbar'];
		$stoktam		 = $_POST['stokh'];
		
		$tambahstok = "update stock_barang set stok = '$stoktam' where id_barang='$barango'";
		mysqli_query($koneksi, $tambahstok);
		
		if($tambahstok){
		header("location:../../homes.php?module=".$module);
		}else{ echo"gagal";}
}

	elseif($module=='barang' and $klik=='inputkategori'){
	$kategori = $_POST['namakategori'];
	
	$tbkate = "insert into kategori (nama) values ('$kategori')";
	mysqli_query($koneksi,$tbkate);
	header("location:../../homes.php?module=barang&klik=kategori");
}
	elseif($module=='barang' and $klik=='editkate'){
	$idkat		= $_POST['idkat'];
	$kategori	= $_POST['kategori'];
	$aktif		= $_POST['aktif'];
	
	$updatekate = "update kategori set nama= '$kategori', aktif='$aktif' where id_kategori = '$idkat'";
	mysqli_query($koneksi,$updatekate);
	header("location:../../homes.php?module=barang&klik=kategori");
}
	
	
	
	
}
?>