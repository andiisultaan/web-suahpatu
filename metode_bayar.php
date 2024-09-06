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
  <div class="row">
    <div class="col-md-6">
      <h2>Metode Pembayaran</h2>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6">
        <!-- Tambah Paket -->
        <form action="" class="add-container">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahMetodeModal">
                <i class="fa-solid fa-plus"></i>&nbsp; Metode Pembayaran
            </button>
        </form>
  </div>
</div>


  <table class="table mt-3">
    <thead>
      <tr>
        <th scope="col" style="width: 100px;">No</th>
        <th scope="col" style="width: 900px;">Metode Pembayaran</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Query untuk mengambil data sepatu dari tabel paket berdasarkan pencarian
      $query = "SELECT * FROM metode_bayar WHERE metode LIKE '%$search%'";
      $result = mysqli_query($koneksi, $query);

      // Variabel counter untuk nomor
      $counter = 1;

      // Loop untuk menampilkan data paket dalam bentuk tabel
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<th scope='row'>" . $counter++ . "</th>";
        echo "<td>" . $row['metode'] . "</td>";
        // Tambahkan kolom aksi dengan ikon hapus dan edit
        echo "<td>
    <a href='#editModal_" . $row['id'] . "' data-toggle='modal' data-target='#editModal_" . $row['id'] . "' title='Edit'><i class='fas fa-edit'></i></a>
    <a href='hapus_metode.php?id=" . $row['id'] . "' title='Hapus'><i class='fas fa-trash-alt'></i></a>
</td>";
        echo "</tr>";
        // Modal Edit
echo "<div class='modal fade' id='editModal_" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='editModalLabel_" . $row['id'] . "' aria-hidden='true'>";
echo "    <div class='modal-dialog' role='document'>";
echo "        <div class='modal-content'>";
echo "            <div class='modal-header'>";
echo "                <h5 class='modal-title' id='editModalLabel_" . $row['id'] . "'>Edit Metode Pembayaran</h5>";
echo "                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
echo "                    <span aria-hidden='true'>&times;</span>";
echo "                </button>";
echo "            </div>";
echo "            <div class='modal-body'>";
// Formulir Edit
echo "                <form action='edit_metodeact.php' method='post'>";
echo "                    <input type='hidden' name='id' value='" . $row['id'] . "'>";
echo "                    <div class='form-group'>";
echo "                        <label for='metode'>Metode Pembayaran</label>";
echo "                        <input type='text' class='form-control' id='metode' name='metode' value='" . $row['metode'] . "'>";
echo "                    </div>";
echo "                    <button type='submit' class='btn btn-primary'>Simpan Perubahan</button>";
echo "                </form>";
echo "            </div>";
echo "        </div>";
echo "    </div>";
echo "</div>";
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


<!-- Modal Tambah Paket -->
<div class="modal fade" id="tambahMetodeModal" tabindex="-1" role="dialog" aria-labelledby="tambahMetodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahMetodeModalLabel">Tambah Metode Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulir Tambah Data Paket -->
                <form action="tambah_metodeact.php" method="post">
                    <div class="form-group">
                        <label for="namaPaket">Nama Metode Pembayaran</label>
                        <input type="text" class="form-control" id="metode" name="metode" placeholder="Masukkan Nama Metode Pembayaran" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
