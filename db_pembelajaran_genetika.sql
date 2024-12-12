-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 12, 2024 at 09:18 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pembelajaran_genetika`
--

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `judul`, `isi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Persilangan Dihibrida', 'Persilangan dihibrida adalah persilangan dengan melibatkan dua sifat beda. Contoh: bentuk dan warna pada kacang kapri...', NULL, '2024-12-12 11:40:06', '2024-12-12 11:40:06'),
(2, 'Hukum Mendel', 'Hukum Mendel menjelaskan tentang pewarisan sifat dari induk kepada keturunannya...', NULL, '2024-12-12 11:40:06', '2024-12-12 11:40:06');

-- --------------------------------------------------------

--
-- Table structure for table `minigame_progress`
--

CREATE TABLE `minigame_progress` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `level` int NOT NULL DEFAULT '1',
  `skor` int NOT NULL DEFAULT '0',
  `status` varchar(20) DEFAULT 'belum_selesai',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `jenis_tes` varchar(50) NOT NULL,
  `nilai` int NOT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id` int NOT NULL,
  `pertanyaan` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `pilihan_a` varchar(255) NOT NULL,
  `pilihan_b` varchar(255) NOT NULL,
  `pilihan_c` varchar(255) NOT NULL,
  `pilihan_d` varchar(255) NOT NULL,
  `gambar_pilihan_a` varchar(255) DEFAULT NULL,
  `gambar_pilihan_b` varchar(255) DEFAULT NULL,
  `gambar_pilihan_c` varchar(255) DEFAULT NULL,
  `gambar_pilihan_d` varchar(255) DEFAULT NULL,
  `jawaban_benar` char(1) NOT NULL,
  `penjelasan` text,
  `gambar_penjelasan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `pertanyaan`, `gambar`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `gambar_pilihan_a`, `gambar_pilihan_b`, `gambar_pilihan_c`, `gambar_pilihan_d`, `jawaban_benar`, `penjelasan`, `gambar_penjelasan`, `created_at`, `updated_at`) VALUES
(1, 'Perhatikan gambar persilangan dihibrida berikut. Jika terjadi persilangan antara tanaman berbiji bulat kuning (BBKK) dengan tanaman berbiji kisut hijau (bbkk), berapakah ratio fenotip F2?', 'assets/images/soal/soal1.jpg', '9:3:3:1', '9:3:4', '12:3:1', '1:2:1', 'assets/images/pilihan/1a.jpg', 'assets/images/pilihan/1b.jpg', 'assets/images/pilihan/1c.jpg', 'assets/images/pilihan/1d.jpg', 'a', 'Pada persilangan dihibrida, rasio fenotip F2 adalah 9:3:3:1. Hal ini dapat dilihat dari hasil persilangan pada diagram berikut:', 'assets/images/penjelasan/penjelasan1.jpg', '2024-12-12 11:40:27', '2024-12-12 11:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `username`, `password`, `kelas`, `created_at`, `updated_at`) VALUES
(1, 'Denis Akbar', 'bekoy', '$2y$10$H89zfcimS6R3xJmwZY9DJO.Nc419rEDx.Ek19xw97OJLtfPz3RYTe', '7', '2024-12-12 13:25:17', '2024-12-12 13:25:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minigame_progress`
--
ALTER TABLE `minigame_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `minigame_progress`
--
ALTER TABLE `minigame_progress`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `minigame_progress`
--
ALTER TABLE `minigame_progress`
  ADD CONSTRAINT `minigame_progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
