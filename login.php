<?php
include_once 'koneksi.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-image: url('sepatu.jpeg'); /* Ganti dengan path gambar latar belakang login Anda */
      background-size: cover;
      background-position: center;
      color: #fff;
      font-family: 'Helvetica', sans-serif;
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0; /* Nilai awal opasitas 0 untuk efek fade-in */
      transition: opacity 1s ease-in-out; /* Transisi opasitas selama 1 detik */
    }
    .login-container {
      background-color: rgba(0, 0, 0, 0.7);
      padding: 20px;
      border-radius: 10px;
      width: 300px;
      opacity: 0; /* Nilai awal opasitas 0 untuk efek fade-in */
      transition: opacity 1s ease-in-out; /* Transisi opasitas selama 1 detik */
    }
  </style>
</head>
<body>

<div class="login-container" id="app">
  <h2 class="text-center">Login</h2>
  <form action="loginact.php" method="post">
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username"  name="username" placeholder="Enter your username">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
    </div>
    <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
  </form>
  <div class="mt-3 text-center">
    <a href="register.php" class="text-light">Daftar</a> | <a href="index.php" class="text-light">Beranda</a>
  </div>
</div>

<!-- Bootstrap JS dan jQuery (Diperlukan untuk komponen Bootstrap yang memerlukan JavaScript) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  // Menunggu dokumen selesai dimuat
  document.addEventListener("DOMContentLoaded", function() {
    // Menetapkan opasitas menjadi 1 setelah dokumen dimuat (efek fade-in)
    document.body.style.opacity = 5;
    document.querySelector('.login-container').style.opacity = 5;
  });
</script>

</body>
</html>
