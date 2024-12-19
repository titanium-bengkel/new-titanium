-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Agu 2024 pada 11.23
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
-- Struktur dari tabel `detail_barang`
--

CREATE TABLE `detail_barang` (
  `id_kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `harga` decimal(15,2) DEFAULT NULL,
  `jumlah` decimal(15,2) DEFAULT NULL,
  `qty_beli` int(11) DEFAULT NULL,
  `qty_sisa` int(11) DEFAULT NULL,
  `no_faktur` varchar(50) DEFAULT NULL,
  `tgl_faktur` date DEFAULT NULL,
  `id_po_bahan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_barang`
--

INSERT INTO `detail_barang` (`id_kode_barang`, `nama_barang`, `qty`, `satuan`, `harga`, `jumlah`, `qty_beli`, `qty_sisa`, `no_faktur`, `tgl_faktur`, `id_po_bahan`) VALUES
('K222', 'LAMPU DEPAN KIRI', 1, 'PCS', 45000000.00, 45000000.00, 1, 0, NULL, NULL, 'PO20240801002'),
('Q112', 'FELG DEPAN KIRI', 1, 'PCS', 734000000.00, 734000000.00, 1, 0, NULL, NULL, 'PO20240801002'),
('T000', 'Kaca depan', 1, 'PCS', 20000000.00, 20000000.00, 1, 0, NULL, NULL, 'PO20240801002');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD PRIMARY KEY (`id_kode_barang`,`id_po_bahan`),
  ADD KEY `id_po_bahan` (`id_po_bahan`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD CONSTRAINT `detail_barang_ibfk_1` FOREIGN KEY (`id_po_bahan`) REFERENCES `po_bahan` (`id_po_bahan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
