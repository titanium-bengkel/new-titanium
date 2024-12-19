-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Agu 2024 pada 06.19
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
-- Struktur dari tabel `po`
--

CREATE TABLE `po` (
  `id_po` varchar(255) NOT NULL,
  `id_terima_po` varchar(255) DEFAULT NULL,
  `tgl_klaim` date NOT NULL,
  `tgl_acc` date DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `progres` varchar(50) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `harga_estimasi` decimal(15,2) DEFAULT NULL,
  `harga_acc` decimal(15,2) DEFAULT NULL,
  `no_kendaraan` varchar(20) NOT NULL,
  `jenis_mobil` varchar(50) NOT NULL,
  `warna` varchar(30) NOT NULL,
  `no_polis` varchar(30) NOT NULL,
  `no_rangka` varchar(50) NOT NULL,
  `tahun_kendaraan` int NOT NULL,
  `no_contact` varchar(20) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(50) NOT NULL,
  `asuransi` varchar(100) NOT NULL,
  `keterangan` text,
  `id_kendaraan` int DEFAULT NULL,
  `biaya_pengerjaan` decimal(15,2) DEFAULT '0.00',
  `biaya_sparepart` decimal(15,2) DEFAULT '0.00',
  `total_biaya` decimal(15,2) GENERATED ALWAYS AS ((`biaya_pengerjaan` + `biaya_sparepart`)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `po`
--

INSERT INTO `po` (`id_po`, `id_terima_po`, `tgl_klaim`, `tgl_acc`, `status`, `progres`, `user_id`, `harga_estimasi`, `harga_acc`, `no_kendaraan`, `jenis_mobil`, `warna`, `no_polis`, `no_rangka`, `tahun_kendaraan`, `no_contact`, `customer_name`, `alamat`, `kota`, `asuransi`, `keterangan`, `id_kendaraan`, `biaya_pengerjaan`, `biaya_sparepart`) VALUES
('PO202408001', 'T202408001', '2024-08-08', NULL, 'Acc Asuransi', 'Menunggu Supply', '8', '7900000.00', NULL, 'KH 7776 PP', 'Mitsubishi Ayla', 'Putih Metalic', '445833137999', '13134565', 2022, '085621983722', 'Jennifer Colw', 'Semarang', 'Kota Semarang', 'JASINDO INSURANCE', '', NULL, '1500000.00', '6400000.00'),
('PO202408002', 'T202408002', '2024-08-17', NULL, 'Pre-Order', 'Proses Klaim', '8', NULL, NULL, 'B 9964 PK', 'Mitsubishi Ayla', 'Putih Metalic', '552738166288', '097399927772', 2022, '08768098656', 'Aditya Anugrah', 'Semendawai II', 'Palembang', 'Umum/Pribadi', '', NULL, '0.00', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`id_po`),
  ADD KEY `fk_kendaraan` (`id_kendaraan`),
  ADD KEY `idx_id_terima_po` (`id_terima_po`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `po`
--
ALTER TABLE `po`
  ADD CONSTRAINT `fk_kendaraan` FOREIGN KEY (`id_kendaraan`) REFERENCES `kendaraan` (`id_kendaraan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
