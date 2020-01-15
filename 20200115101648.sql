/*
MySQL Backup
Database: b-arif_on
Backup Time: 2020-01-15 10:16:48
*/

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `b-arif_on`.`api_keys`;
DROP TABLE IF EXISTS `b-arif_on`.`api_limit`;
DROP TABLE IF EXISTS `b-arif_on`.`tm_antrian`;
DROP TABLE IF EXISTS `b-arif_on`.`tm_data`;
DROP PROCEDURE IF EXISTS `b-arif_on`.`p_terbilang`;
DROP FUNCTION IF EXISTS `b-arif_on`.`f_terbilang`;
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
CREATE PROCEDURE `p_terbilang`(IN angka bigint, OUT retval TEXT)
BEGIN
  -- @rgiapratama - 2017
    DECLARE tmp1 TEXT;
    DECLARE tmp2 TEXT;
     
    SET max_sp_recursion_depth := 20;
 
    IF(angka = 0) THEN
        SET retval = '';
  ELSEIF(angka < 12) THEN
        SET retval = ELT(angka,'Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan','Sepuluh','Sebelas');
  ELSEIF (angka < 20) THEN
        CALL p_terbilang((angka-10),tmp1);
        SET retval = CONCAT(tmp1,' Belas');
  ELSEIF (angka < 100) THEN
        CALL p_terbilang(FLOOR(angka/10),tmp1);
        CALL p_terbilang((angka%10),tmp2);
        SET retval = CONCAT(tmp1,' Puluh ',tmp2);
  ELSEIf (angka < 200) THEN
        CALL p_terbilang((angka-100),tmp1);
        SET retval = CONCAT('Seratus ',tmp1);
  ELSEIF (angka < 1000) THEN
        CALL p_terbilang(FLOOR(angka/100),tmp1);
        CALL p_terbilang((angka%100),tmp2);
        SET retval = CONCAT(tmp1,' Ratus ',tmp2);
  ELSEIF (angka < 2000) THEN
        CALL p_terbilang((angka-1000),tmp1);
        SET retval = CONCAT('Seribu ',tmp1);
  ELSEIF (angka < 1000000) THEN
        CALL p_terbilang(FLOOR(angka/1000),tmp1);
        CALL p_terbilang((angka%1000),tmp2);
        SET retval = CONCAT(tmp1,' Ribu ',tmp2);
  ELSEIF (angka < 1000000000) THEN
        CALL p_terbilang(FLOOR(angka/1000000),tmp1);
        CALL p_terbilang((angka%1000000),tmp2);
        SET retval = CONCAT(tmp1,' Juta ',tmp2);
  ELSEIF (angka < 1000000000000) THEN
        CALL p_terbilang(FLOOR(angka/1000000000),tmp1);
        CALL p_terbilang((angka%1000000000),tmp2);
        SET retval = CONCAT(tmp1,' Milyar ',tmp2);
  ELSE SET retval = 'GIA';
  END IF;
END;
CREATE FUNCTION `f_terbilang`(angka BIGINT) RETURNS text CHARSET latin1
BEGIN
-- @rgiapratama - 2017
    DECLARE v_result TEXT;
    CALL p_terbilang(angka, v_result);
    RETURN REPLACE(v_result,'  ',' ');
END;
BEGIN;
LOCK TABLES `b-arif_on`.`api_keys` WRITE;
DELETE FROM `b-arif_on`.`api_keys`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `b-arif_on`.`api_limit` WRITE;
DELETE FROM `b-arif_on`.`api_limit`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `b-arif_on`.`tm_antrian` WRITE;
DELETE FROM `b-arif_on`.`tm_antrian`;
INSERT INTO `b-arif_on`.`tm_antrian` (`antrian_id`,`antrian_data`,`created_at`,`created_by`,`updated_at`,`updated_by`,`deleted_at`,`deleted_by`) VALUES (1, '{\"child_id\":\"35\",\"penjamin\":\"8\",\"poliklinik\":\"27\",\"dokter\":\"31\",\"hari_tanggal\":\"2020-01-14\",\"nomor_urut\":\"5\",\"nomor_rm\":\"3995\",\"alamat\":\"Banyumas\",\"dokter_history\":[\"id\",\"31\",\"text\",\"Dokter Ika\",\"attribute\",\"Poli Kandungan\",\"selected\",\"true\"],\"hari_tanggal_history\":[\"id\",\"2020-01-14\",\"text\",\"Selasa\",\" 14 Januari 2020\",\"child_id\",\"35\",\"selected\",\"true\"],\"called_antrian\":\"0\",\"is_online\":\"1\"}', '2020-01-14 17:08:59', 3995, '2020-01-14 17:08:59', 6012020, '0000-00-00 00:00:00', 0),(2, '{\"child_id\":\"35\",\"penjamin\":\"8\",\"poliklinik\":\"27\",\"dokter\":\"31\",\"hari_tanggal\":\"2020-01-14\",\"nomor_urut\":\"4\",\"nomor_rm\":\"12312\",\"alamat\":\"123123\",\"dokter_history\":[\"id\",\"31\",\"text\",\"Dokter Ika\",\"attribute\",\"Poli Kandungan\",\"selected\",\"true\"],\"hari_tanggal_history\":[\"id\",\"2020-01-14\",\"text\",\"Selasa\",\" 14 Januari 2020\",\"child_id\",\"35\",\"selected\",\"true\"],\"called_antrian\":\"0\",\"is_online\":\"1\"}', '2020-01-14 17:12:02', 12312, '2020-01-14 17:12:02', 6012020, '0000-00-00 00:00:00', 0),(3, '{\"child_id\":\"35\",\"penjamin\":\"8\",\"poliklinik\":\"27\",\"dokter\":\"31\",\"hari_tanggal\":\"2020-01-14\",\"nomor_urut\":\"2\",\"nomor_rm\":\"123123\",\"alamat\":\"123123\",\"dokter_history\":[\"id\",\"31\",\"text\",\"Dokter Ika\",\"attribute\",\"Poli Kandungan\",\"selected\",\"true\"],\"hari_tanggal_history\":[\"id\",\"2020-01-14\",\"text\",\"Selasa\",\" 14 Januari 2020\",\"child_id\",\"35\",\"selected\",\"true\"],\"called_antrian\":\"0\",\"is_online\":\"0\"}', '2020-01-14 17:14:16', 123123, '2020-01-14 17:14:16', 6012020, '0000-00-00 00:00:00', 0);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `b-arif_on`.`tm_data` WRITE;
DELETE FROM `b-arif_on`.`tm_data`;
INSERT INTO `b-arif_on`.`tm_data` (`child_id`,`child_value`,`created_at`,`created_by`,`updated_at`,`updated_by`,`deleted_at`,`deleted_by`) VALUES (1, '{\"k0\":\"category\",\"k1\":\"jenis_penjamin\",\"k2\":\"Jenis Penjamin\"}', '2020-01-06 08:19:38', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(2, '{\"k0\":\"category\",\"k1\":\"poliklinik\",\"k2\":\"Poliklinik\"}', '2020-01-06 08:20:49', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(3, '{\"k0\":\"category\",\"k1\":\"dokter\",\"k2\":\"Dokter\"}', '2020-01-06 08:22:26', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(4, '{\"k0\":\"category\",\"k1\":\"user_admin\",\"k2\":\"Administrator\"}', '2020-01-06 08:27:56', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(5, '{\"k0\":\"category\",\"k1\":\"level_user\",\"k2\":\"Level Hak Akses\"}', '2020-01-06 08:28:32', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(6, '{\"k0\":\"category\",\"k1\":\"jadwal_dokter\",\"k2\":\"Jadwal Dokter\"}', '2020-01-06 08:32:13', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(7, '\r\n{\"k0\":\"jenis_penjamin\",\"k1\":\"asuransi\",\"k2\":\"Asuransi\"}', '2020-01-06 14:21:14', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(8, '\r\n{\"k0\":\"jenis_penjamin\",\"k1\":\"umum\",\"k2\":\"Umum\"}', '2020-01-06 14:21:36', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(9, '\r\n{\"k0\":\"poliklinik\",\"k1\":\"poli_anak\",\"k2\":\"Poli Anak\"}', '2020-01-06 15:26:56', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(10, '{\"k0\":\"poliklinik\",\"k1\":\"poli_gigi\",\"k2\":\"Poli Gigi\"}', '2020-01-06 15:28:07', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(11, '{\"k0\":\"dokter\",\"k1\":\"dr.anton\",\"k2\":\"Dokter Anton\",\"k3\":\"9\",\"k4\":\"Poli Anak\"}', '2020-01-06 15:30:09', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(12, '{\"k0\":\"user_admin\",\"k1\":\"admin\",\"k2\":\"Administrator\",\"k3\":\"QXNIc3B2V0tjelhsYmFCYmxldEZaUT09\",\"k3_validate\":\"admin\",\"k4\":\"13\",\"k5\":\"Administrator\"}', '2020-01-06 15:54:28', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(13, '{\"k0\":\"level_user\",\"k1\":\"administrator\",\"k2\":\"Administrator\",\"k3\":\"0\"}', '2020-01-06 15:55:15', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(15, '{\"k0\":\"level_user\",\"k1\":\"admin_poli_gigi_dokter_budi\",\"k2\":\"Admin Poli Gigi Dokter Budi\",\"k3\":\"23\",\"k3_text\":\"Dokter Budi || Poli Gigi\"}', '2020-01-06 15:57:25', 6012020, '2020-01-14 14:32:08', 0, '0000-00-00 00:00:00', 0),(16, '{\"k0\":\"level_user\",\"k1\":\"admin_poli_kandungan_dokter_ika\",\"k2\":\"Admin Poli Kandungan Dokter Ika\",\"k3\":\"31\",\"k3_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-06 15:58:56', 6012020, '2020-01-14 14:24:51', 0, '0000-00-00 00:00:00', 0),(17, '{\"k0\":\"jadwal_dokter\",\"k1\":\"senin\",\"k2\":\"Senin\",\"k3\":\"15\",\"k4\":\"11\",\"k4_text\":\"Dokter Anton || Poli Anak\"}', '2020-01-06 16:26:33', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(18, '{\"k0\":\"jadwal_dokter\",\"k1\":\"selasa\",\"k2\":\"Selasa\",\"k3\":\"13\",\"k4\":\"11\",\"k4_text\":\"Dokter Anton || Poli Anak\"}', '2020-01-06 16:34:24', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(19, '{\"k0\":\"jadwal_dokter\",\"k1\":\"rabu\",\"k2\":\"Rabu\",\"k3\":\"10\",\"k4\":\"11\",\"k4_text\":\"Dokter Anton || Poli Anak\"}', '2020-01-06 18:35:45', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(20, '{\"k0\":\"category\",\"k1\":\"libur_dokter\",\"k2\":\"Libur Dokter\"}', '2020-01-07 11:48:53', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(21, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-15\",\"k2\":\"2020-01-15\",\"k3\":\"11\"}', '2020-01-07 11:51:25', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(22, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-20\",\"k2\":\"2020-01-20\",\"k3\":\"11\"}', '2020-01-07 12:15:58', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(23, '{\"k0\":\"dokter\",\"k1\":\"dr.budi\",\"k2\":\"Dokter Budi\",\"k3\":\"10\",\"k4\":\"Poli Gigi\"}', '2020-01-08 18:03:21', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(25, '{\"k0\":\"jenis_penjamin\",\"k1\":\"bpjs\",\"k2\":\"Bpjs\"}', '2020-01-10 19:18:07', 12, '2020-01-10 19:51:01', 12, '0000-00-00 00:00:00', 0),(27, '{\"k0\":\"poliklinik\",\"k1\":\"poli_kandungan\",\"k2\":\"Poli Kandungan\"}', '2020-01-10 19:21:58', 12, '2020-01-10 20:56:14', 12, '0000-00-00 00:00:00', 0),(28, '{\"k0\":\"dokter\",\"k1\":\"dokter_setia\",\"k2\":\"Dokter Setia\",\"k3\":\"27\",\"k4\":\"Poli Kandungan\"}', '2020-01-10 20:48:54', 12, '2020-01-10 21:04:46', 12, '0000-00-00 00:00:00', 0),(30, '{\"k0\":\"jenis_penjamin\",\"k1\":\"preudential\",\"k2\":\"Preudential\"}', '2020-01-10 20:55:50', 12, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(31, '{\"k0\":\"dokter\",\"k1\":\"dokter_ika\",\"k2\":\"Dokter Ika\",\"k3\":\"27\",\"k4\":\"Poli Kandungan\"}', '2020-01-10 21:11:36', 12, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(33, '{\"k0\":\"user_admin\",\"k1\":\"dww\",\"k2\":\"Daniel Wija Waluyajati\",\"k3\":\"QXNIc3B2V0tjelhsYmFCYmxldEZaUT09\",\"k3_validate\":\"admin\",\"k4\":\"16\",\"k5\":\"Admin Poli Kandungan\"}', '2020-01-11 08:30:25', 12, '2020-01-14 11:35:25', 0, '0000-00-00 00:00:00', 0),(34, '{\"k0\":\"jadwal_dokter\",\"k1\":\"senin\",\"k2\":\"Senin\",\"k3\":\"17\",\"k4\":31,\"k4_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:19:27', 12, '2020-01-11 09:24:39', 12, '0000-00-00 00:00:00', 0),(35, '{\"k0\":\"jadwal_dokter\",\"k1\":\"selasa\",\"k2\":\"Selasa\",\"k3\":\"17\",\"k4\":\"31\",\"k4_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:20:55', 12, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(36, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-21\",\"k2\":\"2020-01-21\",\"k3\":\"31\",\"k3_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:34:27', 12, '2020-01-11 09:48:36', 12, '0000-00-00 00:00:00', 0),(37, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-28\",\"k2\":\"2020-01-28\",\"k3\":\"31\",\"k3_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:35:50', 12, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(38, '{\"k0\":\"jenis_penjamin\",\"k1\":\"pt._sinarmas\",\"k2\":\"PT. Sinarmas\"}', '2020-01-11 09:48:57', 12, '2020-01-11 09:49:22', 12, '2020-01-11 09:49:46', 12),(39, '{\"k0\":\"poliklinik\",\"k1\":\"poli_jantung_2\",\"k2\":\"Poli Jantung 2\"}', '2020-01-11 09:50:21', 12, '2020-01-11 09:50:39', 12, '2020-01-11 09:50:49', 12),(40, '{\"k0\":\"dokter\",\"k1\":\"dokter_rio\",\"k2\":\"Dokter Rio\",\"k3\":\"9\",\"k4\":\"Poli Anak\"}', '2020-01-11 09:51:09', 12, '2020-01-11 09:51:43', 12, '0000-00-00 00:00:00', 0),(41, '{\"k0\":\"user_admin\",\"k1\":\"jantung1\",\"k2\":\"Perawat Jantung\",\"k3\":\"QXNIc3B2V0tjelhsYmFCYmxldEZaUT09\",\"k3_validate\":\"admin\",\"k4\":\"14\",\"k5\":\"Editor\"}', '2020-01-11 09:52:09', 12, '2020-01-11 09:54:04', 12, '2020-01-11 09:54:35', 12),(42, '{\"k0\":\"jadwal_dokter\",\"k1\":\"sabtu\",\"k2\":\"Sabtu\",\"k3\":\"20\",\"k4\":\"31\",\"k4_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:54:55', 12, '2020-01-11 10:21:28', 12, '0000-00-00 00:00:00', 0),(43, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-27\",\"k2\":\"2020-01-27\",\"k3\":\"31\",\"k3_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:56:19', 12, '2020-01-11 10:02:29', 12, '0000-00-00 00:00:00', 0),(44, '{\"k0\":\"level_user\",\"k1\":\"admin_poli_anak_dokter_anton\",\"k2\":\"Admin Poli Anak Dokter Anton\",\"k3\":\"11\",\"k3_text\":\"Dokter Anton || Poli Anak\"}', '2020-01-14 14:19:26', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),(45, '{\"k0\":\"user_admin\",\"k1\":\"drbud\",\"k2\":\"Dokter Budi\",\"k3\":\"QXNIc3B2V0tjelhsYmFCYmxldEZaUT09\",\"k3_validate\":\"admin\",\"k4\":\"15\",\"k5\":\"Admin Poli Gigi Dokter Budi\"}', '2020-01-14 14:32:48', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);
UNLOCK TABLES;
COMMIT;
