-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2020 pada 14.12
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
(62, 'Pengguna admin mengimport nomor resi ', '2020-06-21 14:35:04', 1),
(63, 'Pengguna admin berhasil logout', '2020-06-21 14:58:03', 1),
(64, 'Pengguna admin berhasil login', '2020-06-21 19:22:18', 1),
(65, 'Pengguna admin berhasil logout', '2020-06-21 20:35:51', 1),
(66, 'Pelanggan Andre Farhan Saputra berhasil menambahkan pesanan ', '2020-06-21 20:36:25', NULL),
(67, 'Pengguna admin berhasil login', '2020-06-21 20:37:15', 1),
(68, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 69', '2020-06-21 20:37:22', 1),
(69, 'Pengguna admin berhasil login', '2020-06-22 20:10:48', 1),
(70, 'Pengguna admin berhasil login', '2020-06-23 00:08:35', 1),
(71, 'Pengguna admin berhasil login', '2020-06-23 00:11:03', 1),
(72, 'Pengguna admin berhasil logout', '2020-06-23 00:20:05', 1),
(73, 'Pengguna admin berhasil login', '2020-06-23 00:20:43', 1),
(74, 'Pengguna admin berhasil logout', '2020-06-23 00:21:09', 1),
(75, 'Pengguna admin berhasil login', '2020-06-23 00:22:50', 1),
(76, 'Pelanggan Andri Firman Saputra berhasil menambahkan pesanan ', '2020-06-23 00:46:52', NULL),
(77, 'Pengguna admin berhasil login', '2020-06-23 00:47:06', 1),
(78, 'Pengguna admin berhasil login', '2020-06-23 00:50:36', 1),
(79, 'Pengguna admin mengimport nomor resi ', '2020-06-23 00:53:55', 1),
(80, 'Pengguna admin mengimport nomor resi ', '2020-06-23 01:00:54', 1),
(81, 'Pengguna admin mengimport nomor resi ', '2020-06-23 01:01:06', 1),
(82, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100 RT02/02, Setu, Tangerang Selatan, Banten 15315', '2020-06-23 01:01:27', 1),
(83, 'Kurir admin Telah Mengambil Barang Di Jl. AMD Babakan Pocis No. 100 RT02/02, Setu, Tangerang Selatan, Banten 15315', '2020-06-23 01:01:34', 1),
(84, 'Pengguna admin mengimport nomor resi ', '2020-06-23 01:01:51', 1),
(85, 'Pengguna admin mengimport nomor resi ', '2020-06-23 01:03:47', 1),
(86, 'Pengguna admin mengimport nomor resi ', '2020-06-23 01:05:33', 1),
(87, 'Pengguna admin mengimport nomor resi ', '2020-06-23 01:06:25', 1),
(88, 'Pengguna admin mengimport nomor resi ', '2020-06-23 01:06:45', 1),
(89, 'Pengguna admin berhasil logout', '2020-06-23 01:19:49', 1),
(90, 'Pelanggan Andri Firman Saputra berhasil menambahkan pesanan ', '2020-06-23 01:21:36', NULL),
(91, 'Pengguna admin berhasil login', '2020-06-23 01:22:04', 1),
(92, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100 RT02/02, Setu, Tangerang Selatan, Banten 15315', '2020-06-23 01:22:11', 1),
(93, 'Kurir admin Telah Mengambil Barang Di Jl. AMD Babakan Pocis No. 100 RT02/02, Setu, Tangerang Selatan, Banten 15315', '2020-06-23 01:22:24', 1),
(94, 'Pengguna admin mengimport nomor resi ', '2020-06-23 01:28:38', 1),
(95, 'Pengguna admin berhasil logout', '2020-06-23 01:28:55', 1),
(96, 'Pelanggan Andri Firman Saputra berhasil menambahkan pesanan ', '2020-06-23 21:14:51', NULL),
(97, 'Pengguna admin berhasil login', '2020-06-23 21:15:50', 1),
(98, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100 RT02/02, Setu, Tangerang Selatan, Banten 15315', '2020-06-23 21:19:03', 1),
(99, 'Kurir admin Telah Mengambil Barang Di Jl. AMD Babakan Pocis No. 100 RT02/02, Setu, Tangerang Selatan, Banten 15315', '2020-06-23 21:25:03', 1),
(100, 'Pengguna admin mengimport nomor resi ', '2020-06-23 21:29:33', 1),
(101, 'Pengguna admin berhasil login', '2020-06-23 21:52:34', 1),
(102, 'Pengguna admin berhasil login', '2020-06-23 21:59:13', 1),
(103, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100 RT02/02, Setu, Tangerang Selatan, Banten 15315', '2020-06-23 21:59:18', 1),
(104, 'Kurir admin Telah Mengambil Barang Di Jl. AMD Babakan Pocis No. 100 RT02/02, Setu, Tangerang Selatan, Banten 15315', '2020-06-23 21:59:28', 1),
(105, 'Pengguna admin mengimport nomor resi ', '2020-06-23 21:59:55', 1),
(106, 'Pengguna admin berhasil logout', '2020-06-23 22:08:08', 1),
(107, 'Pengguna admin berhasil login', '2020-06-23 22:41:24', 1),
(108, 'Pengguna admin mengimport nomor resi ', '2020-06-23 22:41:30', 1),
(109, 'Pengguna admin mengimport nomor resi ', '2020-06-23 22:41:51', 1),
(110, 'Pengguna admin mengimport nomor resi ', '2020-06-23 22:43:13', 1),
(111, 'Pengguna admin mengimport nomor resi ', '2020-06-23 22:52:05', 1),
(112, 'Pengguna admin berhasil login', '2020-06-24 17:17:23', 1),
(113, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100 RT02/02, Setu, Tangerang Selatan, Banten 15315', '2020-06-24 17:18:21', 1),
(114, 'Pengguna admin berhasil logout', '2020-06-24 17:19:20', 1),
(115, 'Pelanggan Andri Firman Saputra berhasil menambahkan pesanan ', '2020-06-24 17:22:15', NULL),
(116, 'Pengguna admin berhasil login', '2020-06-24 17:23:11', 1),
(117, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-24 17:23:18', 1),
(118, 'Kurir admin Telah Mengambil Barang Di Jl. AMD Babakan Pocis No. 100', '2020-06-24 17:23:32', 1),
(119, 'Pengguna admin mengimport nomor resi ', '2020-06-24 17:27:55', 1),
(120, 'Pengguna admin mengimport nomor resi ', '2020-06-24 17:29:36', 1),
(121, 'Pengguna admin mengimport nomor resi ', '2020-06-24 17:35:17', 1),
(122, 'Pengguna admin mengimport nomor resi ', '2020-06-24 17:43:46', 1),
(123, 'Pengguna admin berhasil logout', '2020-06-24 17:49:48', 1),
(124, 'Pelanggan Escepat berhasil menambahkan pesanan ', '2020-06-24 17:52:40', NULL),
(125, 'Pengguna andri975 berhasil login', '2020-06-24 17:53:00', 2),
(126, 'Pengguna admin berhasil login', '2020-06-24 17:53:29', 1),
(127, 'Pengguna admin berhasil menambahkan pesanan Ajos', '2020-06-24 17:57:38', 1),
(128, 'Pengguna admin berhasil login', '2020-06-24 18:02:40', 1),
(129, 'Kurir admin Akan Mengambil Barang Di Auto pad BSD', '2020-06-24 18:28:59', 1),
(130, 'Kurir admin Telah Mengambil Barang Di Auto pad BSD', '2020-06-24 18:29:30', 1),
(131, 'Pengguna admin mengimport nomor resi ', '2020-06-24 18:45:19', 1),
(132, 'Pengguna admin mengimport nomor resi ', '2020-06-24 18:54:46', 1),
(133, 'Pengguna admin mengimport nomor resi ', '2020-06-24 19:00:42', 1),
(134, 'Pengguna admin mengimport nomor resi ', '2020-06-24 19:05:00', 1);

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
(1, 'Andre Farhan Saputra', '+628965343212', 'Jl. kebangsaan no. 5'),
(2, 'Imam', '+6289531231231', 'Banjar Negara'),
(3, 'Udin', '+628747747374', 'Semarang'),
(4, 'Budi', '+628780897727', 'Jl. Solo'),
(5, 'Iwan', '+6237139139137', 'Malang');

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
(1, 'Andri Firman Saputra', '+6287808675313', 'Jl. AMD Babakan Pocis No. 100', '::1'),
(2, 'Escepat', '+6287808675313', 'Auto pad BSD', '::1'),
(3, 'Ajos', '+6287808675313', 'Auto pad BSD', '::1');

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
  `nama_barang` varchar(100) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `berat_barang` float DEFAULT NULL,
  `harga_pengiriman` int(11) DEFAULT NULL,
  `tanggal_pemesanan` datetime DEFAULT NULL,
  `tanggal_penjemputan` datetime DEFAULT NULL,
  `tanggal_masuk_logistik` datetime DEFAULT NULL,
  `tanggal_input_resi` datetime DEFAULT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pickup_barang`
--

INSERT INTO `pickup_barang` (`id_pickup_barang`, `no_resi`, `id_pengirim`, `id_penerima`, `id_jenis_layanan`, `nama_barang`, `jumlah_barang`, `berat_barang`, `harga_pengiriman`, `tanggal_pemesanan`, `tanggal_penjemputan`, `tanggal_masuk_logistik`, `tanggal_input_resi`, `id_status`) VALUES
(1, '540700080433320', 1, 1, 1, 'surat', 2, 1, NULL, '2020-06-24 17:22:15', '2020-06-24 17:23:18', '2020-06-24 17:23:32', '2020-06-24 17:43:41', 4),
(2, '540700080433321', 2, 2, 1, 'CDI', 1, 1, 18000, '2020-06-24 17:52:40', '2020-06-24 18:28:59', '2020-06-24 18:29:30', '2020-06-24 19:04:41', 4),
(3, '540700080433322', 2, 3, 1, 'Handle', 1, 1, 10000, '2020-06-24 17:52:40', '2020-06-24 18:28:59', '2020-06-24 18:29:30', '2020-06-24 19:04:45', 4),
(4, '540700080433323', 3, 4, 1, 'Stir Mobil', 1, 1, 9000, '2020-06-24 17:57:38', '2020-06-24 18:28:59', '2020-06-24 18:29:30', '2020-06-24 19:04:51', 4),
(5, '540700080433324', 3, 5, 1, 'Hordyn', 1, 1, 12000, '2020-06-24 17:57:38', '2020-06-24 18:28:59', '2020-06-24 18:29:30', '2020-06-24 19:04:56', 4);

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
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT untuk tabel `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id_penerima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  MODIFY `id_pengirim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pickup_barang`
--
ALTER TABLE `pickup_barang`
  MODIFY `id_pickup_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
