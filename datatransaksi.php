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
    .modal {
  display: none;
  z-index: 1;
  padding-top: 50px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.9);
}

.modal-content {
  margin: auto;
  margin-top: 50px;
  display: block;
  width: auto;
  height: auto;
}

.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  cursor: pointer;
}

  </style>
</head>
<body>

<div class="container mt-4">
  <h2>Data Transaksi</h2>

  <!-- Formulir Pencarian -->
  <form method="GET" action="">
    <div class="search-container">
      <input type="text" class="form-control" id="search" name="search" value="<?php echo $search; ?>" placeholder="Cari Transaksi">
      <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
    </div>
  </form>

  <table class="table mt-3">
    <thead>
      <tr>
        <th scope="col" style="width: 50px;">No</th>
        <th scope="col" style="width: 200px;">Nama</th>
        <th scope="col" style="width: 200px;">Paket</th>
        <th scope="col" >Metode</th>
        <th scope="col">Total Bayar</th>
        <th scope="col">Bukti Pembayaran</th>
      </tr>
    </thead>
    <tbody>
    <?php
    // Query untuk mengambil data pelanggan dari tabel pelanggan berdasarkan pencarian
    $query = "SELECT * FROM transaksi WHERE namapaket LIKE '%$search%'";
    $result = mysqli_query($koneksi, $query);

    // Variabel counter untuk nomor
    $counter = 1;

    // Loop untuk menampilkan data pelanggan dalam bentuk tabel
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<th scope='row'>" . $counter++ . "</th>";
        echo "<td>" . $row['nama'] . "</td>";
        echo "<td>" . $row['namapaket'] . "</td>";
        echo "<td>" . $row['metode'] . "</td>";
        echo "<td>" . $row['totalbayar'] . "</td>";
        echo "<td><img src='uploads/" . $row['buktibayar'] . "' class='popup-image' style='max-width: 100px; max-height: 100px; cursor: pointer;'></td>";
        echo "</tr>";

        
    }

    // Menutup koneksi database
    mysqli_close($koneksi);
    ?>
</tbody>

  </table>
</div>
<div id="imageModal" class="modal">
  <span class="close" onclick="closeModal()">&times;</span>
  <img class="modal-content" id="modalImage">
</div>


<!-- Bootstrap JS dan jQuery (Diperlukan untuk komponen Bootstrap yang memerlukan JavaScript) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
// Open modal
function openModal() {
  document.getElementById('imageModal').style.display = 'block';
}

// Close modal
function closeModal() {
  document.getElementById('imageModal').style.display = 'none';
}

// Close modal when clicking outside the image
window.onclick = function(event) {
  var modal = document.getElementById('imageModal');
  if (event.target == modal) {
    closeModal();
  }
};

// Set modal image source and open modal
document.querySelectorAll('.popup-image').forEach(function(el) {
  el.addEventListener('click', function() {
    var modalImage = document.getElementById('modalImage');
    modalImage.src = this.src;

    // Set max-width and max-height for the modal
    var maxWidth = window.innerWidth * 0.8; // 80% of window width
    var maxHeight = window.innerHeight * 0.8; // 80% of window height
    modalImage.style.maxWidth = maxWidth + 'px';
    modalImage.style.maxHeight = maxHeight + 'px';

    openModal();
  });
});
</script>

</body>
</html>
