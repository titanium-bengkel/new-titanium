-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Agu 2024 pada 11.24
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
-- Struktur dari tabel `po_bahan`
--

CREATE TABLE `po_bahan` (
  `id_po_bahan` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `no_ro` varchar(255) DEFAULT NULL,
  `asuransi` varchar(255) DEFAULT NULL,
  `jenis_mobil` varchar(255) DEFAULT NULL,
  `warna` varchar(225) NOT NULL,
  `nama_pemilik` varchar(255) DEFAULT NULL,
  `no_kendaraan` varchar(255) DEFAULT NULL,
  `total_qty` int(11) DEFAULT NULL,
  `total_jumlah` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `po_bahan`
--

INSERT INTO `po_bahan` (`id_po_bahan`, `tanggal`, `supplier`, `jatuh_tempo`, `keterangan`, `no_ro`, `asuransi`, `jenis_mobil`, `warna`, `nama_pemilik`, `no_kendaraan`, `total_qty`, `total_jumlah`) VALUES
('PO20240801002', '2024-08-01', 'PT. MAJU MUNDIR', '2024-08-09', 'TEST', 'T101010', 'BNI INSURANCE', 'SKYLINE GTR-34', '', 'FIKRI', 'K 1234 KK', 3, 799000000.00);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `po_bahan`
--
ALTER TABLE `po_bahan`
  ADD PRIMARY KEY (`id_po_bahan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
