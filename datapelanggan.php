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
  <h2>Data Pelanggan</h2>

  <!-- Formulir Pencarian -->
  <form method="GET" action="">
    <div class="search-container">
      <input type="text" class="form-control" id="search" name="search" value="<?php echo $search; ?>" placeholder="Cari Nama Pelanggan">
      <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
    </div>
  </form>

  <table class="table mt-3">
    <thead>
      <tr>
        <th scope="col" style="width: 50px;">No</th>
        <th scope="col" style="width: 200px;">Nama</th>
        <th scope="col" style="width: 400px;">Alamat</th>
        <th scope="col">No. HP</th>
        <th scope="col">Email</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php
    // Query untuk mengambil data pelanggan dari tabel pelanggan berdasarkan pencarian
    $query = "SELECT * FROM pelanggan WHERE nama LIKE '%$search%'";
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
        echo "<td>" . $row['email'] . "</td>";
        // Tambahkan kolom aksi dengan ikon hapus dan edit
        echo "<td>
                <a href='#' data-toggle='modal' data-target='#editModal_" . $row['id'] . "' title='Edit'><i class='fas fa-edit'></i></a>
                <a href='admhapus_pelanggan.php?id=" . $row['id'] . "' title='Hapus'><i class='fas fa-trash-alt'></i></a>
              </td>";
        echo "</tr>";
        
        // Modal Edit
echo "
<div class='modal fade' id='editModal_" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='editModalLabel_" . $row['id'] . "' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='editModalLabel_" . $row['id'] . "'>Edit Data Pelanggan</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <!-- Isi formulir edit di sini -->
                <form action='admedit_pelangganact.php' method='post'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <div class='form-group'>
                        <label for='username'>Username</label>
                        <input type='text' class='form-control' id='username' name='username' value='" . $row['username'] . "' readonly>
                    </div>
                    <div class='form-group'>
                        <label for='password'>Password</label>
                        <input type='password' class='form-control' id='password' name='password' placeholder='Enter your password'>
                    </div>
                    <div class='form-group'>
                        <label for='nama'>Nama</label>
                        <input type='text' class='form-control' id='nama' name='nama' value='" . $row['nama'] . "'>
                    </div>
                    <div class='form-group'>
                        <label for='alamat'>Alamat</label>
                        <textarea class='form-control' id='alamat' name='alamat'>" . $row['alamat'] . "</textarea>
                    </div>
                    <div class='form-group'>
                        <label for='nohp'>No. HP</label>
                        <input type='tel' class='form-control' id='nohp' name='nohp' value='" . $row['nohp'] . "'>
                    </div>
                    <div class='form-group'>
                        <label for='email'>Email</label>
                        <input type='email' class='form-control' id='email' name='email' value='" . $row['email'] . "'>
                    </div>
                    <button type='submit' class='btn btn-primary'>Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
";
        
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
