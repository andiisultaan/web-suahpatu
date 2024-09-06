<?php
session_start();
session_destroy();

// Menggunakan header untuk redirect ke halaman index.php
header("location:index.php");
exit(); // Pastikan untuk keluar setelah melakukan redirect
?>
