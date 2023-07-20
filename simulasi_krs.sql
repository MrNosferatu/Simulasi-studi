-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2023 at 05:10 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simulasi_krs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(16) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `no_telpon` varchar(13) DEFAULT NULL,
  `jabatan` varchar(128) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `no_telpon`, `jabatan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'asdas@dms.com', '$2y$10$6zHMbNcHphPGySAVq6FhIelhdDO2s.tpQi8u.TATi0uejDJDA9EH.', NULL, NULL, NULL, NULL, NULL),
(4, 'admin', 'admisn@email.com', '$2y$10$6zHMbNcHphPGySAVq6FhIelhdDO2s.tpQi8u.TATi0uejDJDA9EH.', NULL, NULL, NULL, NULL, NULL),
(6, 'admin', 'admin@email.com', '$2y$10$iwzvqADMZ3fmtZikufPjZeR6yoK5kKdhSspUpogUhcmF02srYOtBS', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konsentrasi`
--

CREATE TABLE `konsentrasi` (
  `kode_konsentrasi` int(3) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `sks_minimal` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsentrasi`
--

INSERT INTO `konsentrasi` (`kode_konsentrasi`, `nama`, `sks_minimal`) VALUES
(1, 'Web Development', 24),
(2, 'Animasi 2D', 42),
(3, 'Networking', 45);

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `kode_matakuliah` int(3) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `sks` int(1) NOT NULL,
  `sifat` int(1) NOT NULL,
  `nilai_minimal` varchar(1) NOT NULL,
  `semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`kode_matakuliah`, `nama`, `sks`, `sifat`, `nilai_minimal`, `semester`) VALUES
(2, 'Etika Profesi', 2, 1, 'E', 1),
(3, 'Lingkungan Bisnis', 2, 1, 'E', 2),
(4, 'Pendidikan Pancasila', 2, 1, 'C', 1),
(5, 'Kewirausahaan', 2, 1, 'E', 1),
(6, 'Ekonomi Kreatif', 2, 1, 'E', 1),
(8, 'Logika Informatika', 2, 1, 'E', 1),
(9, 'Sistem Operasi', 4, 1, 'E', 1),
(10, 'Pengantar IT & Instalasi-Komputer', 2, 1, 'E', 1),
(11, 'Pendidikan Kewarganegaraan', 2, 1, 'C', 1),
(12, 'Lingkungan Bisnis', 2, 1, 'E', 2),
(13, 'Bahasa Inggris II', 2, 1, 'E', 2),
(14, 'Desain Grafis', 4, 1, 'E', 2),
(15, 'Algoritma dan Pemrograman', 4, 1, 'E', 2),
(16, 'Perancangan Web I', 4, 1, 'E', 2),
(17, 'Jaringan Komputer I', 4, 1, 'E', 2),
(18, 'Success Skill', 2, 1, 'E', 3),
(19, 'Bahasa Indonesia', 2, 1, 'C', 3),
(20, 'Metodologi Penelitian', 2, 1, 'E', 3),
(21, 'Struktur Data', 4, 1, 'E', 3),
(22, 'Multimedia', 2, 1, 'E', 3),
(23, 'E-Commerce', 4, 1, 'E', 3),
(24, 'Perancangan Web II', 4, 1, 'E', 3),
(25, 'Pengolahan Basis Data', 4, 1, 'E', 3),
(26, 'Jaringan Komputer II', 4, 1, 'E', 3),
(27, 'Pengantar Film Animasi 2D', 2, 1, 'E', 3),
(28, 'Storyboard dan Animatic', 4, 1, 'E', 3),
(29, 'Teknik Anatomi Dasar', 4, 1, 'E', 3),
(30, 'Motion Grafik', 2, 1, 'E', 3),
(31, 'Animasi Dasar', 4, 1, 'E', 3),
(32, 'User Interface/Experience', 2, 1, 'E', 4),
(33, 'Pemasaran Digital', 4, 1, 'E', 4),
(34, 'Bisnis Digital', 2, 1, 'E', 4),
(35, 'Hybrid Web Development', 4, 1, 'E', 4),
(36, 'Keamanan Web', 2, 1, 'E', 4),
(37, 'Development Framework', 4, 1, 'E', 4),
(38, 'Pemrograman Web Lanjut', 4, 1, 'E', 4),
(39, 'Nirkabel & Manajemen Jaringan', 4, 1, 'E', 4),
(40, 'OS Server & Sys Admin', 4, 1, 'E', 4),
(41, 'Komputasi Awan', 4, 1, 'E', 4),
(42, 'Jaringan Komputer III', 4, 1, 'E', 4),
(43, 'Keamanan Jaringan', 4, 1, 'E', 4),
(44, 'Windows Server', 2, 1, 'E', 4),
(45, 'Manajemen Proyek IT', 2, 1, 'E', 4),
(46, 'Background', 2, 1, 'E', 4),
(47, 'Concept Art', 4, 1, 'E', 4),
(48, 'Animasi 3D', 4, 1, 'E', 4),
(49, 'Screen Writing dan Sinematografi', 4, 1, 'E', 4),
(50, 'Digital Painting', 2, 1, 'E', 4),
(51, 'Compositing dan Editing', 2, 1, 'E', 4),
(52, 'Teknik Anatomi Lanjut', 4, 1, 'E', 4),
(53, 'Animasi Lanjut', 2, 1, 'E', 4),
(54, 'Manajemen Strategik', 2, 2, 'E', 5),
(55, 'Komunikasi dan Negoisasi', 2, 2, 'E', 5),
(56, 'Kepemimpinan', 2, 2, 'E', 5),
(57, 'Bahasa Inggris III', 2, 2, 'E', 5),
(58, 'Pemrograman Python', 4, 2, 'E', 5),
(59, 'Proyek Pemrograman Seluler', 4, 2, 'E', 5),
(60, 'Kerja Praktek Magang', 8, 2, 'E', 5),
(61, 'Tugas Akhir', 4, 1, 'C', 6),
(77, 'MPIT', 2, 1, 'B', 2);

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah_konsentrasi`
--

CREATE TABLE `matakuliah_konsentrasi` (
  `id` int(11) NOT NULL,
  `kode_matakuliah` int(3) NOT NULL,
  `kode_konsentrasi` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matakuliah_konsentrasi`
--

INSERT INTO `matakuliah_konsentrasi` (`id`, `kode_matakuliah`, `kode_konsentrasi`) VALUES
(3, 21, 1),
(4, 23, 1),
(5, 24, 1),
(6, 25, 1),
(7, 32, 1),
(8, 33, 1),
(9, 34, 1),
(10, 35, 1),
(11, 36, 1),
(12, 37, 1),
(13, 38, 1),
(19, 48, 2),
(20, 27, 2),
(22, 29, 2),
(25, 46, 2),
(28, 49, 2),
(30, 51, 2),
(31, 52, 2),
(35, 28, 2),
(37, 30, 2),
(38, 31, 2),
(40, 47, 2),
(43, 50, 2),
(46, 53, 2),
(47, 21, 3),
(48, 24, 3),
(49, 25, 3),
(50, 26, 3),
(51, 39, 3),
(52, 40, 3),
(53, 41, 3),
(54, 42, 3),
(55, 43, 3),
(56, 44, 3),
(95, 45, 1),
(96, 45, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `konsentrasi`
--
ALTER TABLE `konsentrasi`
  ADD PRIMARY KEY (`kode_konsentrasi`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`kode_matakuliah`);

--
-- Indexes for table `matakuliah_konsentrasi`
--
ALTER TABLE `matakuliah_konsentrasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_konsentrasi` (`kode_konsentrasi`),
  ADD KEY `kode_matakuliah` (`kode_matakuliah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `konsentrasi`
--
ALTER TABLE `konsentrasi`
  MODIFY `kode_konsentrasi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `kode_matakuliah` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `matakuliah_konsentrasi`
--
ALTER TABLE `matakuliah_konsentrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matakuliah_konsentrasi`
--
ALTER TABLE `matakuliah_konsentrasi`
  ADD CONSTRAINT `matakuliah_konsentrasi_ibfk_1` FOREIGN KEY (`kode_konsentrasi`) REFERENCES `konsentrasi` (`kode_konsentrasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matakuliah_konsentrasi_ibfk_2` FOREIGN KEY (`kode_matakuliah`) REFERENCES `matakuliah` (`kode_matakuliah`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
