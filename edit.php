<?php
session_start();
require 'functions1.php';

//mengecek username pada session
if (!isset($_SESSION['username'])) {
	echo '<script>alert("Please Login");document.location.href = "index.php"</script>';
	exit;
}
$username = $_SESSION['username'];
$result = query("SELECT * FROM accounts WHERE username = '$username'")[0];

if (isset($_POST["ubah"])) {
	$cek = edit($_POST);

	if ($cek > 0) {
		echo " <script>alert('Data Berhasil Diubah !');document.location.href ='profil.php'</script>";
	} else {
		echo "<script>alert('Data Tidak Berhasil Diubah !!!');document.location.href ='edit.php'</script>";
	}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<!-- meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<!-- costum css -->
	<link rel="stylesheet" href="style_edit.css">
	<title>Edit Profile</title>
</head>

<body>
	<br>
	<br>
	<section class="container-fluid">
		<!-- justify-content-center untuk mengatur posisi form agar berada di tengah-tengah -->
		<section class="row justify-content-center">
			<section class="col-12 col-sm-6 col-md-4">

				<form class="register-box" action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?= $result["id"]  ?>">
					<input type="hidden" name="fotoLama" value="<?= $result["foto"]  ?>">

					<button title="Menuju Ke Halaman Profil" class="btn_style posisi-head" id="submit"><a href="profil.php">Back</a></button><br><br><br>
					<h2>Edit Profile</h2>

					<div class="user-box">
						<label for="name">Nama :</label>
						<input type="text" class="form-control" id="name" value="<?= $result["nama"]  ?>" name="nama" required>
					</div>
					<div class="user-box">
						<label for="name">Username : </label>
						<input type="text" class="form-control" id="username" value="<?= $result["username"]  ?>" name="user" required>
					</div>
					<div class="user-box">
						<label for="InputEmail">Email : </label>
						<input type="email" class="form-control" id="InputEmail" aria-describeby="emailHelp" name="email" value="<?= $result["email"]  ?>" required>
					</div>
					<div class="user-box">
						<label for="formFile" class="form-label">Photo Profile :</label>
						<input class="form-control" type="file" id="formFile" name="foto">
					</div>
					</div>
					<button type="submit" class="btn_style" id="submit" name="ubah">Submit</button>
					<div class="form-footer">
						<p>Change Your Password ? <a href="password.php">Change Password</a></p>
					</div>
				</form>
			</section>
		</section>
	</section>
	<br>
	<br>
</body>

</html>