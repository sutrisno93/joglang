<?php
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "GAGAL!";  
}

	else {
		$link = "modul/controller/c_barang.php";
		$klik = isset($_GET['klik']) ? $_GET['klik'] : ''; 
	//tambah barang (golongan, kelompok,di sedirikan(next update))
	if($klik=="tambah") {
	echo"<div class=\"row\">
		<div class=\"col-md-5\">
		<div class=\"box box-info\">
		<div class=\"box info-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
	echo"<table class=\"table no-margin\">";
		echo "<h3>Tambah barang</h3>
          <form method=\"POST\" enctype=\"multipart/form-data\" action=\"$link?module=barang&klik=tambah\">
          <table class=\"table-responsive table-bordered\">";
	echo"<tr><td>Kategori </td></tr>
		 <tr><td>
		 <select name=\"kategori\">
            <option value=\"0\" selected>- Pilih Kategori -</option>";
		  $select = "select * from kategori where aktif='Y' order by nama";
		  $query = mysqli_query($koneksi,$select);
		  while($r=mysqli_fetch_array($query)){
		  echo "<option value=\"$r[id_kategori]\">$r[nama]</option>";
		  }
	 echo"</select></td></tr> <tr><td>Kode Barang :</td></tr><tr><td> <input type=\"text\" class=\"form-control input-sm\" name=\"kode_barang\"></td></tr>
		  <tr><td>Nama Barang :</td></tr><tr><td> <input type=\"text\" class=\"form-control input-sm\"  name=\"nama\"></td></tr>
		  <tr><td>Harga Beli :</td></tr><tr><td>  <input type=\"text\" class=\"form-control input-sm\" placeHolder=\"Harga Beli\" name=\"harga_beli\"></td></tr>
          <tr><td>Harga Jual :</td></tr><tr><td>  <input type=\"text\" class=\"form-control input-sm\" placeHolder=\"Harga Jual\" name=\"harga_jual\"></td></tr>
		  <tr><td>Stok :</td></tr><tr><td> <input type=\"text\" class=\"form-control input-sm\" value=\"25\" name=\"stok\"></td></tr>
		  <tr><td>Gambar :</td></tr><tr><td> <input type=\"file\" name=\"fupload\" size=\"50\"><br> - Tipe gambar harus JPG (disarankan lebar gambar 350 px).</td></tr>
		  <tr><td>Keterangan :</td></tr><tr><td>  <textarea class=\"form-control input-sm\" type=\"text\" name=\"ket\" ></textarea></td></tr>
		  <tr><td colspan=\"2\"><input type=\"submit\" class=\"btn btn-xs btn-primary\" value=\"Simpan\">
          <input type=\"button\" class=\"btn btn-xs btn-warning\" value=\"Batal\" onclick=\"self.history.back()\"></td></tr>
          </form>";
		  echo"</table>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>";
		  
	
	}
	
	//kategori
	elseif($klik=="kategori"){
	
	echo"<div class=\"row\">
		<div class=\"col-md-5\">
		<div class=\"box box-info\">
		<div class=\"box info-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
	echo"<table class=\"table no-margin\">";
	echo "<h3>Kategori</h3>
          <form method=\"POST\" enctype=\"multipart/form-data\" action=\"$link?module=barang&klik=inputkategori\">
          <table class=\"table-responsive table-bordered\">
		  <tr><td>Kategori</td> <td> <input type=\"text\" class=\"form-control input-sm\" name=\"namakategori\"></td></tr>
		  <tr><td><input type=\"submit\" class=\"btn btn-xs btn-primary\" value=\"Simpan\">
          <input type=\"button\" class=\"btn btn-xs btn-warning\" value=\"Batal\" onclick=\"self.history.back()\"></td></tr>
          </form>
		  </table>";
	echo" </div></div></div> </div> </div> ";
		 
		 $select = "select * from kategori";
		 $query = mysqli_query($koneksi,$select);
	echo"<div class=\"col-md-5\">
		<div class=\"box box-info\">
		<div class=\"box info-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
	echo"<table class=\"table no-margin\">
		
		<tr><th>Nama</th><th>Aktif </th><th>Aksi</th></tr>";
		while($h = mysqli_fetch_array($query)){
	echo"<tr><td> $h[nama]</td><td>$h[aktif]</td><td><a href=\"?module=barang&klik=editkate&id=$h[id_kategori]\">Edit</a></td></tr>";
        }
	echo"</table></div></div></div> </div> </div></div> ";
	
	
	
	}
	
	
	elseif($klik=="editkate"){
	echo"<div class=\"col-md-5\">
		<div class=\"box box-info\">
		<div class=\"box info-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
	echo"<table class=\"table no-margin\">
		<form method=\"POST\" action=\"$link?module=barang&klik=editkate\">";
		$ambil = "select * from kategori where id_kategori='$_GET[id]'";
		$query = mysqli_query($koneksi,$ambil);
		$m = mysqli_fetch_array($query);
	echo"<input type=\"hidden\" name=\"idkat\" value=\"$m[id_kategori]\" />";
	echo"<tr><td>Nama</td><td><input type=\"text\" value=\"$m[nama]\" name=\"kategori\" class=\"form-control input-sm\" /></td></tr>";	
	echo"<td>Aktif </td>
			<td> <input type=\"radio\" name=\"aktif\" value=\"N\"> N 
				 <input type=\"radio\" name=\"aktif\" value=\"Y\" checked> Y 	</td>
			</tr>";	
	echo"		<tr><td><input type=\"submit\" class=\"btn btn-xs btn-primary\" value=\"Simpan\">
          <input type=\"button\" class=\"btn btn-xs btn-warning\" value=\"Batal\" onclick=\"self.history.back()\"></td></tr>";
	echo"</form></table></div></div></div> </div> </div></div> ";
	}
	
	//habis
	elseif($klik=="habis"){
	$stok = "select id_barang,kode_barang,nama,stok from stock_barang where id_barang and stok < 6 order by stok asc";
	$query = mysqli_query($koneksi,$stok);
	echo "
		<div class=\"col-md-6\">
		<table class=\"table no-margin\">
		<form method=\"POST\" action=\"$link?module=barang&klik=tambahstok\">					 
		<tr>
		<th>Kode</th>
		<th>Nama </th>
		<th>stok</th>
		<th>Aksi</th>
		</tr>";
	while($r = mysqli_fetch_array($query)){
	echo"<input type=\"hidden\" name=\"idbar\"  value=\"$r[id_barang]\"> 
		<tr>
		<td>$r[kode_barang]</td>
		<td>$r[nama]</td>
		<td><input type=\"text\" class=\"form-control input-sm\" name=\"stokh\" value=\"$r[stok]\" ></td>
		<td><input type=\"submit\" class=\"btn btn-xs btn-primary\" value=\"Update\"></td>
		</tr>";
		}
	echo "</form>
		  </table>
		  </div>";
		
		
		}
	
	
	//edit barang
	elseif($klik=="edit"){
		$cari = "select * from stock_barang where id_barang='$_GET[id]'";
		$query = mysqli_query($koneksi,$cari);
		$r = mysqli_fetch_array($query);
		
		if($_SESSION['leveluser']=='admin'){
		echo"<div class=\"col-sm-6\">
		<div class=\"row\">
		<div class=\"box box-info\">
		<div class=\"box-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
		echo"<h2>Edit Barang </h2>
		<form method=\"POST\" action=\"$link?module=barang&klik=edit\">
		<input type=\"hidden\" name=\"id\" value=\"$r[id_barang]\">
		<table class=\"table no-margin\">
		<tr><td>Kategori </td><td><select name=\"kategori\"><option value=\"$r[id_kategori]\" selected>$r[id_kategori]</option>";
		  $select = "select * from kategori order by nama";
		  $query = mysqli_query($koneksi,$select);
		  while($y=mysqli_fetch_array($query)){
		  echo "<option value=\"$y[id_kategori]\">$y[nama]</option>";
		  }
	 echo"</select></td></tr>
		<tr><td>Kode Barang </td><td><input type=\"text\" name=\"kodebarang\" class=\"form-control input-sm\" value=\"$r[kode_barang]\" > </td></tr>

		<tr><td>Nama </td><td> <input type=\"text\" name=\"nama\" class=\"form-control input-sm\" value=\"$r[nama]\" > </td></tr>
		<tr><td>Harga Beli </td><td><input type=\"text\" name=\"hargabeli\" class=\"form-control input-sm\" value=\"$r[harga_beli]\"> </td></tr>
		<tr><td>Harga Jual </td><td><input type=\"text\" name=\"hargajual\" class=\"form-control input-sm\" value=\"$r[harga_jual]\"> </td></tr></tr>
		<tr><td>Stock </td><td> <input type=\"text\" name=\"stok\" class=\"form-control input-sm\" value=\"$r[stok]\"> </td></tr>
		<tr><td>Gambar</td><td>  <input type=\"file\" name=\"fupload\" size=\"50\"><br> -  - Apabila gambar tidak diganti, dikosongkan saja.</td></tr><tr>
		<td>Keteranagan </td><td>
		<textarea type=\"text\" class=\"form-control input-md\" name=\"ket\" value=\"\">".strip_tags($r['ket'])."</textarea></td></tr>"; 
		 echo"<tr><td colspan=\"2\"><input type=\"submit\" class=\"btn btn-xs btn-primary\" value=\"Update\">
		<input type=\"button\" value=\"Batal\" class=\" btn btn-xs btn-warning\" onclick=\"self.history.back()\">
		</td></tr>
		</form>
		</table>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>";
		
		}
	
	
	}
	
	// tampil barang
	else {
	echo"<div class=\"box-header\">
		<h3>Menejemen Barang</h3>
    <p><input type=\"button\" class=\"btn btn-xs btn-primary\" value=\"Tambah Barang\" onclick=window.location.href=\"?module=barang&klik=tambah\">
       <input type=\"button\" class=\"btn btn-xs btn-primary\" value=\"Kategori\" onclick=window.location.href=\"?module=barang&klik=kategori\">
       <input type=\"button\" class=\"btn btn-xs btn-danger\" value=\"Barang Habis\" onclick=window.location.href=\"?module=barang&klik=habis\">
	</p></div>";
	echo" <div class=\"col-md-12\">
		<div class=\"row\">
		<div class=\"box box-info\">
		<div class=\"box-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
	echo"<table class=\"table no-margin\" id=\"example1\">
          <thead>
          <tr class=\"info\">
		  <th>No</th>
		  <th>Kode Barang</th>
		  <th>Nama</th>
		  <th>Harga Beli</th>
		  <th>Harga Jual</th>
		  <th>Stok</th>
		  <th>Aksi</th>
		  </tr>
          </thead>
          <tbody>";
		$query  = "SELECT * FROM stock_barang ORDER BY id_barang";
        $tampil = mysqli_query($koneksi, $query);
		$no = 1;
		while($r=mysqli_fetch_array($tampil)){
        echo "<tr>
				<td>$no</td>
				<td>$r[kode_barang]</td>
				<td>$r[nama]</td>
				<td>$r[harga_beli]</td>
				<td>$r[harga_jual]</td>
				<td>$r[stok]</td>
				<td><a href=\"?module=barang&klik=edit&id=$r[id_barang]\">Edit</a> | <a href=\"$link?module=barang&klik=hapus&id=$r[id_barang]\">Hapus</a></td>
		
		      </tr>";
        $no++;
      }
	   echo "</tbody>
			</table>
			</div>
			</div>
			</div>
			</div>
			</div>
			";
	


	}
	
}
?>