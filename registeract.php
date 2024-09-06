<?php
include("koneksi.php");

$username = $_POST['username'];
$password = md5($_POST['password']); // Gunakan fungsi hash sesuai kebutuhan (contoh: MD5)
$name = $_POST['nama'];
$address = $_POST['alamat'];
$phone = $_POST['nohp'];
$email = $_POST['email'];

$sql = "INSERT INTO pelanggan (username, password, nama, alamat, nohp, email) 
        VALUES ('$username', '$password', '$name', '$address', '$phone', '$email')";

if (mysqli_query($koneksi, $sql)) {
    echo '<script>alert("Registrasi berhasil! Silakan login."); window.location.href = "login.php";</script>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}

// mysqli_close($koneksi);
?>
