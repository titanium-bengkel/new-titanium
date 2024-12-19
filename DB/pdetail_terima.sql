-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Sep 2024 pada 11.09
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
-- Struktur dari tabel `pdetail_terima`
--

CREATE TABLE `pdetail_terima` (
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
-- Dumping data untuk tabel `pdetail_terima`
--

INSERT INTO `pdetail_terima` (`id_kode_barang`, `nama_barang`, `qty`, `satuan`, `harga`, `disc`, `jumlah`, `no_po`, `po_id`, `id_penerimaan`) VALUES
('asd', 'asd', 1, 'LT', 1000000.00, 0.00, 1000000.00, '1', NULL, 'PC202409001'),
('T000', 'Kaca depan', 1, 'LT', 1000000.00, 0.00, 1000000.00, '1', NULL, 'PC202409002'),
('SP001', 'Valve TPMS', 11, 'PCS', 14000.00, 1.00, 152460.00, '11', NULL, 'PC202409003'),
('SP001', 'Valve TPMS', 11, 'PCS', 14000.00, 0.00, 154000.00, '1', NULL, 'PC202409003'),
('SP003', 'Foglamp Kiri', 11, 'PCS', 12500.00, 1.00, 136125.00, '1', NULL, 'PC202409004'),
('SP001', 'Valve TPMS', 1, 'PCS', 14000.00, 0.00, 14000.00, '11', NULL, 'PC202409004'),
('SP001', 'Valve TPMS', 1, 'PCS', 14000.00, 0.00, 14000.00, '1', NULL, 'PC202409005'),
('SP001', 'Valve TPMS', 11, 'PCS', 14000.00, 0.00, 154000.00, '1', NULL, 'PC202409005'),
('SP003', 'Foglamp Kiri', 11, 'PCS', 12500.00, 1.00, 136125.00, '1111', NULL, 'PC202409006'),
('SP006', 'Oil Filter', 1, 'PCS', 11500.00, 0.00, 11500.00, '1', NULL, 'PC202409006'),
('SP001', 'Valve TPMS', 1, 'PCS', 14000.00, 0.00, 14000.00, '1', NULL, 'PC202409007'),
('SP001', 'Valve TPMS', 1, 'PCS', 14000.00, 0.00, 14000.00, '1', NULL, 'PC202409008'),
('SP001', 'Valve TPMS', 1, 'PCS', 14000.00, 0.00, 14000.00, '1', NULL, 'PC202409009'),
('SP001', 'Valve TPMS', 11, 'PCS', 14000.00, 0.00, 154000.00, '1', NULL, 'PC202409010'),
('SP006', 'Oil Filter', 100, 'PCS', 11500.00, 1.00, 1138500.00, '11', NULL, 'PC202409010'),
('SP001', 'Valve TPMS', 111, 'PCS', 14000.00, 0.00, 1554000.00, '1', NULL, 'PC202409011'),
('SP003', 'Foglamp Kiri', 111, 'PCS', 12500.00, 0.00, 1387500.00, '1', NULL, 'PC202409011');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pdetail_terima`
--
ALTER TABLE `pdetail_terima`
  ADD KEY `id_penerimaan` (`id_penerimaan`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pdetail_terima`
--
ALTER TABLE `pdetail_terima`
  ADD CONSTRAINT `pdetail_terima_ibfk_1` FOREIGN KEY (`id_penerimaan`) REFERENCES `part_terima` (`id_penerimaan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
