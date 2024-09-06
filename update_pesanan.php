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

// Make sure it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the request
    $id = $_POST['id'];
    $status_pemesanan = $_POST['status_pesanan'];
    $status_transaksi = $_POST['status_pembayaran'];

    // Update the record in the database
    $query_update = "UPDATE transaksi SET status_pesanan = '$status_pemesanan', status_pembayaran = '$status_transaksi' WHERE id = $id";
    $result_update = mysqli_query($koneksi, $query_update);


    if ($result_update) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data berhasil diganti!!.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'datapesanan.php';
                });
             </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }

    // Close the database connection
    mysqli_close($koneksi);
} else {
    // If it's not a POST request, return an error response
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
