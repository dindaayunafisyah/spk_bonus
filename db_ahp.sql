-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2022 at 07:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ahp`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_kuisioner_kasi`
--

CREATE TABLE `data_kuisioner_kasi` (
  `id_kuis_kasi` varchar(10) NOT NULL,
  `id_kriteria_kasi` varchar(10) NOT NULL,
  `kuis_kasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_kuisioner_kasi`
--

INSERT INTO `data_kuisioner_kasi` (`id_kuis_kasi`, `id_kriteria_kasi`, `kuis_kasi`) VALUES
('KS001', 'KKS001', 'sadhusaydy');

-- --------------------------------------------------------

--
-- Table structure for table `data_kuisioner_op`
--

CREATE TABLE `data_kuisioner_op` (
  `id_kuis_op` varchar(10) NOT NULL,
  `id_kriteria_op` varchar(10) NOT NULL,
  `kuis_op` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_kuisioner_op`
--

INSERT INTO `data_kuisioner_op` (`id_kuis_op`, `id_kriteria_op`, `kuis_op`) VALUES
('KP001', 'KOP001', 'dadada'),
('KP002', 'KOP001', 'lilili'),
('KP003', 'KOP001', 'nananna'),
('KP004', 'KOP001', 'y'),
('KP005', 'KOP001', 'dadada'),
('KP006', 'KOP001', 'yayys'),
('KP007', 'KOP001', 'ghgkjgk'),
('KP008', 'KOP001', 'fjgfyfyy');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_banding`
--

CREATE TABLE `nilai_banding` (
  `id_nilai` varchar(10) NOT NULL,
  `nama_nilai` varchar(50) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_banding`
--

INSERT INTO `nilai_banding` (`id_nilai`, `nama_nilai`, `nilai`) VALUES
('NL001', 'Sama penting dengan', 1),
('NL002', 'Mendekati sedikit lebih dari', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` varchar(10) NOT NULL,
  `nama_admin` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_divisi`
--

CREATE TABLE `tb_divisi` (
  `id_divisi` varchar(10) NOT NULL,
  `nama_divisi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_divisi`
--

INSERT INTO `tb_divisi` (`id_divisi`, `nama_divisi`) VALUES
('DV001', 'Welding'),
('DV002', 'Blower'),
('DV003', 'Aoutomotive');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id_jabatan` varchar(10) NOT NULL,
  `nama_jabatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
('JB001', 'HRD'),
('JB002', 'Manajer'),
('JB003', 'Kepala Divisi'),
('JB004', 'Operator');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `nik` varchar(16) NOT NULL,
  `id_jabatan` varchar(10) NOT NULL,
  `id_divisi` varchar(10) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria_kasi`
--

CREATE TABLE `tb_kriteria_kasi` (
  `id_kriteria_kasi` varchar(10) NOT NULL,
  `nama_kriteria_kasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kriteria_kasi`
--

INSERT INTO `tb_kriteria_kasi` (`id_kriteria_kasi`, `nama_kriteria_kasi`) VALUES
('KKS001', 'Leadership');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria_operator`
--

CREATE TABLE `tb_kriteria_operator` (
  `id_kriteria_op` varchar(10) NOT NULL,
  `nama_kriteria_op` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kriteria_operator`
--

INSERT INTO `tb_kriteria_operator` (`id_kriteria_op`, `nama_kriteria_op`) VALUES
('KOP001', 'Productivity'),
('KOP002', 'Kerjasama');

-- --------------------------------------------------------

--
-- Table structure for table `tb_subrange_kasi`
--

CREATE TABLE `tb_subrange_kasi` (
  `id_subrange_kasi` int(11) NOT NULL,
  `id_kriteria_kasi` varchar(10) NOT NULL,
  `id_jabatan` varchar(10) NOT NULL,
  `nama_subrange_kasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_subrange_op`
--

CREATE TABLE `tb_subrange_op` (
  `id_subrange_op` varchar(10) NOT NULL,
  `id_kriteria_op` varchar(10) NOT NULL,
  `id_jabatan` varchar(10) NOT NULL,
  `nama_subrange_op` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(8) NOT NULL,
  `level` enum('HRD','Manajer','Kepala Divisi','') NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `level`, `status`) VALUES
(1, 'Bahrul', 'bahrul', 'kasi', 'Kepala Divisi', ''),
(2, 'Atim', 'atim', 'manajer', 'Manajer', ''),
(3, 'Rendi', 'rendi', 'hrd', 'HRD', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_kuisioner_kasi`
--
ALTER TABLE `data_kuisioner_kasi`
  ADD PRIMARY KEY (`id_kuis_kasi`),
  ADD KEY `id_kriteria_kasi` (`id_kriteria_kasi`);

--
-- Indexes for table `data_kuisioner_op`
--
ALTER TABLE `data_kuisioner_op`
  ADD PRIMARY KEY (`id_kuis_op`),
  ADD KEY `id_kriteria_op` (`id_kriteria_op`);

--
-- Indexes for table `nilai_banding`
--
ALTER TABLE `nilai_banding`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `tb_divisi`
--
ALTER TABLE `tb_divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `id_jabatan` (`id_jabatan`,`id_divisi`),
  ADD KEY `id_divisi` (`id_divisi`);

--
-- Indexes for table `tb_kriteria_kasi`
--
ALTER TABLE `tb_kriteria_kasi`
  ADD PRIMARY KEY (`id_kriteria_kasi`);

--
-- Indexes for table `tb_kriteria_operator`
--
ALTER TABLE `tb_kriteria_operator`
  ADD PRIMARY KEY (`id_kriteria_op`);

--
-- Indexes for table `tb_subrange_kasi`
--
ALTER TABLE `tb_subrange_kasi`
  ADD PRIMARY KEY (`id_subrange_kasi`),
  ADD KEY `id_kriteria_kasi` (`id_kriteria_kasi`,`id_jabatan`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `tb_subrange_op`
--
ALTER TABLE `tb_subrange_op`
  ADD PRIMARY KEY (`id_subrange_op`),
  ADD KEY `id_kriteria_op` (`id_kriteria_op`,`id_jabatan`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_kuisioner_kasi`
--
ALTER TABLE `data_kuisioner_kasi`
  ADD CONSTRAINT `data_kuisioner_kasi_ibfk_1` FOREIGN KEY (`id_kriteria_kasi`) REFERENCES `tb_kriteria_kasi` (`id_kriteria_kasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_kuisioner_op`
--
ALTER TABLE `data_kuisioner_op`
  ADD CONSTRAINT `data_kuisioner_op_ibfk_1` FOREIGN KEY (`id_kriteria_op`) REFERENCES `tb_kriteria_operator` (`id_kriteria_op`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD CONSTRAINT `tb_karyawan_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_karyawan_ibfk_2` FOREIGN KEY (`id_divisi`) REFERENCES `tb_divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_subrange_kasi`
--
ALTER TABLE `tb_subrange_kasi`
  ADD CONSTRAINT `tb_subrange_kasi_ibfk_1` FOREIGN KEY (`id_kriteria_kasi`) REFERENCES `tb_kriteria_kasi` (`id_kriteria_kasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_subrange_kasi_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_subrange_op`
--
ALTER TABLE `tb_subrange_op`
  ADD CONSTRAINT `tb_subrange_op_ibfk_1` FOREIGN KEY (`id_kriteria_op`) REFERENCES `tb_kriteria_operator` (`id_kriteria_op`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_subrange_op_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
