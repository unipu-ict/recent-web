-- MySQL dump 10.13  Distrib 5.7.16, for Linux (x86_64)
--
-- Host: localhost    Database: recent
-- ------------------------------------------------------
-- Server version	5.7.16-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `evidencija`
--

DROP TABLE IF EXISTS `evidencija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evidencija` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `razlog_id` int(11) DEFAULT NULL,
  `datum` date NOT NULL,
  `vrijeme` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_52A9E31FA76ED395` (`user_id`),
  KEY `IDX_52A9E31F37A02C98` (`razlog_id`),
  CONSTRAINT `FK_52A9E31F37A02C98` FOREIGN KEY (`razlog_id`) REFERENCES `razlog` (`id`),
  CONSTRAINT `FK_52A9E31FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evidencija`
--

LOCK TABLES `evidencija` WRITE;
/*!40000 ALTER TABLE `evidencija` DISABLE KEYS */;
INSERT INTO `evidencija` VALUES (1,2,1,'2016-11-11','07:00:00'),(2,3,1,'2016-11-11','07:00:00'),(3,4,1,'2016-11-11','07:00:00'),(4,5,1,'2016-11-11','07:00:00'),(5,6,1,'2016-11-11','07:00:00'),(6,2,3,'2016-11-11','10:26:00'),(7,3,3,'2016-11-11','10:26:00'),(8,4,3,'2016-11-11','10:26:00'),(9,5,3,'2016-11-11','10:26:00'),(10,6,3,'2016-11-11','10:26:00'),(11,2,1,'2016-11-11','10:58:00'),(12,3,1,'2016-11-11','10:58:00'),(13,4,1,'2016-11-11','10:58:00'),(14,5,1,'2016-11-11','10:58:00'),(15,6,1,'2016-11-11','10:58:00'),(16,2,2,'2016-11-11','15:03:00'),(17,3,2,'2016-11-11','15:03:00'),(18,4,2,'2016-11-11','15:03:00'),(19,5,2,'2016-11-11','15:03:00'),(20,6,2,'2016-11-11','15:03:00'),(21,2,1,'2016-11-12','07:04:00'),(22,3,1,'2016-11-12','07:04:00'),(23,4,1,'2016-11-12','07:04:00'),(24,5,1,'2016-11-12','07:04:00'),(25,6,1,'2016-11-12','07:04:00'),(26,2,3,'2016-11-12','10:31:00'),(27,3,3,'2016-11-12','10:31:00'),(28,4,3,'2016-11-12','10:31:00'),(29,5,3,'2016-11-12','10:31:00'),(30,6,3,'2016-11-12','10:31:00'),(31,2,1,'2016-11-12','11:09:15'),(32,3,1,'2016-11-12','11:09:15'),(33,4,1,'2016-11-12','11:09:15'),(34,5,1,'2016-11-12','11:09:15'),(35,6,1,'2016-11-12','11:09:15'),(36,2,2,'2016-11-12','15:11:26'),(37,3,2,'2016-11-12','15:11:26'),(38,4,2,'2016-11-12','15:11:26'),(39,5,2,'2016-11-12','15:11:26'),(40,6,2,'2016-11-12','15:11:26'),(42,3,1,'2016-12-13','19:09:31'),(43,3,2,'2016-12-13','19:09:34'),(44,3,1,'2016-12-13','19:09:35'),(45,3,2,'2016-12-13','19:09:37'),(46,3,1,'2016-12-13','19:12:23'),(47,4,2,'2016-12-13','19:13:17'),(86,3,1,'2016-12-30','10:44:08'),(87,3,2,'2016-12-30','10:45:29'),(88,3,1,'2016-12-30','10:45:46'),(89,3,2,'2016-12-30','10:45:54'),(90,2,1,'2017-01-05','09:02:20'),(91,5,1,'2017-01-05','09:05:44'),(92,5,2,'2017-01-05','11:23:07'),(93,5,1,'2017-01-05','13:48:42'),(94,1,1,'2017-01-05','14:58:13'),(95,5,2,'2017-01-05','14:59:00'),(96,4,1,'2017-01-05','14:59:37'),(97,3,1,'2017-01-05','10:03:11'),(98,3,2,'2017-01-05','15:05:18'),(99,1,2,'2017-01-05','15:17:47'),(101,2,2,'2017-01-05','15:43:50'),(102,2,1,'2017-01-05','15:50:45'),(103,2,2,'2017-01-05','16:01:10'),(104,2,1,'2017-01-06','15:53:20'),(105,2,1,'2017-01-09','14:30:36'),(106,5,1,'2017-01-09','14:32:20'),(107,3,1,'2017-01-09','14:33:29'),(108,2,2,'2017-01-09','14:36:55'),(109,5,1,'2017-01-10','14:57:07'),(110,5,2,'2017-01-10','15:06:13'),(111,1,1,'2017-01-11','12:20:22'),(112,2,1,'2017-01-11','23:10:21'),(113,1,1,'2017-01-12','17:54:54'),(114,3,1,'2017-01-12','17:55:44'),(115,4,1,'2017-01-12','17:56:26'),(116,5,1,'2017-01-12','18:52:35'),(117,4,1,'2017-01-13','08:35:51'),(118,4,2,'2017-01-13','08:36:26'),(119,4,1,'2017-01-13','08:36:45'),(120,4,2,'2017-01-13','08:37:07'),(121,4,1,'2017-01-13','08:43:22'),(122,4,2,'2017-01-13','08:43:28'),(123,4,1,'2017-01-13','08:51:43'),(124,4,2,'2017-01-13','08:52:23'),(125,4,1,'2017-01-13','08:52:46'),(126,4,2,'2017-01-13','08:54:37'),(127,4,1,'2017-01-13','08:56:44'),(128,4,2,'2017-01-13','08:57:38'),(129,4,1,'2017-01-13','08:58:29'),(130,3,1,'2017-01-13','09:05:53'),(131,3,2,'2017-01-13','09:06:03'),(132,1,1,'2017-01-13','09:06:17'),(133,1,2,'2017-01-13','09:09:06'),(134,1,1,'2017-01-13','09:10:40'),(135,1,2,'2017-01-13','09:13:25'),(136,1,1,'2017-01-13','09:13:35'),(137,1,2,'2017-01-13','09:14:52'),(138,1,1,'2017-01-13','09:15:14'),(139,1,2,'2017-01-13','09:18:06'),(140,1,1,'2017-01-13','09:21:23'),(141,1,2,'2017-01-13','09:26:06'),(142,1,1,'2017-01-13','09:27:45'),(143,1,2,'2017-01-13','09:29:59'),(144,1,1,'2017-01-13','09:31:14'),(145,1,2,'2017-01-13','09:32:01'),(146,1,1,'2017-01-13','09:32:06'),(147,1,2,'2017-01-13','09:33:37'),(148,1,1,'2017-01-13','09:34:08'),(149,1,2,'2017-01-13','09:35:46'),(150,1,1,'2017-01-13','09:38:06'),(151,1,2,'2017-01-13','09:38:53'),(152,3,1,'2017-01-13','09:39:29'),(153,1,1,'2017-01-13','09:40:26'),(154,1,2,'2017-01-13','10:40:43'),(155,1,1,'2017-01-13','10:44:24'),(156,1,2,'2017-01-13','10:45:10'),(157,1,1,'2017-01-13','10:46:41'),(158,1,2,'2017-01-13','10:49:14'),(159,1,1,'2017-01-13','10:52:50'),(160,1,2,'2017-01-13','10:53:46'),(161,1,1,'2017-01-13','10:55:02'),(162,1,2,'2017-01-13','10:55:33'),(163,3,2,'2017-01-13','10:56:00'),(164,1,1,'2017-01-13','10:56:46'),(165,1,2,'2017-01-13','10:58:12'),(166,4,2,'2017-01-13','10:59:57'),(167,4,1,'2017-01-13','11:00:37'),(168,4,2,'2017-01-13','11:01:08'),(169,5,1,'2017-01-14','19:42:19'),(170,5,2,'2017-01-14','19:42:25'),(171,3,1,'2017-01-15','19:25:15');
/*!40000 ALTER TABLE `evidencija` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evidencija_dana`
--

DROP TABLE IF EXISTS `evidencija_dana`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evidencija_dana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `datum` date NOT NULL,
  `done_business_hours` double NOT NULL,
  `vrijeme_dolaska` time NOT NULL,
  `vrijeme_odlaska` time NOT NULL,
  `not_workingId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_38A5CE1F4AA9A495` (`not_workingId`),
  KEY `IDX_38A5CE1FA76ED395` (`user_id`),
  CONSTRAINT `FK_38A5CE1F4AA9A495` FOREIGN KEY (`not_workingId`) REFERENCES `neprisustvo` (`id`),
  CONSTRAINT `FK_38A5CE1FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evidencija_dana`
--

LOCK TABLES `evidencija_dana` WRITE;
/*!40000 ALTER TABLE `evidencija_dana` DISABLE KEYS */;
INSERT INTO `evidencija_dana` VALUES (1,2,'2016-11-11',8,'07:00:00','15:00:00',1),(2,3,'2016-11-11',8,'07:00:00','15:00:00',1),(3,4,'2016-11-11',8,'07:00:00','15:00:00',1),(4,5,'2016-11-11',8,'07:00:00','15:00:00',1),(5,6,'2016-11-11',8,'07:00:00','15:00:00',1),(6,2,'2016-11-12',8,'07:00:00','15:00:00',1),(7,3,'2016-11-12',8,'07:00:00','15:00:00',1),(8,4,'2016-11-12',8,'07:00:00','15:00:00',1),(9,5,'2016-11-12',8,'07:00:00','15:00:00',1),(10,6,'2016-11-12',8,'07:00:00','15:00:00',1),(11,1,'2017-01-05',0.32611111111111,'14:58:13','15:17:47',1),(12,2,'2017-01-05',7.3652777777778,'09:02:20','16:01:10',1),(13,3,'2017-01-05',5.0352777777778,'10:03:11','15:05:18',1),(14,4,'2017-01-05',0,'09:02:20','09:02:20',2),(15,5,'2017-01-05',3.9613888888889,'09:05:44','14:59:00',1),(16,6,'2017-01-05',0,'09:02:20','09:02:20',2),(17,1,'2017-01-06',0,'15:53:20','15:53:20',3),(18,2,'2017-01-06',0,'15:53:20','15:53:20',2),(19,3,'2017-01-06',0,'15:53:20','15:53:20',3),(20,4,'2017-01-06',0,'15:53:20','15:53:20',3),(21,5,'2017-01-06',0,'15:53:20','15:53:20',3),(22,6,'2017-01-06',0,'15:53:20','15:53:20',3),(23,1,'2017-01-09',0,'14:30:36','14:30:36',3),(24,2,'2017-01-09',0.10527777777778,'14:30:36','14:36:55',1),(25,3,'2017-01-09',0,'14:30:36','14:30:36',3),(26,4,'2017-01-09',0,'14:30:36','14:30:36',3),(27,5,'2017-01-09',0,'14:30:36','14:30:36',2),(28,6,'2017-01-09',0,'14:30:36','14:30:36',3),(29,1,'2017-01-10',0,'14:57:07','14:57:07',3),(30,2,'2017-01-10',0,'14:57:07','14:57:07',2),(31,3,'2017-01-10',0,'14:57:07','14:57:07',3),(32,4,'2017-01-10',0,'14:57:07','14:57:07',2),(33,5,'2017-01-10',0.15166666666667,'14:57:07','15:06:13',1),(34,6,'2017-01-10',0,'14:57:07','14:57:07',3),(35,1,'2017-01-11',0,'12:20:22','12:20:22',2),(36,2,'2017-01-11',0,'12:20:22','12:20:22',3),(37,3,'2017-01-11',0,'12:20:22','12:20:22',2),(38,4,'2017-01-11',0,'12:20:22','12:20:22',2),(39,5,'2017-01-11',0,'12:20:22','12:20:22',3),(40,6,'2017-01-11',0,'12:20:22','12:20:22',3),(41,1,'2017-01-12',0,'17:54:54','17:54:54',2),(42,2,'2017-01-12',0,'17:54:54','17:54:54',3),(43,3,'2017-01-12',0,'17:54:54','17:54:54',2),(44,4,'2017-01-12',0,'17:54:54','17:54:54',3),(45,5,'2017-01-12',0,'18:52:35','17:54:54',3),(46,6,'2017-01-12',0,'17:54:54','17:54:54',2),(47,1,'2017-01-13',0,'09:06:17','09:14:52',3),(48,2,'2017-01-13',0,'08:35:51','08:35:51',2),(49,3,'2017-01-13',1.7780555555556,'09:05:53','10:56:00',1),(50,4,'2017-01-13',0,'08:35:51','08:43:28',3),(51,5,'2017-01-13',0,'08:35:51','08:35:51',2),(52,6,'2017-01-13',0,'08:35:51','08:35:51',2),(53,1,'2017-01-14',0,'19:42:19','19:42:19',3),(54,2,'2017-01-14',0,'19:42:19','19:42:19',2),(55,3,'2017-01-14',0,'19:42:19','19:42:19',3),(56,4,'2017-01-14',0,'19:42:19','19:42:19',2),(57,5,'2017-01-14',0.0016666666666667,'19:42:19','19:42:25',1),(58,6,'2017-01-14',0,'19:42:19','19:42:19',2),(59,1,'2017-01-15',0,'19:25:15','19:25:15',3),(60,2,'2017-01-15',0,'19:25:15','19:25:15',2),(61,3,'2017-01-15',0,'19:25:15','19:25:15',2),(62,4,'2017-01-15',0,'19:25:15','19:25:15',3),(63,5,'2017-01-15',7,'19:25:15','19:25:15',1),(64,6,'2017-01-15',0,'19:25:15','19:25:15',2),(65,7,'2017-01-15',0,'19:25:15','19:25:15',3);
/*!40000 ALTER TABLE `evidencija_dana` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_group`
--

DROP TABLE IF EXISTS `fos_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fos_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4B019DDB5E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_group`
--

LOCK TABLES `fos_group` WRITE;
/*!40000 ALTER TABLE `fos_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `fos_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user`
--

LOCK TABLES `fos_user` WRITE;
/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;
INSERT INTO `fos_user` VALUES (1,'admin','admin','admin@gmail.com','admin@gmail.com',1,'lf2yg3q9ayowwsggow4wwgkogcckwck','$2y$13$ymzmn2TbLaeVzPp91XLFt./sHcQXm4LZXqfepqE0I5kKdC4MScy6O','2017-01-16 19:54:38','wp4Hjce8v687ksWiRY6vGv7Q-3kbjQ-evaijEGm-g7A','2016-11-03 17:50:46','a:1:{i:0;s:10:\"ROLE_ADMIN\";}','admin','admin'),(2,'masimo.orbanic','masimo.orbanic','masimo.orbanic@gmai.com','masimo.orbanic@gmai.com',1,'6xpat06anps80w8kcokkk4og84wss08','$2y$13$Ya/hXTqnFGrngaRCIPbJ1uIk8j2eNfdB/q8ApHVOPGBFnmrCaAenW','2017-01-11 16:52:21','gvj57N3bgMgLPqaDTgWx9dlINpjXjOqJArrHM_YvXjM','2016-12-01 17:03:08','a:0:{}','Masimo','Orbanic'),(3,'mihovil.petkovic','mihovil.petkovic','mihovil.petko@gmail.com','mihovil.petko@gmail.com',1,'j5x1sim12coocowcs44kwccswcgoco0','$2y$13$b175PXqh4h3siH6e9he7yenGbERBUmUU2bOMYjZVbxlisxdNZOS/a','2017-01-13 11:00:06',NULL,NULL,'a:0:{}','Mihovil','Peković'),(4,'patrik.grof','patrik.grof','patrik.grofina@unipu.xom','patrik.grofina@unipu.xom',1,'md8r6n0vx80scs0cww48ogc48s0oc4o','$2y$13$bC49BJd.Zo02BvNzmUgrne60DV9mmnxmSESGKsBAYBAt8ZjYsgKEq','2016-11-02 14:27:45',NULL,NULL,'a:0:{}','Patrik','Grof'),(5,'antun.kova','antun.kova','antun.kova@unipu.com','antun.kova@unipu.com',1,'md8r6n0vx80scs0cww48ogc48s0oc4o','$2y$13$bC49BJd.Zo02BvNzmUgrne60DV9mmnxmSESGKsBAYBAt8ZjYsgKEq','2017-01-10 14:55:36',NULL,NULL,'a:0:{}','Antun','Kovacevic'),(6,'marino.peresa','marino.peresa','maperes@unipu.hr','maperes@unipu.hr',1,NULL,'$2y$13$RsIwL2KbPQ8XmL.6w1xDvOzKZCuViNkbz1468.xB0wsA.ZrrD3sKe','2016-12-07 13:16:57',NULL,NULL,'a:0:{}','Marino','Peresa'),(7,'testic','testic','test@test.com','test@test.com',1,NULL,'$2y$13$8fjJbSA6XPZS3mQVW3Fgteik42YCn9S/yYr0jO54a6zyWiPUztcJi',NULL,NULL,NULL,'a:0:{}','Test','Testic');
/*!40000 ALTER TABLE `fos_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user_user_group`
--

DROP TABLE IF EXISTS `fos_user_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fos_user_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `IDX_B3C77447A76ED395` (`user_id`),
  KEY `IDX_B3C77447FE54D947` (`group_id`),
  CONSTRAINT `FK_B3C77447A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`),
  CONSTRAINT `FK_B3C77447FE54D947` FOREIGN KEY (`group_id`) REFERENCES `fos_group` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user_user_group`
--

LOCK TABLES `fos_user_user_group` WRITE;
/*!40000 ALTER TABLE `fos_user_user_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `fos_user_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `neprisustvo`
--

DROP TABLE IF EXISTS `neprisustvo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `neprisustvo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `neprisustvo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `neprisustvo`
--

LOCK TABLES `neprisustvo` WRITE;
/*!40000 ALTER TABLE `neprisustvo` DISABLE KEYS */;
INSERT INTO `neprisustvo` VALUES (1,'Prisutan'),(2,'Dnevni odmor'),(3,'Tjedni odmor'),(4,'Godišnji odmor'),(5,'Blagdan /neradni dan'),(6,'Bolovanje'),(7,'Dopust - rodiljni /roditeljski'),(8,'Dr. roditeljska prava'),(9,'Plaćeni dopust'),(10,'Neplaćeni dopust'),(11,'Po zahtjevu radnika'),(12,'Krivnjom radnika'),(13,'Zbog štrajka'),(14,'Zbog isključenja s rada');
/*!40000 ALTER TABLE `neprisustvo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `razlog`
--

DROP TABLE IF EXISTS `razlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `razlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razlog` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `razlog`
--

LOCK TABLES `razlog` WRITE;
/*!40000 ALTER TABLE `razlog` DISABLE KEYS */;
INSERT INTO `razlog` VALUES (1,'dolazak'),(2,'odlazak'),(3,'pauza'),(4,'terenski rad'),(5,'privatni izlazak'),(6,'ostalo');
/*!40000 ALTER TABLE `razlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_user`
--

DROP TABLE IF EXISTS `tag_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_tag` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_user`
--

LOCK TABLES `tag_user` WRITE;
/*!40000 ALTER TABLE `tag_user` DISABLE KEYS */;
INSERT INTO `tag_user` VALUES (1,1,'adscew',0),(2,1,'044af052d84980',0),(3,2,'qwd11we',0),(4,3,'4f847108',0),(5,3,'weer2232',0),(6,4,'313233343536',0),(7,5,'587bc047e3997',1),(8,7,'bezveze',0);
/*!40000 ALTER TABLE `tag_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-17 14:34:44
