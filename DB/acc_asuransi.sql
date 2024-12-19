-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Agu 2024 pada 06.10
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
-- Struktur dari tabel `acc_asuransi`
--

CREATE TABLE `acc_asuransi` (
  `id_acc_asuransi` int NOT NULL,
  `id_terima_po` varchar(50) NOT NULL,
  `tgl_acc` date NOT NULL,
  `no_kendaraan` varchar(20) NOT NULL,
  `jenis_mobil` varchar(50) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `no_contact` varchar(20) NOT NULL,
  `tahun_kendaraan` year NOT NULL,
  `asuransi` varchar(100) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_estimasi` date NOT NULL,
  `biaya_jasa` decimal(15,2) NOT NULL,
  `biaya_sparepart` decimal(15,2) NOT NULL,
  `biaya_total` decimal(15,2) NOT NULL,
  `nilai_or` decimal(15,2) NOT NULL,
  `qty_or` int NOT NULL,
  `keterangan` text,
  `file_lampiran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `acc_asuransi`
--

INSERT INTO `acc_asuransi` (`id_acc_asuransi`, `id_terima_po`, `tgl_acc`, `no_kendaraan`, `jenis_mobil`, `warna`, `customer_name`, `no_contact`, `tahun_kendaraan`, `asuransi`, `tgl_masuk`, `tgl_estimasi`, `biaya_jasa`, `biaya_sparepart`, `biaya_total`, `nilai_or`, `qty_or`, `keterangan`, `file_lampiran`) VALUES
(11, 'T202408001', '2024-08-10', 'KH 7776 PP', 'Mitsubishi Ayla', 'Putih Metalic', 'Jennifer Colw', '085621983722', 2022, 'JASINDO INSURANCE', '2024-08-08', '0000-00-00', '1000000.00', '1500000.00', '2500000.00', '1250000.00', 1, '', NULL);

--
-- Trigger `acc_asuransi`
--
DELIMITER $$
CREATE TRIGGER `before_acc_asuransi_insert` BEFORE INSERT ON `acc_asuransi` FOR EACH ROW BEGIN
    SET NEW.biaya_total = NEW.biaya_jasa + NEW.biaya_sparepart;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_acc_asuransi_update` BEFORE UPDATE ON `acc_asuransi` FOR EACH ROW BEGIN
    SET NEW.biaya_total = NEW.biaya_jasa + NEW.biaya_sparepart;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `acc_asuransi`
--
ALTER TABLE `acc_asuransi`
  ADD PRIMARY KEY (`id_acc_asuransi`),
  ADD KEY `fk_acc_asuransis_id_terima_po` (`id_terima_po`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `acc_asuransi`
--
ALTER TABLE `acc_asuransi`
  MODIFY `id_acc_asuransi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `acc_asuransi`
--
ALTER TABLE `acc_asuransi`
  ADD CONSTRAINT `fk_acc_asuransis_id_terima_po` FOREIGN KEY (`id_terima_po`) REFERENCES `po` (`id_terima_po`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
