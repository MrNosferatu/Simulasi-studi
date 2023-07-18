-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2023 at 05:37 AM
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
-- Database: `study_sim`
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
(1, 'admin', 'asdas@dms.com', '12345678', NULL, NULL, NULL, NULL, NULL),
(2, 'admin', 'admin@email.com', '$2y$10$k6ptxBdTrBD9kwQ1a7UR1uzFEG7YcSvRBbvWrRvd7Cdnpv2eGLRfS', NULL, NULL, NULL, NULL, NULL),
(4, 'admin', 'admisn@email.com', '$2y$10$6zHMbNcHphPGySAVq6FhIelhdDO2s.tpQi8u.TATi0uejDJDA9EH.', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `kode_fakultas` int(3) NOT NULL,
  `nama` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`kode_fakultas`, `nama`) VALUES
(3, 'FAKULTAS EKONOMI DAN SOSIAL'),
(4, 'FAKULTAS SAINS DAN TEKNOLOGI'),
(5, 'FAKULTAS ILMU KOMPUTER');

-- --------------------------------------------------------

--
-- Table structure for table `konsentrasi`
--

CREATE TABLE `konsentrasi` (
  `kode_konsentrasi` int(3) NOT NULL,
  `kode_prodi` int(3) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `sks_minimal` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsentrasi`
--

INSERT INTO `konsentrasi` (`kode_konsentrasi`, `kode_prodi`, `nama`, `sks_minimal`) VALUES
(1, 1, 'Web Development', 24),
(2, 1, 'Animasi 2D', 42),
(3, 1, 'Networking', 45);

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `kode_prodi` int(3) NOT NULL,
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

INSERT INTO `matakuliah` (`kode_prodi`, `kode_matakuliah`, `nama`, `sks`, `sifat`, `nilai_minimal`, `semester`) VALUES
(1, 2, 'Etika Profesi', 2, 1, 'E', 1),
(1, 3, 'Lingkungan Bisnis', 2, 1, 'E', 2),
(1, 4, 'Pendidikan Pancasila', 2, 1, 'C', 1),
(1, 5, 'Kewirausahaan', 2, 1, 'E', 1),
(1, 6, 'Ekonomi Kreatif', 2, 1, 'E', 1),
(1, 7, 'Fotografi', 2, 1, 'E', 1),
(1, 8, 'Logika Informatika', 2, 1, 'E', 1),
(1, 9, 'Sistem Operasi', 4, 1, 'E', 1),
(1, 10, 'Pengantar IT & Instalasi-Komputer', 2, 1, 'E', 1),
(1, 11, 'Pendidikan Kewarganegaraan', 2, 1, 'C', 1),
(1, 12, 'Lingkungan Bisnis', 2, 1, 'E', 2),
(1, 13, 'Bahasa Inggris II', 2, 1, 'E', 2),
(1, 14, 'Desain Grafis', 4, 1, 'E', 2),
(1, 15, 'Algoritma dan Pemrograman', 4, 1, 'E', 2),
(1, 16, 'Perancangan Web I', 4, 1, 'E', 2),
(1, 17, 'Jaringan Komputer I', 4, 1, 'E', 2),
(1, 18, 'Success Skill', 2, 1, 'E', 3),
(1, 19, 'Bahasa Indonesia', 2, 1, 'C', 3),
(1, 20, 'Metodologi Penelitian', 2, 1, 'E', 3),
(1, 21, 'Struktur Data', 4, 1, 'E', 3),
(1, 22, 'Multimedia', 2, 1, 'E', 3),
(1, 23, 'E-Commerce', 4, 1, 'E', 3),
(1, 24, 'Perancangan Web II', 4, 1, 'E', 3),
(1, 25, 'Pengolahan Basis Data', 4, 1, 'E', 3),
(1, 26, 'Jaringan Komputer II', 4, 1, 'E', 3),
(1, 27, 'Pengantar Film Animasi 2D', 2, 1, 'E', 3),
(1, 28, 'Storyboard dan Animatic', 4, 1, 'E', 3),
(1, 29, 'Teknik Anatomi Dasar', 4, 1, 'E', 3),
(1, 30, 'Motion Grafik', 2, 1, 'E', 3),
(1, 31, 'Animasi Dasar', 4, 1, 'E', 3),
(1, 32, 'User Interface/Experience', 2, 1, 'E', 4),
(1, 33, 'Pemasaran Digital', 4, 1, 'E', 4),
(1, 34, 'Bisnis Digital', 2, 1, 'E', 4),
(1, 35, 'Hybrid Web Development', 4, 1, 'E', 4),
(1, 36, 'Keamanan Web', 2, 1, 'E', 4),
(1, 37, 'Development Framework', 4, 1, 'E', 4),
(1, 38, 'Pemrograman Web Lanjut', 4, 1, 'E', 4),
(1, 39, 'Nirkabel & Manajemen Jaringan', 4, 1, 'E', 4),
(1, 40, 'OS Server & Sys Admin', 4, 1, 'E', 4),
(1, 41, 'Komputasi Awan', 4, 1, 'E', 4),
(1, 42, 'Jaringan Komputer III', 4, 1, 'E', 4),
(1, 43, 'Keamanan Jaringan', 4, 1, 'E', 4),
(1, 44, 'Windows Server', 2, 1, 'E', 4),
(1, 45, 'Manajemen Proyek IT', 2, 1, 'E', 4),
(1, 46, 'Background', 2, 1, 'E', 4),
(1, 47, 'Concept Art', 4, 1, 'E', 4),
(1, 48, 'Animasi 3D', 4, 1, 'E', 4),
(1, 49, 'Screen Writing dan Sinematografi', 4, 1, 'E', 4),
(1, 50, 'Digital Painting', 2, 1, 'E', 4),
(1, 51, 'Compositing dan Editing', 2, 1, 'E', 4),
(1, 52, 'Teknik Anatomi Lanjut', 4, 1, 'E', 4),
(1, 53, 'Animasi Lanjut', 2, 1, 'E', 4),
(1, 54, 'Manajemen Strategik', 2, 2, 'E', 5),
(1, 55, 'Komunikasi dan Negoisasi', 2, 2, 'E', 5),
(1, 56, 'Kepemimpinan', 2, 2, 'E', 5),
(1, 57, 'Bahasa Inggris III', 2, 2, 'E', 5),
(1, 58, 'Pemrograman Python', 4, 2, 'E', 5),
(1, 59, 'Proyek Pemrograman Seluler', 4, 2, 'E', 5),
(1, 60, 'Kerja Praktek Magang', 8, 2, 'E', 5),
(1, 61, 'Tugas Akhir', 4, 1, 'C', 6),
(1, 62, 'Test', 2, 1, 'E', 1),
(1, 63, 'Hacking Lanjut', 2, 1, 'B', 1);

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
(14, 45, 1),
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
(57, 45, 3);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `kode_fakultas` int(3) NOT NULL,
  `kode_prodi` int(3) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `sks_minimal` int(3) NOT NULL,
  `nilai_d_maksimal` int(3) NOT NULL,
  `ipk_minimal` varchar(4) NOT NULL,
  `semester_konsentrasi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`kode_fakultas`, `kode_prodi`, `nama`, `sks_minimal`, `nilai_d_maksimal`, `ipk_minimal`, `semester_konsentrasi`) VALUES
(5, 1, 'D3 Teknik Informatika', 108, 25, '2', 3),
(5, 2, 'D3 Manajemen Informatika', 108, 25, '2', 3),
(5, 4, 'Teknik Komputer', 144, 25, '4', 3),
(3, 6, 'D3 Teknik Jaringan', 108, 25, '', 0);

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
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`kode_fakultas`);

--
-- Indexes for table `konsentrasi`
--
ALTER TABLE `konsentrasi`
  ADD PRIMARY KEY (`kode_konsentrasi`),
  ADD KEY `kode_prodi` (`kode_prodi`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`kode_matakuliah`),
  ADD KEY `kode_prodi` (`kode_prodi`);

--
-- Indexes for table `matakuliah_konsentrasi`
--
ALTER TABLE `matakuliah_konsentrasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_konsentrasi` (`kode_konsentrasi`),
  ADD KEY `kode_matakuliah` (`kode_matakuliah`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`kode_prodi`),
  ADD KEY `kode_fakultas` (`kode_fakultas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `kode_fakultas` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `konsentrasi`
--
ALTER TABLE `konsentrasi`
  MODIFY `kode_konsentrasi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `kode_matakuliah` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `matakuliah_konsentrasi`
--
ALTER TABLE `matakuliah_konsentrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `kode_prodi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `konsentrasi`
--
ALTER TABLE `konsentrasi`
  ADD CONSTRAINT `konsentrasi_ibfk_1` FOREIGN KEY (`kode_prodi`) REFERENCES `prodi` (`kode_prodi`);

--
-- Constraints for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD CONSTRAINT `matakuliah_ibfk_1` FOREIGN KEY (`kode_prodi`) REFERENCES `prodi` (`kode_prodi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matakuliah_konsentrasi`
--
ALTER TABLE `matakuliah_konsentrasi`
  ADD CONSTRAINT `matakuliah_konsentrasi_ibfk_1` FOREIGN KEY (`kode_konsentrasi`) REFERENCES `konsentrasi` (`kode_konsentrasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matakuliah_konsentrasi_ibfk_2` FOREIGN KEY (`kode_matakuliah`) REFERENCES `matakuliah` (`kode_matakuliah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `prodi_ibfk_1` FOREIGN KEY (`kode_fakultas`) REFERENCES `fakultas` (`kode_fakultas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
