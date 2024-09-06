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

// Pastikan parameter ID tersedia
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data paket berdasarkan ID
    $query = "DELETE FROM metode_bayar WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah penghapusan berhasil
    if ($result) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Metode Pembayaran berhasil dihapus!',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'metode_bayar.php';
                });
              </script>";
        exit();
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan: " . mysqli_error($koneksi) . "',
                    confirmButtonText: 'OK'
                });
              </script>";
    }

    // Menutup koneksi database
    mysqli_close($koneksi);
} else {
    // Redirect jika ID tidak tersedia
    header("location: metode_bayar.php");
    exit();
}
?>
