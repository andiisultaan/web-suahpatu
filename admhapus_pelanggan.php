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

    // Query untuk menghapus data pelanggan berdasarkan ID
    $query = "DELETE FROM pelanggan WHERE id = $id";

    // Periksa apakah penghapusan berhasil
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Data paket berhasil dihapus',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'datapelanggan.php';
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
    header("location: datapelanggan.php");
    exit();
}
?>
