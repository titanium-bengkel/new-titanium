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
-- Struktur dari tabel `part_terima`
--

CREATE TABLE `part_terima` (
  `id_penerimaan` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `gudang` varchar(255) DEFAULT NULL,
  `no_preor` varchar(255) DEFAULT NULL,
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
-- Dumping data untuk tabel `part_terima`
--

INSERT INTO `part_terima` (`id_penerimaan`, `tanggal`, `supplier`, `jatuh_tempo`, `keterangan`, `gudang`, `no_preor`, `kota`, `alamat`, `nopol`, `pembayaran`, `ppn`, `term`, `total_qty`, `total_jumlah`, `nilai_ppn`, `netto`) VALUES
('PC202409001', NULL, 'asdasd', '2024-09-25', NULL, 'GUDANG STOK SPAREPART', NULL, 'asd', 'semarang', 'a 1111 a', 'KREDIT', '0', '33', 1, 1000000.00, 0.00, 1000000.00),
('PC202409002', NULL, 'asdasd', '2024-09-25', '-', 'GUDANG STOK SPAREPART', 'tttt', 'smg', 'semarang', 'a 1111 a', 'TRANSVER', '0', '33', 1, 1000000.00, 0.00, 1000000.00),
('PC202409003', '2024-09-05', 'HANINDA EKA MUDA (THINER)', '2024-09-04', 'test', 'GUDANG STOK SPAREPART', 'PO2024090001', 'SEMARANG', 'asd', 'asd', 'TRANSVER', '0', '', 22, 306460.00, 0.00, 306460.00),
('PC202409004', '2024-09-05', 'asd', '2024-09-03', 'test', 'GUDANG STOK SPAREPART', 'PO2024090001', 'smg', 'smg@g.com', 'asd', 'KREDIT', '0', '1', 12, 150125.00, 0.00, 150125.00),
('PC202409005', '2024-09-05', 'HANINDA EKA MUDA (THINER)', '2024-09-27', '-', 'GUDANG REPAIR(MOBIL SUDAH ADA)', 'PO2024090001', 'SEMARANG', 'asd', 'asd', 'TRANSVER', '0', '33', 12, 168000.00, 0.00, 168000.00),
('PC202409006', '2024-09-05', 'HANINDA EKA MUDA (THINER)', '0000-00-00', 'o', 'GUDANG WAITING(MOBIL BELUM DATANG)', 'PO2024090001', 'SEMARANG', 'asd', 'asd', 'TRANSVER', '0', '33', 12, 147625.00, 0.00, 147625.00),
('PC202409007', '2024-09-06', 'CV ABADI JAYA (GLITZERN)', '2024-09-19', '-', 'GUDANG STOK SPAREPART', 'PO2024090001', 'smg', '-', 'asd', 'TRANSVER', '0', '1', 1, 14000.00, 1540.00, 15540.00),
('PC202409008', '2024-09-06', 'HANINDA EKA MUDA (THINER)', '2024-09-06', '-', 'GUDANG STOK SPAREPART', 'PO2024090001', 'SEMARANG', 'asd', 'asd', 'TRANSVER', '11', '-', 1, 14000.00, 1540.00, 15540.00),
('PC202409009', '2024-09-06', 'HANINDA EKA MUDA (THINER)', '2024-09-06', '-', 'GUDANG STOK SPAREPART', 'PO2024090001', 'SEMARANG', 'asd', 'asd', 'TRANSVER', '11', '-', 1, 14000.00, 1540.00, 15540.00),
('PC202409010', '2024-09-06', 'CV ABADI JAYA (GLITZERN)', '2024-09-13', 'test', 'GUDANG STOK SPAREPART', 'PO2024090001', 'smg', '-', 'asd', 'KREDIT', '11', '33', 111, 1292500.00, 142175.00, 1434675.00),
('PC202409011', '2024-09-06', 'CV ABADI JAYA (GLITZERN)', '2024-09-26', '-', 'GUDANG STOK SPAREPART', 'PO2024090001', 'smg', '-', 'asd', 'CASH', '0', '11', 222, 2941500.00, 0.00, 2941500.00);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `part_terima`
--
ALTER TABLE `part_terima`
  ADD PRIMARY KEY (`id_penerimaan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
