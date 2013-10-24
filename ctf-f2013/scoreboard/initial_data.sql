-- MySQL dump 10.11
--
-- Host: mysql-user    Database: mchow
-- ------------------------------------------------------
-- Server version	5.0.95-log

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
-- Current Database: `mchow`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `mchow` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mchow`;

--
-- Table structure for table `ctf_flags`
--

DROP TABLE IF EXISTS `ctf_flags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ctf_flags` (
  `id` int(11) NOT NULL auto_increment,
  `flag` text NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ctf_flags`
--

LOCK TABLES `ctf_flags` WRITE;
/*!40000 ALTER TABLE `ctf_flags` DISABLE KEYS */;
INSERT INTO `ctf_flags` VALUES (1,'key{18e9d8d92b4c6342ffd51de9934b69223c312b51}',100),(2,'key{dc76ee78430d2982026f8364dbccb5755f6d5561}',100),(3,'key{b220a91e7eab10fde8677c149829fee7ef6b6758}',300),(4,'key{ee16dd465865e2233c2e715f11ef3caf4ac79c03}',200),(5,'key{2645e286540c44f4bac5f648dfe301c81dcfbff7}',200),(6,'key{8aace50bc0675c767c949fea6ae483a5212a739d}',300),(7,'key{d21f5c37658648250bfbb22824a337174ced3161}',200),(8,'key{04e3895d689bbbe88f80021e3a8428eb3b626b6f}',100);
/*!40000 ALTER TABLE `ctf_flags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ctf_scoreboard`
--

DROP TABLE IF EXISTS `ctf_scoreboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ctf_scoreboard` (
  `id` int(11) NOT NULL auto_increment,
  `team_number` int(11) NOT NULL,
  `flag_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `added_on` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ctf_scoreboard`
--

LOCK TABLES `ctf_scoreboard` WRITE;
/*!40000 ALTER TABLE `ctf_scoreboard` DISABLE KEYS */;
/*!40000 ALTER TABLE `ctf_scoreboard` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 22:02:34
