/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `arsiparis` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `arsiparis`;

CREATE TABLE IF NOT EXISTS `tb_archives` (
  `archive_id` int NOT NULL,
  `archive_code` varchar(50) DEFAULT NULL,
  `document_no` varchar(50) DEFAULT NULL,
  `archived_by` varchar(50) DEFAULT NULL,
  `retention_date` date DEFAULT NULL,
  `archive_status` varchar(50) DEFAULT NULL COMMENT '#PERMANENT | #ADUSTMENT | #DISPOSE',
  `retention_type` varchar(50) DEFAULT NULL COMMENT '#MONTHLY | #ANNUALY | #PERMANENT',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`archive_id`),
  KEY `archive_code` (`archive_code`),
  KEY `document_no` (`document_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE IF NOT EXISTS `tb_boxes` (
  `box_id` int NOT NULL,
  `box_code` varchar(50) DEFAULT NULL,
  `shelf_code` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL COMMENT '#EMPTY, #AVAILABLE, #FULL',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`box_id`),
  KEY `box_code` (`box_code`),
  KEY `shelf_code` (`shelf_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE IF NOT EXISTS `tb_buildings` (
  `building_id` int NOT NULL AUTO_INCREMENT,
  `building_code` varchar(24) NOT NULL DEFAULT '',
  `building_name` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `added_by` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`building_id`),
  KEY `building_code` (`building_code`),
  KEY `added_by` (`added_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `FK_tb_buildings_tb_users` FOREIGN KEY (`added_by`) REFERENCES `tb_users` (`username`),
  CONSTRAINT `FK_tb_buildings_tb_users_2` FOREIGN KEY (`updated_by`) REFERENCES `tb_users` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

REPLACE INTO `tb_buildings` (`building_id`, `building_code`, `building_name`, `description`, `status`, `added_by`, `created_at`, `updated_by`, `updated_at`) VALUES
	(1, 'DBS-BLD001-2023', 'GEDUNG UTAMA', 'GEDUNG A (IT, HRD, PRESDIR)', 'ACTIVE', 'admin', '2023-11-02 08:10:41', 'admin', '2023-11-02 02:38:31');

CREATE TABLE IF NOT EXISTS `tb_categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(50) DEFAULT NULL,
  `category_code` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  KEY `category_code` (`category_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE IF NOT EXISTS `tb_documents` (
  `document_id` int NOT NULL AUTO_INCREMENT,
  `document_no` varchar(50) DEFAULT NULL,
  `unit_code` varchar(50) DEFAULT NULL,
  `category_code` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`document_id`),
  KEY `document_no` (`document_no`),
  KEY `unit_code` (`unit_code`),
  KEY `category_code` (`category_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE IF NOT EXISTS `tb_profiles` (
  `profile_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `role` int DEFAULT NULL COMMENT '#1 role admin, #2 role pimpinan',
  `phone` varchar(16) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`profile_id`),
  KEY `username` (`user_id`) USING BTREE,
  CONSTRAINT `FK_tb_profiles_tb_users` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

REPLACE INTO `tb_profiles` (`profile_id`, `user_id`, `name`, `nik`, `role`, `phone`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Administrator', NULL, 1, '', '2023-11-01 20:40:20', NULL);

CREATE TABLE IF NOT EXISTS `tb_rooms` (
  `room_id` int NOT NULL AUTO_INCREMENT,
  `building_code` varchar(24) NOT NULL DEFAULT '',
  `room_code` varchar(32) DEFAULT NULL,
  `room_name` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`room_id`),
  KEY `building_code` (`building_code`),
  KEY `room_code` (`room_code`),
  CONSTRAINT `FK_tb_rooms_tb_buildings` FOREIGN KEY (`building_code`) REFERENCES `tb_buildings` (`building_code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

REPLACE INTO `tb_rooms` (`room_id`, `building_code`, `room_code`, `room_name`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'DBS-BLD001-2023', 'DBSR-202311-001', 'RUANG A', 'RUANG A GEDUNG A', 'ACTIVE', '2023-11-03 18:49:08', NULL),
	(2, 'DBS-BLD001-2023', 'DBSR-202311-002', 'RUANG B', 'RUANG A GEDUNG B', 'ACTIVE', '2023-11-03 18:49:08', NULL);

CREATE TABLE IF NOT EXISTS `tb_shelfs` (
  `shelf_id` int NOT NULL,
  `room_code` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `shelf_name` varchar(50) DEFAULT NULL,
  `shelf_code` varchar(24) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '#EMPTY, #AVAILABLE, #FULL',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`shelf_id`),
  KEY `shelf_code` (`shelf_code`),
  KEY `room_code` (`room_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE IF NOT EXISTS `tb_units` (
  `unit_id` int NOT NULL,
  `unit_name` varchar(50) DEFAULT NULL,
  `unit_code` int DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`unit_id`),
  KEY `unit_code` (`unit_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE IF NOT EXISTS `tb_users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(24) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

REPLACE INTO `tb_users` (`user_id`, `username`, `password`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '11a9e1079aa55ec237158521cb611864', '2023-10-09 08:39:34', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
