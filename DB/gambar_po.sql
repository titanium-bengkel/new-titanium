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
-- Struktur dari tabel `gambar_po`
--

CREATE TABLE `gambar_po` (
  `id_gambar_po` int NOT NULL,
  `id_terima_po` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `gambar_po`
--

INSERT INTO `gambar_po` (`id_gambar_po`, `id_terima_po`, `keterangan`, `gambar`, `deskripsi`, `created_at`, `updated_at`) VALUES
(12, 'T202408001', 'Sebelum', '1723099906_ecd561f2571a5d77c6f3.jpeg', '', '2024-08-07 23:51:46', '2024-08-07 23:51:46');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gambar_po`
--
ALTER TABLE `gambar_po`
  ADD PRIMARY KEY (`id_gambar_po`),
  ADD KEY `id_terima_po` (`id_terima_po`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gambar_po`
--
ALTER TABLE `gambar_po`
  MODIFY `id_gambar_po` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `gambar_po`
--
ALTER TABLE `gambar_po`
  ADD CONSTRAINT `gambar_po_ibfk_1` FOREIGN KEY (`id_terima_po`) REFERENCES `po` (`id_terima_po`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
