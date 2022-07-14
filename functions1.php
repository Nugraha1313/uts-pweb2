<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phplogin", "3306");

function query($query){
    global $conn;
    
    $result = mysqli_query($conn,$query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function edit($data){
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $username = strtolower(htmlspecialchars($data["user"]));
    $email = strtolower(htmlspecialchars($data["email"]));
    
    
    $fotoLama = htmlspecialchars($data["fotoLama"]);
    $result = mysqli_query($conn,"SELECT username FROM accounts WHERE username ='$username'  AND id != $id");


    if(mysqli_fetch_assoc($result)){
        echo " <script>alert('Username Telah Digunakan , Silahkan Cari Username Lain ! !');</script>"; 
        return false;
    }

    $result1 = mysqli_query($conn,"SELECT email FROM accounts WHERE email = '$email' AND id != $id");

    if(mysqli_fetch_assoc($result1)){
        echo " <script>alert('Email Telah Digunakan ! !');</script>"; 
        return false;
    }
    $_SESSION['username'] = $username;

    if($_FILES['foto']['error'] === 4){
        $foto = $fotoLama;
    }else {
        $foto = upload();
    } 
    $query = "UPDATE accounts
              SET nama = '$nama',username = '$username',email = '$email',foto = '$foto'
              WHERE id = $id";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function upload(){

    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $tmpName = $_FILES['foto']['tmp_name'];
    $error = $_FILES['foto']['error'];

    if($error === 4){
        echo " <script> alert('Upload Gambar Terlebih Dahulu !');</script>";
        return false;
    }

    $ekstensiValid = ['jpg' , 'jpeg' , 'png'];
    $ekstensiFoto = explode('.', $namaFile);
    $ekstensiFoto = strtolower(end($ekstensiFoto));
    if(!in_array($ekstensiFoto , $ekstensiValid)){
        echo " <script>alert('Tolong Hanya Upload Gambar berekstensi (jpg,jpeg,png) !');</script>";
        return false;
    }

    if($ukuranFile > 2000000){
        echo " <script> alert('Ukuran Gambar Terlalu Besar , Hanya Boleh Dibawah 2 Mb !');</script>";
        return false;
    }

    $namaFileBaru = uniqid() . '.' . $ekstensiFoto;

    move_uploaded_file($tmpName, 'img/'.$namaFileBaru);
    return $namaFileBaru;
}

function cekpass($data){
    global $conn;
    $id = $data["id"];
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]); 

    if( $password !== $password2 ) {
        echo "<script>alert('konfirmasi password tidak sesuai!');</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE accounts
              SET password = '$password'
              WHERE id = $id";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);

}

?>



