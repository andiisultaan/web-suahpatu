<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Data Paket</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
  <!-- Your other stylesheets and head content -->
  <!-- ... -->

  <!-- SweetAlert2 Script -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<!-- Your page content -->
<!-- ... -->
</body>
</html>

<?php
include_once 'koneksi.php';

// Pastikan form disubmit dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $metode = $_POST['metode'];

    // SQL Query untuk menambah data paket
    $sql = "INSERT INTO metode_bayar (metode) VALUES ('$metode')";

    // Eksekusi query dan cek keberhasilan
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Metode Pembayaran berhasil ditambah!.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'metode_bayar.php';
                });
             </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}

// Menutup koneksi database
mysqli_close($koneksi);
?>
