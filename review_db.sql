-- MySQL dump 10.13  Distrib 5.1.69, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: review_db
-- ------------------------------------------------------
-- Server version	5.1.69

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cates`
--

LOCK TABLES `cates` WRITE;
/*!40000 ALTER TABLE `cates` DISABLE KEYS */;
INSERT INTO `cates` VALUES (1,'パグ',0),(2,'コリー',0),(3,'ブルドック',0),(4,'シェットランドシープドッグ',0);
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
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,1,'このパグはかわいすぎだ！','2013-09-15 14:56:03',0),(2,1,8,'結婚できない男のケンちゃんです。','2013-10-14 16:55:03',0),(3,1,10,'test','2013-11-16 10:08:39',0),(4,1,10,'aaa','2013-11-16 10:16:13',0),(5,1,10,'hoge','2013-11-16 10:21:45',0),(6,1,10,'aaaaaaa','2013-11-16 10:24:01',0),(7,1,10,'fafaege','2013-11-16 10:31:37',0),(8,1,10,'あああああああああああああああああ','2013-11-16 10:38:54',0),(9,1,10,'ありあり','2013-11-16 10:41:06',0),(10,1,7,'aa','2013-11-16 10:45:31',0),(11,1,7,'agege','2013-11-16 11:06:52',0),(12,1,7,'gege','2013-11-16 11:06:57',0),(13,1,7,'fafdafda','2013-11-16 11:07:23',0),(14,1,7,'gege','2013-11-16 11:09:37',0),(15,1,7,'gegegehe','2013-11-16 11:09:55',0),(16,1,7,'agegege','2013-11-16 11:13:55',0),(17,1,7,'fafeefe','2013-11-16 11:14:27',0),(18,1,7,'feege','2013-11-16 11:23:06',0),(19,1,7,'fefejiojefo','2013-11-16 11:24:29',0),(20,1,7,'egege','2013-11-16 11:25:37',0),(21,1,7,'fafefe','2013-11-16 11:28:01',0),(22,1,7,'ffe','2013-11-16 11:29:08',0),(23,1,3,'tete','2013-11-16 11:33:16',0),(24,1,3,'test','2013-11-30 01:33:41',0),(25,1,7,'test','2013-12-15 14:19:24',0),(26,1,7,'aa','2013-12-15 14:20:43',0),(27,1,10,'hujhu','2013-12-15 15:58:31',0),(28,1,10,'かわいい','2013-12-23 16:23:08',0),(29,1,10,'test','2013-12-27 12:41:27',0);
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
  `comment_count` int(11) DEFAULT '0',
  `counter` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `delete_flg` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,1,'黒パグ','かわいいパグ犬です。','1379224522_001.jpeg','1379224522_002.jpeg',NULL,1,1,22,'2013-09-15 14:55:22',0),(2,1,'パグ2','さらにかわいいパグ','1379225201_001.jpeg',NULL,NULL,1,0,30,'2013-09-15 15:06:41',0),(3,1,'黒パグ3','test','1379733036_001.jpeg','1379733036_002.jpeg',NULL,1,2,25,'2013-09-21 12:10:36',0),(9,1,'こつぶ２','結婚できない男に登場するパグ犬。\r\n役名はケンちゃん','1381738009_001.jpeg',NULL,NULL,1,0,4,'2013-10-14 17:06:49',0),(8,1,'こつぶ','結婚できない男に登場','1381737229_001.jpeg',NULL,NULL,1,1,9,'2013-10-14 16:53:49',0),(6,1,'fefe','て','1379734775_001.jpeg',NULL,NULL,1,0,8,'2013-09-21 12:39:35',0),(7,1,'パグ犬','テスト','1379734824_001.jpeg','1379734824_002.jpeg','1379734824_003.jpeg',1,15,77,'2013-09-21 12:40:24',0),(10,1,'シェットランドシープドッグ','昔飼ってた犬の種類','1381739068_001.jpeg',NULL,NULL,4,10,50,'2013-10-14 17:24:28',0);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items_tags`
--

DROP TABLE IF EXISTS `items_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items_tags` (
  `item_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`item_id`,`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items_tags`
--

LOCK TABLES `items_tags` WRITE;
/*!40000 ALTER TABLE `items_tags` DISABLE KEYS */;
INSERT INTO `items_tags` VALUES (1,1),(2,1),(2,2),(3,1),(8,3),(9,3),(10,1);
/*!40000 ALTER TABLE `items_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'美犬'),(2,'キュート'),(3,'かわいい');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usermanagements`
--

DROP TABLE IF EXISTS `usermanagements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usermanagements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` varchar(10) DEFAULT NULL,
  `action` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `permit_flg` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usermanagements`
--

LOCK TABLES `usermanagements` WRITE;
/*!40000 ALTER TABLE `usermanagements` DISABLE KEYS */;
INSERT INTO `usermanagements` VALUES (1,'items','add','admin',1),(2,'items','add','member',1),(3,'items','add','guest',0),(4,'items','index','admin',1),(5,'items','index','member',1),(6,'items','index','guest',1),(7,'items','userinfo','admin',1),(8,'items','userinfo','member',1),(9,'items','userinfo','guest',1),(10,'items','useritem','admin',1),(11,'items','useritem','member',1),(12,'items','useritem','guest',1),(13,'items','view','admin',1),(14,'items','view','member',1),(15,'items','view','guest',1),(16,'items','edit','admin',1),(17,'items','edit','member',0),(18,'items','edit','guest',0),(19,'items','delete','admin',1),(20,'items','delete','member',0),(21,'items','delete','guest',0),(22,'comments','index','admin',1),(23,'comments','index','member',1),(24,'comments','index','guest',1),(25,'comments','add','admin',1),(26,'comments','add','member',1),(27,'comments','add','guest',0),(28,'comments','edit','admin',1),(29,'comments','edit','member',0),(30,'comments','edit','guest',0),(31,'comments','delete','admin',1),(32,'comments','delete','member',0),(33,'comments','delete','guest',0),(34,'userinfos','index','admin',1),(35,'userinfos','index','member',0),(36,'userinfos','index','guest',0),(37,'userinfos','add','admin',1),(38,'userinfos','add','member',1),(39,'userinfos','add','guest',0),(40,'userinfos','edit','admin',1),(41,'userinfos','edit','member',1),(42,'userinfos','edit','guest',0),(43,'userinfos','view','admin',1),(44,'userinfos','view','member',1),(45,'userinfos','delete','view',0),(46,'userinfos','personal','admin',1),(47,'userinfos','personal','member',1),(48,'userinfos','personal','guest',0);
/*!40000 ALTER TABLE `usermanagements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` varchar(30) NOT NULL,
  `yourname` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `status` varchar(10) DEFAULT 'guest',
  `session_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'umanari145@gmail.com','のりお','ab267f06443b6b9be778d6e6c439efa43799ce7e','member','84lk4ahu2euapmn1ubrceclvq1'),(2,'info@kourinnet.co.jp','kourin_user','ab267f06443b6b9be778d6e6c439efa43799ce7e','guest','9euu7cqk260u2gkagp4bhormo0'),(3,'hrhrh','kourin_user','ab267f06443b6b9be778d6e6c439efa43799ce7e','guest','9euu7cqk260u2gkagp4bhormo0'),(4,'matsumoto@sunny-gems.jp','kourin_user','ab267f06443b6b9be778d6e6c439efa43799ce7e','guest','5gvnjftras412t1bplug8evv81'),(5,'matsumoto@sunny-gem.jp','kourin_user','ab267f06443b6b9be778d6e6c439efa43799ce7e','guest','5gvnjftras412t1bplug8evv81'),(6,'matsumoto@dt30.net','kourin_user','ab267f06443b6b9be778d6e6c439efa43799ce7e','guest','5gvnjftras412t1bplug8evv81');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` varchar(50) NOT NULL,
  `item_id` int(11) NOT NULL,
  `vote_point` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votes`
--

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `votes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-10 22:27:20
