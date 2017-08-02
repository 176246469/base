/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : shop

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-07-07 11:07:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '账户名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `level` tinyint(1) DEFAULT NULL COMMENT '状态 1 银卡 2 金卡',
  `status` tinyint(1) DEFAULT '0' COMMENT '0 未审核 1 通过',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10038 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('10036', 'admin', 'admin', '1', '0');

-- ----------------------------
-- Table structure for book
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `types` varchar(1) DEFAULT NULL COMMENT '1 收入 2 支出',
  `level` tinyint(1) DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL COMMENT '被推荐人',
  `to` varchar(255) DEFAULT NULL COMMENT '推荐人',
  `info` varchar(255) DEFAULT NULL,
  `gold` int(11) DEFAULT NULL,
  `silver` int(11) DEFAULT NULL,
  `fenxiang` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of book
-- ----------------------------
INSERT INTO `book` VALUES ('52', '1', '3', '10070,10071,10072', '10067', '钻石会员推荐', '10000', '1680', '0');
INSERT INTO `book` VALUES ('53', '1', null, '52', '10066', '分享', '1000', null, '1');
INSERT INTO `book` VALUES ('54', '1', '3', '10074,10075,10076', '10070', '钻石会员推荐', '10000', '1680', '0');
INSERT INTO `book` VALUES ('55', '1', null, '54', '10066', '分享', '1000', null, '1');
INSERT INTO `book` VALUES ('56', '1', null, '54', '10067', '分享', '1000', null, '1');

-- ----------------------------
-- Table structure for cash
-- ----------------------------
DROP TABLE IF EXISTS `cash`;
CREATE TABLE `cash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gold` int(11) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `stauts` tinyint(1) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='提现表';

-- ----------------------------
-- Records of cash
-- ----------------------------
INSERT INTO `cash` VALUES ('14', '1000', '9999', '9999', '0', '10066');
INSERT INTO `cash` VALUES ('15', '2000', '1999', '1999', '0', '10066');

-- ----------------------------
-- Table structure for level_group
-- ----------------------------
DROP TABLE IF EXISTS `level_group`;
CREATE TABLE `level_group` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of level_group
-- ----------------------------
INSERT INTO `level_group` VALUES ('1', '银卡会员');
INSERT INTO `level_group` VALUES ('2', '金卡会员');
INSERT INTO `level_group` VALUES ('3', '钻石会员');

-- ----------------------------
-- Table structure for meal
-- ----------------------------
DROP TABLE IF EXISTS `meal`;
CREATE TABLE `meal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `info` varchar(255) DEFAULT NULL COMMENT '介绍',
  `level` tinyint(1) DEFAULT NULL COMMENT '等级',
  `gold` int(11) NOT NULL,
  `silver` int(11) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of meal
-- ----------------------------
INSERT INTO `meal` VALUES ('1', '银卡会员【1280】', '银卡会员【1280】', '1', '1000', '00000000280');
INSERT INTO `meal` VALUES ('2', '金卡会员【3880】', '金卡会员【3880】', '2', '200', '00000000200');
INSERT INTO `meal` VALUES ('3', '钻石会员【11680】【15099元产品】', '钻石会员 套餐A', '3', '300', '00000000300');
INSERT INTO `meal` VALUES ('4', '钻石会员【11680】【15099元产品】', '钻石会员 套餐B', '3', '400', '00000000400');

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '账户名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `meal` tinyint(1) DEFAULT NULL COMMENT '  套餐',
  `level` tinyint(1) DEFAULT NULL COMMENT '状态 1 银卡 2 金卡',
  `integral` int(255) DEFAULT NULL COMMENT '积分',
  `gold` int(11) unsigned zerofill NOT NULL DEFAULT '00000000000' COMMENT '金币',
  `silver` int(11) NOT NULL DEFAULT '0' COMMENT '银币',
  `telephone` varchar(255) DEFAULT NULL COMMENT '电话',
  `address` varchar(255) DEFAULT NULL COMMENT '收货地址',
  `bank` varchar(255) DEFAULT NULL COMMENT '银行',
  `code` varchar(255) DEFAULT NULL COMMENT '银行卡号',
  `mid` int(11) DEFAULT NULL COMMENT '推荐人ID',
  `pids` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0 未审核 1 通过',
  `is_tijian` tinyint(1) unsigned zerofill NOT NULL,
  `book_id` tinytext COMMENT '分享奖金id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10078 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('10036', '刘晓明', '3726115', '1', '1', null, '00000000000', '0', '15269', '山东省烟台市北郊镇2011', '19999', '199999', '11111', null, '0', '0', null);
INSERT INTO `member` VALUES ('10037', '汪洋', '1212', '1', '1', null, '00000000000', '0', '15268372611', '山东省烟台市北郊镇2011', '1232323', '1232323', '10037', '', '0', '0', null);
INSERT INTO `member` VALUES ('10035', '270', '221314', '1', '1', null, '00000000000', '0', '15268372611', '海南省三县市', '1', '1', '10037', '', '0', '0', null);
INSERT INTO `member` VALUES ('10038', '李明晓', '372811', '1', '1', null, '00000000100', '0', '15269372822', '海南省三县市小区12号', '中国农业银行', '200901123000111', '10035', '_10035', '1', '0', '');
INSERT INTO `member` VALUES ('10039', '李三三', '372711', '2', '1', null, '00000000100', '0', '15269372712', '蓬莱市科苑办事处', '交通银行', '2011002288112', '10038', '_10035_10038', '0', '0', '');
INSERT INTO `member` VALUES ('10040', '肖茜茜', '372811', '2', '1', null, '00000002000', '560', '15269372811', '枣庄市信息学院', '农行', '4445553322323211', '10039', '_10035_10038_10039', '0', '0', null);
INSERT INTO `member` VALUES ('10041', '李世敏', '372811', '1', '1', null, '00000000000', '0', '15269372811', '西安交通大学12号楼', '邮政储蓄', '622819882211009', '10040', '_10035_10038_10039_10040', '0', '1', null);
INSERT INTO `member` VALUES ('10042', '小华', '372811', '1', '1', null, '00000000000', '0', '15269372811', '济南市', '农业银行', '1212123333333', '10040', '_10035_10038_10039_10040', '0', '1', null);
INSERT INTO `member` VALUES ('10043', '小丽', '372811', '1', '1', null, '00000000000', '0', '15269372811', '济南市天桥区', '中国银行', '20099911222333', '10040', '_10035_10038_10039_10040', '1', '1', null);
INSERT INTO `member` VALUES ('10059', '小鱼儿1', '888888', '1', '1', null, '00000000000', '0', '15269362719', '111111', '111111', '111111', '10058', '_10036_10058', '0', '0', null);
INSERT INTO `member` VALUES ('10060', '小鱼儿2', '1111', '1', '1', null, '00000000000', '0', '15269362719', '111111', '111111', '111111', '10058', '_10036_10058', '0', '0', null);
INSERT INTO `member` VALUES ('10061', 'lizhenjie', '888888', '3', '1', null, '00000000000', '0', '13356798585', 'qingdao', 'zhonnghang ', '750462311225', '122633333', '122633333', '-1', '0', null);
INSERT INTO `member` VALUES ('10062', '111111', '888888', '0', '1', null, '00000000000', '0', '15269362711', '2222', '222', '222', '11111', '11111', '1', '0', null);
INSERT INTO `member` VALUES ('10063', '111111', '888888', '0', '1', null, '00000000000', '0', '15269372811', '2222', '222', '222', '11111', '11111', '0', '0', null);
INSERT INTO `member` VALUES ('10064', '4444', '888888', '3', '1', null, '00000000000', '0', '15269372711', '22222', '333', '3333', '111111', '111111', '0', '0', null);
INSERT INTO `member` VALUES ('10065', '4444', '888888', '3', '3', null, '00000000000', '0', '15268337111', '22222', '333', '3333', '111111', '111111', '0', '0', null);
INSERT INTO `member` VALUES ('10066', 'lizhenjie ', '888888', '3', '3', null, '00000009000', '1680', '13356798585', 'qingdao ', 'qingdao ', '5556666', '2147483647', '4566333333', '1', '0', '52,54');
INSERT INTO `member` VALUES ('10067', 'lizhenjie ', '888888', '4', '3', null, '00000011000', '1680', '15169377787', 'qingdao ', 'qingdao ', '5556666', '10066', '4566333333_10066', '1', '1', '54');
INSERT INTO `member` VALUES ('10068', 'lizhenjie ', '888888', '4', '3', null, '00000000000', '0', '13356798585', 'qingdao ', 'qingdao ', '5556666', '10066', '4566333333_10066', '1', '1', null);
INSERT INTO `member` VALUES ('10069', 'lizhenjie ', '888888', '3', '3', null, '00000000000', '0', '13356798585', 'qingdao ', 'qingdao ', '5556666', '10066', '4566333333_10066', '1', '1', null);
INSERT INTO `member` VALUES ('10058', '李雷雷', '888888', '2', '1', null, '00000000000', '0', '15269362719', '大红门', '建行', '12121212121', '10036', '_10036', '0', '0', null);
INSERT INTO `member` VALUES ('10070', 'lizhenjie ', '888888', '3', '3', null, '00000010000', '1680', '13356798585', 'qingdao ', 'qingdao ', '5556666', '10067', '4566333333_10066_10067', '1', '1', null);
INSERT INTO `member` VALUES ('10071', 'lizhenjie ', '888888', '3', '3', null, '00000000000', '0', '13356798585', 'qingdao ', 'qingdao ', '5556666', '10067', '4566333333_10066_10067', '1', '1', null);
INSERT INTO `member` VALUES ('10072', 'lizhenjie ', '888888', '3', '3', null, '00000000000', '0', '13356798585', 'qingdao ', 'qingdao ', '5556666', '10067', '4566333333_10066_10067', '1', '1', null);
INSERT INTO `member` VALUES ('10073', 'lizhenjie', '888888', '1', '1', null, '00000000000', '0', '13356798585', 'qingdao ', 'qingdao', '456123', '10070', '4566333333_10066_10067_10070', '1', '0', null);
INSERT INTO `member` VALUES ('10074', 'lizhenjie', '888888', '3', '3', null, '00000000000', '0', '15268337199', 'qingdao ', 'qingdao', '456123', '10070', '4566333333_10066_10067_10070', '0', '1', null);
INSERT INTO `member` VALUES ('10075', 'lizhenjie', '888888', '3', '3', null, '00000000000', '0', '13356798585', 'qingdao ', 'qingdao', '456123', '10070', '4566333333_10066_10067_10070', '1', '1', null);
INSERT INTO `member` VALUES ('10076', 'lizhenjie', '888888', '3', '3', null, '00000000000', '0', '13356798585', 'qingdao', 'qingdao', '55555555555555555555', '10070', '4566333333_10066_10067_10070', '1', '1', null);
INSERT INTO `member` VALUES ('10077', '11', '888888', '1', '1', null, '00000000000', '0', '15269372811', '111', null, null, '0', '', '0', '0', null);
