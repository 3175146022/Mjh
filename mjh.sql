/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : mjh

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-18 17:33:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for activity
-- ----------------------------
DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity` (
  `activity_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动编号',
  `act_title` varchar(150) DEFAULT NULL COMMENT '活动标题',
  `start_time` int(10) unsigned DEFAULT NULL COMMENT '活动开始时间',
  `end_time` int(10) unsigned DEFAULT NULL COMMENT '活动结束时间',
  `astrict` int(11) unsigned NOT NULL COMMENT '活动人数限制',
  `sign_up` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '报名人数',
  `act_detail` varchar(255) DEFAULT NULL COMMENT '详细描述',
  `act_content` text COMMENT '活动内容',
  `act_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '活动状态',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of activity
-- ----------------------------

-- ----------------------------
-- Table structure for activity_cate
-- ----------------------------
DROP TABLE IF EXISTS `activity_cate`;
CREATE TABLE `activity_cate` (
  `act_cate_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动分类编号',
  `act_icon` varchar(255) NOT NULL COMMENT '活动图标',
  `act_cate_title` varchar(255) NOT NULL COMMENT '活动标题',
  `act_img` varchar(255) NOT NULL COMMENT '封面图',
  `img_detail` varchar(150) DEFAULT NULL COMMENT '封面图详解',
  PRIMARY KEY (`act_cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of activity_cate
-- ----------------------------

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `address_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '地址编号',
  `address` varchar(100) DEFAULT NULL COMMENT '地址名称',
  `pid` int(11) unsigned DEFAULT NULL COMMENT '父id',
  PRIMARY KEY (`address_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of address
-- ----------------------------

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员编号',
  `admin_name` varchar(100) NOT NULL COMMENT '管理员账号',
  `password` varchar(255) NOT NULL COMMENT '管理员密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否是超级管理员',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'mmjh', '7b8ba283fe880ccde9443b307e7b93c5', '1');
INSERT INTO `admin` VALUES ('4', 'wangjian', '44bc64daf3c37a7ada23e63a137310bd', '0');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论编号',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户信息id',
  `solive_id` int(11) unsigned NOT NULL COMMENT '直播信息id',
  `content` varchar(255) DEFAULT NULL COMMENT '评论内容',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for integral
-- ----------------------------
DROP TABLE IF EXISTS `integral`;
CREATE TABLE `integral` (
  `level_id` int(11) unsigned NOT NULL COMMENT '等级id',
  `level_name` char(20) NOT NULL COMMENT '等级名称',
  `integral` int(5) unsigned NOT NULL COMMENT '积分'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of integral
-- ----------------------------

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `news_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '新闻编号',
  `picture` varchar(255) NOT NULL COMMENT '新闻封面图',
  `title` varchar(150) NOT NULL COMMENT '新闻标题',
  `content` text NOT NULL COMMENT '新闻内容',
  `add_time` int(80) unsigned DEFAULT NULL COMMENT '添加时间',
  `update_time` int(80) unsigned DEFAULT NULL COMMENT '修改时间',
  `cate_id` int(11) unsigned NOT NULL COMMENT '分类',
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------

-- ----------------------------
-- Table structure for news_cate
-- ----------------------------
DROP TABLE IF EXISTS `news_cate`;
CREATE TABLE `news_cate` (
  `cate_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '新闻分类编号',
  `cate_name` varchar(100) NOT NULL COMMENT '新闻分类名',
  `pid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news_cate
-- ----------------------------
INSERT INTO `news_cate` VALUES ('1', '江湖须知', '0');

-- ----------------------------
-- Table structure for reward
-- ----------------------------
DROP TABLE IF EXISTS `reward`;
CREATE TABLE `reward` (
  `reward_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '悬赏编号',
  `re_image` varchar(255) NOT NULL COMMENT '悬赏封面图',
  `re_title` varchar(150) NOT NULL COMMENT '悬赏标题',
  `re_content` text COMMENT '悬赏内容',
  `author` varchar(100) DEFAULT NULL COMMENT '许愿者',
  `re_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '悬赏状态',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`reward_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reward
-- ----------------------------

-- ----------------------------
-- Table structure for solive
-- ----------------------------
DROP TABLE IF EXISTS `solive`;
CREATE TABLE `solive` (
  `solive_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '直播编号',
  `so_title` varchar(150) NOT NULL COMMENT '直播标题',
  `so_detail` varchar(255) NOT NULL COMMENT '直播简介',
  `so_author` varchar(80) NOT NULL COMMENT '发布者',
  PRIMARY KEY (`solive_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of solive
-- ----------------------------

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `token_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '令牌id',
  `tok_num` char(6) NOT NULL COMMENT '令牌编号',
  `tok_level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '令牌等级0:欢喜令1：义士令2：英雄令3：大侠令4：大谦令',
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户信息',
  `tok_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '令牌状态0：未使用1：已使用',
  PRIMARY KEY (`token_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of token
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员编号',
  `avatar` varchar(255) DEFAULT NULL COMMENT '会员头像',
  `user_name` varchar(255) NOT NULL COMMENT '会员姓名',
  `sex` tinyint(1) unsigned NOT NULL COMMENT '会员性别：0男1女',
  `address_id` int(11) unsigned DEFAULT NULL COMMENT '地址信息',
  `trade_type` varchar(255) DEFAULT NULL COMMENT '行业类型',
  `trade` varchar(255) DEFAULT NULL COMMENT '行业详情',
  `hobby` varchar(255) DEFAULT NULL COMMENT '爱好',
  `token_id` int(11) unsigned DEFAULT NULL COMMENT '令牌信息id',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for user_infor
-- ----------------------------
DROP TABLE IF EXISTS `user_infor`;
CREATE TABLE `user_infor` (
  `infor_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '地址信息编号',
  `name` varchar(150) NOT NULL COMMENT '收货人姓名',
  `phone` char(11) NOT NULL COMMENT '手机号',
  `address_id` int(11) unsigned NOT NULL COMMENT '地址信息id',
  `ad_detail` varchar(255) DEFAULT NULL COMMENT '详细地址',
  `postcode` char(6) DEFAULT NULL COMMENT '邮编',
  PRIMARY KEY (`infor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_infor
-- ----------------------------
