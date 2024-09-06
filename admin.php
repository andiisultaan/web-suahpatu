<?php
include_once 'koneksi.php';
include("headeradmin.php");

// Ambil informasi admin dari session
if (isset($_SESSION['admin_login_id'])) {
    $login_id = $_SESSION['admin_login_id'];
    $query = "SELECT * FROM admin WHERE login_id = $login_id";
    $result = mysqli_query($koneksi, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
        $welcome_message = "Selamat datang, " . $admin['username'] . "!";
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
  <style>
    body {
      background-image: url('sepatu.jpeg'); /* Ganti dengan path gambar latar belakang yang sesuai */
      background-size: cover;
      background-position: center;
      color: #fff;
      font-family: 'Helvetica', sans-serif;
      padding-top: 56px;
    }
    .welcome-container {
      text-align: center;
      padding: 50px;
      background-color: rgba(0, 0, 0, 0.5); /* Warna latar belakang dengan tingkat transparansi */
      border-radius: 10px; /* Sudut sudut background */
    }
  </style>
</head>
<body>

<div class="welcome-container">
  <h1><?php echo $welcome_message; ?></h1>
  <p>Selamat datang di halaman admin. Ini adalah halaman dashboard khusus untuk admin.</p>
</div>

<!-- Bootstrap JS dan jQuery (Diperlukan untuk komponen Bootstrap yang memerlukan JavaScript) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
