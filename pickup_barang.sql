-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jun 2020 pada 06.51
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
(2, 'YES (Yakin Esok Sampai)'),
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
(1, 'Pengguna admin berhasil login', '2020-06-29 11:24:29', 1),
(2, 'Pengguna admin berhasil menambahkan Jenis Layanan REG (Reguler)', '2020-06-29 11:24:54', 1),
(3, 'Pengguna admin berhasil menambahkan Jenis Layanan YES (Yakin Esok Sampai)', '2020-06-29 11:25:07', 1),
(4, 'Pengguna admin berhasil menambahkan Jenis Layanan OKE (Ongkos Kirim Ekonomis)', '2020-06-29 11:25:55', 1),
(5, 'Pengguna admin berhasil menambahkan pesanan Budi Setiawan', '2020-06-29 11:29:27', 1),
(6, 'Kurir admin Akan Mengambil Barang Di Jl. Kebangsaan No. 100 RT02/02 Setu, Tangerang Selatan, Banten 15315', '2020-06-29 11:29:34', 1),
(7, 'Kurir admin Telah Mengambil Barang Di Jl. Kebangsaan No. 100 RT02/02 Setu, Tangerang Selatan, Banten 15315', '2020-06-29 11:29:41', 1),
(8, 'Pengguna admin mengimport nomor resi ', '2020-06-29 11:51:12', 1),
(9, 'Pengguna admin berhasil membuat Backup, untuk mengakses backup tambahkan /backups diakhir url, contoh https://pickupbarang.com/backups ', '2020-06-29 11:51:27', 1),
(10, 'Pengguna admin berhasil membuat Backup, untuk mengakses backup tambahkan /backups diakhir url, contoh https://pickupbarang.com/backups ', '2020-06-29 11:51:28', 1);

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
(1, 'Dewa Agus', '+62895875421365', 'Jl. Melati No. 12 RT02/01');

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
(1, 'Budi Setiawan', '+6287808675313', 'Jl. Kebangsaan No. 100 RT02/02 Setu, Tangerang Selatan, Banten 15315', '::1');

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
(1, '540700080433320', 1, 1, 1, 'Tempat Makan', 2, 2, 9000, '2020-06-29 11:34:29', '2020-06-29 11:29:34', '2020-06-29 11:29:41', '2020-06-29 11:51:05', 4);

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
(1, 'avatar3.png', 'Administrator', 'admin', '$2y$10$bSDiUVtZclSedp7EbG3O/u8dVE3RqBgP3crIm/uztlUqobSJJ6NR2', 1),
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
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id_penerima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  MODIFY `id_pengirim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pickup_barang`
--
ALTER TABLE `pickup_barang`
  MODIFY `id_pickup_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
