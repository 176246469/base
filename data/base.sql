/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : base

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-08-07 11:25:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '账户名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `level` tinyint(1) DEFAULT NULL COMMENT '状态 1 银卡 2 金卡',
  `status` tinyint(1) DEFAULT '0' COMMENT '0 未审核 1 通过',
  `group` tinyint(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10039 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', '666', 'admin', 'admin', '1', '1', '2');
INSERT INTO `admin` VALUES ('10038', '666', '4444', '4444', null, '0', '2');

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `access` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1' COMMENT '删除-1，正常 1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of group
-- ----------------------------
INSERT INTO `group` VALUES ('2', '管理组4', '2222', 'a:2:{i:1;a:1:{i:2;s:1:\"1\";}i:3;a:2:{i:4;s:1:\"1\";i:5;s:1:\"1\";}}', '0', '1');
INSERT INTO `group` VALUES ('3', '管理组2', '222', null, '2', '1');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '菜单名称',
  `address` varchar(255) DEFAULT NULL,
  `fa` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `mould_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '菜单管理', '/index.php/admin/menu/columns', 'fa-home', '0', null);
INSERT INTO `menu` VALUES ('2', '菜单列表', '/index.php/admin/menu/columns', null, '1', null);
INSERT INTO `menu` VALUES ('3', '用户管理', '44', 'fa-envelope', '0', null);
INSERT INTO `menu` VALUES ('4', '用户组', '/index.php/admin/group/columns', null, '3', null);
INSERT INTO `menu` VALUES ('5', '用户列表', '/index.php/admin/admin/columns', null, '3', null);
INSERT INTO `menu` VALUES ('7', '模型管理', '', null, '0', null);
INSERT INTO `menu` VALUES ('8', '模型列表', '/index.php/admin/mould/columns', null, '7', null);

-- ----------------------------
-- Table structure for mould
-- ----------------------------
DROP TABLE IF EXISTS `mould`;
CREATE TABLE `mould` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `add` varchar(255) DEFAULT NULL,
  `edit` varchar(255) DEFAULT NULL,
  `list` varchar(255) DEFAULT NULL,
  `sreach` varchar(255) DEFAULT NULL,
  `ct_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mould
-- ----------------------------
INSERT INTO `mould` VALUES ('8', '用户', 'user', 'a:2:{i:8;a:0:{}i:9;a:0:{}}', 'a:1:{i:8;a:0:{}}', 'a:1:{i:8;a:0:{}}', 'a:1:{i:8;a:0:{}}', null);

-- ----------------------------
-- Table structure for mould_fileds
-- ----------------------------
DROP TABLE IF EXISTS `mould_fileds`;
CREATE TABLE `mould_fileds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mould_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `filed` varchar(255) DEFAULT NULL,
  `type` tinyint(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mould_fileds
-- ----------------------------
INSERT INTO `mould_fileds` VALUES ('8', '8', '名称', 'username', '1', '默认');
INSERT INTO `mould_fileds` VALUES ('9', '8', '等级', 'level', '3', '大，中，小');
