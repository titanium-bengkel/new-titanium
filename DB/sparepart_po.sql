-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Agu 2024 pada 06.11
-- Versi server: 8.0.30
-- Versi PHP: 7.4.33

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
-- Struktur dari tabel `sparepart_po`
--

CREATE TABLE `sparepart_po` (
  `id_sparepart_po` int NOT NULL,
  `id_terima_po` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kode_sparepart` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_sparepart` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `harga` decimal(15,2) DEFAULT NULL,
  `kode_pengerjaan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenis_part` enum('NON-SUPPLY','SUPPLY','BORONG','TIDAK JADI GANTI') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `total_qty` int DEFAULT '0',
  `total_harga` decimal(15,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `sparepart_po`
--

INSERT INTO `sparepart_po` (`id_sparepart_po`, `id_terima_po`, `kode_sparepart`, `nama_sparepart`, `qty`, `harga`, `kode_pengerjaan`, `jenis_part`, `total_qty`, `total_harga`, `created_at`, `updated_at`) VALUES
(33, 'T202408001', 'SP004', 'Bracket Bumper Depan Kanan', 2, '1600000.00', 'J0007', 'NON-SUPPLY', 2, '3200000.00', '2024-08-07 23:51:32', '2024-08-07 23:51:32'),
(34, 'T202408001', 'SP004', 'Bracket Bumper Depan Kanan', 2, '1600000.00', 'J0007', 'NON-SUPPLY', 2, '3200000.00', '2024-08-07 23:51:33', '2024-08-07 23:51:33');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `sparepart_po`
--
ALTER TABLE `sparepart_po`
  ADD PRIMARY KEY (`id_sparepart_po`),
  ADD KEY `id_terima_po` (`id_terima_po`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `sparepart_po`
--
ALTER TABLE `sparepart_po`
  MODIFY `id_sparepart_po` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `sparepart_po`
--
ALTER TABLE `sparepart_po`
  ADD CONSTRAINT `sparepart_po_ibfk_1` FOREIGN KEY (`id_terima_po`) REFERENCES `po` (`id_terima_po`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
