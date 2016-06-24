<?php
include "config/koneksi.php";
// catatan!!
// keamanan masih kurang...

// fungsi untuk menghindari injeksi dari user yang jahil
function anti_injection($data){
  $filter  = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
  return $filter;
}

$username = anti_injection($_POST['username']);
$password = anti_injection(md5($_POST['password']));

// menghindari sql injection
$injeksi_username = mysqli_real_escape_string($koneksi, $username);
$injeksi_password = mysqli_real_escape_string($koneksi, $password);

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($injeksi_username) OR !ctype_alnum($injeksi_password)){
  echo "<script>alert('Masukan username dan password dengan benar.'); window.location = 'index.php'</script>";
}
else{
  $query  = "SELECT * FROM users WHERE username='$username' AND password='$password' AND blokir='N'";
  $login  = mysqli_query($koneksi, $query);
  $ketemu = mysqli_num_rows($login);
  $r      = mysqli_fetch_array($login);

  // Apabila username dan password ditemukan (benar)
  if ($ketemu > 0){
    session_start();

    // bikin variabel session
	$_SESSION['iduser']		 = $r['id_user'];
    $_SESSION['namauser']    = $r['username'];
    $_SESSION['passuser']    = $r['password'];
    $_SESSION['namalengkap'] = $r['nama_lengkap'];
    $_SESSION['leveluser']   = $r['level'];
      
    // bikin id_session yang unik dan mengupdatenya agar slalu berubah 
    // agar user biasa sulit untuk mengganti password Administrator 
    $sid_lama = session_id();
	  session_regenerate_id();
    $sid_baru = session_id();
    mysqli_query($koneksi, "UPDATE users SET id_session='$sid_baru' WHERE username='$username'");

    header("location:homes.php?module=beranda");
  }
  else{
   echo "<script>alert('Username atau password salah.'); window.location = 'index.php'</script>";  
  }
}
?>