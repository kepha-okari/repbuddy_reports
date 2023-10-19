-- MySQL dump 10.19  Distrib 10.3.28-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: paysol
-- ------------------------------------------------------
-- Server version	10.3.28-MariaDB

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
-- Table structure for table `account_categories`
--

DROP TABLE IF EXISTS `account_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `account_categories_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_categories`
--

LOCK TABLES `account_categories` WRITE;
/*!40000 ALTER TABLE `account_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `account_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `balance` double DEFAULT NULL,
  `debit` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `inserted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  CONSTRAINT `accounts_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `accounts_ibfk_3` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,-1207,1207,0,'DEPOSITS',11,NULL,'2022-03-15 08:56:28','2022-09-05 13:45:27'),(2,1232,0,1232,'MEMBER',11,2,'2022-03-15 09:00:13','2022-09-05 13:45:27'),(3,532,830,1362,'MOBILE LOANS',11,NULL,'2022-04-07 10:58:20','2022-09-05 13:45:46'),(4,-130,1362,1232,'MEMBER LOAN',11,2,'2022-04-07 11:02:43','2022-09-05 13:45:46'),(7,0,0,0,'MEMBER',11,4,'2022-04-12 11:41:01','2022-04-12 08:41:01'),(8,0,0,0,'MEMBER LOAN',11,4,'2022-04-12 11:41:01','2022-04-12 08:41:01'),(9,0,0,0,'MEMBER',11,5,'2022-04-12 11:46:31','2022-04-12 08:46:31'),(10,0,0,0,'MEMBER LOAN',11,5,'2022-04-12 11:46:31','2022-04-12 08:46:31'),(11,0,0,0,'MEMBER',11,6,'2022-04-12 11:47:12','2022-04-12 08:47:12'),(12,0,0,0,'MEMBER LOAN',11,6,'2022-04-12 11:47:12','2022-04-12 08:47:12'),(13,0,0,0,'MEMBER',11,7,'2022-04-12 11:47:49','2022-04-12 08:47:49'),(14,0,0,0,'MEMBER LOAN',11,7,'2022-04-12 11:47:49','2022-04-12 08:47:49'),(15,0,0,0,'MEMBER',11,8,'2022-04-12 11:48:55','2022-04-12 08:48:55'),(16,0,0,0,'MEMBER LOAN',11,8,'2022-04-12 11:48:56','2022-04-12 08:48:56'),(17,0,0,0,'MEMBER',NULL,9,'2022-04-12 12:01:10','2022-04-12 09:01:10'),(18,0,0,0,'MEMBER LOAN',NULL,9,'2022-04-12 12:01:10','2022-04-12 09:01:10'),(19,0,0,0,'MEMBER',11,10,'2022-04-19 16:04:24','2022-04-19 13:04:24'),(20,0,0,0,'MEMBER LOAN',11,10,'2022-04-19 16:04:24','2022-04-19 13:04:24'),(21,0,0,0,'MEMBER',11,11,'2022-04-19 16:07:45','2022-04-19 13:07:45'),(22,0,0,0,'MEMBER LOAN',11,11,'2022-04-19 16:07:45','2022-04-19 13:07:45'),(23,0,0,0,'MEMBER',11,12,'2022-05-05 10:49:12','2022-05-05 07:49:12'),(24,0,0,0,'MEMBER LOAN',11,12,'2022-05-05 10:49:12','2022-05-05 07:49:12'),(25,0,0,0,'MEMBER',11,13,'2022-05-05 10:50:23','2022-05-05 07:50:23'),(26,0,0,0,'MEMBER LOAN',11,13,'2022-05-05 10:50:23','2022-05-05 07:50:23');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actions`
--

DROP TABLE IF EXISTS `actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `visible` tinyint(4) DEFAULT 1,
  `inserted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actions`
--

LOCK TABLES `actions` WRITE;
/*!40000 ALTER TABLE `actions` DISABLE KEYS */;
INSERT INTO `actions` VALUES (1,'omnipotent',0,'2018-03-21 12:34:03','2018-08-17 14:13:46'),(2,'manage_clients',0,'2018-08-17 18:28:07','2018-09-03 18:59:08'),(3,'manage_users',1,'2018-08-19 10:35:25','2018-08-19 07:35:25'),(4,'manage_actions',0,'2018-09-03 21:57:08','2018-09-03 18:57:08'),(5,'manage_permissions',1,'2018-09-03 21:57:58','2018-09-03 18:57:58'),(6,'manage_user_groups',1,'2018-09-03 21:58:19','2018-09-03 18:58:19'),(7,'manage_groups',1,'2018-09-03 21:58:45','2018-09-03 18:58:45'),(8,'manage_notifications',1,'2018-09-04 18:49:10','2022-01-05 09:44:45'),(9,'view_user_audits',1,'2018-09-06 19:08:50','2018-09-06 16:08:50');
/*!40000 ALTER TABLE `actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authentication`
--

DROP TABLE IF EXISTS `authentication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authentication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(15) NOT NULL,
  `otp` varchar(10) NOT NULL,
  `expired` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authentication`
--

LOCK TABLES `authentication` WRITE;
/*!40000 ALTER TABLE `authentication` DISABLE KEYS */;
INSERT INTO `authentication` VALUES (114,'254707630747','1327',0,'2022-10-18 14:45:08'),(115,'254707250844','5053',1,'2022-04-19 13:03:14');
/*!40000 ALTER TABLE `authentication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `active` tinyint(4) DEFAULT 1,
  `inserted_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (10,'Drinks',1,'2022-08-30 20:28:53'),(11,'Foods',1,'2022-08-30 20:29:17');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_admins`
--

DROP TABLE IF EXISTS `client_admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `msisdn` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `inserted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_admins`
--

LOCK TABLES `client_admins` WRITE;
/*!40000 ALTER TABLE `client_admins` DISABLE KEYS */;
INSERT INTO `client_admins` VALUES (2,'Charles Sewe','254704965665','chaliblues',NULL,'','$2y$13$4xxaPQ8.8Lh4fIDzrJACZeS3YzsmP9wLp0FS/QVAmMU89MLktHmNG','$2y$13$bZMBVNnkz.z5Jstr.F98AePRazXo69VH5xz60gpqk8ugqBdESQIUi','olivetest@gmail.com',1,1,2,NULL,'2018-07-21 00:00:00','2022-03-15 04:19:06'),(14,'Wambani C Sewe','254704965665',NULL,NULL,NULL,'$2y$13$JJhaj4GULBzLhEpo6OYGP.zR0H63rApaUki9nuts9HxiXgOWLmdiq',NULL,'wambani@live.com',7,1,NULL,2,'2018-09-03 21:45:17','2018-09-06 19:06:55'),(18,'kephaaaa','254707630747','Bulldozer','634fa7953358f.jpeg','123x73','$2y$13$SKN6lfmN2lYtPYCpVPBgceAc341mSzLD6aBbqZ/PWcmmzFAHQ37ny',NULL,'kepha.okari@olivetreemobile.co',11,1,NULL,18,'2021-12-20 19:44:27','2022-10-19 07:30:29'),(19,'brayo & kevo','0707630747',NULL,NULL,NULL,'$2y$13$SKN6lfmN2lYtPYCpVPBgceAc341mSzLD6aBbqZ/PWcmmzFAHQ37ny',NULL,'brayo@gmail.com',11,2,18,18,'2022-02-10 17:19:51','2022-02-10 14:19:52'),(20,'Wachira','254707250844','',NULL,'','$2y$13$SKN6lfmN2lYtPYCpVPBgceAc341mSzLD6aBbqZ/PWcmmzFAHQ37ny','','brian.wachira@olivetreemobile.co',11,1,18,18,'2022-02-14 13:05:24','2022-04-12 08:37:34'),(22,'James Kabiru','254721881969','James',NULL,'','$2y$13$Be3EU.MKVFqlALmyvzHneeQ3DWbpfpah9VmhGUJFVPm5LFmvqzipq','$2y$13$jtFVSN80AvY7wBCnUZN.x.Sob1OCVNoxyQqGsOnb79FLHDGrAcFyS','kabiru@olivetreemobile.co',11,1,18,18,'2022-04-25 10:45:53','2022-04-25 07:49:47'),(23,'Ragira','254719318686','Ragira',NULL,'','$2y$13$VZM72Su6nKdX.lObwrnjuOyHgbsozxoy9oJb7D97VCwTUmjFsR/W.','$2y$13$YbxFUIt7LVnV8z0lfTqXQOO4iY1m1InMh7s53NjaMj0rK5nbo2Iom','webb@olivetreemobilehub.co',NULL,1,18,18,'2022-08-30 11:06:17','2022-08-30 08:06:17'),(28,'kepha Ok','254719318686','The Key','63445d4fb4b02.jpg',NULL,NULL,NULL,'kephaokari@gmail.com',NULL,1,NULL,NULL,NULL,'2022-10-10 17:58:39'),(32,'kepha Ok','2547193186864','The Keey','634c4f9726eda.jpg',NULL,NULL,NULL,'kephaokari@gmail.comw',11,1,NULL,NULL,NULL,'2022-10-16 18:38:15');
/*!40000 ALTER TABLE `client_admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `location` varchar(15) DEFAULT 'Westlands',
  `api_key` varchar(255) DEFAULT NULL,
  `api_secret` varchar(255) DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `inserted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_name` (`name`),
  KEY `idx_email` (`email`),
  KEY `idx_phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Riverside Pub','634fa79b47dc8.jpg','olivetest@gmail.com','','814 Westlands Rd, Nairobi, KENYA','Westlands','FSRqBCKmVspHw3r','4d3rGtcQ5GdjqSMkfNyJUCzh2Hpbe6A3','Q1M2WlQ0cUc3RnQwQndBbXdrV1NLaThybkp6TVlNblhXTnh3NlhaS1phU1lYTzZWb0doTkFOR0JHUUozR0xXSw==',1,'2022-10-06 15:00:18','2022-10-19 07:30:35'),(7,'Skylux Bar & Lounge',NULL,'olivetest2@gmail.com','254704965665','14 Westlands Rd, Nairobi, KENYA','Westlands','2uAq7cDbmF32Qpc','g30eIX1Tk8r5RhDmwOJjlTF5PKEkvWhJ','WmdvS0piWXV2dWlKdzkyUUFLVGMxVjdqalhic1NZYmFWZlU3UmJuNjAwdzV2WkVSUG5QMVNpTGtYZTFhRHdYeA==',1,'2018-09-03 21:45:17','2022-10-10 12:00:18'),(8,'Club Volume',NULL,'kephaokari@gmail.com','254707630747','14 Westlands Rd, Nairobi, KENYA','Westlands','VsudfL2HbNuU833','hNsNhEHmIpbBjJY1bwDacdQtIYKR27pi','YmloanR6UURHOGVFOVR1TnRsamIwaGRzZWhyWHF4YmVJUmU2TVpMZWlUdzJYSU9iMElwbDlqVVNpeVE1SFlmNg==',1,'2021-02-09 10:37:45','2022-10-10 12:00:18'),(9,'Mzuqa Bar & Restaurant',NULL,'kepha@gmail.com','254707630747','14 Westlands Rd, Nairobi, KENYA','Westlands','znSe0MPYLPmOrz3','UScI3JcOurvF4Rsy2Ah6yc4m7zE207al','Q2hmVkxNNVViTERmODRmQ3FGMU5UTndiN2ZCbWZsV1FNa0ZEWExQTzluZTM1aU5hVDJ0MmdrUWRzQnAyYU5kYw==',1,'2021-02-24 13:32:38','2022-10-10 12:00:18'),(10,'Riverside Pub',NULL,'kr@gmail.com','254707630747','14 Westlands Rd, Nairobi, KENYA','Westlands','v4Yo9eCPFxsEkTZ','YR6Zb4Sf1xpHIzWslMmoe5Ie5J95nE3p','bHpveG50WGQ3QXB4RmtGQ1BtVWpWMnQ5ajhIREZXT2dyNWdjWjM2bUxQdzF6Q0w1TkVEd2lVa1BLSmlWWFQ4Nw==',1,'2021-03-09 14:34:55','2022-10-10 12:00:18'),(11,'Mountain View Lounge','63462b7c80e1a.jpg','kepha.okari@olivetreemobile.co','254707630747','814 Westlands Rd, Nairobi, KENYA','Westlands','bchXbC9ElNkkQxc','Np4JPmwfmxQVLwc5NLxYuaZnT13J8KGf','anFRR3NWYTZhc3loZE13dnJxZlF5V2xIRVlRS2I1TlJxaUJpWW1HQmNFZEg0WGdhcUJlellKTG1Sd0pGdEkwUw==',1,'2021-12-20 19:44:26','2022-10-12 02:50:36'),(12,'Kaloqo Cafe',NULL,'mongoose@gmail.com','254719318686','14 Westlands Rd, Nairobi, KENYA','Westlands','J9ZBkvoA8JL6mov','1H6DeDH9CjsiA4nO5zE4yftrLFtU4TcQ','eThzWnBuSHV3NVhMbFE3ejhiNzhKd1ZCTlFlWHZnQjBOZEVuYjlJbzViRlNZOFBYOVZRaHE0M1A0cURaV0ZsTg==',1,'2022-03-08 15:14:24','2022-10-10 12:00:18');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `inserted_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `groups_fk0` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'GODS',1,2,2,'2018-03-21 12:33:10','2018-08-17 15:29:05'),(2,'ADMINS',1,2,2,'2018-08-17 18:30:28','2018-08-17 15:30:28');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incoming_payment_logs`
--

DROP TABLE IF EXISTS `incoming_payment_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `incoming_payment_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msisdn` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `merchant_request_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checkout_request_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `response_code` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `response_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_message` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `result_code` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `result_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mpesa_receipt` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `status` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'PENDING',
  `inserted_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `incoming_payment_logs_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incoming_payment_logs`
--

LOCK TABLES `incoming_payment_logs` WRITE;
/*!40000 ALTER TABLE `incoming_payment_logs` DISABLE KEYS */;
INSERT INTO `incoming_payment_logs` VALUES (21,'254707630747',NULL,'79306-52596481-1','ws_CO_310320221127460729','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1','QCU1J35A9P','20220330170237',11,'CLOSED','2022-03-31 11:31:41','2022-03-31 08:33:20'),(22,'254707630747',NULL,'9703-52333837-1','ws_CO_310320221131245302','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1','QCV5KFBRJX','20220331113529',11,'CLOSED','2022-03-31 11:35:20','2022-03-31 08:35:31'),(23,'254707630747',NULL,'31018-154129276-1','ws_CO_310320221131328088','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1','QCV7KFEBJX','20220331113638',11,'CLOSED','2022-03-31 11:36:21','2022-03-31 08:36:40'),(24,'254707630747',NULL,'43064-128289206-1','ws_CO_310320221134594823','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'50','QCU1J35A9P','20220330170237',11,'CLOSED','2023-04-29 11:39:48','2023-05-03 03:32:53'),(25,'254707630747',NULL,'122947-41037063-1','ws_CO_05092022112234056707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,11,'PENDING','2022-09-05 11:24:29','2022-09-05 08:24:29'),(26,'254707630747',NULL,'3144-33834273-1','ws_CO_05092022120908503707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,11,'PENDING','2022-09-05 12:10:13','2022-09-05 09:10:13'),(27,'254707630747',NULL,'7368-3628266-1','ws_CO_05092022124451885707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,11,'PENDING','2022-09-05 12:46:47','2022-09-05 09:46:47'),(28,'254707630747',NULL,'3136-33955230-1','ws_CO_05092022125850792707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,11,'PENDING','2022-09-05 12:59:56','2022-09-05 09:59:56'),(29,'254707630747',NULL,'6218-41314749-1','ws_CO_05092022130340045707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,11,'PENDING','2022-09-05 13:04:45','2022-09-05 10:04:45'),(30,'254707630747',NULL,'6218-41317568-1','ws_CO_05092022130404756707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,11,'PENDING','2022-09-05 13:06:00','2022-09-05 10:06:00'),(31,'254707630747',NULL,'117446-4106798-1','ws_CO_05092022155929326707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,11,'PENDING','2022-09-05 16:01:25','2022-09-05 13:01:25'),(32,'254707630747',31,'127580-13197230-1','ws_CO_08092022151733900707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,11,'PENDING','2022-09-08 15:18:42','2022-09-08 12:18:42'),(34,'254707630747',NULL,'22502-25292587-1','ws_CO_01052023122855579707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,NULL,'PENDING','2023-05-01 12:28:22','2023-05-01 09:28:22'),(35,'254707630747',NULL,'2591-24331251-1','ws_CO_01052023122940082707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,1,'PENDING','2023-05-01 12:29:27','2023-05-01 09:29:27'),(36,'254707630747',NULL,'39307-150408285-2','ws_CO_01052023123446587707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,1,'PENDING','2023-05-01 12:34:13','2023-05-01 09:34:13'),(37,'254707630747',NULL,'24331-23139399-4','ws_CO_01052023135852042707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,1,'PENDING','2023-05-01 13:58:19','2023-05-01 10:58:19'),(38,'254707630747',NULL,'25494-25839331-5','ws_CO_01052023141757560707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,1,'PENDING','2023-05-01 14:17:44','2023-05-01 11:17:44'),(39,'254707630747',NULL,'2575-24732497-1','ws_CO_01052023142504481707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,1,'PENDING','2023-05-01 14:24:51','2023-05-01 11:24:51'),(40,'254707630747',NULL,'39318-150978499-5','ws_CO_01052023151652272707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,1,'PENDING','2023-05-01 15:16:19','2023-05-01 12:16:19'),(41,'254707630747',NULL,'39327-150982547-1','ws_CO_01052023151644367707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,1,'PENDING','2023-05-01 15:16:31','2023-05-01 12:16:31'),(42,'254707630747',NULL,'24342-23470389-1','ws_CO_01052023152952926707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,1,'PENDING','2023-05-01 15:29:20','2023-05-01 12:29:20'),(43,'254707630747',NULL,'2579-31279240-1','ws_CO_03052023055815861707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,1,'PENDING','2023-05-03 05:58:02','2023-05-03 02:58:02'),(44,'254707630747',NULL,'120934-32103574-1','ws_CO_03052023060815082707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,1,'PENDING','2023-05-03 06:08:01','2023-05-03 03:08:01'),(45,'254719318686',NULL,'39323-158190993-1','ws_CO_03052023110433167719318686','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-03 08:03:58','2023-05-03 08:03:58'),(46,'254707630747',NULL,'39316-158244243-2','ws_CO_03052023112013116707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-03 08:19:38','2023-05-03 08:19:38'),(47,'254707630747',NULL,'7430-158251216-1','ws_CO_03052023114923029707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-03 08:49:09','2023-05-03 08:49:09'),(48,'254719318686',NULL,'24344-30901322-1','ws_CO_03052023115042143719318686','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'30',NULL,NULL,1,'PENDING','2023-05-03 08:50:10','2023-05-03 08:50:10'),(49,'254728314988',NULL,'25492-33659906-2','ws_CO_03052023120009989728314988','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'35',NULL,NULL,1,'PENDING','2023-05-03 08:59:35','2023-05-03 08:59:35'),(50,'254741549377',NULL,'2580-32413884-1','ws_CO_03052023125021640741549377','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-03 09:49:47','2023-05-03 09:49:47'),(51,'254710765230',NULL,'7432-162523601-1','ws_CO_04052023131439418710765230','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-04 10:14:25','2023-05-04 10:14:25'),(52,'254728314988',NULL,'24339-37194838-1','ws_CO_04052023205638611728314988','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-04 17:56:24','2023-05-04 17:56:24'),(53,'254703443524',NULL,'10691-53865756-2','ws_CO_05052023113957330703443524','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-05 08:39:42','2023-05-05 08:39:42'),(54,'254703443524',NULL,'70231-56331897-1','ws_CO_05052023114039079703443524','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-05 08:40:24','2023-05-05 08:40:24'),(55,'254717463469',NULL,'84255-5273252-1','ws_CO_06052023072342829717463469','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-06 04:23:05','2023-05-06 04:23:05'),(56,'254710641803',NULL,'84258-12831207-2','ws_CO_08052023005152265710641803','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-07 21:51:13','2023-05-07 21:51:13'),(57,'254712504497',NULL,'10692-66947500-1','ws_CO_08052023171344486712504497','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-08 14:13:05','2023-05-08 14:13:05'),(58,'254712504497',NULL,'2596-53195417-1','ws_CO_08052023171358048712504497','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-08 14:13:42','2023-05-08 14:13:42'),(59,'254740712201',NULL,'19182-53978888-1','ws_CO_08052023203930883740712201','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-08 17:38:51','2023-05-08 17:38:51'),(60,'254740712201',NULL,'2586-54134338-1','ws_CO_08052023204025344740712201','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-08 17:40:09','2023-05-08 17:40:09'),(61,'254712504497',NULL,'97072-867144-1','ws_CO_09052023111637674712504497','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-09 08:16:21','2023-05-09 08:16:21'),(62,'254742294539',NULL,'29014-2345210-1','ws_CO_09052023182644821742294539','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-09 15:26:28','2023-05-09 15:26:28'),(63,'254742294539',NULL,'10694-71241889-1','ws_CO_09052023182810975742294539','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-09 15:27:30','2023-05-09 15:27:30'),(64,'254742294539',NULL,'72355-2377750-1','ws_CO_09052023182848784742294539','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-09 15:28:32','2023-05-09 15:28:32'),(65,'254742294539',NULL,'70248-73897880-1','ws_CO_09052023183026221742294539','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-09 15:30:10','2023-05-09 15:30:10'),(66,'254742294539',NULL,'39326-183934085-1','ws_CO_09052023183317935742294539','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-09 15:32:39','2023-05-09 15:32:39'),(67,'254742294539',NULL,'25641-2372941-1','ws_CO_09052023183344395742294539','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-09 15:33:28','2023-05-09 15:33:28'),(68,'254727058111',NULL,'2577-57891225-1','ws_CO_09052023195735421727058111','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-09 16:56:55','2023-05-09 16:56:55'),(69,'254742294539',NULL,'7251-79383808-1','ws_CO_09052023204932233742294539','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-09 17:49:18','2023-05-09 17:49:18'),(70,'254707630747',NULL,'16462-3941572-1','ws_CO_10052023064521535707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-10 03:44:40','2023-05-10 03:44:40'),(71,'254742294539',NULL,'72345-4325681-1','ws_CO_10052023090246719742294539','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-10 06:02:06','2023-05-10 06:02:06'),(72,'254707630747',NULL,'72355-4464758-2','ws_CO_10052023094855156707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-10 06:48:38','2023-05-10 06:48:38'),(73,'254707630747',NULL,'29032-4314626-1','ws_CO_10052023095403378707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-10 06:54:03','2023-05-10 06:54:03'),(74,'254719318686',NULL,'55840-4328389-1','ws_CO_10052023095911289719318686','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-10 06:59:11','2023-05-10 06:59:11'),(75,'254719318686',NULL,'120596-181597708-1','ws_CO_10052023095935746719318686','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-10 06:59:36','2023-05-10 06:59:36'),(76,'254719318686',NULL,'30572-181630136-1','ws_CO_10052023100406744719318686','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-10 07:04:07','2023-05-10 07:04:07'),(77,'254707630747',NULL,'39316-186056908-1','ws_CO_10052023102407320707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-10 07:24:07','2023-05-10 07:24:07'),(78,'254707630747',NULL,'97069-4782685-1','ws_CO_10052023112754317707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-10 08:27:55','2023-05-10 08:27:55'),(79,'254719318686',NULL,'108115-4144551-1','ws_CO_10052023112918254719318686','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,'1',NULL,NULL,1,'PENDING','2023-05-10 08:29:18','2023-05-10 08:29:18'),(80,'254707630747',NULL,'25624-5392989-1','ws_CO_10052023145308158707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,1,'PENDING','2023-05-10 11:53:08','2023-05-10 11:53:08'),(81,'254707630747',NULL,'70246-76923097-1','ws_CO_10052023145501279707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,1,'PENDING','2023-05-10 11:55:01','2023-05-10 11:55:01'),(82,'254707630747',NULL,'108126-4869394-1','ws_CO_10052023151035803707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,1,'PENDING','2023-05-10 12:10:36','2023-05-10 12:10:36'),(83,'254707630747',NULL,'77199-5336416-1','ws_CO_10052023151044897707630747','0','Success. Request accepted for processing','Success. Request accepted for processing',NULL,NULL,NULL,NULL,NULL,1,'PENDING','2023-05-10 12:10:45','2023-05-10 12:10:45');
/*!40000 ALTER TABLE `incoming_payment_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ledgers`
--

DROP TABLE IF EXISTS `ledgers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ledgers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `debit` double DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `member_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `ledgers_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  CONSTRAINT `ledgers_ibfk_3` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ledgers`
--

LOCK TABLES `ledgers` WRITE;
/*!40000 ALTER TABLE `ledgers` DISABLE KEYS */;
INSERT INTO `ledgers` VALUES (4,'wHOpEXNUk',200,200,0,200,'2022-03-15 06:10:12',NULL,2),(5,'wHOpEXNUk',200,0,200,-200,'2022-03-15 06:10:12',2,1),(6,'CxrL7JMR1',200,400,0,400,'2022-03-15 06:10:24',NULL,2),(7,'CxrL7JMR1',200,0,400,-400,'2022-03-15 06:10:24',2,1),(8,'RaCI7s9LM',150,550,0,550,'2022-03-15 06:10:59',NULL,2),(9,'RaCI7s9LM',150,0,550,-550,'2022-03-15 06:10:59',2,1),(10,'2bAknDXbd',50,600,0,600,'2022-03-15 06:11:12',NULL,2),(11,'2bAknDXbd',50,0,600,-600,'2022-03-15 06:11:12',2,1),(12,'2fUJmhiLC',25,625,0,625,'2022-03-17 09:29:12',NULL,2),(13,'2fUJmhiLC',25,0,625,-625,'2022-03-17 09:29:12',2,1),(14,'Eo9sZve8K',500,500,0,500,'2022-04-07 08:39:36',2,4),(15,'Eo9sZve8K',500,0,500,-500,'2022-04-07 08:39:36',2,3),(16,'ybRUQY82a',500,1000,0,1000,'2022-04-07 08:55:58',2,4),(17,'ybRUQY82a',500,0,1000,-1000,'2022-04-07 08:55:58',2,3),(20,'JYUJH0WnO',500,500,0,500,'2022-04-07 08:59:10',2,4),(21,'JYUJH0WnO',500,0,500,-500,'2022-04-07 08:59:10',2,3),(22,'cVSqO3Cca',200,700,0,700,'2022-04-07 10:13:53',2,4),(23,'cVSqO3Cca',200,0,700,-700,'2022-04-07 10:13:53',2,3),(42,'j1LG0KAIr',20,0,20,680,'2022-04-08 04:30:34',2,4),(43,'j1LG0KAIr',20,20,0,-680,'2022-04-08 04:30:34',2,3),(44,'enZrzablk',20,0,40,660,'2022-04-08 04:30:53',2,4),(45,'enZrzablk',20,40,0,-660,'2022-04-08 04:30:53',2,3),(46,'dQul5Vqhi',20,0,60,640,'2022-04-08 04:31:12',2,4),(47,'dQul5Vqhi',20,60,0,-640,'2022-04-08 04:31:12',2,3),(48,'qM2YlgnED',20,0,80,620,'2022-04-08 04:31:13',2,4),(49,'qM2YlgnED',20,80,0,-620,'2022-04-08 04:31:13',2,3),(50,'MS1Ae7sUP',20,0,100,600,'2022-04-08 04:31:38',2,4),(51,'MS1Ae7sUP',20,100,0,-600,'2022-04-08 04:31:38',2,3),(52,'TBAfWAemy',20,0,120,580,'2022-04-08 04:50:03',2,4),(53,'TBAfWAemy',20,120,0,-580,'2022-04-08 04:50:03',2,3),(54,'FxnyHdXTQ',20,0,140,560,'2022-04-08 04:50:24',2,4),(55,'FxnyHdXTQ',20,140,0,-560,'2022-04-08 04:50:24',2,3),(56,'Yz2Y16ykl',20,0,160,540,'2022-04-08 07:02:38',2,4),(57,'Yz2Y16ykl',20,160,0,-540,'2022-04-08 07:02:38',2,3),(58,'4uYo5ydcG',25,650,0,650,'2022-04-08 09:01:34',NULL,2),(59,'4uYo5ydcG',25,0,650,-650,'2022-04-08 09:01:34',2,1),(60,'1p1XM0A5h',1,0,161,489,'2022-04-08 09:23:27',2,4),(61,'1p1XM0A5h',1,161,0,-539,'2022-04-08 09:23:27',2,3),(62,'ddD4lurcL',1,0,162,488,'2022-04-08 09:24:14',2,4),(63,'ddD4lurcL',1,162,0,-538,'2022-04-08 09:24:14',2,3),(66,'C7KufchPr',50,0,212,438,'2022-04-08 09:28:49',2,4),(67,'C7KufchPr',50,212,0,-488,'2022-04-08 09:28:49',2,3),(68,'3WIdrIb2F',12,662,0,662,'2022-04-08 09:28:49',NULL,2),(69,'3WIdrIb2F',12,0,637,-637,'2022-04-08 09:28:49',2,1),(70,'nggsgXWqh',50,0,262,400,'2022-04-11 02:28:21',2,4),(71,'nggsgXWqh',50,262,0,-438,'2022-04-11 02:28:21',2,3),(72,'YBUsvTRyD',50,712,0,712,'2022-04-11 02:28:21',NULL,2),(73,'YBUsvTRyD',50,0,687,-687,'2022-04-11 02:28:21',2,1),(74,'kflcMnyd8',50,0,312,400,'2022-04-11 02:29:45',2,4),(75,'kflcMnyd8',50,312,0,-388,'2022-04-11 02:29:45',2,3),(76,'6g6wXZdnO',50,762,0,762,'2022-04-11 02:29:45',NULL,2),(77,'6g6wXZdnO',50,0,737,-737,'2022-04-11 02:29:45',2,1),(78,'BlMajPaji',50,0,362,400,'2022-04-11 02:30:45',2,4),(79,'BlMajPaji',50,362,0,-338,'2022-04-11 02:30:45',2,3),(80,'flDfj7LGF',50,812,0,812,'2022-04-11 02:30:45',NULL,2),(81,'flDfj7LGF',50,0,787,-787,'2022-04-11 02:30:45',2,1),(82,'wDbX3N5Md',50,0,412,400,'2022-04-11 02:32:04',2,4),(83,'wDbX3N5Md',50,412,0,-288,'2022-04-11 02:32:04',2,3),(84,'nBTfu3zqJ',50,862,0,862,'2022-04-11 02:32:04',NULL,2),(85,'nBTfu3zqJ',50,0,837,-837,'2022-04-11 02:32:04',2,1),(86,'cDQY1Iuuf',50,0,462,400,'2022-04-11 02:32:48',2,4),(87,'cDQY1Iuuf',50,462,0,-238,'2022-04-11 02:32:48',2,3),(88,'6tjw7ZoZO',50,0,512,350,'2022-04-11 02:33:30',2,4),(89,'6tjw7ZoZO',50,512,0,-188,'2022-04-11 02:33:30',2,3),(90,'KbiVU7TQc',100,962,0,962,'2022-04-11 02:33:30',NULL,2),(91,'KbiVU7TQc',100,0,937,-937,'2022-04-11 02:33:30',2,1),(104,'1nJZrH1yr',50,0,562,400,'2022-04-11 02:37:02',2,4),(105,'1nJZrH1yr',50,562,0,-138,'2022-04-11 02:37:02',2,3),(106,'W8MHHEOi3',50,1012,0,1012,'2022-04-11 02:37:02',NULL,2),(107,'W8MHHEOi3',50,0,987,-987,'2022-04-11 02:37:02',2,1),(108,'WUXKGi7Ok',50,0,612,400,'2022-04-11 02:37:31',2,4),(109,'WUXKGi7Ok',50,612,0,-88,'2022-04-11 02:37:31',2,3),(110,'OhmanZaec',50,1062,0,1062,'2022-04-11 02:37:31',NULL,2),(111,'OhmanZaec',50,0,1037,-1037,'2022-04-11 02:37:31',2,1),(112,'Jz5qe3XN9',50,0,662,400,'2022-04-11 02:38:04',2,4),(113,'Jz5qe3XN9',50,662,0,-38,'2022-04-11 02:38:04',2,3),(114,'R8JQuN9Uf',50,0,712,350,'2022-04-11 02:38:22',2,4),(115,'R8JQuN9Uf',50,712,0,12,'2022-04-11 02:38:22',2,3),(116,'Kl3Xhs0jH',50,0,762,300,'2022-04-11 02:38:27',2,4),(117,'Kl3Xhs0jH',50,762,0,62,'2022-04-11 02:38:27',2,3),(118,'m7ZXCqy8r',50,0,812,250,'2022-04-11 02:38:28',2,4),(119,'m7ZXCqy8r',50,812,0,112,'2022-04-11 02:38:28',2,3),(120,'xVhnRko58',50,0,862,200,'2022-04-11 02:38:50',2,4),(121,'xVhnRko58',50,862,0,162,'2022-04-11 02:38:50',2,3),(122,'L1wjb3XNy',50,0,912,150,'2022-04-11 02:38:53',2,4),(123,'L1wjb3XNy',50,912,0,212,'2022-04-11 02:38:53',2,3),(124,'q3R9BJiwp',50,0,962,100,'2022-04-11 02:38:58',2,4),(125,'q3R9BJiwp',50,962,0,262,'2022-04-11 02:38:58',2,3),(126,'iFMWny4p4',50,0,1012,50,'2022-04-11 02:38:59',2,4),(127,'iFMWny4p4',50,1012,0,312,'2022-04-11 02:38:59',2,3),(128,'8qpjvBoQp',50,1112,0,1112,'2022-04-11 02:38:59',NULL,2),(129,'8qpjvBoQp',50,0,1087,-1087,'2022-04-11 02:38:59',2,1),(130,'IS4zGgHn1',50,0,1062,50,'2022-04-11 03:54:44',2,4),(131,'IS4zGgHn1',50,1062,0,362,'2022-04-11 03:54:44',2,3),(132,'wzPkjlBZb',50,0,1112,0,'2022-04-11 07:54:18',2,4),(133,'wzPkjlBZb',50,1112,0,412,'2022-04-11 07:54:18',2,3),(134,'Q7NHQGLSa',30,1142,0,1142,'2022-04-11 07:54:18',NULL,2),(135,'Q7NHQGLSa',30,0,1117,-1117,'2022-04-11 07:54:18',2,1),(136,'KXQRDDgNj',50,0,1162,-20,'2022-04-11 07:59:57',2,4),(137,'KXQRDDgNj',50,1162,0,462,'2022-04-11 07:59:57',2,3),(138,'umBfxsB68',30,1172,0,1172,'2022-04-11 07:59:57',NULL,2),(139,'umBfxsB68',30,0,1147,-1147,'2022-04-11 07:59:57',2,1),(140,'JEob6WJSL',50,0,1212,-40,'2022-04-11 08:02:00',2,4),(141,'JEob6WJSL',50,1212,0,512,'2022-04-11 08:02:00',2,3),(142,'0bmki9kS7',30,1202,0,1202,'2022-04-11 08:02:00',NULL,2),(143,'0bmki9kS7',30,0,1177,-1177,'2022-04-11 08:02:00',2,1),(144,'zggAChHxD',50,1252,0,40,'2022-04-26 07:20:34',2,4),(145,'zggAChHxD',50,0,750,462,'2022-04-26 07:20:34',2,3),(146,'5YvNgzezD',20,1272,0,60,'2022-04-26 07:23:46',2,4),(147,'5YvNgzezD',20,0,770,442,'2022-04-26 07:23:46',2,3),(148,'BT8OlKlBS',20,1292,0,80,'2022-04-26 07:45:19',2,4),(149,'BT8OlKlBS',20,0,790,422,'2022-04-26 07:45:19',2,3),(150,'DnDs416i9',20,1312,0,100,'2022-04-26 07:51:30',2,4),(151,'DnDs416i9',20,0,810,402,'2022-04-26 07:51:30',2,3),(152,'Jqu43ZUAM',20,1332,0,120,'2022-04-26 07:55:29',2,4),(153,'Jqu43ZUAM',20,0,830,382,'2022-04-26 07:55:29',2,3),(154,'k7QEACxHR',50,0,1262,70,'2022-09-05 13:45:27',2,4),(155,'k7QEACxHR',50,1262,0,432,'2022-09-05 13:45:27',2,3),(156,'BYdHT3mOj',30,1232,0,1232,'2022-09-05 13:45:27',NULL,2),(157,'BYdHT3mOj',30,0,1207,-1207,'2022-09-05 13:45:27',2,1),(158,'ckSYaZnEb',50,0,1312,-80,'2022-09-05 13:45:45',2,4),(159,'ckSYaZnEb',50,1312,0,482,'2022-09-05 13:45:45',2,3),(160,'hfGjnQtmc',50,0,1362,-130,'2022-09-05 13:45:46',2,4),(161,'hfGjnQtmc',50,1362,0,532,'2022-09-05 13:45:46',2,3);
/*!40000 ALTER TABLE `ledgers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `loan_code` varchar(20) DEFAULT NULL,
  `member_id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `balance` double DEFAULT 0,
  `status` varchar(10) NOT NULL,
  `inserted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `loan_code` (`loan_code`),
  KEY `client_id` (`client_id`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `loans_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loans`
--

LOCK TABLES `loans` WRITE;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
INSERT INTO `loans` VALUES (5,11,'LN#4O3R3uu0L',2,2000,0,'REJECTED','2022-03-16 11:19:25','2022-04-05 12:09:07'),(6,11,'LN#L2ukFsES4',2,200,0,'REJECTED','2022-03-28 15:56:49','2022-04-05 12:12:21'),(7,11,'LN#cXyVC5JX9',1,3435345,0,'REJECTED','2022-04-01 15:16:05','2022-04-05 12:08:23'),(8,11,'LN#eb6yOFRaA',2,500,500,'REJECTED','2022-04-05 15:13:30','2022-04-07 10:35:43'),(9,11,'LN#v9X97sgQp',2,200,0,'SETTLED','2022-04-07 12:06:23','2022-04-11 02:37:02'),(10,11,'LN#kX2zorCHp',2,20,0,'SETTLED','2022-04-07 14:25:28','2022-04-11 07:54:18'),(11,11,'LN#EjCUcCzbk',2,20,0,'SETTLED','2022-04-07 14:26:01','2022-04-11 07:59:57'),(12,11,'LN#vXC0asJRY',2,20,0,'SETTLED','2022-04-07 14:26:59','2022-04-11 08:02:00'),(13,11,'LN#d0p1eJvlf',2,30000,0,'SETTLED','2022-04-07 14:27:18','2022-04-11 02:38:59'),(17,11,'LN#5x1o8F2Ob',2,20,0,'SETTLED','2022-04-26 10:55:22','2022-09-05 13:45:27'),(18,11,'LN#dtLckZr4c',2,20,0,'PENDING','2022-07-21 16:02:00','2022-07-21 13:02:00');
/*!40000 ALTER TABLE `loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `identity_no` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `loan_limit` double DEFAULT 0,
  `inserted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_client_id` (`client_id`),
  KEY `idx_phone` (`phone`),
  CONSTRAINT `members_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'John','Doe','Dow','3000111','NATIONAL ID','254707250844','2000-01-01',11,0,'2022-02-24 05:05:17','2022-03-15 06:36:31'),(2,'Kepha','Ragira','Okari','32121359','NATIONAL ID','254707630747','2001-01-20',11,50,'2022-03-14 10:25:49','2022-04-26 07:42:59'),(4,'kepha2','okari','Ragira','30101359','NATIONAL ID','254719318686','2000-04-28',11,150,'2022-04-12 11:41:01','2022-05-05 07:53:38'),(5,'Michael','Elexander','Okong\'o','3000111','NATIONAL ID','254728314988','1995-01-01',11,150,'2022-04-12 11:46:31','2022-05-05 07:53:38'),(6,'Titus','Emirundu','M','3000111','NATIONAL ID','25474222872','1995-01-01',11,150,'2022-04-12 11:47:12','2022-05-05 07:53:38'),(7,'James','Kabiru','M','3000111','NATIONAL ID','254721881969','1995-01-01',11,150,'2022-04-12 11:47:49','2022-05-05 07:53:38'),(8,'Brian','Wachira','BMW','3000111','NATIONAL ID','254707250844','1995-01-01',11,150,'2022-04-12 11:48:55','2022-05-05 07:53:38'),(11,'Dorsey','Dorsey','wachira','38756789','PASSPORT','254753472876','1991-05-04',11,150,'2022-04-19 16:07:45','2022-05-05 10:10:10'),(12,'Salome','Kiruri','','30001123','NATIONAL ID','254724217046','2001-01-20',11,150,'2022-05-05 10:49:12','2022-05-05 07:53:38'),(13,'Evalyne','Ngari','','30001125','NATIONAL ID','254711810250','2001-01-20',11,150,'2022-05-05 10:50:23','2022-05-05 07:53:38');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1532171409),('m130524_201442_init',1532171413);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `msisdn` varchar(50) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `processed` tinyint(4) DEFAULT 0,
  `inserted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'chaliblues@gmail.com','254704965665',NULL,'Hi ,<br/>\n              Your BongaSMS account password recovery request has been processed. Kindly Follow the below link to complete your password recovery.<br/><br/>\n              Link:<a href=\"http://localhost/bongasms/index.php/site/recover-password?&email=chaliblues@gmail.com&token=z3vApOgrZv\">Password Recover Link</a>\n    <br/>',1,NULL,0,'2018-09-03 12:55:32','2018-09-03 09:55:32'),(2,'wambani@live.com','254704965665','BongaSMS Registration Notification','Hi Wambani Sewe ,<br/>\n              Your BongaSMS account has has been processed. Details are listed below :<br/><br/>\n              \n              Account Name : Olive Tree Test<br/>\n              Account Email: wambani@live.com<br/>\n              Account Phone: 254704965665<br/><br/>\n\n              Admin User Name  : Wambani Sewe<br/>\n              Admin User Phone : 254704965665<br/>\n    <br/>',1,NULL,0,'2018-09-03 21:45:17','2018-09-03 18:45:17'),(3,'chaliblues@gmail.com','254704965665','BongaSMS Forgot Password Notification','Hi ,<br/>\n              Your BongaSMS account password recovery request has been processed. Kindly Follow the below link to complete your password recovery.<br/><br/>\n              Link:<a href=\"http://localhost/bongasms/index.php/site/recover-password?&email=chaliblues@gmail.com&token=TXmcTN41bc\">Password Recover Link</a>\n    <br/>',1,NULL,0,'2018-09-05 10:26:23','2018-09-05 07:26:23'),(4,'chaliblues@gmail.com','254704965665','BongaSMS Forgot Password Notification','Hi ,<br/>\n              Your BongaSMS account password recovery request has been processed. Kindly Follow the below link to complete your password recovery.<br/><br/>\n              Link:<a href=\"http://localhost/bongasms/index.php/site/recover-password?&email=chaliblues@gmail.com&token=U5r9cGzmgs\">Password Recover Link</a>\n    <br/>',1,NULL,0,'2018-09-05 10:30:13','2018-09-05 07:30:13'),(5,'chaliblues@gmail.com','254704965665','BongaSMS Forgot Password Notification','Hi ,<br/>\n              Your BongaSMS account password recovery request has been processed. Kindly Follow the below link to complete your password recovery.<br/><br/>\n              Link:<a href=\"http://localhost/bongasms/index.php/site/recover-password?&email=chaliblues@gmail.com&token=krBXAesvqJ\">Password Recover Link</a>\n    <br/>',1,NULL,0,'2018-09-05 10:31:09','2018-09-05 07:31:09'),(6,'chaliblues@gmail.com','254704965665','BongaSMS Forgot Password Notification','Hi ,<br/>\n              Your BongaSMS account password recovery request has been processed. Kindly Follow the below link to complete your password recovery.<br/><br/>\n              Link:<a href=\"http://localhost/bongasms/index.php/site/recover-password?&email=chaliblues@gmail.com&token=B8umKGJeZZ\">Password Recover Link</a>\n    <br/>',1,1,0,'2018-09-05 10:33:42','2018-09-05 07:33:42'),(7,'chaliblues@gmail.com','254704965665','BongaSMS Forgot Password Notification','Hi ,<br/>\n              Your BongaSMS account password recovery request has been processed. Kindly Follow the below link to complete your password recovery.<br/><br/>\n              Link:<a href=\"http://localhost/bongasms/index.php/site/recover-password?&email=chaliblues@gmail.com&token=HuxKTdfOYs\">Password Recover Link</a>\n    <br/>',1,1,0,'2018-09-05 10:40:25','2018-09-05 07:40:25'),(8,'chaliblues@gmail.com','254704965665','BongaSMS Forgot Password Notification','Hi ,<br/>\n              Your BongaSMS account password recovery request has been processed. Kindly Follow the below link to complete your password recovery.<br/><br/>\n              Link:<a href=\"http://localhost/bongasms/index.php/site/recover-password?&email=chaliblues@gmail.com&token=6fh0C93SR4\">Password Recover Link</a>\n    <br/>',1,1,0,'2018-09-05 10:42:10','2018-09-05 07:42:10'),(9,'chaliblues@gmail.com','254704965665','Peanut Forgot Password Notification','Hi ,<br/>\n              Your Peanut account password recovery request has been processed. Kindly Follow the below link to complete your password recovery.<br/><br/>\n              Link:<a href=\"https://app.bongasms.co.ke//site/recover-password?&email=chaliblues@gmail.com&token=U8tcazkB4D\">Password Recover Link</a>\n    <br/>',1,1,0,'2021-02-09 10:36:40','2021-02-09 07:36:40'),(10,'kephaokari@gmail.com','254707630747','Peanut Registration Notification','Hi Kepha ,<br/>\n              Your Peanut account has has been processed. Details are listed below :<br/><br/>\n              \n              Account Name : kephaokari@gmail.com<br/>\n              Account Email: kephaokari@gmail.com<br/>\n              Account Phone: 254707630747<br/><br/>\n\n              Admin User Name  : Kepha<br/>\n              Admin User Phone : 254707630747<br/>\n    <br/>',1,8,0,'2021-02-09 10:37:46','2021-02-09 07:37:46'),(11,'kepha@gmail.com','254707630747','Peanut Registration Notification','Hi Kep ,<br/>\n              Your Peanut account has has been processed. Details are listed below :<br/><br/>\n              \n              Account Name : kepha@gmail.com<br/>\n              Account Email: kepha@gmail.com<br/>\n              Account Phone: 254707630747<br/><br/>\n\n              Admin User Name  : Kep<br/>\n              Admin User Phone : 254707630747<br/>\n    <br/>',1,9,0,'2021-02-24 13:32:38','2021-02-24 10:32:38'),(12,'kr@gmail.com','254707630747','Peanut Registration Notification','Hi Kepha ,<br/>\n              Your Peanut account has has been processed. Details are listed below :<br/><br/>\n              \n              Account Name : kr@gmail.com<br/>\n              Account Email: kr@gmail.com<br/>\n              Account Phone: 254707630747<br/><br/>\n\n              Admin User Name  : Kepha<br/>\n              Admin User Phone : 254707630747<br/>\n    <br/>',1,10,0,'2021-03-09 14:34:56','2021-03-09 11:34:56'),(13,'kepha.okari@olivetreemobile.co','254707630747','Peanut Registration Notification','Hi Kepha ,<br/>\n              Your Peanut account has has been processed. Details are listed below :<br/><br/>\n              \n              Account Name : kephaokari@gmail.com<br/>\n              Account Email: kepha.okari@olivetreemobile.co<br/>\n              Account Phone: 254707630747<br/><br/>\n\n              Admin User Name  : Kepha<br/>\n              Admin User Phone : 254707630747<br/>\n    <br/>',1,11,0,'2021-12-20 19:44:27','2021-12-20 16:44:27');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_claims`
--

DROP TABLE IF EXISTS `order_claims`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_claims` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(15) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `code` varchar(15) NOT NULL,
  `is_valid` tinyint(4) DEFAULT 1,
  `inserted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_claims_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_claims`
--

LOCK TABLES `order_claims` WRITE;
/*!40000 ALTER TABLE `order_claims` DISABLE KEYS */;
INSERT INTO `order_claims` VALUES (1,'11',37,'OA2176',0,'2022-10-10 13:37:03','2022-10-19 08:47:25');
/*!40000 ALTER TABLE `order_claims` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) DEFAULT 1,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `orders_items_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,10,3,2,'2022-09-02 12:02:26'),(2,1,10,3,2,'2022-09-02 12:02:26'),(3,1,10,3,2,'2022-09-02 12:02:26'),(4,1,10,3,3,'2022-09-02 12:02:26'),(5,1,10,3,5,'2022-09-02 12:02:26'),(6,1,10,3,2,'2022-09-02 12:03:22'),(7,1,10,3,2,'2022-09-02 12:03:22'),(8,1,10,3,2,'2022-09-02 12:03:22'),(9,1,10,3,3,'2022-09-02 12:03:22'),(10,1,10,3,5,'2022-09-02 12:03:22'),(11,1,10,3,2,'2022-09-02 12:12:09'),(12,1,10,3,2,'2022-09-02 12:12:09'),(13,1,10,3,2,'2022-09-02 12:12:09'),(14,1,10,3,3,'2022-09-02 12:12:09'),(15,1,10,3,5,'2022-09-02 12:12:09'),(16,1,10,3,2,'2022-09-02 12:32:49'),(17,1,10,3,2,'2022-09-02 12:32:49'),(18,1,10,3,2,'2022-09-02 12:32:49'),(19,1,10,3,3,'2022-09-02 12:32:49'),(20,1,10,3,5,'2022-09-02 12:32:49'),(21,1,10,3,2,'2022-09-02 12:32:51'),(22,1,10,3,2,'2022-09-02 12:32:51'),(23,1,10,3,2,'2022-09-02 12:32:51'),(24,1,10,3,3,'2022-09-02 12:32:51'),(25,1,10,3,5,'2022-09-02 12:32:51'),(26,1,30,3,2,'2022-09-04 18:37:35'),(27,1,30,3,2,'2022-09-04 18:37:35'),(28,1,30,3,2,'2022-09-04 18:37:35'),(29,1,30,3,3,'2022-09-04 18:37:35'),(30,1,30,3,5,'2022-09-04 18:37:35'),(31,1,31,3,2,'2022-09-08 12:18:19'),(32,1,31,3,2,'2022-09-08 12:18:19'),(33,1,31,3,2,'2022-09-08 12:18:19'),(34,1,31,3,3,'2022-09-08 12:18:19'),(35,1,31,3,5,'2022-09-08 12:18:19'),(36,1,32,3,2,'2022-10-09 18:49:39'),(37,1,32,3,2,'2022-10-09 18:49:39'),(38,1,32,3,2,'2022-10-09 18:49:39'),(39,1,32,3,3,'2022-10-09 18:49:39'),(40,1,32,3,5,'2022-10-09 18:49:39'),(41,1,33,3,2,'2022-10-09 18:49:41'),(42,1,33,3,2,'2022-10-09 18:49:41'),(43,1,33,3,2,'2022-10-09 18:49:41'),(44,1,33,3,3,'2022-10-09 18:49:41'),(45,1,33,3,5,'2022-10-09 18:49:41'),(61,1,37,3,2,'2022-10-10 10:37:03'),(62,1,37,3,2,'2022-10-10 10:37:03'),(63,1,37,3,2,'2022-10-10 10:37:03'),(64,1,37,3,3,'2022-10-10 10:37:03'),(65,1,37,3,5,'2022-10-10 10:37:03');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) DEFAULT 1,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `to_deliver` tinyint(4) DEFAULT 1,
  `inserted_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `client_admins` (`id`),
  CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (10,2,18,11,1,'2022-09-02 14:50:52','2022-10-14 06:24:07'),(11,1,18,11,1,'2022-09-02 14:53:54','2022-09-02 11:53:54'),(12,1,18,11,1,'2022-09-02 14:54:21','2022-09-02 11:54:21'),(16,1,18,11,1,'2022-09-02 14:55:08','2022-09-02 11:55:08'),(20,1,18,11,1,'2022-09-02 14:55:49','2022-09-02 11:55:49'),(21,1,18,11,1,'2022-09-02 14:55:50','2022-09-02 11:55:50'),(22,1,18,11,1,'2022-09-02 14:55:51','2022-09-02 11:55:51'),(25,1,18,11,1,'2022-09-02 15:02:26','2022-09-02 12:02:26'),(26,1,18,11,1,'2022-09-02 15:03:22','2022-09-02 12:03:22'),(27,1,18,11,1,'2022-09-02 15:12:09','2022-09-02 12:12:09'),(28,1,18,11,1,'2022-09-02 15:32:49','2022-09-02 12:32:49'),(29,1,18,11,1,'2022-09-02 15:32:51','2022-09-02 12:32:51'),(30,1,18,11,1,'2022-09-04 21:37:35','2022-09-04 18:37:35'),(31,1,18,11,1,'2022-09-08 15:18:19','2022-09-08 12:18:19'),(32,1,18,11,1,'2022-10-09 21:49:39','2022-10-09 18:49:39'),(33,1,18,11,1,'2022-10-09 21:49:41','2022-10-09 18:49:41'),(37,1,18,11,1,'2022-10-10 13:37:03','2022-10-10 10:37:03');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `inserted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`action_id`),
  KEY `group_actions_fk0` (`group_id`),
  KEY `group_actions_fk1` (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,1,1,1,2,2,'2018-03-21 12:34:20','2018-03-21 09:34:20'),(2,2,2,2,2,11,'2018-08-19 10:56:15','2018-09-03 18:29:21'),(3,2,3,1,2,2,'2018-08-19 10:56:15','2018-08-19 07:56:15'),(5,2,5,1,2,2,'2018-09-03 22:04:31','2018-09-03 19:04:31'),(6,2,6,1,2,2,'2018-09-03 22:04:31','2018-09-03 19:04:31'),(7,2,7,1,2,2,'2018-09-03 22:04:31','2018-09-03 19:04:31'),(8,2,9,1,2,2,'2018-09-06 22:10:33','2018-09-06 19:10:33'),(9,2,1,1,2,2,'2020-12-15 09:22:14','2020-12-15 06:22:14'),(10,2,4,1,2,2,'2020-12-15 09:22:14','2020-12-15 06:22:14'),(11,2,8,1,2,2,'2020-12-15 09:22:14','2020-12-15 06:22:14');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `in_stock` tinyint(4) DEFAULT 1,
  `cost` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `inserted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (3,'Tusker Malt','634a8693bae0b.jpeg','Cold',8,10,1,250,18,18,'2022-08-30 23:33:30','2022-10-15 11:15:06'),(4,'Kenya Originals Cider','634a870236a69.jpeg','Cold Kenyan beer',8,10,1,250,18,18,'2022-08-30 23:34:49','2022-10-15 11:15:07'),(5,'Guiness','634a86f18e418.jpeg','Stout',8,10,1,250,18,18,'2022-08-30 23:35:24','2022-10-15 11:15:07'),(7,'Tusker Malt','634a86f18e418.jpeg','Cold',11,10,1,270,18,18,'2022-08-30 23:40:48','2022-10-15 11:15:07'),(8,'Tusker Malt','634a86d1413ef.jpeg','Cold',8,10,1,250,18,18,NULL,'2022-10-15 11:15:07'),(9,'Kenya Originals Cider','634a870236a69.jpeg','Cold Kenyan beer',8,10,1,250,18,18,NULL,'2022-10-15 11:15:07'),(10,'Guiness','634a86d1413ef.jpeg','Stout',8,10,1,250,18,18,NULL,'2022-10-15 11:15:07'),(11,'Tusker Malt','634a86d1413ef.jpeg','Cold',11,10,1,270,18,18,NULL,'2022-10-15 11:15:07'),(15,'Tusker Malt','634a86f18e418.jpeg','Cold',8,10,1,250,18,18,NULL,'2022-10-15 11:15:07'),(16,'Kenya Originals Cider','634a86f18e418.jpeg','Cold Kenyan beer',8,10,1,250,18,18,NULL,'2022-10-15 11:15:07'),(17,'Guiness','634a8693bae0b.jpeg','Stout',8,10,1,250,18,18,NULL,'2022-10-15 11:15:07'),(18,'Tusker Malt','634a870236a69.jpeg','Cold',11,10,1,270,18,18,NULL,'2022-10-15 11:15:07'),(19,'Tusker Malt','634a86f18e418.jpeg','Cold',8,10,1,250,18,18,NULL,'2022-10-15 11:15:07'),(20,'Kenya Originals Cider','634a86f18e418.jpeg','Cold Kenyan beer',8,10,1,250,18,18,NULL,'2022-10-15 11:15:07'),(21,'Guiness','634a86d1413ef.jpeg','Stout',8,10,1,250,18,18,NULL,'2022-10-15 11:15:07'),(22,'Tusker Malt','634a86f18e418.jpeg','Cold',11,10,1,270,18,18,NULL,'2022-10-15 11:15:07'),(30,'Tusker Malt','634a86d1413ef.jpeg','Cold',8,10,1,250,18,18,NULL,'2022-10-15 11:15:07'),(107,'veggy','634a86d1413ef.jpeg','Made of greens and fruits',10,11,1,200,NULL,NULL,'2022-10-09 10:23:28','2022-10-15 11:15:07'),(108,'veggy','634a8693bae0b.jpeg','made of gegetables and fruits',10,11,1,200,NULL,NULL,'2022-10-09 10:24:44','2022-10-15 11:15:07'),(109,'vegetarian','634a86f18e418.jpeg','Made of greens',10,11,1,200,NULL,NULL,'2022-10-09 16:58:36','2022-10-15 11:15:07'),(110,'vegetarian2','634a870236a69.jpeg','Made of greens',10,11,1,200,18,NULL,'2022-10-09 17:23:31','2022-10-15 11:15:07');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) DEFAULT NULL,
  `visible` tinyint(4) DEFAULT 0,
  `inserted_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'ACTIVE',1,'2017-07-26 06:33:14'),(2,'INACTIVE',1,'2017-07-26 06:33:14'),(3,'PENDING',1,'2017-07-26 06:33:14'),(4,'FAILED_AUTH',1,'2017-07-26 06:33:14'),(5,'SUCCESS',1,'2017-08-04 15:21:59'),(6,'FAILED',1,'2017-08-04 15:22:10');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_code` varchar(255) NOT NULL,
  `transaction_type` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `payment_gateway` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `reference_code` (`reference_code`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28230 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (28150,'wHOpEXNUk','DEPOSIT','Member deposit',200,'MPESA',0,2,'2022-03-15 07:13:26','2022-03-17 10:03:10'),(28151,'CxrL7JMR1','DEPOSIT','Member deposit',200,'MPESA',0,2,'2022-03-15 07:13:26','2022-03-17 10:03:10'),(28152,'RaCI7s9LM','DEPOSIT','Member deposit',150,'MPESA',0,2,'2022-03-15 07:13:26','2022-03-17 10:03:10'),(28153,'2bAknDXbd','DEPOSIT','Member deposit',50,'MPESA',0,2,'2022-03-15 07:13:26','2022-03-17 10:03:10'),(28154,'2fUJmhiLC','DEPOSIT','Member deposit',25,'MPESA',0,2,'2022-03-18 12:05:50','2022-03-18 12:05:50'),(28156,'Eo9sZve8K','LOAN','The loan funds disbursed to member member mobile money account',500,'MPESA',0,2,'2022-04-07 08:39:36','2022-04-07 08:39:36'),(28157,'ybRUQY82a','LOAN','The loan funds disbursed to member member mobile money account',500,'MPESA',0,2,'2022-04-07 08:55:58','2022-04-07 08:55:58'),(28159,'JYUJH0WnO','LOAN','The loan funds disbursed to member member mobile money account',500,'MPESA',0,2,'2022-04-07 08:59:10','2022-04-07 08:59:10'),(28160,'cVSqO3Cca','LOAN','The loan funds disbursed to member member mobile money account',200,'MPESA',0,2,'2022-04-07 10:13:53','2022-04-07 10:13:53'),(28170,'j1LG0KAIr','LOAN PAYMENT','The funds to service an active loan',20,'MPESA',0,2,'2022-04-08 04:30:34','2022-04-08 04:30:34'),(28171,'enZrzablk','LOAN PAYMENT','The funds to service an active loan',20,'MPESA',0,2,'2022-04-08 04:30:53','2022-04-08 04:30:53'),(28172,'dQul5Vqhi','LOAN PAYMENT','The funds to service an active loan',20,'MPESA',0,2,'2022-04-08 04:31:12','2022-04-08 04:31:12'),(28173,'qM2YlgnED','LOAN PAYMENT','The funds to service an active loan',20,'MPESA',0,2,'2022-04-08 04:31:13','2022-04-08 04:31:13'),(28174,'MS1Ae7sUP','LOAN PAYMENT','The funds to service an active loan',20,'MPESA',0,2,'2022-04-08 04:31:38','2022-04-08 04:31:38'),(28175,'TBAfWAemy','LOAN PAYMENT','The funds to service an active loan',20,'MPESA',0,2,'2022-04-08 04:50:03','2022-04-08 04:50:03'),(28176,'FxnyHdXTQ','LOAN PAYMENT','The funds to service an active loan',20,'MPESA',0,2,'2022-04-08 04:50:24','2022-04-08 04:50:24'),(28177,'Yz2Y16ykl','LOAN PAYMENT','The funds to service an active loan',20,'MPESA',0,2,'2022-04-08 07:02:38','2022-04-08 07:02:38'),(28178,'4uYo5ydcG','DEPOSIT','Member deposit to service an active loan',25,'MPESA',0,2,'2022-04-08 09:01:34','2022-04-08 09:01:34'),(28179,'1p1XM0A5h','LOAN PAYMENT','The funds to service an active loan',1,'MPESA',0,2,'2022-04-08 09:23:27','2022-04-08 09:23:27'),(28180,'ddD4lurcL','LOAN PAYMENT','The funds to service an active loan',1,'MPESA',0,2,'2022-04-08 09:24:14','2022-04-08 09:24:14'),(28182,'C7KufchPr','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-08 09:28:49','2022-04-08 09:28:49'),(28183,'3WIdrIb2F','DEPOSIT','Loan overpayment',12,'INTERNAL',0,2,'2022-04-08 09:28:49','2022-04-08 09:28:49'),(28184,'nggsgXWqh','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:28:21','2022-04-11 02:28:21'),(28185,'RFYBUsvTRyD','LOAN OVERPAYMENT','Refund due to overpayment of loan',50,'INTERNAL',0,2,'2022-04-11 02:28:21','2022-04-11 02:28:21'),(28186,'kflcMnyd8','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:29:45','2022-04-11 02:29:45'),(28187,'RF6g6wXZdnO','LOAN OVERPAYMENT','Refund due to overpayment of loan',50,'INTERNAL',0,2,'2022-04-11 02:29:45','2022-04-11 02:29:45'),(28188,'BlMajPaji','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:30:45','2022-04-11 02:30:45'),(28189,'RFflDfj7LGF','LOAN OVERPAYMENT','Refund due to overpayment of loan',50,'INTERNAL',0,2,'2022-04-11 02:30:45','2022-04-11 02:30:45'),(28190,'wDbX3N5Md','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:32:04','2022-04-11 02:32:04'),(28191,'RFnBTfu3zqJ','LOAN OVERPAYMENT','Refund due to overpayment of loan',50,'INTERNAL',0,2,'2022-04-11 02:32:04','2022-04-11 02:32:04'),(28192,'cDQY1Iuuf','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:32:48','2022-04-11 02:32:48'),(28193,'6tjw7ZoZO','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:33:30','2022-04-11 02:33:30'),(28194,'RFKbiVU7TQc','LOAN OVERPAYMENT','Refund due to overpayment of loan',100,'INTERNAL',0,2,'2022-04-11 02:33:30','2022-04-11 02:33:30'),(28201,'1nJZrH1yr','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:37:02','2022-04-11 02:37:02'),(28202,'RFW8MHHEOi3','LOAN OVERPAYMENT','Refund due to overpayment of loan',50,'INTERNAL',0,2,'2022-04-11 02:37:02','2022-04-11 02:37:02'),(28203,'WUXKGi7Ok','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:37:31','2022-04-11 02:37:31'),(28204,'RFOhmanZaec','LOAN OVERPAYMENT','Refund due to overpayment of loan',50,'INTERNAL',0,2,'2022-04-11 02:37:31','2022-04-11 02:37:31'),(28205,'Jz5qe3XN9','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:38:04','2022-04-11 02:38:04'),(28206,'R8JQuN9Uf','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:38:22','2022-04-11 02:38:22'),(28207,'Kl3Xhs0jH','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:38:27','2022-04-11 02:38:27'),(28208,'m7ZXCqy8r','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:38:28','2022-04-11 02:38:28'),(28209,'xVhnRko58','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:38:50','2022-04-11 02:38:50'),(28210,'L1wjb3XNy','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:38:53','2022-04-11 02:38:53'),(28211,'q3R9BJiwp','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:38:58','2022-04-11 02:38:58'),(28212,'iFMWny4p4','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 02:38:59','2022-04-11 02:38:59'),(28213,'RF8qpjvBoQp','LOAN OVERPAYMENT','Refund due to overpayment of loan',50,'INTERNAL',0,2,'2022-04-11 02:38:59','2022-04-11 02:38:59'),(28214,'IS4zGgHn1','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 03:54:44','2022-04-11 03:54:44'),(28215,'wzPkjlBZb','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 07:54:18','2022-04-11 07:54:18'),(28216,'RFQ7NHQGLSa','LOAN OVERPAYMENT','Refund due to overpayment of loan',30,'INTERNAL',0,2,'2022-04-11 07:54:18','2022-04-11 07:54:18'),(28217,'KXQRDDgNj','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 07:59:57','2022-04-11 07:59:57'),(28218,'RFumBfxsB68','LOAN OVERPAYMENT','Refund due to overpayment of loan',30,'INTERNAL',0,2,'2022-04-11 07:59:57','2022-04-11 07:59:57'),(28219,'JEob6WJSL','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-04-11 08:02:00','2022-04-11 08:02:00'),(28220,'RF0bmki9kS7','LOAN OVERPAYMENT','Refund due to overpayment of loan',30,'INTERNAL',0,2,'2022-04-11 08:02:00','2022-04-11 08:02:00'),(28221,'zggAChHxD','LOAN','The loan funds disbursed to member member mobile money account',50,'MPESA',0,2,'2022-04-26 07:20:34','2022-04-26 07:20:34'),(28222,'5YvNgzezD','LOAN','The loan funds disbursed to member member mobile money account',20,'MPESA',0,2,'2022-04-26 07:23:46','2022-04-26 07:23:46'),(28223,'BT8OlKlBS','LOAN','The loan funds disbursed to member member mobile money account',20,'MPESA',0,2,'2022-04-26 07:45:19','2022-04-26 07:45:19'),(28224,'DnDs416i9','LOAN','The loan funds disbursed to member member mobile money account',20,'MPESA',0,2,'2022-04-26 07:51:30','2022-04-26 07:51:30'),(28225,'Jqu43ZUAM','LOAN','The loan funds disbursed to member member mobile money account',20,'MPESA',0,2,'2022-04-26 07:55:29','2022-04-26 07:55:29'),(28226,'k7QEACxHR','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-09-05 13:45:27','2022-09-05 13:45:27'),(28227,'RFBYdHT3mOj','LOAN OVERPAYMENT','Refund due to overpayment of loan',30,'INTERNAL',0,2,'2022-09-05 13:45:27','2022-09-05 13:45:27'),(28228,'ckSYaZnEb','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-09-05 13:45:45','2022-09-05 13:45:45'),(28229,'hfGjnQtmc','LOAN PAYMENT','The funds to service an active loan',50,'MPESA',0,2,'2022-09-05 13:45:46','2022-09-05 13:45:46');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `msisdn` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `inserted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'Charles Sewe','254704965665','chaliblues','','$2y$13$4xxaPQ8.8Lh4fIDzrJACZeS3YzsmP9wLp0FS/QVAmMU89MLktHmNG','$2y$13$bZMBVNnkz.z5Jstr.F98AePRazXo69VH5xz60gpqk8ugqBdESQIUi','olivetest@gmail.com',1,1,2,NULL,'2018-07-21 00:00:00','2022-03-15 04:19:06'),(14,'Wambani C Sewe','254704965665',NULL,NULL,'$2y$13$JJhaj4GULBzLhEpo6OYGP.zR0H63rApaUki9nuts9HxiXgOWLmdiq',NULL,'wambani@live.com',7,1,NULL,2,'2018-09-03 21:45:17','2018-09-06 19:06:55'),(18,'Kepha','254707630747','krom','123x73','$2y$13$SKN6lfmN2lYtPYCpVPBgceAc341mSzLD6aBbqZ/PWcmmzFAHQ37ny',NULL,'kepha.okari@olivetreemobile.co',11,1,NULL,18,'2021-12-20 19:44:27','2022-03-09 10:12:40'),(19,'brayo & kevo','0707630747',NULL,NULL,'$2y$13$SKN6lfmN2lYtPYCpVPBgceAc341mSzLD6aBbqZ/PWcmmzFAHQ37ny',NULL,'brayo@gmail.com',11,2,18,18,'2022-02-10 17:19:51','2022-02-10 14:19:52'),(20,'Wachira','254707250844',NULL,NULL,'$2y$13$zmL4QbDJlRVSei1lI.BoLe9/6O4LvFHfGqZJ2BU2I4QYWu/6DwFtC',NULL,'brian.wachira@olivetreemobile.co',11,1,18,18,'2022-02-14 13:05:24','2022-02-14 10:05:24');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_audit_details`
--

DROP TABLE IF EXISTS `user_audit_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_audit_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_audit_id` int(11) DEFAULT NULL,
  `old_value` text DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `field` varchar(250) DEFAULT NULL,
  `inserted_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_audit_details`
--

LOCK TABLES `user_audit_details` WRITE;
/*!40000 ALTER TABLE `user_audit_details` DISABLE KEYS */;
INSERT INTO `user_audit_details` VALUES (1,6,'Wambani Sewe','Wambani C Sewe','names','2018-09-06 19:06:55'),(2,8,NULL,'krom','username','2022-02-15 13:55:39'),(3,9,'254707630747','254707630749','msisdn','2022-02-15 13:56:10');
/*!40000 ALTER TABLE `user_audit_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_audits`
--

DROP TABLE IF EXISTS `user_audits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_audits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `table_key` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `inserted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_audits`
--

LOCK TABLES `user_audits` WRITE;
/*!40000 ALTER TABLE `user_audits` DISABLE KEYS */;
INSERT INTO `user_audits` VALUES (1,2,1,3,'UPDATE','user',14,5,'2018-09-06 21:42:21','2018-09-06 18:42:21'),(2,2,1,3,'UPDATE','user',14,5,'2018-09-06 21:43:07','2018-09-06 18:43:07'),(3,2,1,3,'UPDATE','user',14,5,'2018-09-06 22:03:35','2018-09-06 19:03:35'),(4,2,1,3,'UPDATE','user',14,5,'2018-09-06 22:05:33','2018-09-06 19:05:33'),(5,2,1,3,'UPDATE','user',14,5,'2018-09-06 22:05:54','2018-09-06 19:05:54'),(6,2,1,3,'UPDATE','user',14,5,'2018-09-06 22:06:55','2018-09-06 19:06:55'),(7,20,11,3,'UPDATE','user',18,5,'2022-02-14 14:52:51','2022-02-14 11:52:51'),(8,18,11,3,'UPDATE','user',18,5,'2022-02-15 16:55:39','2022-02-15 13:55:39'),(9,18,11,3,'UPDATE','user',18,5,'2022-02-15 16:56:10','2022-02-15 13:56:10');
/*!40000 ALTER TABLE `user_audits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `inserted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_groups_fk0` (`user_id`),
  KEY `user_groups_fk1` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_groups`
--

LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
INSERT INTO `user_groups` VALUES (1,2,1,1,4,4,'2018-08-17 12:19:09','2018-08-17 09:19:09'),(8,14,2,1,NULL,NULL,'2018-09-03 21:45:17','2018-09-03 18:45:17'),(9,15,2,1,NULL,NULL,'2021-02-09 10:37:46','2021-02-09 07:37:46'),(10,16,2,1,NULL,NULL,'2021-02-24 13:32:38','2021-02-24 10:32:38'),(11,17,2,1,NULL,NULL,'2021-03-09 14:34:56','2021-03-09 11:34:56'),(12,18,2,1,NULL,18,'2021-12-20 19:44:27','2022-02-15 14:48:06'),(13,19,2,1,18,18,'2022-02-10 17:19:52','2022-02-10 14:19:52'),(14,20,2,1,18,18,'2022-02-14 13:05:24','2022-02-14 11:51:59');
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-22 21:00:47
