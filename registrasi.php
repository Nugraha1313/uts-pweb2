<?php
require 'functions.php';

if (isset($_POST["register"])) {
    global $conn;
    if (registrasi($_POST) > 0) {
        echo '<script>alert("User Berhasil Ditambahkan");document.location.href = "index.php"</script>';
    } else {
        echo mysqli_error($conn);
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
    <link rel="stylesheet" href="style_registrasi.css">
    <title>Registration</title>
</head>

<body>
    <br>
    <br>
    <section class="container-fluid">
        <!-- justify-content-center untuk mengatur posisi form agar berada di tengah-tengah -->
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-4">
                <form class="register-box" action="" method="post" enctype="multipart/form-data">
                    <button title="Menuju ke Halaman Login" class="btn_style posisi-head" id="submit"><a href="index.php">Back</a></button><br><br><br>
                    <h2>Registration</h2>
                    <div class="user-box">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" placeholder="Masukkan Nama" name="nama" required>
                    </div>
                    <div class="user-box">
                        <label for="InputEmail">Email</label>
                        <input type="email" class="form-control" id="InputEmail" aria-describeby="emailHelp" name="email" placeholder="Masukkan email" required>
                    </div>
                    <div class="user-box">
                        <label for="name">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukkan username" name="username" required>
                    </div>
                    <div class="user-box">
                        <label for="formFile" class="form-label">Foto Profile </label>
                        <input class="form-control" type="file" id="formFile" name="foto" required>
                    </div>
                    <div class="user-box">
                        <label for="InputPassword">Password</label>
                        <input type="password" class="form-control" id="InputPassword" placeholder="Password" name="password" required minlength="6">
                    </div>
                    <div class="user-box">
                        <label for="InputPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="InputRePassword" placeholder="Confirm Password" name="password2" required min="6">
                    </div>
                    </div>
                    <input type="submit" class="btn_style" id="submit" name="register" value="submit">
<!--                     <div class="form-footer">
                        <p> Sudah punya account? <a href="index.php">Login</a></p>
                    </div> -->
                </form>
            </section>
        </section>
    </section>
    <br>
    <br>

</body>

</html>