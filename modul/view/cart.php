<?php
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "GAGAL";  
}


else {
	$link = "modul/controller/c_cart.php";
	$klik = isset($_GET['klik']) ? $_GET['klik'] : '';

	if($klik=="detail") {
	//detail pembayaran  halaman user
	$cari = "SELECT  quantity,ttl_harga,tgl_pesan,nama,harga_jual FROM stock_barang INNER JOIN pesanan
				on 	stock_barang.id_barang = pesanan.id_barang WHERE no_faktur='$_GET[id]'";
	$hasil = mysqli_query($koneksi, $cari);
	$total=0;
	echo "<h3>Status Belanja Anda</h3>";
	echo"<div class=\"col-md-11\">
		<div class=\"row\">
		<div class=\"box box-info\">
		<div class=\"box info-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
	echo"<table class=\"table no-margin\">";
	echo"<tr class=\"info\">
			<th> Nama Barang</th>
		    <th>Harga</th>
		    <th>Jumlah</th>
		    <th>SubTotal</th>
		    <th>Tanggal pesan</th>
		    
		</tr>";
	while($r = mysqli_fetch_array($hasil)){
		 echo "
		 <tr class=\"success\">
		    <td>$r[nama]</td>
		    <td>Rp ".number_format($r['harga_jual'], 0, ",",".")."</td>
		    <td>$r[quantity]</td>
		    <td>Rp ".number_format($subtotal=$r['quantity']*$r['harga_jual'], 0, ",",".")."</td>
		    <td>$r[tgl_pesan]</td>
		    
		</tr>";
		$total+=$subtotal;
		}
		
	echo"<tr class=\"info\">";
		
	echo"<th>Total Belanja :Rp ".number_format($total, 0, ",",".")."</th>
		<th><input type=\"button\" value=\"Kembali\" class=\"btn btn-xs btn-warning\" onclick=\"self.history.back()\"></th>
		</tr>
		</table>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>";
		
		
		//form detail pemesanan/data pemesan----------------------------------
		echo"
		<div class=\"row\">
		<div class=\"col-md-6\">
		<div class=\"box box-info\">
		<div class=\"box info-header with-border\">
		<h3 class=\"box-title\"> Detail Pemesanan </h3>			</div>
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
		echo"<table class=\"table no-margin\">";
		$cari ="SELECT distinct  nama_lengkap,email,alamat,kode_pos,no_telp,tgl_pesan,ttl_harga,status FROM users INNER JOIN pesanan
			on 	users.id_user = pesanan.id_user WHERE no_faktur='$_GET[id]'";
		$hasil = mysqli_query($koneksi, $cari);	
		while($r = mysqli_fetch_array($hasil)){
		echo"<tr class=\"\">
			<td>Nama</td>
			<td><input type=\"text\" class=\"form-control input-md\" name=\"namalengkap\" value=\"$r[nama_lengkap]\" disabled></td>
		    </tr>
			<tr class=\"info\">
			<td>E-mail</td>
			<td><input type=\"text\" class=\"form-control input-md\" name=\"email\" value=\"$r[email]\" disabled></td>
		    </tr>
			<tr class=\"\">
			<td>Alamat</td>
			<td><input type=\"text\" class=\"form-control input-md\" name=\"alamat\" value=\"$r[alamat]\" disabled></td>
		    </tr>
			<tr class=\"info\">
			<td>Kode Pos</td>
			<td><input type=\"text\" class=\"form-control input-md\" name=\"kodepos\" value=\"$r[kode_pos]\" disabled></td>
		    </tr>
			<tr class=\"\">
			<td>Tanggal Pesan</td>
			<td><input type=\"text\" class=\"form-control input-md\" name=\"tglpesan\" value=\"$r[tgl_pesan]\" disabled></td>
		    </tr>
			<tr class=\"info\">
			<td>Total Belanja</td>
			<td><input type=\"text\" class=\"form-control input-md\" name=\"ttlbelanja\" value=\"Rp ".number_format($r['ttl_harga'], 0, ",",".")."\" disabled></td>
		    </tr>
			<tr class=\"\">
			<td>No Telp</td>
			<td><input type=\"text\" class=\"form-control input-md\" name=\"notelp\" value=\"$r[no_telp]\" disabled></td>
		    </tr>
			";
			}
		echo"
		</table>
		</div>
		</div>
		
		</div>
		</div>";
		
		//aaaaaaaaaaaaaaaaaaaaaaaaaa konfirmasi
		if($_GET['status']=='bayar'){
		$cari ="SELECT distinct  nama_lengkap,email,alamat,kode_pos,no_telp,tgl_pesan,ttl_harga,status FROM users INNER JOIN pesanan
			on 	users.id_user = pesanan.id_user WHERE no_faktur='$_GET[id]'";
		$hasil = mysqli_query($koneksi, $cari);
	echo"
		<div class=\"col-md-6\">
		<div class=\"box box-warning\">
		<div class=\"box info-header with-border\">
		<h3 class=\"box-title\"> Konfirmasi Pembayaran </h3></div>
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
		echo"<table class=\"table no-margin\">
		<form method=\"POST\" action=\"$link?module=cart&klik=konfirm\">";
		while($r = mysqli_fetch_array($hasil)){
	echo"
		<input type=\"hidden\" name=\"id\" value=\"$_GET[id]\">
		<input type=\"hidden\" name=\"nama\" value=\"$r[nama_lengkap]\">
		<input type=\"hidden\" name=\"alamat\" value=\"$r[alamat]\">
		<input type=\"hidden\" name=\"kodepos\" value=\"$r[kode_pos]\">
		<input type=\"hidden\" name=\"tglpesan\" value=\"$r[tgl_pesan]\">";
		
		echo"<tr class=\"\">
			<td>Tanggal Bayar</td>
			<td><input type=\"text\" class=\"form-control input-md\" name=\"\" placeHolder=\"konfirmasi\" value=\"".date("d-M-Y")."\" disabled></td>
		    </tr>
			<tr class=\"info\">
			<td>Dari Rekening</td>
			<td><input type=\"text\" class=\"form-control input-md\" name=\"dari\" placeHolder=\"konfirmasi\" value=\"\"></td>
		    </tr>
			<tr class=\"\">
			<td>Rekening Tujuan</td>
			<td><select class=\"form-control\" name=\"kepada\">
			<option>BRI 2487455489758 A/N Sutrisno Septa Prasetyo</option>
			<option>BNI 5456464145444 A/N Sutrisno Septa Prasetyo</option>
			<option>BCA 6449548445888 A/N Sutrisno Septa Prasetyo</option>
			</select></td>
		    </tr>
			<tr class=\"info\">
			<td>Jumlah Pembayaran</td>
			<td><input type=\"text\" class=\"form-control input-md\" name=\"nominal\" placeHolder=\"Tidak usah pakai titik(.) Ex: 2000000\" value=\"\"></td>
		    </tr>
			<tr class=\"\">
			<td>Note</td>
			<td><textarea class=\"form-control input-md\" name=\"note\" placeHolder=\"Note...\" value=\"Pesan\"></textarea></td>
		    </tr>"; }
		echo "<tr><td colspan=\"2\"><input type=\"submit\" class=\"btn btn-xs btn-primary\" value=\"Konfirmasi\">
		<input type=\"button\" value=\"Batal\" class=\" btn btn-xs btn-warning\" onclick=\"self.history.back()\"></br>
		*Produk yang sudah dipesan dan dikonfirmasi tidak dapat diBatalkan.
		</td></tr>";	
		
		echo"</form>
		</table>
		</div>
		</div>
		</div>
		</div>
		</div>"; 
		}
		
		elseif($_GET['status']=='proses' or $_GET['status']=='mengirim'){
		
		echo "<div class=\"col-md-5\">";
		//memanggil data tabel status pembayaran dan pesanan
		$cari = "select * from status_belanja WHERE no_faktur='$_GET[id]' ";
		$query = mysqli_query($koneksi,$cari);
		$r = mysqli_fetch_array($query);
		echo"
		<div class=\"nav-tabs-custom\">
			<ul class=\"nav nav-tabs\">
				<li class=\"active\"> <a href=\"#home\"  data-toggle=\"tab\"  aria-expanded=\"true\"> Home</a></li>
				<li class=\"\">		  <a href=\"#daggg\" data-toggle=\"tab\"  aria-expanded=\"false\"> Pesan</a></li>
				<li class=\"\">		  <a href=\"#doggg\" data-toggle=\"tab\"  aria-expanded=\"false\"> No resi</a></li>
				
			</ul>
			<div class=\"tab-content\">
			<div id=\"home\" class=\"tab-pane active\">
			<dl class=\"dl-horizontal\">
			<dt>No Faktur</dt>
			<dd>: $r[no_faktur]</dd>
			<dt>Tanggal</dt>
			<dd>: $r[tgl_bayar]</dd>
			<dt>Nama</dt>
			<dd>: $r[nama] </dd>
			<dt>Dari</dt>
			<dd>: $r[trans_dari] </dd>
			<dt>Kepda</dt>
			<dd>: $r[trans_kepada] </dd>
			<dt>Nominal</dt>
			<dd>: ".number_format($r['jml_bayar'], 0, ",",".")." </dd>
			<dl>
			</div>
			
			<div id=\"daggg\" class=\"tab-pane\">
			<p>$r[ket]</p>
			</div>
			
			<div id=\"doggg\" class=\"tab-pane\">";
			
			if($r['no_resi']=='' or $_GET['status']!='mengirim'){
			echo "Belanja Anda Masih dalam Proses";
			}else{
			echo "<p> $r[no_resi] </p>";
			}
			
		echo"</div>
			</div>
			</div>"; 
		}
		
		//barang terkirim
		else{
		
		echo "<div class=\"col-md-5\">
		<div class=\"box box-success\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
		echo "<h3>Terima Kasih Atas Belanja Anda.</h3>";
		
		echo"
		</div>
		</div>
		</div>
		</div>
		</div>";
			}
		// ahir halaman detail pesanan untuk user!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	}
	
	
	//update status belanja----------------------------------------------------
	elseif($klik=="update"){
	$cari = "SELECT  quantity,ttl_harga,tgl_pesan,nama,harga_jual FROM stock_barang INNER JOIN pesanan
				on 	stock_barang.id_barang = pesanan.id_barang WHERE no_faktur='$_GET[id]'";
	$hasil = mysqli_query($koneksi, $cari);
	$total=0;
	echo "<h3>Status Belanja Anda</h3>";
	echo"<div class=\"row\">
		<div class=\"col-md-11\">
		<div class=\"box box-info\">
		<div class=\"box info-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
	echo"<table class=\"table no-margin\">";
	echo"<tr class=\"info\">
			<th> Nama Barang</th>
		    <th>Harga</th>
		    <th>Jumlah</th>
		    <th>SubTotal</th>
		    <th>Tanggal pesan</th>
		    
		</tr>";
	while($r = mysqli_fetch_array($hasil)){
		 echo "
		 <tr class=\"success\">
		    <td>$r[nama]</td>
		    <td>Rp ".number_format($r['harga_jual'], 0, ",",".")."</td>
		    <td>$r[quantity]</td>
		    <td>Rp ".number_format($subtotal=$r['quantity']*$r['harga_jual'], 0, ",",".")."</td>
		    <td>$r[tgl_pesan]</td>
		    
		</tr>";
		$total+=$subtotal;
		}
		
	echo"<tr class=\"info\">";
		
	echo"<th>Total Belanja :Rp ".number_format($total, 0, ",",".")."</th>
		<th><input type=\"button\" value=\"Kembali\" class=\"btn btn-xs btn-warning\" onclick=\"self.history.back()\"></th>
		</tr>
		</table>
		</div>
		</div>
		</div>
		</div>
		</div>";
		
	
	
	//
	$cari = "SELECT  no_faktur,quantity,ttl_harga,tgl_pesan,nama,status FROM stock_barang INNER JOIN pesanan
					ON 	stock_barang.id_barang = pesanan.id_barang WHERE no_faktur='$_GET[id]'";
		$hasil = mysqli_query($koneksi, $cari);
		$r  = mysqli_fetch_array($hasil);
	echo"<div class=\"col-md-4\">
		<div class=\"box box-info\">
		<div class=\"box info-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
	echo"<form method=\"POST\" action=\"$link?module=cart&klik=update\">
		<input type=\"hidden\" name=\"id\" value=\"$r[no_faktur]\">
		<table class=\"table no-margin\">";
	echo"<tr>
		<td>No Faktur </td>
		<td>$r[no_faktur]</td>
		</tr>
		<tr>
		<td>Status </td>
		<td>$r[status]</td>
		</tr>
		<tr>
		<td>Total Belanja </td>
		<td> Rp ".number_format($r['ttl_harga'], 0, ",",".")."</td>
		</tr>
		<tr>
		<td>Status </td>
		<td><input type=\"radio\" name=\"status\" value=\"pending\" checked> Pending 
		<input type=\"radio\" name=\"status\" value=\"bayar\" > Pembayaran <br>
		<input type=\"radio\" name=\"status\" value=\"proses\" > Proses 
		<input type=\"radio\" name=\"status\" value=\"mengirim\" > Mengirim <br>
		<input type=\"radio\" name=\"status\" value=\"terkirim\"> Terkirim	</td>
		</tr>
		<tr><td colspan=\"2\"><input type=\"submit\" class=\"btn btn-xs btn-primary\" value=\"Update\">
		<input type=\"button\" value=\"Batal\" class=\"btn btn-xs btn-warning\" onclick=\"self.history.back()\">
		<span id=\"pass-info\"></span></td></tr>";
	echo"</table>
		</form>
		</div>
		
		</div>
		</div>
		</div>
		</div>";
		
		$y = "UPDATE pesanan SET baca='Y' WHERE no_faktur='$_GET[id]'";
		mysqli_query($koneksi, $y); 	
		

		if($r['status']=='bayar'  or $r['status']=='proses'  ){
		echo "<div class=\"col-md-7\">";
		
		//memanggil data tabel status pembayaran dan pesanan
		$cari = "select * from status_belanja WHERE no_faktur='$_GET[id]' ";
		$query = mysqli_query($koneksi,$cari);
		$r = mysqli_fetch_array($query);
		echo"
		<div class=\"nav-tabs-custom\">
			<ul class=\"nav nav-tabs\">
				<li class=\"active\"> <a href=\"#home\"  data-toggle=\"tab\"  aria-expanded=\"true\"> Home</a></li>
				<li class=\"\">		  <a href=\"#daggg\" data-toggle=\"tab\"  aria-expanded=\"false\"> Pesan</a></li>
				<li class=\"\">		  <a href=\"#doggg\" data-toggle=\"tab\"  aria-expanded=\"false\"> No resi</a></li>
				
			</ul>
			<div class=\"tab-content\">
			<div id=\"home\" class=\"tab-pane active\">
			<dl class=\"dl-horizontal\">
			<dt>No Faktur</dt>
			<dd>: $r[no_faktur]</dd>
			<dt>Tanggal</dt>
			<dd>: $r[tgl_bayar]</dd>
			<dt>Nama</dt>
			<dd>: $r[nama] </dd>
			<dt>Dari</dt>
			<dd>: $r[trans_dari] </dd>
			<dt>Kepda</dt>
			<dd>: $r[trans_kepada] </dd>
			<dt>Nominal</dt>
			<dd>: ".number_format($r['jml_bayar'], 0, ",",".")." </dd>
			<dl>
			</div>
			
			<div id=\"daggg\" class=\"tab-pane\">
			<p>$r[ket]</p>
			</div>
			<div id=\"doggg\" class=\"tab-pane\">";
			if($r['no_resi']==''){
			echo "<form method=\"POST\" action=\"$link?module=cart&klik=inputresi\" >
				<input type=\"hidden\" name=\"no_fak\" value=\"$r[no_faktur]\">
				<input type=\"text\" name=\"noresi\" >
				<tr><td colspan=\"2\"><input type=\"submit\" class=\"btn btn-xs btn-primary\" value=\"Update\">
				<input type=\"button\" value=\"Batal\" class=\"btn btn-xs btn-warning\" onclick=\"self.history.back()\">
				<span id=\"pass-info\"></span></td></tr>
				</form>
			
			
			
			";
			}else{
			echo "<p> $r[no_resi] </p>";
			}
			
			
			
		echo"</div>
			</div>
		</div>		
		</div>
		</div>"; 
		}
		
		
	}
	
	
	//pembayaran--------------------
	elseif($klik=="pembayaran"){
	$cari = "select * from status_belanja";
	$query = mysqli_query($koneksi,$cari);
	
	echo"<div class=\"col-lg-12\">
		<div class=\"row\">
		<div class=\"box box-info\">
		<div class=\"box info-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
	echo"<table class=\"table no-margin\">";
	echo"
		<tr>
		<th>No Faktur</th>
		<th>Nama Pemesan</th>
		<th>Tanggal Pesan</th>
		<th>Tanggal Bayar</th>
		<th>Dari</th>
		<th>Kepada</th>
		<th>Bayar Rp</th>
		<th class=\"danger\">Note</th>
		</tr>
	
	";
	while($r = mysqli_fetch_array($query)){
echo"	<tr>
		<td><a href=\"?module=cart&klik=update&id=$r[no_faktur]\">$r[no_faktur]</a></td>
		<td>$r[nama]</td>
		<td>$r[tgl_pesan]</td>
		<td>$r[tgl_bayar]</td>
		<td>$r[trans_dari]</td>
		<td>$r[trans_kepada]</td>
		<td>".number_format($r['jml_bayar'], 0, ",",".")."</td>
		<td class=\"danger\"><b> ".strip_tags($r['ket'])." </b></td>
		</tr>";
	}
	echo"</table>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>";
		
	
	}
	
	
	else{
		//tampilan tidak sesuai database. masih error. faak(done!)
		// menampilkan data pesanna berdasarkan data pesanan pembeli(done!)
		//status : re-check!
	echo "<h3>Status Belanja</h3>";
	
	if ($_SESSION['leveluser']=='admin'){
        $tampil = "SELECT DISTINCT `no_faktur`,`ttl_harga`,`status`,`tgl_pesan`,users.`id_user` 
	FROM `pesanan`,`users` where pesanan.id_user = users.id_user order by pesanan.`tgl_pesan`";
	$hasil = mysqli_query($koneksi, $tampil);
	echo "<input type=\"button\" class=\"btn btn-xs btn-primary\" value=\"Pembayaran\" onclick=window.location.href=\"?module=cart&klik=pembayaran\"></p>";
		
      }
      else{
       $tampil = "SELECT DISTINCT `no_faktur`,`ttl_harga`,`status`,`tgl_pesan`,users.`id_user` 
	FROM `pesanan`,`users` where pesanan.`id_user`='$_SESSION[iduser]' = users.id_user order by pesanan.`id_user`='$_SESSION[iduser]'";
	$hasil = mysqli_query($koneksi, $tampil);	
      }
	 echo"<div class=\"col-md-11\">
		<div class=\"row\">
		<div class=\"box box-info\">
		<div class=\"box-header with-border\">
		<div class=\"box-body \">
		<div class=\"table-responsive\">";
		echo"<table class=\"table no-margin\"> 
			<tr>
				<th>No Faktur</th>
				<th>Tanggal Pesan</th>
				<th>Total Belanja</th>
				<th>Status</th>
				<th>Aksi</th>
				
			  </tr>";
			  

		while($r=mysqli_fetch_array($hasil)){
		echo "
				<tr>
				<td>$r[no_faktur]</td>
				<td>$r[tgl_pesan]</td>
				<td>Rp ".number_format($r['ttl_harga'], 0, ",",".")."</td>
				<td>";
					if($r['status']== 'pending') {
					echo"<span  class=\"label label-warning\">Pending</span>";
					}elseif($r['status']== 'bayar'){
					echo"<span  class=\"label label-danger\">Pembayaran</span>";
					}elseif($r['status']== 'proses'){
					echo"<span  class=\"label label-info\">Proses</span>";
					}elseif($r['status']=='mengirim'){
					echo "<span  class=\"label label-success\">Mengirim</span>";
					}else{
					echo "<span  class=\"label label-danger\">Terkirim</span> ";
					}
			echo"</td>
				<td><a href=\"?module=cart&klik=detail&id=$r[no_faktur]&status=$r[status]\">Detail</a>";
				if($_SESSION['leveluser']=='admin'){
			echo" | <a href=\"?module=cart&klik=update&id=$r[no_faktur]\">Update</a>"; }	
			
			echo"</td>
				</tr>";
			}
		echo "</table>
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>";
			if ($_SESSION['leveluser']=='user'){	
	 echo"<div class=\"col-sm-6\">
		<div class=\"row\">
		<div class=\"box box-danger\">
		<div class=\"box-header with-border\">
		<div class=\"box-body \">";
		
		echo "
		<h3>Keterangan  :</h3>
		Status <span  class=\"label label-warning\">Pending</span> 			: Belum diproses oleh admin, <b>Jangan</b> melakukan pembayaran.<br>
		Status <span  class=\"label label-danger\">Pembayaran</span>	 	: Anda bisa melakukan Pembayaran disesi ini.<br>
		Status <span  class=\"label label-info\">Proses</span>	   			: Pesanan anda dalam proses siap kirim.<br>
		Status <span  class=\"label label-success\">Mengirim</span>			: Pesanan sudah dikirim, dan anda dapat No Resi.<br>
		Status <span  class=\"label label-danger\">Terkirim</span>		    : Transaksi anda berhasil, dan barang sudah sampai.<br>
		*Pergantian Status ditentukan oleh admin.";}
		echo "</table>
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>";
	}
	
	
}
?>