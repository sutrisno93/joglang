<?php
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "GAGAL";  
}

else {

	$link = "modul/controller/c_modul.php";
	$act = isset($_GET['act']) ? $_GET['act'] : ''; 
	
if($act=="tambah") {
 echo "<h2>Tambah Modul</h2>
          <form method=\"POST\" action=\"$link?module=modul&act=input\">
          <table>
          <tr><td>Nama Modul</td><td> : <input type=\"text\" name=\"nama_modul\"></td></tr>
          <tr><td>Link      </td><td> : <input type=\"text\" name=\"link\"></td></tr>
          <tr><td colspan=\"2\"><input type=\"submit\" value=\"Simpan\">
                                <input type=\"button\" value=\"Batal\" onclick=\"self.history.back()\"></td></tr>
          </table>
          </form>";
		
	}
	
	
 elseif ($act=="edit"){
	  $query = "SELECT * FROM modul WHERE id_modul='$_GET[id]'";
      $hasil = mysqli_query($koneksi, $query);
      $ambl     = mysqli_fetch_array($hasil);

      echo "<h2>Edit Modul</h2>
          <form method=\"POST\" action=\"$link?module=modul&act=edit\">
          <input type=\"hidden\" name=\"id\" value=\"$ambl[id_modul]\">
          <table>
          <tr><td>Urutan Menu</td><td> : <input type=\"text\" name=\"urutan\" value=\"$ambl[urutan]\"></td></tr>
          <tr><td>Nama Modul </td><td> : <input type=\"text\" name=\"nama_modul\" value=\"$ambl[nama_modul]\"></td></tr>
          <tr><td>Link       </td><td> : <input type=\"text\" name=\"link\" value=\"$ambl[link]\"></td></tr>";
          
      if ($ambl['status']=='admin'){
        echo "<tr><td>Status</td><td> : <input type=\"radio\" name=\"status\" value=\"admin\" checked> admin   
                                        <input type=\"radio\" name=\"status\" value=\"user\"> user </td></tr>";
      }
      else{
        echo "<tr><td>Status</td><td> : <input type=\"radio\" name=\"status\" value=\"admin\"> admin   
                                        <input type=\"radio\" name=\"status\" value=\"user\" checked> user </td></tr>";
      }
      if ($ambl['aktif']=='Y'){
        echo "<tr><td>Aktif</td><td> : <input type=\"radio\" name=\"aktif\" value=\"Y\" checked> Y   
                                       <input type=\"radio\" name=\"aktif\" value=\"N\"> N </td></tr>";
      }
      else{
        echo "<tr><td>Aktif</td><td> : <input type=\"radio\" name=\"aktif\" value=\"Y\"> Y   
                                       <input type=\"radio\" name=\"aktif\" value=\"N\" checked> N </td></tr>";
      }
      echo "<tr><td colspan=\"2\"><input type=\"submit\" value=\"edit\">
                                  <input type=\"button\" value=\"Batal\" onclick=\"self.history.back()\"></td></tr>
            </table>
            </form>";
	
	
	}
	
	//tampilkan modul
 else { 
	  echo "<div class=\"box-header\">
			<h3>Menejemen Modul</h3>
          <p><input type=\"button\" class=\"btn btn-xs btn-primary\" value=\"Tambah Modul\" onclick=window.location.href=\"?module=modul&act=tambah\"></p></div>";
            
      $query  = "SELECT * FROM modul ORDER BY urutan";
      $tampil = mysqli_query($koneksi, $query);
	  
	echo"<div class=\"col-md-12\">
		<div class=\"row\">
		<div class=\"box box-info\">
		<div class=\"box-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
	echo"<table id=\"example1\" class=\"table no-margin\">
	  <thead>
	  <tr>
	  <th>Urutan Modul</th>
	  <th>Nama Modul</th>
	  <th>Link</th>
	  <th>Status</th>
	  <th>Aktif</th>
	  <th>Aksi</th>
	  </tr>
	  </thead>
	  <tbody>";
 
      while ($r=mysqli_fetch_array($tampil)){  
        echo "
				<tr>
				  <td>$r[urutan]</td>
                  <td>$r[nama_modul]</td>
                  <td>$r[link]</td>
                  <td>$r[status]</td>
                  <td align=\"center\">$r[aktif]</td>
                  <td><a href=\"?module=modul&act=edit&id=$r[id_modul]\">Edit</a></td>
                </tr>
			  ";
      }
      echo "
        </tbody>
		</table>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	"; }
}
?>
