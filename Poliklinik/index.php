<?php 
@session_start();
include "config/koneksi.php";

if (isset($_POST['login'])) {
	$sq = "SELECT * from tb_user where username = '$_POST[username]' AND password = '$_POST[password]'";
	$sql = mysqli_query($con,$sq);
	$tampil = mysqli_fetch_array($sql);
	$cek = mysqli_num_rows($sql);
	if($cek > 0){
		$_SESSION['username'] = $_POST['username'];
		echo "<script>document.location.href='home.php'</script>";
	}else{
		echo "<script>alert('username dan password Salah')</script>";
	} 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<style>
	body{
		background: url("images/img11.jpg");
		background-size: 100% 100%;
	}
</style>
<link rel="stylesheet" href="css/style.css">
<body>
<form method="post">
<aside class="right-side">
	<div class="header">
		<p>Login Administrator</p>
	</div>
	<div class="form-login" align="center">
		<br>
		<img src="images/png/admin.png" class="img-icon">
		<div class="down">
			<input type="text" name="username" class="textbox" placeholder="Username"><br>	
		</div>
		<div class="down">
			<input type="password" name="password" class="textbox" placeholder="Password"><br>
		</div>
		<div class="down">
			<input type="submit" name="login" value="Login" class="btn">
		</div>
	</div>
</aside>
</form>	
</body>
</html>