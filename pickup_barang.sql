-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jun 2020 pada 10.52
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
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `isi_log` text NOT NULL,
  `tanggal_log` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `isi_log`, `tanggal_log`, `id_user`) VALUES
(1, 'Pengguna andri123 berhasil login', '2020-06-08 09:18:15', 1),
(2, 'Pengguna  berhasil diubah', '2020-06-08 10:17:03', 1),
(3, 'Pengguna  berhasil diubah', '2020-06-08 10:17:28', 1),
(4, 'Pengguna  berhasil diubah', '2020-06-08 10:18:08', 1),
(5, 'Pengguna  berhasil diubah', '2020-06-08 10:20:41', 1),
(6, 'Pengguna andri123 berhasil logout', '2020-06-08 10:31:20', 1),
(7, 'Pengguna andri123 berhasil login', '2020-06-08 10:31:25', 1),
(8, 'Pengguna andri123 berhasil login', '2020-06-08 10:36:30', 1),
(9, 'Pengguna andri123 berhasil login', '2020-06-08 10:39:59', 1),
(10, 'Pengguna andri123 berhasil login', '2020-06-08 10:40:04', 1),
(11, 'Pengguna andri123 berhasil login', '2020-06-08 10:40:38', 1),
(12, 'Pengguna andri123 berhasil login', '2020-06-08 10:40:48', 1),
(13, 'Pengguna andri123 berhasil logout', '2020-06-08 10:40:53', 1),
(14, 'Pengguna andri123 berhasil login', '2020-06-08 10:40:57', 1),
(15, 'Pengguna andri123 berhasil logout', '2020-06-08 10:41:00', 1),
(16, 'Pengguna andri123 berhasil login', '2020-06-08 10:41:07', 1),
(17, 'Pengguna andri123 berhasil logout', '2020-06-08 10:41:13', 1),
(18, 'Pengguna andri123 berhasil login', '2020-06-08 10:41:17', 1),
(19, 'Pengguna andri123 berhasil mengubah Password', '2020-06-08 10:44:13', 1),
(20, 'Pengguna andri123 berhasil logout', '2020-06-08 10:44:25', 1),
(21, 'Pengguna andri123 berhasil login', '2020-06-08 10:44:37', 1),
(22, 'Pengguna andri123 berhasil mengubah Password', '2020-06-08 10:44:52', 1),
(23, 'Pengguna andri123 berhasil login', '2020-06-08 10:45:21', 1),
(24, 'Pengguna andri123 berhasil logout', '2020-06-08 10:45:24', 1),
(25, 'Pengguna andri123 berhasil login', '2020-06-08 10:45:29', 1),
(26, 'Pengguna andri123 berhasil login', '2020-06-08 10:45:46', 1),
(27, 'Pengguna andri123 berhasil logout', '2020-06-08 10:47:31', 1),
(28, 'Pengguna andri123 berhasil login', '2020-06-08 10:47:35', 1),
(29, 'Pengguna  berhasil diubah', '2020-06-08 10:47:49', 1),
(30, 'Pengguna  berhasil diubah', '2020-06-08 10:47:55', 1);

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
(1, 'Andri Firman Saputra', 'default2.png', 'andri123', '$2y$10$NYR5auwjiW4rpADsuDMukeO4JVTZ6rx0e7BNOorbFdYQyYB2J/ExS', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

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
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
