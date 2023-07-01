-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jul 2023 pada 05.03
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(100) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun` varchar(100) NOT NULL,
  `tgl_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `judul`, `penerbit`, `tahun`, `tgl_masuk`) VALUES
(1, 'KKN di Desa Penari', 'SimpleMan', '2019', '2023-06-13'),
(2, 'Pemrograman web', 'ga tau', '2020', '2023-06-14'),
(3, 'UI UX', 'lia', '2019', '2019-01-29'),
(4, 'Menpro', 'amel', '2015', '2015-02-17'),
(5, 'Dasar Pemrograman Robot Menggunakan Arduino+cd', 'Andi', '2019', '2020-02-24'),
(6, 'Analisis Jaringan Komunikasi', 'Media', '2019', '2019-04-10'),
(7, 'Microsoft Visual C', 'Andi Offset', '2011', '2023-06-24'),
(8, 'abc', 'dwi', '2015', '2020-01-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(100) NOT NULL,
  `nim` char(9) NOT NULL,
  `id_buku` int(100) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `status` enum('0','1') NOT NULL,
  `denda` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `nim`, `id_buku`, `tgl_pinjam`, `tgl_kembali`, `status`, `denda`) VALUES
(1, '123', 1, '2023-06-13', '0000-00-00', '0', '0'),
(2, '202153013', 2, '2023-06-15', '2023-06-17', '0', '1'),
(3, '202153000', 4, '2023-06-17', '0000-00-00', '0', '0'),
(4, '202153003', 6, '2023-06-24', '0000-00-00', '0', '0'),
(5, '202153003', 3, '2023-06-24', '0000-00-00', '0', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `nim` char(9) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`nim`, `password`, `nama`, `img`, `jenis_kelamin`, `telepon`, `alamat`, `status`) VALUES
('123', '03f7f7198958ffbda01db956d15f134a', 'Admin', '123.jpg', 'Perempuan', '0867967676745', 'Jepang', '1'),
('202153000', '08005a61ee3724d2ad963de79ba369cd', 'Catur', '', 'Laki-laki', '086298415214', 'Loram', '0'),
('202153003', '19b82608667fac7d38cd7795b351a5e1', 'Cahya', '202153003.jpg', 'Perempuan', '0887632653267', 'Kudus', '0'),
('202153013', 'dcb5331c003525f76754d4e975fda5ed', 'Dwi Amelia', '202153013.jpg', 'Perempuan', '085781029558', 'Jepang Pakis', '0'),
('202153073', '430ebc47e0e150c5b4ae2d65764eaab2', 'Yulinda', '', 'Perempuan', '087777777687', 'Pati', '0');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nim`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
