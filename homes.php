<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){echo "login dulu";}else{?>
<html>
<head>
<title>Joglang Online Shop</title>
<meta charset="UTF-8">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />   
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link href="dist/css/skins/_all-skins.css" rel="stylesheet" type="text/css" />
<link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
<link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<link href="css/pass-checker.css" rel="stylesheet" type="text/css" /> 
<link href="css/bootstrapValidator.css" rel="stylesheet" type="text/css" />
</head>
<body class="skin-purple sidebar-mini">
<div class="wrapper">			
		<header class="main-header">
			<a href="?module=beranda" class="logo">
			<span class="logo-mini"><b>J</b>OS</span>
			<span class="logo-lg"><b>Joglang</b>Shop</span>
			</a>
			<nav class="navbar navbar-static-top" role="navigation">
					<!------- side bar toogle-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<!-- menu kanan notifikasi--->
				<?php	if ($_SESSION['leveluser']=='admin'){ ?>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						  <li class="dropdown notifications-menu">
							<a href="?module=barang&klik=habis">
								<i class="glyphicon glyphicon-exclamation-sign "></i>
								<span class="label label-danger" id="stock"></span>
							</a>
							<!---mulai dari sini --->
							<ul class="dropdown-menu" id="info">
							</ul>
						  </li>
					</ul>
				</div>
				<?php } ?>
			<?php	if ($_SESSION['leveluser']=='admin'){ ?>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						  <li class="dropdown notifications-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="pesan">
								<i class="glyphicon glyphicon-usd"></i>
								<span class="label label-success" id="notifikasi"></span>
							</a>
							<!---mulai dari sini --->
							<ul class="dropdown-menu" id="info">
									<li>
                    		<!-- inner menu: data pesan dari database-->
									<ul class="menu" id="konten-info">
									<div id="loading"><br><img src="load2.gif"></div>  
									</ul>
									</li>
							<li class="footer"><a href="?module=cart&klik=pembayaran">View all</a></li>
							</ul>
						  </li>
					</ul>
				</div>
				<?php } ?>
				
				<?php	if ($_SESSION['leveluser']=='admin'){ ?>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						  <li class="dropdown notifications-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="order">
								<i class="glyphicon glyphicon-save "></i>
								<span class="label label-info" id="ordero"></span>
							</a>
							<ul class="dropdown-menu" id="tampilorder">
									<li>
                
									<ul class="menu" id="konten-order">
									<div id="loading"><br><img src="load2.gif"></div>  
									</ul>
									</li>
							<li class="footer"><a href="?module=cart">View all</a></li>
							</ul>
						  </li>
					</ul>
				</div>
				<?php } ?>				
				<?php	if ($_SESSION['leveluser']=='user'){ ?>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						  <li class="dropdown notifications-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="notif">
								<i class="glyphicon glyphicon-bell"></i>
								<span class="label label-danger" id="notifo"></span>
							</a>
							<ul class="dropdown-menu" id="tampilnotif">
									<li>
                
									<ul class="menu" id="konten-notif">
									<div id="loading"><br><img src="load2.gif"></div>  
									</ul>
									</li>
							<li class="footer"><a href="?module=cart">View all</a></li>
							</ul>
						  </li>
					</ul>
				</div>
				<?php } ?>
			</nav>
		</header>
			<aside class="main-sidebar">
				 <section class="sidebar">
					<div class="user-panel">
					<div class="pull-left image">
						 <img src="dist/img/PSS.jpg" class="img-circle" alt="User Image" />
					</div>
						<div class="pull-left info">
						<p><?php
							echo  "<p> Selamat Datang<br /><b>$_SESSION[namalengkap]</b></p>"; 
							?>
						</p>
						</div>
					</div>			
					<ul class="sidebar-menu">
						<li class="header">Menu</li>
						
						<li><a href="?module=beranda"> <i class="fa fa-envelope"></i> <span>Beranda</span> </a></li>
								<?php include "menu.php"; ?>
						<li><a href="logout.php"> <i class="fa fa-envelope"></i> <span>Keluar</span></a></li>
					</ul>
					
					
		
				</section>
			</aside>
			<div class="content-wrapper">
			<section class="content">
			<?php include "content.php"; ?>
			</section>
			</div>
</div>
 <footer class="main-footer">
<div class="pull-right hidden-xs">
 Developed by <a href="mailto:sutrisnosepta@gmail.com">Sutrisno Septa Prasetyo</a>
</div>
<strong>Special thanks to <a href="http://almsaeedstudio.com"> Almsaeed Studio</a></strong>
 & <strong> <a href="http://bukulokomedia.com/"> Cms Lokomedia</a>.</strong></footer>
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>  
<script src="plugins/dataTables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/dataTables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="css/js/pass-checker.js" type="text/javascript"></script>
<script src="css/js/notif.js" type="text/javascript"></script>
<script src="css/js/c_order.js" type="text/javascript"></script>
<script src="css/js/bootstrapValidator.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
 $('#defaultForm').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: { valid: 'glyphicon glyphicon-ok', invalid: 'glyphicon glyphicon-remove', validating: 'glyphicon glyphicon-refresh'  },
        fields:{
		email:{validators:{emailAddress:{message:'Alamat E-mail Tidak Valid.'}}},
		nama_lengkap:{validators:{notEmpty:{message: 'Nama Tidak Boleh Kosong.'}}},
		alamat:{validators:{notEmpty:{message: 'Alamat Tidak Boleh Kosong.'}}},
		kota:{validators:{notEmpty: {message:'Kota Tidak Boleh Kosong.'}}},
		kecamatan:{validators:{notEmpty:{message:'Kecamatan Tidak Boleh Kosong.'}}},
		kabupaten:{validators:{ notEmpty:{message: 'Kabupaten Tidak Boleh Kosong.'}}},
		provinsi:{validators:{notEmpty:{message: 'Provinsi Tidak Boleh Kosong.'}}},
		kode_pos:{ validators:{notEmpty:{message: 'Kode Pos Tidak Boleh Kosong.'}}},
		no_telp:{validators:{notEmpty: {message: 'No Telepon Tidak Boleh Kosong.'}}},
		}});});
</script>
<script type="text/javascript" charset="utf-8">
$(function () {
$("#example2").dataTable();$('#example1').dataTable({"sPaginationType": "full_numbers", "oLanguage": {
 "sLengthMenu": "Tampilkan _MENU_ data","sSearch": "Pencarian: ", "sZeroRecords": "Tidak ditemukan data yang sesuai","sInfo": "", "sInfoEmpty": "","sInfoFiltered": "",
 "oPaginate": {"sFirst": "Awal","sLast": "Akhir", "sPrevious": "Balik", "sNext": "Lanjut"}}});});</script>
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="dist/js/app.min.js" type="text/javascript"></script>   
</body>
</html>
<?php } ?>