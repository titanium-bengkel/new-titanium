-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Sep 2024 pada 11.08
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
-- Struktur dari tabel `pdetail_pesan`
--

CREATE TABLE `pdetail_pesan` (
  `id_kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `harga` decimal(15,2) DEFAULT NULL,
  `jumlah` decimal(15,2) DEFAULT NULL,
  `qty_beli` int(11) DEFAULT NULL,
  `qty_sisa` int(11) DEFAULT NULL,
  `no_faktur` varchar(50) DEFAULT NULL,
  `tgl_faktur` date DEFAULT NULL,
  `id_pesan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pdetail_pesan`
--

INSERT INTO `pdetail_pesan` (`id_kode_barang`, `nama_barang`, `qty`, `satuan`, `harga`, `jumlah`, `qty_beli`, `qty_sisa`, `no_faktur`, `tgl_faktur`, `id_pesan`) VALUES
('asd', 'asd', 1, 'LT', 1000000.00, 1000000.00, 1, 1, NULL, NULL, 'PO2024090001'),
('asd', 'asd', 1, 'f', 2000000.00, 2000000.00, 1, 1, NULL, NULL, 'PO2024090003'),
('asda', 'asd', 1, 'LT', 1000000.00, 1000000.00, 1, 1, NULL, NULL, 'PO2024090004'),
('SP001', 'Valve TPMS', 11, 'PCS', 14000.00, 154000.00, 11, 0, NULL, NULL, 'PO2024090005'),
('SP002', 'Tutup Whelldoff', 1, 'PCS', 11500.00, 11500.00, 1, 0, NULL, NULL, 'PO2024090005'),
('SP001', 'Valve TPMS', 1, 'PCS', 14000.00, 14000.00, 1, 0, NULL, NULL, 'PO2024090006'),
('SP001', 'Valve TPMS', 1, 'PCS', 14000.00, 14000.00, 1, 0, NULL, NULL, 'PO2024090007');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pdetail_pesan`
--
ALTER TABLE `pdetail_pesan`
  ADD KEY `id_pesan` (`id_pesan`),
  ADD KEY `id_kode_barang` (`id_kode_barang`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pdetail_pesan`
--
ALTER TABLE `pdetail_pesan`
  ADD CONSTRAINT `pdetail_pesan_ibfk_1` FOREIGN KEY (`id_pesan`) REFERENCES `part_po` (`id_pesan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
