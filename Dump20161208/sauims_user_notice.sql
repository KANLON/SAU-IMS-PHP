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
-- Table structure for table `user_notice`
--

DROP TABLE IF EXISTS `user_notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_notice` (
  `user_id` int(11) NOT NULL,
  `notice_id` int(11) NOT NULL,
  `delete` tinyint(4) NOT NULL DEFAULT '0',
  `read` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`notice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_notice`
--

LOCK TABLES `user_notice` WRITE;
/*!40000 ALTER TABLE `user_notice` DISABLE KEYS */;
INSERT INTO `user_notice` VALUES (1,3,1,0),(1,4,1,1),(1,29,0,0),(1,30,0,0),(1,31,0,0),(1,32,0,0),(1,33,0,0),(1,34,0,0),(1,35,0,0),(1,36,0,0),(1,37,0,0),(1,38,0,0),(1,52,0,0),(1,53,0,0),(1,55,0,0),(1,56,0,0),(1,57,0,0),(1,58,0,0),(1,59,0,0),(1,60,0,0),(1,61,0,0),(1,62,0,0),(1,63,0,0),(1,64,0,0),(1,65,0,0),(1,66,0,0),(1,69,0,0),(1,70,0,0),(1,71,0,0),(2,29,0,0),(2,30,0,0),(2,31,0,0),(2,32,0,0),(2,33,0,0),(2,34,0,0),(2,35,0,0),(2,36,0,0),(2,37,0,0),(2,38,0,0),(2,52,0,0),(2,53,0,0),(2,55,0,0),(2,56,0,0),(2,57,0,0),(2,58,0,0),(2,59,0,0),(2,60,0,0),(2,61,0,0),(2,62,0,0),(2,63,0,0),(2,64,0,0),(2,65,0,0),(2,66,0,0),(2,69,0,0),(2,70,0,0),(2,71,0,0);
/*!40000 ALTER TABLE `user_notice` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-08 18:02:15
