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

  $module = $_GET['module'];
  $act    = $_GET['act'];

  // Input modul
  if($module=='modul' AND $act=='input'){
    // cari urutan terakhir karena kita  menampilkan menu dari field urutan.
    $query = mysqli_query($koneksi, "SELECT urutan FROM modul ORDER BY urutan DESC LIMIT 1");
    $r     = mysqli_fetch_array($query);
    
    $urutan     = $r['urutan']+1;
    $nama_modul = $_POST['nama_modul'];
    $link       = $_POST['link'];
    
    $input = "INSERT INTO modul(nama_modul, link, urutan) VALUES('$nama_modul', '$link', '$urutan')";
    mysqli_query($koneksi, $input);
    
    header("location:../../homes.php?module=".$module);
  }
  
elseif ($module=='modul' AND $act=='edit'){
    $id         = $_POST['id'];
    $urutan     = $_POST['urutan'];
    $nama_modul = $_POST['nama_modul'];
    $link       = $_POST['link'];
    $status     = $_POST['status'];
    $aktif      = $_POST['aktif'];
    
    $update = "UPDATE modul SET nama_modul = '$nama_modul',
                                link       = '$link',
                                urutan     = '$urutan',
                                status     = '$status', 
                                aktif      = '$aktif' 
                          WHERE id_modul   = '$id'";
    mysqli_query($koneksi, $update);
    
    header("location:../../homes.php?module=".$module);
  }

}



?>