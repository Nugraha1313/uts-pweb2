<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phplogin", "3306");


function registrasi($data) {
    global $conn;
    $email = $data["email"];
    $nama = $data["nama"];

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);


    if(!empty(trim($nama)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($password2)) && !empty(trim(upload()))  ){
        // cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM accounts WHERE username = '$username'");
        if( mysqli_fetch_assoc($result) ) {
            echo '<script>alert("Username sudah ada ");history.back(self);</script>';
            return false;
        }
        // cek email sudah ada atau belum
        $checkEmail = mysqli_query($conn, "SELECT username FROM accounts WHERE email = '$email'");
        if( mysqli_fetch_assoc($checkEmail) ) {
            echo "<script>
				alert('email sudah terdaftar!')
		      </script>";
            return false;
        }
        // cek konfirmasi password
        if( $password !== $password2 ) {
            echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
            return false;
        }
        $foto = upload();
        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
        // tambahkan userbaru ke database
        mysqli_query($conn, "INSERT INTO accounts VALUES('','$nama' ,'$username', '$password', '$foto',  '$email ')");

    }

    return mysqli_affected_rows($conn);

}
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
    // $username = htmlspecialchars($data["user"]);
    $username = strtolower(stripslashes($data["user"]));
    $email = htmlspecialchars($data["email"]);


    // 

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM accounts WHERE username = '$username' AND id NOT $id");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
        return 0;
    }

    // cek email sudah ada atau belum
    $checkEmail = mysqli_query($conn, "SELECT email FROM accounts WHERE email = '$email' AND id NOT $id");
    if (mysqli_fetch_assoc($checkEmail)) {
        echo "<script>
				alert('email sudah terdaftar!')
		      </script>";
        return 0;
    }

    $fotoLama = htmlspecialchars($data["fotoLama"]);

    if($_FILES['foto']['error'] === 4){
        $foto = $fotoLama;
    }
    else  {
        $foto = upload();
    }

        $query = "UPDATE accounts 
                SET
            nama = '$nama',
            username = '$username',
            email = '$email',
            foto = '$foto'
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
        echo " <script> 
                    alert('Upload Gambar Terlebih Dahulu !');
               </script>
               ";
            return false;
    }

    $ekstensiValid = ['jpg' , 'jpeg' , 'png'];
    $ekstensiFoto = explode('.', $namaFile);
    $ekstensiFoto = strtolower(end($ekstensiFoto));
    if(!in_array($ekstensiFoto , $ekstensiValid)){
        echo " <script> 
                    alert('Tolong Hanya Upload Gambar berekstensi (jpg,jpeg,png) !');
                    
                   </script>

            ";
            return false;
    }

    
    if($ukuranFile > 2000000){
        echo " <script> 
                    alert('Ukuran Gambar Terlalu Besar , Hanya Boleh Dibawah 2 Mb !');
                    
                   </script>

            ";
            return false;
    }

    $namaFileBaru = uniqid() . '.' . $ekstensiFoto;

    move_uploaded_file($tmpName, 'img/'.$namaFileBaru);
    return $namaFileBaru;
}

?>