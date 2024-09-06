<?php
session_start();

// Cek apakah sudah login sebagai admin
if (isset($_SESSION['admin_login_id'])) {
    $login_id = $_SESSION['admin_login_id'];
    // Lakukan query untuk mendapatkan informasi admin berdasarkan login_id
    // Sesuaikan dengan struktur tabel dan kolom yang digunakan
    include("koneksi.php");
    $query = "SELECT * FROM admin WHERE login_id = $login_id";
    $result = mysqli_query($koneksi, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
    } else {
        // Redirect ke halaman login jika tidak ada informasi admin
        header("location: login.php");
        exit();
    }
} else {
    // Redirect ke halaman login jika belum login sebagai admin
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Dashboard</title>
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
  <a class="navbar-brand" href="admin.php">Admin Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="datapelanggan.php">Data Pelanggan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="datapesanan.php">Data Pesanan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="datatransaksi.php">Data Transaksi</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="datapaket.php">Data Paket</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="metode_bayar.php">Metode Bayar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="datasepatu.php">Jenis Sepatu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="datapesananselesai.php">Pesanan Selesai</a>
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
