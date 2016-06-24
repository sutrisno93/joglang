<?php

if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "GAGAL";  
}


else {
	$link = "modul/controller/c_cart.php";
	$klik = isset($_GET['klik']) ? $_GET['klik'] : '';
	
	


	//pesan barang ->simpan ke cart_order
	if($klik=="pesan") {
		
	$cari = "SELECT * FROM stock_barang WHERE id_barang='$_GET[id]'";
    $hasil = mysqli_query($koneksi, $cari);
	
	while($ambl=mysqli_fetch_array($hasil)){
	$asd = "$ambl[harga_jual]";
	$format_harga = number_format($asd, 0, ",",".");
	 echo "
		
		
		<h2>Masukan Belanja anda</h2>
		<div class=\"col-sm-4\">
		<table class=\"table nomargin\">
		<form id=\"form\"  method=\"POST\" action=\"$link?module=order&klik=cart&id=$ambl[id_barang]\">
		<tr>
		<td>Nama </td>
		<td><input type=\"text\" class=\"form-control input-md\"  value=\"$ambl[nama]\" disabled></td>
		</tr>
		<tr>
		<td> Harga</td>
		<td><input type=\"text\" class=\"form-control input-md\" value= $format_harga disabled></td>
		</tr>
		<td> Stok</td>
		<td><input type=\"text\" class=\"form-control input-md\" value=$ambl[stok] disabled></td>
		</tr>
		<tr>
		<td>Jumlah </td>
		<td><input name=\"p-qty\" class=\"form-control input-md\"  type=\"text\"></td>
		</tr>
		
		<tr><td colspan=\"2\">
		<button type=\"submit\" class=\"btn btn-sm btn-success\">Add to Cart</button>
		<input type=\"button\" class=\"btn btn-sm btn-warning\" value=\"Batal\" onclick=\"self.history.back()\"></td></tr>
		<input type=\"hidden\"  name=\"type\" value=\"add\" />
		<input type=\"hidden\" name=\"p-kode\" value=$ambl[id_barang]></td>
		</form>
		</table>
		</div>
	";
	
	}
}
	
	
	
	
	
	
	//keranjang belanja 
	elseif($klik=="keranjang"){
	//cart order
		
		echo "<h3>Keranjang belanja anda</h3>";
	if(isset($_SESSION['produks'])){	
		echo "<div class=\"table-responsive\">";
		echo "<form method=\"POST\" action=\"$link?module=order&klik=simpan\">";
		echo "<table class=\"table table-bordered\">";
		echo "<tr  class=\"info\">
		    <th>Nama</th>
		    <th>Quantity</th>
		    <th>@Harga </th>
		    <th>Sub Total</th>
			</tr>";
					
					$sql="SELECT * FROM stock_barang WHERE id_barang IN (";
					
					foreach($_SESSION['produks'] as $id => $value) {
						$sql.=$id.",";
					}
					
					$sql=substr($sql, 0, -1).") ORDER BY nama ASC";
					$query=mysqli_query($koneksi, $sql);
					$totalprice=0;
					while($r = mysqli_fetch_array($query)){
					$asd = "$r[harga_jual]";
					$format_harga = number_format($asd, 0, ",",".");
					$subtotal=$_SESSION['produks'][$r['id_barang']]['quantity']*$r['harga_jual'];					
					$totalprice+=$subtotal;
	echo "<tr><td  class=\"success\">$r[nama]</td>";
	echo "<td><input type=\"text\" name=\"update".$r['id_barang']."\" value='".$_SESSION['produks'][$r['id_barang']]['quantity']."' disabled></td>";
    echo"<td class=\"success\">Rp $format_harga,-</td>";					
	echo"<td>Rp ".number_format($subtotal, 0, ",",".").",-</td>";			   
	echo"<input type=\"hidden\" name=\"nama[]\" value=$r[nama]>";
	echo"<input type=\"hidden\" name=\"nofaktur\" value=\"431265\">";
	echo"<input type=\"hidden\"  value=$r[harga_jual]>";
	echo"<input type=\"hidden\" name=\"subtotal[]\" value=$subtotal>";
	echo"<input type=\"hidden\" name=\"total\" value=$totalprice>";
	echo"<input type=\"hidden\" name=\"quantity[]\" value='".$_SESSION['produks'][$r['id_barang']]['quantity']."'>";
	echo"<input type=\"hidden\" name=\"id_barang[]\" value=$r[id_barang]>";
	echo"<input type=\"hidden\" name=\"id_user[]\" value='".$_SESSION['iduser']."'>";
		}
	echo"<tr class=\"info\">
	<td>Total Belanja: Rp ".number_format($totalprice, 0, ",",".")." </td>";
	echo"</tr>";
	echo "</table>";
	echo "<button type=\"submit\" class=\"btn btn-xs btn-success\">Order!</button>";
	echo "</form>";
	echo "</div";	
	}else{
	echo "Your cart is empty.";
	}
}
 else { 
	echo"<div class=\"box-header\">
	<h3>Order Belanja</h3>	
	</div>";  
	

	echo"<p><input type=\"button\" class=\"btn btn-xs btn-primary\" value=\"Keranjang Belanja\" onclick=window.location.href=\"?module=order&klik=keranjang\"> 
		 <select id=\"kode\"></select></p>";
	 
	
	echo"<div class=\"row\">
		<div class=\"col-md-12\">
	 <div id=\"status\"></div>
		<div class=\"box box-default\" id=\"koder\">
		 <div class=\"text-center\">Pilih Kategori untuk memilih item.</div>";
	//data barang ajax...
	
	echo"</div></div></div></div>";
	
	}
}
?>