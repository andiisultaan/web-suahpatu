<?php
include_once 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Registration Page</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-image: url('sepatu.jpeg'); /* Ganti dengan path gambar latar belakang registrasi Anda */
      background-size: cover;
      background-position: center;
      color: #fff;
      font-family: 'Helvetica', sans-serif;
      margin: auto;
      padding: 0;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }
    .registration-container {
      background-color: rgba(0, 0, 0, 0.7);
      padding: 25px;
      border-radius: 10px;
      width: 500px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      opacity: 0;
      transition: opacity 3s ease-in-out;
      margin: auto;
    }
  </style>
</head>
<body>

<div class="registration-container">
  <h2 class="text-center">Registration</h2>
  <form action="registeract.php" method="post">
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
    </div>
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter your name">
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <textarea class="form-control" id="alamat" name="alamat" placeholder="Enter your address"></textarea>
    </div>
    <div class="form-group">
      <label for="phone">Phone Number</label>
      <input type="tel" class="form-control" id="nohp" name="nohp" placeholder="Enter your phone number">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
    </div>
    <button type="submit" class="btn btn-primary btn-block">Register</button>
  </form>
  <div class="mt-3 text-center">
    <a href="login.php" class="text-light">Login</a> | <a href="index.php" class="text-light">Beranda</a>
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
    document.querySelector('.registration-container').style.opacity = 5;
  });
</script>

</body>
</html>
