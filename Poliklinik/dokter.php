<?php 
@session_start();
include"config/koneksi.php";
if (empty($_SESSION['username'])) {
	echo "<script>alert('login terlebih dahulu');document.location.href='index.php'</script>";
}

if(isset($_POST['simpan'])){
	mysqli_query($con,"INSERT INTO tbl_dokter (kd_dokter,nama_dokter,kd_poli) VALUES ('$_POST[kd_dokter]','$_POST[nama_dokter]','$_POST[kd_poli]') ");
	echo "<script>alert('Data Tersimpan');document.location.href='?menu=dokter'</script>";
}
if(isset($_GET['delete'])){
	mysqli_query($con,"DELETE FROM tbl_dokter where kd_dokter = '$_GET[id]' ");
	echo "<script>alert('Data Terhapus');document.location.href='?menu=dokter</script>";
}
if(isset($_GET['edit'])){
	$sql = mysqli_query($con,"SELECT * FROM tbl_dokter WHERE kd_dokter='$_GET[id]' ");
	$edit = mysqli_fetch_array($sql);
}
if(isset($_POST['update'])){
	mysqli_query($con,"UPDATE tbl_dokter  SET kd_dokter ='$_POST[kd_dokter]', nama_dokter= '$_POST[nama_dokter]',kd_poli= '$_POST[kd_poli]' WHERE kd_dokter='$_GET[id]' ");
	echo "<script>alert('Data Terupdate');document.location.href='?menu=dokter'</script>";
}
if(isset($_POST['reset'])){
	$_POST['kd_dokter']="";
	$_POST['nama_dokter']="";
	$_POST['kd_poli']="";
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
          <a class="active" href="#dokter">Dokter</a>
          <a href="poli.php">Poli</a>
          <a href="pasien.php">Pasien</a>
        </div>
    </li>
  <li><a href="jadwal.php">Jadwal Praktek</a></li>
  <li><a href="home.php">Home</a></li>
</ul>

<div align="center" class="kotak-form">
	<div class="form-input">
		<p align="center" style="font-size:30px;font-family:arial;color:#33b5eb">Form Master Dokter</p>
		<div class="down">
			<input type="text" name="kd_dokter" value="<?php echo $edit['kd_dokter'] ?>" class="textbox" placeholder="Kode Dokter" required>
			<input type="text" name="nama_dokter" value="<?php echo $edit['nama_dokter'] ?>" class="textbox" placeholder="Nama Dokter" required>
			<input type="text" name="kd_poli" value="<?php echo $edit['kd_poli'] ?>" class="textbox" placeholder="Poli" required>
		</div>
		<div class="down">
			<?php if($_GET['id']== ""){ ?>
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
			<th>Kode Dokter</th>
			<th>Nama Dokter</th>
			<th>Poli</th>
			<th>aksi</th>
		</tr>
		<?php 
		$no =0;
		$sql = mysqli_query($con,"SELECT * FROM tbl_dokter order by kd_dokter");
		while($r = mysqli_fetch_array($sql)){
		$no++;
		?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $r['kd_dokter'] ?></td>
			<td><?php echo $r['nama_dokter'] ?></td>
			<td><?php echo $r['kd_poli'] ?></td>
			<td>
				<a href="?menu=dokter&edit&id=<?php echo $r['kd_dokter']; ?>" class="btn">Edit </a>
				<a href="?menu=dokter&delete&id=<?php echo $r['kd_dokter']; ?>" style="margin-left:10px;" class="btn" onclick="return confirm('Anda yakin ingin menghapus data ini')"> Hapus</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>

</form>
</body>
</html>