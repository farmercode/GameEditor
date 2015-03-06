/*
SQLyog Enterprise - MySQL GUI v8.13 Beta1
MySQL - 5.6.19-1~exp1ubuntu2 : Database - game_tool
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`game_tool` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `game_tool`;

/*Table structure for table `t_atlasloot` */

DROP TABLE IF EXISTS `t_atlasloot`;

CREATE TABLE `t_atlasloot` (
  `a_id` int(20) NOT NULL AUTO_INCREMENT,
  `atlasloot_id` int(11) DEFAULT NULL COMMENT '掉落id',
  `atlasloot_name` varchar(500) DEFAULT NULL COMMENT '掉落名称',
  `atlasloot_num` int(11) DEFAULT NULL COMMENT '掉落数量,1表示从后面掉落中按照概率抽取一个',
  `content` text COMMENT '掉落详尽',
  `data` text COMMENT '序列换掉落信息',
  `game` tinyint(4) DEFAULT NULL COMMENT '所属游戏',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `t_atlasloot` */

/*Table structure for table `t_games` */

DROP TABLE IF EXISTS `t_games`;

CREATE TABLE `t_games` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_name` varchar(500) DEFAULT NULL COMMENT '游戏名称',
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `t_games` */

insert  into `t_games`(`g_id`,`game_name`) values (1,'三国英雄');

/*Table structure for table `t_lootbase` */

DROP TABLE IF EXISTS `t_lootbase`;

CREATE TABLE `t_lootbase` (
  `auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `loot_id` int(11) DEFAULT NULL COMMENT '物品ID',
  `loot_name` varchar(500) DEFAULT NULL COMMENT '掉落名称',
  `loot_type` tinyint(4) DEFAULT NULL COMMENT '掉落类型',
  `img_info` varchar(500) DEFAULT NULL COMMENT '图片信息,json类型',
  PRIMARY KEY (`auto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;

/*Data for the table `t_lootbase` */

insert  into `t_lootbase`(`auto_id`,`loot_id`,`loot_name`,`loot_type`,`img_info`) values (1,1001,'青铜剑',4,'/Public/EquipIcon/zb_1001.jpg'),(2,1002,'大剑',4,'/Public/EquipIcon/zb_1002.jpg'),(3,1003,'单钩枪',4,'/Public/EquipIcon/zb_1003.jpg'),(4,1004,'流星锤',4,'/Public/EquipIcon/zb_1004.jpg'),(5,1005,'锐钢爪',4,'/Public/EquipIcon/zb_1005.jpg'),(6,1006,'东胡飞弓',4,'/Public/EquipIcon/zb_1006.jpg'),(7,1007,'双睛斩',4,'/Public/EquipIcon/zb_1007.jpg'),(8,1008,'霸道逆鳞枪',4,'/Public/EquipIcon/zb_1008.jpg'),(9,1009,'赤夜破城刀',4,'/Public/EquipIcon/zb_1009.jpg'),(10,1010,'月华戟',4,'/Public/EquipIcon/zb_1010.jpg'),(11,1011,'神鬼戟',4,'/Public/EquipIcon/zb_1011.jpg'),(12,1012,'罗刹斧',4,'/Public/EquipIcon/zb_1012.jpg'),(13,1013,'孔雀翎',4,'/Public/EquipIcon/zb_1013.jpg'),(14,1014,'神龙双牙',4,'/Public/EquipIcon/zb_1014.jpg'),(15,1015,'护国五色扇',4,'/Public/EquipIcon/zb_1015.jpg'),(16,1016,'破军断魂枪',4,'/Public/EquipIcon/zb_1016.jpg'),(17,1041,'GM武器（攻击）',4,'/Public/EquipIcon/zb_1041.jpg'),(18,2001,'青铜盔',4,'/Public/EquipIcon/zb_2001.jpg'),(19,2002,'貂皮帽',4,'/Public/EquipIcon/zb_2002.jpg'),(20,2003,'灵羽帽',4,'/Public/EquipIcon/zb_2003.jpg'),(21,2004,'金枝冠',4,'/Public/EquipIcon/zb_2004.jpg'),(22,2005,'焰鹊盔',4,'/Public/EquipIcon/zb_2005.jpg'),(23,2006,'鎏金冠',4,'/Public/EquipIcon/zb_2006.jpg'),(24,2007,'玄武冠',4,'/Public/EquipIcon/zb_2007.jpg'),(25,2008,'霸道云龙冠',4,'/Public/EquipIcon/zb_2008.jpg'),(26,2009,'赤夜追风冠',4,'/Public/EquipIcon/zb_2009.jpg'),(27,2010,'毒龙冠',4,'/Public/EquipIcon/zb_2010.jpg'),(28,2011,'无畏面罩',4,'/Public/EquipIcon/zb_2011.jpg'),(29,2012,'寒玉龙巾',4,'/Public/EquipIcon/zb_2012.jpg'),(30,2013,'暗焱盔',4,'/Public/EquipIcon/zb_2013.jpg'),(31,2014,'玄魔盔',4,'/Public/EquipIcon/zb_2014.jpg'),(32,2015,'护国镇军盔',4,'/Public/EquipIcon/zb_2015.jpg'),(33,2016,'破军紫气盔',4,'/Public/EquipIcon/zb_2016.jpg'),(34,2041,'GM头盔（生命）',4,'/Public/EquipIcon/zb_2041.jpg'),(35,3001,'铜狮甲',4,'/Public/EquipIcon/zb_3001.jpg'),(36,3002,'锦蟒袍',4,'/Public/EquipIcon/zb_3002.jpg'),(37,3003,'金环甲',4,'/Public/EquipIcon/zb_3003.jpg'),(38,3004,'百炼甲',4,'/Public/EquipIcon/zb_3004.jpg'),(39,3005,'八荒披风',4,'/Public/EquipIcon/zb_3005.jpg'),(40,3006,'锁环甲',4,'/Public/EquipIcon/zb_3006.jpg'),(41,3007,'墨玉甲',4,'/Public/EquipIcon/zb_3007.jpg'),(42,3008,'霸道荆棘铠',4,'/Public/EquipIcon/zb_3008.jpg'),(43,3009,'赤夜紫金甲',4,'/Public/EquipIcon/zb_3009.jpg'),(44,3010,'英雄铠甲',4,'/Public/EquipIcon/zb_3010.jpg'),(45,3011,'雀翎铠',4,'/Public/EquipIcon/zb_3011.jpg'),(46,3012,'三才披风',4,'/Public/EquipIcon/zb_3012.jpg'),(47,3013,'月轮战甲',4,'/Public/EquipIcon/zb_3013.jpg'),(48,3014,'黄帝精金甲',4,'/Public/EquipIcon/zb_3014.jpg'),(49,3015,'护国讨逆铠',4,'/Public/EquipIcon/zb_3015.jpg'),(50,3016,'破军皇龙铠',4,'/Public/EquipIcon/zb_3016.jpg'),(51,3041,'GM战甲（物防）',4,'/Public/EquipIcon/zb_3041.jpg'),(52,3042,'GM战甲（法防）',4,'/Public/EquipIcon/zb_3042.jpg'),(53,4001,'礼记（法抗）',4,'/Public/EquipIcon/zb_4001.jpg'),(54,4002,'书经（抗暴）',4,'/Public/EquipIcon/zb_4002.jpg'),(55,4003,'列子（躲闪）',4,'/Public/EquipIcon/zb_4003.jpg'),(56,4004,'汉书（物防）',4,'/Public/EquipIcon/zb_4004.jpg'),(57,4005,'史记（抗暴）',4,'/Public/EquipIcon/zb_4005.jpg'),(58,4006,'诗经（躲闪）',4,'/Public/EquipIcon/zb_4006.jpg'),(59,4007,'战国策（物防）',4,'/Public/EquipIcon/zb_4007.jpg'),(60,4008,'尉缭子（躲闪）',4,'/Public/EquipIcon/zb_4008.jpg'),(61,4009,'韩非子（法抗）',4,'/Public/EquipIcon/zb_4009.jpg'),(62,4010,'鬼谷子（抗暴）',4,'/Public/EquipIcon/zb_4010.jpg'),(63,4011,'商君书（抗暴）',4,'/Public/EquipIcon/zb_4011.jpg'),(64,4012,'司马法（躲闪）',4,'/Public/EquipIcon/zb_4012.jpg'),(65,4013,'春秋左传（躲闪）',4,'/Public/EquipIcon/zb_4013.jpg'),(66,4014,'孟德新书（物防）',4,'/Public/EquipIcon/zb_4014.jpg'),(67,4015,'遁甲天书（法抗）',4,'/Public/EquipIcon/zb_4015.jpg'),(68,4016,'孙子兵法（抗暴）',4,'/Public/EquipIcon/zb_4016.jpg'),(69,4017,'三韬六略（躲闪）',4,'/Public/EquipIcon/zb_4017.jpg'),(70,4018,'太平要术（抗暴）',4,'/Public/EquipIcon/zb_4018.jpg'),(71,4019,'兵书二十四篇（法抗）',4,'/Public/EquipIcon/zb_4019.jpg'),(72,4020,'西蜀地形图（物防）',4,'/Public/EquipIcon/zb_4020.jpg'),(73,4041,'GM宝典（暴击）',4,'/Public/EquipIcon/zb_4041.jpg'),(74,4042,'GM宝典（韧性）',4,'/Public/EquipIcon/zb_4042.jpg'),(75,5001,'黄鬃马（命中）',4,'/Public/EquipIcon/zb_5001.jpg'),(76,5002,'西极马（暴击）',4,'/Public/EquipIcon/zb_5002.jpg'),(77,5003,'大宛马（物穿）',4,'/Public/EquipIcon/zb_5003.jpg'),(78,5004,'铁骑马（暴击）',4,'/Public/EquipIcon/zb_5004.jpg'),(79,5005,'白鬃马（法穿）',4,'/Public/EquipIcon/zb_5005.jpg'),(80,5006,'黑鬃马（命中）',4,'/Public/EquipIcon/zb_5006.jpg'),(81,5007,'紫骍（命中）',4,'/Public/EquipIcon/zb_5007.jpg'),(82,5008,'惊帆（暴击）',4,'/Public/EquipIcon/zb_5008.jpg'),(83,5009,'的卢（物穿）',4,'/Public/EquipIcon/zb_5009.jpg'),(84,5010,'追风（命中）',4,'/Public/EquipIcon/zb_5010.jpg'),(85,5011,'闪电（法穿）',4,'/Public/EquipIcon/zb_5011.jpg'),(86,5012,'战虎（暴击）',4,'/Public/EquipIcon/zb_5012.jpg'),(87,5013,'爪黄飞电（命中）',4,'/Public/EquipIcon/zb_5013.jpg'),(88,5014,'紫金赤兔（暴击）',4,'/Public/EquipIcon/zb_5014.jpg'),(89,5015,'乌云踏雪（物穿）',4,'/Public/EquipIcon/zb_5015.jpg'),(90,5016,'汗血宝马（命中）',4,'/Public/EquipIcon/zb_5016.jpg'),(91,5017,'金甲雄狮（物穿）',4,'/Public/EquipIcon/zb_5017.jpg'),(92,5018,'重甲战象（暴击）',4,'/Public/EquipIcon/zb_5018.jpg'),(93,5019,'赤兔胭脂兽（法穿）',4,'/Public/EquipIcon/zb_5019.jpg'),(94,5020,'万里烟云兽（法穿）',4,'/Public/EquipIcon/zb_5020.jpg'),(95,5041,'GM神驹（命中）',4,'/Public/EquipIcon/zb_5041.jpg'),(96,5042,'GM神驹（闪避）',4,'/Public/EquipIcon/zb_5042.jpg'),(97,6001,'碧玉',4,'/Public/EquipIcon/zb_6001.jpg'),(98,6002,'云纹指环',4,'/Public/EquipIcon/zb_6002.jpg'),(99,6003,'龙纹玉佩',4,'/Public/EquipIcon/zb_6003.jpg'),(100,6004,'红锦香囊',4,'/Public/EquipIcon/zb_6004.jpg'),(101,6005,'天龙项链',4,'/Public/EquipIcon/zb_6005.jpg'),(102,6006,'苍穹玉佩',4,'/Public/EquipIcon/zb_6006.jpg'),(103,6007,'修灭手镯',4,'/Public/EquipIcon/zb_6007.jpg'),(104,6008,'霸道太阴镯',4,'/Public/EquipIcon/zb_6008.jpg'),(105,6009,'赤夜恶狼牙',4,'/Public/EquipIcon/zb_6009.jpg'),(106,6010,'凤舞环',4,'/Public/EquipIcon/zb_6010.jpg'),(107,6011,'苍炎耳环',4,'/Public/EquipIcon/zb_6011.jpg'),(108,6012,'雪魂戒',4,'/Public/EquipIcon/zb_6012.jpg'),(109,6013,'蛮狮玉带',4,'/Public/EquipIcon/zb_6013.jpg'),(110,6014,'青焰皇戒',4,'/Public/EquipIcon/zb_6014.jpg'),(111,6015,'护国无双戒 ',4,'/Public/EquipIcon/zb_6015.jpg'),(112,6016,'破军鸿雁环',4,'/Public/EquipIcon/zb_6016.jpg'),(113,6041,'GM饰品（速度）',4,'/Public/EquipIcon/zb_6041.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;

/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;