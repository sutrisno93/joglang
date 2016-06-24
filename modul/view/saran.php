<?php

if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "GAGAL";  
}


else {
	$link = "modul/controller/c_saran.php";
	$klik = isset($_GET['klik']) ? $_GET['klik'] : '';
	
	
if($klik=="lihat") {
	$sql = "select * from saran where id_saran='$_GET[id]'";
	$query = mysqli_query($koneksi,$sql);
	$p = mysqli_fetch_array($query);
	echo"<div class=\"row\">
		<div class=\"col-md-5\">
		<div class=\"box box-solid\">
		<div class=\"box-header with-border\">
		<h3 class=\"text-center\">$p[pilih]</h3>
		</div>
		<div class=\"box-body\">
		<dl class=\"dl-horizontal\">
		<dt>Nama</dt>
		<dd>$p[nama]</dd>
		<dt>E-mail</dt>
		<dd>$p[email]</dd>
		<dt>Pesan</dt>
		<dd>$p[pesan]</dd>
		</dl>
		<dl><input type=\"button\" value=\"Kembali\" class=\" btn btn-xs btn-warning\" onclick=\"self.history.back()\"></dl>
		</div></div></div></div>";
}


else{

	$sql = "select * from saran order by id_saran";
	$query = mysqli_query($koneksi,$sql);
	
	echo"<div class=\"row\">
		<div class=\"col-sm-6\">
		<div class=\"box box-info\">
		<div class=\"box-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">
		<table class=\"table no-margin\">";
	echo"<tr><th>Nama</th><th>Pilihan</th><th>Aksi</th></tr>";
	while($f = mysqli_fetch_array($query)){
	echo"
		<tr>
		<td>$f[nama]</td>
		
		<td>$f[pilih]</td>
		
		<td>
		<a href=\"?module=saran&klik=lihat&id=$f[id_saran]\">Lihat</a> |
		<a href=\"$link?module=saran&klik=hapus&id=$f[id_saran]\">Hapos</a>
		
		</tr>
		
	
	";
	}
		
	echo"</table></div></div></div></div></div></div>";
		

}
	
	
	
	

	
}
?>