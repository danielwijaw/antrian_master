/*
MySQL Backup
Database: antrianmaster
Backup Time: 2020-01-12 01:14:57
*/

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `antrianmaster`.`api_keys`;
DROP TABLE IF EXISTS `antrianmaster`.`api_limit`;
DROP TABLE IF EXISTS `antrianmaster`.`tm_antrian`;
DROP TABLE IF EXISTS `antrianmaster`.`tm_data`;
CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `api_key` varchar(50) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `date_created` date DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `api_limit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `uri` varchar(200) NOT NULL,
  `class` varchar(200) NOT NULL,
  `method` varchar(200) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `tm_antrian` (
  `antrian_id` int(11) NOT NULL AUTO_INCREMENT,
  `antrian_data` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(32) NOT NULL DEFAULT 6012020,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(32) NOT NULL DEFAULT 6012020,
  `deleted_at` datetime NOT NULL,
  `deleted_by` int(255) NOT NULL,
  PRIMARY KEY (`antrian_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
CREATE TABLE `tm_data` (
  `child_id` int(32) NOT NULL AUTO_INCREMENT,
  `child_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`child_value`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(32) NOT NULL DEFAULT 6012020,
  `updated_at` datetime NOT NULL,
  `updated_by` int(32) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `deleted_by` int(255) NOT NULL,
  PRIMARY KEY (`child_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
BEGIN;
LOCK TABLES `antrianmaster`.`api_keys` WRITE;
DELETE FROM `antrianmaster`.`api_keys`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `antrianmaster`.`api_limit` WRITE;
DELETE FROM `antrianmaster`.`api_limit`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `antrianmaster`.`tm_antrian` WRITE;
DELETE FROM `antrianmaster`.`tm_antrian`;
INSERT INTO `antrianmaster`.`tm_antrian` (`antrian_id`,`antrian_data`,`created_at`,`created_by`,`updated_at`,`updated_by`,`deleted_at`,`deleted_by`) VALUES (1, '{\"child_id\":\"42\",\"penjamin\":\"8\",\"poliklinik\":\"27\",\"dokter\":\"31\",\"hari_tanggal\":\"2020-01-25\",\"nomor_urut\":\"5\",\"nomor_rm\":\"15\",\"alamat\":\"15\",\"dokter_history\":[\"id\",\"31\",\"text\",\"Dokter Ika\",\"selected\",\"true\"],\"hari_tanggal_history\":[\"id\",\"2020-01-25\",\"text\",\"Sabtu\",\" 25 Januari 2020\",\"child_id\",\"42\",\"selected\",\"true\"]}', '2020-01-11 10:22:24', 15, '2020-01-11 10:22:24', 6012020, '0000-00-00 00:00:00', 0),(2, '{\"child_id\":\"42\",\"penjamin\":\"8\",\"poliklinik\":\"27\",\"dokter\":\"31\",\"hari_tanggal\":\"2020-01-11\",\"nomor_urut\":\"7\",\"nomor_rm\":\"18\",\"alamat\":\"18\",\"dokter_history\":[\"id\",\"31\",\"text\",\"Dokter Ika\",\"selected\",\"true\"],\"hari_tanggal_history\":[\"id\",\"2020-01-11\",\"text\",\"Sabtu\",\" 11 Januari 2020\",\"child_id\",\"42\",\"selected\",\"true\"]}', '2020-01-11 10:23:30', 18, '2020-01-11 10:23:30', 6012020, '0000-00-00 00:00:00', 0);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `antrianmaster`.`tm_data` WRITE;
DELETE FROM `antrianmaster`.`tm_data`;
INSERT INTO `antrianmaster`.`tm_data` (`child_id`,`child_value`,`created_at`,`created_by`,`updated_at`,`updated_by`,`deleted_at`,`deleted_by`) VALUES (1, '{\"k0\":\"category\",\"k1\":\"jenis_penjamin\",\"k2\":\"Jenis Penjamin\"}', '2020-01-06 08:19:38', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(2, '{\"k0\":\"category\",\"k1\":\"poliklinik\",\"k2\":\"Poliklinik\"}', '2020-01-06 08:20:49', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(3, '{\"k0\":\"category\",\"k1\":\"dokter\",\"k2\":\"Dokter\"}', '2020-01-06 08:22:26', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(4, '{\"k0\":\"category\",\"k1\":\"user_admin\",\"k2\":\"Administrator\"}', '2020-01-06 08:27:56', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(5, '{\"k0\":\"category\",\"k1\":\"level_user\",\"k2\":\"Level Hak Akses\"}', '2020-01-06 08:28:32', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(6, '{\"k0\":\"category\",\"k1\":\"jadwal_dokter\",\"k2\":\"Jadwal Dokter\"}', '2020-01-06 08:32:13', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(7, '\r\n{\"k0\":\"jenis_penjamin\",\"k1\":\"asuransi\",\"k2\":\"Asuransi\"}', '2020-01-06 14:21:14', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(8, '\r\n{\"k0\":\"jenis_penjamin\",\"k1\":\"umum\",\"k2\":\"Umum\"}', '2020-01-06 14:21:36', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(9, '\r\n{\"k0\":\"poliklinik\",\"k1\":\"poli_anak\",\"k2\":\"Poli Anak\"}', '2020-01-06 15:26:56', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(10, '{\"k0\":\"poliklinik\",\"k1\":\"poli_gigi\",\"k2\":\"Poli Gigi\"}', '2020-01-06 15:28:07', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(11, '{\"k0\":\"dokter\",\"k1\":\"dr.anton\",\"k2\":\"Dokter Anton\",\"k3\":\"9\",\"k4\":\"Poli Anak\"}', '2020-01-06 15:30:09', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(12, '{\"k0\":\"user_admin\",\"k1\":\"admin\",\"k2\":\"Administrator\",\"k3\":\"QXNIc3B2V0tjelhsYmFCYmxldEZaUT09\",\"k3_validate\":\"admin\",\"k4\":\"13\",\"k5\":\"Administrator\"}', '2020-01-06 15:54:28', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(13, '{\"k0\":\"level_user\",\"k1\":\"administrator\",\"k2\":\"Administrator\"}', '2020-01-06 15:55:15', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(14, '{\"k0\":\"level_user\",\"k1\":\"editor\",\"k2\":\"Editor\"}', '2020-01-06 15:56:15', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(15, '{\"k0\":\"level_user\",\"k1\":\"author\",\"k2\":\"Author\"}', '2020-01-06 15:57:25', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(16, '{\"k0\":\"level_user\",\"k1\":\"contributtor\",\"k2\":\"Contributtor\"}', '2020-01-06 15:58:56', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(17, '{\"k0\":\"jadwal_dokter\",\"k1\":\"senin\",\"k2\":\"Senin\",\"k3\":\"15\",\"k4\":\"11\",\"k4_text\":\"Dokter Anton || Poli Anak\"}', '2020-01-06 16:26:33', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(18, '{\"k0\":\"jadwal_dokter\",\"k1\":\"selasa\",\"k2\":\"Selasa\",\"k3\":\"13\",\"k4\":\"11\",\"k4_text\":\"Dokter Anton || Poli Anak\"}', '2020-01-06 16:34:24', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(19, '{\"k0\":\"jadwal_dokter\",\"k1\":\"rabu\",\"k2\":\"Rabu\",\"k3\":\"10\",\"k4\":\"11\",\"k4_text\":\"Dokter Anton || Poli Anak\"}', '2020-01-06 18:35:45', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(20, '{\"k0\":\"category\",\"k1\":\"libur_dokter\",\"k2\":\"Libur Dokter\"}', '2020-01-07 11:48:53', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(21, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-15\",\"k2\":\"2020-01-15\",\"k3\":\"11\"}', '2020-01-07 11:51:25', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(22, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-20\",\"k2\":\"2020-01-20\",\"k3\":\"11\"}', '2020-01-07 12:15:58', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(23, '{\"k0\":\"dokter\",\"k1\":\"dr.budi\",\"k2\":\"Dokter Budi\",\"k3\":\"10\",\"k4\":\"Poli Gigi\"}', '2020-01-08 18:03:21', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(25, '{\"k0\":\"jenis_penjamin\",\"k1\":\"bpjs\",\"k2\":\"Bpjs\"}', '2020-01-10 19:18:07', 12, '2020-01-10 19:51:01', 12, '0000-00-00 00:00:00', 0),(27, '{\"k0\":\"poliklinik\",\"k1\":\"poli_kandungan\",\"k2\":\"Poli Kandungan\"}', '2020-01-10 19:21:58', 12, '2020-01-10 20:56:14', 12, '0000-00-00 00:00:00', 0),(28, '{\"k0\":\"dokter\",\"k1\":\"dokter_setia\",\"k2\":\"Dokter Setia\",\"k3\":\"27\",\"k4\":\"Poli Kandungan\"}', '2020-01-10 20:48:54', 12, '2020-01-10 21:04:46', 12, '0000-00-00 00:00:00', 0),(30, '{\"k0\":\"jenis_penjamin\",\"k1\":\"preudential\",\"k2\":\"Preudential\"}', '2020-01-10 20:55:50', 12, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(31, '{\"k0\":\"dokter\",\"k1\":\"dokter_ika\",\"k2\":\"Dokter Ika\",\"k3\":\"27\",\"k4\":\"Poli Kandungan\"}', '2020-01-10 21:11:36', 12, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(33, '{\"k0\":\"user_admin\",\"k1\":\"dww\",\"k2\":\"Daniel Wija Waluyajati\",\"k3\":\"QXNIc3B2V0tjelhsYmFCYmxldEZaUT09\",\"k3_validate\":\"admin\",\"k4\":\"13\",\"k5\":\"Administrator\"}', '2020-01-11 08:30:25', 12, '2020-01-11 08:41:11', 12, '0000-00-00 00:00:00', 0),(34, '{\"k0\":\"jadwal_dokter\",\"k1\":\"senin\",\"k2\":\"Senin\",\"k3\":\"17\",\"k4\":31,\"k4_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:19:27', 12, '2020-01-11 09:24:39', 12, '0000-00-00 00:00:00', 0),(35, '{\"k0\":\"jadwal_dokter\",\"k1\":\"selasa\",\"k2\":\"Selasa\",\"k3\":\"17\",\"k4\":\"31\",\"k4_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:20:55', 12, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(36, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-21\",\"k2\":\"2020-01-21\",\"k3\":\"31\",\"k3_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:34:27', 12, '2020-01-11 09:48:36', 12, '0000-00-00 00:00:00', 0),(37, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-28\",\"k2\":\"2020-01-28\",\"k3\":\"31\",\"k3_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:35:50', 12, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(38, '{\"k0\":\"jenis_penjamin\",\"k1\":\"pt._sinarmas\",\"k2\":\"PT. Sinarmas\"}', '2020-01-11 09:48:57', 12, '2020-01-11 09:49:22', 12, '2020-01-11 09:49:46', 12),(39, '{\"k0\":\"poliklinik\",\"k1\":\"poli_jantung_2\",\"k2\":\"Poli Jantung 2\"}', '2020-01-11 09:50:21', 12, '2020-01-11 09:50:39', 12, '2020-01-11 09:50:49', 12),(40, '{\"k0\":\"dokter\",\"k1\":\"dokter_rio\",\"k2\":\"Dokter Rio\",\"k3\":\"9\",\"k4\":\"Poli Anak\"}', '2020-01-11 09:51:09', 12, '2020-01-11 09:51:43', 12, '0000-00-00 00:00:00', 0),(41, '{\"k0\":\"user_admin\",\"k1\":\"jantung1\",\"k2\":\"Perawat Jantung\",\"k3\":\"QXNIc3B2V0tjelhsYmFCYmxldEZaUT09\",\"k3_validate\":\"admin\",\"k4\":\"14\",\"k5\":\"Editor\"}', '2020-01-11 09:52:09', 12, '2020-01-11 09:54:04', 12, '2020-01-11 09:54:35', 12),(42, '{\"k0\":\"jadwal_dokter\",\"k1\":\"sabtu\",\"k2\":\"Sabtu\",\"k3\":\"20\",\"k4\":\"31\",\"k4_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:54:55', 12, '2020-01-11 10:21:28', 12, '0000-00-00 00:00:00', 0),(43, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-27\",\"k2\":\"2020-01-27\",\"k3\":\"31\",\"k3_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:56:19', 12, '2020-01-11 10:02:29', 12, '0000-00-00 00:00:00', 0);
UNLOCK TABLES;
COMMIT;
