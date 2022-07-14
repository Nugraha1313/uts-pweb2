<?php
//menyertakan file program koneksi.php pada register
require('functions.php');
//inisialisasi session
session_start();

$error = '';
$validate = '';


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM accounts WHERE username = '$username'");

    // cek username and
    if (mysqli_num_rows($result) === 1) {
        // cek password and password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: home.php");
            exit;
        } else {
            echo '<script>alert("Password Salah");history.back(self);</script>';
        }
    } else {
        echo '<script>alert("Username Tidak Ditemukan");history.back(self);</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_index.css">
    <title>Login</title>
</head>

<body>
    <div class="login-box">
        <h2>Login</h2>
        <form action="" method="POST">
            <div class="user-box">
                <input type="text" name="username" required="">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <input class="btn_style" id="simpan" type="submit" value="Login" name="submit">
        </form>
        <br>
        <p> Belum punya account? <a href="registrasi.php">Registrasi</a></p>
    </div>
</body>

</html>