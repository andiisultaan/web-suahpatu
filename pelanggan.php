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
  <title>Pelanggan Dashboard</title>
  <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- FontAwesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      background-image: url('sepatu.jpeg'); /* Ganti dengan path gambar latar belakang yang sesuai */
      background-size: auto;
      background-position: center;
      color: #fff;
      font-family: 'Helvetica', sans-serif;
      padding-top: 56px;
      margin: 0;
      opacity: 0; /* Nilai awal opasitas 0 untuk efek fade-in */
      transition: opacity 2s ease-in-out; /* Transisi opasitas selama 5 detik */
    }
    .welcome-container {
      text-align: center;
      padding: 50px;
      background-color: rgba(0, 0, 0, 0.5); /* Warna latar belakang dengan tingkat transparansi */
      border-radius: 0px; /* Sudut sudut background */
    }

    .content-section{
      text-align: justify;
      padding: 50px;
      background-color: rgba(0, 0, 0, 0.5); /* Warna latar belakang dengan tingkat transparansi */
      border-radius: 0px; 
    }    
    .layanan-section{
      text-align: center;
      padding-top: 50px;
      padding-bottom: 50px;
      padding-left: 200px;
      padding-right: 200px;
      background-color: rgba(0, 0, 0, 0.5); /* Warna latar belakang dengan tingkat transparansi */
      border-radius: 0px; 
    }
    .jenis-section{
      text-align: center;
      padding-top: 50px;
      padding-bottom: 50px;
      padding-left: 200px;
      padding-right: 200px;
      background-color: rgba(0, 0, 0, 0.5); /* Warna latar belakang dengan tingkat transparansi */
      border-radius: 0px; 
    }
    .contact{
      text-align: center;
      padding: 50px;
      background-color: rgba(0, 0, 0, 0.5); /* Warna latar belakang dengan tingkat transparansi */
      border-radius: 0px; 
    }
    .contact .row {
        flex-wrap: wrap;
    }

    .contact .row .map {
        height: 30rem;
    }

    .contact .row form {
        padding-top: 0;
    }
    .map {
      width: 50%;
      height: 300px; /* Adjust the height as needed */
    }
    .fa-icon {
      margin-right: 5px;
    }
  </style>
</head>

<body>
  <div class="welcome-container">
    <h1 ><?php echo $welcome_message; ?></h1>
    <p>Selamat datang di Suahpatu, tempat di mana setiap langkah adalah kelembutan untuk sepatu Anda!</p>
  </div>

  <div class="content-section">
      <h1 style="text-align: center;">Tentang Suahpatu</h1>
      <p style="margin-left: 200px;
        margin-right: 200px;">Di Suahpatu, kami berkomitmen memberikan pencucian sepatu berkualitas tinggi dengan sentuhan keahlian tangan terampil dan teknologi canggih. Keamanan, kebersihan, dan dedikasi untuk detail adalah yang kami utamakan. Dengan tim ahli yang peduli, kami memahami nilai setiap langkah dan ingin menjadi bagian dari cerita sepatu Anda. Terima kasih telah memilih Suahpatu, di mana setiap sepatu mendapat perhatian istimewa untuk setiap langkah yang Anda ambil.</p>
  </div>

  <div class="jenis-section">
  <div class="container">
          <div class="row text-center mb-3">
            <div class="col">
              <h2>Jenis Sepatu</h2>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
              <div class="card">
                <img src="img/pentofel.jpg" class="card-img-top" alt="1" />
                <div class="card-body">
                  <p class="card-text text-dark">Authentic Leather (Berbahan dasar kulit asli / Genuine Leather)</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card">
                <img src="img/adidas.jpg" class="card-img-top" alt="2" />
                <div class="card-body">
                  <p class="card-text text-dark">Synthetic Leather (Berbahan dasar kulit sintesis)</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card">
                <img src="img/converse.jpg" class="card-img-top" alt="3" />
                <div class="card-body">
                  <p class="card-text text-dark">Canvas (Berbahan dasar kain)</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card">
                <img src="img/suede.jpg" class="card-img-top" alt="4" />
                <div class="card-body">
                  <p class="card-text text-dark">Suede (Berbahan bulu)</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card">
                <img src="img/knit.jpg" class="card-img-top" alt="5" />
                <div class="card-body">
                  <p class="card-text text-dark">Knit (Berbahan rajut)</p>
                </div>
              </div>
            </div>
          </div>
        </div>
  </div>

  <div class="layanan-section">
    <h1>Layanan Kami</h1>
    <table class="table table-dark mt-3">
    <thead>
      <tr>
        <th scope="col" style="width: 200px; ">Paket</th>
        <th scope="col" style="width: 200px; ">Deskripsi</th>
        <th scope="col"style="width: 200px;">Harga</th>
      </tr>
    </thead>
    <tbody>
      <?php
      include_once 'koneksi.php';

      // Query untuk mengambil jenis paket dari tabel paket
      $query = "SELECT DISTINCT namapaket, deskripsi, harga FROM paket";
      $result = mysqli_query($koneksi, $query);

      // Cek apakah ada data
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['namapaket'] . "</td>";
          echo "<td style='text-align: left;'>" . $row['deskripsi'] . "</td>";
          echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>"; // Menggunakan number_format untuk format harga
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='4'>Tidak ada layanan yang tersedia.</td></tr>";
      }

      // Menutup koneksi database
      mysqli_close($koneksi);
      ?>
      
    </tbody>
  </table>
  <form action="order.php" class="add-container">
      <button type="submit" class="btn btn-dark">
          <i class="fa-solid fa-basket-shopping"></i> Pesan Sekarang
      </button>
  </form>

  </div>

  <div class="contact">
    <h1 class="text-center mb-4">Lokasi Kami</h1>

    <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d352.6099253842411!2d100.34642221123511!3d-0.9001798272679624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4bf59f7f57fed%3A0xc46b3bbbac07afb0!2sHR%20Laundry%20Express!5e0!3m2!1sen!2sid!4v1677009050016!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>    
  </div>
  </div>


<!-- Bootstrap JS dan jQuery (Diperlukan untuk komponen Bootstrap yang memerlukan JavaScript) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  // Menunggu dokumen selesai dimuat
  document.addEventListener("DOMContentLoaded", function() {
    // Menetapkan opasitas menjadi 1 setelah dokumen dimuat (efek fade-in)
    document.body.style.opacity = 1;
    document.querySelector('.welcome-container').style.opacity = 1;
  });
</script>
</body>
<?php
include('footer.php');
?>