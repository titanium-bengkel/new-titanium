-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 26 Jul 2024 pada 07.26
-- Versi server: 10.11.7-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supe_dev_titanium`
--

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode_group` varchar(50) DEFAULT NULL,
  `sat_B` varchar(20) DEFAULT NULL,
  `isi_B` decimal(10,2) DEFAULT NULL,
  `sat_T` varchar(20) DEFAULT NULL,
  `isi_T` decimal(10,2) DEFAULT NULL,
  `sat_K` varchar(20) DEFAULT NULL,
  `stok_minimal` decimal(10,2) DEFAULT NULL,
  `stok_maksimal` decimal(10,2) DEFAULT NULL,
  `harga_beli` decimal(15,2) DEFAULT NULL,
  `harga_jual` decimal(15,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `kode_kategori` varchar(50) DEFAULT NULL,
  `nama_kategori` varchar(255) DEFAULT NULL,
  `stok` decimal(10,2) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `periode` varchar(20) DEFAULT NULL,
  `upd` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `hargabeli_B` decimal(15,2) DEFAULT NULL,
  `hargabeli_T` decimal(15,2) DEFAULT NULL,
  `hargajual_B` decimal(15,2) DEFAULT NULL,
  `hargajual_T` decimal(15,2) DEFAULT NULL,
  `aktif` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Struktur dari tabel `po`
--

CREATE TABLE `po` (
  `id_po` int(11) NOT NULL,
  `id_terima_po` int(11) DEFAULT NULL,
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
  `id_kendaraan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_jenis_mobil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengerjaan`
--
ALTER TABLE `pengerjaan`
  MODIFY `id_pengerjaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `po`
--
ALTER TABLE `po`
  MODIFY `id_po` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `salesman`
--
ALTER TABLE `salesman`
  MODIFY `id_salesman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `warna`
--
ALTER TABLE `warna`
  MODIFY `id_warna` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
