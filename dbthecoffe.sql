-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 06, 2024 at 10:21 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbthecoffe`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bayar`
--

CREATE TABLE `tb_bayar` (
  `id_bayar` bigint NOT NULL,
  `nominal_uang` bigint NOT NULL,
  `total_bayar` bigint NOT NULL,
  `waktu_bayar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_bayar`
--

INSERT INTO `tb_bayar` (`id_bayar`, `nominal_uang`, `total_bayar`, `waktu_bayar`) VALUES
(24070702537, 100000, 95000, '2024-07-06 19:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_daftar_menu`
--

CREATE TABLE `tb_daftar_menu` (
  `id` int NOT NULL,
  `foto_menu` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_menu` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` int NOT NULL,
  `harga_menu` int NOT NULL,
  `stok_menu` int NOT NULL,
  `keterangan_menu` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_daftar_menu`
--

INSERT INTO `tb_daftar_menu` (`id`, `foto_menu`, `nama_menu`, `kategori`, `harga_menu`, `stok_menu`, `keterangan_menu`) VALUES
(49, '30030-kentang.jpg', 'Kentang Goreng', 17, 15000, 41, ''),
(50, '70745-ayam.jpg', 'Nasi Ayam Mentega', 1, 25000, 25, ''),
(51, '23859-americano.jpg', 'Americano', 4, 25000, 25, ''),
(52, '15954-ayamkari.jpg', 'Kari Ayam', 8, 25000, 41, ''),
(53, '79977-cheesecake.jpg', 'Cheesecake ', 2, 25000, 51, ''),
(54, '36264-croissant.jpg', 'Croissant ', 2, 15000, 41, ''),
(55, '47819-esbuah.jpg', 'Es Buah', 8, 25000, 51, ''),
(56, '75212-eskuwut.jpg', 'Es Kuwut Bali', 8, 25000, 38, ''),
(57, '49871-esteh.jpg', 'Es Teh', 14, 7000, 40, ''),
(58, '40980-expresso.jpg', 'Espresso ', 4, 20000, 21, ''),
(59, '58332-karisapi.jpg', 'Sapi Lada Hitam', 8, 30000, 24, ''),
(60, '98503-lemontea.jpg', 'Lemon Tea', 14, 15000, 32, ''),
(61, '74526-majito.jpg', 'Mojito ', 13, 20000, 53, ''),
(62, '15606-matcha.jpg', 'Matcha Latte', 14, 20000, 37, ''),
(63, '92528-milo.jpg', 'Milo', 18, 15000, 35, ''),
(64, '79648-nasgor.jpg', 'Nasi Goreng Seafood', 1, 30000, 63, ''),
(65, '59857-pisangcoklatkeju.jpg', 'Pisang Cokelat Keju', 2, 15000, 53, ''),
(66, '88216-strawberryshortcake.jpg', 'Strawberry Shortcake', 2, 25000, 68, ''),
(67, '11357-churros.jpg', 'Churros ', 2, 15000, 61, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_menu`
--

CREATE TABLE `tb_kategori_menu` (
  `id_kat` int NOT NULL,
  `jenis_menu` int NOT NULL,
  `kategori_menu` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kategori_menu`
--

INSERT INTO `tb_kategori_menu` (`id_kat`, `jenis_menu`, `kategori_menu`) VALUES
(1, 1, 'Nasi'),
(2, 1, 'Snack'),
(4, 2, 'Kopi'),
(8, 1, 'Traditional Food'),
(13, 2, 'Juice'),
(14, 2, 'Teh'),
(17, 1, 'Makanan Ringan'),
(18, 2, 'Minuman Lain');

-- --------------------------------------------------------

--
-- Table structure for table `tb_list_order`
--

CREATE TABLE `tb_list_order` (
  `id_list_order` int NOT NULL,
  `menu` int NOT NULL,
  `kode_order` bigint NOT NULL,
  `jumlah` int NOT NULL,
  `catatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_list_order`
--

INSERT INTO `tb_list_order` (`id_list_order`, `menu`, `kode_order`, `jumlah`, `catatan`, `status`) VALUES
(22, 52, 24070702537, 2, '', NULL),
(23, 63, 24070702537, 3, '1 tidak pakai es', NULL),
(24, 49, 24070612286, 7, '', NULL),
(25, 57, 24070612286, 7, '', NULL),
(26, 54, 24070612286, 7, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` bigint NOT NULL,
  `pelanggan` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `meja` int NOT NULL,
  `pelayan` int NOT NULL,
  `waktu_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `pelanggan`, `meja`, `pelayan`, `waktu_order`) VALUES
(24062715204, 'Hisan Fairuzi', 2, 1, '2024-06-27 09:25:21'),
(24070103373, 'Agus Lapar Bu', 2, 26, '2024-06-30 20:38:30'),
(24070320328, 'Jhin', 4, 26, '2024-07-03 13:32:31'),
(24070612286, 'Ronaldo SUI', 7, 26, '2024-07-06 20:29:30'),
(24070702537, 'Luthfi Game Idaman', 69, 26, '2024-07-06 19:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int NOT NULL,
  `nama` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `level` int NOT NULL,
  `nohp` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `level`, `nohp`, `alamat`) VALUES
(1, 'Husni Aripin', 'husni@gmail.com', '4297f44b13955235245b2497399d7a93', 1, '082127892622', 'Cipunagara'),
(24, 'Faisal Sidik', 'faisal@gmail.com', '4297f44b13955235245b2497399d7a93', 2, '082127892613', 'jabong'),
(26, 'Bagus Nurlana', 'bagus@gmail.com', 'cc25da2aae1af78170f58692b36fefba', 1, '085315375086', 'Tegal Kalapa'),
(27, 'Wisnu Saputra', 'wisnu@gmail.com', '4297f44b13955235245b2497399d7a93', 4, '082127892124', 'Pagaden'),
(28, 'Ari Faturrahman', 'ari@gmail.com', '4297f44b13955235245b2497399d7a93', 2, '082127892125', 'Ciasem'),
(29, 'Marselina Nur Azzahra', 'marselina@gmail.com', '4297f44b13955235245b2497399d7a93', 3, '082127892123', 'JalanCagak');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `tb_daftar_menu`
--
ALTER TABLE `tb_daftar_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_menu` (`kategori`);

--
-- Indexes for table `tb_kategori_menu`
--
ALTER TABLE `tb_kategori_menu`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indexes for table `tb_list_order`
--
ALTER TABLE `tb_list_order`
  ADD PRIMARY KEY (`id_list_order`),
  ADD KEY `menu` (`menu`),
  ADD KEY `order` (`kode_order`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `pelayan` (`pelayan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_daftar_menu`
--
ALTER TABLE `tb_daftar_menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tb_kategori_menu`
--
ALTER TABLE `tb_kategori_menu`
  MODIFY `id_kat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_list_order`
--
ALTER TABLE `tb_list_order`
  MODIFY `id_list_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_daftar_menu`
--
ALTER TABLE `tb_daftar_menu`
  ADD CONSTRAINT `tb_daftar_menu_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `tb_kategori_menu` (`id_kat`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_list_order`
--
ALTER TABLE `tb_list_order`
  ADD CONSTRAINT `tb_list_order_ibfk_2` FOREIGN KEY (`menu`) REFERENCES `tb_daftar_menu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_list_order_ibfk_3` FOREIGN KEY (`kode_order`) REFERENCES `tb_order` (`id_order`) ON DELETE CASCADE;

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `tb_order_ibfk_1` FOREIGN KEY (`pelayan`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
