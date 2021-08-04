-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Bulan Mei 2021 pada 09.18
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tdsdb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `relaydb`
--

CREATE TABLE `relaydb` (
  `id` int(11) NOT NULL,
  `nutrisia` varchar(11) NOT NULL,
  `nutrisib` varchar(11) NOT NULL,
  `air` varchar(11) NOT NULL,
  `pengaduk` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `relaydb`
--

INSERT INTO `relaydb` (`id`, `nutrisia`, `nutrisib`, `air`, `pengaduk`) VALUES
(1, '1', '0', '0', '0'),
(2, 'ON', 'ON', 'OFF', 'ON');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tds_riwayat`
--

CREATE TABLE `tds_riwayat` (
  `id` int(11) NOT NULL,
  `id_user` varchar(300) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `tds_value1` int(11) NOT NULL,
  `pompa_air` varchar(11) NOT NULL,
  `pompa_nuta` varchar(11) NOT NULL,
  `pompa_nutb` varchar(11) NOT NULL,
  `pompa_pengaduk` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tds_riwayat`
--

INSERT INTO `tds_riwayat` (`id`, `id_user`, `tanggal`, `waktu`, `tds_value1`, `pompa_air`, `pompa_nuta`, `pompa_nutb`, `pompa_pengaduk`) VALUES
(8, '16', '2021-03-25', '22:17:06', 1200, 'OFF', 'OFF', 'ON', 'ON'),
(9, '16', '2021-03-25', '40:23:27', 1600, 'ON', 'OFF', 'OFF', 'ON');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tds_riwayat2`
--

CREATE TABLE `tds_riwayat2` (
  `id` int(11) NOT NULL,
  `id_user` varchar(30) NOT NULL,
  `tanggal2` date NOT NULL,
  `waktu2` time(6) NOT NULL,
  `tds_value2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tds_riwayat2`
--

INSERT INTO `tds_riwayat2` (`id`, `id_user`, `tanggal2`, `waktu2`, `tds_value2`) VALUES
(1, 'ifa', '2021-03-25', '27:12:48.000000', 900),
(2, 'ifa', '2021-03-29', '18:51:33.000000', 1200),
(3, 'ifa', '2021-03-29', '18:28:34.000000', 1450);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `username` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nama` varchar(300) NOT NULL,
  `token` varchar(300) NOT NULL,
  `aktif` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `nama`, `token`, `aktif`) VALUES
(16, 'saya', '', '650feb326abade613932b862af8c85d2', 'saya', 'd200843377c6c9aebad3d04f056304ca5b6558ec5dd929e6e667b7fd9e06f359', '1'),
(20, 'hulala', '', 'a56bc4c94abdc0ec3545cfba6e0b68cf', 'hulala', 'ecee0ecebda0132658b4342e21149ee5e210922c4d9a4482c4f9604cc5f5b35d', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `relaydb`
--
ALTER TABLE `relaydb`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tds_riwayat`
--
ALTER TABLE `tds_riwayat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tds_riwayat2`
--
ALTER TABLE `tds_riwayat2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `relaydb`
--
ALTER TABLE `relaydb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tds_riwayat`
--
ALTER TABLE `tds_riwayat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tds_riwayat2`
--
ALTER TABLE `tds_riwayat2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
