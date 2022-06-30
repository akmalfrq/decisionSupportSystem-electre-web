-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Jun 2022 pada 08.49
-- Versi server: 8.0.28
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rumahrakyat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int NOT NULL,
  `kode` char(3) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `tipe` enum('cost','benefit') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bobot` float NOT NULL,
  `jenis_input` enum('langsung','pilihan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode`, `nama`, `tipe`, `bobot`, `jenis_input`) VALUES
(9, 'C1', 'Kondisi Material Atap', 'cost', 25, 'langsung'),
(10, 'C2', 'Kondisi Dinding', 'cost', 25, 'langsung'),
(11, 'C3', 'Kondisi Lantai', 'cost', 20, 'langsung'),
(12, 'C4', 'Pekerjaan', 'cost', 15, 'langsung'),
(13, 'C5', 'Aspek Utilitas', 'cost', 15, 'langsung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id` int NOT NULL,
  `id_pemohon` int NOT NULL,
  `id_kriteria` int NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id`, `id_pemohon`, `id_kriteria`, `nilai`) VALUES
(23, 15, 9, 2),
(24, 15, 10, 2),
(25, 15, 11, 2),
(26, 15, 12, 3),
(27, 15, 13, 2),
(28, 16, 9, 3),
(29, 16, 10, 3),
(30, 16, 11, 2),
(31, 16, 12, 2),
(32, 16, 13, 1),
(33, 17, 9, 1),
(34, 17, 10, 1),
(35, 17, 11, 2),
(36, 17, 12, 2),
(37, 17, 13, 1),
(38, 18, 9, 3),
(39, 18, 10, 4),
(40, 18, 11, 2),
(41, 18, 12, 3),
(42, 18, 13, 2),
(43, 19, 9, 1),
(44, 19, 10, 2),
(45, 19, 11, 2),
(46, 19, 12, 4),
(47, 19, 13, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemohon`
--

CREATE TABLE `pemohon` (
  `id` int NOT NULL,
  `no_urut` varchar(3) NOT NULL,
  `kk` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `email` varchar(32) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `id_periode` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pemohon`
--

INSERT INTO `pemohon` (`id`, `no_urut`, `kk`, `nik`, `nama`, `email`, `no_hp`, `alamat`, `id_periode`) VALUES
(15, 'A1', '3214011100220005', '3214015647289009', 'Asep', 'asep@asep.com', '08191839201', 'Jl. Ipik Gandamanah', '2'),
(16, 'A2', '3214010989340009', '3214010812450007', 'Budiawan', 'budi@budi.com', '08329203939', 'Jl. Veteran', '2'),
(17, 'A3', '3214010906980006', '3214010810280007', 'Cecep Sukma', 'cecep@cep.com', '08983928393', 'Jl. Basuki Rahmat', '2'),
(18, 'A4', '3214015768390006', '3214014857630009', 'Danar Sunandar', 'danar@gmail.com', '0829389393829', 'Jl. Ibrahim Singadilaga', '2'),
(19, 'A5', '3214019874430004', '3214019309340006', 'Sukandar Dinata', 'kandar@gmail.com', '0839382938398', 'Jl. Veteran', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id` int NOT NULL,
  `periode` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id`, `periode`) VALUES
(1, '2020'),
(2, '2021');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pilihan_kriteria`
--

CREATE TABLE `pilihan_kriteria` (
  `id` int NOT NULL,
  `id_kriteria` int NOT NULL,
  `nama` varchar(30) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `role` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Pegawai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `no_id` varchar(20) DEFAULT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int NOT NULL,
  `is_active` int NOT NULL,
  `created` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `no_id`, `nama`, `email`, `foto`, `password`, `role_id`, `is_active`, `created`) VALUES
(1, NULL, 'Administrator', 'admin@admin.com', 'default.jpg', '$2y$10$K6hRyCCeGQhla0DrQvK6KOjZKd1d/ix/y16ERKdnkvWMkqjp59qJe', 1, 1, 1651992090),
(2, '2112', 'Asep Maulana', 'asep@maulana.com', 'default.jpg', '$2y$10$NsbGp4kJBuHcm2He0AAuWe5SngMdqvC1NrUVjHG9AKVo5mjXQkgQW', 2, 1, 1654352370),
(3, '12345', 'Dini Sarasvati', 'dinisarasvati@gmail.fpk', 'default.jpg', '$2y$10$6sEmQT5M8LLcPGuwhkudw.hNEMfBbF9T2uoQDgYKE9sk5HgFt2HFW', 2, 0, 1654437215);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemohon`
--
ALTER TABLE `pemohon`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pilihan_kriteria`
--
ALTER TABLE `pilihan_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `pemohon`
--
ALTER TABLE `pemohon`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pilihan_kriteria`
--
ALTER TABLE `pilihan_kriteria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
