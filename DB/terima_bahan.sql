-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Agu 2024 pada 06.29
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
-- Struktur dari tabel `terima_bahan`
--

CREATE TABLE `terima_bahan` (
  `id_penerimaan` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `gudang` varchar(255) DEFAULT NULL,
  `no_kendaraan` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nopol` varchar(255) DEFAULT NULL,
  `pembayaran` varchar(255) DEFAULT NULL,
  `ppn` varchar(225) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL,
  `total_qty` int(11) DEFAULT NULL,
  `total_jumlah` decimal(15,2) DEFAULT NULL,
  `nilai_ppn` decimal(15,2) DEFAULT NULL,
  `netto` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `terima_bahan`
--

INSERT INTO `terima_bahan` (`id_penerimaan`, `tanggal`, `supplier`, `jatuh_tempo`, `keterangan`, `gudang`, `no_kendaraan`, `kota`, `alamat`, `nopol`, `pembayaran`, `ppn`, `term`, `total_qty`, `total_jumlah`, `nilai_ppn`, `netto`) VALUES
('PC20240808001', '2024-08-08', 'asdad', '2024-08-09', 'asd', 'GUDANG BAHAN', 'asd', 'ad', 'asd', 'asd', 'TRANSFER', '11', '19', 3, 34020.00, 3742.20, 37762.20),
('PC20240808002', '2024-08-08', 'CV ABADI JAYA (GLITZERN)', '2024-08-09', 'a', 'GUDANG BAHAN', 'ASD', 'as', 'ass', 'as', 'TRANSFER', '11', '1', 13, 179685.00, 19765.35, 199450.35),
('PC20240808003', '2024-08-08', 'asd', '2024-08-14', 'asd', 'GUDANG BAHAN', 'ASD', 'asd', '', '', 'KREDIT', '11', 'asd', 2, 27720.00, 3049.20, 30769.20),
('PC20240808004', '2024-08-08', '', '0000-00-00', '', 'GUDANG BAHAN', '', '', '', '', '--Pilih--', '0', '', 1, 12375.00, 0.00, 12375.00),
('PC20240808005', '2024-08-08', '', '0000-00-00', '', 'GUDANG BAHAN', '', '', '', '', '--Pilih--', '0', '', 2, 23000.00, 0.00, 23000.00),
('PC20240808006', '2024-08-08', 'asd', '2024-08-12', 'asd', 'GUDANG BAHAN', 'asda', 'as', 'asd', 'as', 'TRANSFER', '11', '1', 2, 24975.00, 2747.25, 27722.25),
('PC20240808007', '2024-08-09', 'vibra ', '2024-08-09', 'test edit', 'GUDANG BAHAN', 'asdaaa', NULL, 'ASDaa', 'hehe', 'TRANSFER', '0', '1', 4, 53460.00, 5880.60, 59340.60);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `terima_bahan`
--
ALTER TABLE `terima_bahan`
  ADD PRIMARY KEY (`id_penerimaan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
