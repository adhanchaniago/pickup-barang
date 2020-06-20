-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2020 pada 12.09
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
(3, 'OKE (Ongkos Kirim Ekonomis)'),
(5, 'SS (Spesial Service)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_paket`
--

CREATE TABLE `jenis_paket` (
  `id_jenis_paket` int(11) NOT NULL,
  `jenis_paket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_paket`
--

INSERT INTO `jenis_paket` (`id_jenis_paket`, `jenis_paket`) VALUES
(1, 'Kiloan'),
(2, 'Unit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id_kabupaten` int(11) NOT NULL,
  `nama_kabupaten` varchar(100) NOT NULL,
  `id_provinsi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kabupaten`
--

INSERT INTO `kabupaten` (`id_kabupaten`, `nama_kabupaten`, `id_provinsi`) VALUES
(1, 'Kabupaten Aceh Barat Daya', 1),
(2, 'Kabupaten Aceh Barat', 1),
(3, 'Kabupaten Aceh Besar', 1),
(4, 'Kabupaten Aceh Jaya', 1),
(5, 'Kabupaten Aceh Selatan', 1),
(6, 'Kabupaten Aceh Singkil', 1),
(7, 'Kabupaten Aceh Tamiang', 1),
(8, 'Kabupaten Aceh Tengah', 1),
(9, 'Kabupaten Aceh Tenggara', 1),
(10, 'Kabupaten Aceh Timur', 1),
(11, 'Kabupaten Aceh Utara', 1),
(12, 'Kabupaten Bener Meriah', 1),
(13, 'Kabupaten Bireuen', 1),
(14, 'Kabupaten Gayo Lues', 1),
(15, 'Kabupaten Nagan Raya', 1),
(16, 'Kabupaten Pidie Jaya', 1),
(17, 'Kabupaten Pidie', 1),
(18, 'Kabupaten Simeulue', 1),
(27, 'Kabupaten Lebak', 11),
(28, 'Kabupaten Pandeglang', 11),
(29, 'Kabupaten Serang', 11),
(30, 'Kabupaten Tangerang', 11),
(31, 'Kabupaten Bengkulu Selatan', 7),
(32, 'Kabupaten Bengkulu Tengah', 7),
(33, 'Kabupaten Bengkulu Utara', 7),
(34, 'Kabupaten Kaur', 7),
(35, 'Kabupaten Kepahiang', 7),
(36, 'Kabupaten Lebong', 7),
(37, 'Kabupaten Mukomuko', 7),
(38, 'Kabupaten Rejang Lebong', 7),
(39, 'Kabupaten Seluma', 7),
(40, 'Kabupaten Boalemo', 25),
(41, 'Kabupaten Bone Bolango', 25),
(42, 'Kabupaten Gorontalo Utara', 25),
(43, 'Kabupaten Gorontalo', 25),
(44, 'Kabupaten Pohuwato', 25),
(45, 'Kabupaten Administrasi Kepulauan Seribu', 13),
(46, 'Kabupaten Batanghari', 6),
(47, 'Kabupaten Bungo', 6),
(48, 'Kabupaten Kerinci', 6),
(49, 'Kabupaten Merangin', 6),
(50, 'Kabupaten Muaro Jambi', 6),
(51, 'Kabupaten Sarolangun', 6),
(52, 'Kabupaten Tanjung Jabung Barat', 6),
(53, 'Kabupaten Tanjung Jabung Timur', 6),
(54, 'Kabupaten Tebo', 6),
(55, 'Kabupaten Bandung Barat', 12),
(56, 'Kabupaten Bandung', 12),
(57, 'Kabupaten Bekasi', 12),
(58, 'Kabupaten Bogor', 12),
(59, 'Kabupaten Ciamis', 12),
(60, 'Kabupaten Cianjur', 12),
(61, 'Kabupaten Cirebon', 12),
(62, 'Kabupaten Garut', 12),
(63, 'Kabupaten Indramayu', 12),
(64, 'Kabupaten Karawang', 12),
(65, 'Kabupaten Kuningan', 12),
(66, 'Kabupaten Majalengka', 12),
(67, 'Kabupaten Pangandaran', 12),
(68, 'Kabupaten Purwakarta', 12),
(69, 'Kabupaten Subang', 12),
(70, 'Kabupaten Sukabumi', 12),
(71, 'Kabupaten Sumedang', 12),
(72, 'Kabupaten Tasikmalaya', 12),
(73, 'Kabupaten Banjarnegara', 14),
(74, 'Kabupaten Banyumas', 14),
(75, 'Kabupaten Batang', 14),
(76, 'Kabupaten Blora', 14),
(77, 'Kabupaten Boyolali', 14),
(78, 'Kabupaten Brebes', 14),
(79, 'Kabupaten Cilacap', 14),
(80, 'Kabupaten Demak', 14),
(81, 'Kabupaten Grobogan', 14),
(82, 'Kabupaten Jepara', 14),
(83, 'Kabupaten Karanganyar', 14),
(84, 'Kabupaten Kebumen', 14),
(85, 'Kabupaten Kendal', 14),
(86, 'Kabupaten Klaten', 14),
(87, 'Kabupaten Kudus', 14),
(88, 'Kabupaten Magelang', 14),
(89, 'Kabupaten Pati', 14),
(90, 'Kabupaten Pekalongan', 14),
(91, 'Kabupaten Pemalang', 14),
(92, 'Kabupaten Purbalingga', 14),
(93, 'Kabupaten Purworejo', 14),
(94, 'Kabupaten Rembang', 14),
(95, 'Kabupaten Semarang', 14),
(96, 'Kabupaten Sragen', 14),
(97, 'Kabupaten Sukoharjo', 14),
(98, 'Kabupaten Tegal', 14),
(99, 'Kabupaten Temanggung', 14),
(100, 'Kabupaten Wonogiri', 14),
(101, 'Kabupaten Wonosobo', 14),
(102, 'Kabupaten Bangkalan', 16),
(103, 'Kabupaten Banyuwangi', 16),
(104, 'Kabupaten Blitar', 16),
(105, 'Kabupaten Bojonegoro', 16),
(106, 'Kabupaten Bondowoso', 16),
(107, 'Kabupaten Gresik', 16),
(108, 'Kabupaten Jember', 16),
(109, 'Kabupaten Jombang', 16),
(110, 'Kabupaten Kediri', 16),
(111, 'Kabupaten Lamongan', 16),
(112, 'Kabupaten Lumajang', 16),
(113, 'Kabupaten Madiun', 16),
(114, 'Kabupaten Magetan', 16),
(115, 'Kabupaten Malang', 16),
(116, 'Kabupaten Mojokerto', 16),
(117, 'Kabupaten Nganjuk', 16),
(118, 'Kabupaten Ngawi', 16),
(119, 'Kabupaten Pacitan', 16),
(120, 'Kabupaten Pamekasan', 16),
(121, 'Kabupaten Pasuruan', 16),
(122, 'Kabupaten Ponorogo', 16),
(123, 'Kabupaten Probolinggo', 16),
(124, 'Kabupaten Sampang', 16),
(125, 'Kabupaten Sidoarjo', 16),
(126, 'Kabupaten Situbondo', 16),
(127, 'Kabupaten Sumenep', 16),
(128, 'Kabupaten Trenggalek', 16),
(129, 'Kabupaten Tuban', 16),
(130, 'Kabupaten Tulungagung', 16),
(131, 'Kabupaten Bengkayang', 20),
(132, 'Kabupaten Kapuas Hulu', 20),
(133, 'Kabupaten Kayong Utara', 20),
(134, 'Kabupaten Ketapang', 20),
(135, 'Kabupaten Kubu Raya', 20),
(136, 'Kabupaten Landak', 20),
(137, 'Kabupaten Melawi', 20),
(138, 'Kabupaten Mempawah', 20),
(139, 'Kabupaten Sambas', 20),
(140, 'Kabupaten Sanggau', 20),
(141, 'Kabupaten Sekadau', 20),
(142, 'Kabupaten Sintang', 20),
(143, 'Kabupaten Balangan', 21),
(144, 'Kabupaten Banjar', 21),
(145, 'Kabupaten Barito Kuala', 21),
(146, 'Kabupaten Hulu Sungai Selatan', 21),
(147, 'Kabupaten Hulu Sungai Tengah', 21),
(148, 'Kabupaten Hulu Sungai Utara', 21),
(149, 'Kabupaten Kotabaru', 21),
(150, 'Kabupaten Tabalong', 21),
(151, 'Kabupaten Tanah Bumbu', 21),
(152, 'Kabupaten Tanah Laut', 21),
(153, 'Kabupaten Tapin', 21),
(154, 'Kabupaten Barito Selatan', 22),
(155, 'Kabupaten Barito Timur', 22),
(156, 'Kabupaten Barito Utara', 22),
(157, 'Kabupaten Gunung Mas', 22),
(158, 'Kabupaten Kapuas', 22),
(159, 'Kabupaten Katingan', 22),
(160, 'Kabupaten Kotawaringin Barat', 22),
(161, 'Kabupaten Kotawaringin Timur', 22),
(162, 'Kabupaten Lamandau', 22),
(163, 'Kabupaten Murung Raya', 22),
(164, 'Kabupaten Pulang Pisau', 22),
(165, 'Kabupaten Seruyan', 22),
(166, 'Kabupaten Sukamara', 22),
(167, 'Kabupaten Berau', 23),
(168, 'Kabupaten Kutai Barat', 23),
(169, 'Kabupaten Kutai Kartanegara', 23),
(170, 'Kabupaten Kutai Timur', 23),
(171, 'Kabupaten Mahakam Ulu', 23),
(172, 'Kabupaten Paser', 23),
(173, 'Kabupaten Penajam Paser Utara', 23),
(174, 'Kabupaten Bulungan', 24),
(175, 'Kabupaten Malinau', 24),
(176, 'Kabupaten Nunukan', 24),
(177, 'Kabupaten Tana Tidung', 24),
(178, 'Kabupaten Bangka Barat', 9),
(179, 'Kabupaten Bangka Selatan', 9),
(180, 'Kabupaten Bangka Tengah', 9),
(181, 'Kabupaten Bangka', 9),
(182, 'Kabupaten Belitung Timur', 9),
(183, 'Kabupaten Belitung', 9),
(184, 'Kabupaten Bintan', 5),
(185, 'Kabupaten Karimun', 5),
(186, 'Kabupaten Kepulauan Anambas', 5),
(187, 'Kabupaten Lingga', 5),
(188, 'Kabupaten Natuna', 5),
(189, 'Kabupaten Lampung Barat', 10),
(190, 'Kabupaten Lampung Selatan', 10),
(191, 'Kabupaten Lampung Tengah', 10),
(192, 'Kabupaten Lampung Timur', 10),
(193, 'Kabupaten Lampung Utara', 10),
(194, 'Kabupaten Mesuji', 10),
(195, 'Kabupaten Pesawaran', 10),
(196, 'Kabupaten Pesisir Barat', 10),
(197, 'Kabupaten Pringsewu', 10),
(198, 'Kabupaten Tanggamus', 10),
(199, 'Kabupaten Tulang Bawang Barat', 10),
(200, 'Kabupaten Tulang Bawang', 10),
(201, 'Kabupaten Way Kanan', 10),
(202, 'Kabupaten Buru Selatan', 31),
(203, 'Kabupaten Buru', 31),
(204, 'Kabupaten Kepulauan Aru', 31),
(205, 'Kabupaten Maluku Barat Daya', 31),
(206, 'Kabupaten Maluku Tengah', 31),
(207, 'Kabupaten Maluku Tenggara Barat', 31),
(208, 'Kabupaten Maluku Tenggara', 31),
(209, 'Kabupaten Seram Bagian Barat', 31),
(210, 'Kabupaten Seram Bagian Timur', 31),
(211, 'Kabupaten Halmahera Barat', 32),
(212, 'Kabupaten Halmahera Selatan', 32),
(213, 'Kabupaten Halmahera Tengah', 32),
(214, 'Kabupaten Halmahera Timur', 32),
(215, 'Kabupaten Halmahera Utara', 32),
(216, 'Kabupaten Kepulauan Sula', 32),
(217, 'Kabupaten Pulau Morotai', 32),
(218, 'Kabupaten Pulau Taliabu', 32),
(219, 'Kabupaten Bima', 18),
(220, 'Kabupaten Dompu', 18),
(221, 'Kabupaten Lombok Barat', 18),
(222, 'Kabupaten Lombok Tengah', 18),
(223, 'Kabupaten Lombok Timur', 18),
(224, 'Kabupaten Lombok Utara', 18),
(225, 'Kabupaten Sumbawa Barat', 18),
(226, 'Kabupaten Sumbawa', 18),
(227, 'Kabupaten Alor', 19),
(228, 'Kabupaten Belu', 19),
(229, 'Kabupaten Ende', 19),
(230, 'Kabupaten Flores Timur', 19),
(231, 'Kabupaten Kupang', 19),
(232, 'Kabupaten Lembata', 19),
(233, 'Kabupaten Malaka', 19),
(234, 'Kabupaten Manggarai Barat', 19),
(235, 'Kabupaten Manggarai Timur', 19),
(236, 'Kabupaten Manggarai', 19),
(237, 'Kabupaten Nagekeo', 19),
(238, 'Kabupaten Ngada', 19),
(239, 'Kabupaten Rote Ndao', 19),
(240, 'Kabupaten Sabu Raijua', 19),
(241, 'Kabupaten Sikka', 19),
(242, 'Kabupaten Sumba Barat Daya', 19),
(243, 'Kabupaten Sumba Barat', 19),
(244, 'Kabupaten Sumba Tengah', 19),
(245, 'Kabupaten Sumba Timur', 19),
(246, 'Kabupaten Timor Tengah Selatan', 19),
(247, 'Kabupaten Timor Tengah Utara', 19),
(248, 'Kabupaten Asmat', 34),
(249, 'Kabupaten Biak Numfor', 34),
(250, 'Kabupaten Boven Digoel', 34),
(251, 'Kabupaten Deiyai', 34),
(252, 'Kabupaten Dogiyai', 34),
(253, 'Kabupaten Intan Jaya', 34),
(254, 'Kabupaten Jayapura', 34),
(255, 'Kabupaten Jayawijaya', 34),
(256, 'Kabupaten Keerom', 34),
(257, 'Kabupaten Kepulauan Yapen', 34),
(258, 'Kabupaten Lanny Jaya', 34),
(259, 'Kabupaten Mamberamo Raya', 34),
(260, 'Kabupaten Mamberamo Tengah', 34),
(261, 'Kabupaten Mappi', 34),
(262, 'Kabupaten Merauke', 34),
(263, 'Kabupaten Mimika', 34),
(264, 'Kabupaten Nabire', 34),
(265, 'Kabupaten Nduga', 34),
(266, 'Kabupaten Paniai', 34),
(267, 'Kabupaten Pegunungan Bintang', 34),
(268, 'Kabupaten Puncak Jaya', 34),
(269, 'Kabupaten Puncak', 34),
(270, 'Kabupaten Sarmi', 34),
(271, 'Kabupaten Supiori', 34),
(272, 'Kabupaten Tolikara', 34),
(273, 'Kabupaten Waropen', 34),
(274, 'Kabupaten Yahukimo', 34),
(275, 'Kabupaten Yalimo', 34),
(276, 'Kabupaten Fakfak', 33),
(277, 'Kabupaten Kaimana', 33),
(278, 'Kabupaten Manokwari', 33),
(279, 'Kabupaten Manokwari Selatan', 33),
(280, 'Kabupaten Maybrat', 33),
(281, 'Kabupaten Pegunungan Arfak', 33),
(282, 'Kabupaten Raja Ampat', 33),
(283, 'Kabupaten Sorong', 33),
(284, 'Kabupaten Sorong Selatan', 33),
(285, 'Kabupaten Tambrauw', 33),
(286, 'Kabupaten Teluk Bintuni', 33),
(287, 'Kabupaten Teluk Wondama', 33),
(288, 'Kabupaten Bengkalis', 4),
(289, 'Kabupaten Indragiri Hilir', 4),
(290, 'Kabupaten Indragiri Hulu', 4),
(291, 'Kabupaten Kampar', 4),
(292, 'Kabupaten Kepulauan Meranti', 4),
(293, 'Kabupaten Kuantan Singingi', 4),
(294, 'Kabupaten Pelalawan', 4),
(295, 'Kabupaten Rokan Hilir', 4),
(296, 'Kabupaten Rokan Hulu', 4),
(297, 'Kabupaten Siak', 4),
(298, 'Kabupaten Majene', 26),
(299, 'Kabupaten Mamasa', 26),
(300, 'Kabupaten Mamuju', 26),
(301, 'Kabupaten Mamuju Tengah', 26),
(302, 'Kabupaten Mamuju Utara', 26),
(303, 'Kabupaten Polewali Mandar', 26),
(304, 'Kabupaten Bantaeng', 27),
(305, 'Kabupaten Barru', 27),
(306, 'Kabupaten Bone', 27),
(307, 'Kabupaten Bulukumba', 27),
(308, 'Kabupaten Enrekang', 27),
(309, 'Kabupaten Gowa', 27),
(310, 'Kabupaten Jeneponto', 27),
(311, 'Kabupaten Kepulauan Selayar', 27),
(312, 'Kabupaten Luwu', 27),
(313, 'Kabupaten Luwu Timur', 27),
(314, 'Kabupaten Luwu Utara', 27),
(315, 'Kabupaten Maros', 27),
(316, 'Kabupaten Pangkajene dan Kepulauan', 27),
(317, 'Kabupaten Pinrang', 27),
(318, 'Kabupaten Sidenreng Rappang', 27),
(319, 'Kabupaten Sinjai', 27),
(320, 'Kabupaten Soppeng', 27),
(321, 'Kabupaten Takalar', 27),
(322, 'Kabupaten Tana Toraja', 27),
(323, 'Kabupaten Toraja Utara', 27),
(324, 'Kabupaten Wajo', 27),
(325, 'Kabupaten Banggai', 28),
(326, 'Kabupaten Banggai Kepulauan', 28),
(327, 'Kabupaten Banggai Laut', 28),
(328, 'Kabupaten Buol', 28),
(329, 'Kabupaten Donggala', 28),
(330, 'Kabupaten Morowali', 28),
(331, 'Kabupaten Morowali Utara', 28),
(332, 'Kabupaten Parigi Moutong', 28),
(333, 'Kabupaten Poso', 28),
(334, 'Kabupaten Sigi', 28),
(335, 'Kabupaten Tojo Una-Una', 28),
(336, 'Kabupaten Toli-Toli', 28),
(337, 'Kabupaten Bombana', 29),
(338, 'Kabupaten Buton', 29),
(339, 'Kabupaten Buton Selatan', 29),
(340, 'Kabupaten Buton Tengah', 29),
(341, 'Kabupaten Buton Utara', 29),
(342, 'Kabupaten Kolaka', 29),
(343, 'Kabupaten Kolaka Timur', 29),
(344, 'Kabupaten Kolaka Utara', 29),
(345, 'Kabupaten Konawe Kepulauan', 29),
(346, 'Kabupaten Konawe Selatan', 29),
(347, 'Kabupaten Konawe Utara', 29),
(348, 'Kabupaten Konawe', 29),
(349, 'Kabupaten Muna', 29),
(350, 'Kabupaten Muna Barat', 29),
(351, 'Kabupaten Wakatobi', 29),
(352, 'Kabupaten Bolaang Mongondow', 30),
(353, 'Kabupaten Bolaang Mongondow Selatan', 30),
(354, 'Kabupaten Bolaang Mongondow Timur', 30),
(355, 'Kabupaten Bolaang Mongondow Utara', 30),
(356, 'Kabupaten Kepulauan Sangihe', 30),
(357, 'Kabupaten Kepulauan Siau Tagulandang Biaro', 30),
(358, 'Kabupaten Kepulauan Talaud', 30),
(359, 'Kabupaten Minahasa', 30),
(360, 'Kabupaten Minahasa Selatan', 30),
(361, 'Kabupaten Minahasa Tenggara', 30),
(362, 'Kabupaten Minahasa Utara', 30),
(363, 'Kabupaten Agam', 3),
(364, 'Kabupaten Dharmasraya', 3),
(365, 'Kabupaten Kepulauan Mentawai', 3),
(366, 'Kabupaten Lima Puluh Kota', 3),
(367, 'Kabupaten Padang Pariaman', 3),
(368, 'Kabupaten Pasaman Barat', 3),
(369, 'Kabupaten Pasaman', 3),
(370, 'Kabupaten Pesisir Selatan', 3),
(371, 'Kabupaten Sijunjung', 3),
(372, 'Kabupaten Solok Selatan', 3),
(373, 'Kabupaten Solok', 3),
(374, 'Kabupaten Tanah Datar', 3),
(375, 'Kabupaten Banyuasin', 8),
(376, 'Kabupaten Empat Lawang', 8),
(377, 'Kabupaten Lahat', 8),
(378, 'Kabupaten Muara Enim', 8),
(379, 'Kabupaten Musi Banyuasin', 8),
(380, 'Kabupaten Musi Rawas', 8),
(381, 'Kabupaten Musi Rawas Utara', 8),
(382, 'Kabupaten Ogan Ilir', 8),
(383, 'Kabupaten Ogan Komering Ilir', 8),
(384, 'Kabupaten Ogan Komering Ulu Selatan', 8),
(385, 'Kabupaten Ogan Komering Ulu Timur', 8),
(386, 'Kabupaten Ogan Komering Ulu', 8),
(387, 'Kabupaten Penukal Abab Lematang Ilir', 8),
(388, 'Kabupaten Asahan', 2),
(389, 'Kabupaten Batubara', 2),
(390, 'Kabupaten Dairi', 2),
(391, 'Kabupaten Deli Serdang', 2),
(392, 'Kabupaten Humbang Hasundutan', 2),
(393, 'Kabupaten Karo', 2),
(394, 'Kabupaten Labuhanbatu Selatan', 2),
(395, 'Kabupaten Labuhanbatu Utara', 2),
(396, 'Kabupaten Labuhanbatu', 2),
(397, 'Kabupaten Langkat', 2),
(398, 'Kabupaten Mandailing Natal', 2),
(399, 'Kabupaten Nias Barat', 2),
(400, 'Kabupaten Nias Selatan', 2),
(401, 'Kabupaten Nias Utara', 2),
(402, 'Kabupaten Nias', 2),
(403, 'Kabupaten Padang Lawas Utara', 2),
(404, 'Kabupaten Padang Lawas', 2),
(405, 'Kabupaten Pakpak Bharat', 2),
(406, 'Kabupaten Samosir', 2),
(407, 'Kabupaten Serdang Bedagai', 2),
(408, 'Kabupaten Simalungun', 2),
(409, 'Kabupaten Tapanuli Selatan', 2),
(410, 'Kabupaten Tapanuli Tengah', 2),
(411, 'Kabupaten Tapanuli Utara', 2),
(412, 'Kabupaten Toba Samosir', 2),
(413, 'Kabupaten Bantul', 15),
(414, 'Kabupaten Gunung Kidul', 15),
(415, 'Kabupaten Kulon Progo', 15),
(416, 'Kabupaten Sleman', 15),
(419, 'Kota Serang', 11),
(420, 'Kota Tangerang', 11),
(421, 'Kota Tangerang Selatan', 11),
(423, 'Kota Gorontalo', 25),
(425, 'Kota Administrasi Jakarta Pusat', 13),
(426, 'Kota Administrasi Jakarta Selatan', 13),
(427, 'Kota Administrasi Jakarta Timur', 13),
(428, 'Kota Administrasi Jakarta Utara', 13),
(429, 'Kota Jambi', 6),
(430, 'Kota Sungai Penuh', 6),
(431, 'Kota Bandung', 12),
(432, 'Kota Banjar', 12),
(433, 'Kota Bekasi', 12),
(434, 'Kota Bogor', 12),
(435, 'Kota Cimahi', 12),
(436, 'Kota Cirebon', 12),
(437, 'Kota Depok', 12),
(438, 'Kota Sukabumi', 12),
(439, 'Kota Tasikmalaya', 12),
(440, 'Kota Magelang', 14),
(441, 'Kota Pekalongan', 14),
(442, 'Kota Salatiga', 14),
(443, 'Kota Semarang', 14),
(444, 'Kota Surakarta', 14),
(445, 'Kota Tegal', 14),
(446, 'Kota Batu', 16),
(447, 'Kota Blitar', 16),
(448, 'Kota Kediri', 16),
(449, 'Kota Madiun', 16),
(450, 'Kota Malang', 16),
(451, 'Kota Mojokerto', 16),
(452, 'Kota Pasuruan', 16),
(453, 'Kota Probolinggo', 16),
(454, 'Kota Surabaya', 16),
(455, 'Kota Pontianak', 20),
(456, 'Kota Singkawang', 20),
(458, 'Kota Banjarmasin', 21),
(459, 'Kota Palangka Raya', 22),
(460, 'Kota Balikpapan', 23),
(461, 'Kota Bontang', 23),
(462, 'Kota Samarinda', 23),
(463, 'Kota Tarakan', 24),
(464, 'Kota Pangkal Pinang', 9),
(465, 'Kota Batam', 5),
(466, 'Kota Tanjung Pinang', 5),
(467, 'Kota Bandar Lampung', 10),
(468, 'Kota Metro', 10),
(469, 'Kota Ambon', 31),
(470, 'Kota Tual', 31),
(471, 'Kota Ternate', 32),
(472, 'Kota Tidore Kepulauan', 32),
(473, 'Kota Banda Aceh', 1),
(474, 'Kota Langsa', 1),
(475, 'Kota Lhoksumawe', 1),
(476, 'Kota Sabang', 1),
(477, 'Kota Subulussalam', 1),
(478, 'Kota Bima', 18),
(479, 'Kota Mataram', 18),
(480, 'Kota Kupang', 19),
(481, 'kota Jayapura', 34),
(482, 'Kota Sorong', 33),
(483, 'Kota Dumai', 4),
(484, 'Kota Pekanbaru', 4),
(485, 'Kota Makassar', 27),
(486, 'Kota Palopo', 27),
(487, 'Kota Parepare', 27),
(488, 'Kota Palu', 28),
(489, 'Kota Baubau', 29),
(490, 'Kota Kendari', 29),
(491, 'Kota Bitung', 30),
(492, 'Kota Kotamobagu', 30),
(493, 'Kota Manado', 30),
(494, 'Kota Tomohon', 30),
(495, 'Kota Bukittinggi', 3),
(496, 'Kota Padang', 3),
(497, 'Kota Padangpanjang', 3),
(498, 'Kota Pariaman', 3),
(499, 'Kota Payakumbuh', 3),
(500, 'Kota Sawahlunto', 3),
(501, 'Kota Solok', 3),
(502, 'Kota Lubuklinggau', 8),
(503, 'Kota Pagar Alam', 8),
(504, 'Kota Palembang', 8),
(505, 'Kota Prabumulih', 8),
(506, 'Kota Binjai', 2),
(507, 'Kota Gunungsitoli', 2),
(508, 'Kota Medan', 2),
(509, 'Kota Padangsidempuan', 2),
(510, 'Kota Pematangsiantar', 2),
(511, 'Kota Sibolga', 2),
(512, 'Kota Tanjungbalai', 2),
(513, 'Kota Tebing Tinggi', 2),
(514, 'Kota Yogyakarta', 15),
(515, 'Kabupaten Badung', 17),
(516, 'Kabupaten Bangli', 17),
(517, 'Kabupaten Buleleng', 17),
(518, 'Kabupaten Gianyar', 17),
(519, 'Kabupaten Jembrana', 17),
(520, 'Kabupaten Karangasem', 17),
(521, 'Kabupaten Klungkung', 17),
(522, 'Kabupaten Tabanan', 17),
(523, 'Kota Denpasar', 17),
(524, 'Kota Cilegon', 11),
(525, 'Kota Bengkulu', 7),
(526, 'Kota Administrasi Jakarta Barat', 13),
(528, 'Kota Banjarbaru', 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `nama_kecamatan` varchar(100) NOT NULL,
  `id_kabupaten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `nama_kecamatan`, `id_kabupaten`) VALUES
(1, 'Blang Pidie', 1),
(2, 'Tangan-Tangan', 1),
(3, 'Manggeng', 1),
(4, 'Susoh', 1),
(5, 'Kuala Batee', 1),
(6, 'Babah Rot', 1),
(7, 'Setia', 1),
(8, 'Jeumpa', 1),
(9, 'Lembah Sabil', 1),
(10, 'Johan Pahlawan', 2),
(11, 'Samatiga', 2),
(12, 'Bubon', 2),
(13, 'Arongan Lambalek', 2),
(14, 'Woyla', 2),
(15, 'Woyla Barat', 2),
(16, 'Woyla Timur', 2),
(17, 'Kaway XVI', 2),
(18, 'Meureubo', 2),
(19, 'Pante Ceureumen', 2),
(20, 'Panton Reu', 2),
(21, 'Sungai Mas', 2),
(22, 'Ciputat', 421),
(23, 'Ciputat Timur', 421),
(24, 'Pamulang', 421),
(25, 'Pondok Aren', 421),
(26, 'Serpong', 421),
(27, 'Serpong Utara', 421),
(28, 'Setu', 421),
(29, 'Abiansemal', 515),
(30, 'Kuta', 515),
(31, 'Kuta Selatan', 515),
(32, 'Kuta Utara', 515),
(33, 'Mengwi', 515),
(34, 'Petang', 515);

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan_paket`
--

CREATE TABLE `layanan_paket` (
  `id_layanan_paket` int(11) NOT NULL,
  `id_jenis_layanan` int(11) NOT NULL,
  `id_kecamatan_asal` int(11) NOT NULL,
  `id_kecamatan_tujuan` int(11) NOT NULL,
  `id_jenis_paket` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `durasi_pengiriman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `layanan_paket`
--

INSERT INTO `layanan_paket` (`id_layanan_paket`, `id_jenis_layanan`, `id_kecamatan_asal`, `id_kecamatan_tujuan`, `id_jenis_paket`, `harga`, `durasi_pengiriman`) VALUES
(1, 2, 28, 27, 1, 10000, 48),
(2, 1, 28, 29, 1, 23000, 24),
(3, 3, 29, 28, 1, 9000, 48),
(4, 2, 26, 31, 1, 9000, 48);

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
(213, 'Pengguna admin berhasil login', '2020-06-15 12:12:04', 1),
(214, 'Pengguna admin berhasil login', '2020-06-15 23:07:55', 1),
(215, 'Pengguna admin berhasil logout', '2020-06-15 23:08:37', 1),
(216, 'Pengguna admin berhasil login', '2020-06-15 23:18:10', 1),
(217, 'Pengguna admin berhasil login', '2020-06-17 12:23:46', 1),
(218, 'Pengguna admin berhasil login', '2020-06-17 17:02:07', 1),
(219, 'Pengguna admin berhasil menambahkan pengguna irgi', '2020-06-17 17:21:38', 1),
(220, 'Pengguna admin berhasil logout', '2020-06-17 17:21:46', 1),
(221, 'Pengguna irgi berhasil login', '2020-06-17 17:21:49', 3),
(222, 'Pengguna irgi berhasil logout', '2020-06-17 17:21:58', 3),
(223, 'Pengguna admin berhasil login', '2020-06-17 17:22:02', 1),
(224, 'Pengguna admin berhasil menambahkan Layanan Paket ', '2020-06-17 17:22:40', 1),
(225, 'Pengguna admin berhasil mengubah Layanan Paket ', '2020-06-17 17:22:50', 1),
(226, 'Pengguna admin berhasil diubah', '2020-06-17 17:24:10', 1),
(227, 'Pengguna admin berhasil diubah', '2020-06-17 17:24:54', 1),
(228, 'Pengguna admin berhasil login', '2020-06-17 17:34:24', 1),
(229, 'Pengguna admin berhasil menambahkan Jenis Layanan SS (Spesial Service)', '2020-06-17 17:34:56', 1),
(230, 'Pengguna admin berhasil mengubah Jenis Layanan SS (Spesial Services)', '2020-06-17 17:35:02', 1),
(231, 'Pengguna admin berhasil mengubah Jenis Layanan SS (Spesial Service)', '2020-06-17 17:35:08', 1),
(232, 'Pengguna admin berhasil menambahkan Jenis Paket Elektronik', '2020-06-17 17:35:47', 1),
(233, 'Pengguna admin berhasil mengubah Jenis Paket Elektroni', '2020-06-17 17:35:51', 1),
(234, 'Jenis Paket Elektroni berhasil dihapus', '2020-06-17 17:35:54', 1),
(235, 'Pengguna admin berhasil mengubah Jenis Layanan SS (Spesial Service)', '2020-06-17 17:36:00', 1),
(236, 'Jenis Layanan SS (Spesial Service) berhasil dihapus', '2020-06-17 17:36:04', 1),
(237, 'Pengguna admin berhasil menambahkan Jenis Layanan SS (Spesial Service)', '2020-06-17 17:36:07', 1),
(238, 'Pengguna admin berhasil menambahkan Provinsi ', '2020-06-17 17:36:20', 1),
(239, 'Pengguna admin berhasil mengubah Provinsi ', '2020-06-17 17:36:31', 1),
(240, 'Provinsi Mana Aja berhasil dihapus', '2020-06-17 17:36:38', 1),
(241, 'Pengguna admin berhasil menambahkan kabupaten ', '2020-06-17 17:37:01', 1),
(242, 'Pengguna admin berhasil mengubah kabupaten ', '2020-06-17 17:37:08', 1),
(243, 'kabupaten Asdasdasd berhasil dihapus', '2020-06-17 17:37:11', 1),
(244, 'Pengguna admin berhasil menambahkan kecamatan ', '2020-06-17 17:37:31', 1),
(245, 'Pengguna admin berhasil mengubah kecamatan ', '2020-06-17 17:37:39', 1),
(246, 'kecamatan Asdasdas berhasil dihapus', '2020-06-17 17:37:43', 1),
(247, 'Jabatan Andri Firman Saputra | tas | Andre Farhan Saputra berhasil dihapus', '2020-06-17 19:11:49', 1),
(248, 'Jabatan Andri Firman Saputra | tas | Andre Farhan Saputra berhasil dihapus', '2020-06-17 19:11:52', 1),
(249, 'Kurir admin Akan Mengambil Barang Di \r\n<div style=', '2020-06-17 19:12:44', 1),
(250, 'Jabatan Andri Firman Saputra | Kemeja Pendek | Andre Farhan Saputra berhasil dihapus', '2020-06-17 19:19:35', 1),
(251, 'Jabatan Andri Firman Saputra | Kemeja Panjang | Andre Farhan Saputra berhasil dihapus', '2020-06-17 19:19:39', 1),
(252, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-17 19:30:28', 1),
(253, 'Jabatan Andri Firman Saputra | handphone | Andere berhasil dihapus', '2020-06-17 19:30:35', 1),
(254, 'Pengguna admin berhasil logout', '2020-06-17 19:41:26', 1),
(255, 'Pengguna  berhasil menambahkan pesanan ', '2020-06-17 19:43:34', NULL),
(256, 'Pengguna admin berhasil login', '2020-06-17 19:44:52', 1),
(257, 'Pengguna admin berhasil login', '2020-06-17 19:44:59', 1),
(258, 'Pelanggan  berhasil menambahkan pesanan ', '2020-06-17 19:51:17', NULL),
(259, 'Pengguna admin berhasil login', '2020-06-17 19:53:30', 1),
(260, 'Pengguna admin berhasil login', '2020-06-17 19:54:06', 1),
(261, 'Kurir admin Akan Mengambil Barang Di Pocis No. 100, Setu, Kota Tangerang Selatan, Banten', '2020-06-17 20:21:12', 1),
(262, 'Jabatan Andri Firman Saputra | tas | Andre Farhan Saputra berhasil dihapus', '2020-06-17 20:21:21', 1),
(263, 'Jabatan Andri Firman Saputra | handphone | Andere berhasil dihapus', '2020-06-17 20:21:24', 1),
(264, 'Jabatan Andri Firman Saputra | kopi bali 2kg | Andre Fahr berhasil dihapus', '2020-06-17 20:21:28', 1),
(265, 'Kurir admin Telah Mengambil Barang Di Pocis No. 100, Setu, Kota Tangerang Selatan, Banten', '2020-06-17 20:21:36', 1),
(266, 'Kurir admin Akan Mengambil Barang Di Pocis No. 100, Setu, Kota Tangerang Selatan, Banten', '2020-06-17 20:23:37', 1),
(267, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-17 20:25:32', 1),
(268, 'Pengguna admin berhasil login', '2020-06-17 21:20:01', 1),
(269, 'Pengguna admin berhasil login', '2020-06-17 21:24:14', 1),
(270, 'Pengguna admin berhasil login', '2020-06-17 21:34:57', 1),
(271, 'Pengguna admin berhasil login', '2020-06-17 21:38:16', 1),
(272, 'Pengguna admin berhasil login', '2020-06-17 21:39:35', 1),
(273, 'Kurir admin Akan Mengambil Barang Di Pocis No. 100, Setu, Kota Tangerang Selatan, Banten', '2020-06-17 22:52:29', 1),
(274, 'Pengguna admin berhasil login', '2020-06-17 23:21:00', 1),
(275, 'Pengguna admin berhasil logout', '2020-06-17 23:41:20', 1),
(276, 'Pengguna admin berhasil login', '2020-06-17 23:41:34', 1),
(277, 'Pengguna admin berhasil login', '2020-06-18 00:34:30', 1),
(278, 'Pengguna admin berhasil login', '2020-06-18 00:37:18', 1),
(279, 'Pengguna admin berhasil login', '2020-06-18 00:38:20', 1),
(280, 'Pengguna admin berhasil login', '2020-06-18 00:38:33', 1),
(281, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-18 00:39:47', 1),
(282, 'Pengguna admin berhasil login', '2020-06-18 00:42:38', 1),
(283, 'Pengguna admin berhasil login', '2020-06-18 00:45:39', 1),
(284, 'Jabatan Andri Firman Saputra | kopi bali 2kg | Andre berhasil dihapus', '2020-06-18 00:47:52', 1),
(285, 'Pengguna admin berhasil login', '2020-06-18 01:18:55', 1),
(286, 'Pengguna admin berhasil logout', '2020-06-18 01:19:46', 1),
(287, 'Pengguna admin berhasil login', '2020-06-18 01:22:11', 1),
(288, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-18 01:52:53', 1),
(289, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-18 02:06:58', 1),
(290, 'Jabatan Andri Firman Saputra | handphone | Andre berhasil dihapus', '2020-06-18 02:07:20', 1),
(291, 'Pengguna admin berhasil logout', '2020-06-18 02:19:45', 1),
(292, 'Pelanggan  berhasil menambahkan pesanan ', '2020-06-18 02:20:17', NULL),
(293, 'Pengguna admin berhasil login', '2020-06-18 02:20:32', 1),
(294, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-18 02:22:03', 1),
(295, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-18 02:26:24', 1),
(296, 'Jabatan Andri Firman Saputra | handphone | Andre berhasil dihapus', '2020-06-18 02:47:21', 1),
(297, 'Jabatan Andri Firman Saputra | stick es krim | Andre berhasil dihapus', '2020-06-18 02:47:25', 1),
(298, 'Jabatan Andri Firman Saputra | buku | Andre berhasil dihapus', '2020-06-18 02:47:28', 1),
(299, 'Jabatan Andri Firman Saputra | pulpen | Andre berhasil dihapus', '2020-06-18 02:47:32', 1),
(300, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-18 02:48:31', 1),
(301, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-18 02:58:08', 1),
(302, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-18 03:03:23', 1),
(303, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-18 03:06:37', 1),
(304, 'Pengguna admin berhasil login', '2020-06-18 03:09:52', 1),
(305, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-18 03:10:48', 1),
(306, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-18 03:12:13', 1),
(307, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-18 03:13:13', 1),
(308, 'Pengguna admin berhasil menambahkan Layanan Paket ', '2020-06-18 03:14:41', 1),
(309, 'Pengguna admin berhasil login', '2020-06-18 12:20:19', 1),
(310, 'Kurir admin Telah Mengambil Barang Di Pocis No. 100, Setu, Kota Tangerang Selatan, Banten', '2020-06-18 12:20:41', 1),
(311, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100, Setu, Kota Tangerang Selatan, Banten', '2020-06-18 12:20:55', 1),
(312, 'Kurir admin Akan Mengambil Barang Di Pocis No. 100, Setu, Kota Tangerang Selatan, Banten', '2020-06-18 12:21:40', 1),
(313, 'Jabatan Andri Firman Saputra | sempak | Andre berhasil dihapus', '2020-06-18 14:15:43', 1),
(314, 'Jabatan Andri Firman Saputra | piring pecah | Andre berhasil dihapus', '2020-06-18 14:15:55', 1),
(315, 'Pengguna admin berhasil logout', '2020-06-18 14:16:10', 1),
(316, 'Pelanggan  berhasil menambahkan pesanan ', '2020-06-18 14:18:45', NULL),
(317, 'Pengguna admin berhasil login', '2020-06-18 14:19:01', 1),
(318, 'Kurir admin Akan Mengambil Barang Di Jl. AMD Babakan Pocis No. 100, Setu, Kota Tangerang Selatan, Banten', '2020-06-18 14:19:16', 1),
(319, 'Pengguna admin berhasil logout', '2020-06-18 14:20:11', 1),
(320, 'Pengguna admin berhasil login', '2020-06-18 14:25:16', 1),
(321, 'Kurir admin Telah Mengambil Barang Di Jl. AMD Babakan Pocis No. 100, Setu, Kota Tangerang Selatan, Banten', '2020-06-18 14:26:04', 1),
(322, 'Pengguna admin berhasil menambahkan Layanan Paket ', '2020-06-18 14:29:41', 1),
(323, 'Pengguna admin berhasil menambahkan pesanan ', '2020-06-18 14:30:24', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerima`
--

CREATE TABLE `penerima` (
  `id_penerima` int(11) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `no_wa_penerima` varchar(25) NOT NULL,
  `alamat_penerima` text NOT NULL,
  `id_kecamatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penerima`
--

INSERT INTO `penerima` (`id_penerima`, `nama_penerima`, `no_wa_penerima`, `alamat_penerima`, `id_kecamatan`) VALUES
(2, 'Andre Farhan Saputra', '081314213758', 'Jl. Amd Babakan Pocis No. 69 Rt02/02', 28),
(3, 'Andre Farhan Saputra', '08123', 'Gg. Kemerdekaan No. 22', 29),
(5, 'Andre Farhan Saputra', '0878787878', 'Gg. Kemerdekaan No. 100', 29),
(6, 'Andre Farhan Saputra', '23423432', 'Jl. AMD Babakan Pocis No. 69 RT02/02', 29),
(7, 'Andre Farhan Saputra', '087808675343', 'di bali gw cuy no, 100 ', 29),
(8, 'Andre Farhan Saputra', '0878787878', 'bali no. 100', 29),
(9, 'Andere', '087878787', 'bali no. 100', 29),
(10, 'Andre Fahr', '123124124123', 'Bali 123', 29),
(11, 'Andreesadsad', '08237128321', 'bali no. 100', 29),
(12, 'asddasd', '12312321', 'eqwewqewq', 29),
(13, 'Andre', '21312312321', 'Pocis No. 101', 29),
(14, 'Andre', '087808787878', 'Pocis No. 101', 29),
(15, 'Andre', '0877879878', 'Pocis No. 101', 29),
(16, 'Andre', '0878237123821', 'Bali no. 100', 29),
(17, 'Andre', '12312321312312', 'Bali no. 100', 29),
(18, 'Andre', '2321312312', 'Bali no. 100', 29),
(19, 'andre', '0872328137128', 'Bali', 29),
(20, 'andre', '213213213213', 'Pocis No. 101`', 29),
(21, 'Andre', '2313213', 'Pocis No. 102', 29),
(22, 'Andre', '32142124', 'Pocis No. 101', 29),
(23, 'Andre', '34324', 'Pocis No. 101', 29),
(24, 'Andre', '213131', 'Pocis No. 101', 29),
(25, 'andre', '3123123', 'dasdsad', 29),
(26, 'Friscal', '089623231321', 'Bali no. 100', 29),
(27, 'Gery', '089623231111', 'Kuta selatan no. 11', 31);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengirim`
--

CREATE TABLE `pengirim` (
  `id_pengirim` int(11) NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `no_wa_pengirim` varchar(25) NOT NULL,
  `alamat_pengirim` text NOT NULL,
  `id_kecamatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengirim`
--

INSERT INTO `pengirim` (`id_pengirim`, `nama_pengirim`, `no_wa_pengirim`, `alamat_pengirim`, `id_kecamatan`) VALUES
(2, 'Andri Firman Saputra', '087808675313', 'Jl. Amd Babakn Pocis No. 100 Rt02/02', 28),
(3, 'Andri Firman Saputra', '087808675313', 'Jl. AMD Babakan Pocis No. 100 RT02/02', 28),
(4, 'Andri Firman Saputra', '087808675313', 'Pocis No. 100', 28),
(5, 'Andri Firman Saputra', '0878086756313', 'aasd', 22),
(6, 'Andri Firman Saputra', '087808675313', '12312312', 28),
(7, 'Andri Firman Saputra', '087808675313', 'Jl. AMD Babakan Pocis No. 100', 28),
(8, 'Andri Firman Saputra', '087808675343', 'Jl. AMD Babakan Pocis No. 100', 28),
(9, 'Andri Firman Saputra', '0878086753413', 'Pocis No. 100', 28),
(10, 'Andri Firman Saputra', '21321321', 'Pocis No. 100', 28),
(11, 'Andri Firman Saputra', '12312321', 'Jl. AMD Babakan Pocis No. 100', 28),
(12, 'Andri Firman Saputra', '234123', 'Jl. AMD Babakan Pocis No. 100', 28),
(13, 'Andri Firman Saputra', '2134213', 'Jl. AMD Babakan Pocis No. 100', 28),
(14, 'Andri Firman Saputra', '21312321321', 'Jl. AMD Babakan Pocis No. 100', 28),
(15, 'Pitarenda', '081314213758', 'Jl. AMD Babakan Pocis No. 100', 28),
(16, 'Andri Firman Saputra', '087808675313', 'Jl. Rawa buntu selatan', 26);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pickup_barang`
--

CREATE TABLE `pickup_barang` (
  `id_pickup_barang` int(11) NOT NULL,
  `no_resi` char(15) NOT NULL,
  `id_pengirim` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `id_layanan_paket` int(11) NOT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `berat_barang` float NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `tanggal_pemesanan` datetime DEFAULT NULL,
  `tanggal_penjemputan` datetime DEFAULT NULL,
  `tanggal_masuk_logistik` datetime DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pickup_barang`
--

INSERT INTO `pickup_barang` (`id_pickup_barang`, `no_resi`, `id_pengirim`, `id_penerima`, `id_layanan_paket`, `nama_barang`, `berat_barang`, `jumlah_barang`, `tanggal_pemesanan`, `tanggal_penjemputan`, `tanggal_masuk_logistik`, `status`) VALUES
(11, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-15 19:51:17', '2020-06-16 21:17:26', '2020-06-17 22:17:37', 3),
(12, '226951592400332', 6, 12, 2, 'wqdasdasd', 1.232, 1, '2020-06-17 20:25:32', NULL, NULL, 1),
(13, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-17 20:04:58', '2020-06-17 20:18:04', '2020-06-18 12:20:41', 3),
(14, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-15 19:51:17', '2020-06-16 21:17:26', '2020-06-17 22:17:37', 3),
(15, '226951592400332', 6, 12, 2, 'wqdasdasd', 1.232, 1, '2020-06-17 20:25:32', NULL, NULL, 1),
(16, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-17 20:04:58', '2020-06-17 20:18:04', NULL, 2),
(17, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-15 19:51:17', '2020-06-16 21:17:26', '2020-06-17 22:17:37', 3),
(18, '226951592400332', 6, 12, 2, 'wqdasdasd', 1.232, 1, '2020-06-17 20:25:32', NULL, NULL, 1),
(19, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-17 20:04:58', '2020-06-17 20:18:04', NULL, 2),
(20, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-15 19:51:17', '2020-06-16 21:17:26', '2020-06-17 22:17:37', 3),
(21, '226951592400332', 6, 12, 2, 'wqdasdasd', 1.232, 1, '2020-06-17 20:25:32', NULL, NULL, 1),
(22, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-17 20:04:58', '2020-06-17 20:18:04', NULL, 2),
(23, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-15 19:51:17', '2020-06-16 21:17:26', '2020-06-17 22:17:37', 3),
(24, '226951592400332', 6, 12, 2, 'wqdasdasd', 1.232, 1, '2020-06-17 20:25:32', NULL, NULL, 1),
(25, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-17 20:04:58', '2020-06-17 20:18:04', '2020-06-18 12:20:41', 3),
(26, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-15 19:51:17', '2020-06-16 21:17:26', '2020-06-17 22:17:37', 3),
(27, '226951592400332', 6, 12, 2, 'wqdasdasd', 1.232, 1, '2020-06-17 20:25:32', NULL, NULL, 1),
(28, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-17 20:04:58', '2020-06-17 20:18:04', NULL, 2),
(29, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-15 19:51:17', '2020-06-16 21:17:26', '2020-06-17 22:17:37', 3),
(30, '226951592400332', 6, 12, 2, 'wqdasdasd', 1.232, 1, '2020-06-17 20:25:32', NULL, NULL, 1),
(31, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-17 20:04:58', '2020-06-17 20:18:04', NULL, 2),
(32, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-15 19:51:17', '2020-06-16 21:17:26', '2020-06-17 22:17:37', 3),
(33, '226951592400332', 6, 12, 2, 'wqdasdasd', 1.232, 1, '2020-06-17 20:25:32', NULL, NULL, 1),
(34, '767041592398277', 4, 11, 2, 'kopi jambi', 1, 1, '2020-06-17 20:04:58', '2020-06-17 20:18:04', NULL, 2),
(41, '793571592423311', 4, 19, 2, 'pensil', 1, 1, '2020-06-18 02:48:31', NULL, NULL, 1),
(42, '870581592423888', 4, 20, 2, 'handphone', 1, 1, '2020-06-18 02:58:08', NULL, NULL, 1),
(44, '559981592424397', 11, 22, 2, 'celana dalam', 0.02, 2, '2020-06-18 03:06:37', '2020-06-18 12:20:55', NULL, 2),
(46, '999961592424733', 13, 24, 2, 'handphone siaomi', 4, 2, '2020-06-18 03:12:13', '2020-06-18 12:20:55', NULL, 2),
(47, '990381592424793', 14, 25, 2, 'kaos jersey', 5, 10, '2020-06-18 03:13:13', '2020-06-18 12:20:55', NULL, 2),
(48, '289361592464725', 15, 26, 2, 'Dompet', 3, 5, '2020-06-18 14:18:45', '2020-06-18 14:19:16', '2020-06-18 14:26:04', 3),
(49, '581181592465424', 16, 27, 4, 'Buku Gambar a3', 3.5, 8, '2020-06-18 14:30:24', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE `provinsi` (
  `id_provinsi` int(11) NOT NULL,
  `nama_provinsi` varchar(100) NOT NULL,
  `negara` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `provinsi`
--

INSERT INTO `provinsi` (`id_provinsi`, `nama_provinsi`, `negara`) VALUES
(1, 'Nanggroe Aceh Darussalam', 'Indonesia'),
(2, 'Sumatra Utara', 'Indonesia'),
(3, 'Sumatra Barat', 'Indonesia'),
(4, 'Riau', 'Indonesia'),
(5, 'Kepulauan Riau', 'Indonesia'),
(6, 'Jambi', 'Indonesia'),
(7, 'Bengkulu', 'Indonesia'),
(8, 'Sumatra Selatan', 'Indonesia'),
(9, 'Kepulauan Bangka Belitung', 'Indonesia'),
(10, 'Lampung', 'Indonesia'),
(11, 'Banten', 'Indonesia'),
(12, 'Jawa Barat', 'Indonesia'),
(13, 'Jakarta', 'Indonesia'),
(14, 'Jawa Tengah', 'Indonesia'),
(15, 'Yogyakarta', 'Indonesia'),
(16, 'Jawa Timur', 'Indonesia'),
(17, 'Bali', 'Indonesia'),
(18, 'Nusa Tenggara Barat', 'Indonesia'),
(19, 'Nusa Tenggara Timur', 'Indonesia'),
(20, 'Kalimantan Barat', 'Indonesia'),
(21, 'Kalimantan Selatan', 'Indonesia'),
(22, 'Kalimantan Tengah', 'Indonesia'),
(23, 'Kalimantan Timur', 'Indonesia'),
(24, 'Kalimantan Utara', 'Indonesia'),
(25, 'Gorontalo', 'Indonesia'),
(26, 'Sulawesi Barat', 'Indonesia'),
(27, 'Sulawesi Selatan', 'Indonesia'),
(28, 'Sulawesi Tengah', 'Indonesia'),
(29, 'Sulawesi Tenggara', 'Indonesia'),
(30, 'Sulawesi Utara', 'Indonesia'),
(31, 'Maluku', 'Indonesia'),
(32, 'Maluku Utara', 'Indonesia'),
(33, 'Papua Barat', 'Indonesia'),
(34, 'Papua', 'Indonesia');

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
(1, 'avatar311.png', 'Administrator', 'admin', '$2y$10$9RYtJdUQAdduDpy0kOpfOey5qdIp1tvB1WLDexgaWQ83Rez4ubxxe', 1),
(2, 'default.png', 'Andri Firman Saputra', 'andri975', '$2y$10$B8CG0imMpSNlopfeBKBGBOQPUALR/LCpacCb5cXaWY9IrRuYtEg4a', 3),
(3, 'default.png', 'Irgisan', 'irgi', '$2y$10$XDRvG7cys2jMQqTC87WxqOokOGrvpB.spSRhI7kPaTOUUEuQsFBaK', 3);

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
-- Indeks untuk tabel `jenis_paket`
--
ALTER TABLE `jenis_paket`
  ADD PRIMARY KEY (`id_jenis_paket`);

--
-- Indeks untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`),
  ADD KEY `id_provinsi` (`id_provinsi`),
  ADD KEY `id_provinsi_2` (`id_provinsi`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`),
  ADD KEY `id_kabupaten` (`id_kabupaten`);

--
-- Indeks untuk tabel `layanan_paket`
--
ALTER TABLE `layanan_paket`
  ADD PRIMARY KEY (`id_layanan_paket`),
  ADD KEY `id_jenis_paket` (`id_jenis_paket`),
  ADD KEY `id_kecamatan_tujuan` (`id_kecamatan_tujuan`),
  ADD KEY `id_kecamatan_asal` (`id_kecamatan_asal`),
  ADD KEY `id_jenis_layanan` (`id_jenis_layanan`);

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
  ADD PRIMARY KEY (`id_penerima`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

--
-- Indeks untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  ADD PRIMARY KEY (`id_pengirim`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

--
-- Indeks untuk tabel `pickup_barang`
--
ALTER TABLE `pickup_barang`
  ADD PRIMARY KEY (`id_pickup_barang`),
  ADD KEY `id_pengirim` (`id_pengirim`),
  ADD KEY `id_penerima` (`id_penerima`),
  ADD KEY `id_layanan` (`id_layanan_paket`);

--
-- Indeks untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id_provinsi`);

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
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jenis_layanan`
--
ALTER TABLE `jenis_layanan`
  MODIFY `id_jenis_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jenis_paket`
--
ALTER TABLE `jenis_paket`
  MODIFY `id_jenis_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id_kabupaten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=530;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `layanan_paket`
--
ALTER TABLE `layanan_paket`
  MODIFY `id_layanan_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;

--
-- AUTO_INCREMENT untuk tabel `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id_penerima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  MODIFY `id_pengirim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pickup_barang`
--
ALTER TABLE `pickup_barang`
  MODIFY `id_pickup_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id_provinsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD CONSTRAINT `kabupaten_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD CONSTRAINT `kecamatan_ibfk_1` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `layanan_paket`
--
ALTER TABLE `layanan_paket`
  ADD CONSTRAINT `layanan_paket_ibfk_1` FOREIGN KEY (`id_jenis_paket`) REFERENCES `jenis_paket` (`id_jenis_paket`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `layanan_paket_ibfk_2` FOREIGN KEY (`id_kecamatan_asal`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `layanan_paket_ibfk_3` FOREIGN KEY (`id_kecamatan_tujuan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `layanan_paket_ibfk_4` FOREIGN KEY (`id_jenis_layanan`) REFERENCES `jenis_layanan` (`id_jenis_layanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penerima`
--
ALTER TABLE `penerima`
  ADD CONSTRAINT `penerima_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  ADD CONSTRAINT `pengirim_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pickup_barang`
--
ALTER TABLE `pickup_barang`
  ADD CONSTRAINT `pickup_barang_ibfk_1` FOREIGN KEY (`id_layanan_paket`) REFERENCES `layanan_paket` (`id_layanan_paket`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pickup_barang_ibfk_2` FOREIGN KEY (`id_penerima`) REFERENCES `penerima` (`id_penerima`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pickup_barang_ibfk_3` FOREIGN KEY (`id_pengirim`) REFERENCES `pengirim` (`id_pengirim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
