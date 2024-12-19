-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Agu 2024 pada 03.44
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
-- Struktur dari tabel `acc_asuransi`
--

CREATE TABLE `acc_asuransi` (
  `id_acc_asuransi` int(11) NOT NULL,
  `id_terima_po` varchar(50) NOT NULL,
  `tgl_acc` date NOT NULL,
  `no_kendaraan` varchar(20) NOT NULL,
  `jenis_mobil` varchar(50) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `no_contact` varchar(20) NOT NULL,
  `tahun_kendaraan` year(4) NOT NULL,
  `asuransi` varchar(100) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_estimasi` date NOT NULL,
  `biaya_jasa` decimal(15,2) NOT NULL,
  `biaya_sparepart` decimal(15,2) NOT NULL,
  `biaya_total` decimal(15,2) NOT NULL,
  `nilai_or` decimal(15,2) NOT NULL,
  `qty_or` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `file_lampiran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `asuransi`
--

CREATE TABLE `asuransi` (
  `id_asuransi` int(11) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `nama_asuransi` varchar(255) DEFAULT NULL,
  `status_member` varchar(50) DEFAULT NULL,
  `kode_alokasi` varchar(50) DEFAULT NULL,
  `kode_group` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kodepos` varchar(20) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `no_hp_whatsapp` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `discount` varchar(128) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `plafond` varchar(128) DEFAULT NULL,
  `max_bill` varchar(128) DEFAULT NULL,
  `customer_pos` varchar(50) DEFAULT NULL,
  `kode_gudang` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_user`
--

CREATE TABLE `auth_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kontak` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth_user`
--

INSERT INTO `auth_user` (`id`, `username`, `password`, `nama_user`, `alamat`, `kontak`, `email`, `status`, `level`, `role`, `created_at`, `updated_at`, `foto`) VALUES
(1, 'ione', '123', 'ione', 'semarang', '0000000', 'aaaa@gmail.com', NULL, NULL, NULL, '2024-07-26 07:31:28', '2024-07-26 23:16:52', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_repair`
--

CREATE TABLE `bahan_repair` (
  `id_material` varchar(50) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_repair` varchar(50) DEFAULT NULL,
  `gudang` varchar(50) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `no_kendaraan` varchar(50) DEFAULT NULL,
  `jenis_mobil` varchar(50) DEFAULT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `nama_pemilik` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total_qty_B` int(11) DEFAULT NULL,
  `total_qty_T` int(11) DEFAULT NULL,
  `total_qty_K` int(11) DEFAULT NULL,
  `total_hpp` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode_group` varchar(50) DEFAULT NULL,
  `sat_B` varchar(50) DEFAULT NULL,
  `isi_B` int(11) DEFAULT NULL,
  `sat_T` varchar(50) DEFAULT NULL,
  `isi_T` int(11) DEFAULT NULL,
  `sat_K` varchar(50) DEFAULT NULL,
  `stok_minimal` int(11) DEFAULT NULL,
  `stok_maksimal` int(11) DEFAULT NULL,
  `harga_beli` varchar(128) DEFAULT NULL,
  `harga_jual` varchar(128) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tgl` datetime DEFAULT current_timestamp(),
  `kode_kategori` varchar(50) DEFAULT NULL,
  `nama_kategori` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `periode` varchar(50) DEFAULT NULL,
  `upd` varchar(50) DEFAULT NULL,
  `hargabeli_B` varchar(128) DEFAULT NULL,
  `hargabeli_T` varchar(128) DEFAULT NULL,
  `hargajual_B` varchar(128) DEFAULT NULL,
  `hargajual_T` varchar(128) DEFAULT NULL,
  `aktif` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `kode`, `nama`, `kode_group`, `sat_B`, `isi_B`, `sat_T`, `isi_T`, `sat_K`, `stok_minimal`, `stok_maksimal`, `harga_beli`, `harga_jual`, `user_id`, `tgl`, `kode_kategori`, `nama_kategori`, `stok`, `tahun`, `periode`, `upd`, `hargabeli_B`, `hargabeli_T`, `hargajual_B`, `hargajual_T`, `aktif`) VALUES
(1, 'SP001', 'Valve TPMS', 'GRP1', 'PCS', 10, 'BOX', 100, 'KAR', 50, 200, '15000', '20000', 1, '2024-08-03 00:00:00', 'CAT1', 'Sparepart', 150, 2024, '01', '2024-08-03', '14000', '14500', '19500', '20500', 1),
(2, 'SP002', 'Tutup Whelldoff', 'GRP1', 'PCS', 20, 'BOX', 200, 'KAR', 30, 150, '12000', '18000', 1, '2024-08-03 00:00:00', 'CAT1', 'Sparepart', 100, 2024, '02', '2024-08-03', '11500', '11800', '17500', '18500', 1),
(3, 'SP003', 'Foglamp Kiri', 'GRP1', 'PCS', 15, 'BOX', 150, 'KAR', 40, 160, '13000', '19000', 2, '2024-08-03 00:00:00', 'CAT1', 'Sparepart', 120, 2024, '03', '2024-08-03', '12500', '12800', '18500', '19500', 1),
(4, 'SP004', 'Bracket Bumper Depan Kanan', 'GRP1', 'PCS', 12, 'BOX', 120, 'KAR', 60, 250, '17000', '22000', 3, '2024-08-03 00:00:00', 'CAT1', 'Sparepart', 140, 2024, '04', '2024-08-03', '16000', '16500', '21500', '22500', 1),
(5, 'SP005', 'Brake Pad Set', 'GRP2', 'PCS', 10, 'BOX', 100, 'KAR', 50, 200, '15000', '20000', 1, '2024-08-03 00:00:00', 'CAT2', 'Sparepart', 150, 2024, '05', '2024-08-03', '14000', '14500', '19500', '20500', 1),
(6, 'SP006', 'Oil Filter', 'GRP2', 'PCS', 20, 'BOX', 200, 'KAR', 30, 150, '12000', '18000', 1, '2024-08-03 00:00:00', 'CAT2', 'Sparepart', 100, 2024, '06', '2024-08-03', '11500', '11800', '17500', '18500', 1),
(7, 'SP007', 'Air Filter', 'GRP2', 'PCS', 15, 'BOX', 150, 'KAR', 40, 160, '13000', '19000', 2, '2024-08-03 00:00:00', 'CAT2', 'Sparepart', 120, 2024, '07', '2024-08-03', '12500', '12800', '18500', '19500', 1),
(8, 'SP008', 'Headlamp Assy', 'GRP2', 'PCS', 12, 'BOX', 120, 'KAR', 60, 250, '17000', '22000', 3, '2024-08-03 00:00:00', 'CAT2', 'Sparepart', 140, 2024, '08', '2024-08-03', '16000', '16500', '21500', '22500', 1),
(9, 'SP009', 'Wiper Blade', 'GRP3', 'PCS', 10, 'BOX', 100, 'KAR', 50, 200, '15000', '20000', 1, '2024-08-03 00:00:00', 'CAT3', 'Sparepart', 150, 2024, '09', '2024-08-03', '14000', '14500', '19500', '20500', 1),
(10, 'SP010', 'Radiator Hose', 'GRP3', 'PCS', 20, 'BOX', 200, 'KAR', 30, 150, '12000', '18000', 1, '2024-08-03 00:00:00', 'CAT3', 'Sparepart', 100, 2024, '10', '2024-08-03', '11500', '11800', '17500', '18500', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangalokasi`
--

CREATE TABLE `barangalokasi` (
  `id_alokasi` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kode_perkiraan` varchar(50) DEFAULT NULL,
  `kode_alokasi` varchar(50) DEFAULT NULL,
  `nama_alokasi` varchar(255) DEFAULT NULL,
  `keterangan_alokasi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `baranggroup`
--

CREATE TABLE `baranggroup` (
  `id_group` int(11) NOT NULL,
  `kodegroup` varchar(50) NOT NULL,
  `kodekategori` varchar(50) DEFAULT NULL,
  `kodeperkiraan` varchar(50) DEFAULT NULL,
  `namagroup` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangkategori`
--

CREATE TABLE `barangkategori` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `stok` decimal(10,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `coa`
--

CREATE TABLE `coa` (
  `id_coa` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama_account` varchar(255) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `kode_head` varchar(50) DEFAULT NULL,
  `kelompok` varchar(50) DEFAULT NULL,
  `posisi` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaksi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('1122', '112ww', 11, 'LT', 2000000.00, 22000000.00, 1, 1, NULL, NULL, 'PO20240808006'),
('12qq', 'qqwq', 11, 'LT', 1000000.00, 11000000.00, 1, 1, NULL, NULL, 'PO20240808006'),
('asd', 'ads', 1, '1', 1.00, 1.00, 1, 1, NULL, NULL, 'PO20240802003'),
('asd', 'ad', 1, '1', 1000000.00, 1000000.00, 0, 1, NULL, NULL, 'PO20240803004'),
('K222', 'LAMPU DEPAN KIRI', 1, 'PCS', 45000000.00, 45000000.00, 1, 0, NULL, NULL, 'PO20240801002'),
('Q112', 'FELG DEPAN KIRI', 1, 'PCS', 734000000.00, 734000000.00, 1, 0, NULL, NULL, 'PO20240801002'),
('SP001', 'Valve TPMS', 111, 'LT', 14000.00, 1554000.00, 1, 1, NULL, NULL, 'PO20240808007'),
('SP001', 'Valve TPMS', 12, 'LT', 14000.00, 168000.00, 1, 1, NULL, NULL, 'PO20240808008'),
('SP001', 'Valve TPMS', 11, 'PCS', 14000.00, 154000.00, 1, 1, NULL, NULL, 'PO20240808009'),
('SP002', 'Tutup Whelldoff', 111, 'LT', 11500.00, 1276500.00, 1, 1, NULL, NULL, 'PO20240808007'),
('SP002', 'Tutup Whelldoff', 1, 'PCS', 11500.00, 11500.00, 1, 1, NULL, NULL, 'PO20240808009'),
('SP003', 'Foglamp Kiri', 11, 'LT', 12500.00, 137500.00, 1, 1, NULL, NULL, 'PO20240808007'),
('SP003', 'Foglamp Kiri', 12, 'LT', 12500.00, 150000.00, 1, 1, NULL, NULL, 'PO20240808008'),
('SP003', 'Foglamp Kiri', 22, 'PCS', 12500.00, 275000.00, 1, 1, NULL, NULL, 'PO20240808009'),
('T000', 'Kaca depan', 1, 'PCS', 20000000.00, 20000000.00, 1, 0, NULL, NULL, 'PO20240801002'),
('T000', 'qwe', 1, '1', 1000000.00, 1000000.00, 1, 1, NULL, NULL, 'PO20240803005'),
('T123', 'wqe', 111, '11', 1000000.00, 111000000.00, 11, 1, NULL, NULL, 'PO20240803005');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_repair`
--

CREATE TABLE `detail_repair` (
  `id_kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `qty_B` int(11) DEFAULT NULL,
  `sat_B` varchar(20) DEFAULT NULL,
  `qty_T` int(11) DEFAULT NULL,
  `sat_T` varchar(20) DEFAULT NULL,
  `qty_K` int(11) DEFAULT NULL,
  `sat_K` varchar(20) DEFAULT NULL,
  `hpp` decimal(18,2) DEFAULT NULL,
  `nilai` varchar(225) DEFAULT NULL,
  `id_material` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar_po`
--

CREATE TABLE `gambar_po` (
  `id_gambar_po` int(11) NOT NULL,
  `id_terima_po` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` int(11) NOT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `gudangpos` varchar(50) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `contactperson` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jasa`
--

CREATE TABLE `jasa` (
  `id_jasa` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama_jasa` varchar(255) NOT NULL,
  `kode_biaya` varchar(50) DEFAULT NULL,
  `ket_biaya` varchar(255) DEFAULT NULL,
  `kode_alokasi` varchar(50) DEFAULT NULL,
  `ket_alokasi` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_mobil`
--

CREATE TABLE `jenis_mobil` (
  `id_jenis_mobil` int(11) NOT NULL,
  `jenis_mobil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_mobil`
--

INSERT INTO `jenis_mobil` (`id_jenis_mobil`, `jenis_mobil`) VALUES
(1, 'xenia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `no_kendaraan` varchar(50) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `no_contact` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `no_kendaraan`, `customer_name`, `no_contact`) VALUES
(1, '1111111', 'affa', '08222222222'),
(2, 'k 9292 h', 'affa', '08222222222');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengerjaan`
--

CREATE TABLE `pengerjaan` (
  `id_pengerjaan` int(11) NOT NULL,
  `kode_pengerjaan` varchar(50) NOT NULL,
  `nama_pengerjaan` varchar(255) NOT NULL,
  `keterangan_pengerjaan` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengerjaan_po`
--

CREATE TABLE `pengerjaan_po` (
  `id_pengerjaan_po` int(11) NOT NULL,
  `kode_pengerjaan` varchar(50) NOT NULL,
  `nama_pengerjaan` varchar(255) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `id_terima_po` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `po`
--

CREATE TABLE `po` (
  `id_po` varchar(255) NOT NULL,
  `id_terima_po` varchar(255) DEFAULT NULL,
  `tgl_klaim` date DEFAULT NULL,
  `tgl_acc` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `progres` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `harga_estimasi` decimal(15,2) DEFAULT NULL,
  `harga_acc` decimal(15,2) DEFAULT NULL,
  `no_kendaraan` varchar(50) DEFAULT NULL,
  `jenis_mobil` varchar(255) DEFAULT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `no_polis` varchar(50) DEFAULT NULL,
  `no_rangka` varchar(50) DEFAULT NULL,
  `tahun_kendaraan` year(4) DEFAULT NULL,
  `no_contact` varchar(50) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `asuransi` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `id_kendaraan` int(11) DEFAULT NULL,
  `biaya_pengerjaan` decimal(15,2) DEFAULT 0.00,
  `biaya_sparepart` decimal(15,2) DEFAULT 0.00,
  `total_biaya` decimal(15,2) GENERATED ALWAYS AS (`biaya_pengerjaan` + `biaya_sparepart`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `po`
--

INSERT INTO `po` (`id_po`, `id_terima_po`, `tgl_klaim`, `tgl_acc`, `status`, `progres`, `user_id`, `harga_estimasi`, `harga_acc`, `no_kendaraan`, `jenis_mobil`, `warna`, `no_polis`, `no_rangka`, `tahun_kendaraan`, `no_contact`, `customer_name`, `alamat`, `kota`, `asuransi`, `keterangan`, `id_kendaraan`, `biaya_pengerjaan`, `biaya_sparepart`) VALUES
('PO20240726001', 'T20240726001', '2024-07-26', NULL, 'Pre-Order', 'Proses Klaim', 1, 4000000.00, NULL, 'k 9292 h', 'xenia', 'merah', '00010101', '1000101010', '2019', '08222222222', 'affa', 'smg', 'smg', 'bca', '', NULL, 0.00, 0.00);

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
('PO20240801002', '2024-08-01', 'PT. MAJU MUNDIR', '2024-08-09', 'TEST', 'T101010', 'BNI INSURANCE', 'SKYLINE GTR-34', '', 'FIKRI', 'K 1234 KK', 3, 799000000.00),
('PO20240802003', '2024-08-02', 'sada', '2024-09-06', 'asd', 'asda', 'asd', 'asdasdasd', '', 'asd', 'asd', 1, 1.00),
('PO20240803004', '2024-08-03', 'asdasd', '2024-08-06', 'asd', 'asdas', 'asd', 'asdasd', '', 'asd', 'asd', 2, 1011111.00),
('PO20240803005', '2024-08-03', 'asd', '2024-08-22', 'as', 'asd', 'asdasd', 'asdasd', '', 'asdasd', 'asd', 112, 112000000.00),
('PO20240808006', '2024-08-08', 'asdasd', '0000-00-00', 'asdasd', 'asda', 'as', 'sad', '', 'asdasd', 'asd', 22, 33000000.00),
('PO20240808007', '2024-08-08', '', '0000-00-00', '', '', '', '', '', '', '', 233, 2968000.00),
('PO20240808008', '2024-08-08', 'asdasd', '2024-08-15', 'asd', 'asdasd', 'asdad', 'asd', '', 'asda', 'ASD', 24, 318000.00),
('PO20240808009', '2024-08-08', '', '0000-00-00', '', '', '', '', '', '', '', 34, 440500.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `salesman`
--

CREATE TABLE `salesman` (
  `id_salesman` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `target` decimal(15,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sparepart_po`
--

CREATE TABLE `sparepart_po` (
  `id_sparepart_po` int(11) NOT NULL,
  `id_terima_po` varchar(255) NOT NULL,
  `kode_sparepart` varchar(50) DEFAULT NULL,
  `nama_sparepart` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` decimal(15,2) DEFAULT NULL,
  `kode_pengerjaan` varchar(50) DEFAULT NULL,
  `jenis_part` enum('NON-SUPPLY','SUPPLY','BORONG','TIDAK JADI GANTI') DEFAULT NULL,
  `total_qty` int(11) DEFAULT 0,
  `total_harga` decimal(15,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contactperson` varchar(100) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `rekening` varchar(50) DEFAULT NULL,
  `term` varchar(50) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `inisial` varchar(10) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `kode`, `nama`, `alamat`, `email`, `contactperson`, `telp`, `kota`, `fax`, `hp`, `rekening`, `term`, `npwp`, `status`, `inisial`, `keterangan`, `user_id`) VALUES
(1, '005', 'CV ABADI JAYA (GLITZERN)', '-', 'fssgd@gmail.com', '-', '-', 'smg', '-', '-', '-', NULL, '-', '-', '-', '-', 1),
(2, '001', 'asd', 'smg@g.com', '', '', '', 'smg', '', '', 'KWOK JUNUS C : 8545207377', NULL, '', 'NORMAL', '', '', 1),
(3, '015', 'HANINDA EKA MUDA (THINER)', 'asd', 'jugalupa@gmail.com', '', '', 'SEMARANG', '', '', 'STEVEN WILLIAM, BCA : 7830385015', NULL, '', 'NORMAL', '', '', 1);

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `warna`
--

CREATE TABLE `warna` (
  `id_warna` int(11) NOT NULL,
  `kode_warna` varchar(50) NOT NULL,
  `warna` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `warna`
--

INSERT INTO `warna` (`id_warna`, `kode_warna`, `warna`) VALUES
(1, '', 'merah');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `asuransi`
--
ALTER TABLE `asuransi`
  ADD PRIMARY KEY (`id_asuransi`);

--
-- Indeks untuk tabel `auth_user`
--
ALTER TABLE `auth_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `bahan_repair`
--
ALTER TABLE `bahan_repair`
  ADD PRIMARY KEY (`id_material`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `barangalokasi`
--
ALTER TABLE `barangalokasi`
  ADD PRIMARY KEY (`id_alokasi`);

--
-- Indeks untuk tabel `baranggroup`
--
ALTER TABLE `baranggroup`
  ADD PRIMARY KEY (`id_group`);

--
-- Indeks untuk tabel `barangkategori`
--
ALTER TABLE `barangkategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`id_coa`);

--
-- Indeks untuk tabel `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD PRIMARY KEY (`id_kode_barang`,`id_po_bahan`),
  ADD KEY `id_po_bahan` (`id_po_bahan`);

--
-- Indeks untuk tabel `detail_repair`
--
ALTER TABLE `detail_repair`
  ADD PRIMARY KEY (`id_kode_barang`,`id_material`) USING BTREE,
  ADD KEY `id_material` (`id_material`);

--
-- Indeks untuk tabel `detail_terima`
--
ALTER TABLE `detail_terima`
  ADD PRIMARY KEY (`id_penerimaan`,`id_kode_barang`) USING BTREE,
  ADD KEY `id_kode_barang` (`id_penerimaan`) USING BTREE;

--
-- Indeks untuk tabel `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`);

--
-- Indeks untuk tabel `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id_jasa`);

--
-- Indeks untuk tabel `jenis_mobil`
--
ALTER TABLE `jenis_mobil`
  ADD PRIMARY KEY (`id_jenis_mobil`);

--
-- Indeks untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indeks untuk tabel `pengerjaan`
--
ALTER TABLE `pengerjaan`
  ADD PRIMARY KEY (`id_pengerjaan`);

--
-- Indeks untuk tabel `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`id_po`);

--
-- Indeks untuk tabel `po_bahan`
--
ALTER TABLE `po_bahan`
  ADD PRIMARY KEY (`id_po_bahan`);

--
-- Indeks untuk tabel `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`id_salesman`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `terima_bahan`
--
ALTER TABLE `terima_bahan`
  ADD PRIMARY KEY (`id_penerimaan`);

--
-- Indeks untuk tabel `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`id_warna`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `asuransi`
--
ALTER TABLE `asuransi`
  MODIFY `id_asuransi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_user`
--
ALTER TABLE `auth_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `barangalokasi`
--
ALTER TABLE `barangalokasi`
  MODIFY `id_alokasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `baranggroup`
--
ALTER TABLE `baranggroup`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `barangkategori`
--
ALTER TABLE `barangkategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `coa`
--
ALTER TABLE `coa`
  MODIFY `id_coa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id_gudang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id_jasa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_mobil`
--
ALTER TABLE `jenis_mobil`
  MODIFY `id_jenis_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengerjaan`
--
ALTER TABLE `pengerjaan`
  MODIFY `id_pengerjaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `salesman`
--
ALTER TABLE `salesman`
  MODIFY `id_salesman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `warna`
--
ALTER TABLE `warna`
  MODIFY `id_warna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD CONSTRAINT `detail_barang_ibfk_1` FOREIGN KEY (`id_po_bahan`) REFERENCES `po_bahan` (`id_po_bahan`);

--
-- Ketidakleluasaan untuk tabel `detail_repair`
--
ALTER TABLE `detail_repair`
  ADD CONSTRAINT `detail_repair_ibfk_1` FOREIGN KEY (`id_material`) REFERENCES `bahan_repair` (`id_material`);

--
-- Ketidakleluasaan untuk tabel `detail_terima`
--
ALTER TABLE `detail_terima`
  ADD CONSTRAINT `detail_terima_ibfk_1` FOREIGN KEY (`id_penerimaan`) REFERENCES `terima_bahan` (`id_penerimaan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
