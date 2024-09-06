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
    $id = $_POST['id'];
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];
    $email = $_POST['email'];

    // Cek apakah input password tidak kosong
    $password = !empty($_POST['password']) ? md5($_POST['password']) : null;

    // Update data pelanggan ke dalam database
    $sql = "UPDATE pelanggan SET";
    if ($password) {
        $sql .= " password='$password',";
    }
    $sql .= " username='$username', nama='$nama', alamat='$alamat', nohp='$nohp', email='$email' WHERE id=$id";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data pelanggan berhasil diubah.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'datapelanggan.php';
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
