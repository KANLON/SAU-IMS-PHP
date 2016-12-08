CREATE DATABASE  IF NOT EXISTS `sauims` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sauims`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: sauims
-- ------------------------------------------------------
-- Server version	5.7.16-log

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
-- Table structure for table `notice`
--

DROP TABLE IF EXISTS `notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(60) NOT NULL,
  `right` int(11) NOT NULL DEFAULT '0',
  `club_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notice`
--

LOCK TABLES `notice` WRITE;
/*!40000 ALTER TABLE `notice` DISABLE KEYS */;
INSERT INTO `notice` VALUES (3,'啊第三方反反复复反反复复反反复复吩咐','2016-11-27 04:03:47','厄尔',0,1),(4,'搜索','2016-11-27 04:03:51','嗖嗖嗖',0,2),(5,'鹅鹅鹅','2016-11-27 04:03:48','轻轻巧巧',0,1),(6,'333','2016-11-27 04:03:52','二万人',0,1),(8,'<?php\r\n\r\nrequire \"../framework/ModelFactory.php\";\r\n<?php\r\n\r\nrequire \"../framework/ModelFactory.php\";\r\n<?php\r\n\r\nrequire \"../framework/ModelFactory.php\";\r\n<?php\r\n\r\nrequire \"../framework/ModelFactory.php\";\r\n<?php\r\n\r\nrequire \"../framework/ModelFactory.php\";\r\n','2016-11-27 04:03:53','大妈',0,1),(9,'22','2016-11-27 04:03:55','2',0,2),(10,'we','2016-11-27 04:03:56','2e',0,2),(11,'23','2016-11-27 04:03:58','2',0,2),(14,'text','2016-11-11 03:11:11','title',0,1),(16,'text','2016-11-11 03:11:11','title',0,1),(17,'text','2016-11-11 03:11:11','title',0,1),(18,'text','2016-11-11 03:11:11','title',0,1),(19,'text','2016-11-11 03:11:11','title',0,1),(20,'text','2016-11-11 03:11:11','title',0,1),(21,'text','2016-11-11 03:11:11','title',0,1),(22,'text','2016-11-11 03:11:11','title',0,1),(23,'text','2016-11-11 03:11:11','title',0,1),(24,'text','2016-11-11 03:11:11','title',0,1),(25,'text','2016-11-11 03:11:11','title',0,1),(26,'text','2016-11-11 03:11:11','title',0,1),(27,'text','2016-11-11 03:11:11','title',0,1),(28,'text','2016-11-11 03:11:11','title',0,1),(29,'text','2016-11-11 03:11:11','title',0,1),(30,'text','2016-11-11 03:11:11','title',0,1),(31,'text','2016-11-11 03:11:11','title',0,1),(32,'text','2016-11-11 03:11:11','title',0,1),(33,'text','2016-11-11 03:11:11','title',0,1),(34,'text','2016-11-11 03:11:11','title',0,1),(35,'text','2016-11-11 03:11:11','title',0,1),(36,'各位社长、成员、同学们：<br>adadaddasd<br>','2016-12-07 11:01:36','lalal',0,1),(37,'各位社长、成员、同学们：<div><br></div><div>asdasd</div>','2016-12-07 12:26:04','fsfdsf',0,1),(38,'各位社长、成员、同学们： <br>     evetbox is ppap<br><br>','2016-12-07 13:05:27','test',0,1),(52,'各位社长、成员、同学们：','2016-12-07 15:01:28','一撒',0,1),(53,'各位社长、成员、同学们：','2016-12-07 15:01:59','一撒',0,1),(55,'各位社长、成员、同学们：','2016-12-07 15:02:08','一撒',0,1),(56,'各位社长、成员、同学们：','2016-12-07 15:02:12','一撒',0,1),(57,'各位社长、成员、同学们：','2016-12-07 15:02:15','一撒',0,1),(58,'各位社长、成员、同学们：','2016-12-07 15:02:19','一撒',0,1),(59,'各位社长、成员、同学们：','2016-12-07 15:02:22','一撒',0,1),(60,'各位社长、成员、同学们：','2016-12-07 15:02:25','一撒',0,1),(61,'各位社长、成员、同学们：','2016-12-07 15:02:28','一撒',0,1),(62,'各位社长、成员、同学们：','2016-12-07 15:02:31','一撒',0,1),(63,'各位社长、成员、同学们：','2016-12-07 15:02:37','一撒',0,1),(64,'各位社长、成员、同学们：','2016-12-07 15:02:41','一撒',0,1),(65,'各位社长、成员、同学们：','2016-12-07 15:02:48','一撒',0,1),(66,'各位社长、成员、同学们：','2016-12-07 15:02:52','一撒',0,1),(69,'gdfgdfg<br>','2016-12-08 07:53:02','dfgdfgf',0,1),(70,'各位社长、成员、同学们：rererere','2016-12-08 07:55:12','rererer',0,1),(71,'各位社长、成员、同学们：<br>sdgsdgdsgdsgsgsgsdgsd<br>','2016-12-08 07:57:02','gdggdfg',0,1);
/*!40000 ALTER TABLE `notice` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-08 18:02:14
