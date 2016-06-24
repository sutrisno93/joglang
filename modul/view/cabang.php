<?php
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "gagal!";  
}

	else {
		$link = "modul/controller/c_cabang.php";
		$klik = isset($_GET['klik']) ? $_GET['klik'] : ''; 
	//tambah polling
	if($klik=="tambah") {
		 echo "<h2>Tambah Polling</h2>
          <form method=\"POST\" action=\"$link?module=cabang&klik=tambah\">
          <table>
          <tr><td>Pilihan</td><td> : <input type=\"text\" name=\"pilihan\"></td></tr>
          <tr><td>Status </td><td> : <input type=\"radio\" name=\"status\" value=\"Jawaban\" checked> Jawaban  
                                     <input type=\"radio\" name=\"status\" value=\"Pertanyaan\"> Pertanyaan </td></tr>
          <tr><td colspan=\"2\"><input type=\"submit\" value=\"Simpan\">
                                <input type=\"button\" value=\"Batal\" onclick=\"self.history.back()\"></td></tr>
          </table>
          </form>";
	}
	//edit
	elseif($klik=="edit"){
	  $query = "SELECT * FROM polling WHERE id_pilihan='$_GET[id]'";
      $hasil = mysqli_query($koneksi, $query);
      $r     = mysqli_fetch_array($hasil);
	  
	    echo "<h2>Edit Polling</h2>
          <form method=\"POST\" action=\"$link?module=cabang&klik=edit\">
          <input type=\"hidden\" name=\"id\" value=\"$r[id_pilihan]\">
          <table>
          <tr><td>Pilihan</td><td> : <input type=\"text\" name=\"pilihan\" value=\"$r[pilihan]\"></td></tr>";
          
      if ($r['status']=='Jawaban'){
        echo "<tr><td>Status</td><td> : <input type=\"radio\" name=\"status\" value=\"Jawaban\" checked> Jawaban   
                                        <input type=\"radio\" name=\"status\" value=\"Pertanyaan\"> Pertanyaan </td></tr>";
      }
      else{
        echo "<tr><td>Status</td><td> : <input type=\"radio\" name=\"status\" value=\"Jawaban\"> Jawaban   
                                        <input type=\"radio\" name=\"status\" value=\"Pertanyaan\" checked> Pertanyaan </td></tr>";
      }
      if ($r['aktif']=='Y'){
        echo "<tr><td>Aktif</td><td> : <input type=\"radio\" name=\"aktif\" value=\"Y\" checked> Y   
                                       <input type=\"radio\" name=\"aktif\" value=\"N\"> N </td></tr>";
      }
      else{
        echo "<tr><td>Aktif</td><td> : <input type=\"radio\" name=\"aktif\" value=\"Y\"> Y   
                                       <input type=\"radio\" name=\"aktif\" value=\"N\" checked> N </td></tr>";
      }
      echo "<tr><td colspan=\"2\"><input type=\"submit\" value=\"Update\">
                                  <input type=\"button\" value=\"Batal\" onclick=\"self.history.back()\"></td></tr>
            </table>
            </form>";
	
	
	}
	//polling
	else{
	echo"<p><input type=\"button\" value=\"Tambah Polling\" onclick=window.location.href=\"?module=cabang&klik=tambah\"></p>
		<div class=\"row\">
		<div class=\"col-md-8\">
		<div class=\"box box-info\">
		<div class=\"box info-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
	echo"<table class=\"table no-margin\">";	
	$cari = "select * from polling order by status";
	$query = mysqli_query($koneksi,$cari);
	echo"
		<tr>
		<th>Pilihan</th>
		<th>Status</th>
		<th>Rating</th>
		<th>Aktif</th>
		<th>Aksi</th>
		</tr>
	
	";
	while($r = mysqli_fetch_array($query)){
	echo"<tr>
		 <td>$r[pilihan]</td>
		 <td>$r[status]</td>
		 <td>$r[rating]</td>
		 <td>$r[aktif]</td>
		<td> <a href=\"?module=cabang&klik=edit&id=$r[id_pilihan]\">Edit</a> | 
	         <a href=\"$link?module=cabang&klik=hapus&id=$r[id_pilihan]\">Hapus</a></td>
		</tr>";
	}
	echo "
		</form>
		</table>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>";
	}
	
	
}	
?>