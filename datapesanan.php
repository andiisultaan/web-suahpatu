<?php
include_once 'koneksi.php';
include("headeradmin.php");

if (isset($_SESSION['admin_login_id'])) {
  $login_id = $_SESSION['admin_login_id'];
  // Lakukan query untuk mendapatkan informasi admin berdasarkan login_id
  // Sesuaikan dengan struktur tabel dan kolom yang digunakan
  include("koneksi.php");
  $query = "SELECT * FROM admin WHERE login_id = $login_id";
  $result = mysqli_query($koneksi, $query);
  
  if ($result && mysqli_num_rows($result) > 0) {
      $admin = mysqli_fetch_assoc($result);
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
// Fungsi untuk membersihkan input pengguna
function cleanInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Pemrosesan pencarian
$search = "";
if (isset($_GET['search'])) {
    $search = cleanInput($_GET['search']);
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

  <!-- Formulir Pencarian -->
  <form method="GET" action="">
    <div class="search-container">
      <input type="text" class="form-control" id="search" name="search" value="<?php echo $search; ?>" placeholder="Cari Pesanan">
      <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
    </div>
  </form>

  <table class="table mt-3">
    <thead>
      <tr>
        <th scope="col" style="width: 50px;">No</th>
        <th scope="col" style="width: 150px;">Nama</th>
        <th scope="col" style="width: 150px;">Alamat</th>
        <th scope="col" style="width: 70px;">No. HP</th>
        <th scope="col" style="width: 80px;">Tanggal Pemesanan</th>
        <th scope="col" style="width: 100px;">Jenis Sepatu</th>
        <th scope="col" style="width: 200px;">Status Pemesanan</th>
        <th scope="col" style="width: 170px;">Status Pembayaran</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php
    // Query untuk mengambil data pelanggan dari tabel pelanggan berdasarkan pencarian
    $query = "SELECT * FROM transaksi WHERE nama LIKE '%$search%'";
    $result = mysqli_query($koneksi, $query);

    // Variabel counter untuk nomor
    $counter = 1;

    // Loop untuk menampilkan data pelanggan dalam bentuk tabel
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<th scope='row'>" . $counter++ . "</th>";
        echo "<td>" . $row['nama'] . "</td>";
        echo "<td>" . $row['alamat'] . "</td>";
        echo "<td>" . $row['nohp'] . "</td>";
        echo "<td>" . $row['tanggal'] . "</td>";
        echo "<td>" . $row['jenis_sepatu'] . "</td>";
        // Tambahkan kolom aksi dengan ikon hapus dan edit
echo "<td><form method='post' action='update_pesanan.php'>
<div class='input-group'>";

// Ambil data transaksi berdasarkan ID atau metode lainnya sesuai dengan aplikasi Anda
$id_transaksi = $row['id'];
$query_transaksi = "SELECT status_pesanan, status_pembayaran FROM transaksi WHERE id = $id_transaksi";
$result_transaksi = mysqli_query($koneksi, $query_transaksi);
$row_transaksi = mysqli_fetch_assoc($result_transaksi);

// Simpan status yang telah diubah ke variabel
$status_pesanan_terpilih = $row_transaksi['status_pesanan'];
$status_pembayaran_terpilih = $row_transaksi['status_pembayaran'];

// Tampilkan opsi dropdown status_pesanan dengan status yang telah diubah
echo "<select class='form-control' name='status_pesanan' id='status_pesanan'>";
$query1 = "SELECT status_pesanan FROM status_pesanan";
$result1 = mysqli_query($koneksi, $query1);

while ($row1 = mysqli_fetch_assoc($result1)) {
$selected = ($row1['status_pesanan'] == $status_pesanan_terpilih) ? 'selected' : '';
echo "<option value='" . $row1['status_pesanan'] . "' $selected>" . $row1['status_pesanan'] . "</option>";
}
echo "</select>
</div>
</td>";

// Tampilkan opsi dropdown status_pembayaran dengan status yang telah diubah
echo "<td>
<div class='input-group'>
    <select class='form-control' name='status_pembayaran' id='status_pembayaran'>";
$query2 = "SELECT status_pembayaran FROM status_pembayaran";
$result2 = mysqli_query($koneksi, $query2);

while ($row2 = mysqli_fetch_assoc($result2)) {
$selected = ($row2['status_pembayaran'] == $status_pembayaran_terpilih) ? 'selected' : '';
echo "<option value='" . $row2['status_pembayaran'] . "' $selected>" . $row2['status_pembayaran'] . "</option>";
}
echo "</select>
</div>
</td>";

// Tambahkan kolom aksi dengan ikon hapus dan edit
echo "<td>
<input type='hidden' name='id' value='" . $row['id'] . "'>
<button type='submit' class='btn btn-primary'><i class='fas fa-check'></i></button>
</form>
</td>";
echo "</tr>";

    
        
    }

    // Menutup koneksi database
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
