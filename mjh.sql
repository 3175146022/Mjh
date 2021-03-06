/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : mjh

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-10-19 09:43:14
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
  `sign_up` int(11) unsigned DEFAULT '0' COMMENT '报名人数',
  `act_detail` varchar(255) DEFAULT NULL COMMENT '详细描述',
  `act_content` text COMMENT '活动内容',
  `act_status` tinyint(1) unsigned DEFAULT '0' COMMENT '活动状态',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `is_sold` tinyint(1) unsigned NOT NULL COMMENT '是否下架0：否1：是',
  `type` tinyint(1) unsigned NOT NULL COMMENT '类型0：长线活动1：短线活动',
  `img` varchar(255) DEFAULT NULL COMMENT '封面图',
  `act_cate_id` int(11) unsigned DEFAULT NULL COMMENT '分类',
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员编号',
  `admin_name` varchar(100) NOT NULL COMMENT '管理员账号',
  `password` varchar(255) NOT NULL COMMENT '管理员密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否是超级管理员',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for collect
-- ----------------------------
DROP TABLE IF EXISTS `collect`;
CREATE TABLE `collect` (
  `collect_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '收藏id',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `collect` int(11) unsigned NOT NULL COMMENT '收藏数据id',
  `cate` tinyint(1) unsigned NOT NULL COMMENT '收藏分类 0：活动 1：直播 2：故事 3：签到',
  `time` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`collect_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论编号',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户信息id',
  `reply_id` int(20) NOT NULL DEFAULT '0' COMMENT '回复id',
  `solive_id` int(11) unsigned NOT NULL COMMENT '直播信息id',
  `content` varchar(255) DEFAULT NULL COMMENT '评论内容',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上一级id',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `access_token` text NOT NULL COMMENT 'access_token凭证',
  `token_time` varchar(10) NOT NULL COMMENT '有效时间',
  `jsapi_ticket` text NOT NULL,
  `jsapi_time` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='配置表';

-- ----------------------------
-- Table structure for friend
-- ----------------------------
DROP TABLE IF EXISTS `friend`;
CREATE TABLE `friend` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `friend_id` int(11) unsigned NOT NULL COMMENT '好友id',
  `add_time` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='好友表';

-- ----------------------------
-- Table structure for genera
-- ----------------------------
DROP TABLE IF EXISTS `genera`;
CREATE TABLE `genera` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '推广id',
  `content` text NOT NULL COMMENT '推广内容',
  `add_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `author` varchar(25) NOT NULL COMMENT '发布人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
-- Table structure for mark
-- ----------------------------
DROP TABLE IF EXISTS `mark`;
CREATE TABLE `mark` (
  `mark_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '签到编号',
  `zero_time` int(10) unsigned NOT NULL COMMENT '第二天凌晨',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户编号',
  `mark_time` int(10) unsigned NOT NULL COMMENT '签到时间',
  PRIMARY KEY (`mark_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='签到表';

-- ----------------------------
-- Table structure for my_activity
-- ----------------------------
DROP TABLE IF EXISTS `my_activity`;
CREATE TABLE `my_activity` (
  `my_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '我的活动id',
  `activity_id` int(11) unsigned NOT NULL COMMENT '活动id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  PRIMARY KEY (`my_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='我的活动';

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
  `introduction` varchar(150) NOT NULL COMMENT '简介',
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for news_cate
-- ----------------------------
DROP TABLE IF EXISTS `news_cate`;
CREATE TABLE `news_cate` (
  `cate_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '新闻分类编号',
  `cate_name` varchar(100) NOT NULL COMMENT '新闻分类名',
  `pid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for reward
-- ----------------------------
DROP TABLE IF EXISTS `reward`;
CREATE TABLE `reward` (
  `reward_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '悬赏编号',
  `re_image` varchar(255) NOT NULL COMMENT '悬赏封面图',
  `re_title` varchar(150) NOT NULL COMMENT '悬赏标题',
  `re_content` text COMMENT '悬赏内容',
  `author` varchar(255) DEFAULT NULL COMMENT '许愿者',
  `re_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '悬赏状态',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `end_time` int(10) unsigned NOT NULL COMMENT '结束时间',
  `undertake` varchar(255) DEFAULT NULL COMMENT '揭榜人',
  `take_time` int(10) unsigned DEFAULT NULL COMMENT '揭榜时间',
  PRIMARY KEY (`reward_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for re_picture
-- ----------------------------
DROP TABLE IF EXISTS `re_picture`;
CREATE TABLE `re_picture` (
  `re_pic_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '图册id',
  `re_picture` varchar(255) DEFAULT NULL COMMENT '图片',
  `reward_id` int(11) unsigned NOT NULL COMMENT '悬赏id',
  PRIMARY KEY (`re_pic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='悬赏图册';

-- ----------------------------
-- Table structure for solive
-- ----------------------------
DROP TABLE IF EXISTS `solive`;
CREATE TABLE `solive` (
  `solive_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '直播编号',
  `so_title` varchar(150) NOT NULL COMMENT '直播标题',
  `so_detail` varchar(255) NOT NULL COMMENT '直播简介',
  `so_author` varchar(80) NOT NULL COMMENT '发布者',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `so_link` text NOT NULL COMMENT '直播链接',
  `img` varchar(255) NOT NULL COMMENT '封面图',
  PRIMARY KEY (`solive_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `token_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '令牌id',
  `tok_num` char(6) NOT NULL COMMENT '令牌编号',
  `tok_level` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '令牌等级1:欢喜令2：义士令3：英雄令4：大侠令5：大谦令',
  `bind_time` int(10) unsigned NOT NULL COMMENT '绑定时间',
  `phone` varchar(11) NOT NULL COMMENT '手机号',
  PRIMARY KEY (`token_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for trade
-- ----------------------------
DROP TABLE IF EXISTS `trade`;
CREATE TABLE `trade` (
  `trade_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '行业id',
  `trade` varchar(25) NOT NULL COMMENT '行业',
  PRIMARY KEY (`trade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='行业表';

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员编号',
  `open_id` varchar(80) CHARACTER SET utf8mb4 NOT NULL COMMENT '微信用户id',
  `avatar` varchar(255) DEFAULT NULL COMMENT '会员头像',
  `user_name` varchar(255) NOT NULL COMMENT '会员姓名',
  `sex` tinyint(1) unsigned NOT NULL COMMENT '会员性别：1男0女',
  `info_id` int(11) unsigned DEFAULT NULL COMMENT '地址信息',
  `trade_type` int(11) DEFAULT NULL COMMENT '行业类型',
  `company` varchar(255) DEFAULT NULL COMMENT '组织机构',
  `hobby` varchar(255) DEFAULT NULL COMMENT '爱好',
  `token_id` int(11) unsigned DEFAULT NULL COMMENT '令牌信息id',
  `code` varchar(255) NOT NULL COMMENT '二维码',
  `integral` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `reputation` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '声望',
  `pid` int(11) unsigned DEFAULT NULL COMMENT '邀请人id',
  `user_wx` varchar(50) DEFAULT NULL COMMENT '微信账号',
  `phone_num` varchar(14) DEFAULT NULL COMMENT '手机号',
  `address` varchar(255) DEFAULT NULL COMMENT '地址信息',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user_info
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `info_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '地址信息编号',
  `name` varchar(150) NOT NULL COMMENT '收货人姓名',
  `phone` char(11) NOT NULL COMMENT '手机号',
  `area` varchar(225) NOT NULL COMMENT '地区',
  `ad_detail` varchar(255) DEFAULT NULL COMMENT '详细地址',
  `postcode` char(6) DEFAULT NULL COMMENT '邮编',
  PRIMARY KEY (`info_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
