<?php 
@session_start();
include"config/koneksi.php";
if (empty($_SESSION['username'])) {
	echo "<script>alert('login terlebih dahulu');document.location.href='index.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
</head>
<link rel="stylesheet" href="css/style.css">
<body class="home-flat">

<ul class="topnav">
    <li class="dropdown right">
      <a href="#" class="dropbtn">Account</a>
        <div class="dropdown-content">
          <a href="Profil.php">Profile</a>
          <a href="logout.php" onclick="return confirm('Anda yakin ingin keluar')">Logout</a>
        </div>
    </li>
    <li class="dropdown">
      <a href="#" class="dropbtn">Master</a>
        <div class="dropdown-content">
          <a href="dokter.php">Dokter</a>
          <a href="poli.php">Poli</a>
          <a href="pasien.php">Pasien</a>
        </div>
    </li>
  <li><a href="jadwal.php">Jadwal Praktek</a></li>
  <li><a class="active" href="#home">Home</a></li>
</ul>

<section>
	<p class="center-top" align="center">SELAMAT DATANG DI HALAMAN UTAMA</p>
</section>
	
</body>
</html>