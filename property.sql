-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2017 at 03:26 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `property`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `info_about`
--

CREATE TABLE `info_about` (
  `id` int(11) NOT NULL,
  `strategi` text NOT NULL,
  `visi` text NOT NULL,
  `tujuan` text NOT NULL,
  `misi` text NOT NULL,
  `profile` text NOT NULL,
  `email` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `facebook` varchar(225) NOT NULL,
  `twitter` varchar(225) NOT NULL,
  `instagram` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_about`
--

INSERT INTO `info_about` (`id`, `strategi`, `visi`, `tujuan`, `misi`, `profile`, `email`, `alamat`, `no_telp`, `facebook`, `twitter`, `instagram`) VALUES
(1, 'sdfg er', ' wertfge rte', ' werert', 'e fgergerfgwds', 'Perusahaan kami merupakan perusahan yang bergerak di bidang developer dan penjualan  properti rumah.', 'irwanto@gmail.com', 'Jl. Gatot subroto, Medan sumatera utara', '061-7723342', 'https://www.facebook.com', 'https://twitter.com', 'https://instagram.com');

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(150) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `umur` tinyint(4) NOT NULL,
  `alamat` text NOT NULL,
  `pekerjaan` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id`, `user_id`, `tanggal_input`, `nama`, `jenis_kelamin`, `umur`, `alamat`, `pekerjaan`) VALUES
(1, 3, '2017-09-22 13:37:20', 'Jumadi Sembiring', 'laki-laki', 48, 'Jl. Jamin Ginting Medan Sumatera Utara', 'Pegawai Negri Sipil ( PNS )'),
(3, 6, '2017-09-22 16:10:04', 'Rahmat', 'laki-laki', 36, 'Jl. Karya ujung, Medan Belawan', 'Mekanik Mobil Honda'),
(4, 6, '2017-09-22 16:12:42', 'Boris Hutagaol', 'laki-laki', 45, 'Jl. Manda By Pass, Medan Denai', 'Lawyer'),
(5, 7, '2017-09-23 00:23:37', 'Erna wati', 'perempuan', 45, 'Jl. Karya jaya Namorambe, Medan delitua', 'Guru PNS'),
(6, 7, '2017-09-23 00:26:38', 'Imelda sari nasution', 'perempuan', 36, 'Jl. Jamin Ginting no.122, Medan padan bulan', 'dr. Gigi');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `rumah_id` int(11) DEFAULT NULL,
  `pembeli_id` int(11) DEFAULT NULL,
  `blok_rumah` varchar(10) NOT NULL,
  `no_rumah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `tanggal_input`, `user_id`, `rumah_id`, `pembeli_id`, `blok_rumah`, `no_rumah`) VALUES
(1, '2017-09-22 13:37:21', 3, 2, 1, 'B', 12),
(3, '2017-09-22 16:10:04', 6, 3, 3, 'A', 6),
(4, '2017-09-22 16:12:42', 6, 6, 4, 'A', 12),
(5, '2017-09-23 00:23:37', 7, 1, 5, 'C', 3),
(6, '2017-09-23 00:26:38', 7, 7, 6, 'AA', 23);

-- --------------------------------------------------------

--
-- Table structure for table `rumah`
--

CREATE TABLE `rumah` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `lokasi` varchar(225) NOT NULL,
  `photo` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rumah`
--

INSERT INTO `rumah` (`id`, `nama`, `kategori_id`, `harga`, `lokasi`, `photo`) VALUES
(1, 'Cempaka Asri', 2, 120000000, 'Jl. sei mencirim Binjai', '7edf357874e5a8d1f871fc7c3bcc72066f7d4ade.jpg'),
(2, 'Mawar Asri', 2, 150000000, 'Jl. Kapten Muslim Medan, Sumatera Utara Indonesia', '6855a54dd8565b2b50b1caadd097e79f8851f6b8.jpg'),
(3, 'Perumahan Jati Kembar', 1, 145000000, 'Jl Helvetia Medan marelan, Sumatera Utara', '6715b4cbe2517d83f3e063d54d1366f0e076da2b.jpg'),
(4, 'Perumahan Elok Bintang', 1, 135000000, 'Jl. Marelan pasar 2 Medan, Sumatera Utara', '55fcfc830e2c617a14d604f1641c06176b67d634.jpg'),
(5, 'Perumahan  Bintang Kejora', 2, 175000000, 'Jl. Setia Budi, Medan Sumatera Utara', '760ee18d31d9eba9571b02f2a3cb0d8128d25f9f.jpg'),
(6, 'Griya Kenanga Indah', 8, 160000000, 'Jl. Tanjung Morawa', 'a7956b9296f680d2462348d63597af2e8e377439.jpg'),
(7, 'Teratai Permai Indah', 9, 220000000, 'Jl. Gaperta Medan Helvetia Sumatera Utara', '79218bf38d3c681020a43827b3d8176fab9c6202.jpg'),
(8, 'Perumahan Cendana Puri', 8, 165000000, 'Jl. Ring Road, Medan Sumatera utara', 'eec0a008dc03dfacad9bcd857f0e14026a1ec121.jpg'),
(9, 'Jati Emas Residance', 9, 175000000, 'Jl. Iskandar Muda, Medan Sumatera utara', '6cd2911a63c5002201592d060bb4f6acfc987880.jpg'),
(10, 'Kencana Emas Residance', 11, 320000000, 'Jl. Karya Jaya Medan Delitua Sumatera Utara', '26e046a9e23972fb26876b5ff95010be35fd4f03.png'),
(11, 'Perumahan Sinar Helvetia', 11, 235000000, 'Jl. Helvetia no 121, Medan Sumetara Utara', 'c378c53813b2c6cccae61ee3ab89a0b13e8280cf.jpg'),
(12, 'Perumahan Antares Medan', 12, 275000000, 'Jl. A.H Nasution, Medan Deli Tua Sumater Utara.', '26b965a642d6aea01276ba23f0d6925cf2abdff1.jpg'),
(13, 'Perumahan Kencana Puri', 12, 285000000, 'Jl. Gatot subroto km.10 Medan Sumatera utara', 'a0438c163e3bfcd09a7c9a7023c680fa76c18ef4.jpg'),
(14, 'Griya Cempaka Indah', 13, 375000000, 'Jl. Petisah Medan Sumatera Utara', '762fb7dd654c927c9d0abe6529b7a87b0aa94419.jpg'),
(15, 'Griya Asri Indah', 14, 450000000, 'Jl. Setia Budi Medan Selayang Sumatera utara', 'a9b3aaafc65d556684bcfa6961e97abb9f3755f8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rumah_blok`
--

CREATE TABLE `rumah_blok` (
  `id` int(11) NOT NULL,
  `rumah_id` int(11) NOT NULL,
  `blok` varchar(225) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rumah_blok`
--

INSERT INTO `rumah_blok` (`id`, `rumah_id`, `blok`, `jumlah`) VALUES
(22, 3, 'A', 25),
(23, 3, 'B', 30),
(24, 6, 'A', 20),
(25, 6, 'B', 20),
(26, 6, 'C', 20),
(27, 6, 'D', 20),
(28, 1, 'A', 10),
(29, 1, 'B', 10),
(30, 1, 'C', 5),
(31, 7, 'AA', 25),
(32, 7, 'BB', 25),
(36, 2, 'C', 15),
(37, 2, 'B', 15),
(38, 2, 'A', 15),
(39, 4, 'AB', 20),
(40, 5, 'AA', 25),
(41, 5, 'AB', 25),
(42, 8, 'AAA', 15),
(43, 8, 'BBB', 15),
(44, 9, 'A', 20),
(45, 9, 'B', 20),
(46, 9, 'C', 25),
(49, 11, 'BB', 18),
(50, 11, 'CC', 18),
(51, 12, 'AA', 15),
(52, 12, 'BB', 15),
(53, 13, 'AA', 15),
(54, 13, 'AB', 15),
(55, 13, 'AC', 15),
(60, 15, 'AA', 16),
(61, 15, 'BB', 16),
(62, 14, 'A', 15),
(63, 14, 'B', 15),
(64, 10, 'AB', 18),
(65, 10, 'AC', 18);

-- --------------------------------------------------------

--
-- Table structure for table `rumah_kategori`
--

CREATE TABLE `rumah_kategori` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `luas` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rumah_kategori`
--

INSERT INTO `rumah_kategori` (`id`, `type`, `luas`, `description`) VALUES
(1, '21', '6m x 3,5m = 21 m2', 'Rumah tipe 21 atau tipe rumah 21 yaitu rumah yang dibangun diatas lahan dengan total luas bangunan mencapai 21m2. Terdiri dari 1 ruang tamu (*dapur), 1 ruang tidur dan 1 kamar mandi ukuran rumah ini sangat lah minimalis dan simple'),
(2, '21/60', '6m x 10m = 60mÂ²', 'Rumah Tipe 21/60 adalah tipe rumah dengan luas bangunan 21 mÂ², rumah dengan ukuran 6m x 3,5m. Ukuran tanah pada rumah tipe 21 dipadukan dengan ukuran luas tanah 6m x 10m = 60 mÂ². Terdiri dari 1 ruang tamu (*dapur), 1 ruang tidur dan 1 kamar mandi ukuran rumah ini sangat lah minimalis dan simple'),
(7, '21/72', '6m x 12m = 72mÂ²', 'Rumah Tipe 21/72 adalah tipe rumah dengan luas bangunan 21 mÂ², rumah dengan ukuran 6m x 3,5m. Ukuran tanah pada rumah tipe 21 dipadukan dengan ukuran luas tanah 6m x 12m = 72 mÂ² .'),
(8, '36', '6m x 6m = 36m2', 'Rumah Tipe 36 yaitu tipe rumah perumahan dengan luas bangunan 36 m2, rumah dengan ukuran 6 meter x 6 meter = 36 m2. Terdiri dari 2 ruang tidur, ruang keluarga/ruang tamu, 1 kamar mandi, dan dapur.'),
(9, '36/60', '6m x 10m = 60mÂ²', 'Rumah Tipe 36 yaitu tipe rumah perumahan dengan luas bangunan 36 m2, rumah dengan ukuran 6 meter x 6 meter = 36 m2, luas lahan pada rumah tipe 36 ini dipadukan dengan ukuran luas tanah 60 m2 sehingga disebut rumah tipe 36/60. Terdiri dari 2 ruang tidur, ruang keluarga/ruang tamu, 1 kamar mandi, dan dapur.'),
(10, '36/72', '6m x 12m = 72mÂ²', 'Rumah Tipe 36 yaitu tipe rumah perumahan dengan luas bangunan 36 m2, rumah dengan ukuran 6 meter x 6 meter = 36 m2, luas lahan pada rumah tipe 36 ini dipadukan dengan ukuran luas tanah 72 m2 sehingga disebut rumah tipe 36/72. Terdiri dari 2 ruang tidur, ruang keluarga/ruang tamu, 1 kamar mandi, dan dapur.'),
(11, '45', '6m x 7,5 m = 45m2', 'Rumah tipe 45 adalah tipe rumah  perumahan dengan  luas bangunan  45 m2 dengan ukuran rumah 6m x 7,5 m = 45m2. Mempunyai 2 kamar tidur, 1 ruang tamu, ruang keluarga, dapur, 1 kamar mandi, garasi atau teras rumah yang cukup luas.'),
(12, '45/96', '8m x 12m = 96 mÂ²', 'Rumah tipe 45/96 adalah tipe rumah perumahan dengan luas bangunan 45 m2  dengan ukuran rumah 6m x 7,5 m = 45m2. Dengan luas tanah 8m x 12m = 96 mÂ². Mempunyai 2 kamar tidur, 1 ruang tamu, ruang keluarga, dapur, 1 kamar mandi, garasi atau teras rumah yang cukup luas.'),
(13, '60', '6m x 10m = 60 m2', 'Rumah tipe 60 memiliki  ukuran bangunan 6 m x 10 m = 60 m2 sehingga disebut rumah tipe 60, rumah ini sudah cukup luas dan berkelas mewah diperumahan namun masih dengan harga yang terjangkau.'),
(14, '70', '10m x 7m =70m2', 'rumah tipe 70 adalah tipe rumah dengan luas bangunan sebesar 70m2. dan memiliki luas 70 meter kuadrat , maka bisa 10m x 7m , dan seterusnya.'),
(15, '70/120', '10m x 12m = 120m2', 'Rumah tipe 70/120 adalah tipe rumah dengan luas bangunan sebesar 120m2. dan memiliki luas 120 meter kuadrat , maka bisa 10m x 12m.'),
(16, '70/150', '10m x 15m = 150m2', 'Rumah tipe 70/150 adalah tipe rumah dengan luas bangunan sebesar 150m2. dan memiliki luas 150 meter kuadrat , maka bisa 10m x 15m.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `photo` varchar(225) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `photo`, `role`) VALUES
(1, 'Robert Ngatijo', 'robert@gmail.com', '684c851af59965b680086b7b4896ff98', '5548809725daa2fc9a5556b0d31648f86bc6d382.jpg', 'super_admin'),
(3, 'Irwanto', 'irwanto@gmail.com', 'df8a0de892c54e2fc414461502be051f', 'a43e8a5bbd28bb3058aebb4dd8ca9e745727f819.jpg', 'super_admin'),
(4, 'Bambang tut', 'bambang@gmail.com', 'a9711cbb2e3c2d5fc97a63e45bbe5076', '', 'super_admin'),
(5, 'Nanang', 'nanang@gmail.com', 'cc8839950896aa17b3224887089241ba', '93acd9d2bb8cb93f260fc1819923fc22893f7cc5.png', 'admin'),
(6, 'Herman', 'herman@gmail.com', 'a1a6907c989946085b0e35493786fce3', 'd10153f353c7c78b8306f73dc57a35ea02e86496.png', 'admin'),
(7, 'Rizal', 'rizal@gmail.com', '150fb021c56c33f82eef99253eb36ee1', '99bc480b2d3d024bdedd5f25167d86f7368c1283.jpg', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_about`
--
ALTER TABLE `info_about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `rumah_id` (`rumah_id`),
  ADD KEY `pembeli_id` (`pembeli_id`);

--
-- Indexes for table `rumah`
--
ALTER TABLE `rumah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `rumah_blok`
--
ALTER TABLE `rumah_blok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rumah_id` (`rumah_id`);

--
-- Indexes for table `rumah_kategori`
--
ALTER TABLE `rumah_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `info_about`
--
ALTER TABLE `info_about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rumah`
--
ALTER TABLE `rumah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `rumah_blok`
--
ALTER TABLE `rumah_blok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `rumah_kategori`
--
ALTER TABLE `rumah_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD CONSTRAINT `pembeli_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_ibfk_3` FOREIGN KEY (`pembeli_id`) REFERENCES `pembeli` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_ibfk_4` FOREIGN KEY (`rumah_id`) REFERENCES `rumah` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `rumah`
--
ALTER TABLE `rumah`
  ADD CONSTRAINT `rumah_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `rumah_kategori` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `rumah_blok`
--
ALTER TABLE `rumah_blok`
  ADD CONSTRAINT `rumah_blok_ibfk_1` FOREIGN KEY (`rumah_id`) REFERENCES `rumah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
