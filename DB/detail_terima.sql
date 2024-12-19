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
-- Struktur dari tabel `detail_terima`
--

CREATE TABLE `detail_terima` (
  `id_kode_barang` varchar(125) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `disc` decimal(5,2) DEFAULT NULL,
  `jumlah` decimal(10,2) DEFAULT NULL,
  `no_po` varchar(255) DEFAULT NULL,
  `po_id` varchar(255) DEFAULT NULL,
  `id_penerimaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_terima`
--

INSERT INTO `detail_terima` (`id_kode_barang`, `nama_barang`, `qty`, `satuan`, `harga`, `disc`, `jumlah`, `no_po`, `po_id`, `id_penerimaan`) VALUES
('SP007', 'Air Filter', 1, 'PCS', 12500.00, 10.00, 11250.00, '11', NULL, 'PC20240808001'),
('SP001', 'Valve TPMS', 11, 'PCS', 14000.00, 1.00, 152460.00, '1', NULL, 'PC20240808002'),
('SP001', 'Valve TPMS', 1, 'PCS', 14000.00, 1.00, 13860.00, '123', NULL, 'PC20240808003'),
('SP003', 'Foglamp Kiri', 1, 'PCS', 12500.00, 1.00, 12375.00, '1', NULL, 'PC20240808004'),
('SP002', 'Tutup Whelldoff', 1, 'PCS', 11500.00, 0.00, 11500.00, 'q', NULL, 'PC20240808005'),
('SP003', 'Foglamp Kiri', 1, 'PCS', 12500.00, 1.00, 12375.00, '1', NULL, 'PC20240808006'),
('SP005', 'Brake Pad Set', 1, 'PCS', 14000.00, 10.00, 12600.00, '123', NULL, 'PC20240808006'),
('SP001', 'Valve TPMS', 1, 'PCS', 14000.00, 1.00, 13860.00, '123', NULL, 'PC20240808007'),
('SP002', 'Tutup Whelldoff', 1, 'PCS', 11500.00, 1.00, 11385.00, '1', NULL, 'PC20240808007'),
('SP003', 'Foglamp Kiri', 1, 'PCS', 12500.00, 1.00, 12375.00, '1', NULL, 'PC20240808007'),
('SP004', 'Bracket Bumper Depan Kanan', 1, 'PCS', 16000.00, 1.00, 15840.00, '1', NULL, 'PC20240808007');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_terima`
--
ALTER TABLE `detail_terima`
  ADD PRIMARY KEY (`id_penerimaan`,`id_kode_barang`) USING BTREE,
  ADD KEY `id_kode_barang` (`id_penerimaan`) USING BTREE;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_terima`
--
ALTER TABLE `detail_terima`
  ADD CONSTRAINT `detail_terima_ibfk_1` FOREIGN KEY (`id_penerimaan`) REFERENCES `terima_bahan` (`id_penerimaan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
