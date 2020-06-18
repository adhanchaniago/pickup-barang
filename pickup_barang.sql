-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jun 2020 pada 01.34
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
(1, 'YES (Yakin Esok Sampai)'),
(2, 'REG (Reguler)'),
(3, 'OKE (Ongkos Kirim Ekonomis)');

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
(2, 'Pengguna admin berhasil login', '2020-06-13 20:19:11', 1),
(3, 'Pengguna admin berhasil login', '2020-06-14 20:16:43', 1),
(4, 'Pengguna admin berhasil menambahkan jabatan Operator', '2020-06-14 20:17:02', 1),
(5, 'Pengguna admin berhasil mengubah jabatan Operatorasd', '2020-06-14 20:17:06', 1),
(6, 'Jabatan Operatorasd berhasil dihapus', '2020-06-14 20:17:09', 1),
(7, 'Pengguna admin berhasil diubah', '2020-06-14 20:17:44', 1),
(8, 'Pengguna admin berhasil diubah', '2020-06-14 20:17:53', 1),
(9, 'Pengguna admin berhasil diubah', '2020-06-14 20:18:04', 1),
(10, 'Pengguna admin gagal mengubah Password! Password tidak sesuai dengan password lama', '2020-06-14 20:18:13', 1),
(11, 'Pengguna admin berhasil mengubah Password', '2020-06-14 20:18:22', 1),
(12, 'Pengguna admin berhasil mengubah Password', '2020-06-14 20:18:29', 1),
(13, 'Pengguna admin berhasil menambahkan jabatan Operator', '2020-06-14 20:18:45', 1),
(14, 'Pengguna admin berhasil menambahkan pengguna andri975', '2020-06-14 20:19:09', 1),
(15, 'Pengguna admin berhasil menambahkan Jenis Layanan YES (Yakin Esok Sampai)', '2020-06-14 20:20:34', 1),
(16, 'Pengguna admin berhasil menambahkan Jenis Layanan REG (Reguler)', '2020-06-14 20:20:51', 1),
(17, 'Pengguna admin berhasil menambahkan Jenis Paket kiloan', '2020-06-14 20:24:43', 1),
(18, 'Pengguna admin berhasil mengubah Jenis Paket Kiloan', '2020-06-14 20:24:53', 1),
(19, 'Pengguna admin berhasil menambahkan Jenis Layanan oke (Ongkos Kirim Ekonomis)', '2020-06-14 20:27:32', 1),
(20, 'Pengguna admin berhasil mengubah Jenis Layanan Oke (Ongkos Kirim Ekonomis)', '2020-06-14 20:27:38', 1),
(21, 'Pengguna admin berhasil mengubah Jenis Layanan OKE (Ongkos Kirim Ekonomis)', '2020-06-14 20:27:54', 1),
(22, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:31:35', 1),
(23, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:31:48', 1),
(24, 'Pengguna admin berhasil mengubah Provinsi ', '2020-06-14 20:32:05', 1),
(25, 'Pengguna admin berhasil mengubah Provinsi ', '2020-06-14 20:32:22', 1),
(26, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:32:29', 1),
(27, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:32:34', 1),
(28, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:32:59', 1),
(29, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:33:04', 1),
(30, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:33:20', 1),
(31, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:33:30', 1),
(32, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:33:46', 1),
(33, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:33:51', 1),
(34, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:34:08', 1),
(35, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:34:13', 1),
(36, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:34:18', 1),
(37, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:34:47', 1),
(38, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:34:53', 1),
(39, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:35:04', 1),
(40, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:35:09', 1),
(41, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:35:23', 1),
(42, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:35:32', 1),
(43, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:35:43', 1),
(44, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:35:49', 1),
(45, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:36:01', 1),
(46, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:36:09', 1),
(47, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:36:21', 1),
(48, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:36:27', 1),
(49, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:36:37', 1),
(50, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:36:49', 1),
(51, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:36:59', 1),
(52, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:37:14', 1),
(53, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:37:25', 1),
(54, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:37:33', 1),
(55, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:37:45', 1),
(56, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:37:55', 1),
(57, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-14 20:38:02', 1),
(58, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 20:43:43', 1),
(59, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 20:44:06', 1),
(60, 'Pengguna admin berhasil menambahkan Jenis Paket Unit', '2020-06-14 20:47:56', 1),
(61, 'Pengguna admin berhasil menambahkan jabatan Kurir', '2020-06-14 21:00:21', 1),
(62, 'Pengguna admin berhasil login', '2020-06-14 21:03:09', 1),
(63, 'Pengguna admin berhasil login', '2020-06-14 21:09:31', 1),
(64, 'Pengguna admin berhasil login', '2020-06-14 21:10:40', 1),
(65, 'Pengguna admin berhasil login', '2020-06-14 21:15:46', 1),
(66, 'Pengguna admin berhasil login', '2020-06-14 21:35:42', 1),
(67, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 21:36:02', 1),
(68, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 21:36:16', 1),
(69, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 21:36:37', 1),
(70, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 21:36:47', 1),
(71, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 21:37:00', 1),
(72, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 21:37:10', 1),
(73, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 21:37:23', 1),
(74, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 21:37:41', 1),
(75, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 21:37:59', 1),
(76, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 21:38:10', 1),
(77, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 21:40:07', 1),
(78, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 21:47:12', 1),
(79, 'Pengguna admin berhasil logout', '2020-06-14 22:20:25', 1),
(80, 'Pengguna admin berhasil login', '2020-06-14 22:21:29', 1),
(81, 'Pengguna admin berhasil login', '2020-06-14 22:45:59', 1),
(82, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 22:56:25', 1),
(83, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 22:57:16', 1),
(84, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 22:57:28', 1),
(85, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 22:57:51', 1),
(86, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 22:58:02', 1),
(87, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 22:58:49', 1),
(88, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 22:59:09', 1),
(89, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:00:21', 1),
(90, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:00:32', 1),
(91, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:00:42', 1),
(92, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:00:55', 1),
(93, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:01:06', 1),
(94, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:01:32', 1),
(95, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:01:45', 1),
(96, 'Pengguna admin berhasil mengubah kabupaten ', '2020-06-14 23:02:02', 1),
(97, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:02:51', 1),
(98, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:03:04', 1),
(99, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:03:15', 1),
(100, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:03:28', 1),
(101, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:03:41', 1),
(102, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:03:52', 1),
(103, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:04:02', 1),
(104, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:04:21', 1),
(105, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:04:38', 1),
(106, 'Pengguna admin berhasil mengubah kabupaten ', '2020-06-14 23:05:29', 1),
(107, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:06:17', 1),
(108, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:06:32', 1),
(109, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:07:31', 1),
(110, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:07:43', 1),
(111, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:08:00', 1),
(112, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:08:23', 1),
(113, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:11:43', 1),
(114, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:11:54', 1),
(115, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:12:52', 1),
(116, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:13:06', 1),
(117, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:13:34', 1),
(118, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:14:06', 1),
(119, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:14:24', 1),
(120, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:14:39', 1),
(121, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:15:02', 1),
(122, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:15:56', 1),
(123, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:16:18', 1),
(124, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:16:38', 1),
(125, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:17:19', 1),
(126, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:17:29', 1),
(127, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:18:24', 1),
(128, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:18:38', 1),
(129, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:18:59', 1),
(130, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:19:25', 1),
(131, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:21:47', 1),
(132, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:21:58', 1),
(133, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:22:13', 1),
(134, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:22:46', 1),
(135, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:23:02', 1),
(136, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:23:23', 1),
(137, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:23:39', 1),
(138, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:25:19', 1),
(139, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:25:46', 1),
(140, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:26:02', 1),
(141, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-14 23:32:11', 1),
(142, 'Jabatan Kurir berhasil dihapus', '2020-06-14 23:41:38', 1),
(143, 'Pengguna admin berhasil menambahkan Layanan Paket ', '2020-06-14 23:47:44', 1),
(144, 'Pengguna admin berhasil mengubah Layanan Paket ', '2020-06-14 23:57:22', 1),
(145, 'Pengguna admin berhasil mengubah Layanan Paket ', '2020-06-14 23:57:32', 1),
(146, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-15 00:06:26', 1),
(147, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-15 00:07:39', 1),
(148, 'Pengguna admin berhasil mengubah kabupaten ', '2020-06-15 00:07:52', 1),
(149, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-15 00:09:14', 1),
(150, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-15 00:09:54', 1),
(151, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-15 00:12:36', 1),
(152, 'kabupaten Kota Sungai Penuh berhasil dihapus', '2020-06-15 00:19:04', 1),
(153, 'Pengguna admin berhasil login', '2020-06-15 00:23:33', 1),
(154, 'Pengguna admin berhasil login', '2020-06-15 00:58:18', 1),
(155, 'Pengguna admin berhasil login', '2020-06-15 00:59:09', 1),
(156, 'Pengguna admin berhasil mengubah Layanan Paket ', '2020-06-15 01:04:40', 1),
(157, 'Pengguna admin berhasil mengubah Layanan Paket ', '2020-06-15 01:12:53', 1),
(158, 'Pengguna admin berhasil mengubah Layanan Paket ', '2020-06-15 01:26:48', 1),
(159, 'Pengguna admin berhasil mengubah Layanan Paket ', '2020-06-15 01:29:30', 1),
(160, 'Pengguna admin berhasil mengubah Layanan Paket ', '2020-06-15 01:29:36', 1),
(161, 'Pengguna admin berhasil logout', '2020-06-15 01:40:56', 1),
(162, 'Pengguna andri975 berhasil login', '2020-06-15 01:40:59', 2),
(163, 'Pengguna andri975 berhasil logout', '2020-06-15 01:41:05', 2),
(164, 'Pengguna admin berhasil login', '2020-06-15 01:41:09', 1),
(165, 'Pengguna admin berhasil logout', '2020-06-15 01:41:12', 1),
(166, 'Pengguna andri975 berhasil login', '2020-06-15 01:41:24', 2),
(167, 'Pengguna andri975 berhasil mengubah Password', '2020-06-15 01:41:34', 2),
(168, 'Pengguna andri975 berhasil logout', '2020-06-15 01:41:36', 2),
(169, 'Pengguna admin berhasil login', '2020-06-15 01:41:42', 1),
(170, 'Pengguna admin berhasil logout', '2020-06-15 01:46:38', 1),
(171, 'Pengguna admin berhasil login', '2020-06-15 01:46:40', 1),
(172, 'Pengguna admin berhasil login', '2020-06-15 01:46:54', 1),
(173, 'Pengguna admin berhasil logout', '2020-06-15 01:47:55', 1),
(174, 'Pengguna andri975 berhasil login', '2020-06-15 01:48:00', 2),
(175, 'Pengguna andri975 berhasil logout', '2020-06-15 01:48:11', 2),
(176, 'Pengguna admin berhasil login', '2020-06-15 01:48:15', 1),
(177, 'Pengguna admin berhasil mengubah penerima Andri Firman Saputra', '2020-06-15 02:03:57', 1),
(178, 'Pengguna admin berhasil mengubah penerima Andri Firman Saputra', '2020-06-15 02:13:13', 1),
(179, 'Pengguna admin berhasil mengubah penerima Andri Firman Saputra', '2020-06-15 02:13:20', 1),
(180, 'Penerima Andri Firman Saputra berhasil dihapus', '2020-06-15 02:13:23', 1),
(181, 'Pengguna admin berhasil menambahkan penerima Andri Firman Saputra', '2020-06-15 02:20:26', 1),
(182, 'Pengguna admin berhasil login', '2020-06-15 02:22:28', 1),
(183, 'Pengguna admin berhasil login', '2020-06-15 02:26:54', 1),
(184, 'Pengguna admin berhasil login', '2020-06-15 02:27:39', 1),
(185, 'Pengguna admin berhasil menambahkan pengirim Andri Firman Saputra', '2020-06-15 02:42:42', 1),
(186, 'Pengguna admin berhasil mengubah pengirim Andri Firman Saputra', '2020-06-15 02:42:54', 1),
(187, 'pengirim Andri Firman Saputra berhasil dihapus', '2020-06-15 02:43:03', 1),
(188, 'Pengguna admin berhasil menambahkan pengirim Andri Firman Saputra', '2020-06-15 02:43:26', 1),
(189, 'Pengguna admin berhasil mengubah Penerima Andre Farhan Saputra', '2020-06-15 02:43:52', 1),
(190, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-15 02:55:43', 1),
(191, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-15 03:15:41', 1),
(192, 'Pengguna admin mencoba menghapus data Pickup Barang', '2020-06-15 03:16:00', 1),
(193, 'Pengguna admin mencoba menghapus data Pickup Barang', '2020-06-15 03:16:05', 1),
(194, 'Pengguna admin mencoba menghapus data Pickup Barang', '2020-06-15 03:18:48', 1),
(195, 'Pengguna admin mencoba menghapus data Pickup Barang', '2020-06-15 03:18:53', 1),
(196, 'Jabatan  berhasil dihapus', '2020-06-15 03:19:06', 1),
(197, 'Jabatan  berhasil dihapus', '2020-06-15 03:19:10', 1),
(198, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-15 03:20:46', 1),
(199, 'Pengguna admin berhasil mengubah Pickup Barang ', '2020-06-15 03:23:31', 1),
(200, 'Pengguna admin berhasil mengubah Pickup Barang ', '2020-06-15 03:23:38', 1),
(201, 'Pengguna admin berhasil mengubah Pickup Barang ', '2020-06-15 03:25:30', 1),
(202, 'Pengguna admin berhasil mengubah Pickup Barang ', '2020-06-15 03:25:34', 1),
(203, 'Pengguna admin berhasil mengubah Pickup Barang ', '2020-06-15 03:25:40', 1),
(204, 'Pengguna admin berhasil mengubah Pickup Barang ', '2020-06-15 03:25:46', 1),
(205, 'Pengguna admin berhasil mengubah Pickup Barang ', '2020-06-15 03:25:50', 1),
(206, 'Pengguna admin berhasil mengubah Pickup Barang ', '2020-06-15 03:25:54', 1),
(207, 'Pengguna admin berhasil mengubah Pickup Barang ', '2020-06-15 03:26:40', 1),
(208, 'Pengguna admin berhasil mengubah Pickup Barang ', '2020-06-15 03:26:45', 1),
(209, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-15 03:27:18', 1),
(210, 'Pengguna admin berhasil mengubah Pickup Barang ', '2020-06-15 03:27:24', 1),
(211, 'Pengguna admin berhasil mengubah Pickup Barang ', '2020-06-15 03:30:26', 1),
(212, 'Pengguna admin berhasil login', '2020-06-15 04:17:18', 1),
(213, 'Pengguna admin berhasil login', '2020-06-15 12:32:08', 1),
(214, 'Pengguna admin berhasil login', '2020-06-16 06:03:33', 1),
(215, 'Pengguna admin berhasil login', '2020-06-16 10:18:14', 1),
(216, 'Kurir admin Akan Mengambil Barang Di Jl. Amd Babakn Pocis No. 100 Rt02/02, Setu, Kota Tangerang Selatan, Banten', '2020-06-16 12:59:59', 1),
(217, 'Kurir admin Akan Mengambil Barang Di Jl. Amd Babakn Pocis No. 100 Rt02/02, Setu, Kota Tangerang Selatan, Banten', '2020-06-16 13:00:35', 1),
(218, 'Kurir admin Akan Mengambil Barang Di Jl. Amd Babakn Pocis No. 100 Rt02/02, Setu, Kota Tangerang Selatan, Banten', '2020-06-16 14:02:06', 1),
(219, 'Kurir admin Telah Mengambil Barang Di Jl. Amd Babakn Pocis No. 100 Rt02/02, Setu, Kota Tangerang Selatan, Banten', '2020-06-16 14:08:38', 1),
(220, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-16 16:39:57', 1),
(221, 'Pengguna admin berhasil login', '2020-06-17 07:56:05', 1),
(222, 'Pengguna admin berhasil logout', '2020-06-17 08:15:34', 1),
(223, 'Pengguna andri975 berhasil login', '2020-06-17 08:15:57', 2),
(224, 'Pengguna  berhasil menambahkan pesanan ', '2020-06-17 15:10:28', NULL),
(225, 'Pengguna admin berhasil login', '2020-06-17 15:11:10', 1),
(226, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-17 17:49:40', 1),
(227, 'Pengguna admin berhasil login', '2020-06-18 09:02:35', 1),
(228, 'Kurir admin Akan Mengambil Barang Di Jln ABC, Setu, Kota Tangerang Selatan, Banten', '2020-06-18 09:08:44', 1);

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
(2, 'Andre Farhan Saputra', '081314213758', 'Jl. Amd Babakan Pocis No. 69 Rt02/02'),
(3, '', '', ''),
(4, 'Sutejo', '081531313131', 'Jln DEF'),
(5, 'Sutejo', '081531313131', 'Jln DEF'),
(6, 'Sutejo', '098918273123', 'haduhsa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengirim`
--

CREATE TABLE `pengirim` (
  `id_pengirim` int(11) NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `no_wa_pengirim` varchar(25) NOT NULL,
  `alamat_pengirim` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengirim`
--

INSERT INTO `pengirim` (`id_pengirim`, `nama_pengirim`, `no_wa_pengirim`, `alamat_pengirim`) VALUES
(2, 'Andri Firman Saputra', '087808675313', 'Jl. Amd Babakn Pocis No. 100 Rt02/02'),
(3, 'Bambang', '081510101010', 'Jln ABC'),
(4, 'Sutejo', '081510101010', 'Jln ABC'),
(5, 'asd', '123123131221', 'sdaasd');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT untuk tabel `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id_penerima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  MODIFY `id_pengirim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pickup_barang`
--
ALTER TABLE `pickup_barang`
  MODIFY `id_pickup_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT;

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
