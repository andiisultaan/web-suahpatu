<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'suahpatu';

$koneksi = mysqli_connect($servername, $username, $password, $dbname);

if (!$koneksi) {
    die('Tidak bisa terhubung ke MySQL: ' . mysqli_connect_error());
}

// Memilih database
// if (mysqli_select_db($conn, $dbname)) {
//     echo 'Database berhasil dipilih.';
// } else {
//     die('Tidak bisa memilih database: ' . mysqli_error($conn));
// }

// Lakukan operasi database lainnya di sini...

// mysqli_close($conn);
?>
