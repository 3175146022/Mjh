/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : mjh

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-25 17:41:41
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of activity
-- ----------------------------
INSERT INTO `activity` VALUES ('2', '测试', '1505750400', '1505836800', '100', '0', '测试', '<p>测试</p>', '0', '1505816113', '0', '0', 'Uploads/activity/2017-09-22/59c46f012e455.jpg', '3');
INSERT INTO `activity` VALUES ('3', 'ces', '1506096000', '1506528000', '100', '0', '测试1', '<p>111</p>', '0', '1506045766', '0', '0', 'Uploads/activity/2017-09-22/59c471ea1961c.jpg', '13');

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of activity_cate
-- ----------------------------
INSERT INTO `activity_cate` VALUES ('3', 'Uploads/activity/2017-09-19/59c0ab2fd6963.jpg', '主题活动', 'Uploads/activity/2017-09-19/59c0ab2fd7839.jpg', '越野风暴');
INSERT INTO `activity_cate` VALUES ('13', 'Uploads/activity/2017-09-19/59c0ca079b657.jpg', '其他活动', 'Uploads/activity/2017-09-19/59c0c9fb69959.jpg', '越野竞赛');

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'mmjh', '7b8ba283fe880ccde9443b307e7b93c5', '1');
INSERT INTO `admin` VALUES ('9', 'wangjian', '44bc64daf3c37a7ada23e63a137310bd', '0');

-- ----------------------------
-- Table structure for collect
-- ----------------------------
DROP TABLE IF EXISTS `collect`;
CREATE TABLE `collect` (
  `collect_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '收藏id',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `collect` int(11) unsigned NOT NULL COMMENT '收藏数据id',
  `cate` tinyint(1) unsigned NOT NULL COMMENT '收藏分类 0：活动 1：直播 2：故事 3：签到',
  PRIMARY KEY (`collect_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of collect
-- ----------------------------

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
-- Table structure for genera
-- ----------------------------
DROP TABLE IF EXISTS `genera`;
CREATE TABLE `genera` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '推广id',
  `content` varchar(255) NOT NULL COMMENT '推广内容',
  `add_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `author` varchar(25) NOT NULL COMMENT '发布人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of genera
-- ----------------------------
INSERT INTO `genera` VALUES ('2', '满堂花醉三千客，一剑寒霜十四粥', '1506328898', 'wangjian');
INSERT INTO `genera` VALUES ('3', 'hello!boys and girls', '1506329501', 'wangjian');

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
  `introduction` varchar(150) NOT NULL COMMENT '简介',
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('3', 'Uploads/news/2017-09-22/59c4e0c1de26c.jpg', '什么是江湖？', '<p>经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p>经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p>经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p>经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p>经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p>经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p>经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p>', '1506074817', '1506318155', '5', '桑德拉时间后大家哈搜的骄傲山莨按时打卡大');
INSERT INTO `news` VALUES ('5', 'Uploads/news/2017-09-23/59c5b54557f28.jpg', '探望少年', '<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; white-space: normal; background-color: rgb(245, 245, 245);\">经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; white-space: normal; background-color: rgb(245, 245, 245);\">经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; white-space: normal; background-color: rgb(245, 245, 245);\">经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; white-space: normal; background-color: rgb(245, 245, 245);\">经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; white-space: normal; background-color: rgb(245, 245, 245);\">经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; white-space: normal; background-color: rgb(245, 245, 245);\">经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; white-space: normal; background-color: rgb(245, 245, 245);\">经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p><br/></p>', '1506129221', '1506318161', '6', '测试测试');
INSERT INTO `news` VALUES ('6', 'Uploads/news/2017-09-23/59c5bc1c93bd7.jpg', '测试', '<p>测试测试测试&nbsp;</p>', '1506130972', '1506131350', '6', '萨达我萨达萨达撒多调度室自神的箭爱上了大');
INSERT INTO `news` VALUES ('7', 'Uploads/news/2017-09-23/59c5f5f7a0404.jpg', '测试', '<p>测试测试</p>', '1506145783', '1506145783', '5', '测试测试');
INSERT INTO `news` VALUES ('8', 'Uploads/news/2017-09-23/59c607b618857.jpg', '江湖推介1', '<p>江湖推介11111111111111</p>', '1506150326', '1506150326', '7', '江湖推介1');
INSERT INTO `news` VALUES ('9', 'Uploads/news/2017-09-23/59c60e902feb1.jpg', '江湖故事1', '<p>江湖故事1江湖故事1江湖故事1江湖故事1江湖故事1</p>', '1506152080', '1506152080', '8', '江湖故事1');
INSERT INTO `news` VALUES ('10', 'Uploads/news/2017-09-23/59c60eb5cdeb1.jpg', '江湖故事2', '<p>江湖故事2江湖故事2江湖故事2江湖故事2江湖故事2</p>', '1506152117', '1506152117', '8', '江湖故事2');
INSERT INTO `news` VALUES ('11', 'Uploads/news/2017-09-23/59c60f0db3630.jpg', '江湖推介2', '<p>江湖推介2江湖推介2江湖推介2江湖推介2江湖推介2</p>', '1506152205', '1506318131', '7', '江湖推介2');

-- ----------------------------
-- Table structure for news_cate
-- ----------------------------
DROP TABLE IF EXISTS `news_cate`;
CREATE TABLE `news_cate` (
  `cate_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '新闻分类编号',
  `cate_name` varchar(100) NOT NULL COMMENT '新闻分类名',
  `pid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news_cate
-- ----------------------------
INSERT INTO `news_cate` VALUES ('1', '江湖须知', '0');
INSERT INTO `news_cate` VALUES ('5', '江湖须知', '1');
INSERT INTO `news_cate` VALUES ('6', '江湖告示', '1');
INSERT INTO `news_cate` VALUES ('7', '江湖推介', '1');
INSERT INTO `news_cate` VALUES ('8', '江湖故事', '1');

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
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `so_link` text NOT NULL COMMENT '直播链接',
  `img` varchar(255) NOT NULL COMMENT '封面图',
  PRIMARY KEY (`solive_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of solive
-- ----------------------------
INSERT INTO `solive` VALUES ('6', '直播', '直播', '王建1', '1506156258', '<p><embed width=\"800\" height=\"500\" allownetworking=\"all\" allowscriptaccess=\"always\" src=\"http://liveshare.huya.com/saonan/huyacoop.swf\" quality=\"high\" bgcolor=\"#000\" wmode=\"window\" allowfullscreen=\"true\" type=\"application/x-shockwave-flash\"/></p>', 'Uploads/solive/2017-09-23/59c6288925a60.jpg');
INSERT INTO `solive` VALUES ('7', '测试', '测试', '王建', '1506331734', '<p><iframe frameborder=\"0\" width=\"640\" height=\"498\" src=\"https://v.qq.com/iframe/player.html?vid=o0014eg8yxo&tiny=0&auto=0\" allowfullscreen=\"\"></iframe></p>', 'Uploads/solive/2017-09-25/59c8cc570a239.jpg');

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of token
-- ----------------------------
INSERT INTO `token` VALUES ('1', '524104', '0', null, '0');
INSERT INTO `token` VALUES ('2', '123456', '3', null, '0');
INSERT INTO `token` VALUES ('3', '123456', '2', null, '0');
INSERT INTO `token` VALUES ('4', '253696', '3', null, '0');
INSERT INTO `token` VALUES ('7', '369582', '3', null, '0');

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
