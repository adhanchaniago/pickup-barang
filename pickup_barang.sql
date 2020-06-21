-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jun 2020 pada 09.56
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

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
-- Struktur dari tabel `jenis_layanan`
--

CREATE TABLE `jenis_layanan` (
  `id_jenis_layanan` int(11) NOT NULL,
  `jenis_layanan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_layanan`
--

INSERT INTO `jenis_layanan` (`id_jenis_layanan`, `jenis_layanan`) VALUES
(1, 'REG (Reguler)'),
(2, 'OKE (Ongkos Kirim Ekonomis)'),
(3, 'YES (Yakin Esok Sampai)');

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
(1, 'Pengguna admin berhasil login', '2020-06-20 23:52:48', 1),
(2, 'Pengguna admin berhasil login', '2020-06-20 23:53:05', 1),
(3, 'Pengguna admin berhasil menambahkan pengguna andre975', '2020-06-20 23:54:42', 1),
(4, 'Pengguna andre975 berhasil dihapus', '2020-06-21 00:00:35', 1),
(5, 'Pengguna admin berhasil diubah', '2020-06-21 00:06:57', 1),
(6, 'Pengguna admin berhasil diubah', '2020-06-21 00:07:10', 1),
(7, 'Pengguna admin berhasil logout', '2020-06-21 00:07:13', 1),
(8, 'Pelanggan Andri Firman Saputra berhasil menambahkan pesanan ', '2020-06-21 00:08:32', NULL),
(9, 'Pelanggan Andri Firman Saputra berhasil menambahkan pesanan ', '2020-06-21 00:08:32', NULL),
(10, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 00:09:04', 1),
(11, 'Kurir admin Telah Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 00:09:13', 1),
(12, 'Pengguna admin berhasil login', '2020-06-21 00:30:06', 1),
(13, 'Pengguna admin mengimport nomor resi ', '2020-06-21 00:33:08', 1),
(14, 'Pengguna admin mengimport nomor resi ', '2020-06-21 00:33:48', 1),
(15, 'Pengguna admin mengimport nomor resi ', '2020-06-21 00:34:32', 1),
(16, 'Pengguna admin mengimport nomor resi ', '2020-06-21 00:34:38', 1),
(17, 'Pengguna admin mengimport nomor resi ', '2020-06-21 00:38:49', 1),
(18, 'Pickup Barang Andri Firman Saputra |  | Andre Farhan Saputra berhasil dihapus', '2020-06-21 00:39:40', 1),
(19, 'Pengguna admin berhasil menambahkan pesanan Andri Firman Saputra', '2020-06-21 00:40:03', 1),
(20, 'Pengguna admin mengimport nomor resi ', '2020-06-21 00:40:11', 1),
(21, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 00:40:18', 1),
(22, 'Kurir admin Telah Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 00:40:24', 1),
(23, 'Pengguna admin mengimport nomor resi ', '2020-06-21 01:14:55', 1),
(24, 'Pengguna admin berhasil mengubah Password', '2020-06-21 01:25:40', 1),
(25, 'Pengguna admin berhasil logout', '2020-06-21 01:25:43', 1),
(26, 'Pengguna admin berhasil login', '2020-06-21 01:25:51', 1),
(27, 'Pengguna admin berhasil mengubah Password', '2020-06-21 01:26:09', 1),
(28, 'Pengguna admin berhasil logout', '2020-06-21 01:26:12', 1),
(29, 'Pengguna admin berhasil login', '2020-06-21 01:26:16', 1),
(30, 'Pengguna admin berhasil menambahkan pesanan Hako', '2020-06-21 02:11:22', 1),
(31, 'Pickup Barang Hako |  | Anderson berhasil dihapus', '2020-06-21 02:12:12', 1),
(32, 'Pengguna admin berhasil menambahkan pesanan Andri Firman Saputra', '2020-06-21 02:26:35', 1),
(33, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 02:29:26', 1),
(34, 'Pelanggan Andri Firman Saputra berhasil menambahkan pesanan ', '2020-06-21 02:30:25', NULL),
(35, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 02:30:35', 1),
(36, 'Kurir admin Telah Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 02:30:45', 1),
(37, 'Pelanggan Andri Firman Saputra berhasil menambahkan pesanan ', '2020-06-21 02:32:26', NULL),
(38, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 02:32:33', 1),
(39, 'Kurir admin Telah Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 02:32:38', 1),
(40, 'Pengguna admin mengimport nomor resi ', '2020-06-21 02:35:27', 1),
(41, 'Pengguna admin berhasil login', '2020-06-21 11:49:00', 1),
(42, 'Pelanggan Andri Firman Saputra berhasil menambahkan pesanan ', '2020-06-21 11:53:08', NULL),
(43, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 11:53:49', 1),
(44, 'Pengguna admin berhasil login', '2020-06-21 12:02:10', 1),
(45, 'Pelanggan Andri Firman Saputra berhasil menambahkan pesanan ', '2020-06-21 12:05:14', NULL),
(46, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 12:05:23', 1),
(47, 'Kurir admin Telah Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 12:06:09', 1),
(48, 'Pengguna admin mengimport nomor resi ', '2020-06-21 12:06:23', 1),
(49, 'Pengguna admin berhasil menambahkan pesanan Andri Firman Saputra', '2020-06-21 12:09:14', 1),
(50, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 12:09:51', 1),
(51, 'Kurir admin Telah Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 12:09:57', 1),
(52, 'Pengguna admin mengimport nomor resi ', '2020-06-21 12:10:09', 1),
(53, 'Pelanggan Andri Firman Saputra berhasil menambahkan pesanan ', '2020-06-21 14:19:36', NULL),
(54, 'Pengguna admin berhasil login', '2020-06-21 14:26:43', 1),
(55, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 14:26:50', 1),
(56, 'Kurir admin Telah Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-21 14:26:56', 1),
(57, 'Pengguna admin mengimport nomor resi ', '2020-06-21 14:27:25', 1),
(58, 'Pengguna admin mengimport nomor resi ', '2020-06-21 14:28:25', 1),
(59, 'Pengguna admin mengimport nomor resi ', '2020-06-21 14:28:55', 1),
(60, 'Pengguna admin mengimport nomor resi ', '2020-06-21 14:30:57', 1),
(61, 'Pengguna admin mengimport nomor resi ', '2020-06-21 14:31:09', 1),
(62, 'Pengguna admin mengimport nomor resi ', '2020-06-21 14:35:04', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerima`
--

CREATE TABLE `penerima` (
  `id_penerima` int(11) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `no_wa_penerima` varchar(25) NOT NULL,
  `alamat_penerima` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penerima`
--

INSERT INTO `penerima` (`id_penerima`, `nama_penerima`, `no_wa_penerima`, `alamat_penerima`) VALUES
(1, 'Anderson', '+6287832211222', 'New York No. 12'),
(2, 'Anderson Farhan', '+62898123123', 'Jl. AMD Babakan Pocis No. 69, Setu, Tangsel, Banten 15315');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengirim`
--

CREATE TABLE `pengirim` (
  `id_pengirim` int(11) NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `no_wa_pengirim` varchar(25) NOT NULL,
  `alamat_pengirim` text NOT NULL,
  `ip_address` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengirim`
--

INSERT INTO `pengirim` (`id_pengirim`, `nama_pengirim`, `no_wa_pengirim`, `alamat_pengirim`, `ip_address`) VALUES
(1, 'Andri Firman Saputra', '+6287808675313', 'Jl. AMD Babakan Pocis No. 100', '::1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pickup_barang`
--

CREATE TABLE `pickup_barang` (
  `id_pickup_barang` int(11) NOT NULL,
  `no_resi` char(15) DEFAULT NULL,
  `id_pengirim` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `id_jenis_layanan` int(11) NOT NULL,
  `tanggal_pemesanan` datetime DEFAULT NULL,
  `tanggal_penjemputan` datetime DEFAULT NULL,
  `tanggal_masuk_logistik` datetime DEFAULT NULL,
  `tanggal_input_resi` datetime NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pickup_barang`
--

INSERT INTO `pickup_barang` (`id_pickup_barang`, `no_resi`, `id_pengirim`, `id_penerima`, `id_jenis_layanan`, `tanggal_pemesanan`, `tanggal_penjemputan`, `tanggal_masuk_logistik`, `tanggal_input_resi`, `id_status`) VALUES
(1, '540700080433320', 1, 1, 3, '2020-06-21 12:09:14', '2020-06-21 12:09:51', '2020-06-21 12:09:57', '2020-06-21 14:35:04', 4),
(2, NULL, 1, 2, 3, '2020-06-21 14:19:36', '2020-06-21 14:26:50', '2020-06-21 14:26:56', '0000-00-00 00:00:00', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'Pending'),
(2, 'Kurir Menjemput'),
(3, 'Barang Masuk Logistik'),
(4, 'Resi Terinput');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `img_profile` text NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `img_profile`, `nama_lengkap`, `username`, `password`, `id_jabatan`) VALUES
(1, 'avatar3.png', 'Administrator', 'admin', '$2y$10$4SogMAaHGgQtvtIbixTvieV4QZR6tC3efTPV8sENOjCxpgeXU.GTu', 1),
(2, 'default.png', 'Andri Firman Saputra', 'andri975', '$2y$10$B8CG0imMpSNlopfeBKBGBOQPUALR/LCpacCb5cXaWY9IrRuYtEg4a', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `jenis_layanan`
--
ALTER TABLE `jenis_layanan`
  ADD PRIMARY KEY (`id_jenis_layanan`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_user_2` (`id_user`);

--
-- Indeks untuk tabel `penerima`
--
ALTER TABLE `penerima`
  ADD PRIMARY KEY (`id_penerima`);

--
-- Indeks untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  ADD PRIMARY KEY (`id_pengirim`);

--
-- Indeks untuk tabel `pickup_barang`
--
ALTER TABLE `pickup_barang`
  ADD PRIMARY KEY (`id_pickup_barang`),
  ADD KEY `id_pengirim` (`id_pengirim`),
  ADD KEY `id_penerima` (`id_penerima`),
  ADD KEY `id_layanan` (`id_jenis_layanan`),
  ADD KEY `pickup_barang_ibfk_4` (`id_status`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

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
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenis_layanan`
--
ALTER TABLE `jenis_layanan`
  MODIFY `id_jenis_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id_penerima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  MODIFY `id_pengirim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pickup_barang`
--
ALTER TABLE `pickup_barang`
  MODIFY `id_pickup_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pickup_barang`
--
ALTER TABLE `pickup_barang`
  ADD CONSTRAINT `pickup_barang_ibfk_1` FOREIGN KEY (`id_jenis_layanan`) REFERENCES `jenis_layanan` (`id_jenis_layanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pickup_barang_ibfk_2` FOREIGN KEY (`id_penerima`) REFERENCES `penerima` (`id_penerima`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pickup_barang_ibfk_3` FOREIGN KEY (`id_pengirim`) REFERENCES `pengirim` (`id_pengirim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pickup_barang_ibfk_4` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
