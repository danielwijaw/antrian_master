/*
MySQL Backup
Database: antrianmaster
Backup Time: 2020-01-08 15:49:04
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
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
INSERT INTO `antrianmaster`.`tm_antrian` (`antrian_id`,`antrian_data`,`created_at`,`created_by`,`updated_at`,`updated_by`,`deleted_at`,`deleted_by`) VALUES (1, '{\"child_id\":\"19\",\"penjamin\":\"8\",\"poliklinik\":\"9\",\"dokter\":\"11\",\"hari_tanggal\":\"2020-01-08\",\"jam_periksa\":\"21:55\",\"nomor_rm\":\"12\",\"tanggal_lahir\":\"2020-01-08\",\"jk\":\"laki-laki\",\"dokter_history\":\"id,11,text,Dokter Anton,selected,true\",\"hari_tanggal_history\":\"id,2020-01-08,text,Rabu, 8 Januari 2020,child_id,19,selected,true\",\"jam_history\":\"id,2020-01-08,text,Rabu, 8 Januari 2020,child_id,19,selected,true\"}', '2020-01-06 21:37:36', 12, '2020-01-06 21:37:36', 6012020, '0000-00-00 00:00:00', 0),(2, '{\"child_id\":\"18\",\"penjamin\":\"8\",\"poliklinik\":\"9\",\"dokter\":\"11\",\"hari_tanggal\":\"2020-01-07\",\"jam_periksa\":\"19:07\",\"nomor_rm\":\"13\",\"tanggal_lahir\":\"2020-01-08\",\"jk\":\"laki-laki\",\"dokter_history\":\"id,11,text,Dokter Anton,selected,true\",\"hari_tanggal_history\":\"id,2020-01-07,text,Selasa, 7 Januari 2020,child_id,18,selected,true\",\"jam_history\":\"id,2020-01-07,text,Selasa, 7 Januari 2020,child_id,18,selected,true\"}', '2020-01-07 09:07:03', 13, '2020-01-07 09:07:03', 6012020, '0000-00-00 00:00:00', 0),(3, '{\"child_id\":\"18\",\"penjamin\":\"8\",\"poliklinik\":\"9\",\"dokter\":\"11\",\"hari_tanggal\":\"2020-01-07\",\"jam_periksa\":\"19:14\",\"nomor_rm\":\"12\",\"tanggal_lahir\":\"2020-01-08\",\"jk\":\"laki-laki\",\"dokter_history\":\"id,11,text,Dokter Anton,selected,true\",\"hari_tanggal_history\":\"id,2020-01-07,text,Selasa, 7 Januari 2020,child_id,18,selected,true\",\"jam_history\":\"id,2020-01-07,text,Selasa, 7 Januari 2020,child_id,18,selected,true\"}', '2020-01-07 09:07:44', 12, '2020-01-07 09:07:44', 6012020, '0000-00-00 00:00:00', 0);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `antrianmaster`.`tm_data` WRITE;
DELETE FROM `antrianmaster`.`tm_data`;
INSERT INTO `antrianmaster`.`tm_data` (`child_id`,`child_value`,`created_at`,`created_by`,`updated_at`,`updated_by`,`deleted_at`,`deleted_by`) VALUES (1, '{\"k0\":\"category\",\"k1\":\"jenis_penjamin\",\"k2\":\"Jenis Penjamin\"}', '2020-01-06 08:19:38', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(2, '{\"k0\":\"category\",\"k1\":\"poliklinik\",\"k2\":\"Poliklinik\"}', '2020-01-06 08:20:49', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(3, '{\"k0\":\"category\",\"k1\":\"dokter\",\"k2\":\"Dokter\"}', '2020-01-06 08:22:26', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(4, '{\"k0\":\"category\",\"k1\":\"user_admin\",\"k2\":\"Administrator\"}', '2020-01-06 08:27:56', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(5, '{\"k0\":\"category\",\"k1\":\"level_user\",\"k2\":\"Level Hak Akses\"}', '2020-01-06 08:28:32', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(6, '{\"k0\":\"category\",\"k1\":\"jadwal_dokter\",\"k2\":\"Jadwal Dokter\"}', '2020-01-06 08:32:13', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(7, '\r\n{\"k0\":\"jenis_penjamin\",\"k1\":\"asuransi\",\"k2\":\"Asuransi\"}', '2020-01-06 14:21:14', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(8, '\r\n{\"k0\":\"jenis_penjamin\",\"k1\":\"umum\",\"k2\":\"Umum\"}', '2020-01-06 14:21:36', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(9, '\r\n{\"k0\":\"poliklinik\",\"k1\":\"poli_anak\",\"k2\":\"Poli Anak\"}', '2020-01-06 15:26:56', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(10, '{\"k0\":\"poliklinik\",\"k1\":\"poli_gigi\",\"k2\":\"Poli Gigi\"}', '2020-01-06 15:28:07', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(11, '{\"k0\":\"dokter\",\"k1\":\"dr.anton\",\"k2\":\"Dokter Anton\",\"k3\":\"9\",\"k4\":\"Poli Anak\"}', '2020-01-06 15:30:09', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(12, '{\"k0\":\"user_admin\",\"k1\":\"admin\",\"k2\":\"Administrator\",\"k3\":\"21232f297a57a5a743894a0e4a801fc3\",\"k4\":\"13\"}', '2020-01-06 15:54:28', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(13, '{\"k0\":\"level_user\",\"k1\":\"administrator\",\"k2\":\"Administrator\"}', '2020-01-06 15:55:15', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(14, '{\"k0\":\"level_user\",\"k1\":\"editor\",\"k2\":\"Editor\"}', '2020-01-06 15:56:15', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(15, '{\"k0\":\"level_user\",\"k1\":\"author\",\"k2\":\"Author\"}', '2020-01-06 15:57:25', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(16, '{\"k0\":\"level_user\",\"k1\":\"contributtor\",\"k2\":\"Contributtor\"}', '2020-01-06 15:58:56', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(17, '{\"k0\":\"jadwal_dokter\",\"k1\":\"senin\",\"k2\":\"Senin\",\"k3\":\"07:00 & 13:00\",\"k4\":\"09:00 & 15:00\",\"k5\":\"5\",\"k6\":\"11\"}', '2020-01-06 16:26:33', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(18, '{\"k0\":\"jadwal_dokter\",\"k1\":\"selasa\",\"k2\":\"Selasa\",\"k3\":\"19:00\",\"k4\":\"21:00\",\"k5\":\"7\",\"k6\":\"11\"}', '2020-01-06 16:34:24', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(19, '{\"k0\":\"jadwal_dokter\",\"k1\":\"rabu\",\"k2\":\"Rabu\",\"k3\":\"18:00\",\"k4\":\"22:00\",\"k5\":\"5\",\"k6\":\"11\"}', '2020-01-06 18:35:45', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(20, '{\"k0\":\"category\",\"k1\":\"libur_dokter\",\"k2\":\"Libur Dokter\"}', '2020-01-07 11:48:53', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(21, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-15\",\"k2\":\"2020-01-15\",\"k3\":\"11\"}', '2020-01-07 11:51:25', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(22, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-20\",\"k2\":\"2020-01-20\",\"k3\":\"11\"}', '2020-01-07 12:15:58', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);
UNLOCK TABLES;
COMMIT;
