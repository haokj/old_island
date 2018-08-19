/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : old_island

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-08-18 23:32:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hot_keyword
-- ----------------------------
DROP TABLE IF EXISTS `hot_keyword`;
CREATE TABLE `hot_keyword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '热搜关键词',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='热搜关键词表';

-- ----------------------------
-- Records of hot_keyword
-- ----------------------------
INSERT INTO `hot_keyword` VALUES ('1', 'Fluent Python');
INSERT INTO `hot_keyword` VALUES ('2', 'Python');
INSERT INTO `hot_keyword` VALUES ('3', '小程序Java核心编程');
INSERT INTO `hot_keyword` VALUES ('4', '慕课网7七月');
INSERT INTO `hot_keyword` VALUES ('5', '微信小程序开发入门与实践');
INSERT INTO `hot_keyword` VALUES ('6', 'C++');

-- ----------------------------
-- Table structure for journal
-- ----------------------------
DROP TABLE IF EXISTS `journal`;
CREATE TABLE `journal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '内容',
  `fav_nums` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '点赞次数',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '图片地址',
  `index` int(11) unsigned NOT NULL COMMENT '期刊号',
  `pubdate` date NOT NULL COMMENT '发布日期',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '文章标题',
  `type` smallint(4) unsigned NOT NULL DEFAULT '100' COMMENT '100电影200音乐300句子400图书',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '音乐文件地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COMMENT='期刊表';

-- ----------------------------
-- Records of journal
-- ----------------------------
INSERT INTO `journal` VALUES ('1', '人生不能像做菜，把所有料准备好才下锅', '20', 'http://weixinhkj.xyz/img/old_island/100-1.png', '8', '2018-08-14', '李安 《饮食男女》', '100', '');
INSERT INTO `journal` VALUES ('2', '谁念 过千字文章 秋收冬已藏', '0', 'http://weixinhkj.xyz/img/old_island/200-1.png', '7', '2018-08-14', '不才 《参商》', '200', 'http://other.web.rh01.sycdn.kuwo.cn/resource/n2/57/28/423038354.mp3');
INSERT INTO `journal` VALUES ('3', '心上污垢，林间有风', '0', 'http://weixinhkj.xyz/img/old_island/300-2.jpg', '6', '2018-08-14', '未名', '300', '');
INSERT INTO `journal` VALUES ('4', '许多人来来去去，相聚又别离', '0', 'http://weixinhkj.xyz/img/old_island/200-2.png', '5', '2018-08-14', '好妹妹 《一个人的北京》', '200', 'http://weixinhkj.xyz/img/old_island/person-beijing.mp3');
INSERT INTO `journal` VALUES ('5', '在变幻的生命里，岁月原来是最大的小偷', '0', 'http://weixinhkj.xyz/img/old_island/100-2.png', '4', '2018-08-14', '罗启锐 《岁月神偷》', '100', '');
INSERT INTO `journal` VALUES ('6', '你陪我步入蝉夏 越过城市喧嚣', '0', 'http://weixinhkj.xyz/img/old_island/200-4.png', '3', '2018-08-14', '花粥 《纸短情长》', '200', 'http://weixinhkj.xyz/img/old_island/zhiduan.mp3');
INSERT INTO `journal` VALUES ('7', '这个夏天又是一个毕业季', '0', 'http://weixinhkj.xyz/img/old_island/300-1.jpg', '2', '2018-08-14', '未名', '300', '');
INSERT INTO `journal` VALUES ('8', '岁月长，衣裳薄', '0', 'http://weixinhkj.xyz/img/old_island/200-3.png', '1', '2018-08-14', '杨千嬅 《再见二丁目》', '200', 'http://media.bitauto.com/gz/2.mp3');

-- ----------------------------
-- Table structure for short_comment
-- ----------------------------
DROP TABLE IF EXISTS `short_comment`;
CREATE TABLE `short_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图书id',
  `content` varchar(50) NOT NULL DEFAULT '' COMMENT '短评内容',
  `num` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `book_id` (`book_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='图书短评表';

-- ----------------------------
-- Records of short_comment
-- ----------------------------
INSERT INTO `short_comment` VALUES ('1', '26745030', '不错', '5');
INSERT INTO `short_comment` VALUES ('2', '26745030', '非常棒', '2');
INSERT INTO `short_comment` VALUES ('5', '26745030', '不错，很棒', '3');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) NOT NULL COMMENT '用户openid',
  `nick_name` varchar(50) DEFAULT NULL COMMENT '微信昵称',
  `avatar_url` varchar(255) DEFAULT NULL COMMENT '微信头像地址',
  `gender` tinyint(1) unsigned DEFAULT NULL COMMENT '用户性别1男2女0未知',
  `city` varchar(50) DEFAULT NULL COMMENT '城市',
  `province` varchar(50) DEFAULT NULL COMMENT '省份',
  `country` varchar(50) DEFAULT NULL COMMENT '国家',
  PRIMARY KEY (`id`),
  KEY `openid` (`openid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='小程序用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'ojV8R0ag4h9LyCwNVP3-7CSm-2Ao', '尘缘未央', 'https://wx.qlogo.cn/mmopen/vi_32/W4FmdTMO3hB4Vx1pjn8ck0l6iaN5chKGJnFZbqRiazyhH1AHAaumvBVGibuXn9s2Y7wcRhvUWZqPcqCAwCIMebWwQ/132', '1', '邯郸', '河北', '中国');

-- ----------------------------
-- Table structure for user_comment
-- ----------------------------
DROP TABLE IF EXISTS `user_comment`;
CREATE TABLE `user_comment` (
  `com_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '短评表id',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT '用户表id',
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户与短评的中间表';

-- ----------------------------
-- Records of user_comment
-- ----------------------------
INSERT INTO `user_comment` VALUES ('3', '1');
INSERT INTO `user_comment` VALUES ('4', '1');
INSERT INTO `user_comment` VALUES ('5', '1');

-- ----------------------------
-- Table structure for user_praise
-- ----------------------------
DROP TABLE IF EXISTS `user_praise`;
CREATE TABLE `user_praise` (
  `user_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `art_id` int(10) unsigned NOT NULL COMMENT '期刊或图书id',
  `type` smallint(4) unsigned NOT NULL COMMENT '100电影200音乐300句子400图书',
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户点赞表';

-- ----------------------------
-- Records of user_praise
-- ----------------------------
INSERT INTO `user_praise` VALUES ('1', '2', '200');
INSERT INTO `user_praise` VALUES ('1', '30158999', '400');
INSERT INTO `user_praise` VALUES ('2', '30158999', '400');
INSERT INTO `user_praise` VALUES ('3', '30158999', '400');
INSERT INTO `user_praise` VALUES ('1', '10769749', '400');
INSERT INTO `user_praise` VALUES ('2', '26745030', '400');
