<?php
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "anda tidak dapt mengakses halaman tersebut";  
}



else {

	$link = "modul/controller/c_user.php";
	$klik = isset($_GET['klik']) ? $_GET['klik'] : '';


if($klik=="tambah") {
	echo "<h2>Tambah User</h2>
          <form method=\"POST\" action=\"$link?module=user&klik=tambah\">
          <table>
          <tr><td>Username</td><td> : <input type=\"text\" name=\"username\"></td></tr>
          <tr><td>Password  </td><td> : <input type=\"password\" name=\"password\"></td></tr>
		  <tr><td>Nama Lengkap </td><td> : <input type=\"text\" name=\"nama_lengkap\"></td></tr>
		  <tr><td>Alamat E-Mail  </td><td> : <input type=\"text\" name=\"email\"></td></tr>
		  <tr><td>Alamat Lengkap  </td><td> : <input type=\"text\" name=\"alamat\"></td></tr>
		  <tr><td>Kota </td><td> : <input type=\"text\" name=\"kota\"></td></tr>
		  <tr><td>Kecamatan </td><td> : <input type=\"text\" name=\"kecamatan\"></td></tr>
		  <tr><td>Keabupaten </td><td> : <input type=\"text\" name=\"kabupaten\"></td></tr>
		  <tr><td>Provinsi </td><td> : <input type=\"text\" name=\"provinsi\"></td></tr>
		  <tr><td>Kode Pos </td><td> : <input type=\"text\" name=\"kode_pos\"></td></tr>
		  <tr><td>No.Telpon </td><td> : <input type=\"text\" name=\"no_telp\"></td></tr>
          <tr><td colspan=\"2\"><input type=\"submit\" class=\"btn-success\" value=\"Simpan\">
                                <input type=\"button\" class=\"btn-warning\" value=\"Batal\" onclick=\"self.history.back()\"></td></tr>
          </table>
          </form>";

	}
	//hapus
elseif($klik=="hapus") { 
	 $query = "SELECT * FROM users WHERE id_user='$_GET[id]'"; // MASIH ERROR 02/06/15 GAKBISA HAPUS DGN KONFIRMASI
     $hasil = mysqli_query($koneksi, $query);
     $ambl  = mysqli_fetch_array($hasil);
	
	echo "<form method=\"POST\" action=\"$link?module=user&klik=hapus\">
	<p> Apakah anda yakin ingin menghapus <b>$ambl[username]</b> status sebagai <b>$ambl[level] </b>? </p>
	<tr><td colspan=\"2\"><input type=\"submit\" value=\"Hapus\">
      <input type=\"button\" value=\"Batal\" onclick=\"self.history.back()\"></td></tr>
	</form>";
	
	

}

//----------- edit edit edit edit apdet user
elseif ($klik=="edit"){
	  $cari = "SELECT * FROM users WHERE id_user='$_GET[id]'";
      $hasil = mysqli_query($koneksi, $cari);
      $ambl  = mysqli_fetch_array($hasil);
	
	if($_SESSION['leveluser']=='admin'){
		echo"<div class=\"col-sm-6\">
		<div class=\"row\">
		<div class=\"box box-info\">
		<div class=\"box-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
		echo"<h2>Edit user </h2>
		<form method=\"POST\" action=\"$link?module=user&klik=edit\">
		<input type=\"hidden\" name=\"id\" value=\"$ambl[id_user]\">
		<table class=\"table no-margin\">
		<tr>
		<td>Username </td>
		<td><input type=\"text\" name=\"username\" class=\"form-control input-sm\" value=\"$ambl[username]\" disabled> </td>
		</tr>
		<tr>
		<td>password </td>
		<td> <input type=\"password\" id=\"password1\" class=\"form-control input-sm\" name=\"password\" > </td>
		</tr>
		<tr>
		<td>Cek Password</td>
		<td><input type=\"password\" class=\"form-control input-sm\" id=\"password2\"> 
		<span id=\"pass-info\"></span></td>
		</tr>
		<tr>
		<td>Nama </td>
		<td><input type=\"text\" name=\"nama_lengkap\" class=\"form-control input-sm\" value=\"$ambl[nama_lengkap]\"> </td>
		</tr>
		<tr>
		<td>E-Mail </td>
		<td><input type=\"text\" name=\"email\" class=\"form-control input-sm\" value=\"$ambl[email]\"> </td>
		</tr>
		</tr>
		<tr>
		<td>Alamat </td>
		<td> <textarea name=\"alamat\" class=\"form-control input-sm\">$ambl[alamat]</textarea> </td>
		</tr>
		</tr>
		<tr>
		<td>Kota </td>
		<td><input type=\"text\" name=\"kota\" class=\"form-control input-sm\" value=\"$ambl[kota]\"> </td>
		</tr>
		</tr>
		<tr>
		<td>Kecamatan </td>
		<td><input type=\"text\" name=\"kecamatan\" class=\"form-control input-sm\" value=\"$ambl[kecamatan]\"> </td>
		</tr>
		<td>Kabupaten </td>
		<td> <input type=\"text\" name=\"kabupaten\" class=\"form-control input-sm\" value=\"$ambl[kecamatan]\"> </td>
		</tr>
		</tr>
		<tr>
		<td>Provinsi </td>
		<td> <input type=\"text\" name=\"provinsi\" class=\"form-control input-sm\" value=\"$ambl[provinsi]\"> </td>
		</tr>
		</tr>
		<tr>
		<td>Pos </td>
		<td> <input type=\"text\" name=\"kode_pos\" class=\"form-control input-sm\" value=\"$ambl[kode_pos]\"> </td>
		</tr>
		</tr>
		<tr>
		<td>No. Telp </td>
		<td> <input type=\"text\" name=\"no_telp\" class=\"form-control input-sm\" value=\"$ambl[no_telp]\"> </td>
		</tr>";
		
		if ($ambl['blokir']== 'N') {
			echo "
			<tr>
			<td>Blokir :</td>
			<td> <input type=\"radio\" name=\"blokir\" value=\"N\" checked> N 
				 <input type=\"radio\" name=\"blokir\" value=\"Y\"> Y 	</td>
			</tr>";
			}
		else{
		echo "<tr>
		<td>Blokir :</td>
			<td> <input type=\"radio\" name=\"blokir\" value=\"N\"> N 
				 <input type=\"radio\" name=\"blokir\" value=\"Y\" checked> Y 	</td>
			</tr>";
			}
			
			
		echo "<tr><td colspan=\"2\"><input type=\"submit\" class=\"btn btn-xs btn-primary\" value=\"Update\">
		<input type=\"button\" value=\"Batal\" class=\" btn btn-xs btn-warning\" onclick=\"self.history.back()\">
		</td></tr>
		
		</form>
		</table>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		";
		
		
		}
		//userself does not aplied
	else{
		echo"<h2>Perbaharui akun anda </h2>
		<div class=\"row\">
		<div class=\"col-md-6\">
		<form method=\"POST\" id=\"defaultForm\" action=\"$link?module=user&klik=edit\">
		<input type=\"hidden\" name=\"id\" value=\"$ambl[id_user]\">
		<input type=\"hidden\" name=\"blokir\" value=\"$ambl[blokir]\">
		<table class=\"table no-margin\">
		<tr>
		<td>Username </td>
		<td><div class=\"col-md-12\"> <input type=\"text\" class=\"form-control input-sm\" name=\"username\" value=\"$ambl[username]\" disabled></div> </td>
		</tr>
		<tr>
		<td>password </td>
		<td> <div class=\"col-md-12\"><input type=\"password\" class=\"form-control input-sm\" id=\"password1\"  > </div></td>
		</tr>
		<tr>
		<td>Cek Password</td>
		<td><div class=\"col-md-12\"> <input type=\"password\" class=\"form-control input-sm\" name=\"password\" id=\"password2\">
		* Jika password tidak diubah, kosongkan saja.<br>		<span class=\"help-block\" id=\"pass-info\"></span></div></td>
		</tr>
		<tr>
		<td>Nama </td>
		<td><div class=\"col-md-12\"> <input type=\"text\" class=\"form-control input-sm\" name=\"nama_lengkap\" value=\"$ambl[nama_lengkap]\"></div> </td>
		</tr>
		<tr>
		<td>E-Mail </td>
		<td><div class=\"col-md-12\"> <input type=\"text\" class=\"form-control input-sm\" name=\"email\" value=\"$ambl[email]\"></div></td>
		</tr>
		</tr>
		<tr>
		<td>Alamat </td>
		<td><div class=\"col-md-12\"> <textarea name=\"alamat\" class=\"form-control input-sm\">$ambl[alamat]</textarea></div> </td>
		</tr>
		</tr>
		<tr>
		<td>Kota </td>
		<td><div class=\"col-md-12\"> <input type=\"text\" class=\"form-control input-sm\" name=\"kota\" value=\"$ambl[kota]\"></div> </td>
		</tr>
		</tr>
		<tr>
		<td>Kecamatan </td>
		<td><div class=\"col-md-12\"> <input type=\"text\" class=\"form-control input-sm\" name=\"kecamatan\" value=\"$ambl[kecamatan]\"></div> </td>
		</tr>
		<td>Kabupaten </td>
		<td><div class=\"col-md-12\"> <input type=\"text\" class=\"form-control input-sm\" name=\"kabupaten\" value=\"$ambl[kecamatan]\"></div> </td>
		</tr>
		</tr>
		<tr>
		<td>Provinsi </td>
		<td> <div class=\"col-md-12\"><input type=\"text\" class=\"form-control input-sm\" name=\"provinsi\" value=\"$ambl[provinsi]\"></div> </td>
		</tr>
		</tr>
		<tr>
		<td>Pos </td>
		<td><div class=\"col-md-12\"> <input type=\"text\" class=\"form-control input-sm\" name=\"kode_pos\" value=\"$ambl[kode_pos]\"> </div></td>
		</tr>
		</tr>
		<tr>
		<td>No. Telp </td>
		<td><div class=\"col-md-12\"> <input type=\"text\" class=\"form-control input-sm\" name=\"no_telp\" value=\"$ambl[no_telp]\"></div> </td>
		</tr>";
		echo "<tr><td colspan=\"2\"><input type=\"submit\" class=\"btn btn-sm btn-primary\" value=\"Update\">
		<input type=\"button\" value=\"Batal\" class=\"btn btn-sm btn-warning\" onclick=\"self.history.back()\">
		</td></tr>
		</table></form></div></div>";
		
		}
	
}

	
elseif ($klik=="detail"){
	
	echo "<h2>Detail Member<h2>";
	$sql   = "SELECT * FROM users WHERE id_user='$_GET[id]'";
	$tampil = mysqli_query($koneksi,$sql);
	  $ambl  = mysqli_fetch_array($tampil);
	 echo"<div class=\"col-sm-5\">
		<div class=\"row\">
		<div class=\"box box-info\">
		<div class=\"box-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
	echo "
		<table class=\"table no-margin\">
		<tr>
		<td>Username</td>
		<td>: $ambl[username]</td>
		</tr>
		<tr>
		<td>Nama</td>
		<td>: $ambl[nama_lengkap]</td>
		</tr>
		<tr>
		<td>E-Mail</td>
		<td>: $ambl[email] </td>
		</tr>
		<tr>
		<td>Alamat</td>
		<td>: $ambl[alamat]</td>
		</tr>
		<tr>
		<td>Kota</td>
		<td>: $ambl[kota]</td>
		</tr>
		<tr>
		<td>Kec</td>
		<td>: $ambl[kecamatan]</td>
		</tr>
		<td>Kab</td>
		<td>: $ambl[kabupaten]</td>
		</tr>
		<tr>
		<td>Prov</td>
		<td>:$ambl[provinsi]</td>
		</tr>
		<tr>
		<td>Kode Pos</td>
		<td>: $ambl[kode_pos]</td>
		</tr>
		<tr>
		<td>No Telp</td>
		<td>: $ambl[no_telp]</td>
		</tr>
		<td><th><input type=\"button\" value=\"Kembali\" class=\"btn btn-sm btn-info\" onclick=\"self.history.back()\"></th></td>
		";
		
	
	echo "</table>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>";
	
}



	
else { 
	//tampilkan profile user berdasarkan session name
	  echo "<div class=\"box-header\">
			<h3>Informasi Akun</h3>";
	  
	  if ($_SESSION['leveluser']=='admin'){
        $query  = "SELECT * FROM users ORDER BY username";
        $tampil = mysqli_query($koneksi, $query);
  echo"<p><input type=\"button\" class=\"btn btn-xs btn-primary\" value=\"Tambah User\" onclick=window.location.href=\"?module=user&klik=tambah\"></p></div>";
       }
      else{
        $query  = "SELECT * FROM users WHERE username='$_SESSION[namauser]'";
        $tampil = mysqli_query($koneksi, $query);
      }
	  $no=1;   
      
	echo"<div class=\"col-md-12\">
		<div class=\"row\">
		<div class=\"box box-info\">
		<div class=\"box-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
	  echo " <table id=\"example1\" class=\"table no-margin\">
	  <thead><tr><th>No</th><th>Username</th><th>Nama</th><th>No Telp</th><th>Status</th>";
	  if($_SESSION['leveluser']=='admin'){echo" <th>Blokir</th>"; }
		echo"<th>Aksi</th></tr></thead>";
 
      while ($ambl=mysqli_fetch_array($tampil)){  
        echo " 
				<tr>
				  <td>$no </td>
                  <td>$ambl[username]</td>
                  <td>$ambl[nama_lengkap]</td>
                  <td>$ambl[no_telp]</td>
                  <td align=\"center\">$ambl[level]</td>";
				  if($_SESSION['leveluser']=='admin'){
				echo"<td align=\"center\">$ambl[blokir]</td>"; }
				echo"<td><a href=\"?module=user&klik=edit&id=$ambl[id_user]\">Edit</a> |";
				  if($_SESSION['leveluser']=='admin'){
				echo"<a href=\"$link?module=user&klik=hapus&id=$ambl[id_user]\">Hapus</a> |";}
				echo"<a href=\"?module=user&klik=detail&id=$ambl[id_user]\">Detail</a> </td>
              </tr>
			  ";
     $no++; }
     echo "</table> 
			</div>
			</div>
			</div>
			</div>
			</div>" 
	 
	 
	 ; 
	  }

}

?>