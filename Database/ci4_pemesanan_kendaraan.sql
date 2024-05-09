-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for ci4_pemesanan_kendaraan
CREATE DATABASE IF NOT EXISTS `ci4_pemesanan_kendaraan` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `ci4_pemesanan_kendaraan`;


-- Dumping structure for table ci4_pemesanan_kendaraan.tb_driver
CREATE TABLE IF NOT EXISTS `tb_driver` (
  `id_driver` int(11) NOT NULL AUTO_INCREMENT,
  `nama_driver` varchar(50) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_driver`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ci4_pemesanan_kendaraan.tb_driver: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_driver` DISABLE KEYS */;
INSERT INTO `tb_driver` (`id_driver`, `nama_driver`, `no_hp`) VALUES
	(1, 'Herman', '083444555666'),
	(2, 'Yanto', '083111111111'),
	(3, 'Semir', '083222222222'),
	(4, 'Amir', '083456789101'),
	(5, 'Andi suyadi', '081222333444'),
	(6, 'Roma yadi', '082834992000'),
	(7, 'Kestel adi', '089786667000');
/*!40000 ALTER TABLE `tb_driver` ENABLE KEYS */;


-- Dumping structure for table ci4_pemesanan_kendaraan.tb_kendaraan
CREATE TABLE IF NOT EXISTS `tb_kendaraan` (
  `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kendaraan` varchar(50) DEFAULT NULL,
  `no_plat` varchar(50) DEFAULT NULL,
  `jenis_kendaraan` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kendaraan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ci4_pemesanan_kendaraan.tb_kendaraan: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_kendaraan` DISABLE KEYS */;
INSERT INTO `tb_kendaraan` (`id_kendaraan`, `nama_kendaraan`, `no_plat`, `jenis_kendaraan`, `status`) VALUES
	(1, 'Mobil Box CDD', 'B 1234 AH', 'Mobil Box', 'Ada'),
	(2, 'Suzuki New Carry', 'B 5678 AH', 'Pick Up', 'Ada'),
	(3, 'Daihatsu GRAN MAX', 'B 9101 BC', 'Pick Up', 'Ada'),
	(4, 'DFSK Gelora Supercab 2023', 'B 1121 ZZ', 'Pick Up', 'Ada'),
	(5, 'Mitsubishi New Colt L300', 'B 9999 XX', 'Pick Up', 'Ada'),
	(6, 'Wuling Formo Max', 'B 8888 CC', 'Pick Up', 'Ada');
/*!40000 ALTER TABLE `tb_kendaraan` ENABLE KEYS */;


-- Dumping structure for table ci4_pemesanan_kendaraan.tb_level
CREATE TABLE IF NOT EXISTS `tb_level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ci4_pemesanan_kendaraan.tb_level: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_level` DISABLE KEYS */;
INSERT INTO `tb_level` (`id_level`, `level`) VALUES
	(1, 'Atasan'),
	(2, 'Admin');
/*!40000 ALTER TABLE `tb_level` ENABLE KEYS */;


-- Dumping structure for table ci4_pemesanan_kendaraan.tb_login
CREATE TABLE IF NOT EXISTS `tb_login` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `userlevelid` int(11) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ci4_pemesanan_kendaraan.tb_login: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_login` DISABLE KEYS */;
INSERT INTO `tb_login` (`userid`, `nama_user`, `email`, `password`, `userlevelid`) VALUES
	(1, 'Ali Gufron', 'ali.gfron@gmail.com', '123456', 2),
	(2, 'Iskandar Sholeh', 'iskandar@gmail.com', '12345', 1);
/*!40000 ALTER TABLE `tb_login` ENABLE KEYS */;


-- Dumping structure for table ci4_pemesanan_kendaraan.tb_pesanan
CREATE TABLE IF NOT EXISTS `tb_pesanan` (
  `id_pesanan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(11) DEFAULT NULL,
  `id_driver` int(11) DEFAULT NULL,
  `tgl_pesan` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `id_atasan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pesanan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ci4_pemesanan_kendaraan.tb_pesanan: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_pesanan` DISABLE KEYS */;
INSERT INTO `tb_pesanan` (`id_pesanan`, `id_kendaraan`, `id_driver`, `tgl_pesan`, `tgl_kembali`, `id_atasan`) VALUES
	(1, 1, 1, '2024-05-09', '2024-05-09', 2);
/*!40000 ALTER TABLE `tb_pesanan` ENABLE KEYS */;


-- Dumping structure for table ci4_pemesanan_kendaraan.tb_pesan_disetujui
CREATE TABLE IF NOT EXISTS `tb_pesan_disetujui` (
  `id_setuju` int(11) NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(11) DEFAULT NULL,
  `id_driver` int(11) DEFAULT NULL,
  `tgl_pesan` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `id_atasan` int(11) DEFAULT NULL,
  `tgl_disetujui` date DEFAULT NULL,
  PRIMARY KEY (`id_setuju`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ci4_pemesanan_kendaraan.tb_pesan_disetujui: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_pesan_disetujui` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_pesan_disetujui` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
