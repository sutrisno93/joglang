<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "login dulu";  
}

else{

	include "config/koneksi.php";
	$op = $_GET['op'];
	
	
if($op=='kode'){
		 echo"<option value=\"0\" selected>- Pilih Kategori -</option>";
		  $select = "select * from kategori where aktif='Y' order by nama";
		  $query = mysqli_query($koneksi,$select);
		  while($r=mysqli_fetch_array($query)){
		  echo "<option value=\"$r[id_kategori]\">$r[nama]</option>";
		  }
	
	}
	
	
	
	
elseif($op=='ambildata'){	

	echo"<div class=\"box-body \">
		 <div class=\"table-responsive\">";
	echo"<table class=\"table no-margin\">";
	$query = "SELECT * FROM kategori,stock_barang WHERE kategori.`id_kategori`=stock_barang.`id_kategori` AND kategori.`id_kategori`='$_GET[kode]'";
	$tampil = mysqli_query($koneksi, $query);
	$kolom = 9;
	echo "<tr>";
	$i=0;
	while ($r= mysqli_fetch_array($tampil)) {
	$asd = "$r[harga_jual]";
	$format_harga = number_format($asd, 0, ",",".");
		if($i >= $kolom){
		echo "</tr><tr>";
		$i=0;
		}
		$i++;
	echo "<td align=\"center\"><br>
				<a>
				<img src=\"gambar_barang/$r[gambar]\" border=\"1\" width=\"100\" height=\"100\" alt=\"$r[nama]\">
				</a>";
	echo"<br><button class=\"btn btn-primary btn-xs\" data-toggle=\"modal\" data-target=\"#myModal-$r[id_barang]\">Detail </button>
		<div class=\"modal fade\" id=\"myModal-$r[id_barang]\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
		<div class=\"modal-dialog\">
         <div class=\"modal-content\">
         <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
        <h4 class=\"modal-title\" id=\"myModalLabel\">$r[nama]</h4>
        </div>
        <div class=\"modal-body\">
		<img src=\"gambar_barang/$r[gambar]\" class=\"image\" border=\"1\" width=\"60%\" height=\"60%\" ><br>
		<dl class=\"dl-horizontal\">
		<dt>Detail Produk :		</dt>
		<dd class=\"text-left\"> $r[ket] </dd>
		</dl>
		</div>
          <div class=\"modal-footer\">
		Stok : <label class=\"label label-success\"> $r[stok] </label> |
          Harga		  :		 <label class=\"label label-info\"> Rp ".number_format($r['harga_jual'], 0, ",",".").",- </label>
        </div>
        </div>
       </div></div>";
		echo"<a href=\"?module=order&klik=pesan&id=$r[id_barang]\" class=\"btn btn-xs btn-success\" >Pesan</a> 
				<br>Rp $format_harga 
				<br></td>";
			}
	echo "</tr>";
	echo"</table></div></div>";
	 }
}	 
?>