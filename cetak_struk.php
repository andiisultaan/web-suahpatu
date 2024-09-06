<?php
include_once 'koneksi.php';

// Ambil id_pesanan dari parameter URL
$id_pesanan = isset($_GET['id']) ? $_GET['id'] : die('Parameter id_pesanan tidak ditemukan.');

// Lakukan query untuk mengambil data pesanan
$query_struk = "SELECT * FROM transaksi WHERE id = $id_pesanan";
$result_struk = mysqli_query($koneksi, $query_struk);

if ($result_struk && mysqli_num_rows($result_struk) > 0) {
    $data_struk = mysqli_fetch_assoc($result_struk);

    // Set content type to HTML
    header('Content-Type: text/html; charset=UTF-8');

    // Output HTML content
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
    echo '<title>Cetak Struk</title>';
    echo '<style>';
    echo 'body { font-family: "Arial", sans-serif; }';
    echo '.container { max-width: 300px; margin: 0 auto; border: 1px solid #ccc; padding: 10px; }';
    echo '.header { text-align: center; font-size: 18px; font-weight: bold; margin-bottom: 10px; }';
    echo '.info { font-size: 12px; margin-bottom: 10px; }';
    echo 'table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }';
    echo 'table, th, td { border: 1px solid #ddd; }';
    echo 'th, td { padding: 8px; text-align: left; }';
    echo '.footer { font-size: 14px; text-align: center; margin-top: 20px; }';
    echo '@media print {';
    echo '  body { margin: 0; padding: 10px; }';
    echo '  .container { border: none; }';
    echo '  .footer { display: none; }';
    echo '}';
    echo '</style>';
    echo '<script>';
    echo 'function printReceipt() { window.print(); }';
    echo '</script>';
    echo '</head>';
    echo '<body onload="printReceipt()">';
    echo '<div class="container">';
    echo '<div class="header">SuahPatu</div>';
    echo '<div class="info">';
    echo '<p>Alamat: Jl. Belibis No.27, Air Tawar Bar., Kec. Padang Utara, Kota Padang, Sumatera Barat 25132</p>';
    echo '<p>No. HP: 083862644921</p>';
    echo '</div>';
    echo '<table>';
    echo '<tr><th>Nama</th><td>' . $data_struk['nama'] . '</td></tr>';
    echo '<tr><th>Alamat</th><td>' . $data_struk['alamat'] . '</td></tr>';
    echo '<tr><th>No. HP</th><td>' . $data_struk['nohp'] . '</td></tr>';
    echo '<tr><th>Tanggal</th><td>' . $data_struk['tanggal'] . '</td></tr>';
    echo '<tr><th>Jenis Sepatu</th><td>' . $data_struk['jenis_sepatu'] . '</td></tr>';
    echo '<tr><th>Status Pembayaran</th><td>' . $data_struk['status_pembayaran'] . '</td></tr>';
    echo '<tr><th>Status Pesanan</th><td>' . $data_struk['status_pesanan'] . '</td></tr>';
    echo '</table>';
    echo '<div class="footer">Terima kasih atas pemesanannya, jangan lupa cuci kembali di SuahPatu!!</div>';
    echo '</div>';
    echo '</body>';
    echo '</html>';
} else {
    // Handle kesalahan jika data tidak ditemukan
    echo "Data pesanan tidak ditemukan.";
}

// Menutup koneksi database
mysqli_close($koneksi);
?>
