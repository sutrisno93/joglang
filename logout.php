<!DOCTYPE html>
<html>
<title>Samoedra Group</title>
<head>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />  
<link href="css/login2.css" rel="stylesheet" type="text/css" />
</head>
 <h2 class="text-center">TERIMA KASIH ATAS BELANJA ANDA</h2>

 <div class="bg-form-login slide-login">
  	<div>
	
<?php
Session_start();
Session_destroy();
echo "<script>alert('Anda sudah Logout.'); window.location = 'index.php'</script>";
?>

	
	</div>
	</div>



<script type="text/javascript" src="css/js/jquery-1.10.1.js"></script>
<script type="text/javascript" src="css/js/admintamp.js"></script>
</html>