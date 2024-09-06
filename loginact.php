<?php
include("koneksi.php");

$username = $_POST['username'];
$password = md5($_POST['password']);

// Cek login di tabel admin
$sql_admin = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
$result_admin = mysqli_query($koneksi, $sql_admin);

// Cek login di tabel pelanggan
$sql_pelanggan = "SELECT * FROM pelanggan WHERE username = '$username' AND password = '$password'";
$result_pelanggan = mysqli_query($koneksi, $sql_pelanggan);

if (mysqli_num_rows($result_admin) == 1) {
    $user_admin = mysqli_fetch_assoc($result_admin);
    session_start();
    $_SESSION['admin_username'] = $username;
    $_SESSION['admin_login_id'] = $user_admin['login_id'];
    header("location: admin.php");
    exit();
} elseif (mysqli_num_rows($result_pelanggan) == 1) {
    $user_pelanggan = mysqli_fetch_assoc($result_pelanggan);
    session_start();
    $_SESSION['pelanggan_username'] = $username;
    $_SESSION['pelanggan_login_id'] = $user_pelanggan['id']; // Sesuaikan dengan kolom ID pada tabel pelanggan
    header("location: pelanggan.php");
    exit();
}  else {
    echo "<script>
            alert('Login gagal. Cek username dan password Anda.');
            window.location.href = 'login.php'; // Ganti dengan halaman login Anda
          </script>";
}

mysqli_close($koneksi);
?>
