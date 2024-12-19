-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Sep 2024 pada 11.07
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `titanium`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `part_po`
--

CREATE TABLE `part_po` (
  `id_pesan` varchar(50) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `no_repair_order` varchar(50) DEFAULT NULL,
  `asuransi` varchar(100) DEFAULT NULL,
  `jenis_mobil` varchar(50) DEFAULT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `nama_pemilik` varchar(250) DEFAULT NULL,
  `no_kendaraan` varchar(50) DEFAULT NULL,
  `user_id` varchar(225) DEFAULT NULL,
  `total_qty` int(11) DEFAULT NULL,
  `total_jumlah` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `part_po`
--

INSERT INTO `part_po` (`id_pesan`, `tanggal`, `supplier`, `jatuh_tempo`, `keterangan`, `no_repair_order`, `asuransi`, `jenis_mobil`, `warna`, `nama_pemilik`, `no_kendaraan`, `user_id`, `total_qty`, `total_jumlah`) VALUES
('PO2024090001', '2024-09-03', 'asdad', '2024-09-30', '-', NULL, 'asd', 'avanza', 'Xpander', NULL, 'asd', '', 1, 1000000.00),
('PO2024090002', '2024-09-03', 'asdasd', '2024-09-04', '-', NULL, 'ad', 'asdasd', 'asdad', NULL, 'a 2222 a', '', 1, 1.00),
('PO2024090003', '2024-09-03', 'asdasd', '2024-09-26', '-', NULL, 'asdasd', 'Wuling', 'Xpander', NULL, 'a 2222 a', '', 1, 2000000.00),
('PO2024090004', '2024-09-03', 'vibra', '2024-09-30', '-', 'asdas', 'adad', 'avanza', 'asd', NULL, 'a 2222 a', '', 1, 1000000.00),
('PO2024090005', '2024-09-03', 'HANINDA EKA MUDA (THINER)', '2024-09-30', 'test', 'T202409001', 'Umum/Pribadi', 'xenia', 'merah', NULL, '1111111', '', 12, 165500.00),
('PO2024090006', '2024-09-03', 'CV ABADI JAYA (GLITZERN)', '0000-00-00', 'test', 'T20240726001', 'bca', 'xenia', 'merah', NULL, 'k 9292 h', '', 1, 14000.00),
('PO2024090007', '2024-09-03', 'CV ABADI JAYA (GLITZERN)', '2024-09-24', 'test', 'T202409001', 'Umum/Pribadi', 'xenia', 'merah', 'affa', '1111111', '', 1, 14000.00);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `part_po`
--
ALTER TABLE `part_po`
  ADD PRIMARY KEY (`id_pesan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
