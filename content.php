<?php
//content mengatur link ke modul2
// jika menambahkan modul harus tambah modul lewat file ini
// jika level == admin (admin) level == user (user)
// aku ganteng. '*.*


 include "config/koneksi.php";
 include "config/library.php";


//0 
	  // Home (Beranda)
  if ($_GET['module']=='beranda'){               
    if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
      include "modul/view/beranda.php";
    }  
  }

//1
 if ($_GET['module']=='barang'){               
    if ($_SESSION['leveluser']=='admin' ){
      include "modul/view/barang.php";
    }  
  }
 //2 
   if ($_GET['module']=='modul'){               
    if ($_SESSION['leveluser']=='admin'){
      include "modul/view/modul.php";
    }  
  }
  
  
 //3 
   if ($_GET['module']=='cabang'){               
    if ($_SESSION['leveluser']=='admin'){
      include "modul/view/cabang.php";
   }  
  }
//4	
	if ($_GET['module']=='user'){               
    if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
      include "modul/view/user.php";
    }  
  }
 //5 
   if ($_GET['module']=='order'){               
    if ($_SESSION['leveluser']=='admin'  OR $_SESSION['leveluser']=='user'){
      include "modul/view/order.php";
    }  
  }
//6
 if ($_GET['module']=='cart'){               
    if ($_SESSION['leveluser']=='admin'  OR $_SESSION['leveluser']=='user'){
      include "modul/view/cart.php";
    }  
  }
 //7 
  if ($_GET['module']=='saran'){               
    if ($_SESSION['leveluser']=='admin'){
      include "modul/view/saran.php";
    }  
  }
?>