-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2020 pada 13.41
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
(1, 'Administrator\r\n'),
(3, 'Operator');

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
(1, 'REG'),
(2, 'YES'),
(3, 'OKE');

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
(1, 'Pengguna admin berhasil menambahkan Jenis Layanan REG', '2020-06-19 10:49:18', 1),
(2, 'Pengguna admin berhasil menambahkan Jenis Layanan YES', '2020-06-19 10:49:25', 1),
(3, 'Pengguna admin berhasil menambahkan Jenis Layanan OKE', '2020-06-19 10:49:31', 1),
(4, 'Pengguna admin berhasil menambahkan pesanan Bambang', '2020-06-19 11:23:02', 1),
(5, 'Pengguna admin berhasil login', '2020-06-19 13:00:31', 1),
(6, 'Kurir admin Akan Mengambil Barang Di Jln ABC', '2020-06-19 13:14:29', 1),
(7, 'Kurir admin Telah Mengambil Barang Di Jln ABC', '2020-06-19 13:31:09', 1),
(8, 'Pengguna admin berhasil mengubah Pickup Barang 626451591895978', '2020-06-19 13:48:26', 1),
(9, 'Pengguna admin berhasil login', '2020-06-19 22:07:25', 1),
(10, 'Pengguna admin berhasil login', '2020-06-20 07:46:01', 1),
(11, 'Pengguna admin mengimport nomor resi ', '2020-06-20 08:29:17', 1),
(12, 'Pickup Barang Bambang |  | Sutejo berhasil dihapus', '2020-06-20 08:29:53', 1),
(13, 'Pickup Barang Bambang |  | Parman berhasil dihapus', '2020-06-20 08:29:58', 1),
(14, 'Pengguna admin mengimport nomor resi ', '2020-06-20 08:53:07', 1),
(15, 'Pengguna admin mengimport nomor resi ', '2020-06-20 08:53:56', 1),
(16, 'Pengguna admin mengimport nomor resi ', '2020-06-20 08:54:32', 1),
(17, 'Pengguna admin mengimport nomor resi ', '2020-06-20 08:55:18', 1),
(18, 'Pengguna admin mengimport nomor resi ', '2020-06-20 08:55:38', 1),
(19, 'Pengguna admin mengimport nomor resi ', '2020-06-20 08:56:05', 1),
(20, 'Pengguna admin mengimport nomor resi ', '2020-06-20 08:57:06', 1),
(21, 'Pengguna admin mengimport nomor resi ', '2020-06-20 08:57:30', 1),
(22, 'Pengguna admin mengimport nomor resi ', '2020-06-20 08:57:45', 1),
(23, 'Pengguna admin mengimport nomor resi ', '2020-06-20 08:58:41', 1),
(24, 'Pengguna admin mengimport nomor resi ', '2020-06-20 08:59:09', 1),
(25, 'Pengguna admin mengimport nomor resi ', '2020-06-20 08:59:19', 1),
(26, 'Pengguna admin mengimport nomor resi ', '2020-06-20 08:59:29', 1),
(27, 'Pengguna admin mengimport nomor resi ', '2020-06-20 09:00:07', 1),
(28, 'Pengguna admin mengimport nomor resi ', '2020-06-20 09:00:15', 1),
(29, 'Pengguna admin berhasil menambahkan pesanan Bambang', '2020-06-20 09:03:03', 1),
(30, 'Kurir admin Akan Mengambil Barang Di Jln ABC', '2020-06-20 09:03:24', 1),
(31, 'Kurir admin Telah Mengambil Barang Di Jln ABC', '2020-06-20 09:03:36', 1),
(32, 'Pengguna admin mengimport nomor resi ', '2020-06-20 09:04:38', 1),
(33, 'Pengguna admin mengimport nomor resi ', '2020-06-20 09:16:36', 1),
(34, 'Pengguna admin mengimport nomor resi ', '2020-06-20 09:17:01', 1),
(35, 'Pengguna admin mengimport nomor resi ', '2020-06-20 09:17:58', 1),
(36, 'Pengguna admin mengimport nomor resi ', '2020-06-20 09:18:26', 1),
(37, 'Pelanggan Bambang berhasil menambahkan pesanan ', '2020-06-20 17:34:25', NULL),
(38, 'Pelanggan Bambang berhasil menambahkan pesanan ', '2020-06-20 17:37:05', NULL),
(39, 'Pengguna admin berhasil login', '2020-06-20 17:39:52', 1),
(40, 'Pengguna admin mengimport nomor resi ', '2020-06-20 17:47:09', 1),
(41, 'Pengguna admin mengimport nomor resi ', '2020-06-20 17:47:20', 1),
(42, 'Pickup Barang Bambang |  | Sutejo berhasil dihapus', '2020-06-20 17:57:43', 1),
(43, 'Pickup Barang Bambang |  | asd berhasil dihapus', '2020-06-20 17:57:50', 1),
(44, 'Pickup Barang Bambang |  | Sutejo berhasil dihapus', '2020-06-20 17:57:55', 1),
(45, 'Pickup Barang Bambang |  | asd berhasil dihapus', '2020-06-20 17:58:00', 1),
(46, 'Pickup Barang Bambang |  | Sutejo berhasil dihapus', '2020-06-20 17:58:05', 1),
(47, 'Pickup Barang Bambang |  | Sutejo berhasil dihapus', '2020-06-20 17:58:09', 1),
(48, 'Pickup Barang Bambang |  | Parman berhasil dihapus', '2020-06-20 17:58:14', 1),
(49, 'Pengguna admin mengimport nomor resi ', '2020-06-20 17:58:24', 1),
(50, 'Pengguna admin mengimport nomor resi ', '2020-06-20 17:59:01', 1),
(51, 'Pengguna admin berhasil menambahkan pesanan Bambang', '2020-06-20 18:13:13', 1),
(52, 'Pengguna admin mengimport nomor resi ', '2020-06-20 18:24:27', 1),
(53, 'Pengguna admin berhasil menambahkan pesanan Bambang', '2020-06-20 18:38:45', 1),
(54, 'Pengguna admin berhasil logout', '2020-06-20 18:40:53', 1);

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
(1, 'Sutejo', '08123456789', 'Jln DEF'),
(2, 'Parman', '0877987654321', 'Jln GHI'),
(3, 'Sutejo', '6281276696861', 'Jln DEF'),
(4, 'Sutejo', '081287654321', 'Jln DEF'),
(5, 'asd', '081511111111', 'Jln GHI'),
(6, 'Sutejo', '081587654321', 'Jln DEF');

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
(1, 'Bambang', '081212345678', 'Jln ABC', ''),
(2, 'Bambang', '628151407477', 'Jln ABC', ''),
(3, 'Bambang', '081512345678', 'Jln ABC', ''),
(4, 'Bambang', '081512345678', 'Jln ABC', '::1');

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
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pickup_barang`
--

INSERT INTO `pickup_barang` (`id_pickup_barang`, `no_resi`, `id_pengirim`, `id_penerima`, `id_jenis_layanan`, `tanggal_pemesanan`, `tanggal_penjemputan`, `tanggal_masuk_logistik`, `id_status`) VALUES
(12, NULL, 3, 6, 1, '2020-06-20 18:13:13', NULL, NULL, 1),
(13, NULL, 3, 5, 1, '2020-06-20 18:13:13', NULL, NULL, 1),
(14, NULL, 4, 6, 3, '2020-06-20 18:38:45', NULL, NULL, 1);

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
(3, 'Barang Masuk Logistik');

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
(1, 'avatar31.png', 'Administrator', 'admin', '$2y$10$9RYtJdUQAdduDpy0kOpfOey5qdIp1tvB1WLDexgaWQ83Rez4ubxxe', 1),
(2, 'default.png', 'Andri Firman Saputra', 'andri975', '$2y$10$B8CG0imMpSNlopfeBKBGBOQPUALR/LCpacCb5cXaWY9IrRuYtEg4a', 3);

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
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jenis_layanan`
--
ALTER TABLE `jenis_layanan`
  MODIFY `id_jenis_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id_penerima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  MODIFY `id_pengirim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pickup_barang`
--
ALTER TABLE `pickup_barang`
  MODIFY `id_pickup_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
