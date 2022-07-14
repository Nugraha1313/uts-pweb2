<?php
session_start(); //inisialisasi session
session_destroy();
echo '<script>alert("Berhasil Logout");document.location.href = "index.php"</script>';

?>