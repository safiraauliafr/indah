-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05 Okt 2018 pada 13.03
-- Versi Server: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `password`, `salt`, `grup`, `nama_depan`, `nama_belakang`, `tanggal_lahir`, `jenis_kelamin`, `nomor_telepon`, `province_id`, `regency_id`, `district_id`, `alamat`, `kode_pos`, `tanggal_daftar`) VALUES
(1, 'admin@example.com', 'ae232bd39182363e2f2cd8e44546dfd8324ebfae7821f297913bb9433eb91a62a9a824eb384835f971394504e3a40097c91941a2771051ee33b16ad57ed7da49', '$6$5bb7423c5ea6f', 2, 'Ardi', 'Yusran', '1997-10-21', 'L', '081310922866', '36', '3674', '3674050', 'Cempaka Putih', 15412, '2018-09-12 19:45:02'),
(2, 'user@example.com', 'fb10be074edac0ccbd8c400477825a3c0227e1d46eb92f37df846b5794f5921df91a5a97f482d5291d946238c240f20f4a7608835a7eb86fd7dd7d388c31456e', '$6$5bb74230dc0f7', 1, 'John', 'Doe', '2000-10-18', 'L', '+628123456789', '31', '3171', '', 'Jaksel', 0, '2018-09-18 17:43:39');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
