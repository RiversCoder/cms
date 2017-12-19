-- MySQL dump 10.13  Distrib 5.7.14, for Win32 (AMD64)
--
-- Host: localhost    Database: cmss
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `cms_level`
--

DROP TABLE IF EXISTS `cms_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_level` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '等级编号',
  `level_name` varchar(20) NOT NULL COMMENT '等级名称',
  `level_info` varchar(200) NOT NULL COMMENT '等级信息',
  `premission` varchar(200) NOT NULL DEFAULT '0' COMMENT '权限',
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_level`
--

LOCK TABLES `cms_level` WRITE;
/*!40000 ALTER TABLE `cms_level` DISABLE KEYS */;
INSERT INTO `cms_level` VALUES (1,'普通管理员','就是normal管理员的意思呀','0',5),(2,'超级管理员','就是super管理员的意思呀','0',6),(3,'发帖专员','只能对帖子进行管理的专员','0',3),(4,'评论专员','只能对评论进行管理的专员','0',4),(5,'会员专员','会员专员','0',2),(6,'后台游客','后台游客','0',1);
/*!40000 ALTER TABLE `cms_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_manage`
--

DROP TABLE IF EXISTS `cms_manage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_manage` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `admin_user` varchar(20) NOT NULL COMMENT '管理员账号',
  `admin_pas` char(40) NOT NULL COMMENT '管理员密码',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '管理员等级',
  `login_count` smallint(5) NOT NULL DEFAULT '1' COMMENT '登陆次数',
  `last_ip` varchar(20) NOT NULL DEFAULT '000.000.000.000' COMMENT '最后一次登录',
  `last_time` datetime NOT NULL DEFAULT '2017-12-12 12:12:12' COMMENT '最后一次登陆时间',
  `reg_time` datetime NOT NULL COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_manage`
--

LOCK TABLES `cms_manage` WRITE;
/*!40000 ALTER TABLE `cms_manage` DISABLE KEYS */;
INSERT INTO `cms_manage` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3',6,1,'000.000.000.000','2010-01-12 00:00:00','2011-12-12 00:00:00'),(2,'大家好哈','1234567890',1,1,'000.000.000.000','2010-01-12 00:00:00','2011-12-12 00:00:00'),(3,'哈哈哈','123456',3,1,'000.000.000.000','2010-01-12 13:45:12','2011-12-12 22:12:14'),(4,'樱木花道','',3,1,'000.000.000.000','2017-12-18 15:37:38','2017-12-08 15:36:09'),(5,'鸣人','63a9f0ea7bb98050796b649e85481845',3,1,'000.000.000.000','2017-12-18 15:37:38','2017-12-08 15:36:09'),(6,'动感超人','dongganchaoren',3,1,'000.000.000.000','2017-12-12 12:12:12','2017-12-19 15:04:05'),(8,'泰罗奥特曼','e10adc3949ba59abbe56e057f20f883e',6,1,'000.000.000.000','2017-12-12 12:12:12','2017-12-19 15:58:06'),(9,'猪猪侠','e10adc3949ba59abbe56e057f20f883e',6,1,'000.000.000.000','2017-12-12 12:12:12','2017-12-19 16:14:25');
/*!40000 ALTER TABLE `cms_manage` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-20  0:13:21
