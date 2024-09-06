<?php
include_once 'koneksi.php';
session_start();
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
      margin: 0;
      padding: 0;
      background-image: url('sepatu.jpeg'); /* Ganti dengan path gambar sepatu Anda */
      background-size: cover;
      background-position: center;
      color: #fff;
      font-family: 'Helvetica', sans-serif;
      opacity: 0; /* Nilai awal opasitas 0 untuk efek fade-in */
      transition: opacity 3s ease-in-out; /* Transisi opasitas selama 1 detik */
    }
    .navbar {
      background-color: rgba(0, 0, 0, 0.7); /* Nilai alpha menentukan tingkat transparansi */
    }
    .navbar-brand {
      color: #fff;
    }
    .navbar-nav .nav-link {
      color: #fff;
    }
    header.jumbotron {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh; /* 100% tinggi viewport */
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      opacity: 0; /* Nilai awal opasitas 0 untuk efek fade-in */
      transition: opacity 1s ease-in-out; /* Transisi opasitas selama 1 detik */
    }
    header.jumbotron h1 {
      font-size: 3rem;
    }
    .btn-translucent {
      background-color: rgba(0, 0, 0, 0.3);
      border: 1px solid #fff;
      color: #fff;
    }
    @keyframes fadeInBackground {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
    body.fade-in {
      animation: fadeInBackground 1s ease-in-out;
    }
  </style>
</head>
<body class="fade-in">

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">SuahPatu</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<header class="jumbotron text-center">
  <h1 class="display-10">Selamat Datang di SuahPatu</h1>
  <p class="lead">Cuci sepatu anda agar seperti baru lagi.</p>
  <a class="btn btn-dark btn-md btn-translucent" href="register.php" role="button">Gabung Sekarang</a>
</header>

<!-- Bootstrap JS dan jQuery (Diperlukan untuk komponen Bootstrap yang memerlukan JavaScript) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  // Menunggu dokumen selesai dimuat
  document.addEventListener("DOMContentLoaded", function() {
    // Menetapkan opasitas menjadi 1 setelah dokumen dimuat (efek fade-in)
    document.body.style.opacity = 1;
    document.querySelector('header.jumbotron').style.opacity = 1;
  });
</script>


</body>
</html>
