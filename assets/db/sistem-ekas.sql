-- MariaDB dump 10.19  Distrib 10.4.21-MariaDB, for osx10.10 (x86_64)
--
-- Host: 127.0.0.1    Database: sistem_ekas
-- ------------------------------------------------------
-- Server version	10.4.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `access_menu`
--

DROP TABLE IF EXISTS `access_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access_menu` (
  `access_id` int(11) NOT NULL,
  `role_id` varchar(36) DEFAULT NULL,
  `menu_id` varchar(36) DEFAULT NULL,
  `_view` tinyint(1) NOT NULL,
  `_add` tinyint(1) NOT NULL,
  `_update` tinyint(1) NOT NULL,
  `_delete` tinyint(1) NOT NULL,
  `created_by` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(128) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`access_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_menu`
--

LOCK TABLES `access_menu` WRITE;
/*!40000 ALTER TABLE `access_menu` DISABLE KEYS */;
INSERT INTO `access_menu` VALUES (3,'1','02',1,1,1,1,NULL,NULL,NULL,NULL,1),(4,'1','03',1,1,1,1,NULL,NULL,NULL,NULL,1),(5,'1','03.01',1,1,1,1,NULL,NULL,NULL,NULL,1),(8,'1','02.03',1,1,1,1,NULL,NULL,NULL,NULL,1),(9,'1','03.02',1,1,1,1,NULL,NULL,NULL,NULL,1),(10,'1','03.03',1,1,1,1,NULL,NULL,NULL,NULL,1),(12,'2','01',1,1,1,1,NULL,NULL,NULL,NULL,1),(16,'2','02.02',1,1,1,1,'superadmin','2023-05-26 15:52:40',NULL,NULL,1),(18,'2','02.03',1,1,1,1,'superadmin','2023-05-26 15:54:26',NULL,NULL,1),(19,'2','02.01',1,1,1,1,'superadmin','2023-05-26 15:55:43',NULL,NULL,1),(20,'2','01.01',1,1,1,1,'superadmin','2023-05-26 16:03:00',NULL,NULL,1),(21,'2','01.02',1,1,1,1,'superadmin','2023-05-26 16:03:03',NULL,NULL,1),(22,'2','02',1,1,1,1,'superadmin','2023-05-26 16:03:06',NULL,NULL,1),(23,'3','01',1,1,1,1,'superadmin','2023-05-26 16:16:44',NULL,NULL,1),(24,'3','01.01',1,1,1,1,'superadmin','2023-05-26 16:16:46',NULL,NULL,1),(25,'3','01.02',1,1,1,1,'superadmin','2023-05-26 16:16:51',NULL,NULL,1),(26,'1','03.04',1,1,1,1,'superadmin','2023-05-26 17:34:14',NULL,NULL,1),(31,'2','01.03',1,1,1,1,'superadmin','2023-06-03 16:06:27',NULL,NULL,1),(32,'2','01.04',1,1,1,1,'superadmin','2023-06-03 16:06:28',NULL,NULL,1),(33,'2','03',1,1,1,1,'superadmin','2023-06-03 16:06:30',NULL,NULL,1),(34,'1','02.01',1,1,1,1,'superadmin','2023-06-03 16:10:53',NULL,NULL,1),(35,'1','02.02',1,1,1,1,'superadmin','2023-06-03 16:10:56',NULL,NULL,1),(36,'1','01',1,1,1,1,'superadmin','2023-06-03 16:11:14',NULL,NULL,1),(37,'1','01.01',1,1,1,1,'superadmin','2023-06-03 16:11:16',NULL,NULL,1),(38,'1','01.02',1,1,1,1,'superadmin','2023-06-03 16:11:16',NULL,NULL,1),(39,'1','01.03',1,1,1,1,'superadmin','2023-06-03 16:11:17',NULL,NULL,1),(40,'1','01.04',1,1,1,1,'superadmin','2023-06-03 16:11:18',NULL,NULL,1),(41,'1','01.05',1,1,1,1,'superadmin','2023-06-04 16:16:48',NULL,NULL,1);
/*!40000 ALTER TABLE `access_menu` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

--
-- Table structure for table `dat_transaksi_jimpitan`
--

DROP TABLE IF EXISTS `dat_transaksi_jimpitan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dat_transaksi_jimpitan` (
  `transaksijimpitan_id` char(15) NOT NULL,
  `transaksi_id` char(36) NOT NULL DEFAULT '',
  `jenis_st` char(10) DEFAULT 'jimpitan',
  `anggota_id` char(36) DEFAULT NULL,
  `jumlah_transaksi` char(36) DEFAULT NULL,
  `petugas_catat_id` char(36) DEFAULT NULL,
  `tgl_catat` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`transaksijimpitan_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dat_transaksi_jimpitan`
--

LOCK TABLES `dat_transaksi_jimpitan` WRITE;
/*!40000 ALTER TABLE `dat_transaksi_jimpitan` DISABLE KEYS */;
INSERT INTO `dat_transaksi_jimpitan` VALUES ('2305310001','001','jimpitan','2305300004','500','2305300004','2023-05-31','--','superadmin','2023-05-30 19:41:36','superadmin','2023-05-30 19:50:20',NULL,NULL,0,1),('2305310002','001','jimpitan','2305300001','5000','2305300003','2023-05-31','-','superadmin','2023-05-31 08:55:38',NULL,NULL,NULL,NULL,0,1),('2306030001','001','jimpitan','2305300004','1000','2305300003','2023-06-03','-','superadmin','2023-06-03 08:15:12',NULL,NULL,NULL,NULL,0,1);
/*!40000 ALTER TABLE `dat_transaksi_jimpitan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dat_transaksi_kas`
--

DROP TABLE IF EXISTS `dat_transaksi_kas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dat_transaksi_kas` (
  `transaksikas_id` char(15) NOT NULL,
  `transaksi_id` char(36) NOT NULL DEFAULT '',
  `jenis_st` char(10) DEFAULT 'kas',
  `anggota_id` char(36) DEFAULT NULL,
  `jumlah_transaksi` char(36) DEFAULT NULL,
  `petugas_catat_id` char(36) DEFAULT NULL,
  `tgl_catat` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`transaksikas_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dat_transaksi_kas`
--

LOCK TABLES `dat_transaksi_kas` WRITE;
/*!40000 ALTER TABLE `dat_transaksi_kas` DISABLE KEYS */;
INSERT INTO `dat_transaksi_kas` VALUES ('2305310001','001','kas','2305300003','30000','2305300005','2023-05-31','-','superadmin','2023-05-30 19:40:23','superadmin','2023-05-31 08:05:02',NULL,NULL,0,1),('2305310002','001','kas','2305300001','40000','2305300003','2023-05-31','-','superadmin','2023-05-30 19:48:11',NULL,NULL,NULL,NULL,0,1),('2305310003','001','kas','2305300004','5000','2305260001','2023-05-31','-','superadmin','2023-05-31 08:00:40',NULL,NULL,NULL,NULL,0,1),('2305310004','001','kas','2305300003','6000','2305290001','2023-05-31','-','superadmin','2023-05-31 08:01:42','superadmin','2023-05-31 08:08:37',NULL,NULL,0,1),('2305310005','001','kas','2305300004','30000','2305300005','2023-05-31','-','superadmin','2023-05-31 08:02:17',NULL,NULL,NULL,NULL,0,1),('2306030001','001','kas','2305300002','10000','2305300002','2023-06-03','kas','superadmin','2023-06-03 07:47:31',NULL,NULL,NULL,NULL,0,1);
/*!40000 ALTER TABLE `dat_transaksi_kas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipe_transaksi`
--

DROP TABLE IF EXISTS `tipe_transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipe_transaksi` (
  `transaksi_id` char(15) NOT NULL,
  `tipe_transaksi` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`transaksi_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipe_transaksi`
--

LOCK TABLES `tipe_transaksi` WRITE;
/*!40000 ALTER TABLE `tipe_transaksi` DISABLE KEYS */;
INSERT INTO `tipe_transaksi` VALUES ('001','Pemasukan',NULL,NULL,NULL,NULL,NULL,NULL,0,1),('002','Pengeluaran',NULL,NULL,NULL,NULL,NULL,NULL,0,1);
/*!40000 ALTER TABLE `tipe_transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dat_pengeluaran`
--

DROP TABLE IF EXISTS `dat_pengeluaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dat_pengeluaran` (
  `pengeluaran_id` char(15) NOT NULL,
  `jml_pengeluaran` char(36) DEFAULT NULL,
  `petugas_catat_id` char(36) DEFAULT NULL,
  `asal` char(36) DEFAULT NULL,
  `tgl_catat` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`pengeluaran_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dat_pengeluaran`
--

LOCK TABLES `dat_pengeluaran` WRITE;
/*!40000 ALTER TABLE `dat_pengeluaran` DISABLE KEYS */;
INSERT INTO `dat_pengeluaran` VALUES ('2305310001','80000','2305300001','Kas','2023-05-31','membeli lampu pemuda','superadmin','2023-05-31 08:55:09',NULL,NULL,NULL,NULL,0,1),('2305310002','5000','2305290001','Jimpitan','2023-05-31','--','superadmin','2023-05-31 08:55:23',NULL,NULL,NULL,NULL,0,1),('2305310003','4000','2305300004','Kas','2023-05-31','--','superadmin','2023-05-31 09:26:39',NULL,NULL,NULL,NULL,0,1),('2306060001','3000','2305300001','Kas','2023-06-06','-','superadmin','2023-06-06 07:46:37',NULL,NULL,NULL,NULL,0,1);
/*!40000 ALTER TABLE `dat_pengeluaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_anggota`
--

DROP TABLE IF EXISTS `mst_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_anggota` (
  `anggota_id` char(32) NOT NULL,
  `anggota_nm` varchar(128) DEFAULT NULL,
  `no_rumah` char(11) DEFAULT NULL,
  `no_tlp` char(20) DEFAULT NULL,
  `tgl_catat` date DEFAULT NULL,
  `created_by` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(128) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`anggota_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_anggota`
--

LOCK TABLES `mst_anggota` WRITE;
/*!40000 ALTER TABLE `mst_anggota` DISABLE KEYS */;
INSERT INTO `mst_anggota` VALUES ('2305260001','AKBAR','D34','08546854785','2023-05-26','superadmin','2023-05-26 19:52:52','superadmin','2023-05-26 19:53:42',1),('2305290001','HARIS','D12','085948392839238','2023-05-29','superadmin','2023-05-29 17:30:27',NULL,NULL,1),('2305300001','ARDI','D10','085938395232','2023-05-30','superadmin','2023-05-30 16:51:22',NULL,NULL,1),('2305300002','EDDY','A31','05869493482','2023-05-30','superadmin','2023-05-30 16:51:39',NULL,NULL,1),('2305300003','RUDY','D10','08595753934','2023-05-30','superadmin','2023-05-30 16:52:17',NULL,NULL,1),('2305300004','SEPTIAN','D5','08594392322','2023-05-30','superadmin','2023-05-30 16:52:30',NULL,NULL,1),('2305300005','AJI','D12','0893439682329','2023-05-30','superadmin','2023-05-30 16:52:53',NULL,NULL,1);
/*!40000 ALTER TABLE `mst_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dat_pengurus`
--

DROP TABLE IF EXISTS `dat_pengurus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dat_pengurus` (
  `pengurus_id` char(15) NOT NULL,
  `anggota_id` char(36) NOT NULL DEFAULT '',
  `jabatan` varchar(100) DEFAULT NULL,
  `masa_jabatan` varchar(255) DEFAULT NULL,
  `tgl_awal_jabatan` date DEFAULT NULL,
  `tgl_akhir_jabatan` date DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`pengurus_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dat_pengurus`
--

LOCK TABLES `dat_pengurus` WRITE;
/*!40000 ALTER TABLE `dat_pengurus` DISABLE KEYS */;
INSERT INTO `dat_pengurus` VALUES ('2305290001','2305290001','Sekretaris','5 tahun','2023-03-01','2023-05-29','superadmin','2023-05-29 11:08:33','superadmin','2023-05-29 11:21:13',NULL,NULL,0,1);
/*!40000 ALTER TABLE `dat_pengurus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jadwal_ronda`
--

DROP TABLE IF EXISTS `jadwal_ronda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jadwal_ronda` (
  `jadwal_id` char(15) NOT NULL,
  `anggota_id` char(36) NOT NULL DEFAULT '',
  `hari_ronda` char(36) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`jadwal_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal_ronda`
--

LOCK TABLES `jadwal_ronda` WRITE;
/*!40000 ALTER TABLE `jadwal_ronda` DISABLE KEYS */;
INSERT INTO `jadwal_ronda` VALUES ('2305300001','2305260001','Senin','senin malam','superadmin','2023-05-30 09:49:46',NULL,NULL,NULL,NULL,0,1),('2305300002','2305290001','Selasa','selasa malam','superadmin','2023-05-30 09:49:58',NULL,NULL,NULL,NULL,0,1),('2305300003','2305300002','Rabu','-','superadmin','2023-05-30 09:51:50',NULL,NULL,NULL,NULL,0,1),('2305300004','2305300001','Kamis','-','superadmin','2023-05-30 09:51:59',NULL,NULL,NULL,NULL,0,1),('2305300005','2305300003','Jumat','-','superadmin','2023-05-30 09:53:06',NULL,NULL,NULL,NULL,0,1),('2305300006','2305300004','Sabtu','-','superadmin','2023-05-30 09:53:13',NULL,NULL,NULL,NULL,0,1),('2306030001','2305300002','Senin','s','superadmin','2023-06-03 08:52:41',NULL,NULL,NULL,NULL,0,1),('2306030002','2305300005','Minggu','-','superadmin','2023-06-03 09:12:07',NULL,NULL,NULL,NULL,0,1);
/*!40000 ALTER TABLE `jadwal_ronda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `menu_id` varchar(36) NOT NULL,
  `parent_id` varchar(100) DEFAULT NULL,
  `menu_nm` varchar(128) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `created_by` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(128) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES ('01',NULL,'Dashboard','#','fas',NULL,NULL,NULL,'superadmin','2023-06-03 16:04:38',1),('01.01','01','Informasi','dashboard/dashboard','fas',NULL,NULL,NULL,'superadmin','2023-06-03 16:00:56',1),('01.02','01','Kas','dashboard/kas','fas',NULL,'superadmin','2023-05-21 18:05:00',NULL,NULL,1),('01.03','01','Jimpitan','dashboard/jimpitan','fas',NULL,'superadmin','2023-05-30 17:24:38',NULL,NULL,1),('01.04','01','Pengeluran','dashboard/pengeluaran','fas',NULL,'superadmin','2023-05-31 15:20:42',NULL,NULL,1),('01.05','01','Laporan','dashboard/laporan','fas',NULL,'superadmin','2023-06-04 16:16:33',NULL,NULL,1),('02',NULL,'Master','#','fas',NULL,NULL,NULL,NULL,NULL,1),('02.01','02','Pengurus','master/pengurus','fas',NULL,NULL,NULL,NULL,NULL,1),('02.02','02','Anggota','master/anggota','fas',NULL,NULL,NULL,NULL,NULL,1),('02.03','02','Jadwal','master/jadwal','fas',NULL,NULL,NULL,NULL,NULL,1),('03',NULL,'Management','#','fas',NULL,NULL,NULL,NULL,NULL,1),('03.01','03','Menu','management/menu','fas',NULL,NULL,NULL,NULL,NULL,1),('03.02','03','Role','management/role','fas',NULL,NULL,NULL,NULL,NULL,1),('03.03','03','Access Menu','management/access','fas',NULL,'superadmin','2023-05-21 17:52:19',NULL,NULL,1),('03.04','03','User','management/user','fas',NULL,'superadmin','2023-05-26 17:34:07',NULL,NULL,1);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_nm` varchar(128) DEFAULT NULL,
  `created_by` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(128) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Super Admin',NULL,NULL,NULL,NULL,1),(2,'Admin',NULL,NULL,NULL,NULL,1),(3,'Anggota','superadmin','2023-05-21 17:26:07',NULL,NULL,1);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_nm` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_by` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(128) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Super Admin','superadmin','default.jpg','$2y$10$3ZB7eCvYVd67rIqLrfiauOj5AWNGZlsZIF6VYgxrgcxlAM8wWkWwa',1,NULL,NULL,NULL,NULL,1),(2,'Admin','admin','default.jpg','$2y$10$3ZB7eCvYVd67rIqLrfiauOj5AWNGZlsZIF6VYgxrgcxlAM8wWkWwa',2,NULL,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-09 18:45:10
