-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: imxscore
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES (1,'8A','Kelas 8 A','2025-09-28 08:01:12','2025-09-28 08:01:12'),(2,'7 Leader','Leader','2025-09-28 08:16:31','2025-09-28 08:16:31'),(3,'7 Reguler','Reguler','2025-09-28 08:16:48','2025-09-28 08:16:48');
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grades` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `notes_scores` json DEFAULT NULL,
  `assignments_scores` json DEFAULT NULL,
  `attendance_present` int NOT NULL DEFAULT '0',
  `attendance_permission` int NOT NULL DEFAULT '0',
  `attendance_sick` int NOT NULL DEFAULT '0',
  `attendance_absent` int NOT NULL DEFAULT '0',
  `final_average` decimal(5,2) DEFAULT NULL,
  `semester` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `academic_year` year NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grades_student_id_foreign` (`student_id`),
  CONSTRAINT `grades_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grades`
--

LOCK TABLES `grades` WRITE;
/*!40000 ALTER TABLE `grades` DISABLE KEYS */;
/*!40000 ALTER TABLE `grades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas`
--

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` VALUES (1,'7 Leader','7','2025-10-12 07:57:12','2025-10-24 07:50:35'),(2,'9 A Leader','9','2025-10-12 21:32:16','2025-10-24 07:54:45'),(3,'7 Reguler','7','2025-10-12 22:11:36','2025-10-24 07:50:58'),(4,'9 B  Solid','9','2025-10-13 21:42:14','2025-10-24 07:54:53'),(5,'8 B Gacor','8','2025-10-17 18:06:52','2025-10-24 07:51:21'),(6,'8 A','8','2025-10-17 18:38:49','2025-10-24 07:51:09');
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `komponen_nilai`
--

DROP TABLE IF EXISTS `komponen_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `komponen_nilai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mata_pelajaran_id` bigint unsigned NOT NULL,
  `nama_komponen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` int NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `komponen_nilai_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  CONSTRAINT `komponen_nilai_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komponen_nilai`
--

LOCK TABLES `komponen_nilai` WRITE;
/*!40000 ALTER TABLE `komponen_nilai` DISABLE KEYS */;
INSERT INTO `komponen_nilai` VALUES (1,1,'Catatan',10,1,'2025-10-19 21:36:42','2025-10-19 21:36:42'),(2,1,'Tugas',10,2,'2025-10-19 21:37:08','2025-10-19 21:37:08'),(3,1,'UTS',25,3,'2025-10-19 21:37:20','2025-10-19 21:37:20'),(4,1,'UAS',35,4,'2025-10-19 21:37:31','2025-10-19 21:37:31'),(5,1,'Kehadiran',10,5,'2025-10-19 21:37:40','2025-10-19 21:37:40'),(6,1,'Etika',10,6,'2025-10-19 21:37:50','2025-10-19 21:37:50'),(12,2,'Tugas',25,1,'2025-10-21 10:43:57','2025-10-21 10:43:57'),(13,2,'Praktik',15,2,'2025-10-21 10:44:15','2025-10-24 22:21:27'),(14,2,'UTS',25,3,'2025-10-21 10:44:31','2025-10-21 10:44:31'),(15,2,'UAS',35,4,'2025-10-21 10:44:44','2025-10-21 10:44:44'),(16,3,'Tugas',30,1,'2025-10-21 10:46:07','2025-10-21 10:46:07'),(17,3,'Praktik',20,2,'2025-10-21 10:46:23','2025-10-21 10:46:23'),(18,3,'UTS',20,3,'2025-10-21 10:46:34','2025-10-21 10:46:34'),(19,3,'UAS',30,4,'2025-10-21 10:46:44','2025-10-21 10:46:44'),(20,4,'Praktikum',20,1,'2025-10-21 10:47:35','2025-10-21 10:47:35'),(21,4,'UTS',25,2,'2025-10-21 10:47:45','2025-10-21 10:59:48'),(22,4,'Tugas',25,3,'2025-10-21 10:47:57','2025-10-21 10:47:57'),(23,4,'UAS',30,4,'2025-10-21 10:48:08','2025-10-21 10:48:08'),(24,5,'Tugas',30,1,'2025-10-21 10:48:52','2025-10-21 10:48:52'),(25,5,'Proyek',20,2,'2025-10-21 10:49:06','2025-10-21 10:49:06'),(26,5,'UTS',20,3,'2025-10-21 10:49:15','2025-10-21 10:49:15'),(27,5,'UAS',30,4,'2025-10-21 10:49:25','2025-10-21 10:49:25'),(28,6,'Tugas',25,1,'2025-10-21 11:06:41','2025-10-21 11:06:41'),(29,6,'Praktik',25,2,'2025-10-21 11:06:58','2025-10-21 11:06:58'),(30,6,'UTS',20,3,'2025-10-21 11:07:13','2025-10-21 11:07:13'),(31,6,'UAS',30,4,'2025-10-21 11:07:26','2025-10-21 11:07:26'),(32,7,'Tugas',20,1,'2025-10-21 11:08:24','2025-10-21 11:08:24'),(33,7,'Praktik',50,2,'2025-10-21 11:08:34','2025-10-21 11:08:34'),(34,7,'UTS',10,3,'2025-10-21 11:08:45','2025-10-21 11:08:45'),(35,7,'UAS',20,4,'2025-10-21 11:09:01','2025-10-21 11:09:01');
/*!40000 ALTER TABLE `komponen_nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mata_pelajaran`
--

DROP TABLE IF EXISTS `mata_pelajaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mata_pelajaran` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_mapel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_mapel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mata_pelajaran_kode_mapel_unique` (`kode_mapel`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mata_pelajaran`
--

LOCK TABLES `mata_pelajaran` WRITE;
/*!40000 ALTER TABLE `mata_pelajaran` DISABLE KEYS */;
INSERT INTO `mata_pelajaran` VALUES (1,'Teknologi Informasi dan Komputer','TIK',NULL,'2025-10-18 07:22:04','2025-10-24 08:57:41'),(2,'Matematika','MTK',NULL,'2025-10-18 07:23:14','2025-10-18 07:23:14'),(3,'Bahasa Indonesia','BIND',NULL,'2025-10-19 21:45:19','2025-10-21 10:45:19'),(4,'Ilmu Pengetahuan Alam','IPA',NULL,'2025-10-21 10:47:16','2025-10-21 10:47:16'),(5,'Ilmu Pengetahuan Sosial','IPS',NULL,'2025-10-21 10:48:30','2025-10-21 10:48:30'),(6,'Bahasa Inggris','BING',NULL,'2025-10-21 11:06:25','2025-10-21 11:06:25'),(7,'Pendidikan Jasmani dan Olahraga','PJOK',NULL,'2025-10-21 11:08:04','2025-10-21 11:08:04');
/*!40000 ALTER TABLE `mata_pelajaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_09_28_141556_create_classes_table',1),(6,'2025_09_28_141645_create_students_table',1),(7,'2025_09_28_141706_create_grades_table',1),(8,'2025_09_28_153730_update_assignments_scores_in_grades_table',2),(9,'2025_10_12_143011_create_kelas_table',3),(10,'2025_10_12_143054_create_siswa_table',3),(11,'2025_10_12_143121_create_nilai_table',3),(12,'2025_10_18_124331_create_tahun_ajaran_table',4),(13,'2025_10_18_124359_create_mata_pelajaran_table',4),(14,'2025_10_18_124427_create_komponen_nilai_table',4),(15,'2025_10_18_124500_update_nilai_table_for_mapel',4),(16,'2025_10_23_124746_add_role_to_users_table',5),(17,'2025_10_23_124812_user_id_to_siswa_table',5),(18,'2025_10_23_124831_add_guru_id_to_nilai_table',5),(19,'2025_10_25_104219_add_nilai_dongkrak_to_nilai_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nilai`
--

DROP TABLE IF EXISTS `nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nilai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `guru_id` bigint unsigned DEFAULT NULL,
  `mata_pelajaran_id` bigint unsigned DEFAULT NULL,
  `tahun_ajaran_id` bigint unsigned DEFAULT NULL,
  `catatan` json DEFAULT NULL,
  `nilai_komponen` json DEFAULT NULL,
  `nilai_tugas` decimal(5,2) NOT NULL DEFAULT '0.00',
  `nilai_mid` decimal(5,2) NOT NULL DEFAULT '0.00',
  `nilai_uas` decimal(5,2) NOT NULL DEFAULT '0.00',
  `hadir` int NOT NULL DEFAULT '0',
  `izin` int NOT NULL DEFAULT '0',
  `sakit` int NOT NULL DEFAULT '0',
  `alfa` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nilai_dongkrak` decimal(5,2) DEFAULT NULL,
  `catatan_dongkrak` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `nilai_siswa_id_foreign` (`siswa_id`),
  KEY `nilai_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  KEY `nilai_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  KEY `nilai_guru_id_foreign` (`guru_id`),
  CONSTRAINT `nilai_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `nilai_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE,
  CONSTRAINT `nilai_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE,
  CONSTRAINT `nilai_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=277 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nilai`
--

LOCK TABLES `nilai` WRITE;
/*!40000 ALTER TABLE `nilai` DISABLE KEYS */;
INSERT INTO `nilai` VALUES (1,1,NULL,NULL,NULL,'[]',NULL,80.00,60.00,80.00,9,1,0,0,'2025-10-12 08:15:50','2025-10-14 23:24:38',NULL,NULL),(2,2,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(3,3,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,1,0,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(4,4,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(5,5,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(6,6,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(7,7,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,1,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(8,8,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,1,0,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(9,9,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(10,10,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,1,0,0,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(11,11,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(12,12,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(13,13,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(14,14,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(15,15,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(16,16,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(17,17,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:09','2025-10-12 21:44:58',NULL,NULL),(18,18,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:10','2025-10-12 21:44:58',NULL,NULL),(19,19,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,1,'2025-10-12 21:44:10','2025-10-12 21:44:58',NULL,NULL),(20,20,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,1,'2025-10-12 21:44:10','2025-10-12 21:44:58',NULL,NULL),(21,21,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:10','2025-10-12 21:44:58',NULL,NULL),(22,22,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:10','2025-10-12 21:44:58',NULL,NULL),(23,23,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:10','2025-10-12 21:44:58',NULL,NULL),(24,24,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:10','2025-10-12 21:44:58',NULL,NULL),(25,25,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-12 21:44:58','2025-10-12 21:44:58',NULL,NULL),(26,26,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(27,27,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(28,28,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(29,29,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(30,30,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(31,31,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(32,32,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(33,33,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(34,34,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(35,35,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(36,36,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(37,37,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(38,38,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(39,39,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(40,41,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(41,42,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(42,43,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(43,44,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(44,45,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,0,'2025-10-12 22:22:12','2025-10-12 22:22:12',NULL,NULL),(45,46,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 4\", \"Catatan 5\"]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(46,47,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\"]',NULL,95.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(47,48,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\"]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(48,49,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\"]',NULL,90.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(49,50,NULL,NULL,NULL,'[\"Catatan 2\", \"Catatan 3\", \"Catatan 4\"]',NULL,35.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(50,51,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(51,52,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,1,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(52,53,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\"]',NULL,90.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(53,54,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,1,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(54,55,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(55,56,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(56,57,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,1,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(57,58,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(58,59,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(59,60,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(60,61,NULL,NULL,NULL,'[\"Catatan 3\", \"Catatan 4\", \"Catatan 5\"]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(61,62,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\"]',NULL,100.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(62,63,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,1,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:10',NULL,NULL),(63,64,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:11',NULL,NULL),(64,65,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\"]',NULL,100.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:11',NULL,NULL),(65,66,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:11',NULL,NULL),(66,67,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\"]',NULL,100.00,0.00,0.00,1,0,0,0,'2025-10-13 22:30:26','2025-10-13 22:58:11',NULL,NULL),(67,82,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-13 22:31:36','2025-10-13 22:58:11',NULL,NULL),(68,68,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\"]',NULL,95.00,0.00,0.00,9,0,0,0,'2025-10-14 23:03:13','2025-10-14 23:24:38',NULL,NULL),(69,69,NULL,NULL,NULL,'[\"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\"]',NULL,25.00,20.00,0.00,9,0,0,0,'2025-10-14 23:03:13','2025-10-14 23:24:38',NULL,NULL),(70,70,NULL,NULL,NULL,'[\"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\"]',NULL,100.00,0.00,0.00,9,0,0,0,'2025-10-14 23:03:13','2025-10-14 23:24:38',NULL,NULL),(71,71,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,8,1,0,0,'2025-10-14 23:03:13','2025-10-14 23:24:38',NULL,NULL),(72,72,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\"]',NULL,65.00,0.00,0.00,9,0,0,0,'2025-10-14 23:03:13','2025-10-14 23:24:38',NULL,NULL),(73,73,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\"]',NULL,80.00,0.00,0.00,9,0,0,0,'2025-10-14 23:03:13','2025-10-14 23:24:38',NULL,NULL),(74,74,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\"]',NULL,0.00,0.00,0.00,9,0,0,0,'2025-10-14 23:03:13','2025-10-14 23:24:38',NULL,NULL),(75,75,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\"]',NULL,85.00,0.00,0.00,9,0,0,0,'2025-10-14 23:03:13','2025-10-14 23:24:38',NULL,NULL),(76,76,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\"]',NULL,100.00,0.00,0.00,9,0,0,0,'2025-10-14 23:03:13','2025-10-14 23:24:38',NULL,NULL),(77,77,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\"]',NULL,85.00,0.00,0.00,9,0,0,0,'2025-10-14 23:03:13','2025-10-14 23:24:38',NULL,NULL),(78,78,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\"]',NULL,0.00,0.00,0.00,8,1,0,0,'2025-10-14 23:03:13','2025-10-14 23:24:38',NULL,NULL),(79,79,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\"]',NULL,75.00,0.00,0.00,9,0,0,0,'2025-10-14 23:03:13','2025-10-14 23:24:38',NULL,NULL),(80,80,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\"]',NULL,60.00,0.00,0.00,9,0,0,0,'2025-10-14 23:03:13','2025-10-14 23:24:38',NULL,NULL),(81,81,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\"]',NULL,95.00,0.00,0.00,9,0,0,0,'2025-10-14 23:03:13','2025-10-14 23:24:38',NULL,NULL),(82,83,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 6\"]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(83,84,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,1,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(84,85,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(85,86,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(86,87,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 6\"]',NULL,80.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(87,88,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\"]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(88,89,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(89,90,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(90,91,NULL,NULL,NULL,'[\"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 6\"]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(91,92,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(92,93,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 6\"]',NULL,85.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(93,94,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 6\"]',NULL,85.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(94,95,NULL,NULL,NULL,'[\"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 6\"]',NULL,85.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(95,96,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 6\"]',NULL,95.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(96,97,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 6\"]',NULL,85.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(97,98,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,1,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(98,99,NULL,NULL,NULL,'[\"Catatan 4\"]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(99,100,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(100,101,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 6\"]',NULL,70.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(101,102,NULL,NULL,NULL,'[\"Catatan 1\", \"Catatan 2\"]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(102,103,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,1,'2025-10-17 18:18:19','2025-10-17 18:32:02',NULL,NULL),(103,104,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,1,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(104,105,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(105,106,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,1,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(106,107,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,1,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(107,108,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(108,109,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(109,110,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(110,112,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(111,113,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(112,114,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(113,115,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(114,116,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(115,117,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(116,118,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(117,119,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(118,120,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,1,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(119,121,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(120,122,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(121,123,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(122,124,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(123,125,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,1,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(124,126,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,9,0,0,0,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(125,127,NULL,NULL,NULL,'[]',NULL,0.00,0.00,0.00,0,0,0,1,'2025-10-17 20:13:34','2025-10-17 20:29:25',NULL,NULL),(126,2,NULL,1,1,'[]','{\"1\": \"10\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(127,3,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(128,4,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(129,23,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(130,5,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(131,6,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(132,7,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(133,8,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(134,9,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(135,10,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(136,24,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(137,22,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(138,12,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(139,11,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(140,13,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(141,14,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(142,15,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(143,25,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(144,40,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(145,17,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(146,16,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(147,21,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(148,18,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(149,19,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(150,20,NULL,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-20 20:41:14','2025-10-20 20:41:14',NULL,NULL),(151,68,1,1,1,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\", \"Catatan 8\", \"Catatan 10\"]','{\"1\": \"30\", \"2\": \"80\", \"3\": \"70\", \"4\": \"85\", \"5\": \"90\", \"6\": \"30\"}',0.00,0.00,0.00,24,4,0,2,'2025-10-21 10:51:40','2025-11-03 07:46:46',80.00,NULL),(152,69,1,1,1,'[]','{\"1\": \"25\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:51:40','2025-11-03 07:46:46',NULL,NULL),(153,70,1,1,1,'[]','{\"1\": \"10\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:51:40','2025-11-03 07:46:46',NULL,NULL),(154,71,1,1,1,'[]','{\"1\": \"50\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:51:40','2025-11-03 07:46:46',NULL,NULL),(155,72,1,1,1,'[]','{\"1\": \"70\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:51:40','2025-11-03 07:46:46',NULL,NULL),(156,73,1,1,1,'[]','{\"1\": \"85\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:51:40','2025-11-03 07:46:46',NULL,NULL),(157,74,1,1,1,'[]','{\"1\": \"60\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:51:40','2025-11-03 07:46:46',NULL,NULL),(158,75,1,1,1,'[]','{\"1\": \"50\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:51:40','2025-11-03 07:46:46',NULL,NULL),(159,76,1,1,1,'[]','{\"1\": \"10\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:51:40','2025-11-03 07:46:46',NULL,NULL),(160,77,1,1,1,'[]','{\"1\": \"50\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:51:40','2025-11-03 07:46:46',NULL,NULL),(161,1,1,1,1,'[]','{\"1\": \"30\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:51:40','2025-11-03 07:46:46',NULL,NULL),(162,78,1,1,1,'[]','{\"1\": \"70\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:51:40','2025-11-03 07:46:46',NULL,NULL),(163,79,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:51:40','2025-11-03 07:46:46',NULL,NULL),(164,80,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:51:40','2025-11-03 07:46:46',NULL,NULL),(165,81,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:51:40','2025-11-03 07:46:46',NULL,NULL),(166,68,NULL,2,1,'[\"Catatan 1\", \"Catatan 3\", \"Catatan 5\"]','{\"12\": \"80\", \"13\": \"75\", \"14\": \"85\", \"15\": \"90\"}',0.00,0.00,0.00,34,2,1,1,'2025-10-21 10:55:49','2025-10-26 21:18:33',95.00,NULL),(167,69,NULL,2,1,'[]','{\"12\": \"0\", \"13\": \"0\", \"14\": \"0\", \"15\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:55:49','2025-10-21 10:55:49',NULL,NULL),(168,70,NULL,2,1,'[]','{\"12\": \"0\", \"13\": \"0\", \"14\": \"0\", \"15\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:55:49','2025-10-21 10:55:49',NULL,NULL),(169,71,NULL,2,1,'[]','{\"12\": \"0\", \"13\": \"0\", \"14\": \"0\", \"15\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:55:49','2025-10-21 10:55:49',NULL,NULL),(170,72,NULL,2,1,'[]','{\"12\": \"0\", \"13\": \"0\", \"14\": \"0\", \"15\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:55:49','2025-10-21 10:55:49',NULL,NULL),(171,73,NULL,2,1,'[]','{\"12\": \"0\", \"13\": \"0\", \"14\": \"0\", \"15\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:55:49','2025-10-21 10:55:49',NULL,NULL),(172,74,NULL,2,1,'[]','{\"12\": \"0\", \"13\": \"0\", \"14\": \"0\", \"15\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:55:49','2025-10-21 10:55:49',NULL,NULL),(173,75,NULL,2,1,'[]','{\"12\": \"0\", \"13\": \"0\", \"14\": \"0\", \"15\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:55:49','2025-10-21 10:55:49',NULL,NULL),(174,76,NULL,2,1,'[]','{\"12\": \"0\", \"13\": \"0\", \"14\": \"0\", \"15\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:55:49','2025-10-21 10:55:49',NULL,NULL),(175,77,NULL,2,1,'[]','{\"12\": \"0\", \"13\": \"0\", \"14\": \"0\", \"15\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:55:49','2025-10-21 10:55:49',NULL,NULL),(176,1,NULL,2,1,'[]','{\"12\": \"0\", \"13\": \"0\", \"14\": \"0\", \"15\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:55:49','2025-10-21 10:55:49',NULL,NULL),(177,78,NULL,2,1,'[]','{\"12\": \"0\", \"13\": \"0\", \"14\": \"0\", \"15\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:55:49','2025-10-21 10:55:49',NULL,NULL),(178,79,NULL,2,1,'[]','{\"12\": \"0\", \"13\": \"0\", \"14\": \"0\", \"15\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:55:49','2025-10-21 10:55:49',NULL,NULL),(179,80,NULL,2,1,'[]','{\"12\": \"0\", \"13\": \"0\", \"14\": \"0\", \"15\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:55:49','2025-10-21 10:55:49',NULL,NULL),(180,81,NULL,2,1,'[]','{\"12\": \"0\", \"13\": \"0\", \"14\": \"0\", \"15\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:55:49','2025-10-21 10:55:49',NULL,NULL),(181,68,NULL,3,1,'[\"Catatan 1\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\"]','{\"16\": \"88\", \"17\": \"92\", \"18\": \"85\", \"19\": \"90\"}',0.00,0.00,0.00,35,1,1,0,'2025-10-21 10:57:13','2025-10-21 10:57:13',NULL,NULL),(182,69,NULL,3,1,'[]','{\"16\": \"0\", \"17\": \"0\", \"18\": \"0\", \"19\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:57:13','2025-10-21 10:57:13',NULL,NULL),(183,70,NULL,3,1,'[]','{\"16\": \"0\", \"17\": \"0\", \"18\": \"0\", \"19\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:57:13','2025-10-21 10:57:13',NULL,NULL),(184,71,NULL,3,1,'[]','{\"16\": \"0\", \"17\": \"0\", \"18\": \"0\", \"19\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:57:13','2025-10-21 10:57:13',NULL,NULL),(185,72,NULL,3,1,'[]','{\"16\": \"0\", \"17\": \"0\", \"18\": \"0\", \"19\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:57:13','2025-10-21 10:57:13',NULL,NULL),(186,73,NULL,3,1,'[]','{\"16\": \"0\", \"17\": \"0\", \"18\": \"0\", \"19\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:57:13','2025-10-21 10:57:13',NULL,NULL),(187,74,NULL,3,1,'[]','{\"16\": \"0\", \"17\": \"0\", \"18\": \"0\", \"19\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:57:13','2025-10-21 10:57:13',NULL,NULL),(188,75,NULL,3,1,'[]','{\"16\": \"0\", \"17\": \"0\", \"18\": \"0\", \"19\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:57:13','2025-10-21 10:57:13',NULL,NULL),(189,76,NULL,3,1,'[]','{\"16\": \"0\", \"17\": \"0\", \"18\": \"0\", \"19\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:57:13','2025-10-21 10:57:13',NULL,NULL),(190,77,NULL,3,1,'[]','{\"16\": \"0\", \"17\": \"0\", \"18\": \"0\", \"19\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:57:13','2025-10-21 10:57:13',NULL,NULL),(191,1,NULL,3,1,'[]','{\"16\": \"0\", \"17\": \"0\", \"18\": \"0\", \"19\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:57:13','2025-10-21 10:57:13',NULL,NULL),(192,78,NULL,3,1,'[]','{\"16\": \"0\", \"17\": \"0\", \"18\": \"0\", \"19\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:57:13','2025-10-21 10:57:13',NULL,NULL),(193,79,NULL,3,1,'[]','{\"16\": \"0\", \"17\": \"0\", \"18\": \"0\", \"19\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:57:13','2025-10-21 10:57:13',NULL,NULL),(194,80,NULL,3,1,'[]','{\"16\": \"0\", \"17\": \"0\", \"18\": \"0\", \"19\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:57:13','2025-10-21 10:57:13',NULL,NULL),(195,81,NULL,3,1,'[]','{\"16\": \"0\", \"17\": \"0\", \"18\": \"0\", \"19\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 10:57:13','2025-10-21 10:57:13',NULL,NULL),(196,68,NULL,4,1,'[\"Catatan 6\"]','{\"20\": \"82\", \"21\": \"87\", \"22\": \"80\", \"23\": \"85\"}',0.00,0.00,0.00,33,1,2,2,'2025-10-21 11:01:17','2025-10-21 11:01:17',NULL,NULL),(197,69,NULL,4,1,'[]','{\"20\": \"0\", \"21\": \"0\", \"22\": \"0\", \"23\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:01:17','2025-10-21 11:01:17',NULL,NULL),(198,70,NULL,4,1,'[]','{\"20\": \"0\", \"21\": \"0\", \"22\": \"0\", \"23\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:01:17','2025-10-21 11:01:17',NULL,NULL),(199,71,NULL,4,1,'[]','{\"20\": \"0\", \"21\": \"0\", \"22\": \"0\", \"23\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:01:17','2025-10-21 11:01:17',NULL,NULL),(200,72,NULL,4,1,'[]','{\"20\": \"0\", \"21\": \"0\", \"22\": \"0\", \"23\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:01:17','2025-10-21 11:01:17',NULL,NULL),(201,73,NULL,4,1,'[]','{\"20\": \"0\", \"21\": \"0\", \"22\": \"0\", \"23\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:01:17','2025-10-21 11:01:17',NULL,NULL),(202,74,NULL,4,1,'[]','{\"20\": \"0\", \"21\": \"0\", \"22\": \"0\", \"23\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:01:17','2025-10-21 11:01:17',NULL,NULL),(203,75,NULL,4,1,'[]','{\"20\": \"0\", \"21\": \"0\", \"22\": \"0\", \"23\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:01:17','2025-10-21 11:01:17',NULL,NULL),(204,76,NULL,4,1,'[]','{\"20\": \"0\", \"21\": \"0\", \"22\": \"0\", \"23\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:01:17','2025-10-21 11:01:17',NULL,NULL),(205,77,NULL,4,1,'[]','{\"20\": \"0\", \"21\": \"0\", \"22\": \"0\", \"23\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:01:17','2025-10-21 11:01:17',NULL,NULL),(206,1,NULL,4,1,'[]','{\"20\": \"0\", \"21\": \"0\", \"22\": \"0\", \"23\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:01:17','2025-10-21 11:01:17',NULL,NULL),(207,78,NULL,4,1,'[]','{\"20\": \"0\", \"21\": \"0\", \"22\": \"0\", \"23\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:01:17','2025-10-21 11:01:17',NULL,NULL),(208,79,NULL,4,1,'[]','{\"20\": \"0\", \"21\": \"0\", \"22\": \"0\", \"23\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:01:17','2025-10-21 11:01:17',NULL,NULL),(209,80,NULL,4,1,'[]','{\"20\": \"0\", \"21\": \"0\", \"22\": \"0\", \"23\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:01:17','2025-10-21 11:01:17',NULL,NULL),(210,81,NULL,4,1,'[]','{\"20\": \"0\", \"21\": \"0\", \"22\": \"0\", \"23\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:01:17','2025-10-21 11:01:17',NULL,NULL),(211,68,NULL,5,1,'[\"Catatan 1\", \"Catatan 2\", \"Catatan 3\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\"]','{\"24\": \"90\", \"25\": \"85\", \"26\": \"80\", \"27\": \"88\"}',0.00,0.00,0.00,34,1,2,1,'2025-10-21 11:02:17','2025-10-21 11:02:17',NULL,NULL),(212,69,NULL,5,1,'[]','{\"24\": \"0\", \"25\": \"0\", \"26\": \"0\", \"27\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:02:17','2025-10-21 11:02:17',NULL,NULL),(213,70,NULL,5,1,'[]','{\"24\": \"0\", \"25\": \"0\", \"26\": \"0\", \"27\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:02:17','2025-10-21 11:02:17',NULL,NULL),(214,71,NULL,5,1,'[]','{\"24\": \"0\", \"25\": \"0\", \"26\": \"0\", \"27\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:02:17','2025-10-21 11:02:17',NULL,NULL),(215,72,NULL,5,1,'[]','{\"24\": \"0\", \"25\": \"0\", \"26\": \"0\", \"27\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:02:17','2025-10-21 11:02:17',NULL,NULL),(216,73,NULL,5,1,'[]','{\"24\": \"0\", \"25\": \"0\", \"26\": \"0\", \"27\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:02:17','2025-10-21 11:02:17',NULL,NULL),(217,74,NULL,5,1,'[]','{\"24\": \"0\", \"25\": \"0\", \"26\": \"0\", \"27\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:02:17','2025-10-21 11:02:17',NULL,NULL),(218,75,NULL,5,1,'[]','{\"24\": \"0\", \"25\": \"0\", \"26\": \"0\", \"27\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:02:17','2025-10-21 11:02:17',NULL,NULL),(219,76,NULL,5,1,'[]','{\"24\": \"0\", \"25\": \"0\", \"26\": \"0\", \"27\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:02:17','2025-10-21 11:02:17',NULL,NULL),(220,77,NULL,5,1,'[]','{\"24\": \"0\", \"25\": \"0\", \"26\": \"0\", \"27\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:02:17','2025-10-21 11:02:17',NULL,NULL),(221,1,NULL,5,1,'[]','{\"24\": \"0\", \"25\": \"0\", \"26\": \"0\", \"27\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:02:17','2025-10-21 11:02:17',NULL,NULL),(222,78,NULL,5,1,'[]','{\"24\": \"0\", \"25\": \"0\", \"26\": \"0\", \"27\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:02:17','2025-10-21 11:02:17',NULL,NULL),(223,79,NULL,5,1,'[]','{\"24\": \"0\", \"25\": \"0\", \"26\": \"0\", \"27\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:02:17','2025-10-21 11:02:17',NULL,NULL),(224,80,NULL,5,1,'[]','{\"24\": \"0\", \"25\": \"0\", \"26\": \"0\", \"27\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:02:17','2025-10-21 11:02:17',NULL,NULL),(225,81,NULL,5,1,'[]','{\"24\": \"0\", \"25\": \"0\", \"26\": \"0\", \"27\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:02:17','2025-10-21 11:02:17',NULL,NULL),(226,68,NULL,6,1,'[\"Catatan 2\", \"Catatan 4\", \"Catatan 5\", \"Catatan 6\"]','{\"28\": \"85\", \"29\": \"88\", \"30\": \"80\", \"31\": \"90\"}',0.00,0.00,0.00,34,1,2,2,'2025-10-21 11:09:56','2025-10-21 11:09:56',NULL,NULL),(227,69,NULL,6,1,'[]','{\"28\": \"0\", \"29\": \"0\", \"30\": \"0\", \"31\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:09:56','2025-10-21 11:09:56',NULL,NULL),(228,70,NULL,6,1,'[]','{\"28\": \"0\", \"29\": \"0\", \"30\": \"0\", \"31\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:09:56','2025-10-21 11:09:56',NULL,NULL),(229,71,NULL,6,1,'[]','{\"28\": \"0\", \"29\": \"0\", \"30\": \"0\", \"31\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:09:56','2025-10-21 11:09:56',NULL,NULL),(230,72,NULL,6,1,'[]','{\"28\": \"0\", \"29\": \"0\", \"30\": \"0\", \"31\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:09:56','2025-10-21 11:09:56',NULL,NULL),(231,73,NULL,6,1,'[]','{\"28\": \"0\", \"29\": \"0\", \"30\": \"0\", \"31\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:09:56','2025-10-21 11:09:56',NULL,NULL),(232,74,NULL,6,1,'[]','{\"28\": \"0\", \"29\": \"0\", \"30\": \"0\", \"31\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:09:56','2025-10-21 11:09:56',NULL,NULL),(233,75,NULL,6,1,'[]','{\"28\": \"0\", \"29\": \"0\", \"30\": \"0\", \"31\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:09:56','2025-10-21 11:09:56',NULL,NULL),(234,76,NULL,6,1,'[]','{\"28\": \"0\", \"29\": \"0\", \"30\": \"0\", \"31\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:09:56','2025-10-21 11:09:56',NULL,NULL),(235,77,NULL,6,1,'[]','{\"28\": \"0\", \"29\": \"0\", \"30\": \"0\", \"31\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:09:56','2025-10-21 11:09:56',NULL,NULL),(236,1,NULL,6,1,'[]','{\"28\": \"0\", \"29\": \"0\", \"30\": \"0\", \"31\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:09:56','2025-10-21 11:09:56',NULL,NULL),(237,78,NULL,6,1,'[]','{\"28\": \"0\", \"29\": \"0\", \"30\": \"0\", \"31\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:09:56','2025-10-21 11:09:56',NULL,NULL),(238,79,NULL,6,1,'[]','{\"28\": \"0\", \"29\": \"0\", \"30\": \"0\", \"31\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:09:56','2025-10-21 11:09:56',NULL,NULL),(239,80,NULL,6,1,'[]','{\"28\": \"0\", \"29\": \"0\", \"30\": \"0\", \"31\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:09:56','2025-10-21 11:09:56',NULL,NULL),(240,81,NULL,6,1,'[]','{\"28\": \"0\", \"29\": \"0\", \"30\": \"0\", \"31\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:09:56','2025-10-21 11:09:56',NULL,NULL),(241,68,NULL,7,1,'[\"Catatan 1\", \"Catatan 3\", \"Catatan 6\"]','{\"32\": \"80\", \"33\": \"90\", \"34\": \"75\", \"35\": \"88\"}',0.00,0.00,0.00,33,2,1,1,'2025-10-21 11:10:41','2025-10-21 11:10:41',NULL,NULL),(242,69,NULL,7,1,'[]','{\"32\": \"0\", \"33\": \"0\", \"34\": \"0\", \"35\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:10:41','2025-10-21 11:10:41',NULL,NULL),(243,70,NULL,7,1,'[]','{\"32\": \"0\", \"33\": \"0\", \"34\": \"0\", \"35\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:10:41','2025-10-21 11:10:41',NULL,NULL),(244,71,NULL,7,1,'[]','{\"32\": \"0\", \"33\": \"0\", \"34\": \"0\", \"35\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:10:41','2025-10-21 11:10:41',NULL,NULL),(245,72,NULL,7,1,'[]','{\"32\": \"0\", \"33\": \"0\", \"34\": \"0\", \"35\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:10:41','2025-10-21 11:10:41',NULL,NULL),(246,73,NULL,7,1,'[]','{\"32\": \"0\", \"33\": \"0\", \"34\": \"0\", \"35\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:10:41','2025-10-21 11:10:41',NULL,NULL),(247,74,NULL,7,1,'[]','{\"32\": \"0\", \"33\": \"0\", \"34\": \"0\", \"35\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:10:41','2025-10-21 11:10:41',NULL,NULL),(248,75,NULL,7,1,'[]','{\"32\": \"0\", \"33\": \"0\", \"34\": \"0\", \"35\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:10:41','2025-10-21 11:10:41',NULL,NULL),(249,76,NULL,7,1,'[]','{\"32\": \"0\", \"33\": \"0\", \"34\": \"0\", \"35\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:10:41','2025-10-21 11:10:41',NULL,NULL),(250,77,NULL,7,1,'[]','{\"32\": \"0\", \"33\": \"0\", \"34\": \"0\", \"35\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:10:41','2025-10-21 11:10:41',NULL,NULL),(251,1,NULL,7,1,'[]','{\"32\": \"0\", \"33\": \"0\", \"34\": \"0\", \"35\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:10:41','2025-10-21 11:10:41',NULL,NULL),(252,78,NULL,7,1,'[]','{\"32\": \"0\", \"33\": \"0\", \"34\": \"0\", \"35\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:10:41','2025-10-21 11:10:41',NULL,NULL),(253,79,NULL,7,1,'[]','{\"32\": \"0\", \"33\": \"0\", \"34\": \"0\", \"35\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:10:41','2025-10-21 11:10:41',NULL,NULL),(254,80,NULL,7,1,'[]','{\"32\": \"0\", \"33\": \"0\", \"34\": \"0\", \"35\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:10:41','2025-10-21 11:10:41',NULL,NULL),(255,81,NULL,7,1,'[]','{\"32\": \"0\", \"33\": \"0\", \"34\": \"0\", \"35\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-10-21 11:10:41','2025-10-21 11:10:41',NULL,NULL),(256,102,1,1,1,'[]','{\"1\": \"0.1\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(257,83,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(258,84,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(259,85,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(260,101,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(261,103,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(262,86,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(263,100,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(264,88,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(265,87,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(266,90,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(267,89,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(268,91,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(269,92,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(270,93,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(271,94,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(272,99,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(273,95,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(274,96,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(275,98,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL),(276,97,1,1,1,'[]','{\"1\": \"0\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"0\", \"6\": \"0\"}',0.00,0.00,0.00,0,0,0,0,'2025-11-03 07:40:07','2025-11-03 07:40:07',NULL,NULL);
/*!40000 ALTER TABLE `nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siswa`
--

DROP TABLE IF EXISTS `siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `siswa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siswa_nis_unique` (`nis`),
  KEY `siswa_kelas_id_foreign` (`kelas_id`),
  KEY `siswa_user_id_foreign` (`user_id`),
  CONSTRAINT `siswa_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `siswa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siswa`
--

LOCK TABLES `siswa` WRITE;
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
INSERT INTO `siswa` VALUES (1,4,'M Surya Akbar','1234567890',1,'2025-10-12 07:57:42','2025-10-24 23:36:57'),(2,NULL,'Adelia Putri Elvani','0103118362',2,'2025-10-12 21:33:34','2025-10-12 21:33:34'),(3,NULL,'Ahmad Dhanil.','3109357770',2,'2025-10-12 21:33:50','2025-10-12 21:33:50'),(4,NULL,'Anjas Seftiansyah','0103872894',2,'2025-10-12 21:34:07','2025-10-12 21:34:07'),(5,NULL,'Dika Ardiyansyah Wijaya','0107934721',2,'2025-10-12 21:34:24','2025-10-12 21:34:24'),(6,NULL,'Fardhan Indra','3107699822',2,'2025-10-12 21:34:41','2025-10-12 21:34:41'),(7,NULL,'Fatimah Nuha Hariandi','0113769152',2,'2025-10-12 21:34:58','2025-10-12 21:34:58'),(8,NULL,'Febby Clarisa Putri','0114738418',2,'2025-10-12 21:35:15','2025-10-12 21:35:15'),(9,NULL,'Khadafi Al - Faqih','0122618781',2,'2025-10-12 21:35:32','2025-10-12 21:35:32'),(10,NULL,'Kirana Shifa Gunawan','0119841589',2,'2025-10-12 21:35:49','2025-10-12 21:35:49'),(11,NULL,'Marcelino','0126106374',2,'2025-10-12 21:36:09','2025-10-12 21:36:09'),(12,NULL,'M.Fachri Sofyan','3115127435',2,'2025-10-12 21:36:28','2025-10-12 21:36:28'),(13,NULL,'Muhammad Alfiansyah','0124482691',2,'2025-10-12 21:36:47','2025-10-12 21:36:47'),(14,NULL,'Nabila Hasna','0118677053',2,'2025-10-12 21:37:08','2025-10-12 21:37:08'),(15,NULL,'Randi Fahrevi','0108475574',2,'2025-10-12 21:37:28','2025-10-12 21:37:28'),(16,NULL,'Syafira Ayudinata','0109528533',2,'2025-10-12 21:37:46','2025-10-12 21:37:46'),(17,NULL,'Sofyan Rizky','0104545168',2,'2025-10-12 21:38:05','2025-10-12 21:38:05'),(18,NULL,'Umaya Yasmin','0115995343',2,'2025-10-12 21:38:20','2025-10-12 21:38:20'),(19,NULL,'Vicky Azhari','0116890374',2,'2025-10-12 21:38:34','2025-10-12 21:38:34'),(20,NULL,'Zahwa Sakinah Hamdani','0113958208',2,'2025-10-12 21:38:49','2025-10-12 21:38:49'),(21,NULL,'Tengku Rahman Auli','0118847695',2,'2025-10-12 21:39:04','2025-10-12 21:39:04'),(22,NULL,'M. Raffa Sundawa','0108042021',2,'2025-10-12 21:39:20','2025-10-12 21:39:20'),(23,NULL,'Azra Pratama','0116072569',2,'2025-10-12 21:39:34','2025-10-12 21:39:34'),(24,NULL,'M. Alqodaffa Chaniago','0116825356',2,'2025-10-12 21:39:50','2025-10-12 21:39:50'),(25,NULL,'Reza Perdiansyah','111111111',2,'2025-10-12 21:44:45','2025-10-12 21:44:45'),(26,NULL,'ADINDA AULIA','0122674480',3,'2025-10-12 22:12:06','2025-10-12 22:12:06'),(27,NULL,'AHMAD NAZRIL SYAHREZA','3133194767',3,'2025-10-12 22:12:24','2025-10-12 22:12:24'),(28,NULL,'AISYAH','0138349291',3,'2025-10-12 22:12:40','2025-10-12 22:12:40'),(29,NULL,'ARIELLA SEPTO RIANTO','3129937935',3,'2025-10-12 22:12:57','2025-10-12 22:12:57'),(30,NULL,'BALQIS UFAIRA','0132197324',3,'2025-10-12 22:13:12','2025-10-12 22:13:12'),(31,NULL,'BELLA APRILIANI','3132105303',3,'2025-10-12 22:13:27','2025-10-12 22:13:27'),(32,NULL,'DISVA DWI SASTIA','3120242099',3,'2025-10-12 22:13:41','2025-10-12 22:13:41'),(33,NULL,'FADHIL ZAHID PRASETYO','3133730231',3,'2025-10-12 22:14:39','2025-10-12 22:14:39'),(34,NULL,'GEORGE MIRLANNO','3130702578',3,'2025-10-12 22:14:54','2025-10-12 22:14:54'),(35,NULL,'GEZAH EIJAZ RUZANA','0122732703',3,'2025-10-12 22:15:08','2025-10-12 22:15:08'),(36,NULL,'JULIANSYAH','0125178492',3,'2025-10-12 22:15:22','2025-10-12 22:15:22'),(37,NULL,'LISA PATIYAH','3132929704',3,'2025-10-12 22:19:38','2025-10-12 22:19:38'),(38,4,'MHD RAJA','3139757344',3,'2025-10-12 22:19:53','2025-10-24 23:36:57'),(39,NULL,'REHAN WAHYUDA','3121743323',3,'2025-10-12 22:20:08','2025-10-12 22:20:08'),(40,4,'RIZKY FAHREZA','3130017988',2,'2025-10-12 22:20:27','2025-10-24 23:36:57'),(41,NULL,'ROFI\'U MAULANA','0133548193',3,'2025-10-12 22:20:41','2025-10-12 22:20:41'),(42,NULL,'SITI HAULA TANJUNG','3115126482',3,'2025-10-12 22:20:58','2025-10-12 22:20:58'),(43,NULL,'SYAKIRA ZARKASYA ALFIAN','3121596065',3,'2025-10-12 22:21:13','2025-10-12 22:21:13'),(44,NULL,'SYAQILA AZAHRA','3133808881',3,'2025-10-12 22:21:28','2025-10-12 22:21:28'),(45,NULL,'ARIEL MANIK','3132690026',3,'2025-10-12 22:21:43','2025-10-12 22:21:43'),(46,NULL,'Abib Pranata','0113698604',4,'2025-10-13 21:43:35','2025-10-13 21:43:35'),(47,NULL,'Adelia Octapiyanti','0105186333',4,'2025-10-13 21:43:53','2025-10-13 21:43:53'),(48,NULL,'Andika Priatmaja','0117162385',4,'2025-10-13 21:44:12','2025-10-13 21:44:12'),(49,NULL,'Atiqah Sholeha','0116220615',4,'2025-10-13 21:48:55','2025-10-13 21:48:55'),(50,NULL,'Chairul Alkholidi Azam','0107918081',4,'2025-10-13 21:51:45','2025-10-13 21:51:45'),(51,NULL,'Elza Alfiani Safitri Lubis','0101144508',4,'2025-10-13 21:52:52','2025-10-13 21:52:52'),(52,NULL,'Iyyana Fadliyah','3114667202',4,'2025-10-13 21:53:10','2025-10-13 21:53:10'),(53,NULL,'Kirana Elgi Aksara','0115179937',4,'2025-10-13 21:53:37','2025-10-13 21:53:37'),(54,NULL,'Mahatta Shandy Utomo','0118255946',4,'2025-10-13 21:54:09','2025-10-13 21:54:09'),(55,NULL,'M.Rizky Hardiansyah Siregar','0109280559',4,'2025-10-13 21:54:26','2025-10-13 21:54:26'),(56,NULL,'Muhammad Rendi Pratama','113783367',4,'2025-10-13 21:54:42','2025-10-13 21:54:42'),(57,NULL,'Mhd Fatir Chairaldy','0111846712',4,'2025-10-13 21:54:59','2025-10-13 21:54:59'),(58,NULL,'Muhammad Afghan Fahreza','081242869',4,'2025-10-13 21:55:16','2025-10-13 21:55:16'),(59,NULL,'Nauval Hilmiy Athaillah','0117418371',4,'2025-10-13 21:55:32','2025-10-13 21:55:32'),(60,NULL,'Rezqi Ade Pratama Hasibuan','0118844740',4,'2025-10-13 21:55:56','2025-10-13 21:55:56'),(61,NULL,'Rima Tindaon','0119757039',4,'2025-10-13 21:56:12','2025-10-13 21:56:12'),(62,NULL,'Soniya Novella Simbolon','0112207190',4,'2025-10-13 21:56:26','2025-10-13 21:56:26'),(63,NULL,'Sylfia Sari Darma','0118634111',4,'2025-10-13 21:56:43','2025-10-13 21:56:43'),(64,NULL,'Wan Hadi Abdullah','0112795691',4,'2025-10-13 21:56:58','2025-10-13 21:56:58'),(65,NULL,'Natasha Huda','3109824189',4,'2025-10-13 21:57:17','2025-10-13 21:57:17'),(66,NULL,'Wahyu Hardiansyah','0103471280',4,'2025-10-13 21:57:28','2025-10-13 21:57:28'),(67,NULL,'Yufiza Nada Andini','3116218932',4,'2025-10-13 21:57:48','2025-10-13 21:57:48'),(68,NULL,'Aisyah Cantika Rahmadani','3134337166',1,'2025-10-13 22:00:28','2025-10-13 22:00:28'),(69,NULL,'Akhila Leslina Putri','0133370384',1,'2025-10-13 22:00:48','2025-10-13 22:00:48'),(70,NULL,'Almira Ahfiani Nasution','3101048986',1,'2025-10-13 22:01:08','2025-10-13 22:01:08'),(71,NULL,'Diva Azmi','0138059784',1,'2025-10-13 22:01:25','2025-10-13 22:02:55'),(72,NULL,'Eka Anzar Pratiwi','3131571037',1,'2025-10-13 22:01:54','2025-10-13 22:02:25'),(73,NULL,'Fahri Yazid','3134025629',1,'2025-10-13 22:04:41','2025-10-13 22:04:41'),(74,NULL,'Fandi Syahputra','3136758554',1,'2025-10-13 22:04:55','2025-10-13 22:04:55'),(75,NULL,'Fikri Al Rasikh','0134492836',1,'2025-10-13 22:05:09','2025-10-13 22:05:09'),(76,NULL,'Fiza Qaira Maghfirah','3130126622',1,'2025-10-13 22:05:29','2025-10-13 22:05:29'),(77,NULL,'Kalika Putri','3139979233',1,'2025-10-13 22:05:45','2025-10-13 22:05:45'),(78,NULL,'M. Taufan Batubara','3124007062',1,'2025-10-13 22:06:00','2025-10-13 22:06:00'),(79,NULL,'Nurul Azizi','3128705648',1,'2025-10-13 22:06:17','2025-10-13 22:06:17'),(80,NULL,'Putri Adzkia','010214920',1,'2025-10-13 22:06:32','2025-10-13 22:06:32'),(81,NULL,'Safira','3133775616',1,'2025-10-13 22:06:46','2025-10-13 22:06:46'),(82,NULL,'Jihan Zhafira Azka','222222222',4,'2025-10-13 22:31:19','2025-10-13 22:31:19'),(83,NULL,'AHMAD FERNANDA','0123049784',5,'2025-10-17 18:07:56','2025-10-17 18:07:56'),(84,NULL,'ALIF AL FATIH SARAGIH','0125814981',5,'2025-10-17 18:08:15','2025-10-17 18:08:15'),(85,NULL,'ANDRA WIRA YUDHA','0121555822',5,'2025-10-17 18:08:32','2025-10-17 18:08:32'),(86,NULL,'EZA RAMADHAN SILALAHI','0121693632',5,'2025-10-17 18:08:51','2025-10-17 18:08:51'),(87,NULL,'MELSA AULIA PUTRI','3127074347',5,'2025-10-17 18:09:13','2025-10-17 18:09:13'),(88,NULL,'M.RAJA BASA AL-FARIZY','0128516440',5,'2025-10-17 18:09:35','2025-10-17 18:09:35'),(89,NULL,'MUHAMMAD KEVIN LUBIS','0123985738',5,'2025-10-17 18:10:09','2025-10-17 18:10:09'),(90,NULL,'MUHAMMAD FAQHRI ALFISHARI','0112797686',5,'2025-10-17 18:10:56','2025-10-17 18:10:56'),(91,NULL,'MUHAMMAD RASYID PRATAMA','0113783367',5,'2025-10-17 18:11:16','2025-10-17 18:11:16'),(92,NULL,'MUHAMMAD ROBBI FADRIAN','0127106153',5,'2025-10-17 18:11:34','2025-10-17 18:11:34'),(93,NULL,'NAILAH SYAMMA DAULAY','0129108093',5,'2025-10-17 18:11:53','2025-10-17 18:11:53'),(94,NULL,'NUR ALYA ARIANI','0127500730',5,'2025-10-17 18:12:12','2025-10-17 18:12:12'),(95,NULL,'RAYSA AZZAHRA','3121253062',5,'2025-10-17 18:12:31','2025-10-17 18:12:31'),(96,NULL,'SYIFA RISKIYAH','0129034723',5,'2025-10-17 18:12:59','2025-10-17 18:12:59'),(97,NULL,'YARDANIA ALYA KANAHAYA RASIDI','3123334735',5,'2025-10-17 18:13:50','2025-10-17 18:13:50'),(98,NULL,'VADILLA RAMASYAH','3123834592',5,'2025-10-17 18:14:09','2025-10-17 18:14:09'),(99,NULL,'RANDI PRATAMA','0114064905',5,'2025-10-17 18:14:28','2025-10-17 18:14:28'),(100,NULL,'IMAM EKA PUTRA','3123473199',5,'2025-10-17 18:14:47','2025-10-17 18:14:47'),(101,NULL,'AZZAM AL HAFIZ','3121037597',5,'2025-10-17 18:15:05','2025-10-17 18:15:05'),(102,NULL,'AHMAD FATHIR AZIZI','0118476102',5,'2025-10-17 18:15:22','2025-10-17 18:15:22'),(103,NULL,'DHIA IZZ ZAHRA SAHBELA','0125598792',5,'2025-10-17 18:15:39','2025-10-17 18:15:39'),(104,NULL,'AFIQHA NAZWA KHAIRA','0121574021',6,'2025-10-17 18:39:56','2025-10-17 18:39:56'),(105,NULL,'AL ABU SHAHID','0123151812',6,'2025-10-17 18:40:19','2025-10-17 18:40:19'),(106,NULL,'AL FATHIN AKBAR','0129820876',6,'2025-10-17 18:41:00','2025-10-17 18:41:00'),(107,NULL,'AISYAH RANI','0122944819',6,'2025-10-17 18:41:16','2025-10-17 18:41:16'),(108,NULL,'ASHIFAH ARSY NASUTION','0124461165',6,'2025-10-17 18:41:48','2025-10-17 18:41:48'),(109,NULL,'CHIKO ALFATIH SIKUMBANG','0122676700',6,'2025-10-17 18:42:04','2025-10-17 18:42:04'),(110,NULL,'DELFIZAR MUSTAKIM CHANIAGO','0123077996',6,'2025-10-17 18:42:22','2025-10-17 18:42:22'),(111,NULL,'FANY HILMA TASQIYAH','0118872790',6,'2025-10-17 18:42:41','2025-10-18 05:29:14'),(112,NULL,'IBNU FADHILAH RIZQULLAH','0129102795',6,'2025-10-17 18:43:00','2025-10-17 18:43:00'),(113,NULL,'INDAH AZZAHRA','0127325501',6,'2025-10-17 18:43:19','2025-10-17 18:43:19'),(114,NULL,'KAISA ALHDI','3123203059',6,'2025-10-17 18:43:38','2025-10-17 18:43:38'),(115,NULL,'MAQVIRA RAMADHANI','116459576',6,'2025-10-17 18:44:07','2025-10-17 18:44:07'),(116,NULL,'MUHAMMAD ANWAR IBRAHIM','3125290019',6,'2025-10-17 18:44:29','2025-10-17 18:44:29'),(117,NULL,'MHD. REHANSYAH PUTRA SUHADI','0126169331',6,'2025-10-17 18:45:15','2025-10-17 18:45:15'),(118,NULL,'NAYLA KHAIRUNISA NAINGGOLAN','0101006685',6,'2025-10-17 18:45:41','2025-10-17 18:45:41'),(119,NULL,'QUEENSYI ALIKA DEKA','3120244399',6,'2025-10-17 18:46:08','2025-10-17 18:46:08'),(120,NULL,'RIFQI AZKA RASIKA','0123408396',6,'2025-10-17 18:46:26','2025-10-17 18:46:26'),(121,NULL,'SAHARA AULIA','3124341936',6,'2025-10-17 18:46:58','2025-10-17 18:46:58'),(122,NULL,'SASMITA DWI ASIH','3128114542',6,'2025-10-17 20:08:49','2025-10-17 20:08:49'),(123,NULL,'TRISTAN','0129278081',6,'2025-10-17 20:09:06','2025-10-17 20:09:06'),(124,NULL,'ZIHAN SYAHREZA','0116413131',6,'2025-10-17 20:09:27','2025-10-17 20:09:27'),(125,NULL,'AISYAH NANDA FITELI','0118737556',6,'2025-10-17 20:09:46','2025-10-17 20:09:46'),(126,NULL,'RIZIQ SYAH AL-RASYID','0101010101',6,'2025-10-17 20:10:33','2025-10-17 20:10:33'),(127,NULL,'INDRI GHORIYANA','0202020202',6,'2025-10-17 20:11:21','2025-10-17 20:11:21');
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_nis_unique` (`nis`),
  KEY `students_class_id_foreign` (`class_id`),
  CONSTRAINT `students_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tahun_ajaran`
--

DROP TABLE IF EXISTS `tahun_ajaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tahun_ajaran` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tahun_ajaran_tahun_semester_unique` (`tahun`,`semester`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tahun_ajaran`
--

LOCK TABLES `tahun_ajaran` WRITE;
/*!40000 ALTER TABLE `tahun_ajaran` DISABLE KEYS */;
INSERT INTO `tahun_ajaran` VALUES (1,'2025','1',1,'2025-10-18 07:21:34','2025-10-18 07:21:38');
/*!40000 ALTER TABLE `tahun_ajaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','guru','ortu') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ortu',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin@kejoedscore.com','admin',NULL,'$2y$12$Z9LnSmZc7xZ/hb2Q285IRONVxwjcfrXEO3M..7hOdhl4U/qIoB3qW',NULL,'2025-10-23 10:22:41','2025-10-23 10:22:41'),(2,'Guru Muhammadiyah 16','guru@kejoedscore.com','guru',NULL,'$2y$12$AC90cq.7oRrubs/onLoMv.9gUCR7pfMhBxirI3cRdwVl3wFFKiYvW',NULL,'2025-10-23 10:22:42','2025-10-24 08:50:36'),(3,'Orang Tua Siswa','ortu@kejoedscore.com','ortu',NULL,'$2y$12$t5wvFqqDPX1QTLIMfH25R.a1xfwbm7Nelh60H3.tObEzylGv2GO3O',NULL,'2025-10-23 10:22:42','2025-10-23 10:22:42'),(4,'Raden Mas Kian Santang','ortuAkbar@kejoedscore.com','ortu',NULL,'$2y$12$Bq1oKJkzkMSLUYRIPnv0aeS1hfyTr0HF8agKxkNTYKay.OdvcDtnW','mfCIoErU57gM6uJl56toXRn7PT948M28DFKLbKCZ9xrbmPbzUZzBuYGldqz7','2025-10-23 18:58:10','2025-10-23 18:58:10');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-05 22:14:08
