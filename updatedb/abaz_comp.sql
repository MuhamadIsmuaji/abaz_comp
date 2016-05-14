-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 14, 2016 at 07:50 PM
-- Server version: 5.5.47-MariaDB-1ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `abaz_comp`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `kode_barang` char(4) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `stock_barang` enum('Banyak','Terbatas','Tidak ada') DEFAULT NULL,
  `harga_beli` int(10) DEFAULT NULL,
  `harga_jual` int(10) DEFAULT NULL,
  `diskon` int(50) DEFAULT NULL,
  `katagori` int(3) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`kode_barang`),
  KEY `kategori` (`katagori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `stock_barang`, `harga_beli`, `harga_jual`, `diskon`, `katagori`, `gambar`) VALUES
('01', 'Mouse Gaming Bro', 'Banyak', 10000, 15000, 10, 2, ''),
('02', 'Kabel HDMI Panjang', 'Terbatas', 10000, 15000, 10, 2, ''),
('03', 'SD card', 'Terbatas', 20000, 12000, 5, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(3) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'KEYBOARD\r\n'),
(2, 'MEMORY CARD\r\n'),
(3, 'CDR - DVDR\r\n'),
(4, 'CDRW - DVDRW\r\n'),
(5, 'EARPHONE - HEADPHONE - HEADSET\r\n'),
(6, 'SPEAKER AKTIF\r\n'),
(7, 'SPEAKER PORTABLE\r\n'),
(8, 'SPEAKER WOOFER\r\n'),
(9, 'SWITCH & SPLITTER\r\n'),
(10, 'MEJA\r\n'),
(11, 'CARD READER\r\n'),
(12, 'BLUETOOTH\r\n'),
(13, 'USB HUB\r\n'),
(14, 'GAMEPAD / JOY STICK\r\n'),
(15, 'PROTECTOR\r\n'),
(16, 'KUNCI LAPTOP / STICKER\r\n'),
(17, 'COOLER PAD LAPTOP\r\n'),
(18, 'WEBCAM\r\n'),
(19, 'EXTERNAL BOX HARD DISK\r\n'),
(20, 'TANG CRIMPING\r\n'),
(21, 'CONVERTER\r\n'),
(22, 'MOUSE PAD\r\n'),
(23, 'DOTMATRIX (ribbon, catridge)\r\n'),
(24, 'INKJET (ink, catridge)\r\n'),
(25, 'LASERJET (toner, catridge)\r\n'),
(26, 'TABUNG INFUS - MODIFIKASI\r\n'),
(27, 'CLEANER\r\n'),
(28, 'PASTA\r\n'),
(29, 'TV TUNER\r\n'),
(30, 'MODEM (GSM & CDMA)\r\n'),
(31, 'PEN STYLUS\r\n'),
(32, 'CASE\r\n'),
(33, 'MAINBOARD (OB VGA+SC)\r\n'),
(34, 'PROCCESSOR \r\n'),
(35, 'MEMORY\r\n'),
(36, 'HARD DISK INTERNAL LAPTOP\r\n'),
(37, 'HARD DISK INTERNAL PC\r\n'),
(38, 'HARD DISK EXTERNAL\r\n'),
(39, 'ODD\r\n'),
(40, 'POWER SUPPLY - CASING\r\n'),
(41, 'PRINTER\r\n'),
(42, 'LCD & LED\r\n'),
(43, 'VGA \r\n'),
(44, 'SWITCH HUB\r\n'),
(45, 'ROUTER\r\n'),
(46, 'MODEM ADSL\r\n'),
(47, 'USB / PCI WIFI \r\n'),
(48, 'MEMORY CARD\r\n'),
(49, 'FLASH DISK\r\n'),
(50, 'KABEL'),
(51, 'KABEL HDMI'),
(52, 'EXTRA FAN\r\n'),
(53, 'MP3\r\n'),
(54, 'CHARGER\r\n'),
(55, 'STAVOL - UPS\r\n'),
(56, 'VIDEO GAME\r\n'),
(57, 'POWER BANK\r\n'),
(58, 'PROGRAM APLIKASI & ANTI VIRUS\r\n'),
(59, 'NETWORKING\r\n'),
(60, 'SOFT CASE - TAS\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('wisnu', '123');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`katagori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
