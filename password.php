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
 
	if(isset($_POST["ubahpass"])){
		// var_dump($_POST); 
		$cek = cekpass($_POST);
		

		if ($cek > 0 ){
			echo " <script> 
					alert('Password Berhasil Diubah !');
					document.location.href ='profil.php'
			       </script>";
		}
		else { 
            echo "<script> 
					alert('Password Tidak Berhasil Diubah !!!');
					document.location.href ='password.php'
			       </script>";
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
    <title>Change Password</title>
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
			
            	<button  title="Menuju Ke Halaman Edit" class="btn_style posisi-head" id="submit" ><a href="edit.php">Back</a></button><br><br><br>
                <h2>Change Password</h2>

                 <div class="user-box">
                    <label for="InputPassword">Password</label>
                    <input type="password" class="form-control" id="InputPassword" placeholder="Password" name="password" required minlength="6">
                </div>
                <div class="user-box">
                    <label for="InputPassword">Confirm Password</label>
                    <input type="password" class="form-control" id="InputRePassword" placeholder="Confirm Password" name="password2" required min="6">
                </div>
                <button type="submit" class="btn_style" id="submit" name="ubahpass">Submit</button>
                <!-- <div class="form-footer">
                   <p> Kembali ke <a href="edit.php">Edit Profil</a></p>
                </div> -->
            </form>
        </section>
    </section>
</section>
<br>
<br>
</body>
</html>