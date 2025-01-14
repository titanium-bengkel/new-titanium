-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Des 2024 pada 05.02
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
-- Struktur dari tabel `barang_sparepart`
--

CREATE TABLE `barang_sparepart` (
  `id_part` int(11) NOT NULL,
  `kode_part` varchar(50) NOT NULL,
  `nama_part` varchar(100) NOT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `stok` int(11) DEFAULT 0,
  `harga_beliawal` int(11) DEFAULT 0,
  `harga_jualawal` int(11) DEFAULT 0,
  `nama_kategori` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_sparepart`
--

INSERT INTO `barang_sparepart` (`id_part`, `kode_part`, `nama_part`, `satuan`, `stok`, `harga_beliawal`, `harga_jualawal`, `nama_kategori`, `user_id`, `tanggal`) VALUES
(1, 'D09W51730', 'EMBLEM LOGO', 'PCS', 5, 100000, 0, '', 0, '2024-11-07'),
(2, 'SP001', 'LAMPU BELAKANG KIRI', 'PCS', 1, 1000000, 0, '', 0, '2024-11-07'),
(3, 'SP002', 'LAMPU BELAKANG KIRI', 'PCS', 3, 2000000, 0, '', 0, '2024-11-07'),
(4, 'K23050221DBB', 'BAN TOYO PROXES 225/55 R19', 'PCS', 13, 9000000, 10000000, NULL, NULL, '2024-12-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `part_po`
--

CREATE TABLE `part_po` (
  `id_pesan` varchar(50) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kode_supplier` varchar(50) NOT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `gudang` varchar(50) NOT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `wo` varchar(50) DEFAULT NULL,
  `asuransi` varchar(100) DEFAULT NULL,
  `jenis_mobil` varchar(50) DEFAULT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `customer` varchar(250) DEFAULT NULL,
  `nopol` varchar(50) DEFAULT NULL,
  `no_rangka` varchar(50) DEFAULT NULL,
  `user_id` varchar(225) DEFAULT NULL,
  `total_qty` int(11) DEFAULT NULL,
  `total_jumlah` int(11) DEFAULT NULL,
  `oke` varchar(50) DEFAULT '0',
  `no_faktur` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `part_po`
--

INSERT INTO `part_po` (`id_pesan`, `tanggal`, `kode_supplier`, `supplier`, `gudang`, `jatuh_tempo`, `keterangan`, `wo`, `asuransi`, `jenis_mobil`, `warna`, `customer`, `nopol`, `no_rangka`, `user_id`, `total_qty`, `total_jumlah`, `oke`, `no_faktur`) VALUES
('POS202412002', '2024-12-10', 'BGN', 'BANGUN REDJO', '', NULL, '', 'T202411015', 'BCA', 'XPANDER', 'HITAM MIKA', 'TAUFIK HIDAYAT', 'H 1982 SY ', NULL, '91', NULL, NULL, '0', 'PC202412007'),
('POS202412003', '2024-12-11', 'VIB', 'VIBANIUM', '', NULL, '', 'T202411016', 'JASA RAHARJA PUTERA', 'KIJANG INNOVA ', 'ORANGE', 'BAMBANG HARIYANTO ', 'H 1098 IX', NULL, '91', NULL, NULL, '0', 'PC202412004'),
('POS202412004', '2024-12-11', 'VIB', 'VIBANIUM', '', NULL, '', 'T202411014', 'ETIQA', 'CX-8', 'ABU TUA METALIK', 'DJOKO DEWO', 'H 1714 CZ', NULL, '91', NULL, NULL, '0', 'PC202412008'),
('POS202412005', '2024-12-12', 'VIB', 'VIBANIUM', '', NULL, '', 'T202411013', 'MAG', 'HYUNDAI IONIQ 5', 'SILVER METALIK', 'ADHI UTAMA', 'H 1622 RO', NULL, '91', NULL, NULL, '0', 'PC202412005'),
('POS202412006', '2024-12-12', 'BGN', 'BANGUN REDJO', '', NULL, '', 'T202411013', 'MAG', 'HYUNDAI IONIQ 5', 'SILVER METALIK', 'ADHI UTAMA', 'H 1622 RO', NULL, '91', NULL, NULL, '0', 'PC202412006');

-- --------------------------------------------------------

--
-- Struktur dari tabel `part_repair`
--

CREATE TABLE `part_repair` (
  `id_material` varchar(50) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_repair` varchar(50) DEFAULT NULL,
  `gudang_masuk` varchar(100) DEFAULT NULL,
  `gudang_keluar` varchar(50) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `nopol` varchar(50) DEFAULT NULL,
  `asuransi` varchar(50) DEFAULT NULL,
  `jenis_mobil` varchar(50) DEFAULT NULL,
  `warna` varchar(30) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `nama_pemilik` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total_qty_B` int(11) DEFAULT NULL,
  `total_qty_T` int(11) DEFAULT NULL,
  `total_qty_K` int(11) DEFAULT NULL,
  `total_hpp` decimal(15,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `part_repair`
--

INSERT INTO `part_repair` (`id_material`, `tanggal`, `no_repair`, `gudang_masuk`, `gudang_keluar`, `tanggal_masuk`, `nopol`, `asuransi`, `jenis_mobil`, `warna`, `tahun`, `nama_pemilik`, `keterangan`, `total_qty_B`, `total_qty_T`, `total_qty_K`, `total_hpp`, `user_id`) VALUES
('RM2024111111', '2024-11-19', 'T202411012', '', 'GUDANG WAITING', '2024-11-05', 'H 1599 FP', NULL, 'VELOZ', 'PUTIH METALIK', 2022, 'ANDRE WILLYANTO', '', 1, NULL, NULL, 1000000.00, 90),
('RM2024111112', '2024-11-19', 'T202411012', 'GUDANG WAITING', 'GUDANG WAITING', '2024-11-05', 'H 1599 FP', NULL, 'VELOZ', 'PUTIH METALIK', 2022, 'ANDRE WILLYANTO', '', 1, NULL, NULL, 1000000.00, 90),
('RM2024110003', '2024-11-20', 'T202411012', 'GUDANG WAITING', 'GUDANG WAITING', '2024-11-05', 'H 1599 FP', NULL, 'VELOZ', 'PUTIH METALIK', 2022, 'ANDRE WILLYANTO', '', 1, NULL, NULL, 1000000.00, 90),
('RM2024110004', '2024-11-20', 'T202411012', 'GUDANG WAITING', 'GUDANG WAITING', '2024-11-05', 'H 1599 FP', NULL, 'VELOZ', 'PUTIH METALIK', 2022, 'ANDRE WILLYANTO', '', 1, NULL, NULL, 1000000.00, 90),
('RM2024110005', '2024-11-20', 'T202411012', 'GUDANG WAITING', 'GUDANG WAITING', '2024-11-05', 'H 1599 FP', NULL, 'VELOZ', 'PUTIH METALIK', 2022, 'ANDRE WILLYANTO', '', 1, NULL, NULL, 1000000.00, 91);

-- --------------------------------------------------------

--
-- Struktur dari tabel `part_terima`
--

CREATE TABLE `part_terima` (
  `id_penerimaan` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kode_supplier` varchar(50) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `gudang` varchar(255) DEFAULT NULL,
  `no_preor` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_repair_order` varchar(50) DEFAULT NULL,
  `asuransi` varchar(50) DEFAULT NULL,
  `jenis_mobil` varchar(255) DEFAULT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `nama_pemilik` varchar(50) DEFAULT NULL,
  `nopol` varchar(255) DEFAULT NULL,
  `no_rangka` varchar(50) DEFAULT NULL,
  `pembayaran` varchar(255) DEFAULT NULL,
  `ppn` varchar(225) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL,
  `total_qty` int(11) DEFAULT NULL,
  `total_jumlah` int(11) DEFAULT NULL,
  `nilai_ppn` int(11) DEFAULT NULL,
  `netto` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `part_terima`
--

INSERT INTO `part_terima` (`id_penerimaan`, `tanggal`, `kode_supplier`, `supplier`, `jatuh_tempo`, `keterangan`, `gudang`, `no_preor`, `kota`, `alamat`, `no_repair_order`, `asuransi`, `jenis_mobil`, `warna`, `nama_pemilik`, `nopol`, `no_rangka`, `pembayaran`, `ppn`, `term`, `total_qty`, `total_jumlah`, `nilai_ppn`, `netto`, `user_id`, `created_at`) VALUES
('PC202412001', '2024-12-12', 'VIB', 'VIBANIUM', '2024-12-23', '', 'GUDANG STOK SPAREPART', 'POS202412003', 'SEMARANG', '', 'T202411016', 'JASA RAHARJA PUTERA', 'KIJANG INNOVA ', 'ORANGE', ' BAMBANG HARIYANTO ', 'H 1098 IX', NULL, 'TRANSFER', '0', '11', 3, 11099967, 0, 11099967, 91, '2024-12-12 14:16:56'),
('PC202412002', '2024-12-12', 'VIB', 'VIBANIUM', '2024-12-23', '', 'GUDANG STOK SPAREPART', 'POS202412003', '', '', 'T202411016', 'JASA RAHARJA PUTERA', 'KIJANG INNOVA ', 'ORANGE', ' BAMBANG HARIYANTO ', 'H 1098 IX', NULL, 'TRANSFER', '11', '11', 3, 11099967, 1220996, 12320963, 91, '2024-12-12 14:29:21'),
('PC202412003', '2024-12-12', 'VIB', 'VIBANIUM', '2024-12-23', '', 'GUDANG STOK SPAREPART', 'POS202412003', '', '', 'T202411016', 'JASA RAHARJA PUTERA', 'KIJANG INNOVA ', 'ORANGE', ' BAMBANG HARIYANTO ', 'H 1098 IX', NULL, 'TRANSFER', '11', '11', 3, 11099967, 1220996, 12320963, 91, '2024-12-12 14:35:43'),
('PC202412004', '2024-12-12', 'VIB', 'VIBANIUM', '2024-12-23', '', 'GUDANG STOK SPAREPART', 'POS202412003', 'SMG', 'SEMARANG', 'T202411016', 'JASA RAHARJA PUTERA', 'KIJANG INNOVA ', 'ORANGE', ' BAMBANG HARIYANTO ', 'H 1098 IX', NULL, 'TRANSFER', '0', '11', 3, 11099967, 0, 11099967, 91, '2024-12-12 14:41:52'),
('PC202412005', '2024-12-12', 'VIB', 'VIBANIUM', '2024-12-23', '', 'GUDANG STOK SPAREPART', 'POS202412005', '', '', 'T202411013', 'MAG', 'HYUNDAI IONIQ 5', 'SILVER METALIK', ' ADHI UTAMA', 'H 1622 RO', NULL, 'TRANSFER', '11', '11', 1, 999989, 109999, 1109988, 91, '2024-12-12 15:00:11'),
('PC202412006', '2024-12-12', 'BGN', 'BANGUN REDJO', '2024-12-23', '', 'GUDANG STOK SPAREPART', 'POS202412006', '', '', 'T202411013', 'MAG', 'HYUNDAI IONIQ 5', 'SILVER METALIK', ' ADHI UTAMA', 'H 1622 RO', NULL, 'TRANSFER', '0', '11', 3, 11099967, 0, 11099967, 91, '2024-12-12 15:02:32'),
('PC202412007', '2024-12-13', 'BGN', 'BANGUN REDJO', '2024-12-24', '', 'GUDANG STOK SPAREPART', 'POS202412002', 'SEMARANG', 'SEMARANG', 'T202411015', 'BCA', 'XPANDER', 'HITAM MIKA', ' TAUFIK HIDAYAT', 'H 1982 SY', NULL, 'TRANSFER', '0', '11', 1, 99989, 0, 99989, 91, '2024-12-13 06:44:13'),
('PC202412008', '2024-12-13', 'VIB', 'VIBANIUM', '2024-12-24', '', 'GUDANG STOK SPAREPART', 'POS202412004', '', '', 'T202411014', 'ETIQA', 'CX-8', 'ABU TUA METALIK', ' DJOKO DEWO', 'H 1714 CZ', NULL, 'TRANSFER', '0', '11', 11, 90099879, 0, 90099879, 91, '2024-12-13 06:48:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pdetail_pesan`
--

CREATE TABLE `pdetail_pesan` (
  `id` int(11) NOT NULL,
  `id_kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `id_pesan` varchar(50) DEFAULT NULL,
  `wo` varchar(50) DEFAULT NULL,
  `no_rangka` varchar(50) DEFAULT NULL,
  `nopol` varchar(50) DEFAULT NULL,
  `is_checked` tinyint(4) DEFAULT NULL,
  `is_sent` tinyint(4) DEFAULT 0,
  `tgl_faktur` date DEFAULT NULL,
  `no_faktur` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pdetail_pesan`
--

INSERT INTO `pdetail_pesan` (`id`, `id_kode_barang`, `nama_barang`, `qty`, `satuan`, `harga`, `jumlah`, `id_pesan`, `wo`, `no_rangka`, `nopol`, `is_checked`, `is_sent`, `tgl_faktur`, `no_faktur`) VALUES
(11, 'D09W51730', 'EMBLEM LOGO', 1, 'PCS', 100000, 100000, 'POS202412002', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(12, 'D09W51730', 'EMBLEM LOGO', 1, 'PCS', 100000, 100000, 'POS202412003', NULL, NULL, 'H 1098 IX', NULL, 1, NULL, NULL),
(13, 'K23050221DBB', 'BAN TOYO PROXES 225/55 R19', 1, 'PCS', 9000000, 9000000, 'POS202412003', NULL, NULL, 'H 1098 IX', NULL, 1, NULL, NULL),
(14, 'SP002', 'LAMPU BELAKANG KIRI', 1, 'PCS', 2000000, 2000000, 'POS202412003', NULL, NULL, 'H 1098 IX', NULL, 1, NULL, NULL),
(15, 'D09W51730', 'EMBLEM LOGO', 1, 'PCS', 100000, 100000, 'POS202412004', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(16, 'K23050221DBB', 'BAN TOYO PROXES 225/55 R19', 10, 'PCS', 9000000, 90000000, 'POS202412004', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(17, 'SP001', 'LAMPU BELAKANG KIRI', 1, 'PCS', 1000000, 1000000, 'POS202412005', 'T202411013', NULL, 'H 1622 RO', NULL, 1, NULL, NULL),
(18, 'SP002', 'LAMPU BELAKANG KIRI', 1, 'PCS', 2000000, 2000000, 'POS202412006', 'T202411013', NULL, 'H 1622 RO', NULL, 1, NULL, NULL),
(19, 'D09W51730', 'EMBLEM LOGO', 1, 'PCS', 100000, 100000, 'POS202412006', 'T202411013', NULL, 'H 1622 RO', NULL, 1, NULL, NULL),
(20, 'K23050221DBB', 'BAN TOYO PROXES 225/55 R19', 1, 'PCS', 9000000, 9000000, 'POS202412006', 'T202411013', NULL, 'H 1622 RO', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pdetail_repair`
--

CREATE TABLE `pdetail_repair` (
  `id` int(11) NOT NULL,
  `id_kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `qty_B` int(11) DEFAULT NULL,
  `sat_B` varchar(10) DEFAULT NULL,
  `hpp` decimal(15,2) DEFAULT NULL,
  `id_material` varchar(50) NOT NULL,
  `no_repair_order` varchar(50) DEFAULT NULL,
  `no_rangka` varchar(50) DEFAULT NULL,
  `asuransi` varchar(50) DEFAULT NULL,
  `jenis_mobil` varchar(50) DEFAULT NULL,
  `nopol` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pdetail_repair`
--

INSERT INTO `pdetail_repair` (`id`, `id_kode_barang`, `nama_barang`, `qty_B`, `sat_B`, `hpp`, `id_material`, `no_repair_order`, `no_rangka`, `asuransi`, `jenis_mobil`, `nopol`, `created_at`, `updated_at`) VALUES
(18, 'SP001', 'LAMPU BELAKANG KIRI', NULL, NULL, 1000000.00, 'RM2024111111', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'SP001', 'LAMPU BELAKANG KIRI', NULL, NULL, 1000000.00, 'RM2024111112', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'SP001', 'LAMPU BELAKANG KIRI', 1, 'PCS', 1000000.00, 'RM2024110003', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'SP001', 'LAMPU BELAKANG KIRI', 1, 'PCS', 1000000.00, 'RM2024110004', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'SP001', 'LAMPU BELAKANG KIRI', 1, 'PCS', 1000000.00, 'RM2024110005', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pdetail_terima`
--

CREATE TABLE `pdetail_terima` (
  `id` int(11) NOT NULL,
  `id_kode_barang` varchar(125) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `disc` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `no_po` varchar(255) DEFAULT NULL,
  `po_id` varchar(255) DEFAULT NULL,
  `id_penerimaan` varchar(255) NOT NULL,
  `no_repair_order` varchar(50) DEFAULT NULL,
  `nopol` varchar(50) DEFAULT NULL,
  `no_rangka` varchar(50) DEFAULT NULL,
  `asuransi` varchar(50) DEFAULT NULL,
  `jenis_mobil` varchar(50) DEFAULT NULL,
  `supplier` varchar(50) DEFAULT NULL,
  `tgl_terima` date DEFAULT NULL,
  `tgl_pasang` date DEFAULT NULL,
  `is_sent` tinyint(4) NOT NULL DEFAULT 0,
  `is_pasang` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pdetail_terima`
--

INSERT INTO `pdetail_terima` (`id`, `id_kode_barang`, `nama_barang`, `qty`, `satuan`, `harga`, `disc`, `jumlah`, `no_po`, `po_id`, `id_penerimaan`, `no_repair_order`, `nopol`, `no_rangka`, `asuransi`, `jenis_mobil`, `supplier`, `tgl_terima`, `tgl_pasang`, `is_sent`, `is_pasang`, `created_at`, `updated_at`) VALUES
(52, 'D09W51730', 'EMBLEM LOGO', 1, 'PCS', 100000, 11, 89000, 'POS202412003', NULL, 'PC202412001', 'T202411016', 'H 1098 IX', NULL, 'JASA RAHARJA PUTERA', 'KIJANG INNOVA ', 'VIBANIUM', '2024-12-12', NULL, 1, 0, '2024-12-12 14:16:56', '2024-12-12 14:16:56'),
(53, 'D09W51730', 'EMBLEM LOGO', 1, 'PCS', 100000, 11, 89000, 'POS202412003', NULL, 'PC202412002', 'T202411016', 'H 1098 IX', NULL, 'JASA RAHARJA PUTERA', 'KIJANG INNOVA ', 'VIBANIUM', '2024-12-12', NULL, 1, 0, '2024-12-12 14:29:21', '2024-12-12 14:29:21'),
(54, 'D09W51730', 'EMBLEM LOGO', 1, 'PCS', 100000, 11, 89000, 'POS202412003', NULL, 'PC202412003', 'T202411016', 'H 1098 IX', NULL, 'JASA RAHARJA PUTERA', 'KIJANG INNOVA ', 'VIBANIUM', '2024-12-12', NULL, 1, 0, '2024-12-12 14:35:43', '2024-12-12 14:35:43'),
(55, 'D09W51730', 'EMBLEM LOGO', 1, 'PCS', 100000, 11, 89000, 'POS202412003', NULL, 'PC202412004', 'T202411016', 'H 1098 IX', NULL, 'JASA RAHARJA PUTERA', 'KIJANG INNOVA ', 'VIBANIUM', '2024-12-12', NULL, 1, 0, '2024-12-12 14:41:52', '2024-12-12 14:41:52'),
(56, 'K23050221DBB', 'BAN TOYO PROXES 225/55 R19', 1, 'PCS', 9000000, 11, 8010000, 'POS202412003', NULL, 'PC202412004', 'T202411016', 'H 1098 IX', NULL, 'JASA RAHARJA PUTERA', 'KIJANG INNOVA ', 'VIBANIUM', '2024-12-12', NULL, 1, 0, '2024-12-12 14:41:52', '2024-12-12 14:41:52'),
(57, 'SP002', 'LAMPU BELAKANG KIRI', 1, 'PCS', 2000000, 11, 1780000, 'POS202412003', NULL, 'PC202412004', 'T202411016', 'H 1098 IX', NULL, 'JASA RAHARJA PUTERA', 'KIJANG INNOVA ', 'VIBANIUM', '2024-12-12', NULL, 1, 0, '2024-12-12 14:41:52', '2024-12-12 14:41:52'),
(58, 'SP001', 'LAMPU BELAKANG KIRI', 1, 'PCS', 1000000, 11, 890000, 'POS202412005', NULL, 'PC202412005', 'T202411013', 'H 1622 RO', NULL, 'MAG', 'HYUNDAI IONIQ 5', 'VIBANIUM', '2024-12-12', NULL, 1, 0, '2024-12-12 15:00:11', '2024-12-12 15:00:11'),
(59, 'SP002', 'LAMPU BELAKANG KIRI', 1, 'PCS', 2000000, 11, 1780000, 'POS202412006', NULL, 'PC202412006', 'T202411013', 'H 1622 RO', NULL, 'MAG', 'HYUNDAI IONIQ 5', 'BANGUN REDJO', '2024-12-12', '2024-12-12', 1, 1, '2024-12-12 15:02:32', '2024-12-12 15:03:23'),
(60, 'D09W51730', 'EMBLEM LOGO', 1, 'PCS', 100000, 11, 89000, 'POS202412006', NULL, 'PC202412006', 'T202411013', 'H 1622 RO', NULL, 'MAG', 'HYUNDAI IONIQ 5', 'BANGUN REDJO', '2024-12-12', NULL, 1, 0, '2024-12-12 15:02:32', '2024-12-12 15:02:32'),
(61, 'K23050221DBB', 'BAN TOYO PROXES 225/55 R19', 1, 'PCS', 9000000, 11, 8010000, 'POS202412006', NULL, 'PC202412006', 'T202411013', 'H 1622 RO', NULL, 'MAG', 'HYUNDAI IONIQ 5', 'BANGUN REDJO', '2024-12-12', NULL, 1, 0, '2024-12-12 15:02:32', '2024-12-12 15:02:32'),
(62, 'D09W51730', 'EMBLEM LOGO', 1, 'PCS', 100000, 11, 89000, 'POS202412002', NULL, 'PC202412007', 'T202411015', 'H 1982 SY', NULL, 'BCA', 'XPANDER', 'BANGUN REDJO', '2024-12-13', NULL, 1, 0, '2024-12-13 06:44:13', '2024-12-13 06:44:13'),
(63, 'D09W51730', 'EMBLEM LOGO', 1, 'PCS', 100000, 11, 89000, 'POS202412004', NULL, 'PC202412008', 'T202411014', 'H 1714 CZ', NULL, 'ETIQA', 'CX-8', 'VIBANIUM', '2024-12-13', '2024-12-16', 1, 1, '2024-12-13 06:48:25', '2024-12-16 03:16:30'),
(64, 'K23050221DBB', 'BAN TOYO PROXES 225/55 R19', 10, 'PCS', 9000000, 11, 80100000, 'POS202412004', NULL, 'PC202412008', 'T202411014', 'H 1714 CZ', NULL, 'ETIQA', 'CX-8', 'VIBANIUM', '2024-12-13', NULL, 1, 0, '2024-12-13 06:48:25', '2024-12-13 06:48:25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_sparepart`
--
ALTER TABLE `barang_sparepart`
  ADD PRIMARY KEY (`id_part`) USING BTREE,
  ADD UNIQUE KEY `kode_part` (`kode_part`);

--
-- Indeks untuk tabel `part_po`
--
ALTER TABLE `part_po`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `part_repair`
--
ALTER TABLE `part_repair`
  ADD PRIMARY KEY (`id_material`);

--
-- Indeks untuk tabel `part_terima`
--
ALTER TABLE `part_terima`
  ADD PRIMARY KEY (`id_penerimaan`);

--
-- Indeks untuk tabel `pdetail_pesan`
--
ALTER TABLE `pdetail_pesan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pesan` (`id_pesan`),
  ADD KEY `id_kode_barang` (`id_kode_barang`);

--
-- Indeks untuk tabel `pdetail_repair`
--
ALTER TABLE `pdetail_repair`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_material` (`id_material`);

--
-- Indeks untuk tabel `pdetail_terima`
--
ALTER TABLE `pdetail_terima`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penerimaan` (`id_penerimaan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_sparepart`
--
ALTER TABLE `barang_sparepart`
  MODIFY `id_part` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pdetail_pesan`
--
ALTER TABLE `pdetail_pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `pdetail_repair`
--
ALTER TABLE `pdetail_repair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `pdetail_terima`
--
ALTER TABLE `pdetail_terima`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
