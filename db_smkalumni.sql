-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2020 at 03:12 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_smkalumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(65) NOT NULL,
  `foto` varchar(60) NOT NULL,
  `create_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `nama`, `email`, `password`, `foto`, `create_at`) VALUES
('admin', 'Admin', 'admin@gmail.com', '$2y$10$ZdYqIyoTsOavtxeAdg14tOx195hEUboURNd5NC1NoXA5QKUoi22dq', 'default.png', '2020-05-05'),
('admin3', 'admin3', 'admin2@simsekolah.co.id', '$2y$10$1TE98iXRjCTQIZ5kyO5cRulCEeph2i5bqauGPtyKYB48s09KhGUDu', 'default.png', '2020-05-06'),
('alif', 'alif', 'alex@gmail.com', '$2y$10$GcOqhC1vnVmSrDlLUMjNF.4q8bI7/GKDgN1UZhzZAIIuwv/4KZL9.', '737378df719a899e2cc509b62da5f5a2.png', '2020-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `nisn` int(15) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(65) NOT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(60) DEFAULT NULL,
  `agama` varchar(30) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `tahun_masuk` year(4) DEFAULT NULL,
  `tahun_lulus` year(4) DEFAULT NULL,
  `foto` varchar(60) NOT NULL,
  `tentang` text DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`nisn`, `nama`, `email`, `password`, `alamat`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `agama`, `telepon`, `tahun_masuk`, `tahun_lulus`, `foto`, `tentang`, `id_kelas`, `id_jurusan`) VALUES
(1234, 'Bambang sudarmo', 'alumni@gmail.com', '$2y$10$ZdYqIyoTsOavtxeAdg14tOx195hEUboURNd5NC1NoXA5QKUoi22dq', 'dwadawdad', 'L', '2020-05-25', 'Jakarta', 'islam', '08812423814', 2018, 2020, '89d9a05b30dd668cc2de5982e5d60ccd.jpg', 'efwefwefwfwfewffwefewfefefewfefefef\r\n]fefefewfefefef', 3, 4),
(12345, 'Anisa', 'anisa@gmail.com', '$2y$10$ZdYqIyoTsOavtxeAdg14tOx195hEUboURNd5NC1NoXA5QKUoi22dq', 'dwadawdad', 'P', '2020-05-25', 'Jakarta', 'islam', '08812423814', 2018, 2020, 'c978c452767c152d0aa2e4d311fb5958.jpg', 'efwefwefwfwfewffwefewfefefewfefefef\r\n]fefefewfefefef', 3, 3),
(12346, 'Arif', 'arif@gmail.com', '$2y$10$ZdYqIyoTsOavtxeAdg14tOx195hEUboURNd5NC1NoXA5QKUoi22dq', 'dwadawdad', 'P', '2020-05-25', 'Jakarta', 'islam', '08812423814', 2018, 2020, 'c978c452767c152d0aa2e4d311fb5958.jpg', 'efwefwefwfwfewffwefewfefefewfefefef\r\n]fefefewfefefef', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `judul_event` varchar(60) NOT NULL,
  `gambar_event` varchar(60) NOT NULL,
  `tanggal_event` date NOT NULL,
  `lokasi_event` varchar(60) NOT NULL,
  `waktu_event` varchar(30) NOT NULL,
  `deskripsi_event` text NOT NULL,
  `slug` varchar(60) NOT NULL,
  `create_at` date NOT NULL DEFAULT current_timestamp(),
  `author` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id_event`, `judul_event`, `gambar_event`, `tanggal_event`, `lokasi_event`, `waktu_event`, `deskripsi_event`, `slug`, `create_at`, `author`) VALUES
(2, 'Pentas Seni', 'default-event.jpg', '2020-05-25', 'jogja', '15:03', 'fefwefwef', 'test-2-update', '2020-05-05', 'admin'),
(3, 'Sarasehan', 'event2.jpg', '2020-05-25', 'Cafe Mang ujang', '15:03', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'sarasehan', '2020-05-20', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(3, 'jaringan'),
(4, 'test3');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_komentar`
--

CREATE TABLE `kategori_komentar` (
  `id_kategori` int(11) NOT NULL,
  `id_berita` int(11) DEFAULT NULL,
  `kategori` varchar(30) NOT NULL,
  `id_komentar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_komentar`
--

INSERT INTO `kategori_komentar` (`id_kategori`, `id_berita`, `kategori`, `id_komentar`) VALUES
(1, 2, 'lowongan', 1),
(2, 2, 'lowongan', 2),
(3, 3, 'lowongan', 3),
(4, 2, 'lowongan', 4),
(6, 4, 'lowongan', 6),
(8, 2, 'event', 8),
(9, 2, 'lowongan', 9),
(10, 2, 'lowongan', 10),
(11, 5, 'lowongan', 11);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nama_kelas` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_jurusan`, `nama_kelas`) VALUES
(2, 4, 'kelas bersalin 2'),
(3, 4, 'kelas 2');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_parent_komentar` int(11) NOT NULL DEFAULT 0,
  `komentar` varchar(250) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `author` varchar(60) NOT NULL,
  `komentar_oleh` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_parent_komentar`, `komentar`, `tanggal`, `author`, `komentar_oleh`) VALUES
(1, 0, 'koment awal', '2020-05-20 00:03:05', '1234', 'alumni'),
(2, 1, 'balas komen', '2020-05-20 00:03:14', '1234', 'alumni'),
(4, 2, 'balas komen 2.0', '2020-05-20 00:03:49', '1234', 'alumni'),
(6, 0, 'koment', '2020-05-20 00:13:34', '1234', 'alumni'),
(8, 0, 'koment event', '2020-05-20 00:39:54', '1234', 'alumni'),
(11, 0, 'koment', '2020-05-22 19:39:48', '1234', 'alumni');

-- --------------------------------------------------------

--
-- Table structure for table `kritik_saran`
--

CREATE TABLE `kritik_saran` (
  `id_kritik_saran` int(11) NOT NULL,
  `nisn` int(11) NOT NULL,
  `kritik` text NOT NULL,
  `saran` text NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kritik_saran`
--

INSERT INTO `kritik_saran` (`id_kritik_saran`, `nisn`, `kritik`, `saran`, `create_at`) VALUES
(2, 1234, 'test kritik', 'test saran', '2020-05-11 22:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `lowongan`
--

CREATE TABLE `lowongan` (
  `id_lowongan` int(11) NOT NULL,
  `posisi_pekerjaan` varchar(60) NOT NULL,
  `perusahaan` varchar(60) NOT NULL,
  `penempatan` varchar(60) NOT NULL,
  `deskripsi` text NOT NULL,
  `thumbnail` varchar(60) NOT NULL DEFAULT 'default-job.png',
  `berakhir` date DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `author` varchar(30) NOT NULL,
  `slug` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lowongan`
--

INSERT INTO `lowongan` (`id_lowongan`, `posisi_pekerjaan`, `perusahaan`, `penempatan`, `deskripsi`, `thumbnail`, `berakhir`, `create_at`, `author`, `slug`) VALUES
(2, 'back end', 'imersa', 'DKI Jakarta', 'membangun aplikasi berbasis web It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'default-job.jpg', '2020-04-30', '2020-05-01 22:25:29', 'admin', 'back-end-imersa'),
(3, 'data enginerr', 'Telkom', 'DKI Jakarta', 'membangun aplikasi berbasis web It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'default-job.jpg', '2020-04-30', '2020-05-01 22:25:29', 'admin', 'data-enginerr-telkom'),
(4, 'Perawat', 'RSUD Muhammadiyah', 'DI Yogyakarta', 'membangun aplikasi berbasis web It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'default-job.jpg', '2020-04-30', '2020-05-01 22:25:29', 'admin', 'perawat-rsud'),
(5, 'Teknisi Jaringan', 'PT. Insani', 'DI Yogyakarta', 'membangun aplikasi berbasis web It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'default-job.jpg', '2020-04-30', '2020-05-01 22:25:29', 'admin', 'teknisi-jaringan-insani');

-- --------------------------------------------------------

--
-- Table structure for table `obrolan_pesan`
--

CREATE TABLE `obrolan_pesan` (
  `id_obrolan` int(11) NOT NULL,
  `obrolan_pesan` varchar(120) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `id_pesan` int(11) NOT NULL,
  `pengirim` enum('alumni','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obrolan_pesan`
--

INSERT INTO `obrolan_pesan` (`id_obrolan`, `obrolan_pesan`, `tanggal`, `id_pesan`, `pengirim`) VALUES
(22, 'hallo, ada yang bisa dibantu?', '2020-05-10 17:23:39', 1, 'admin'),
(29, 'saya mau tanya sesuatu!', '2020-05-11 22:59:07', 1, 'alumni'),
(30, 'iyah, tanya ajah bambang!!!', '2020-05-11 22:59:19', 1, 'admin'),
(31, 'dwd', '2020-05-22 18:01:22', 3, 'admin'),
(32, 'hallo', '2020-05-22 18:03:20', 3, 'alumni');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `nisn` int(30) NOT NULL,
  `subjek` varchar(60) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('menunggu','terima','tolak') NOT NULL DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `nisn`, `subjek`, `keterangan`, `tanggal`, `status`) VALUES
(1, 1234, 'test', 'fdwefwefwefwefwefwf', '2020-05-10 15:51:28', 'terima'),
(3, 1234, 'Test Pesan', 'ini cuman test', '2020-05-22 17:10:16', 'terima');

-- --------------------------------------------------------

--
-- Table structure for table `status_alumni`
--

CREATE TABLE `status_alumni` (
  `id_status` int(11) NOT NULL,
  `nisn` int(11) NOT NULL,
  `status` varchar(60) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_alumni`
--

INSERT INTO `status_alumni` (`id_status`, `nisn`, `status`, `deskripsi`) VALUES
(1, 1234, 'bekerja', 'Bekerja di pt kfc, sebagai chef 2'),
(3, 12346, 'kuliah', 'egergerg'),
(4, 12345, 'bekerja', 'saya bekerja loh');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id_testimoni` int(11) NOT NULL,
  `nisn` int(20) NOT NULL,
  `testimoni` text DEFAULT NULL,
  `is_tampil` enum('ya','tidak') NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`id_testimoni`, `nisn`, `testimoni`, `is_tampil`, `create_at`) VALUES
(1, 1234, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Omnis accusamus reprehenderit, quo, nostrum amet error voluptas perspiciatis ea ipsum quaerat ex, animi itaque. Sed aliquam eos repellendus aspernatur, esse id?', 'ya', '2020-04-24 00:06:13'),
(2, 12345, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Omnis accusamus reprehenderit, quo, nostrum amet error voluptas perspiciatis ea ipsum quaerat ex, animi itaque. Sed aliquam eos repellendus aspernatur, esse id?', 'ya', '2020-04-24 00:06:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kategori_komentar`
--
ALTER TABLE `kategori_komentar`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `kategori_komentar_ibfk_2` (`id_berita`),
  ADD KEY `kategori_komentar_ibfk_3` (`id_komentar`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `kritik_saran`
--
ALTER TABLE `kritik_saran`
  ADD PRIMARY KEY (`id_kritik_saran`),
  ADD KEY `nisn` (`nisn`);

--
-- Indexes for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id_lowongan`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `obrolan_pesan`
--
ALTER TABLE `obrolan_pesan`
  ADD PRIMARY KEY (`id_obrolan`),
  ADD KEY `obrolan_pesan_ibfk_1` (`id_pesan`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `status_alumni`
--
ALTER TABLE `status_alumni`
  ADD PRIMARY KEY (`id_status`),
  ADD KEY `status_alumni_ibfk_1` (`nisn`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id_testimoni`),
  ADD KEY `nisn` (`nisn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori_komentar`
--
ALTER TABLE `kategori_komentar`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kritik_saran`
--
ALTER TABLE `kritik_saran`
  MODIFY `id_kritik_saran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id_lowongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `obrolan_pesan`
--
ALTER TABLE `obrolan_pesan`
  MODIFY `id_obrolan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_alumni`
--
ALTER TABLE `status_alumni`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id_testimoni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kritik_saran`
--
ALTER TABLE `kritik_saran`
  ADD CONSTRAINT `kritik_saran_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `alumni` (`nisn`);

--
-- Constraints for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD CONSTRAINT `lowongan_ibfk_1` FOREIGN KEY (`author`) REFERENCES `admin` (`username`);

--
-- Constraints for table `obrolan_pesan`
--
ALTER TABLE `obrolan_pesan`
  ADD CONSTRAINT `obrolan_pesan_ibfk_1` FOREIGN KEY (`id_pesan`) REFERENCES `pesan` (`id_pesan`) ON DELETE CASCADE;

--
-- Constraints for table `status_alumni`
--
ALTER TABLE `status_alumni`
  ADD CONSTRAINT `status_alumni_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `alumni` (`nisn`) ON DELETE CASCADE;

--
-- Constraints for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD CONSTRAINT `testimoni_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `alumni` (`nisn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
