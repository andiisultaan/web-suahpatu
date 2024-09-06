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

// Pastikan form telah di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $pelanggan_id = $_POST['pelanggan_id'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $alamat_pelanggan = $_POST['alamat_pelanggan'];
    $nohp = $_POST['nohp'];
    $jenis_sepatu = $_POST['jenis_sepatu'];
    $paket_id = $_POST['paket'];
    $metode_pembayaran_id = $_POST['metode_pembayaran'];
    $total_bayar = $_POST['totalbayar'];

    // Upload bukti pembayaran (contoh, perlu penanganan lebih lanjut)
    $upload_directory = "uploads/"; // Sesuaikan dengan direktori penyimpanan Anda
    $bukti_pembayaran_name = $_FILES['bukti_bayar']['name'];
    $bukti_pembayaran_path = $upload_directory . $bukti_pembayaran_name;

    // Periksa apakah direktori penyimpanan ada, jika tidak, buat direktori baru
    if (!is_dir($upload_directory)) {
        mkdir($upload_directory, 0777, true);
    }

    // Pindahkan file yang diunggah ke direktori penyimpanan
    if (move_uploaded_file($_FILES['bukti_bayar']['tmp_name'], $bukti_pembayaran_path)) {
        echo "File berhasil diunggah.";
    } else {
        echo "Gagal mengunggah file.";
    }


    // Pindahkan file bukti pembayaran ke direktori yang ditentukan
    move_uploaded_file($_FILES['bukti_bayar']['tmp_name'], $bukti_pembayaran_path);

    // Masukkan data ke tabel transaksi
    $query_transaksi = "INSERT INTO transaksi (id_pesanan, nama, alamat, nohp, namapaket, metode, totalbayar, buktibayar, jenis_sepatu, tanggal) 
                        VALUES ('$pelanggan_id', '$nama_pelanggan', '$alamat_pelanggan', '$nohp', '$paket_id', '$metode_pembayaran_id', '$total_bayar', '$bukti_pembayaran_name', '$jenis_sepatu',  DATE_FORMAT(NOW(), '%Y-%m-%d'))";

    $result_transaksi = mysqli_query($koneksi, $query_transaksi);


    // Periksa apakah query berhasil dijalankan
    if ($result_transaksi) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Terima Kasih telah Order!!!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'pesanan.php';
                });
             </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi
    mysqli_close($koneksi);
} else {
    // Jika form tidak di-submit, redirect ke halaman yang sesuai
    header("location: order.php");
    exit();
}
?>
