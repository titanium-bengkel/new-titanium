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
-- Struktur dari tabel `pengerjaan_po`
--

CREATE TABLE `pengerjaan_po` (
  `id_pengerjaan_po` int NOT NULL,
  `kode_pengerjaan` varchar(50) NOT NULL,
  `nama_pengerjaan` varchar(255) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `id_terima_po` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pengerjaan_po`
--

INSERT INTO `pengerjaan_po` (`id_pengerjaan_po`, `kode_pengerjaan`, `nama_pengerjaan`, `harga`, `total_harga`, `id_terima_po`) VALUES
(30, 'J0007', 'B/P ANTENNA', '1500000.00', '1500000.00', 'T202408001');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengerjaan_po`
--
ALTER TABLE `pengerjaan_po`
  ADD PRIMARY KEY (`id_pengerjaan_po`),
  ADD KEY `fk_id_terima_po` (`id_terima_po`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengerjaan_po`
--
ALTER TABLE `pengerjaan_po`
  MODIFY `id_pengerjaan_po` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pengerjaan_po`
--
ALTER TABLE `pengerjaan_po`
  ADD CONSTRAINT `fk_id_terima_po` FOREIGN KEY (`id_terima_po`) REFERENCES `po` (`id_terima_po`),
  ADD CONSTRAINT `pengerjaan_po_ibfk_1` FOREIGN KEY (`id_terima_po`) REFERENCES `po` (`id_terima_po`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
