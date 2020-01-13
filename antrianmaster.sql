-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2020 at 07:47 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antrianmaster`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_terbilang` (IN `angka` BIGINT, OUT `retval` TEXT)  BEGIN
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
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `f_terbilang` (`angka` BIGINT) RETURNS TEXT CHARSET latin1 BEGIN
-- @rgiapratama - 2017
    DECLARE v_result TEXT;
    CALL p_terbilang(angka, v_result);
    RETURN REPLACE(v_result,'  ',' ');
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `api_key` varchar(50) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `date_created` date DEFAULT NULL,
  `date_modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `api_limit`
--

CREATE TABLE `api_limit` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `uri` varchar(200) NOT NULL,
  `class` varchar(200) NOT NULL,
  `method` varchar(200) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tm_antrian`
--

CREATE TABLE `tm_antrian` (
  `antrian_id` int(11) NOT NULL,
  `antrian_data` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(32) NOT NULL DEFAULT 6012020,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(32) NOT NULL DEFAULT 6012020,
  `deleted_at` datetime NOT NULL,
  `deleted_by` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_antrian`
--

INSERT INTO `tm_antrian` (`antrian_id`, `antrian_data`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '{\"child_id\":\"35\",\"penjamin\":\"8\",\"poliklinik\":\"27\",\"dokter\":\"31\",\"hari_tanggal\":\"2020-01-14\",\"nomor_urut\":\"1\",\"nomor_rm\":\"3995\",\"alamat\":\"BANYUMAS\",\"dokter_history\":[\"id\",\"31\",\"text\",\"Dokter Ika\",\"selected\",\"true\"],\"hari_tanggal_history\":[\"id\",\"2020-01-14\",\"text\",\"Selasa\",\" 14 Januari 2020\",\"child_id\",\"35\",\"selected\",\"true\"],\"called_antrian\":\"0\",\"is_online\":\"0\"}', '2020-01-13 23:51:59', 3995, '2020-01-13 23:51:59', 6012020, '0000-00-00 00:00:00', 0),
(2, '{\"child_id\":\"35\",\"penjamin\":\"8\",\"poliklinik\":\"27\",\"dokter\":\"31\",\"hari_tanggal\":\"2020-01-14\",\"nomor_urut\":\"5\",\"nomor_rm\":\"3996\",\"alamat\":\"BANYUMAS\",\"dokter_history\":[\"id\",\"31\",\"text\",\"Dokter Ika\",\"selected\",\"true\"],\"hari_tanggal_history\":[\"id\",\"2020-01-14\",\"text\",\"Selasa\",\" 14 Januari 2020\",\"child_id\",\"35\",\"selected\",\"true\"],\"called_antrian\":\"0\",\"is_online\":\"1\"}', '2020-01-13 23:52:32', 3996, '2020-01-13 23:52:32', 6012020, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tm_data`
--

CREATE TABLE `tm_data` (
  `child_id` int(32) NOT NULL,
  `child_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ;

--
-- Dumping data for table `tm_data`
--

INSERT INTO `tm_data` (`child_id`, `child_value`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '{\"k0\":\"category\",\"k1\":\"jenis_penjamin\",\"k2\":\"Jenis Penjamin\"}', '2020-01-06 08:19:38', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, '{\"k0\":\"category\",\"k1\":\"poliklinik\",\"k2\":\"Poliklinik\"}', '2020-01-06 08:20:49', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, '{\"k0\":\"category\",\"k1\":\"dokter\",\"k2\":\"Dokter\"}', '2020-01-06 08:22:26', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, '{\"k0\":\"category\",\"k1\":\"user_admin\",\"k2\":\"Administrator\"}', '2020-01-06 08:27:56', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(5, '{\"k0\":\"category\",\"k1\":\"level_user\",\"k2\":\"Level Hak Akses\"}', '2020-01-06 08:28:32', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(6, '{\"k0\":\"category\",\"k1\":\"jadwal_dokter\",\"k2\":\"Jadwal Dokter\"}', '2020-01-06 08:32:13', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(7, '\r\n{\"k0\":\"jenis_penjamin\",\"k1\":\"asuransi\",\"k2\":\"Asuransi\"}', '2020-01-06 14:21:14', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(8, '\r\n{\"k0\":\"jenis_penjamin\",\"k1\":\"umum\",\"k2\":\"Umum\"}', '2020-01-06 14:21:36', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(9, '\r\n{\"k0\":\"poliklinik\",\"k1\":\"poli_anak\",\"k2\":\"Poli Anak\"}', '2020-01-06 15:26:56', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(10, '{\"k0\":\"poliklinik\",\"k1\":\"poli_gigi\",\"k2\":\"Poli Gigi\"}', '2020-01-06 15:28:07', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(11, '{\"k0\":\"dokter\",\"k1\":\"dr.anton\",\"k2\":\"Dokter Anton\",\"k3\":\"9\",\"k4\":\"Poli Anak\"}', '2020-01-06 15:30:09', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(12, '{\"k0\":\"user_admin\",\"k1\":\"admin\",\"k2\":\"Administrator\",\"k3\":\"QXNIc3B2V0tjelhsYmFCYmxldEZaUT09\",\"k3_validate\":\"admin\",\"k4\":\"13\",\"k5\":\"Administrator\"}', '2020-01-06 15:54:28', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(13, '{\"k0\":\"level_user\",\"k1\":\"administrator\",\"k2\":\"Administrator\"}', '2020-01-06 15:55:15', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(14, '{\"k0\":\"level_user\",\"k1\":\"editor\",\"k2\":\"Editor\"}', '2020-01-06 15:56:15', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(15, '{\"k0\":\"level_user\",\"k1\":\"author\",\"k2\":\"Author\"}', '2020-01-06 15:57:25', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(16, '{\"k0\":\"level_user\",\"k1\":\"contributtor\",\"k2\":\"Contributtor\"}', '2020-01-06 15:58:56', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(17, '{\"k0\":\"jadwal_dokter\",\"k1\":\"senin\",\"k2\":\"Senin\",\"k3\":\"15\",\"k4\":\"11\",\"k4_text\":\"Dokter Anton || Poli Anak\"}', '2020-01-06 16:26:33', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(18, '{\"k0\":\"jadwal_dokter\",\"k1\":\"selasa\",\"k2\":\"Selasa\",\"k3\":\"13\",\"k4\":\"11\",\"k4_text\":\"Dokter Anton || Poli Anak\"}', '2020-01-06 16:34:24', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(19, '{\"k0\":\"jadwal_dokter\",\"k1\":\"rabu\",\"k2\":\"Rabu\",\"k3\":\"10\",\"k4\":\"11\",\"k4_text\":\"Dokter Anton || Poli Anak\"}', '2020-01-06 18:35:45', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(20, '{\"k0\":\"category\",\"k1\":\"libur_dokter\",\"k2\":\"Libur Dokter\"}', '2020-01-07 11:48:53', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(21, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-15\",\"k2\":\"2020-01-15\",\"k3\":\"11\"}', '2020-01-07 11:51:25', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(22, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-20\",\"k2\":\"2020-01-20\",\"k3\":\"11\"}', '2020-01-07 12:15:58', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(23, '{\"k0\":\"dokter\",\"k1\":\"dr.budi\",\"k2\":\"Dokter Budi\",\"k3\":\"10\",\"k4\":\"Poli Gigi\"}', '2020-01-08 18:03:21', 6012020, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(25, '{\"k0\":\"jenis_penjamin\",\"k1\":\"bpjs\",\"k2\":\"Bpjs\"}', '2020-01-10 19:18:07', 12, '2020-01-10 19:51:01', 12, '0000-00-00 00:00:00', 0),
(27, '{\"k0\":\"poliklinik\",\"k1\":\"poli_kandungan\",\"k2\":\"Poli Kandungan\"}', '2020-01-10 19:21:58', 12, '2020-01-10 20:56:14', 12, '0000-00-00 00:00:00', 0),
(28, '{\"k0\":\"dokter\",\"k1\":\"dokter_setia\",\"k2\":\"Dokter Setia\",\"k3\":\"27\",\"k4\":\"Poli Kandungan\"}', '2020-01-10 20:48:54', 12, '2020-01-10 21:04:46', 12, '0000-00-00 00:00:00', 0),
(30, '{\"k0\":\"jenis_penjamin\",\"k1\":\"preudential\",\"k2\":\"Preudential\"}', '2020-01-10 20:55:50', 12, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(31, '{\"k0\":\"dokter\",\"k1\":\"dokter_ika\",\"k2\":\"Dokter Ika\",\"k3\":\"27\",\"k4\":\"Poli Kandungan\"}', '2020-01-10 21:11:36', 12, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(33, '{\"k0\":\"user_admin\",\"k1\":\"dww\",\"k2\":\"Daniel Wija Waluyajati\",\"k3\":\"QXNIc3B2V0tjelhsYmFCYmxldEZaUT09\",\"k3_validate\":\"admin\",\"k4\":\"13\",\"k5\":\"Administrator\"}', '2020-01-11 08:30:25', 12, '2020-01-11 08:41:11', 12, '0000-00-00 00:00:00', 0),
(34, '{\"k0\":\"jadwal_dokter\",\"k1\":\"senin\",\"k2\":\"Senin\",\"k3\":\"17\",\"k4\":31,\"k4_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:19:27', 12, '2020-01-11 09:24:39', 12, '0000-00-00 00:00:00', 0),
(35, '{\"k0\":\"jadwal_dokter\",\"k1\":\"selasa\",\"k2\":\"Selasa\",\"k3\":\"17\",\"k4\":\"31\",\"k4_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:20:55', 12, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(36, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-21\",\"k2\":\"2020-01-21\",\"k3\":\"31\",\"k3_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:34:27', 12, '2020-01-11 09:48:36', 12, '0000-00-00 00:00:00', 0),
(37, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-28\",\"k2\":\"2020-01-28\",\"k3\":\"31\",\"k3_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:35:50', 12, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(38, '{\"k0\":\"jenis_penjamin\",\"k1\":\"pt._sinarmas\",\"k2\":\"PT. Sinarmas\"}', '2020-01-11 09:48:57', 12, '2020-01-11 09:49:22', 12, '2020-01-11 09:49:46', 12),
(39, '{\"k0\":\"poliklinik\",\"k1\":\"poli_jantung_2\",\"k2\":\"Poli Jantung 2\"}', '2020-01-11 09:50:21', 12, '2020-01-11 09:50:39', 12, '2020-01-11 09:50:49', 12),
(40, '{\"k0\":\"dokter\",\"k1\":\"dokter_rio\",\"k2\":\"Dokter Rio\",\"k3\":\"9\",\"k4\":\"Poli Anak\"}', '2020-01-11 09:51:09', 12, '2020-01-11 09:51:43', 12, '0000-00-00 00:00:00', 0),
(41, '{\"k0\":\"user_admin\",\"k1\":\"jantung1\",\"k2\":\"Perawat Jantung\",\"k3\":\"QXNIc3B2V0tjelhsYmFCYmxldEZaUT09\",\"k3_validate\":\"admin\",\"k4\":\"14\",\"k5\":\"Editor\"}', '2020-01-11 09:52:09', 12, '2020-01-11 09:54:04', 12, '2020-01-11 09:54:35', 12),
(42, '{\"k0\":\"jadwal_dokter\",\"k1\":\"sabtu\",\"k2\":\"Sabtu\",\"k3\":\"20\",\"k4\":\"31\",\"k4_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:54:55', 12, '2020-01-11 10:21:28', 12, '0000-00-00 00:00:00', 0),
(43, '{\"k0\":\"libur_dokter\",\"k1\":\"2020-01-27\",\"k2\":\"2020-01-27\",\"k3\":\"31\",\"k3_text\":\"Dokter Ika || Poli Kandungan\"}', '2020-01-11 09:56:19', 12, '2020-01-11 10:02:29', 12, '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_limit`
--
ALTER TABLE `api_limit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tm_antrian`
--
ALTER TABLE `tm_antrian`
  ADD PRIMARY KEY (`antrian_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `api_limit`
--
ALTER TABLE `api_limit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tm_antrian`
--
ALTER TABLE `tm_antrian`
  MODIFY `antrian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tm_data`
--
ALTER TABLE `tm_data`
  MODIFY `child_id` int(32) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
