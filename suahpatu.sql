-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Des 2023 pada 15.31
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suahpatu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `login_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`login_id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_akses`
--

CREATE TABLE `admin_akses` (
  `login_id` int(11) NOT NULL,
  `akses_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin_akses`
--

INSERT INTO `admin_akses` (`login_id`, `akses_id`) VALUES
(1, 'admin'),
(2, 'pelanggan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_akses`
--

CREATE TABLE `master_akses` (
  `akses_id` varchar(10) NOT NULL,
  `nama` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_akses`
--

INSERT INTO `master_akses` (`akses_id`, `nama`) VALUES
('admin', 'Admin'),
('pelanggan', 'Pelanggan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_bayar`
--

CREATE TABLE `metode_bayar` (
  `id` int(11) NOT NULL,
  `metode` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `metode_bayar`
--

INSERT INTO `metode_bayar` (`id`, `metode`) VALUES
(1, 'BCA'),
(3, 'BRI'),
(4, 'Mandiri'),
(5, 'DANA'),
(6, 'GoPay');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id` int(11) NOT NULL,
  `namapaket` varchar(20) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id`, `namapaket`, `deskripsi`, `harga`) VALUES
(7, 'Regular Cleaning', 'Pencucian reguler (3 Hari)', '30000'),
(8, 'Deep Cleaning', 'Pencucian Keselehuran (3 Hari)', '35000'),
(9, 'Fast Cleaning', 'Pencucian Sepatu (1 Hari)', '45000'),
(10, 'Repaint', 'Cat ulang sepatu agar seperti baru, termasuj regular cleaning (5 Hari)', '115000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `login_id` int(10) NOT NULL DEFAULT 2,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `login_id`, `username`, `password`, `nama`, `alamat`, `nohp`, `email`) VALUES
(8, 2, 'andi', '827ccb0eea8a706c4c34a16891f84e7b', 'Andi Sultan Al Ayyubi', 'Padang', '083862644921', 'andiisultaan@gmail.com'),
(9, 2, 'abel', '827ccb0eea8a706c4c34a16891f84e7b', 'Abel Levran', 'Padang', '0812390123', 'abelevran@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sepatu`
--

CREATE TABLE `sepatu` (
  `id` int(11) NOT NULL,
  `jenis_sepatu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sepatu`
--

INSERT INTO `sepatu` (`id`, `jenis_sepatu`) VALUES
(1, 'Authentic Leather (Berbahan dasar kulit asli / Genuine Leather)'),
(3, 'Synthetic Leather (Berbahan dasar kulit sintesis)'),
(4, 'Canvas (Berbahan dasar kain)'),
(5, 'Suede (Berbahan bulu-bulu)'),
(6, 'Knit (Berbahan rajut)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_pembayaran`
--

CREATE TABLE `status_pembayaran` (
  `id` int(11) NOT NULL,
  `status_pembayaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status_pembayaran`
--

INSERT INTO `status_pembayaran` (`id`, `status_pembayaran`) VALUES
(1, 'Belum Lunas'),
(2, 'Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_pesanan`
--

CREATE TABLE `status_pesanan` (
  `id` int(11) NOT NULL,
  `status_pesanan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status_pesanan`
--

INSERT INTO `status_pesanan` (`id`, `status_pesanan`) VALUES
(1, 'Sedang Dijemput'),
(2, 'Sedang dicuci'),
(3, 'Sedang Diantar'),
(4, 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nohp` varchar(50) NOT NULL,
  `namapaket` varchar(20) NOT NULL,
  `metode` varchar(25) NOT NULL,
  `totalbayar` varchar(50) NOT NULL,
  `buktibayar` varchar(50) NOT NULL,
  `jenis_sepatu` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `status_pesanan` varchar(25) NOT NULL,
  `status_pembayaran` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_pesanan`, `nama`, `alamat`, `nohp`, `namapaket`, `metode`, `totalbayar`, `buktibayar`, `jenis_sepatu`, `tanggal`, `status_pesanan`, `status_pembayaran`) VALUES
(14, 8, 'Andi Sultan Al Ayyubi', 'Padang', '083862644921', 'Deep Cleaning', 'BCA', '35000', 'WhatsApp Image 2023-12-01 at 19.59.13_dfcab265.jpg', 'Canvas (Berbahan dasar kain)', '2023-12-13', 'Sedang Dijemput', 'Lunas'),
(15, 9, 'Abel Levran', 'Padang', '0812390123', 'Repaint', 'DANA', '115000', 'WhatsApp Image 2023-12-01 at 19.59.13_dfcab265.jpg', 'Synthetic Leather (Berbahan dasar kulit sintesis)', '2023-12-13', 'Sedang dicuci', 'Lunas');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`login_id`);

--
-- Indeks untuk tabel `admin_akses`
--
ALTER TABLE `admin_akses`
  ADD KEY `login_id` (`login_id`),
  ADD KEY `akses_id` (`akses_id`);

--
-- Indeks untuk tabel `master_akses`
--
ALTER TABLE `master_akses`
  ADD PRIMARY KEY (`akses_id`);

--
-- Indeks untuk tabel `metode_bayar`
--
ALTER TABLE `metode_bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indeks untuk tabel `sepatu`
--
ALTER TABLE `sepatu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `status_pembayaran`
--
ALTER TABLE `status_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `status_pesanan`
--
ALTER TABLE `status_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `metode` (`metode`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `metode_bayar`
--
ALTER TABLE `metode_bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `sepatu`
--
ALTER TABLE `sepatu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `status_pembayaran`
--
ALTER TABLE `status_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `status_pesanan`
--
ALTER TABLE `status_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
