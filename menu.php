<?php
include "config/koneksi.php";
//jika admin akan tampil menu admin (kiri)
if ($_SESSION['leveluser']=='admin'){
  $query = "SELECT * FROM modul WHERE aktif='Y' ORDER BY urutan";
  $hasil = mysqli_query($koneksi, $query);
  while ($m=mysqli_fetch_array($hasil)){ 
		//ambil link di tabel modul dan field nama modul
    echo "<li><a href=\"$m[link]\"><i class=\"fa fa-envelope\"></i> <span>$m[nama_modul]</span> </a></li>";
  }	
}
//jika user akan tampil menu user (kiri)
elseif ($_SESSION['leveluser']=='user'){
  $query = "SELECT * FROM modul WHERE status='user' and aktif='Y' ORDER BY urutan";
  $hasil = mysqli_query($koneksi, $query);
  while ($m=mysqli_fetch_array($hasil)){  
    echo "<li><a href=\"$m[link]\"><i class=\"fa fa-envelope\"></i> <span>$m[nama_modul]</span></a></li>";
  }
}
?>