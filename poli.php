<?php 
@session_start();
include"config/koneksi.php";
if (empty($_SESSION['username'])) {
	echo "<script>alert('login terlebih dahulu');document.location.href='index.php'</script>";
}

if(isset($_POST['simpan'])){
	mysqli_query($con,"INSERT INTO tbl_poli (kd_poli,nama_poli) VALUES ('$_POST[kd_poli]','$_POST[nama_poli]'");
	echo "<script>alert('Data Tersimpan');document.location.href='?menu=poli'</script>";
}
if(isset($_GET['delete'])){
	mysqli_query($con,"DELETE FROM tbl_poli where kd_poli = '$_GET[id]' ");
	echo "<script>alert('Data Terhapus');document.location.href='?menu=poli</script>";
}
if(isset($_GET['edit'])){
	$sql = mysqli_query($con,"SELECT * FROM tbl_poli WHERE kd_poli='$_GET[id]' ");
	$edit = mysqli_fetch_array($sql);
}
if(isset($_POST['update'])){
	mysqli_query($con,"UPDATE tbl_poli  SET kd_poli ='$_POST[kd_poli]', nama_poli= '$_POST[nama_poli]' WHERE kd_poli='$_GET[id]' ");
	echo "<script>alert('Data Terupdate');document.location.href='?menu=poli'</script>";
}
if(isset($_POST['reset'])){
	$_POST['kd_poli']="";
	$_POST['nama_poli']="";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dokter</title>
</head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<body>
<form method="post">
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
          <a class="active" href="#poli">Poli</a>
          <a href="pasien.php">Pasien</a>
        </div>
    </li>
  <li><a href="jadwal.php">Jadwal Praktek</a></li>
  <li><a href="home.php">Home</a></li>
</ul>

<div align="center" class="kotak-form">
	<div class="form-input">
		<p align="center" style="font-size:30px;font-family:arial;color:#33b5eb">Form Master poli</p>
		<div class="down">
			<input type="text" name="kd_poli" value="<?php echo $edit['kd_poli'] ?>" class="textbox" placeholder="Kode Poli" required>
			<input type="text" name="nama_poli" value="<?php echo $edit['nama_poli'] ?>" class="textbox" placeholder="Nama poli" required>
		</div>
		<div class="down">
			<?php if ($_GET['id']==""){ ?>
				<input type="submit" name="simpan" value="Simpan" class="btn">
				<?php }else{ ?>
				<input type="submit" name="update" value="Update" class="btn">
			<?php } ?>
				<input type="submit" name="reset" value="Reset" class="btn">
		</div>
		<br>
	</div>
	<br>
	<table class="table">
		<tr>
			<th>No</th>
			<th>Kode Poli</th>
			<th>Nama Poli</th>
			<th>aksi</th>
		</tr>
		<?php 
		$no=0;
		$sql = mysqli_query($con,"SELECT * FROM tbl_poli order by kd_poli");
		while($r = mysqli_fetch_array($sql)){
		$no++;
		?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $r['kd_poli'] ?></td>
			<td><?php echo $r['nama_poli'] ?></td>
			<td>
				<a href="?menu=poli&edit&id=<?php echo $r['kd_poli']; ?>" class="btn">Edit </a>
				<a href="?menu=poli&delete&id=<?php echo $r['kd_poli']; ?>" style="margin-left:10px;" class="btn" onclick="return confirm('Anda yakin ingin menghapus data ini')"> Hapus</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>

</form>
</body>
</html>