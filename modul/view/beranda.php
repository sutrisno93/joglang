<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "login dulu";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
?>
<html>
<head>
<title>online order cart</title>
</head>
<body>
	<div class="jumbotron">
		<div class="container">
	        <p>Hallo,  aplikasi web toko cabang ini saya buat hanya sebagai media pembelajaran saya. Stok barang,pembayaran dan transaksi di aplikasi ini
		    hanya sebagai simulasi dari kinerja web.<p>
			<p>Cantumkan komentar, kritik dan saran anda.</p>
			<a class="btn btn-primary btn-md" data-toggle="modal" data-target="#yourmodal" href="#" role="button">Kritik & Saran</a></p>
      	</div>
		</div>
		
		<div class="modal fade" id="yourmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Kritik Dan Saran anda.</h4>
        </div>
        <div class="modal-body">
		<div class="row">
		<div class="col-md-4">
		<?php 
		 $link = "modul/controller/c_saran.php"; 
		 $klik = isset($_GET['klik']) ? $_GET['klik'] : ''; 
		echo"<form method=\"POST\" action=\"$link?module=saran&klik=input\">" ?>
				 <input type="radio" name="pilih" value="Saran" checked> Saran
				 <input type="radio" name="pilih" value="Kritik"> Kritik <br>
		Nama	: <input type="text" name="nama"  class="form-control input-sm" placeHolder="Nama"><br />
		E-mail	: <input type="text" name="email"  class="form-control input-sm" placeHolder="Alamat E-mail"><br />
		Pesan	: <textarea class="form-control input-sm" name="kritiksaran">Kritik Dan Saran. </textarea>
		<br>
		<input type="submit" value="Simpan" class="btn btn-sm btn-primary">
		</form>
		</div>
		</div>
		</div><div class="modal-footer"></div></div></div></div>
		
		
		<div class="row">
		<div class="col-md-7">
		<div class="box box-info">
		<div class="box-header with-border">
		<h4 class="box-title">Proses Pengiriman</h4>
		</div>
		<div class="box-body ">
		<div class="table-responsive">
	<?php $tampil = "SELECT DISTINCT `no_faktur`,`ttl_harga`,`status`,`tgl_pesan`,users.`id_user`,users.`kota`,users.`nama_lengkap` 
	FROM `pesanan`,`users` where pesanan.id_user = users.id_user order by pesanan.`tgl_pesan`";
	$hasil = mysqli_query($koneksi, $tampil);
	?>
		<table class="table no-margin">
		<thead>
		<tr>
		<th>Faktur</th>
		<th>Atas Nama</th>
		<th>Tanggal Pesan</th>
		<th>Kota Tujuan</th>
		<th>Status</th>
		</tr>
		</thead>
		<tbody>
		<?php
		while($r = mysqli_fetch_array($hasil)) {
		 if($r['status']=='mengirim'){
	echo"	<tr>
		<td>$r[no_faktur]</td>
		<td>$r[nama_lengkap]</td>
		<td>$r[tgl_pesan]</td>
		<td>$r[kota]</td>
		<td>";
					if($r['status']== 'pending') {
					echo"<span  class=\"label label-warning\">Pending</span>";
					}elseif($r['status']== 'proses'){
					echo"<span  class=\"label label-info\">Proses</span>";
					}elseif($r['status']=='mengirim'){
					echo "<span  class=\"label label-success\">Mengirim</span>";
					}else{
					echo "<span  class=\"label label-danger\">Terkirim</span> ";
					}		
		
	echo"</td>
		</tr>";
		}
		}?>
		</tbody>
		</table>
		</div>
		</div>
		</div>
		</div>
		
		<div class="col-md-5">
		<div class="box box-info">
		<div class="box-header with-border">
		<h4 class="box-title">Poll</h4>
		</div>
		<div class="box-body ">
		 <?php
		 $link = "modul/controller/c_cabang.php";
		 $klik = isset($_GET['klik']) ? $_GET['klik'] : '';  
		 
          $querytanya = "SELECT * FROM polling WHERE aktif='Y' and status='Pertanyaan'";
          $hasiltanya = mysqli_query($koneksi, $querytanya);
          $b          = mysqli_fetch_array($hasiltanya);          
          echo "<h4>$b[pilihan]</h4>";
          
          $queryjawab = "SELECT * FROM polling WHERE aktif='Y' and status='Jawaban'";
          $hasiljawab = mysqli_query($koneksi, $queryjawab);
  
  				echo "<form method=\"POST\" action=\"$link?module=cabang&klik=pilih\">";
          								
          while ($c=mysqli_fetch_array($hasiljawab)){
						echo "<input type=\"radio\" name=\"pilihan\" value=\"$c[id_pilihan]\"> $c[pilihan] <br>";  
          }                    	
          ?>
                    <br>
                   <input  class="btn btn-xs btn-success" type="submit" value="Vote">
                    <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal"  />Lihat</a>
								</form>
		
		
		</div>
		</div>
		</div>
		</div>
		
		
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
         <div class="modal-content">
        <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Hasil Poling Saat Ini :</h4>
        </div>
        <div class="modal-body">
		
   
					   

    <?php
		echo "<div class=\"post\">";
        echo "<table width=\"100%\" cellpadding=\"20\" cellspacing=\"20\">";
        $jumlahpolling = "SELECT SUM(rating) as jml_vote FROM polling WHERE aktif='Y' AND status='Jawaban'";
        $hasilpolling  = mysqli_query($koneksi, $jumlahpolling);
        $j             = mysqli_fetch_array($hasilpolling);
  
        $jml_vote=$j['jml_vote'];
  
        // tampilkan polling yang aktif
        $sql = "SELECT * FROM polling WHERE aktif='Y' AND status='Jawaban'";
        $hsl = mysqli_query($koneksi, $sql);
  
        while ($s=mysqli_fetch_array($hsl)){
          $rating = $s['rating'];
          // hitung prosentasi masing-masing polling 
  	      $prosentase = sprintf("%2.1f",(($rating/$jml_vote)*100));
  	      $gbr_vote   = $prosentase * 3;

          echo "<tr><td><br>$s[pilihan] ($prosentase %) <br></td>
				<td><br>
				<div class=\"progress-sm\">
				<div class=\"progress-bar progress-bar-aqua\" style=\"width : ".$gbr_vote."\"> </div>
				</div>
				<br></td>
                    
                </tr>";  
        }
        echo "</table>
              <br><br>
              <p>Jumlah Voting: <b>$jml_vote</b> </p>
              
              <div class=\"main-spacer\"></div>              							
						</div>";
  
    ?></div><div class="modal-footer"></div></div></div></div>
			 
			 
</body>
</html>
<?php } ?>