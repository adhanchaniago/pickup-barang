-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jun 2020 pada 17.51
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pickup_barang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Administrator'),
(2, 'Operator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan_paket`
--

CREATE TABLE `layanan_paket` (
  `id_layanan_paket` int(11) NOT NULL,
  `layanan_paket` varchar(100) NOT NULL,
  `harga_layanan_paket` int(11) NOT NULL,
  `durasi_pengiriman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `layanan_paket`
--

INSERT INTO `layanan_paket` (`id_layanan_paket`, `layanan_paket`, `harga_layanan_paket`, `durasi_pengiriman`) VALUES
(1, 'OKE (Ongkos Kirim Ekonomis)', 8000, 48),
(2, 'YES (Yakin Esok Sampai)', 18000, 23),
(3, 'REG (Regular)', 10000, 32);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `isi_log` text NOT NULL,
  `tanggal_log` datetime NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `isi_log`, `tanggal_log`, `id_user`) VALUES
(1, 'Pengguna andri123 berhasil logout', '2020-06-09 02:49:10', 1),
(2, 'Pengguna andri123 berhasil login', '2020-06-09 02:49:16', 1),
(3, 'Pengguna andri123 berhasil menambahkan Layanan Paket OKE (Ongkos Kirim Ekonomis)', '2020-06-09 02:52:24', 1),
(4, 'Pengguna andri123 berhasil menambahkan Layanan Paket YES (Yakin Esok Sampai)', '2020-06-09 02:52:35', 1),
(5, 'Pengguna andri123 berhasil menambahkan Layanan Paket REG (Regular)', '2020-06-09 02:52:45', 1),
(9, 'Pelanggan Andri Firman Saputra berhasil menambahkan pesanan Buku Matematika SPM untuk SMK/MAK', '2020-06-09 02:54:20', NULL),
(10, 'Pelanggan Andre berhasil menambahkan pesanan Gunting', '2020-06-09 03:00:36', NULL),
(11, 'Pengguna andri123 berhasil login', '2020-06-09 16:50:48', 1),
(12, 'Pengguna andri123 berhasil logout', '2020-06-09 16:50:52', 1),
(13, 'Pengguna andri123 berhasil login', '2020-06-09 16:51:02', 1),
(14, 'Pengguna andri123 berhasil mengubah Pickup Barang ', '2020-06-09 17:06:59', 1),
(15, 'Pengguna andri123 berhasil logout', '2020-06-09 17:08:24', 1),
(16, 'Pengguna andre123 berhasil login', '2020-06-09 17:08:28', 3),
(17, 'Pengguna andre123 berhasil logout', '2020-06-09 17:11:29', 3),
(18, 'Pengguna andri123 berhasil login', '2020-06-09 17:11:33', 1),
(19, 'Pengguna andri123 berhasil login', '2020-06-09 17:31:31', 1),
(20, 'Pengguna andri123 berhasil logout', '2020-06-09 17:32:28', 1),
(21, 'Pengguna andri123 berhasil login', '2020-06-10 19:03:47', 1),
(22, 'Pengguna andri123 berhasil logout', '2020-06-10 19:04:09', 1),
(23, 'Pengguna andri123 berhasil login', '2020-06-10 19:04:56', 1),
(24, 'Pengguna andri123 berhasil login', '2020-06-10 19:27:43', 1),
(25, 'Pengguna andri123 berhasil mengubah Pickup Barang ', '2020-06-10 21:49:23', 1),
(26, 'Pengguna andri123 berhasil mengubah Pickup Barang ', '2020-06-10 21:49:59', 1),
(27, 'Pengguna andri123 berhasil mengubah Pickup Barang ', '2020-06-10 21:51:37', 1),
(28, 'Pengguna andri123 berhasil mengubah Pickup Barang ', '2020-06-10 21:51:50', 1),
(29, 'Pengguna andri123 berhasil mengubah Pickup Barang ', '2020-06-10 21:55:48', 1),
(30, 'Pengguna andri123 berhasil mengubah Pickup Barang ', '2020-06-10 21:57:02', 1),
(31, 'Pengguna andri123 berhasil mengubah Pickup Barang ', '2020-06-10 21:58:17', 1),
(32, 'Pengguna andri123 berhasil mengubah Pickup Barang ', '2020-06-10 21:58:37', 1),
(33, 'Pengguna andri123 berhasil mengubah Pickup Barang ', '2020-06-10 21:58:48', 1),
(34, 'Pengguna andri123 berhasil mengubah Pickup Barang ', '2020-06-10 21:58:58', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pickup_barang`
--

CREATE TABLE `pickup_barang` (
  `id_pickup_barang` int(11) NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `no_whatsapp_pengirim` varchar(25) NOT NULL,
  `alamat_pengirim` text NOT NULL,
  `nama_barang` text NOT NULL,
  `berat_barang` float NOT NULL,
  `jumlah_barang` int(4) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `no_whatsapp_penerima` varchar(25) NOT NULL,
  `alamat_penerima` text NOT NULL,
  `tanggal_pemesanan` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `id_layanan_paket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pickup_barang`
--

INSERT INTO `pickup_barang` (`id_pickup_barang`, `nama_pengirim`, `no_whatsapp_pengirim`, `alamat_pengirim`, `nama_barang`, `berat_barang`, `jumlah_barang`, `nama_penerima`, `no_whatsapp_penerima`, `alamat_penerima`, `tanggal_pemesanan`, `status`, `id_layanan_paket`) VALUES
(5, 'Andri Firman Saputra', '087808675313', 'Jl. Amd Babakan Pocis No. 100 RT02/02', 'Buku Matematika SPM untuk SMK/MAK', 2, 1, 'Andre Farhan Saputra', '087878787878', 'Jl. Amd Babakan Pocis No. 69 RT02/02', '2020-06-09 02:54:20', 3, 2),
(6, 'Andre', '08780834222', 'Pocis no. 32', 'Gunting', 5, 10, 'Andri', '08787878787', 'Pocis No. 33', '2020-06-09 03:00:36', 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `img_profile` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `img_profile`, `username`, `password`, `id_jabatan`) VALUES
(1, 'Andri Firman Saputra', 'default2.png', 'andri123', '$2y$10$NYR5auwjiW4rpADsuDMukeO4JVTZ6rx0e7BNOorbFdYQyYB2J/ExS', 1),
(3, 'Andre Farhan Saputra', 'avatar0411.png', 'andre123', '$2y$10$/mBJ.knd1vr4gKf/cbzk9Ofexvq4SD6SR.g4F5RfPCi5AXHSml2Lu', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `layanan_paket`
--
ALTER TABLE `layanan_paket`
  ADD PRIMARY KEY (`id_layanan_paket`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pickup_barang`
--
ALTER TABLE `pickup_barang`
  ADD PRIMARY KEY (`id_pickup_barang`),
  ADD KEY `id_layanan_paket` (`id_layanan_paket`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `layanan_paket`
--
ALTER TABLE `layanan_paket`
  MODIFY `id_layanan_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `pickup_barang`
--
ALTER TABLE `pickup_barang`
  MODIFY `id_pickup_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pickup_barang`
--
ALTER TABLE `pickup_barang`
  ADD CONSTRAINT `pickup_barang_ibfk_1` FOREIGN KEY (`id_layanan_paket`) REFERENCES `layanan_paket` (`id_layanan_paket`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
