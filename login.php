<?php 
include "koneksi.php";
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Halaman Login</title>
	<link rel="stylesheet" type="text/css" href="css/login_register.css">
</head>
<body >
	<!-- page login -->
	<div class="page-login">
		<!-- box -->
		<div class="box">
			<!-- box header -->
			<div class="box-header">
			<img
            src="img/logo_smp.png"
            alt=""
            width="50"
            height="50"
            class="d-inline-block align-text-center"
          /><br>
          <b>PERPUSTAKAAN SMPN 52 BEKASI</b>
			</div>
			<!-- box body -->
			<div class="box-body">
				<!-- form login -->
				<form action="" method="POST">
					<!-- username -->
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" placeholder="Username" required oninvalid="this.setCustomValidity('Tolong masukan Username')"
						oninput="setCustomValidity('')"
						
						class="input-control">
					</div>
					<!-- password -->
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" placeholder="Password" required oninvalid="this.setCustomValidity('Tolong masukan Password')" oninput="setCustomValidity('')"; class="input-control">
					</div>
					<input type="submit" name="submit" value="Login" class="btn">
				</form>
				
				<!-- db submit -->
				<?php
				if (isset($_POST['submit'])) {				
					$username = mysqli_real_escape_string($conn, $_POST['username']);
					$password = mysqli_real_escape_string($conn, $_POST['password']);
					//user
					$dataUser = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password' ");
					$result1 = mysqli_fetch_assoc($dataUser);
					//anggota
					$dataAnggota = mysqli_query($conn, "SELECT * FROM anggota WHERE username = '$username' AND password = '$password'");
					$result2 = mysqli_fetch_assoc($dataAnggota);
					$nama_anggota = $result2['nama_anggota'];
					$kelas = $result2['kelas'];

					if($result1 !== null){

						$username = $result1['username'];
						$password = $result1['password'];
						$level = $result1['level'];
						$_SESSION['level'] = $level;
						$_SESSION['username'] =$username;
						$_SESSION['status'] = "login";
						Header('Location:Dashboard.php');

						}else if ($result2 !== null){

						$username = $result2['username'];
						$password = $result2['password'];
						$_SESSION['nama_anggota'] = $nama_anggota;
						$_SESSION['kelas'] = $kelas;
						$_SESSION['status'] = "login";
						Header('Location:Dashboard1.php');

						}else {
							echo '<div class="alert">data tidak ditemukan</div>';
						}
					}
				?>
				<!-- end db submit -->
		</div>
			<!-- box footer -->
			<div class="box-footer text-center">
				<a href="index.php">Kembali Ke Dashboard</a>
			</div>
	</div>
</body>
</html>