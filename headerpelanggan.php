<?php
include_once 'koneksi.php';

// Pastikan session sudah dimulai
session_start();

// Ambil informasi pelanggan dari session
if (isset($_SESSION['pelanggan_login_id'])) {
    $login_id = $_SESSION['pelanggan_login_id'];
    $query = "SELECT * FROM pelanggan WHERE id = $login_id";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $pelanggan = mysqli_fetch_assoc($result);
        $welcome_message = "Halo, " . $pelanggan['username'] . "!";
    } else {
        // Menampilkan alert dan redirect menggunakan JavaScript
        echo "<script>alert('Informasi pelanggan tidak ditemukan. Silakan login kembali.');</script>";
        echo "<script>window.location.href = 'login.php';</script>";
        exit();
    }
} else {
    // Redirect ke halaman login jika belum login sebagai pelanggan
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SuahPatu</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      padding-top: 56px; /* Menyesuaikan tinggi navbar */
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">SuahPatu</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="pelanggan.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="order.php">Order</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pesanan.php">Pesanan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>

<!-- Content goes here -->

<!-- Bootstrap JS dan jQuery (Diperlukan untuk komponen Bootstrap yang memerlukan JavaScript) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
