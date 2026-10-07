-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: salondungtokyo
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Current Database: `salondungtokyo`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `salondungtokyo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `salondungtokyo`;

--
-- Table structure for table `admin_menus`
--

DROP TABLE IF EXISTS `admin_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_menus` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL DEFAULT '0',
  `sort` int NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `uri` varchar(255) DEFAULT NULL,
  `type` int NOT NULL DEFAULT '0',
  `hidden` int NOT NULL DEFAULT '0',
  `key` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_menu_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_menus`
--

LOCK TABLES `admin_menus` WRITE;
/*!40000 ALTER TABLE `admin_menus` DISABLE KEYS */;
INSERT INTO `admin_menus` VALUES (1,0,3,'admin.service','fa fa-scissors','admin.service.index',0,0,NULL,NULL,'2026-08-28 18:19:41'),(4,0,4,'admin.album','far fa-images',NULL,0,0,NULL,NULL,'2026-08-28 18:19:41'),(5,4,1,'admin.library','fas fa-angle-right','admin.album.library',0,0,NULL,NULL,'2026-08-28 18:19:41'),(6,4,2,'admin.album_list','fas fa-angle-right','admin.album.index',0,0,NULL,NULL,'2026-08-28 18:19:41'),(7,0,1,'admin.contact','fas fa-phone-volume','admin.contact.index',0,0,NULL,NULL,'2026-08-28 18:19:41'),(8,0,5,'admin.post','fa fa-newspaper','admin.post.index',0,0,NULL,NULL,'2026-08-28 18:19:41'),(11,0,6,'admin.page','fas fa-file','admin.page.index',0,0,NULL,NULL,'2026-08-28 18:19:41'),(12,0,7,'admin.menu','fas fa-bars','admin.menu.index',0,0,NULL,NULL,'2026-08-28 18:19:41'),(13,0,2,'admin.email_template','far fa-envelope','admin.email-template.index',0,0,NULL,NULL,'2026-08-28 18:19:41');
/*!40000 ALTER TABLE `admin_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `album_items`
--

DROP TABLE IF EXISTS `album_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `album_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `album_id` bigint unsigned NOT NULL,
  `sub_name` varchar(500) DEFAULT NULL,
  `sub_name_en` varchar(500) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `name_en` varchar(500) DEFAULT NULL,
  `description` text,
  `description_en` text,
  `image` text,
  `image_en` text,
  `video` text,
  `video_en` text,
  `link` text,
  `link_en` text,
  `link_name` text,
  `link_name_en` text,
  `target` varchar(50) NOT NULL DEFAULT '_blank',
  `sort` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `album_items_album_id_foreign` (`album_id`),
  CONSTRAINT `album_items_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=390 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album_items`
--

LOCK TABLES `album_items` WRITE;
/*!40000 ALTER TABLE `album_items` DISABLE KEYS */;
INSERT INTO `album_items` VALUES (384,1,NULL,NULL,'Uốn Sóng Lơi Nữ Thần Tokyo','Tokyo Goddess Wavy Hair',NULL,NULL,'upload/images/hair_1.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'_blank',1,'2026-08-28 08:06:13','2026-08-28 08:06:13'),(385,2,NULL,NULL,'Tóc Layer Nữ Chuẩn Phong Cách Nhật','Japanese Style Layered Cut',NULL,NULL,'upload/images/hair_2.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'_blank',1,'2026-08-28 08:06:13','2026-08-28 08:06:13'),(386,3,NULL,NULL,'Nhuộm Balayage & Highlight Khói Trầm','Ash Grey Balayage & Highlight',NULL,NULL,'upload/images/hair_3.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'_blank',1,'2026-08-28 08:06:13','2026-08-28 08:06:13'),(387,4,NULL,NULL,'Uốn Xoăn Hippie & Tóc Bob Cá Tính','Hippie Curls & Chic Bob',NULL,NULL,'upload/images/hair_4.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'_blank',1,'2026-08-28 08:06:13','2026-08-28 08:06:13'),(388,5,NULL,NULL,'Cắt Bob Tỉa Layer Thời Thượng','Modern Bob Layer Cut',NULL,NULL,'upload/images/hair_5.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'_blank',1,'2026-08-28 08:06:13','2026-08-28 08:06:13'),(389,6,NULL,NULL,'Tạo Kiểu Uốn Side Part / Layer Nam Đẳng Cấp','Premium Men Texture & Side Part',NULL,NULL,'upload/images/hair_6.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'_blank',1,'2026-08-28 08:06:13','2026-08-28 08:06:13');
/*!40000 ALTER TABLE `album_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `albums` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) DEFAULT NULL,
  `name_en` varchar(500) DEFAULT NULL,
  `sort` int DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albums`
--

LOCK TABLES `albums` WRITE;
/*!40000 ALTER TABLE `albums` DISABLE KEYS */;
INSERT INTO `albums` VALUES (1,'Uốn Sóng Lơi Nữ Thần Tokyo','Tokyo Goddess Wavy Hair',1,1,'2026-08-28 08:06:13','2026-08-28 08:06:13'),(2,'Tóc Layer Nữ Chuẩn Phong Cách Nhật','Japanese Style Layered Cut',2,1,'2026-08-28 08:06:13','2026-08-28 08:06:13'),(3,'Nhuộm Balayage & Highlight Khói Trầm','Ash Grey Balayage & Highlight',3,1,'2026-08-28 08:06:13','2026-08-28 08:06:13'),(4,'Uốn Xoăn Hippie & Tóc Bob Cá Tính','Hippie Curls & Chic Bob',4,1,'2026-08-28 08:06:13','2026-08-28 08:06:13'),(5,'Cắt Bob Tỉa Layer Thời Thượng','Modern Bob Layer Cut',5,1,'2026-08-28 08:06:13','2026-08-28 08:06:13'),(6,'Tạo Kiểu Uốn Side Part / Layer Nam Đẳng Cấp','Premium Men Texture & Side Part',6,1,'2026-08-28 08:06:13','2026-08-28 08:06:13');
/*!40000 ALTER TABLE `albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('theme_option','a:46:{i:0;a:8:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"facebook\";s:7:\"content\";s:43:\"https://www.facebook.com/hairsalondungtokyo\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:8;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:1;a:8:{s:2:\"id\";i:2;s:4:\"name\";s:11:\"admin-title\";s:7:\"content\";s:16:\"Salon Dung Tokyo\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:0;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:2;a:8:{s:2:\"id\";i:3;s:4:\"name\";s:7:\"hotline\";s:7:\"content\";s:13:\"090 869 16 96\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:14;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:3;a:8:{s:2:\"id\";i:5;s:4:\"name\";s:9:\"smtp-host\";s:7:\"content\";s:14:\"smtp.gmail.com\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:4;a:8:{s:2:\"id\";i:6;s:4:\"name\";s:9:\"smtp-port\";s:7:\"content\";s:3:\"587\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:2;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:5;a:8:{s:2:\"id\";i:7;s:4:\"name\";s:13:\"smtp-username\";s:7:\"content\";s:21:\"godknight53@gmail.com\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:3;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:6;a:8:{s:2:\"id\";i:8;s:4:\"name\";s:13:\"smtp-password\";s:7:\"content\";s:16:\"feuvelefvtpfzctm\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:4;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:7;a:8:{s:2:\"id\";i:9;s:4:\"name\";s:15:\"smtp-encryption\";s:7:\"content\";s:3:\"tls\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:5;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:8;a:8:{s:2:\"id\";i:10;s:4:\"name\";s:17:\"smtp-from-address\";s:7:\"content\";s:21:\"dungocean82@gmail.com\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:6;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:9;a:8:{s:2:\"id\";i:11;s:4:\"name\";s:8:\"currency\";s:7:\"content\";s:4:\"VNĐ\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:24;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:10;a:8:{s:2:\"id\";i:26;s:4:\"name\";s:12:\"country_code\";s:7:\"content\";s:2:\"VI\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:15;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:11;a:8:{s:2:\"id\";i:29;s:4:\"name\";s:6:\"sender\";s:7:\"content\";s:21:\"dungocean82@gmail.com\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:7;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:12;a:8:{s:2:\"id\";i:31;s:4:\"name\";s:11:\"email_admin\";s:7:\"content\";s:21:\"dungocean82@gmail.com\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:13;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:13;a:8:{s:2:\"id\";i:34;s:4:\"name\";s:5:\"phone\";s:7:\"content\";s:13:\"090 869 16 96\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:16;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:14;a:8:{s:2:\"id\";i:35;s:4:\"name\";s:5:\"email\";s:7:\"content\";s:21:\"dungocean82@gmail.com\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:17;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:15;a:8:{s:2:\"id\";i:51;s:4:\"name\";s:7:\"youtube\";s:7:\"content\";s:0:\"\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:11;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:16;a:8:{s:2:\"id\";i:108;s:4:\"name\";s:8:\"webtitle\";s:7:\"content\";s:16:\"Salon Dung Tokyo\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:25;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:17;a:8:{s:2:\"id\";i:109;s:4:\"name\";s:7:\"twitter\";s:7:\"content\";s:0:\"\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:12;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:18;a:8:{s:2:\"id\";i:128;s:4:\"name\";s:16:\"google_analytics\";s:7:\"content\";s:0:\"\";s:4:\"type\";s:4:\"text\";s:6:\"status\";i:0;s:4:\"sort\";i:44;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:19;a:8:{s:2:\"id\";i:131;s:4:\"name\";s:10:\"email_test\";s:7:\"content\";s:21:\"godknight53@gmail.com\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:26;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:20;a:8:{s:2:\"id\";i:134;s:4:\"name\";s:10:\"favicon_32\";s:7:\"content\";s:23:\"/upload/images/logo.png\";s:4:\"type\";s:3:\"img\";s:6:\"status\";i:0;s:4:\"sort\";i:33;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:21;a:8:{s:2:\"id\";i:135;s:4:\"name\";s:10:\"favicon_16\";s:7:\"content\";s:23:\"/upload/images/logo.png\";s:4:\"type\";s:3:\"img\";s:6:\"status\";i:0;s:4:\"sort\";i:32;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:22;a:8:{s:2:\"id\";i:136;s:4:\"name\";s:10:\"favicon_96\";s:7:\"content\";s:23:\"/upload/images/logo.png\";s:4:\"type\";s:3:\"img\";s:6:\"status\";i:0;s:4:\"sort\";i:36;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:23;a:8:{s:2:\"id\";i:137;s:4:\"name\";s:11:\"favicon_192\";s:7:\"content\";s:23:\"/upload/images/logo.png\";s:4:\"type\";s:3:\"img\";s:6:\"status\";i:0;s:4:\"sort\";i:39;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:24;a:8:{s:2:\"id\";i:138;s:4:\"name\";s:11:\"favicon_180\";s:7:\"content\";s:23:\"/upload/images/logo.png\";s:4:\"type\";s:3:\"img\";s:6:\"status\";i:0;s:4:\"sort\";i:38;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:25;a:8:{s:2:\"id\";i:139;s:4:\"name\";s:10:\"favicon_48\";s:7:\"content\";s:23:\"/upload/images/logo.png\";s:4:\"type\";s:3:\"img\";s:6:\"status\";i:0;s:4:\"sort\";i:34;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:26;a:8:{s:2:\"id\";i:140;s:4:\"name\";s:10:\"favicon_72\";s:7:\"content\";s:23:\"/upload/images/logo.png\";s:4:\"type\";s:3:\"img\";s:6:\"status\";i:0;s:4:\"sort\";i:35;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:27;a:8:{s:2:\"id\";i:141;s:4:\"name\";s:11:\"favicon_144\";s:7:\"content\";s:23:\"/upload/images/logo.png\";s:4:\"type\";s:3:\"img\";s:6:\"status\";i:0;s:4:\"sort\";i:37;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:28;a:8:{s:2:\"id\";i:143;s:4:\"name\";s:8:\"og:title\";s:7:\"content\";s:16:\"Salon Dung Tokyo\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:20;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:29;a:8:{s:2:\"id\";i:144;s:4:\"name\";s:8:\"og:image\";s:7:\"content\";s:0:\"\";s:4:\"type\";s:3:\"img\";s:6:\"status\";i:0;s:4:\"sort\";i:31;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:30;a:8:{s:2:\"id\";i:145;s:4:\"name\";s:12:\"og:site_name\";s:7:\"content\";s:16:\"Salon Dung Tokyo\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:21;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:31;a:8:{s:2:\"id\";i:146;s:4:\"name\";s:14:\"og:description\";s:7:\"content\";s:0:\"\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:22;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:32;a:8:{s:2:\"id\";i:147;s:4:\"name\";s:7:\"og:type\";s:7:\"content\";s:0:\"\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:23;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:33;a:8:{s:2:\"id\";i:148;s:4:\"name\";s:9:\"copyright\";s:7:\"content\";s:16:\"Salon Dung Tokyo\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:19;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:34;a:8:{s:2:\"id\";i:149;s:4:\"name\";s:6:\"author\";s:7:\"content\";s:16:\"Salon Dung Tokyo\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:18;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:35;a:8:{s:2:\"id\";i:150;s:4:\"name\";s:9:\"design_by\";s:7:\"content\";s:6:\"GetAtZ\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:27;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:36;a:8:{s:2:\"id\";i:151;s:4:\"name\";s:14:\"design_by_link\";s:7:\"content\";s:0:\"\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:28;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:37;a:8:{s:2:\"id\";i:154;s:4:\"name\";s:9:\"instagram\";s:7:\"content\";s:40:\"https://www.instagram.com/sevent.agency/\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:9;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:38;a:8:{s:2:\"id\";i:155;s:4:\"name\";s:6:\"tiktok\";s:7:\"content\";s:0:\"\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:10;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:39;a:8:{s:2:\"id\";i:156;s:4:\"name\";s:7:\"website\";s:7:\"content\";s:26:\"https://salondungtokyo.com\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:30;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:40;a:8:{s:2:\"id\";i:162;s:4:\"name\";s:13:\"banner_slogan\";s:7:\"content\";s:30:\"Thời trang &amp; phong cách\";s:4:\"type\";s:4:\"text\";s:6:\"status\";i:0;s:4:\"sort\";i:43;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:41;a:8:{s:2:\"id\";i:163;s:4:\"name\";s:10:\"banner_img\";s:7:\"content\";s:32:\"/upload/images/page/banner_1.jpg\";s:4:\"type\";s:3:\"img\";s:6:\"status\";i:0;s:4:\"sort\";i:42;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:42;a:8:{s:2:\"id\";i:164;s:4:\"name\";s:4:\"logo\";s:7:\"content\";s:23:\"/upload/images/logo.png\";s:4:\"type\";s:3:\"img\";s:6:\"status\";i:0;s:4:\"sort\";i:40;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:43;a:8:{s:2:\"id\";i:165;s:4:\"name\";s:11:\"logo_footer\";s:7:\"content\";s:23:\"/upload/images/logo.png\";s:4:\"type\";s:3:\"img\";s:6:\"status\";i:0;s:4:\"sort\";i:41;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:44;a:8:{s:2:\"id\";i:166;s:4:\"name\";s:10:\"google_map\";s:7:\"content\";s:0:\"\";s:4:\"type\";s:4:\"text\";s:6:\"status\";i:0;s:4:\"sort\";i:45;s:10:\"created_at\";N;s:10:\"updated_at\";N;}i:45;a:8:{s:2:\"id\";i:167;s:4:\"name\";s:7:\"address\";s:7:\"content\";s:67:\"46 Đ. Số 8, Phường 11, Gò Vấp, Thành phố Hồ Chí Minh\";s:4:\"type\";s:4:\"line\";s:6:\"status\";i:0;s:4:\"sort\";i:29;s:10:\"created_at\";N;s:10:\"updated_at\";N;}}',2103898465);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(1000) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `name_en` varchar(1000) DEFAULT NULL,
  `description` longtext,
  `description_en` longtext,
  `content` longtext,
  `content_en` mediumtext,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `parent` int DEFAULT '0',
  `hot` tinyint(1) DEFAULT '0',
  `recommended` tinyint(1) DEFAULT '0',
  `sort` int DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `admin_id` int DEFAULT NULL,
  `seo_title` text,
  `seo_keyword` text,
  `seo_description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (5,'su-kien','post','Event','Event','<p>Event</p>','<p>Event</p>',NULL,NULL,NULL,NULL,NULL,0,0,0,5,1,1,'Sự kiện',NULL,NULL,'2024-03-27 16:48:18','2024-10-01 23:35:11'),(7,'concept-consultant','work','Concept Consultant','Concept Consultant',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,4,1,1,'Exhibition Design',NULL,NULL,'2024-09-11 16:31:13','2024-09-13 08:34:15'),(8,'photography','work','Marketing - Event','Marketing - Event',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,3,1,1,'Photography',NULL,NULL,'2024-09-11 16:31:22','2024-09-13 08:26:03'),(9,'su-kien','work','Sự kiện','Event',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,2,1,1,'Graphic Design',NULL,NULL,'2024-09-11 23:39:52','2024-09-13 08:33:39'),(10,'dieu-hanh','work','Điều hành','Operation',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1,1,'Điều hành',NULL,NULL,'2024-09-13 08:23:02','2024-09-13 08:25:46'),(11,'set-up','work','Set-Up','Set-Up',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,11,1,1,'Set-Up',NULL,NULL,'2024-09-13 08:34:36','2024-09-13 08:34:36'),(12,'branding-marketing','work','Branding & Marketing','Branding & Marketing',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,12,1,1,'Branding & Marketing',NULL,NULL,'2024-09-13 08:34:49','2024-09-13 08:34:49');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT 'contact',
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `file` varchar(200) DEFAULT NULL,
  `content` text,
  `sort` int DEFAULT '0',
  `ip_address` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'contact','Nguyễn Văn Test','test@salondungtokyo.com',NULL,'0901234567',NULL,'Tư vấn cắt tóc layer',0,NULL,0,'2026-08-28 13:44:42','2026-08-28 13:44:42'),(2,'contact','Nguyễn Văn Test','test@salondungtokyo.com',NULL,'0901234567',NULL,'Tư vấn cắt tóc layer',0,NULL,0,'2026-08-28 13:45:20','2026-08-28 13:45:20'),(3,'contact','Nguyễn Văn Test','test@salondungtokyo.com',NULL,'0901234567',NULL,'Tư vấn cắt tóc layer',0,NULL,0,'2026-08-28 13:45:51','2026-08-28 13:45:51'),(17,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',17,'127.0.0.1',0,'2026-08-28 15:10:55','2026-08-28 15:10:55'),(19,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',19,'127.0.0.1',0,'2026-08-28 15:11:10','2026-08-28 15:11:10'),(21,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',21,'127.0.0.1',0,'2026-08-28 15:17:03','2026-08-28 15:17:03'),(23,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',23,'127.0.0.1',0,'2026-08-28 15:18:55','2026-08-28 15:18:55'),(25,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',25,'127.0.0.1',0,'2026-08-28 17:45:31','2026-08-28 17:45:31'),(27,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',27,'127.0.0.1',0,'2026-08-28 17:48:26','2026-08-28 17:48:26'),(29,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',29,'127.0.0.1',0,'2026-08-28 17:49:45','2026-08-28 17:49:45'),(31,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',31,'127.0.0.1',0,'2026-08-28 17:50:46','2026-08-28 17:50:46'),(33,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',33,'127.0.0.1',0,'2026-08-28 17:50:56','2026-08-28 17:50:56'),(35,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',35,'127.0.0.1',0,'2026-08-28 19:03:54','2026-08-28 19:03:54'),(37,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',37,'127.0.0.1',0,'2026-08-28 19:07:18','2026-08-28 19:07:18'),(39,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',39,'127.0.0.1',0,'2026-08-28 22:29:51','2026-08-28 22:29:51'),(41,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',41,'127.0.0.1',0,'2026-08-28 22:30:44','2026-08-28 22:30:44'),(43,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',43,'127.0.0.1',0,'2026-08-29 00:02:22','2026-08-29 00:02:22'),(45,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',45,'127.0.0.1',0,'2026-08-29 00:30:33','2026-08-29 00:30:33'),(47,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',47,'127.0.0.1',0,'2026-08-29 00:30:47','2026-08-29 00:30:47'),(49,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',49,'127.0.0.1',0,'2026-08-29 01:11:32','2026-08-29 01:11:32'),(51,'booking','Khách Hàng Test','khachhang@test.com',NULL,'0988777666',NULL,'Tư vấn nhuộm tóc màu khói',51,'127.0.0.1',0,'2026-08-29 01:18:21','2026-08-29 01:18:21'),(54,'contact','Khách Hàng Test','khachhang@test.com','','0988777666',NULL,'Tư vấn nhuộm tóc màu khói',54,'127.0.0.1',0,'2026-09-22 17:45:12','2026-09-22 17:45:12'),(56,'contact','Khách Hàng Test','khachhang@test.com','','0988777666',NULL,'Tư vấn nhuộm tóc màu khói',56,'127.0.0.1',0,'2026-09-22 18:20:47','2026-09-22 18:20:47');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` char(2) NOT NULL,
  `code_3` char(3) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `phone` int NOT NULL,
  `symbol` varchar(10) DEFAULT NULL,
  `capital` varchar(80) DEFAULT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `continent` varchar(30) DEFAULT NULL,
  `continent_code` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES (1,'AF','AFG','Afghanistan',93,'؋','Kabul','AFN','Asia','AS'),(2,'AX','ALA','Aland Islands',358,'€','Mariehamn','EUR','Europe','EU'),(3,'AL','ALB','Albania',355,'Lek','Tirana','ALL','Europe','EU'),(4,'DZ','DZA','Algeria',213,'دج','Algiers','DZD','Africa','AF'),(5,'AS','ASM','American Samoa',1684,'$','Pago Pago','USD','Oceania','OC'),(6,'AD','AND','Andorra',376,'€','Andorra la Vella','EUR','Europe','EU'),(7,'AO','AGO','Angola',244,'Kz','Luanda','AOA','Africa','AF'),(8,'AI','AIA','Anguilla',1264,'$','The Valley','XCD','North America','NA'),(9,'AQ','ATA','Antarctica',672,'$','Antarctica','AAD','Antarctica','AN'),(10,'AG','ATG','Antigua and Barbuda',1268,'$','St. John\'s','XCD','North America','NA'),(11,'AR','ARG','Argentina',54,'$','Buenos Aires','ARS','South America','SA'),(12,'AM','ARM','Armenia',374,'֏','Yerevan','AMD','Asia','AS'),(13,'AW','ABW','Aruba',297,'ƒ','Oranjestad','AWG','North America','NA'),(14,'AU','AUS','Australia',61,'$','Canberra','AUD','Oceania','OC'),(15,'AT','AUT','Austria',43,'€','Vienna','EUR','Europe','EU'),(16,'AZ','AZE','Azerbaijan',994,'m','Baku','AZN','Asia','AS'),(17,'BS','BHS','Bahamas',1242,'B$','Nassau','BSD','North America','NA'),(18,'BH','BHR','Bahrain',973,'.د.ب','Manama','BHD','Asia','AS'),(19,'BD','BGD','Bangladesh',880,'৳','Dhaka','BDT','Asia','AS'),(20,'BB','BRB','Barbados',1246,'Bds$','Bridgetown','BBD','North America','NA'),(21,'BY','BLR','Belarus',375,'Br','Minsk','BYN','Europe','EU'),(22,'BE','BEL','Belgium',32,'€','Brussels','EUR','Europe','EU'),(23,'BZ','BLZ','Belize',501,'$','Belmopan','BZD','North America','NA'),(24,'BJ','BEN','Benin',229,'CFA','Porto-Novo','XOF','Africa','AF'),(25,'BM','BMU','Bermuda',1441,'$','Hamilton','BMD','North America','NA'),(26,'BT','BTN','Bhutan',975,'Nu.','Thimphu','BTN','Asia','AS'),(27,'BO','BOL','Bolivia',591,'Bs.','Sucre','BOB','South America','SA'),(28,'BQ','BES','Bonaire, Sint Eustatius and Saba',599,'$','Kralendijk','USD','North America','NA'),(29,'BA','BIH','Bosnia and Herzegovina',387,'KM','Sarajevo','BAM','Europe','EU'),(30,'BW','BWA','Botswana',267,'P','Gaborone','BWP','Africa','AF'),(31,'BV','BVT','Bouvet Island',55,'kr','','NOK','Antarctica','AN'),(32,'BR','BRA','Brazil',55,'R$','Brasilia','BRL','South America','SA'),(33,'IO','IOT','British Indian Ocean Territory',246,'$','Diego Garcia','USD','Asia','AS'),(34,'BN','BRN','Brunei Darussalam',673,'B$','Bandar Seri Begawan','BND','Asia','AS'),(35,'BG','BGR','Bulgaria',359,'Лв.','Sofia','BGN','Europe','EU'),(36,'BF','BFA','Burkina Faso',226,'CFA','Ouagadougou','XOF','Africa','AF'),(37,'BI','BDI','Burundi',257,'FBu','Bujumbura','BIF','Africa','AF'),(38,'KH','KHM','Cambodia',855,'KHR','Phnom Penh','KHR','Asia','AS'),(39,'CM','CMR','Cameroon',237,'FCFA','Yaounde','XAF','Africa','AF'),(40,'CA','CAN','Canada',1,'$','Ottawa','CAD','North America','NA'),(41,'CV','CPV','Cape Verde',238,'$','Praia','CVE','Africa','AF'),(42,'KY','CYM','Cayman Islands',1345,'$','George Town','KYD','North America','NA'),(43,'CF','CAF','Central African Republic',236,'FCFA','Bangui','XAF','Africa','AF'),(44,'TD','TCD','Chad',235,'FCFA','N\'Djamena','XAF','Africa','AF'),(45,'CL','CHL','Chile',56,'$','Santiago','CLP','South America','SA'),(46,'CN','CHN','China',86,'¥','Beijing','CNY','Asia','AS'),(47,'CX','CXR','Christmas Island',61,'$','Flying Fish Cove','AUD','Asia','AS'),(48,'CC','CCK','Cocos (Keeling) Islands',672,'$','West Island','AUD','Asia','AS'),(49,'CO','COL','Colombia',57,'$','Bogota','COP','South America','SA'),(50,'KM','COM','Comoros',269,'CF','Moroni','KMF','Africa','AF'),(51,'CG','COG','Congo',242,'FC','Brazzaville','XAF','Africa','AF'),(52,'CD','COD','Congo, Democratic Republic of the Congo',242,'FC','Kinshasa','CDF','Africa','AF'),(53,'CK','COK','Cook Islands',682,'$','Avarua','NZD','Oceania','OC'),(54,'CR','CRI','Costa Rica',506,'₡','San Jose','CRC','North America','NA'),(55,'CI','CIV','Cote D\'Ivoire',225,'CFA','Yamoussoukro','XOF','Africa','AF'),(56,'HR','HRV','Croatia',385,'kn','Zagreb','HRK','Europe','EU'),(57,'CU','CUB','Cuba',53,'$','Havana','CUP','North America','NA'),(58,'CW','CUW','Curacao',599,'ƒ','Willemstad','ANG','North America','NA'),(59,'CY','CYP','Cyprus',357,'€','Nicosia','EUR','Asia','AS'),(60,'CZ','CZE','Czech Republic',420,'Kč','Prague','CZK','Europe','EU'),(61,'DK','DNK','Denmark',45,'Kr.','Copenhagen','DKK','Europe','EU'),(62,'DJ','DJI','Djibouti',253,'Fdj','Djibouti','DJF','Africa','AF'),(63,'DM','DMA','Dominica',1767,'$','Roseau','XCD','North America','NA'),(64,'DO','DOM','Dominican Republic',1809,'$','Santo Domingo','DOP','North America','NA'),(65,'EC','ECU','Ecuador',593,'$','Quito','USD','South America','SA'),(66,'EG','EGY','Egypt',20,'ج.م','Cairo','EGP','Africa','AF'),(67,'SV','SLV','El Salvador',503,'$','San Salvador','USD','North America','NA'),(68,'GQ','GNQ','Equatorial Guinea',240,'FCFA','Malabo','XAF','Africa','AF'),(69,'ER','ERI','Eritrea',291,'Nfk','Asmara','ERN','Africa','AF'),(70,'EE','EST','Estonia',372,'€','Tallinn','EUR','Europe','EU'),(71,'ET','ETH','Ethiopia',251,'Nkf','Addis Ababa','ETB','Africa','AF'),(72,'FK','FLK','Falkland Islands (Malvinas)',500,'£','Stanley','FKP','South America','SA'),(73,'FO','FRO','Faroe Islands',298,'Kr.','Torshavn','DKK','Europe','EU'),(74,'FJ','FJI','Fiji',679,'FJ$','Suva','FJD','Oceania','OC'),(75,'FI','FIN','Finland',358,'€','Helsinki','EUR','Europe','EU'),(76,'FR','FRA','France',33,'€','Paris','EUR','Europe','EU'),(77,'GF','GUF','French Guiana',594,'€','Cayenne','EUR','South America','SA'),(78,'PF','PYF','French Polynesia',689,'₣','Papeete','XPF','Oceania','OC'),(79,'TF','ATF','French Southern Territories',262,'€','Port-aux-Francais','EUR','Antarctica','AN'),(80,'GA','GAB','Gabon',241,'FCFA','Libreville','XAF','Africa','AF'),(81,'GM','GMB','Gambia',220,'D','Banjul','GMD','Africa','AF'),(82,'GE','GEO','Georgia',995,'ლ','Tbilisi','GEL','Asia','AS'),(83,'DE','DEU','Germany',49,'€','Berlin','EUR','Europe','EU'),(84,'GH','GHA','Ghana',233,'GH₵','Accra','GHS','Africa','AF'),(85,'GI','GIB','Gibraltar',350,'£','Gibraltar','GIP','Europe','EU'),(86,'GR','GRC','Greece',30,'€','Athens','EUR','Europe','EU'),(87,'GL','GRL','Greenland',299,'Kr.','Nuuk','DKK','North America','NA'),(88,'GD','GRD','Grenada',1473,'$','St. George\'s','XCD','North America','NA'),(89,'GP','GLP','Guadeloupe',590,'€','Basse-Terre','EUR','North America','NA'),(90,'GU','GUM','Guam',1671,'$','Hagatna','USD','Oceania','OC'),(91,'GT','GTM','Guatemala',502,'Q','Guatemala City','GTQ','North America','NA'),(92,'GG','GGY','Guernsey',44,'£','St Peter Port','GBP','Europe','EU'),(93,'GN','GIN','Guinea',224,'FG','Conakry','GNF','Africa','AF'),(94,'GW','GNB','Guinea-Bissau',245,'CFA','Bissau','XOF','Africa','AF'),(95,'GY','GUY','Guyana',592,'$','Georgetown','GYD','South America','SA'),(96,'HT','HTI','Haiti',509,'G','Port-au-Prince','HTG','North America','NA'),(97,'HM','HMD','Heard Island and Mcdonald Islands',0,'$','','AUD','Antarctica','AN'),(98,'VA','VAT','Holy See (Vatican City State)',39,'€','Vatican City','EUR','Europe','EU'),(99,'HN','HND','Honduras',504,'L','Tegucigalpa','HNL','North America','NA'),(100,'HK','HKG','Hong Kong',852,'$','Hong Kong','HKD','Asia','AS'),(101,'HU','HUN','Hungary',36,'Ft','Budapest','HUF','Europe','EU'),(102,'IS','ISL','Iceland',354,'kr','Reykjavik','ISK','Europe','EU'),(103,'IN','IND','India',91,'₹','New Delhi','INR','Asia','AS'),(104,'ID','IDN','Indonesia',62,'Rp','Jakarta','IDR','Asia','AS'),(105,'IR','IRN','Iran, Islamic Republic of',98,'﷼','Tehran','IRR','Asia','AS'),(106,'IQ','IRQ','Iraq',964,'د.ع','Baghdad','IQD','Asia','AS'),(107,'IE','IRL','Ireland',353,'€','Dublin','EUR','Europe','EU'),(108,'IM','IMN','Isle of Man',44,'£','Douglas, Isle of Man','GBP','Europe','EU'),(109,'IL','ISR','Israel',972,'₪','Jerusalem','ILS','Asia','AS'),(110,'IT','ITA','Italy',39,'€','Rome','EUR','Europe','EU'),(111,'JM','JAM','Jamaica',1876,'J$','Kingston','JMD','North America','NA'),(112,'JP','JPN','Japan',81,'¥','Tokyo','JPY','Asia','AS'),(113,'JE','JEY','Jersey',44,'£','Saint Helier','GBP','Europe','EU'),(114,'JO','JOR','Jordan',962,'ا.د','Amman','JOD','Asia','AS'),(115,'KZ','KAZ','Kazakhstan',7,'лв','Astana','KZT','Asia','AS'),(116,'KE','KEN','Kenya',254,'KSh','Nairobi','KES','Africa','AF'),(117,'KI','KIR','Kiribati',686,'$','Tarawa','AUD','Oceania','OC'),(118,'KP','PRK','Korea, Democratic People\'s Republic of',850,'₩','Pyongyang','KPW','Asia','AS'),(119,'KR','KOR','Korea, Republic of',82,'₩','Seoul','KRW','Asia','AS'),(120,'XK','XKX','Kosovo',383,'€','Pristina','EUR','Europe','EU'),(121,'KW','KWT','Kuwait',965,'ك.د','Kuwait City','KWD','Asia','AS'),(122,'KG','KGZ','Kyrgyzstan',996,'лв','Bishkek','KGS','Asia','AS'),(123,'LA','LAO','Lao People\'s Democratic Republic',856,'₭','Vientiane','LAK','Asia','AS'),(124,'LV','LVA','Latvia',371,'€','Riga','EUR','Europe','EU'),(125,'LB','LBN','Lebanon',961,'£','Beirut','LBP','Asia','AS'),(126,'LS','LSO','Lesotho',266,'L','Maseru','LSL','Africa','AF'),(127,'LR','LBR','Liberia',231,'$','Monrovia','LRD','Africa','AF'),(128,'LY','LBY','Libyan Arab Jamahiriya',218,'د.ل','Tripolis','LYD','Africa','AF'),(129,'LI','LIE','Liechtenstein',423,'CHf','Vaduz','CHF','Europe','EU'),(130,'LT','LTU','Lithuania',370,'€','Vilnius','EUR','Europe','EU'),(131,'LU','LUX','Luxembourg',352,'€','Luxembourg','EUR','Europe','EU'),(132,'MO','MAC','Macao',853,'$','Macao','MOP','Asia','AS'),(133,'MK','MKD','Macedonia, the Former Yugoslav Republic of',389,'ден','Skopje','MKD','Europe','EU'),(134,'MG','MDG','Madagascar',261,'Ar','Antananarivo','MGA','Africa','AF'),(135,'MW','MWI','Malawi',265,'MK','Lilongwe','MWK','Africa','AF'),(136,'MY','MYS','Malaysia',60,'RM','Kuala Lumpur','MYR','Asia','AS'),(137,'MV','MDV','Maldives',960,'Rf','Male','MVR','Asia','AS'),(138,'ML','MLI','Mali',223,'CFA','Bamako','XOF','Africa','AF'),(139,'MT','MLT','Malta',356,'€','Valletta','EUR','Europe','EU'),(140,'MH','MHL','Marshall Islands',692,'$','Majuro','USD','Oceania','OC'),(141,'MQ','MTQ','Martinique',596,'€','Fort-de-France','EUR','North America','NA'),(142,'MR','MRT','Mauritania',222,'MRU','Nouakchott','MRO','Africa','AF'),(143,'MU','MUS','Mauritius',230,'₨','Port Louis','MUR','Africa','AF'),(144,'YT','MYT','Mayotte',262,'€','Mamoudzou','EUR','Africa','AF'),(145,'MX','MEX','Mexico',52,'$','Mexico City','MXN','North America','NA'),(146,'FM','FSM','Micronesia, Federated States of',691,'$','Palikir','USD','Oceania','OC'),(147,'MD','MDA','Moldova, Republic of',373,'L','Chisinau','MDL','Europe','EU'),(148,'MC','MCO','Monaco',377,'€','Monaco','EUR','Europe','EU'),(149,'MN','MNG','Mongolia',976,'₮','Ulan Bator','MNT','Asia','AS'),(150,'ME','MNE','Montenegro',382,'€','Podgorica','EUR','Europe','EU'),(151,'MS','MSR','Montserrat',1664,'$','Plymouth','XCD','North America','NA'),(152,'MA','MAR','Morocco',212,'DH','Rabat','MAD','Africa','AF'),(153,'MZ','MOZ','Mozambique',258,'MT','Maputo','MZN','Africa','AF'),(154,'MM','MMR','Myanmar',95,'K','Nay Pyi Taw','MMK','Asia','AS'),(155,'NA','NAM','Namibia',264,'$','Windhoek','NAD','Africa','AF'),(156,'NR','NRU','Nauru',674,'$','Yaren','AUD','Oceania','OC'),(157,'NP','NPL','Nepal',977,'₨','Kathmandu','NPR','Asia','AS'),(158,'NL','NLD','Netherlands',31,'€','Amsterdam','EUR','Europe','EU'),(159,'AN','ANT','Netherlands Antilles',599,'NAf','Willemstad','ANG','North America','NA'),(160,'NC','NCL','New Caledonia',687,'₣','Noumea','XPF','Oceania','OC'),(161,'NZ','NZL','New Zealand',64,'$','Wellington','NZD','Oceania','OC'),(162,'NI','NIC','Nicaragua',505,'C$','Managua','NIO','North America','NA'),(163,'NE','NER','Niger',227,'CFA','Niamey','XOF','Africa','AF'),(164,'NG','NGA','Nigeria',234,'₦','Abuja','NGN','Africa','AF'),(165,'NU','NIU','Niue',683,'$','Alofi','NZD','Oceania','OC'),(166,'NF','NFK','Norfolk Island',672,'$','Kingston','AUD','Oceania','OC'),(167,'MP','MNP','Northern Mariana Islands',1670,'$','Saipan','USD','Oceania','OC'),(168,'NO','NOR','Norway',47,'kr','Oslo','NOK','Europe','EU'),(169,'OM','OMN','Oman',968,'.ع.ر','Muscat','OMR','Asia','AS'),(170,'PK','PAK','Pakistan',92,'₨','Islamabad','PKR','Asia','AS'),(171,'PW','PLW','Palau',680,'$','Melekeok','USD','Oceania','OC'),(172,'PS','PSE','Palestinian Territory, Occupied',970,'₪','East Jerusalem','ILS','Asia','AS'),(173,'PA','PAN','Panama',507,'B/.','Panama City','PAB','North America','NA'),(174,'PG','PNG','Papua New Guinea',675,'K','Port Moresby','PGK','Oceania','OC'),(175,'PY','PRY','Paraguay',595,'₲','Asuncion','PYG','South America','SA'),(176,'PE','PER','Peru',51,'S/.','Lima','PEN','South America','SA'),(177,'PH','PHL','Philippines',63,'₱','Manila','PHP','Asia','AS'),(178,'PN','PCN','Pitcairn',64,'$','Adamstown','NZD','Oceania','OC'),(179,'PL','POL','Poland',48,'zł','Warsaw','PLN','Europe','EU'),(180,'PT','PRT','Portugal',351,'€','Lisbon','EUR','Europe','EU'),(181,'PR','PRI','Puerto Rico',1787,'$','San Juan','USD','North America','NA'),(182,'QA','QAT','Qatar',974,'ق.ر','Doha','QAR','Asia','AS'),(183,'RE','REU','Reunion',262,'€','Saint-Denis','EUR','Africa','AF'),(184,'RO','ROM','Romania',40,'lei','Bucharest','RON','Europe','EU'),(185,'RU','RUS','Russian Federation',7,'₽','Moscow','RUB','Asia','AS'),(186,'RW','RWA','Rwanda',250,'FRw','Kigali','RWF','Africa','AF'),(187,'BL','BLM','Saint Barthelemy',590,'€','Gustavia','EUR','North America','NA'),(188,'SH','SHN','Saint Helena',290,'£','Jamestown','SHP','Africa','AF'),(189,'KN','KNA','Saint Kitts and Nevis',1869,'$','Basseterre','XCD','North America','NA'),(190,'LC','LCA','Saint Lucia',1758,'$','Castries','XCD','North America','NA'),(191,'MF','MAF','Saint Martin',590,'€','Marigot','EUR','North America','NA'),(192,'PM','SPM','Saint Pierre and Miquelon',508,'€','Saint-Pierre','EUR','North America','NA'),(193,'VC','VCT','Saint Vincent and the Grenadines',1784,'$','Kingstown','XCD','North America','NA'),(194,'WS','WSM','Samoa',684,'SAT','Apia','WST','Oceania','OC'),(195,'SM','SMR','San Marino',378,'€','San Marino','EUR','Europe','EU'),(196,'ST','STP','Sao Tome and Principe',239,'Db','Sao Tome','STD','Africa','AF'),(197,'SA','SAU','Saudi Arabia',966,'﷼','Riyadh','SAR','Asia','AS'),(198,'SN','SEN','Senegal',221,'CFA','Dakar','XOF','Africa','AF'),(199,'RS','SRB','Serbia',381,'din','Belgrade','RSD','Europe','EU'),(200,'CS','SCG','Serbia and Montenegro',381,'din','Belgrade','RSD','Europe','EU'),(201,'SC','SYC','Seychelles',248,'SRe','Victoria','SCR','Africa','AF'),(202,'SL','SLE','Sierra Leone',232,'Le','Freetown','SLL','Africa','AF'),(203,'SG','SGP','Singapore',65,'$','Singapur','SGD','Asia','AS'),(204,'SX','SXM','Sint Maarten',721,'ƒ','Philipsburg','ANG','North America','NA'),(205,'SK','SVK','Slovakia',421,'€','Bratislava','EUR','Europe','EU'),(206,'SI','SVN','Slovenia',386,'€','Ljubljana','EUR','Europe','EU'),(207,'SB','SLB','Solomon Islands',677,'Si$','Honiara','SBD','Oceania','OC'),(208,'SO','SOM','Somalia',252,'Sh.so.','Mogadishu','SOS','Africa','AF'),(209,'ZA','ZAF','South Africa',27,'R','Pretoria','ZAR','Africa','AF'),(210,'GS','SGS','South Georgia and the South Sandwich Islands',500,'£','Grytviken','GBP','Antarctica','AN'),(211,'SS','SSD','South Sudan',211,'£','Juba','SSP','Africa','AF'),(212,'ES','ESP','Spain',34,'€','Madrid','EUR','Europe','EU'),(213,'LK','LKA','Sri Lanka',94,'Rs','Colombo','LKR','Asia','AS'),(214,'SD','SDN','Sudan',249,'.س.ج','Khartoum','SDG','Africa','AF'),(215,'SR','SUR','Suriname',597,'$','Paramaribo','SRD','South America','SA'),(216,'SJ','SJM','Svalbard and Jan Mayen',47,'kr','Longyearbyen','NOK','Europe','EU'),(217,'SZ','SWZ','Swaziland',268,'E','Mbabane','SZL','Africa','AF'),(218,'SE','SWE','Sweden',46,'kr','Stockholm','SEK','Europe','EU'),(219,'CH','CHE','Switzerland',41,'CHf','Berne','CHF','Europe','EU'),(220,'SY','SYR','Syrian Arab Republic',963,'LS','Damascus','SYP','Asia','AS'),(221,'TW','TWN','Taiwan, Province of China',886,'$','Taipei','TWD','Asia','AS'),(222,'TJ','TJK','Tajikistan',992,'SM','Dushanbe','TJS','Asia','AS'),(223,'TZ','TZA','Tanzania, United Republic of',255,'TSh','Dodoma','TZS','Africa','AF'),(224,'TH','THA','Thailand',66,'฿','Bangkok','THB','Asia','AS'),(225,'TL','TLS','Timor-Leste',670,'$','Dili','USD','Asia','AS'),(226,'TG','TGO','Togo',228,'CFA','Lome','XOF','Africa','AF'),(227,'TK','TKL','Tokelau',690,'$','','NZD','Oceania','OC'),(228,'TO','TON','Tonga',676,'$','Nuku\'alofa','TOP','Oceania','OC'),(229,'TT','TTO','Trinidad and Tobago',1868,'$','Port of Spain','TTD','North America','NA'),(230,'TN','TUN','Tunisia',216,'ت.د','Tunis','TND','Africa','AF'),(231,'TR','TUR','Turkey',90,'₺','Ankara','TRY','Asia','AS'),(232,'TM','TKM','Turkmenistan',7370,'T','Ashgabat','TMT','Asia','AS'),(233,'TC','TCA','Turks and Caicos Islands',1649,'$','Cockburn Town','USD','North America','NA'),(234,'TV','TUV','Tuvalu',688,'$','Funafuti','AUD','Oceania','OC'),(235,'UG','UGA','Uganda',256,'USh','Kampala','UGX','Africa','AF'),(236,'UA','UKR','Ukraine',380,'₴','Kiev','UAH','Europe','EU'),(237,'AE','ARE','United Arab Emirates',971,'إ.د','Abu Dhabi','AED','Asia','AS'),(238,'GB','GBR','United Kingdom',44,'£','London','GBP','Europe','EU'),(239,'US','USA','United States',1,'$','Washington','USD','North America','NA'),(240,'UM','UMI','United States Minor Outlying Islands',1,'$','','USD','North America','NA'),(241,'UY','URY','Uruguay',598,'$','Montevideo','UYU','South America','SA'),(242,'UZ','UZB','Uzbekistan',998,'лв','Tashkent','UZS','Asia','AS'),(243,'VU','VUT','Vanuatu',678,'VT','Port Vila','VUV','Oceania','OC'),(244,'VE','VEN','Venezuela',58,'Bs','Caracas','VEF','South America','SA'),(245,'VN','VNM','Viet Nam',84,'₫','Hanoi','VND','Asia','AS'),(246,'VG','VGB','Virgin Islands, British',1284,'$','Road Town','USD','North America','NA'),(247,'VI','VIR','Virgin Islands, U.s.',1340,'$','Charlotte Amalie','USD','North America','NA'),(248,'WF','WLF','Wallis and Futuna',681,'₣','Mata Utu','XPF','Oceania','OC'),(249,'EH','ESH','Western Sahara',212,'MAD','El-Aaiun','MAD','Africa','AF'),(250,'YE','YEM','Yemen',967,'﷼','Sanaa','YER','Asia','AS'),(251,'ZM','ZMB','Zambia',260,'ZK','Lusaka','ZMW','Africa','AF'),(252,'ZW','ZWE','Zimbabwe',263,'$','Harare','ZWL','Africa','AF');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(191) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `about_me` text,
  `birthday` date NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` mediumtext NOT NULL,
  `province` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `ward` varchar(255) DEFAULT NULL,
  `avatar` mediumtext,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_forget_pass_otp`
--

DROP TABLE IF EXISTS `customer_forget_pass_otp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_forget_pass_otp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(191) NOT NULL,
  `user_id` int NOT NULL,
  `otp_mail` varchar(6) NOT NULL,
  `status` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_forget_pass_otp`
--

LOCK TABLES `customer_forget_pass_otp` WRITE;
/*!40000 ALTER TABLE `customer_forget_pass_otp` DISABLE KEYS */;
INSERT INTO `customer_forget_pass_otp` VALUES (1,'bichnhibe@gmail.com',1,'859546',0,'2021-10-22 10:31:56','2021-10-22 10:31:56'),(2,'bichnhibe@gmail.com',1,'254007',0,'2021-10-22 10:34:17','2021-10-22 10:34:17'),(3,'bichnhibe@gmail.com',1,'955604',0,'2021-10-22 10:34:52','2021-10-22 10:34:52'),(4,'bichnhibe@gmail.com',1,'473605',0,'2021-10-22 10:35:17','2021-10-22 10:35:17'),(5,'bichnhibe@gmail.com',1,'477997',0,'2021-10-22 10:36:25','2021-10-22 10:36:25'),(6,'bichnhibe@gmail.com',1,'727958',0,'2021-10-22 10:36:46','2021-10-22 10:36:46'),(7,'bichnhibe@gmail.com',1,'453948',0,'2021-10-22 10:37:29','2021-10-22 10:37:29'),(8,'bichnhibe@gmail.com',1,'699374',0,'2021-10-22 10:38:13','2021-10-22 10:38:13'),(9,'bichnhibe@gmail.com',1,'502117',1,'2021-10-22 10:40:10','2021-10-22 10:46:10'),(10,'bichnhibe@gmail.com',1,'488433',0,'2021-12-06 14:44:02','2021-12-06 14:44:02'),(11,'bichnhibe@gmail.com',1,'563607',0,'2021-12-22 09:29:15','2021-12-22 09:29:15'),(12,'hoangphat5393@gmail.com',12,'713025',0,'2023-05-04 14:13:40','2023-05-04 14:13:40'),(13,'bichnhibe@gmail.com',6,'379130',1,'2023-05-25 16:26:57','2023-05-25 16:27:29'),(14,'bichnhibe@gmail.com',6,'351044',1,'2023-05-25 16:28:31','2023-05-25 16:28:46'),(15,'smalldevil94@gmail.com',14,'355742',1,'2023-06-02 05:51:30','2023-06-02 05:51:54');
/*!40000 ALTER TABLE `customer_forget_pass_otp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_templates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `group` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `sort` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES (1,'Thông báo liên hệ tới Admin','contact_admin','&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Thông tin liên hệ đăng ký tư vấn&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;==============================&lt;/p&gt;\r\n\r\n&lt;p&gt;Tên: {{$name}}&lt;br /&gt;\r\nEmail: {{$email}}&lt;br /&gt;\r\nĐiện thoại: {{$phone}}&lt;br /&gt;\r\nLời nhắn: {{$content}}&lt;/p&gt;\r\n\r\n&lt;p&gt;==============================&lt;/p&gt;',1,0,'2024-01-20 12:12:26',NULL);
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `available_at` int unsigned NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `payload` longtext NOT NULL,
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`(191))
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1679078800,0,'{\"uuid\":\"ffe7626a-8230-4de6-b6ff-6e2bdc1eb1e9\",\"displayName\":\"App\\\\Jobs\\\\ProcessImportData\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\ProcessImportData\",\"command\":\"O:26:\\\"App\\\\Jobs\\\\ProcessImportData\\\":10:{s:39:\\\"\\u0000App\\\\Jobs\\\\ProcessImportData\\u0000productTask\\\";O:21:\\\"App\\\\Tasks\\\\ProductTask\\\":0:{}s:38:\\\"\\u0000App\\\\Jobs\\\\ProcessImportData\\u0000excel_path\\\";s:68:\\\"\\/public\\/\\/excel-file\\/excel-1679078797-Game_Item_Category_List-(2).xls\\\";s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2023-03-18 01:46:40.758758\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:16:\\\"Asia\\/Ho_Chi_Minh\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}',64,'default',NULL,1679078797);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int unsigned NOT NULL,
  `slug` text,
  `label` varchar(255) DEFAULT NULL,
  `link` text,
  `image` text,
  `content` mediumtext,
  `parent` int unsigned NOT NULL DEFAULT '0',
  `sort` int NOT NULL DEFAULT '0',
  `class` varchar(255) DEFAULT NULL,
  `depth` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rel` varchar(10) DEFAULT 'dofollow',
  `target` varchar(10) DEFAULT '_self',
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=351 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (218,1,'home','Trang chủ','#home',NULL,NULL,0,0,'',0,'2024-03-08 04:33:58','2025-08-24 08:57:05','dofollow','_self'),(240,1,'about','Giới thiệu','#about',NULL,NULL,0,1,'',0,'2024-03-08 07:01:55','2025-08-24 08:57:12','dofollow','_self'),(256,1,'contact','Liên hệ','#contact',NULL,NULL,0,3,'',0,'2024-03-08 10:05:17','2025-08-24 08:57:22','dofollow','_self'),(257,1,'service','Dịch vụ','#service',NULL,NULL,0,2,'',0,'2024-03-08 10:08:42','2025-08-24 08:57:17','dofollow','_self'),(260,7,'donate','Quyên góp','https://onehealth.foundation/donate',NULL,NULL,268,12,'',1,'2024-03-14 01:15:16','2024-10-04 13:23:58','dofollow','_self'),(261,7,'about','Về chúng tôi','#',NULL,NULL,0,6,'',0,'2024-03-14 01:15:16','2024-11-11 03:27:11','dofollow','_self'),(262,7,'doi-ngu-chu-chot','Đội ngũ chủ chốt','https://onehealth.foundation/doi-ngu-chu-chot',NULL,NULL,261,7,'',1,'2024-03-14 01:15:16','2024-11-11 03:27:11','dofollow','_self'),(263,7,'tuyen-dung','Tuyển dụng','https://onehealth.foundation/tuyen-dung',NULL,NULL,268,14,'',1,'2024-03-14 01:15:16','2024-10-04 13:23:58','dofollow','_self'),(264,7,'hoc-bong','Học bổng','https://onehealth.foundation/hoc-bong',NULL,NULL,268,13,'',1,'2024-03-14 01:15:16','2024-10-04 13:23:58','dofollow','_self'),(266,7,'thuc-tap','Thực tập','https://onehealth.foundation/thuc-tap',NULL,NULL,268,15,'',1,'2024-03-14 01:15:17','2024-10-04 13:23:58','dofollow','_self'),(267,7,'contact','Liên hệ','https://onehealth.foundation/contact',NULL,NULL,261,9,'',1,'2024-03-14 01:20:38','2024-11-11 03:27:11','dofollow','_self'),(268,7,'','Gia đình OHF','#',NULL,NULL,0,10,'',0,'2024-03-14 01:22:48','2024-10-04 13:23:58','dofollow','_self'),(269,7,'ho-tro','Hỗ trợ','https://onehealth.foundation/ho-tro',NULL,NULL,268,16,'',1,'2024-03-14 01:23:14','2024-10-04 13:23:58','dofollow','_self'),(270,7,'','Đối tác','#',NULL,NULL,0,0,'',0,'2024-03-14 01:24:53','2024-11-11 03:27:10','dofollow','_self'),(271,7,'','CĐ Y Dược Hồng Đức','http://hongduccollege.edu.vn/',NULL,NULL,270,1,'',1,'2024-03-14 01:25:18','2024-11-11 03:27:11','dofollow','_self'),(272,7,'','Dr.OH','https://droh.co/',NULL,NULL,270,4,'',1,'2024-03-14 01:25:27','2024-11-11 03:27:11','dofollow','_self'),(273,7,'','Dr.Fitness','https://drfitness.vn/',NULL,NULL,270,5,'',1,'2024-03-14 01:25:37','2024-11-11 03:27:11','dofollow','_self'),(274,7,'','Bệnh viện Hồng Đức','http://hongduchospital.vn/',NULL,NULL,270,3,'',1,'2024-03-14 01:25:50','2024-11-11 03:27:11','dofollow','_self'),(304,7,'tro-thanh-tinh-nguyen-vien','Trở thành tình nguyện viên','https://onehealth.foundation/be-a-volunteer',NULL,NULL,268,11,'',1,'2024-04-19 08:22:32','2024-10-04 13:23:58','dofollow','_self'),(305,7,'kham-pha-nghe-nghiep','Khám phá nghề nghiệp','https://onehealth.foundation/kham-pha-nghe-nghiep',NULL,NULL,268,17,'',1,'2024-04-19 08:22:32','2024-10-04 13:23:59','dofollow','_self'),(317,7,'doi-tac','Viện Khoa Học Kinh Tế Công Nghệ Y Tế','https://iest.edu.vn/',NULL,NULL,270,2,'',1,'2024-04-30 17:34:11','2024-11-11 03:27:11','dofollow','_self'),(319,7,'bao-chi','Báo chí','https://onehealth.foundation/danh-gia-cua-bao',NULL,NULL,261,8,'',1,'2024-05-03 01:35:03','2024-11-11 03:27:11','dofollow','_self');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Menu-main   ','2021-11-05 18:27:32','2025-08-24 08:35:33'),(7,'Menu-footer ','2022-01-06 18:00:17','2025-08-24 08:27:32');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (5,'2024_05_09_092901_create_sessions_table',2),(4,'0001_01_01_000001_create_cache_table',1),(45,'2024_10_04_134228_create_admin_permission_table',0),(44,'2024_10_04_134228_create_admin_menus_table',0),(43,'2024_10_04_134228_create_admin_menu_items_table',0),(42,'2024_10_04_134228_create_admin_menu_table',0),(41,'2024_08_23_102058_create_users_table',12),(40,'2024_08_03_112929_create_services_table',12),(30,'2024_07_02_092259_create_shortcodes_table',10),(29,'2024_06_24_094638_create_album_items_table',9),(28,'2024_06_24_094602_create_albums_table',9),(31,'2024_07_23_104424_create_posts_table',0),(32,'2024_07_23_113150_create_works_table',11),(46,'2024_10_04_134228_create_admin_role_table',0),(47,'2024_10_04_134228_create_admin_role_permission_table',0),(48,'2024_10_04_134228_create_admin_role_user_table',0),(49,'2024_10_04_134228_create_admins_table',0),(50,'2024_10_04_134228_create_album_items_table',0),(51,'2024_10_04_134228_create_albums_table',0),(52,'2024_10_04_134228_create_cache_table',0),(53,'2024_10_04_134228_create_cache_locks_table',0),(54,'2024_10_04_134228_create_category_table',0),(55,'2024_10_04_134228_create_contacts_table',0),(56,'2024_10_04_134228_create_country_table',0),(57,'2024_10_04_134228_create_customer_table',0),(58,'2024_10_04_134228_create_customer_forget_pass_otp_table',0),(59,'2024_10_04_134228_create_district_table',0),(60,'2024_10_04_134228_create_districts_table',0),(61,'2024_10_04_134228_create_email_templates_table',0),(62,'2024_10_04_134228_create_failed_jobs_table',0),(63,'2024_10_04_134228_create_job_batches_table',0),(64,'2024_10_04_134228_create_jobs_table',0),(65,'2024_10_04_134228_create_page_table',0),(66,'2024_10_04_134228_create_password_reset_tokens_table',0),(67,'2024_10_04_134228_create_password_resets_table',0),(68,'2024_10_04_134228_create_permission_role_table',0),(69,'2024_10_04_134228_create_permissions_table',0),(70,'2024_10_04_134228_create_post_categories_table',0),(71,'2024_10_04_134228_create_posts_table',0),(72,'2024_10_04_134228_create_province_table',0),(73,'2024_10_04_134228_create_provinces_table',0),(74,'2024_10_04_134228_create_role_user_table',0),(75,'2024_10_04_134228_create_roles_table',0),(76,'2024_10_04_134228_create_services_table',0),(77,'2024_10_04_134228_create_sessions_table',0),(78,'2024_10_04_134228_create_settings_table',0),(79,'2024_10_04_134228_create_shop_currency_table',0),(80,'2024_10_04_134228_create_shortcodes_table',0),(81,'2024_10_04_134228_create_state_table',0),(82,'2024_10_04_134228_create_street_table',0),(83,'2024_10_04_134228_create_subscriptions_table',0),(84,'2024_10_04_134228_create_user_password_auto_table',0),(85,'2024_10_04_134228_create_users_table',0),(86,'2024_10_04_134228_create_ward_table',0),(87,'2024_10_04_134228_create_wards_table',0),(88,'2024_10_04_134228_create_work_categories_table',0),(89,'2024_10_04_134228_create_works_table',0),(90,'2024_10_04_134231_add_foreign_keys_to_album_items_table',0),(91,'2026_08_28_000001_create_post_categories_if_not_exists',13),(92,'2026_08_28_000002_seed_clean_admin_menus',14),(93,'2026_08_28_000003_cleanup_shortcodes_and_refine_admin_menus',15),(94,'2026_08_28_000004_fix_admin_menus_tree_structure',16),(95,'2026_08_28_000005_seed_high_quality_salon_media',17),(96,'2026_08_28_000006_sync_roles_and_permissions_from_3nong',18),(97,'2026_08_28_000007_clean_service_and_post_menus',19),(98,'2026_09_04_232755_add_address_to_contacts_table',20);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `slug` text,
  `name` text,
  `description` longtext,
  `content` longtext,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `seo_title` varchar(150) DEFAULT NULL,
  `seo_keyword` mediumtext,
  `seo_description` mediumtext,
  `type` varchar(50) DEFAULT NULL COMMENT 'page | post',
  `sort` int DEFAULT '0',
  `status` int DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_user_id_foreign` (`user_id`),
  CONSTRAINT `pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (2,'contact','contact','<p>contact</p>',NULL,NULL,NULL,'home',NULL,NULL,'page',4,1,'2025-05-01 09:05:33','2025-08-29 00:33:18',1),(3,'home','home','<p>home</p>',NULL,NULL,NULL,'home',NULL,NULL,'page',1,1,'2025-05-03 08:34:52','2025-08-29 00:33:18',1),(4,'blog','blog','blog',NULL,NULL,NULL,'blog',NULL,NULL,'page',3,1,'2025-05-03 08:35:09','2025-08-29 00:33:20',1),(5,'blog-5','blog','blog',NULL,NULL,NULL,'blog',NULL,NULL,'page',5,1,'2025-08-29 00:39:01','2025-08-29 00:39:01',1),(42,'cat-say-tao-kieu-chuan-ty-le-vang','Cắt & Sấy Tạo Kiểu Chuẩn Tỷ Lệ Vàng','Cắt tỉa form tóc cá nhân hóa theo từng dáng khuôn mặt, gội massage bấm huyệt và sấy tạo kiểu bồng bềnh tự nhiên.','<p>Dịch vụ cắt tóc chuẩn Salon Nhật Bản với quy trình 5 bước: Tư vấn dáng tóc - Gội dưỡng sinh - Cắt tỉa kỹ thuật cao - Xả sạch - Sấy tạo phom bồng bềnh.</p>',NULL,'upload/images/service_1.jpg',NULL,NULL,NULL,'service',1,1,'2026-08-28 15:06:13','2026-08-28 15:06:13',1),(43,'uon-setting-song-loi-organic-nhat-ban','Uốn Setting Sóng Lơi Organic Nhật Bản','Kỹ thuật uốn setting nhiệt độ thấp kết hợp thuốc uốn hữu cơ giúp giữ nếp sóng lơi tự nhiên, tóc bóng mượt không lo khô xơ.','<p>Công nghệ uốn sóng lơi độc quyền từ Tokyo mang lại mái tóc xoăn mềm mại như lụa, dễ dàng chăm sóc tại nhà chỉ với thao tác sấy tay đơn giản.</p>',NULL,'upload/images/service_2.jpg',NULL,NULL,NULL,'service',2,1,'2026-08-28 15:06:13','2026-08-28 15:06:13',1),(44,'nhuom-thoi-thuong-va-tay-toc-cong-nghe-bao-ve','Nhuộm Thời Thượng & Tẩy Tóc Công Nghệ Bảo Vệ','Bảng màu hot trend đa dạng: Nâu tây, Trà sữa, Khói xám, Balayage. Công nghệ khóa màu hạt nano giúp tóc bóng khỏe dài lâu.','<p>Nhuộm tóc với dòng sản phẩm cao cấp không mùi hắc, bảo vệ da đầu nhạy cảm và duy trì độ bóng mượt vượt trội.</p>',NULL,'upload/images/service_3.jpg',NULL,NULL,NULL,'service',3,1,'2026-08-28 15:06:13','2026-08-29 01:21:09',1),(45,'combo-phuc-hoi-toc-keratin-chuyen-sau-tai-sinh','Combo Phục Hồi Tóc Keratin Chuyên Sâu Tái Sinh','Cứu cánh cho mái tóc hư tổn nặng do uốn nhuộm nhiều lần. Bổ sung Keratin và Protein tái tạo lõi tóc từ sâu bên trong.','<p>Liệu trình phục hồi 4 bước độc quyền giúp tóc lấy lại độ đàn hồi, hết chẻ ngọn và mềm mượt tức thì ngay sau buổi đầu tiên.</p>',NULL,'upload/images/service_4.jpg',NULL,NULL,NULL,'service',4,1,'2026-08-28 15:06:13','2026-08-29 01:21:00',1),(90,'top-5-mau-toc-nhuom-ton-da-hot-nhat-2026','Top 5 Màu Tóc Nhuộm Tôn Da Cực Hot Dành Cho Nàng Công Sở 2026','Khám phá ngay bảng màu nhuộm sang trọng, không cần tẩy tóc nhưng vẫn nâng tông da rạng rỡ như Nâu Tây ánh khói, Trà sữa trầm, Nâu mocha và Nâu hạt dẻ mật ong.','<p>Một mái tóc đẹp với tone màu phù hợp không chỉ tôn lên đường nét thanh tú của khuôn mặt mà còn giúp làn da của bạn trông sáng hơn từ 1 đến 2 tone. Đặc biệt đối với các quý cô công sở, việc lựa chọn màu tóc vừa thời thượng, thanh lịch nhưng không quá chói lọi luôn là ưu tiên hàng đầu.</p>\n<h3>1. Nâu Tây Ánh Khói – Sang Chảnh & Tinh Tế</h3>\n<p>Nâu Tây ánh khói là sự kết hợp hoàn hảo giữa sắc nâu trầm ấm và ánh khói mờ ảo. Màu sắc này đặc biệt thích hợp với tone da người Châu Á, tạo cảm giác tóc dày dặn và mềm mượt hơn dưới ánh nắng.</p>\n<h3>2. Nâu Trà Sữa Trầm – Ngọt Ngào & Thanh Lịch</h3>\n<p>Không cần trải qua quá trình tẩy tóc gắt gao, tone màu trà sữa trầm vẫn lên chuẩn sắc nét tại Salon Dũng Tokyo nhờ kỹ thuật pha màu độc quyền từ mỹ phẩm hữu cơ Nhật Bản.</p>\n<h3>3. Nâu Hạt Dẻ Mật Ong – Tone Màu Quốc Dân</h3>\n<p>Nếu bạn muốn an toàn nhưng vẫn trẻ trung, hạt dẻ mật ong chính là sự lựa chọn số một. Màu tóc này giúp gương mặt luôn tươi tắn ngay cả khi bạn không trang điểm cầu kỳ.</p>\n<blockquote>Tại <strong>Salon Dũng Tokyo</strong>, 100% thuốc nhuộm đều là sản phẩm chính hãng, bổ sung dưỡng chất bọc sợi tóc giúp tóc giữ độ bóng mượt và bền màu đến hơn 6 tháng.</blockquote>',NULL,'upload/images/hair_1.jpg','Top 5 Màu Tóc Nhuộm Tôn Da Cực Hot Cho Nàng Công Sở | Salon Dũng Tokyo','mau toc ton da, mau nhuom dep 2026, salon dung tokyo, nhuom toc dep','Khám phá top 5 màu tóc nhuộm tôn da cực hot năm 2026 không cần tẩy tóc tại Salon Dũng Tokyo. Màu nhuộm sang trọng, bóng mượt giữ nếp lâu.','post',1,1,'2026-09-03 23:23:10','2026-09-03 23:23:10',1),(91,'bi-quyet-giu-nep-toc-uon-song-loi-bong-benh','Bí Quyết Giữ Nếp Tóc Uốn Sóng Lơi Bồng Bềnh Như Vừa Bước Ra Từ Salon','Uốn sóng lơi tự nhiên là phong cách được yêu thích nhất tại Salon Dũng Tokyo. Bỏ túi ngay 4 mẹo sấy tóc tại nhà bằng kẹp càng cua và tinh dầu dưỡng để tóc luôn vào nếp óng ả.','<p>Kiểu tóc uốn sóng lơi luôn chiếm trọn cảm tình của phái đẹp bởi vẻ bồng bềnh, phóng khoáng và tự nhiên. Tuy nhiên, nhiều nàng thường than phiền rằng sau khi gội đầu ở nhà, lọn sóng không còn giữ được phom dáng như ở tiệm. Dưới đây là những mẹo vàng từ master stylist Dũng Tokyo.</p>\n<h3>1. Dùng Kẹp Càng Cua Cuộn Tròn Khi Làm Việc & Đi Ngủ</h3>\n<p>Sau khi sấy khô tóc khoảng 80%, chia tóc làm hai nhánh và xoắn nhẹ theo chiều sóng, sau đó dùng kẹp càng cua cố định trên đỉnh đầu. Cách này giúp giữ nếp sóng lơi xoăn lọn tự nhiên mà không gây gãy tóc.</p>\n<h3>2. Sấy Xoay Trục Bằng Ngón Tay</h3>\n<p>Hãy điều chỉnh máy sấy ở chế độ nhiệt ấm vừa phải. Trong khi sấy, dùng ngón tay xoắn nhẹ các lọn tóc theo chiều hướng ra ngoài hoặc vào trong tùy theo phom uốn ban đầu.</p>\n<h3>3. Sử Dụng Tinh Dầu Dưỡng Khi Tóc Còn Hơi Ẩm</h3>\n<p>Lấy 2-3 giọt tinh dầu Argan hoặc Macadamia xoa đều lòng bàn tay, sau đó bóp nhẹ từ ngọn tóc lên thân tóc. Tuyệt đối không thoa sát da đầu để tránh bết rít.</p>',NULL,'upload/images/hair_2.jpg','Bí Quyết Giữ Nếp Tóc Uốn Sóng Lơi Bồng Bềnh | Salon Dũng Tokyo','giu nep toc uon, cham soc toc song loi, salon dung tokyo','Hướng dẫn 4 mẹo chăm sóc và giữ nếp tóc uốn sóng lơi bền đẹp tại nhà chuẩn kỹ thuật salon từ chuyên gia Dũng Tokyo.','post',2,1,'2026-09-02 23:23:10','2026-09-02 23:23:10',1),(92,'phuc-hoi-toc-chuyen-sau-phu-lua-nano-collagen','Phục Hồi Tóc Chuyên Sâu Bằng Công Nghệ Phủ Lụa Nano & Collagen Sinh Học','Giải pháp cứu cánh toàn diện cho mái tóc khô xơ, gãy rụng do hóa chất và nhiệt độ cao. Tái sinh cấu trúc tóc từ lõi tủy với liệu trình chuyên sâu 6 bước tại Dũng Tokyo.','<p>Mái tóc sau nhiều lần uốn, nhuộm, tẩy thường bị mất đi lớp biểu bì bảo vệ (cuticle), khiến tủy tóc rỗng xốp, dễ đứt gãy và xơ rối. Liệu pháp phục hồi phủ lụa Nano Collagen độc quyền tại Salon Dũng Tokyo là bước đột phá giúp khôi phục sức sống cho mái tóc.</p>\n<h3>Cơ Chế Phục Hồi Đa Tầng Của Hạt Nano</h3>\n<p>Các phân tử collagen và keratin siêu nhỏ có kích thước nano thẩm thấu trực tiếp vào lõi tủy tóc, lấp đầy các khoảng trống đứt gãy trong chuỗi liên kết protein.</p>\n<h3>Quy Trình 6 Bước Chuẩn Salon Nhật Bản:</h3>\n<ol>\n    <li>Gội sạch sâu loại bỏ tạp chất và silicon tích tụ lâu ngày.</li>\n    <li>Ủ hấp nhiệt ẩm với tinh chất Collagen tươi và Keratin phục hồi.</li>\n    <li>Bắn máy ánh sáng sinh học Nano kích thích nang tóc hấp thu dưỡng chất.</li>\n    <li>Khóa biểu bì bằng tinh chất lụa tơ tằm nguyên chất.</li>\n    <li>Massage bấm huyệt da đầu thư giãn, kích thích tuần hoàn máu.</li>\n    <li>Sấy tạo kiểu bảo vệ nhiệt chuyên nghiệp.</li>\n</ol>',NULL,'upload/images/hair_3.jpg','Phục Hồi Tóc Phủ Lụa Nano Collagen Chuyên Sâu | Salon Dũng Tokyo','phuc hoi toc hu ton, phu lua nano collagen, salon dung tokyo','Dịch vụ phục hồi tóc hư tổn nặng bằng công nghệ phủ lụa nano collagen tại Salon Dũng Tokyo. Tóc mềm mượt, chắc khỏe ngay sau buổi đầu tiên.','post',3,1,'2026-09-01 23:23:10','2026-09-01 23:23:10',1),(93,'xu-huong-cat-toc-layer-tang-cao-ca-tinh','Xu Hướng Cắt Tóc Layer Tầng Cao Cá Tính – Đột Phá Nét Đẹp Gương Mặt','Cắt tỉa Layer chuẩn tỉ lệ vàng giúp khắc phục khuyết điểm mặt tròn, gò má cao và tạo hiệu ứng tóc dày bồng bềnh tự nhiên mà không cần tạo kiểu cầu kỳ mỗi sáng.','<p>Tóc cắt tỉa Layer chưa bao giờ giảm nhiệt trong bản đồ thời trang tóc thế giới. Nhờ các tầng tóc được tỉa so le khéo léo, mái tóc có độ phồng và chuyển động uyển chuyển theo từng bước chân của bạn.</p>\n<h3>Dáng Layer Bay Dịu Dàng Chuẩn Hàn</h3>\n<p>Phần tóc mái bay ôm nhẹ theo xương quai hàm giúp che khéo gò má cao và tạo cảm giác gương mặt thon gọn V-line đáng kể.</p>\n<h3>Dáng Layer Mullet & Shag Cho Nàng Năng Động</h3>\n<p>Dành riêng cho những cô nàng theo đuổi phong cách cá tính, phóng khoáng và khác biệt. Từng thớ tóc được tỉa mỏng nhẹ, ôm gọn gáy và phồng nhẹ ở đỉnh đầu.</p>',NULL,'upload/images/hair_4.jpg','Xu Hướng Cắt Tóc Layer Tầng Cao Đẹp Nhất | Salon Dũng Tokyo','cat toc layer, kieu toc layer dep, salon dung tokyo, cat toc nu','Tổng hợp các kiểu cắt tóc layer đẹp tôn dáng khuôn mặt tại Salon Dũng Tokyo. Thợ cắt tỉa tóc tay nghề cao, tạo phom chuẩn chỉnh.','post',4,1,'2026-08-31 23:23:10','2026-08-31 23:23:10',1),(94,'cham-soc-da-dau-dau-ngon-toc-kho-mua-nang-nong','Cách Chăm Sóc Da Đầu Dầu Nhưng Ngọn Tóc Khô Ráp Trong Thời Tiết Nắng Nóng','Tình trạng da đầu bết dính nhưng đuôi tóc lại chẻ ngọn là nỗi trăn trở của rất nhiều chị em. Cùng chuyên gia Dũng Tokyo tìm hiểu cách cân bằng độ pH và độ ẩm chuẩn xác.','<p>Nhiều khách hàng đến với Salon Dũng Tokyo trong tình trạng da đầu nhiều dầu, gội buổi sáng nhưng buổi chiều đã bết rít, thế nhưng phần thân và ngọn tóc lại giòn xơ, dễ gãy. Đây chính là hiện tượng mất cân bằng độ ẩm điển hình.</p>\n<h3>Nguyên Nhân Gây Nên Tình Trạng \"Đầu Dầu - Ngọn Khô\"</h3>\n<p>Việc gội đầu quá nhiều lần với dầu gội có chất tẩy rửa mạnh làm mất lớp dầu tự nhiên của da đầu, buộc tuyến bã nhờn phải tiết ra nhiều dầu hơn để bù đắp, trong khi dưỡng chất không thể truyền tới tận ngọn tóc.</p>\n<h3>Giải Pháp Cân Bằng Toàn Diện:</h3>\n<ul>\n    <li>Chỉ thoa dầu xả và kem ủ từ phần tai trở xuống ngọn tóc, cách chân tóc ít nhất 5cm.</li>\n    <li>Sử dụng sản phẩm tẩy tế bào chết da đầu sinh học 1 lần/tuần để thông thoáng lỗ chân lông nang tóc.</li>\n    <li>Gội đầu bằng nước mát hoặc nước ấm vừa phải, tránh dùng nước quá nóng.</li>\n</ul>',NULL,'upload/images/hair_5.jpg','Chăm Sóc Da Đầu Dầu Ngọn Tóc Khô Đúng Cách | Salon Dũng Tokyo','da dau dau ngon kho, cham soc toc dung cach, salon dung tokyo','Bí quyết cân bằng da đầu dầu và ngọn tóc khô xơ hiệu quả từ chuyên gia tạo mẫu tóc Salon Dũng Tokyo.','post',5,1,'2026-08-30 23:23:10','2026-08-30 23:23:10',1),(95,'nhuom-balayage-babylights-dinh-cao-toc-da-chieu','Balayage & Babylights: Đỉnh Cao Kỹ Thuật Nhuộm Tóc Đa Chiều Không Lo Lộ Chân Đen','Phong cách nhuộm hiệu ứng chuyển màu mượt mà từ chân tóc đến ngọn giúp bạn tự tin tỏa sáng suốt 6-9 tháng mà không cần dặm lại chân tóc liên tục.','<p>Balayage (xuất phát từ tiếng Pháp nghĩa là \"quét cọ\") là kỹ thuật vẽ màu tự do lên từng tép tóc, tạo hiệu ứng chuyển sắc mềm mại như ánh nắng mặt trời rọi vào mái tóc. Kết hợp cùng các sợi highlight siêu mảnh (Babylights), mái tóc của bạn sẽ có chiều sâu đa chiều cực kỳ quyến rũ.</p>\n<h3>Ưu Điểm Vượt Trội Của Kỹ Thuật Nhuộm Balayage</h3>\n<p>Khác với nhuộm toàn phần, Balayage giữ lại tone màu gốc tự nhiên ở chân tóc và sáng dần về phía đuôi. Do đó, khi tóc mới mọc dài ra, phần chân đen hòa quyện tự nhiên vào tổng thể mà không tạo ngấn ranh giới thô kệch.</p>\n<p>Bạn có thể thoải mái giữ mái tóc đẹp lung linh từ 6 đến 9 tháng chỉ với một lần thực hiện tại Salon Dũng Tokyo.</p>',NULL,'upload/images/hair_6.jpg','Nhuộm Tóc Balayage & Babylights Đẹp Đa Chiều | Salon Dũng Tokyo','nhuom balayage, babylights, nhuom toc dep tokyo, salon dung tokyo','Kỹ thuật nhuộm tóc Balayage nghệ thuật tại Salon Dũng Tokyo. Giữ màu đẹp tự nhiên suốt 6-9 tháng không lo lộ chân tóc đen.','post',6,1,'2026-08-29 23:23:10','2026-08-29 23:23:10',1);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role` (
  `permission_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,9),(1,11),(2,9),(2,11),(3,9),(3,11),(4,9),(4,11),(5,9),(5,11),(6,9),(6,11),(7,9),(7,11),(8,9),(8,11);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `resource` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `http_uri` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'role-create','Create Role','Create New Role','role-create','role','create','ANY::admin/role/create,POST::admin/role','2026-08-28 10:44:35','2026-08-28 10:44:35'),(2,'role-list','Display Role Listing','List All Roles','role-list','role','list','GET::admin/role','2026-08-28 10:44:35','2026-08-28 10:44:35'),(3,'role-update','Update Role','Update Role Information','role-update','role','update','GET::admin/role/*/edit,PUT::admin/role/*','2026-08-28 10:44:35','2026-08-28 10:44:35'),(4,'role-delete','Delete Role','Delete Role','role-delete','role','delete','DELETE::admin/role/*','2026-08-28 10:44:35','2026-08-28 10:44:35'),(5,'user-create','Create User','Create New User','user-create','user','create','ANY::admin/user/create,POST::admin/user','2026-08-28 10:44:35','2026-08-28 10:44:35'),(6,'user-list','Display User Listing','List All Users','user-list','user','list','GET::admin/user','2026-08-28 10:44:35','2026-08-28 10:44:35'),(7,'user-update','Update User','Update User Information','user-update','user','update','GET::admin/user/*/edit,PUT::admin/user/*','2026-08-28 10:44:35','2026-08-28 10:44:35'),(8,'user-delete','Delete User','Delete User','user-delete','user','delete','DELETE::admin/user/*','2026-08-28 10:44:35','2026-08-28 10:44:35');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_categories`
--

DROP TABLE IF EXISTS `post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_categories` (
  `post_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`post_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_categories`
--

LOCK TABLES `post_categories` WRITE;
/*!40000 ALTER TABLE `post_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL DEFAULT '0',
  `permission_id` bigint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `admin_role_permission_role_id_permission_id_index` (`role_id`,`permission_id`),
  KEY `role_permisstion_permisstion_id_foreign` (`permission_id`),
  CONSTRAINT `role_permisstions_permisstion_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  CONSTRAINT `role_permisstions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permissions`
--

LOCK TABLES `role_permissions` WRITE;
/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
INSERT INTO `role_permissions` VALUES (9,9,1),(10,9,2),(11,9,3),(12,9,4),(13,9,5),(14,9,6),(15,9,7),(16,9,8),(17,11,1),(18,11,2),(19,11,3),(20,11,4),(21,11,5),(22,11,6),(23,11,7),(24,11,8);
/*!40000 ALTER TABLE `role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_user` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,9),(1,11);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_users`
--

DROP TABLE IF EXISTS `role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `admin_role_user_role_id_user_id_index` (`role_id`,`user_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_users`
--

LOCK TABLES `role_users` WRITE;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
INSERT INTO `role_users` VALUES (11,9,1),(12,11,1);
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (9,'admin','Admin','admin','Quản Trị','Full Permission','2026-08-28 10:44:35','2026-08-28 10:44:35'),(10,'user','Member','user','Thành Viên','Thành Viên','2026-08-28 10:44:35','2026-08-28 10:44:35'),(11,'Administrator','Super Administrator','administrator','Toàn Quyền Hệ Thống','System Administrator with full access','2026-08-28 10:44:35','2026-08-28 10:44:35');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(1000) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `name_en` varchar(1000) DEFAULT NULL,
  `description` longtext,
  `description_en` longtext,
  `content` longtext,
  `content_en` longtext,
  `icon` longtext,
  `image` text,
  `cover` text,
  `gallery` longtext,
  `status` tinyint(1) DEFAULT '0',
  `sort` int DEFAULT '0',
  `seo_title` longtext,
  `seo_keyword` longtext,
  `seo_description` longtext,
  `gallery_checked` int DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `admin_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (12,'set-up','SET - UP','SET - UP','<ul>\r\n	<li>\r\n	<p>CONSULTING-ADVISORY</p>\r\n	</li>\r\n	<li>\r\n	<p>SET-UP</p>\r\n	</li>\r\n	<li>\r\n	<p>OPERATION</p>\r\n	</li>\r\n</ul>','<ul>\r\n	<li>\r\n	<p>CONSULTING-ADVISORY</p>\r\n	</li>\r\n	<li>\r\n	<p>SET-UP</p>\r\n	</li>\r\n	<li>\r\n	<p>OPERATION</p>\r\n	</li>\r\n</ul>','<p><strong>1.CONSULTING - ADVISORY</strong><br />\r\n. Listening to the customer&#39;s needs.<br />\r\n. Highlighting points for customers in terms to vision the right business model.<br />\r\n. Consult with Concept - brand space and product experience.<br />\r\n. As for customers which is &#39;lost&#39;, we also provide a consulting service Ilwhich create business ideas<br />\r\ncompatible with &#39;pocket&#39;.</p>\r\n\r\n<p><strong>2. SET - UP</strong><br />\r\nHandle all associated matters on behalf of the investment.<br />\r\n. Design - Constructing - Sound, Lighting - Interior - Menu - Personnel Determination - Financial.<br />\r\n. Be the one in charge of collaborating with pertinent parties to finish the business model.<br />\r\n. Deliver the final product to the Investor under monitoring as soon as possible.</p>\r\n\r\n<p><strong>3. OPERATION</strong><br />\r\nEstablish models, and business structures for investors in the F&amp;B and Nightlife sector<br />\r\n&middot; Management<br />\r\n&middot; Business strategy<br />\r\n=&gt; SevenT will negotiate revenue guarantees based on the model.</p>','<p><strong>1.CONSULTING - ADVISORY</strong><br />\r\n. Listening to the customer&#39;s needs.<br />\r\n. Highlighting points for customers in terms to vision the right business model.<br />\r\n. Consult with Concept - brand space and product experience.<br />\r\n. As for customers which is &#39;lost&#39;, we also provide a consulting service Ilwhich create business ideas<br />\r\ncompatible with &#39;pocket&#39;.</p>\r\n\r\n<p><strong>2. SET - UP</strong><br />\r\nHandle all associated matters on behalf of the investment.<br />\r\n. Design - Constructing - Sound, Lighting - Interior - Menu - Personnel Determination - Financial.<br />\r\n. Be the one in charge of collaborating with pertinent parties to finish the business model.<br />\r\n. Deliver the final product to the Investor under monitoring as soon as possible.</p>\r\n\r\n<p><strong>3. OPERATION</strong><br />\r\nEstablish models, and business structures for investors in the F&amp;B and Nightlife sector<br />\r\n&middot; Management<br />\r\n&middot; Business strategy<br />\r\n=&gt; SevenT will negotiate revenue guarantees based on the model.</p>','fa-light fa-gear','/upload/images/service/set%20up.png',NULL,NULL,1,4,NULL,NULL,NULL,0,'2024-08-04 15:50:06','2024-09-30 00:41:46',1),(13,'marketing','MARKETING','MARKETING','<ul>\r\n	<li>\r\n	<p>LOGO &amp; BRAND IDENTITY</p>\r\n	</li>\r\n	<li>\r\n	<p>PACKAGING SYSTEM</p>\r\n	</li>\r\n	<li>\r\n	<p>DESIGN</p>\r\n	</li>\r\n	<li>\r\n	<p>MARKETING STRATEGY</p>\r\n	</li>\r\n</ul>','<ul>\r\n	<li>\r\n	<p>LOGO &amp; BRAND IDENTITY</p>\r\n	</li>\r\n	<li>\r\n	<p>PACKAGING SYSTEM</p>\r\n	</li>\r\n	<li>\r\n	<p>DESIGN</p>\r\n	</li>\r\n	<li>\r\n	<p>MARKETING STRATEGY</p>\r\n	</li>\r\n</ul>','<p><strong>1. LOGO &amp; BRAND IDENTITY</strong><br />\r\n. Elevate Ithe company&#39;s &quot;persona&quot; to the next level.<br />\r\n. From creating a system for identifying a brand to generating a set of guidelines for brand developmer</p>\r\n\r\n<p><strong>2. PACKAGING SYSTEM</strong><br />\r\n&middot; Creative packaging solutions to ensure preservation and enhance user experience<br />\r\n. Cost-effective in terms of production, transportation<br />\r\n&middot; Attracting attention with the display organizings</p>\r\n\r\n<p><strong>3. DESIGN</strong><br />\r\nTo us, design of a brand&#39;s image is a technicolor language system.<br />\r\n. Poster event, promotion - 2D, 3D<br />\r\n. Animation<br />\r\n. Art Visual</p>\r\n\r\n<p><strong>4. MARKETING STRATEGY</strong><br />\r\n. Offering advice, tactics, and solutions to help companies develop and expand their brands.<br />\r\n. Optimizing performance and metrics across social media platforms.</p>','<p><strong>1. LOGO &amp; BRAND IDENTITY</strong><br />\r\n. Elevate Ithe company&#39;s &quot;persona&quot; to the next level.<br />\r\n. From creating a system for identifying a brand to generating a set of guidelines for brand developmer</p>\r\n\r\n<p><strong>2. PACKAGING SYSTEM</strong><br />\r\n&middot; Creative packaging solutions to ensure preservation and enhance user experience<br />\r\n. Cost-effective in terms of production, transportation<br />\r\n&middot; Attracting attention with the display organizings</p>\r\n\r\n<p><strong>3. DESIGN</strong><br />\r\nTo us, design of a brand&#39;s image is a technicolor language system.<br />\r\n. Poster event, promotion - 2D, 3D<br />\r\n. Animation<br />\r\n. Art Visual</p>\r\n\r\n<p><strong>4. MARKETING STRATEGY</strong><br />\r\n. Offering advice, tactics, and solutions to help companies develop and expand their brands.<br />\r\n. Optimizing performance and metrics across social media platforms.</p>','fa-light fa-megaphone','/upload/images/service/matketing.png',NULL,NULL,1,2,NULL,NULL,NULL,0,'2024-08-04 16:53:40','2024-09-30 00:42:38',1),(14,'event','EVENT','EVENT',NULL,NULL,NULL,NULL,'fa-light fa-calendar-pen','/upload/images/service/event.png',NULL,NULL,1,3,NULL,NULL,NULL,0,'2024-08-04 16:53:43','2024-09-22 19:33:51',1);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('oJrfFN0bBfefiyP5sCED7NJfQG0pfHYF5OOSVzsU',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiODhzMDNwZ29Wb01LZldObVVYVUFWZktzaDhLb2pTVjBKcU5heDEyQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbmd1eWVuaHV5bmhkYW5na2hvYS5jb20udGVzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1727078352);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(2000) DEFAULT NULL,
  `content` mediumtext,
  `type` varchar(50) DEFAULT NULL,
  `status` int DEFAULT '0',
  `sort` int DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'facebook','https://www.facebook.com/hairsalondungtokyo','line',0,8,NULL,NULL),(2,'admin-title','Salon Dung Tokyo','line',0,0,NULL,NULL),(3,'hotline','090 869 16 96','line',0,14,NULL,NULL),(5,'smtp-host','smtp.gmail.com','line',0,1,NULL,NULL),(6,'smtp-port','587','line',0,2,NULL,NULL),(7,'smtp-username','godknight53@gmail.com','line',0,3,NULL,NULL),(8,'smtp-password','feuvelefvtpfzctm','line',0,4,NULL,NULL),(9,'smtp-encryption','tls','line',0,5,NULL,NULL),(10,'smtp-from-address','dungocean82@gmail.com','line',0,6,NULL,NULL),(11,'currency','VNĐ','line',0,24,NULL,NULL),(26,'country_code','VI','line',0,15,NULL,NULL),(29,'sender','dungocean82@gmail.com','line',0,7,NULL,NULL),(31,'email_admin','dungocean82@gmail.com','line',0,13,NULL,NULL),(34,'phone','090 869 16 96','line',0,16,NULL,NULL),(35,'email','dungocean82@gmail.com','line',0,17,NULL,NULL),(51,'youtube','','line',0,11,NULL,NULL),(108,'webtitle','Salon Dung Tokyo','line',0,25,NULL,NULL),(109,'twitter','','line',0,12,NULL,NULL),(128,'google_analytics','','text',0,44,NULL,NULL),(131,'email_test','godknight53@gmail.com','line',0,26,NULL,NULL),(134,'favicon_32','/upload/images/logo.png','img',0,33,NULL,NULL),(135,'favicon_16','/upload/images/logo.png','img',0,32,NULL,NULL),(136,'favicon_96','/upload/images/logo.png','img',0,36,NULL,NULL),(137,'favicon_192','/upload/images/logo.png','img',0,39,NULL,NULL),(138,'favicon_180','/upload/images/logo.png','img',0,38,NULL,NULL),(139,'favicon_48','/upload/images/logo.png','img',0,34,NULL,NULL),(140,'favicon_72','/upload/images/logo.png','img',0,35,NULL,NULL),(141,'favicon_144','/upload/images/logo.png','img',0,37,NULL,NULL),(143,'og:title','Salon Dung Tokyo','line',0,20,NULL,NULL),(144,'og:image','','img',0,31,NULL,NULL),(145,'og:site_name','Salon Dung Tokyo','line',0,21,NULL,NULL),(146,'og:description','','line',0,22,NULL,NULL),(147,'og:type','','line',0,23,NULL,NULL),(148,'copyright','Salon Dung Tokyo','line',0,19,NULL,NULL),(149,'author','Salon Dung Tokyo','line',0,18,NULL,NULL),(150,'design_by','GetAtZ','line',0,27,NULL,NULL),(151,'design_by_link','','line',0,28,NULL,NULL),(154,'instagram','https://www.instagram.com/sevent.agency/','line',0,9,NULL,NULL),(155,'tiktok','','line',0,10,NULL,NULL),(156,'website','https://salondungtokyo.com','line',0,30,NULL,NULL),(162,'banner_slogan','Thời trang &amp; phong cách','text',0,43,NULL,NULL),(163,'banner_img','/upload/images/page/banner_1.jpg','img',0,42,NULL,NULL),(164,'logo','/upload/images/logo.png','img',0,40,NULL,NULL),(165,'logo_footer','/upload/images/logo.png','img',0,41,NULL,NULL),(166,'google_map','','text',0,45,NULL,NULL),(167,'address','46 Đ. Số 8, Phường 11, Gò Vấp, Thành phố Hồ Chí Minh','line',0,29,NULL,NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_password_auto`
--

DROP TABLE IF EXISTS `user_password_auto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_password_auto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(191) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_password_auto`
--

LOCK TABLES `user_password_auto` WRITE;
/*!40000 ALTER TABLE `user_password_auto` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_password_auto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `provider` varchar(100) DEFAULT NULL,
  `provider_id` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `admin_level` int DEFAULT '1',
  `status` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin','$2y$04$Xcia3E.SWyzLJmmoRPoRWO2MZ1qe4Th.P1HHMF3FbDTIx0j1cOHh6',NULL,NULL,'12346456798','admin@local','ăcefawefawef',NULL,NULL,'D7wwYbp7kKtmcQKsKJM0vIAQWzYEYIh7aPMu9YDpac5ITeOVoEkmcHvPQxSy',1,1,'2021-05-12 11:48:34','2026-09-22 11:20:47');
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

-- Dump completed on 2026-10-07 23:19:54
