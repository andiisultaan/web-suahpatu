<?php
include_once 'koneksi.php';
include("headerpelanggan.php");

// Ambil informasi pelanggan dari session
if (isset($_SESSION['pelanggan_login_id'])) {
    $login_id = $_SESSION['pelanggan_login_id'];
    $query = "SELECT * FROM pelanggan WHERE id = $login_id";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $pelanggan = mysqli_fetch_assoc($result);
        $welcome_message = "Halo, " . $pelanggan['nama'] . "!";
    } else {
        // Menampilkan alert dan redirect menggunakan JavaScript
        echo "<script>alert('Informasi pelanggan tidak ditemukan. Silakan login kembali.');</script>";
        echo "<script>window.location.href = 'login.php';</script>";
        exit();
    }
} else {
    // Redirect ke halaman login jika belum login sebagai pelanggan
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pemesanan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      body {
        background-image: url('sepatu.jpeg'); /* Ganti dengan path gambar latar belakang registrasi Anda */
        background-size: cover;
        background-position: center;
        color: #fff;
        font-family: 'Helvetica', sans-serif;
        margin: auto;
        padding: 0;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative; /* Added for positioning overlay */
      }

      .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6); /* Adjust the alpha value for darkness */
      }

      body:hover .overlay {
        opacity: 1;
        transition: opacity 1s ease-in-out;
      }

      .transparent-black-bg {
        background-color: rgba(0, 0, 0, 0.7); /* Adjust the alpha value as needed for transparency */
        padding: 20px;
        width: 500px;
        border-radius: 10px;
        margin-top: 350px;
        padding-top: 10px;
      }

      /* Custom style to make text white */
    

      .btn-primary {
        background-color: #007bff; /* Bootstrap primary color */
      }

      /* Override Bootstrap's default file input style */
      .form-control-file {
        color: white;
      }
      
    </style>
  </head>
  <body>
    <?php
    // Ambil informasi pelanggan dari session
    if (isset($_SESSION['pelanggan_login_id'])) {
        $login_id = $_SESSION['pelanggan_login_id'];
        $query_pelanggan = "SELECT * FROM pelanggan WHERE id = $login_id";
        $result_pelanggan = mysqli_query($koneksi, $query_pelanggan);

        if ($result_pelanggan && mysqli_num_rows($result_pelanggan) > 0) {
            $pelanggan = mysqli_fetch_assoc($result_pelanggan);
    ?>

    <div class="container transparent-black-bg">
        <h2 class="text-center">Order</h2>
        <form action="orderact.php" method="post" enctype="multipart/form-data">
          <!-- Hidden input untuk menyimpan ID pelanggan -->
          <input type="hidden" name="pelanggan_id" value="<?php echo $pelanggan['id']; ?>">

          <!-- Informasi pelanggan -->
          <div class="form-group">
            <label for="nama_pelanggan">Nama Pelanggan:</label>
            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo $pelanggan['nama']; ?>">
          </div>

          <div class="form-group">
              <label for="alamat_pelanggan">Alamat:</label>
              <textarea class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" rows="4"><?php echo $pelanggan['alamat']; ?></textarea>
          </div>

          <div class="form-group">
            <label for="bohp">No HP:</label>
            <input type="text" class="form-control" id="nohp" name="nohp" value="<?php echo $pelanggan['nohp']; ?>">
          </div>

          <!-- Pilihan jenis sepetu -->
          <div class="form-group">
            <label for="paket">Pilih Jenis Sepatu:</label>
            <select class="form-control" id="jenis" name="jenis_sepatu">
              <?php
              // Ambil data paket dari database
              $query_paket = "SELECT id, jenis_sepatu FROM sepatu";
              $result_paket = mysqli_query($koneksi, $query_paket);

              // Tampilkan sebagai opsi dalam dropdown
              while ($row_paket = mysqli_fetch_assoc($result_paket)) {
                echo "<option value='" . $row_paket['jenis_sepatu'] . "'>" . $row_paket['jenis_sepatu'] . "</option>";
              }
              ?>
            </select>
          </div>

          <!-- Pilihan paket -->
          <div class="form-group">
            <label for="paket">Pilih Paket:</label>
            <select class="form-control" id="paket" name="paket">
              <?php
              // Ambil data paket dari database
              $query_paket = "SELECT id, namapaket, harga FROM paket";
              $result_paket = mysqli_query($koneksi, $query_paket);

              // Tampilkan sebagai opsi dalam dropdown
              while ($row_paket = mysqli_fetch_assoc($result_paket)) {
                  echo "<option value='" . $row_paket['namapaket'] . "' data-harga='" . $row_paket['harga'] . "'>" . $row_paket['namapaket'] . "</option>";
              }
              ?>
            </select>
          </div>

          <!-- Pilihan metode pembayaran -->
          <div class="form-group">
            <label for="metode_pembayaran">Pilih Metode Pembayaran:</label>
            <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
              <?php
              // Ambil data metode pembayaran dari database
              $query_metode_pembayaran = "SELECT id, metode FROM metode_bayar";
              $result_metode_pembayaran = mysqli_query($koneksi, $query_metode_pembayaran);

              // Tampilkan sebagai opsi dalam dropdown
              while ($row_metode_pembayaran = mysqli_fetch_assoc($result_metode_pembayaran)) {
                echo "<option value='" . $row_metode_pembayaran['metode'] . "'>" . $row_metode_pembayaran['metode'] . "</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label for="bohp">Nominal Pembayaran:</label>
            <input type="text" class="form-control" id="totalbayar" name="totalbayar" placeholder="Masukan Nomimal Pembayaran">
          </div>
          <?php
              echo '<script>';
              echo 'var paketSelect = document.getElementById("paket");';
              echo 'paketSelect.addEventListener("change", function () {';
              echo 'var selectedOption = paketSelect.options[paketSelect.selectedIndex];';
              echo 'var hargaPaket = selectedOption.getAttribute("data-harga");';
              echo 'document.getElementById("totalbayar").value = hargaPaket;';
              echo '});';
              echo '</script>';
          ?>


          <!-- Input bukti pembayaran -->
          <div class="form-group">
              <label for="bukti_pembayaran">Upload Bukti Pembayaran (Maksimal 5MB):</label>
              <input type="file" class="form-control-file" id="bukti_pembayaran" name="bukti_bayar" accept=".jpg, .jpeg, .png" maxlength="5MB" required>
          </div>


          <!-- Tombol Submit -->
          <button type="submit" class="btn btn-primary">Submit Order</button>
        </form>
    </div>  
    <?php
        } else {
            // Menampilkan alert dan redirect menggunakan JavaScript
            echo "<script>alert('Informasi pelanggan tidak ditemukan. Silakan login kembali.');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
            exit();
        }
    } else {
        // Redirect ke halaman login jika belum login sebagai pelanggan
        header("location: login.php");
        exit();
    }

    // Tutup koneksi
    mysqli_close($koneksi);
    ?>

    <!-- Bootstrap JS dan jQuery (Diperlukan untuk komponen Bootstrap yang memerlukan JavaScript) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      // Menunggu dokumen selesai dimuat
      document.addEventListener("DOMContentLoaded", function() {
        // Menetapkan opasitas menjadi 1 setelah dokumen dimuat (efek fade-in)
        document.body.style.opacity = 5;
        document.querySelector('.registration-container').style.opacity = 5;
      });
    </script>
  </body>
</html>








