-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2018 at 02:20 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `p1`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `no_disposisi` int(15) NOT NULL,
  `no_agenda` int(15) NOT NULL,
  `no_surat` int(15) NOT NULL,
  `kepada` varchar(20) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `status_surat` enum('terkirim','pending') NOT NULL,
  `tanggapan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`no_disposisi`, `no_agenda`, `no_surat`, `kepada`, `keterangan`, `status_surat`, `tanggapan`) VALUES
(5, 5, 2, 'Kepala Direktorat', 'Kepala Direktorat', 'terkirim', 'Mohon dibaca, kasian gan'),
(6, 7, 2, 'Kepala Perstokan', 'Kepala Perstokan', 'pending', 'Mohon dibaca, kasian gan'),
(7, 9, 12, 'Kepala Perstokan', 'Kepala Perstokan', 'pending', 'Mohon kasian gan'),
(11, 10, 12, 'as', 'as', 'terkirim', 'Mohon dibaca, kasian gan');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(15) NOT NULL,
  `username` varchar(25) NOT NULL,
  `nama_depan` varchar(20) NOT NULL,
  `nama_belakang` varchar(20) NOT NULL,
  `password` varchar(150) NOT NULL,
  `hak` enum('admin','biasa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `username`, `nama_depan`, `nama_belakang`, `password`, `hak`) VALUES
(1, 'rangga', 'rangga', 'washa', 'ae2b1fca515949e5d54fb22b8ed95575', 'admin'),
(4, 'kirilin', 'Wathis', 'Botaks', 'c9f68f7491f5e696a210415bf63986cd', 'biasa');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `no_agenda` int(15) NOT NULL,
  `id` int(15) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `tanggal_kirim` date NOT NULL,
  `no_surat` int(15) NOT NULL,
  `pengirim` varchar(100) NOT NULL,
  `perihal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`no_agenda`, `id`, `jenis_surat`, `tanggal_kirim`, `no_surat`, `pengirim`, `perihal`) VALUES
(1, 1, 'Permintaan', '2018-02-20', 1, 'rangga', 'Penambahan Stok PT Lali'),
(3, 1, 'Laporan', '2018-02-20', 2, 'rangga', 'Keuangan'),
(4, 4, 'Laporan', '2018-02-22', 3, 'rangga', 'Laporan Ujikom'),
(5, 4, 'Permintaan', '2018-02-21', 4, 'kirilin', 'Jual Ginjal');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `no_agenda` int(11) NOT NULL,
  `id` int(15) NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `tanggal_kirim` date NOT NULL,
  `tanggal_terima` date NOT NULL,
  `no_surat` int(255) NOT NULL,
  `pengirim` varchar(100) NOT NULL,
  `perihal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`no_agenda`, `id`, `jenis_surat`, `tanggal_kirim`, `tanggal_terima`, `no_surat`, `pengirim`, `perihal`) VALUES
(5, 1, 'Lamaran', '2018-02-06', '2018-02-08', 5, 'Mantoes', 'Lamaran Kerja'),
(7, 1, 'Permohonan', '2018-02-13', '2018-02-13', 4, 'Santo', 'Stok barang'),
(9, 1, 'Laporan', '2018-02-20', '2018-02-21', 4, 'Jhonny', 'Pengamatan pekerja'),
(10, 4, 'Lamaran', '2018-02-05', '2018-02-15', 12, 'Chika', 'Lamaran kerja'),
(12, 1, 'Peringatan', '2018-02-20', '2018-02-21', 6, 'PT Sido Jamu', 'Stok rempah rempah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`no_disposisi`),
  ADD UNIQUE KEY `no_agenda` (`no_agenda`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`no_agenda`),
  ADD KEY `keluar_petugas` (`id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`no_agenda`),
  ADD KEY `masuk_petugas` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `no_disposisi` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `no_agenda` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `no_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD CONSTRAINT `disposisi_masuk` FOREIGN KEY (`no_agenda`) REFERENCES `surat_masuk` (`no_agenda`);

--
-- Constraints for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD CONSTRAINT `keluar_petugas` FOREIGN KEY (`id`) REFERENCES `petugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD CONSTRAINT `masuk_petugas` FOREIGN KEY (`id`) REFERENCES `petugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
