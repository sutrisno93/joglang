<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "login dulu";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{

include "config/koneksi.php";
 $op = $_GET['op'];
 
 if($op == "ambil"){
$pesan = "SELECT id_pembayaran FROM status_belanja
    WHERE no_faktur and konfirm='N'";
$query = mysqli_query($koneksi,$pesan);
$j	   = mysqli_num_rows($query);
if($j>0){
    echo $j;
}
}


elseif($op == "stock"){
	$stok = "select stok from stock_barang where id_barang and stok < 6 order by stok asc";
	$query = mysqli_query($koneksi,$stok);
	$s = mysqli_num_rows($query);
	if($s > 0){
	echo $s;
	}
  }
  
  
elseif($op == "order"){
	$stok = "select distinct no_faktur,tgl_pesan,nama_lengkap,baca from pesanan inner join users where pesanan.id_user = users.id_user and baca='N'";
	$query = mysqli_query($koneksi,$stok);
	$o = mysqli_num_rows($query);
	if($o > 0){
	echo $o;
	}
  }
  //notif user------------------------------
elseif($op == "notif"){
	$stok = "SELECT DISTINCT status FROM pesanan WHERE id_user = '$_SESSION[iduser]' ";
	$query = mysqli_query($koneksi,$stok);
	$n = mysqli_num_rows($query);
	if($n > 0){
	echo $n;
	}
  }



elseif($op == "tampil"){
$cari = "SELECT * FROM status_belanja WHERE no_faktur and konfirm='N'";
$query = mysqli_query($koneksi,$cari);
$j = mysqli_num_rows($query);
if($j>0){
    echo "<li>";
}else{
    die("<font color=red>Tidak ada data masuk.</font>");
}
while($p = mysqli_fetch_array($query)){
    echo "
	 <a href=\"?module=cart&klik=update&id=$p[no_faktur]\">No Nota $p[no_faktur]<br>
	<i><b>$p[nama]</b> melakukan Pembayaran 
     Pada $p[tgl_bayar] 
	 </i></a>";
}
echo "</li>";
}




elseif($op == "ordert"){
$cari = "select distinct no_faktur,tgl_pesan,nama_lengkap,baca from pesanan inner join users where pesanan.id_user = users.id_user and baca='N'";
$query = mysqli_query($koneksi,$cari);
$y = mysqli_num_rows($query);
if($y>0){
    echo "<li>";
}else{
    die("<font color=red>Empty</font>");
}
while($l = mysqli_fetch_array($query)){
    echo "
	 <a href=\"?module=cart&klik=update&id=$l[no_faktur]\">No Nota $l[no_faktur]<br>
	<i><b>$l[nama_lengkap]</b> melakukan Pemesanan
     Pada $l[tgl_pesan] 
	 </i></a>";
}
echo "</li>";
}

//notifikasi user
elseif($op == "notift"){
$cari = "SELECT DISTINCT status,no_faktur FROM pesanan WHERE id_user = '$_SESSION[iduser]'";
$query = mysqli_query($koneksi,$cari);
$w = mysqli_num_rows($query);
if($w>0){
    echo "<li>";
}else{
    die("<font color=red>Empty</font>");
}
while($g = mysqli_fetch_array($query)){
    if($g['status']=='pending'){
	echo " <a href=\"?module=cart&klik=detail&id=$g[no_faktur]&status=$g[status]\"> Nota <b> $g[no_faktur]</b> Dalam pengecekan <br>
			<span  class=\"label label-warning\">Pending</span> </a>";
	}
	elseif($g['status']=='bayar'){
	echo " <a href=\"?module=cart&klik=detail&id=$g[no_faktur]&status=$g[status]\"> Nota <b> $g[no_faktur]</b> Diperbaharui <br>
			<span  class=\"label label-danger\">Pembayaran</span> Silahkan lakukan pembayaran. </a>";
	}
	elseif($g['status']=='proses'){
	echo " <a href=\"?module=cart&klik=detail&id=$g[no_faktur]&status=$g[status]\"> Nota <b> $g[no_faktur]</b> Diperbaharui <br>
			<span  class=\"label label-info\">Proses</span> No Resi anda kami kirim disesi selanjutanya. </a>";
	}
	elseif($g['status']=='mengirim'){
	echo " <a href=\"?module=cart&klik=detail&id=$g[no_faktur]&status=$g[status]\"> Nota <b> $g[no_faktur]</b> Diperbaharui <br>
			<span  class=\"label label-success\">Mengirim</span>Silahkan cek No resi. </a>";
	}
			
			}
echo "</li>";
}

} 
?>