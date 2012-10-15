-- MySQL dump 10.13  Distrib 5.1.61, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: board
-- ------------------------------------------------------
-- Server version	5.1.61-0ubuntu0.11.10.1

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
-- Current Database: `board`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `board` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `board`;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `post` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'New Board','We have migrated to a new server and host. Enjoy! <strong>Please read Rule 34.</strong> Thank you!',1,'2012-03-25 17:04:44'),(2,'Rule #34','<img src=\"http://imgs.xkcd.com/comics/rule_34.png\" alt=\"Rule #34\" />',1,'2012-03-25 17:06:10'),(3,'MOAR!','This works...',0,'2012-03-25 17:37:12'),(4,'XSS','<script>alert(\'XSS\')</script>',0,'2012-03-25 17:38:38'),(5,'Let\'s play a game','<img src=\"http://www.reece-eu.net/gallery/var/albums/funny/i-raff-i-ruse.jpg\" />',1,'2012-03-25 17:45:03'),(6,'Ask someone from ManchVegas anything...','	\r\nAlternative name for the city of Manchester, New Hampshire, USA. The word was coined by combining the first part of \"Manchester\" with the second word in \"Las Vegas,\" juxtaposing Las Vegas\'s glitz and glamor with Manchester\'s lack of either. Used derisively. --from http://www.urbandictionary.com/define.php?term=Manch-Vegas',1,'2012-03-25 17:50:05'),(7,'Homer','<iframe width=\"560\" height=\"315\" src=\"http://www.youtube.com/embed/o46NoIWNiGI\" frameborder=\"0\" allowfullscreen></iframe>',1,'2012-03-25 18:17:47'),(-1,'FLAG','FLAG: Monkees',0,'2012-03-25 18:21:24'),(8,'Frogger','<a href=\"/frogger\">Did you play Frogger yet?</a>',0,'2012-03-25 18:22:05');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `replies`
--

DROP TABLE IF EXISTS `replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `replies` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `comments` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  `post_id` int(9) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `replies`
--

LOCK TABLES `replies` WRITE;
/*!40000 ALTER TABLE `replies` DISABLE KEYS */;
INSERT INTO `replies` VALUES (1,'Nice!',1,5,'2012-03-25 18:09:49'),(2,'<img src=\"http://s1.static.gotsmile.net/images/2010/10/07/moar_please.jpg_1286415075.jpg\"/>',1,5,'2012-03-25 18:10:05'),(3,'WUT?',1,2,'2012-03-25 18:10:50'),(4,'<img src=\"http://s-ak.buzzfed.com/static/enhanced/web02/2010/3/12/9/enhanced-buzz-10323-1268404008-10.jpg\" />',1,5,'2012-03-25 18:15:16'),(5,'<img src=\"http://3.bp.blogspot.com/_mmBw3uzPnJI/SC6sw74H5DI/AAAAAAAANUw/xRK8HscCc1U/s400/owned_62.jpg\"/>',1,5,'2012-03-25 18:16:11'),(6,'Did you see that, they called me.........................................................SLOW!',1,7,'2012-03-25 18:18:30');
/*!40000 ALTER TABLE `replies` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-03-25 18:35:44
