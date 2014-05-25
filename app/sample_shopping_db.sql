-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: sample_shopping_db
-- ------------------------------------------------------
-- Server version	5.5.16

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
-- Table structure for table `cates`
--

DROP TABLE IF EXISTS `cates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cate` varchar(20) DEFAULT NULL,
  `delete_flg` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cates`
--

LOCK TABLES `cates` WRITE;
/*!40000 ALTER TABLE `cates` DISABLE KEYS */;
INSERT INTO `cates` VALUES (1,'野菜',0),(2,'果物',0),(3,'飲料',0);
/*!40000 ALTER TABLE `cates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `delete_flg` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,5,'gafgf','2014-05-17 11:02:01',0),(2,1,12,'fdasfas','2014-05-18 12:19:58',0),(3,1,12,'おいしそうなブドウですね','2014-05-18 12:20:20',0),(4,1,12,'とてもおいしそうなブドウですね。','2014-05-18 12:24:58',0),(5,1,12,'すばらしくおいしそうなブドウですね。','2014-05-18 12:25:26',0),(6,1,12,'テスト','2014-05-18 12:25:38',0),(7,1,12,'例の局プリーズ','2014-05-18 12:32:49',0),(8,1,12,'ｆだｓ','2014-05-18 12:37:53',0),(9,1,0,'ｊふぉｄさｊふぉｓ','2014-05-18 12:44:18',0),(10,1,12,'じょてｊとえ','2014-05-18 12:45:42',0),(11,1,17,'honjituhaseitenari','2014-05-23 19:33:43',0),(12,1,15,'gyug','2014-05-24 18:01:35',0);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `body` text NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `image2` varchar(100) DEFAULT NULL,
  `image3` varchar(100) DEFAULT NULL,
  `cate_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `delete_flg` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,1,'ぶどう','現在日本で栽培されているものは、明治時代以降に導入されたもの。病害抵抗性、食味、収量などの点から品種改良が加えられる。','1400289652_001.jpeg',NULL,NULL,2,'2014-05-17 10:20:52',0),(2,1,'ぶどう','現在日本で栽培されているものは、明治時代以降に導入されたもの。病害抵抗性、食味、収量などの点から品種改良が加えられる。','1400289699_001.jpeg',NULL,NULL,2,'2014-05-17 10:21:39',0),(3,1,'ぶどう','現在日本で栽培されているものは、明治時代以降に導入されたもの。病害抵抗性、食味、収量などの点から品種改良が加えられる。','1400289801_001.jpeg',NULL,NULL,2,'2014-05-17 10:23:21',0),(4,1,'ぶどう','現在日本で栽培されているものは、明治時代以降に導入されたもの。病害抵抗性、食味、収量などの点から品種改良が加えられる。','1400289923_001.jpeg',NULL,NULL,2,'2014-05-17 10:25:23',0),(5,1,'ぶどう','現在日本で栽培されているものは、明治時代以降に導入されたもの。病害抵抗性、食味、収量などの点から品種改良が加えられる。','1400290547_001.jpeg',NULL,NULL,2,'2014-05-17 10:35:47',0),(6,0,'たまねぎ','染色体数は2n=16。生育適温は20℃前後で、寒さには強く氷点下でも凍害はほとんど見られないが、25℃以上の高温では生育障害が起こる。','1400376332_001.jpeg',NULL,NULL,1,'2014-05-18 10:25:32',0),(7,0,'にんじん','細長い東洋系品種と、太く短い西洋系品種の2種類に大別され、ともに古くから薬や食用としての栽培が行われてきた。','1400376375_001.jpeg',NULL,NULL,1,'2014-05-18 10:26:15',0),(8,0,'ピーマン','ピーマン自体はトウガラシの品種の一つであり、果実は肉厚でカプサイシンを含まない。','1400376413_001.jpeg',NULL,NULL,1,'2014-05-18 10:26:53',0),(9,1,'なす','世界の各地で独自の品種が育てられている。加賀茄子などの一部例外もあるが日本においては南方ほど長実または大長実で、北方ほど小実品種となる。','1400376650_001.jpeg',NULL,NULL,1,'2014-05-18 10:30:50',0),(10,1,'みかん','日本の代表的な果物で、バナナのように、素手で容易に果皮をむいて食べることができるため、冬になれば炬燵の上にミカンという光景が一般家庭に多く見られる。','1400376686_001.jpeg',NULL,NULL,2,'2014-05-18 10:31:26',0),(11,1,'りんご','現在日本で栽培されているものは、明治時代以降に導入されたもの。病害抵抗性、食味、収量などの点から品種改良が加えられる。','1400376717_001.jpeg',NULL,NULL,2,'2014-05-18 10:31:57',0),(12,1,'ぶどう','葉は両側に切れ込みのある15 - 20cmほどの大きさで、穂状の花をつける。','1400376754_001.jpeg',NULL,NULL,2,'2014-05-18 10:32:34',0),(13,1,'いちご','イチゴとして流通しているものは、ほぼ全てオランダイチゴである。','1400376784_001.jpeg',NULL,NULL,2,'2014-05-18 10:33:04',0),(14,1,'コーラ','複数あるコーラ飲料製造社ではこれらの香味料以外にその会社独自の香味料を加えることで独自の製品として開発している。','1400376824_001.jpeg',NULL,NULL,3,'2014-05-18 10:33:44',0),(15,1,'カルピス','企業としてのカルピスの創業者は、僧侶出身の三島海雲。創業初期は国分グループだった。','1400376858_001.jpeg',NULL,NULL,3,'2014-05-18 10:34:18',0),(16,1,'ウーロン茶','烏龍茶（ウーロンちゃ）は、中国茶のうち青茶（せいちゃ、あおちゃ）と分類され、茶葉を発酵途中で加熱して発酵を止め、半発酵させた茶である。','1400376901_001.jpeg',NULL,NULL,3,'2014-05-18 10:35:01',0),(17,1,'ミネラルウォーター','ミネラルウォーター（Mineral water）とは、容器入り飲料水のうち、地下水を原水とするものを言う。','1400376930_001.jpeg',NULL,NULL,3,'2014-05-18 10:35:30',0);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `delete_flg` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-25  9:55:00
