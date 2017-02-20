/*
SQLyog Ultimate v10.42 
MySQL - 5.7.14 : Database - ecommerce
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ecommerce` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ecommerce`;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `no` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(20) NOT NULL,
  `nama_brg` varchar(255) NOT NULL,
  `kategori` text,
  `diskon` tinyint(3) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `title_seo` varchar(60) DEFAULT NULL,
  `tag` text,
  `keyword` text,
  `deskripsi` text,
  `permalink` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `gambar_1` text,
  `gambar_2` text,
  `gambar_3` text,
  `gambar_4` text,
  `gambar_5` text,
  `gambar_6` text,
  `gambar_aktiv` tinyint(1) DEFAULT NULL,
  `video` text,
  `status` tinyint(1) DEFAULT NULL,
  `kondisi` enum('Baru','Bekas','Rusak','LainLain') DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `no` (`no`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) DEFAULT '0',
  `kategori` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `loc_kabkot` */

DROP TABLE IF EXISTS `loc_kabkot`;

CREATE TABLE `loc_kabkot` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_provinsi` tinyint(4) DEFAULT NULL,
  `kabkot` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cons_prov` (`id_provinsi`),
  CONSTRAINT `cons_prov` FOREIGN KEY (`id_provinsi`) REFERENCES `loc_prov` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=498 DEFAULT CHARSET=latin1;

/*Table structure for table `loc_kec` */

DROP TABLE IF EXISTS `loc_kec`;

CREATE TABLE `loc_kec` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `id_kabkot` int(7) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cons_kab` (`id_kabkot`),
  CONSTRAINT `cons_kab` FOREIGN KEY (`id_kabkot`) REFERENCES `loc_kabkot` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Table structure for table `loc_prov` */

DROP TABLE IF EXISTS `loc_prov`;

CREATE TABLE `loc_prov` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `provinsi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Table structure for table `member` */

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `no` bigint(100) NOT NULL AUTO_INCREMENT,
  `id_member` varchar(100) NOT NULL,
  `nama_dpn` varchar(30) DEFAULT NULL,
  `nama_blk` varchar(30) DEFAULT NULL,
  `jenkel` enum('L','P') DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `tmp_lhr` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `foto` text,
  `id_prov` tinyint(4) NOT NULL,
  `id_kabkot` int(11) NOT NULL,
  `id_kec` int(11) NOT NULL,
  `ket_almt` text NOT NULL,
  `kodepos` varchar(15) DEFAULT NULL,
  `tgl_daftar` datetime DEFAULT NULL,
  PRIMARY KEY (`id_member`),
  KEY `no` (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `trans_cart` */

DROP TABLE IF EXISTS `trans_cart`;

CREATE TABLE `trans_cart` (
  `no` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_cart` varchar(100) NOT NULL,
  `id_member` varchar(100) DEFAULT NULL,
  `nama_dpn` varchar(30) NOT NULL,
  `nama_blk` varchar(30) DEFAULT NULL,
  `nohp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_prov` tinyint(4) NOT NULL,
  `id_kabkot` int(7) NOT NULL,
  `id_kec` int(7) NOT NULL,
  `ket_almt` text NOT NULL,
  `kodepos` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_cart`),
  KEY `no` (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
