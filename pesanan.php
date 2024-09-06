<?php
include_once 'koneksi.php';
include("headerpelanggan.php");

// Ambil informasi pelanggan dari session
if (isset($_SESSION['pelanggan_login_id'])) {
    $login_id = $_SESSION['pelanggan_login_id'];
    $query = "SELECT * FROM pelanggan WHERE id = $login_id";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $pelanggan = mysqli_fetch_assoc($result);
        $welcome_message = "Halo, " . $pelanggan['nama'] . "!";
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
  <title>Data Pelanggan</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      padding-top: 56px; /* Menyesuaikan tinggi navbar */
    }
    .search-container {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 10px;
    }

    .search-container input {
      width: 200px; /* Atur lebar kolom pencarian sesuai kebutuhan */
    }
  </style>
</head>
<body>

<div class="container mt-4">
  <h2>Data Pesanan</h2>

  <table class="table mt-3">
  <thead>
      <tr>
        <th scope="col" style="width: 50px;">No</th>
        <th scope="col" style="width: 150px;">Nama</th>
        <th scope="col" style="width: 150px;">Alamat</th>
        <th scope="col" style="width: 70px;">No. HP</th>
        <th scope="col" style="width: 80px;">Tanggal Pemesanan</th>
        <th scope="col" style="width: 100px;">Jenis Sepatu</th>
        <th scope="col" style="width: 170px;">Status Pembayaran</th>
        <th scope="col" style="width: 200px;">Status Pemesanan</th>
        <th scope="col">Cetak Struk</th>
      </tr>
    </thead>

    <tbody>
    <?php
    // Query untuk mengambil data pelanggan dari tabel pelanggan berdasarkan pencarian
    $query = "SELECT * FROM transaksi WHERE id_pesanan = $login_id";
    $result = mysqli_query($koneksi, $query);

    // Variabel counter untuk nomor
    $counter = 1;

    // Loop untuk menampilkan data pelanggan dalam bentuk tabel
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $counter++ . "</td>";
        echo "<td>" . $row['nama'] . "</td>";
        echo "<td>" . $row['alamat'] . "</td>";
        echo "<td>" . $row['nohp'] . "</td>";
        echo "<td>" . $row['tanggal'] . "</td>";
        echo "<td>" . $row['jenis_sepatu'] . "</td>";
        echo "<td>" . $row['status_pembayaran'] . "</td>";
        echo "<td>" . $row['status_pesanan'] . "</td>";
        echo "<td><a href='cetak_struk.php?id=" . $row['id'] . "' target='_blank' title='Cetak'><i class='fa-solid fa-print'></i></a></td>";
        echo "</tr>";

    
        
    }
    mysqli_close($koneksi);
    ?>
</tbody>

  </table>
</div>

<!-- Bootstrap JS dan jQuery (Diperlukan untuk komponen Bootstrap yang memerlukan JavaScript) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
