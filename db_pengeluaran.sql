-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2026 at 04:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pengeluaran`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggaran`
--

CREATE TABLE `anggaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `bulan` char(7) NOT NULL,
  `batas` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggaran`
--

INSERT INTO `anggaran` (`id`, `bulan`, `batas`) VALUES
(1, '2026-11', 500000),
(2, '2026-12', 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `nominal` int(10) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `tanggal`, `kategori`, `keterangan`, `nominal`, `created_at`, `updated_at`) VALUES
(1, '2026-11-01', 'Makanan', 'Makan siang warteg', 15000, '2026-11-12 08:28:14', '2026-11-12 08:28:14'),
(2, '2026-11-02', 'Transportasi', 'Bensin motor', 30000, '2026-11-12 08:28:14', '2026-11-12 08:28:14'),
(3, '2026-11-03', 'Pendidikan', 'Fotokopi modul kuliah', 12000, '2026-11-12 08:28:14', '2026-11-12 08:28:14'),
(4, '2026-11-04', 'Makanan', 'Makan malam nasi goreng', 18000, '2026-11-12 08:28:14', '2026-11-12 08:28:14'),
(5, '2026-11-05', 'Hiburan', 'Nonton film bareng teman', 45000, '2026-11-12 08:28:14', '2026-11-12 08:28:14'),
(6, '2026-11-06', 'Kesehatan', 'Beli vitamin', 25000, '2026-11-12 08:28:14', '2026-11-12 08:28:14'),
(7, '2026-11-08', 'Makanan', 'Belanja bulanan di minimarket', 120000, '2026-11-12 08:28:14', '2026-11-12 08:28:14'),
(8, '2026-11-09', 'Pendidikan', 'Beli buku referensi', 85000, '2026-11-12 08:28:14', '2026-11-12 08:28:14'),
(9, '2026-11-10', 'Transportasi', 'Ojek online ke kampus', 22000, '2026-11-12 08:28:14', '2026-11-12 08:28:14'),
(10, '2026-11-11', 'Lainnya', 'Iuran kas kelas', 10000, '2026-11-12 08:28:14', '2026-11-12 08:28:14'),
(11, '2026-10-20', 'Makanan', 'Makan siang kantin', 17000, '2026-11-12 08:28:14', '2026-11-12 08:28:14'),
(12, '2026-10-25', 'Hiburan', 'Langganan musik', 30000, '2026-11-12 08:28:14', '2026-11-12 08:28:14'),
(13, '2026-11-12', 'Makanan', 'nasi geprek', 10000, '2026-11-12 03:38:24', '2026-11-12 03:38:24'),
(14, '2026-11-12', 'Hiburan', 'baju', 108000, '2026-11-12 03:50:25', '2026-11-12 03:50:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggaran`
--
ALTER TABLE `anggaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bulan` (`bulan`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggaran`
--
ALTER TABLE `anggaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
