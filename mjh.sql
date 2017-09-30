-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 09 月 30 日 08:57
-- 服务器版本: 5.5.36
-- PHP 版本: 5.2.17p1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `mjh`
--
CREATE DATABASE `mjh` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mjh`;

-- --------------------------------------------------------

--
-- 表的结构 `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `activity`
--

INSERT INTO `activity` (`activity_id`, `act_title`, `start_time`, `end_time`, `astrict`, `sign_up`, `act_detail`, `act_content`, `act_status`, `add_time`, `is_sold`, `type`, `img`, `act_cate_id`) VALUES
(2, '测试', 1505750400, 1506652696, 100, 7, '测试', '<p>测试</p>', 0, 1505816113, 0, 0, 'Uploads/activity/2017-09-22/59c46f012e455.jpg', 3),
(3, 'ces', 1506096000, 1506528000, 100, 13, '测试1', '<p>111</p>', 0, 1506045766, 1, 1, 'Uploads/activity/2017-09-22/59c471ea1961c.jpg', 13),
(5, 'ces132133', 1506614400, 1506700800, 200, 8, 'cea', '<p>sadsadasdadasdas<br/></p>', 0, 1506652929, 0, 1, 'Uploads/activity/2017-09-29/59cdb3012e1e5.jpg', 13),
(6, '团战', 1506614400, 1508342400, 500, 1, 'cf', '<p>大家来参与！</p><p>我们很开心！<br/></p>', 0, 1506694242, 0, 0, 'Uploads/activity/2017-09-29/59ce54680a9bd.png', 3);

-- --------------------------------------------------------

--
-- 表的结构 `activity_cate`
--

CREATE TABLE IF NOT EXISTS `activity_cate` (
  `act_cate_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动分类编号',
  `act_icon` varchar(255) NOT NULL COMMENT '活动图标',
  `act_cate_title` varchar(255) NOT NULL COMMENT '活动标题',
  `act_img` varchar(255) NOT NULL COMMENT '封面图',
  `img_detail` varchar(150) DEFAULT NULL COMMENT '封面图详解',
  PRIMARY KEY (`act_cate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `activity_cate`
--

INSERT INTO `activity_cate` (`act_cate_id`, `act_icon`, `act_cate_title`, `act_img`, `img_detail`) VALUES
(3, 'Uploads/activity/2017-09-19/59c0ab2fd6963.jpg', '主题活动', 'Uploads/activity/2017-09-19/59c0ab2fd7839.jpg', '越野风暴'),
(13, 'Uploads/activity/2017-09-19/59c0ca079b657.jpg', '其他活动', 'Uploads/activity/2017-09-19/59c0c9fb69959.jpg', '越野竞赛');

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员编号',
  `admin_name` varchar(100) NOT NULL COMMENT '管理员账号',
  `password` varchar(255) NOT NULL COMMENT '管理员密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否是超级管理员',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `password`, `status`) VALUES
(1, 'mmjh', '7b8ba283fe880ccde9443b307e7b93c5', 1),
(9, 'wangjian', '44bc64daf3c37a7ada23e63a137310bd', 0);

-- --------------------------------------------------------

--
-- 表的结构 `collect`
--

CREATE TABLE IF NOT EXISTS `collect` (
  `collect_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '收藏id',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `collect` int(11) unsigned NOT NULL COMMENT '收藏数据id',
  `cate` tinyint(1) unsigned NOT NULL COMMENT '收藏分类 0：活动 1：直播 2：故事 3：签到',
  `time` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`collect_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- 转存表中的数据 `collect`
--

INSERT INTO `collect` (`collect_id`, `user_id`, `collect`, `cate`, `time`) VALUES
(51, 29, 9, 3, 0),
(50, 29, 6, 2, 0),
(49, 29, 5, 1, 0),
(48, 31, 6, 1, 0),
(47, 36, 5, 1, 0),
(46, 36, 3, 4, 0),
(45, 31, 5, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论编号',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户信息id',
  `reply_id` int(20) NOT NULL DEFAULT '0' COMMENT '回复id',
  `solive_id` int(11) unsigned NOT NULL COMMENT '直播信息id',
  `content` varchar(255) DEFAULT NULL COMMENT '评论内容',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上一级id',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=184 ;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`comment_id`, `user_id`, `reply_id`, `solive_id`, `content`, `add_time`, `pid`) VALUES
(183, 29, 33, 6, '够了撅嘴', 1506697423, 181),
(182, 29, 31, 6, '你做了我了', 1506697406, 177),
(181, 33, 0, 6, '够了哦了', 1506697298, 0),
(180, 33, 31, 6, '测试卷', 1506697288, 177),
(179, 31, 29, 6, '。。', 1506697265, 176),
(176, 29, 0, 6, '测试1', 1506697136, 0),
(177, 31, 29, 6, '海鸥', 1506697166, 176),
(178, 29, 31, 6, '测试2', 1506697187, 177);

-- --------------------------------------------------------

--
-- 表的结构 `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `access_token` text NOT NULL COMMENT 'access_token凭证',
  `token_time` varchar(10) NOT NULL COMMENT '有效时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='配置表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `config`
--

INSERT INTO `config` (`id`, `access_token`, `token_time`) VALUES
(1, 'f0AVUnuuqEqHQiXCMuesDeB-X_fszfG-sLq-1lWNnhnpuDeIbm5kzN2BciaGdEew4m5U7yHVK1h3DyVJ4ylBOvfOiB7MKMgaJigXRh4QEiQ48kOozt9dlr_i2ZjNUujuIZYiADAXON', '1506419377');

-- --------------------------------------------------------

--
-- 表的结构 `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `friend_id` int(11) unsigned NOT NULL COMMENT '好友id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='好友表' AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `friend`
--

INSERT INTO `friend` (`id`, `user_id`, `friend_id`) VALUES
(11, 31, 33),
(12, 33, 31),
(13, 29, 33),
(14, 33, 29),
(15, 29, 31),
(16, 31, 29);

-- --------------------------------------------------------

--
-- 表的结构 `genera`
--

CREATE TABLE IF NOT EXISTS `genera` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '推广id',
  `content` varchar(255) NOT NULL COMMENT '推广内容',
  `add_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `author` varchar(25) NOT NULL COMMENT '发布人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `genera`
--

INSERT INTO `genera` (`id`, `content`, `add_time`, `author`) VALUES
(2, '满堂花醉三千客，一剑寒霜十四粥', 1506328898, 'wangjian'),
(3, 'hello!boys and girls', 1506329501, 'wangjian');

-- --------------------------------------------------------

--
-- 表的结构 `integral`
--

CREATE TABLE IF NOT EXISTS `integral` (
  `level_id` int(11) unsigned NOT NULL COMMENT '等级id',
  `level_name` char(20) NOT NULL COMMENT '等级名称',
  `integral` int(5) unsigned NOT NULL COMMENT '积分'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `integral`
--


-- --------------------------------------------------------

--
-- 表的结构 `mark`
--

CREATE TABLE IF NOT EXISTS `mark` (
  `mark_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '签到编号',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户编号',
  `mark_time` int(10) unsigned NOT NULL COMMENT '签到时间',
  PRIMARY KEY (`mark_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='签到表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `mark`
--

INSERT INTO `mark` (`mark_id`, `user_id`, `mark_time`) VALUES
(4, 33, 1506679376),
(3, 33, 1505669184),
(5, 31, 1506680443),
(6, 29, 1506690118),
(7, 36, 1506693037);

-- --------------------------------------------------------

--
-- 表的结构 `my_activity`
--

CREATE TABLE IF NOT EXISTS `my_activity` (
  `my_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '我的活动id',
  `activity_id` int(11) unsigned NOT NULL COMMENT '活动id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  PRIMARY KEY (`my_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='我的活动' AUTO_INCREMENT=52 ;

--
-- 转存表中的数据 `my_activity`
--

INSERT INTO `my_activity` (`my_id`, `activity_id`, `user_id`) VALUES
(41, 5, 16),
(42, 2, 16),
(45, 5, 5),
(46, 5, 18),
(47, 5, 9),
(48, 5, 12),
(49, 5, 31),
(50, 5, 36),
(51, 6, 31);

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '新闻编号',
  `picture` varchar(255) NOT NULL COMMENT '新闻封面图',
  `title` varchar(150) NOT NULL COMMENT '新闻标题',
  `content` text NOT NULL COMMENT '新闻内容',
  `add_time` int(80) unsigned DEFAULT NULL COMMENT '添加时间',
  `update_time` int(80) unsigned DEFAULT NULL COMMENT '修改时间',
  `cate_id` int(11) unsigned NOT NULL COMMENT '分类',
  `introduction` varchar(150) NOT NULL COMMENT '简介',
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `news`
--

INSERT INTO `news` (`news_id`, `picture`, `title`, `content`, `add_time`, `update_time`, `cate_id`, `introduction`) VALUES
(3, 'Uploads/news/2017-09-22/59c4e0c1de26c.jpg', '什么是江湖？', '<p>经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p>经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p>经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p>经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p>经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p>经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p>经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p>', 1506074817, 1506394384, 5, '桑德拉时间后大家sdasdds'),
(5, 'Uploads/news/2017-09-23/59c5b54557f28.jpg', '探望少年', '<p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; white-space: normal; background-color: rgb(245, 245, 245);">经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; white-space: normal; background-color: rgb(245, 245, 245);">经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; white-space: normal; background-color: rgb(245, 245, 245);">经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; white-space: normal; background-color: rgb(245, 245, 245);">经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; white-space: normal; background-color: rgb(245, 245, 245);">经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; white-space: normal; background-color: rgb(245, 245, 245);">经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; white-space: normal; background-color: rgb(245, 245, 245);">经过半年时间的打磨，“慢江湖”公众平台现在已基本搭建完毕，开始面向各路江湖儿女公测。</p><p><br/></p>', 1506129221, 1506318161, 6, '测试测试'),
(6, 'Uploads/news/2017-09-23/59c5bc1c93bd7.jpg', '测试', '<p>测试测试测试&nbsp;</p>', 1506130972, 1506394391, 6, '萨达我萨达萨达撒多调度asda'),
(7, 'Uploads/news/2017-09-23/59c5f5f7a0404.jpg', '测试', '<p>测试测试</p>', 1506145783, 1506145783, 5, '测试测试'),
(8, 'Uploads/news/2017-09-23/59c607b618857.jpg', '江湖推介1', '<p>江湖推介11111111111111</p>', 1506150326, 1506150326, 7, '江湖推介1'),
(9, 'Uploads/news/2017-09-23/59c60e902feb1.jpg', '江湖故事1', '<p>江湖故事1江湖故事1江湖故事1江湖故事1江湖故事1</p>', 1506152080, 1506152080, 8, '江湖故事1'),
(10, 'Uploads/news/2017-09-23/59c60eb5cdeb1.jpg', '江湖故事2', '<p>江湖故事2江湖故事2江湖故事2江湖故事2江湖故事2</p>', 1506152117, 1506152117, 8, '江湖故事2'),
(11, 'Uploads/news/2017-09-23/59c60f0db3630.jpg', '江湖推介2', '<p>江湖推介2江湖推介2江湖推介2江湖推介2江湖推介2</p>', 1506152205, 1506318131, 7, '江湖推介2'),
(12, 'Uploads/news/2017-09-28/59ccb8d72be7a.jpg', 'asdasd', '<p>asdasdasdasd</p>', 1506588887, 1506588887, 5, 'asdasd');

-- --------------------------------------------------------

--
-- 表的结构 `news_cate`
--

CREATE TABLE IF NOT EXISTS `news_cate` (
  `cate_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '新闻分类编号',
  `cate_name` varchar(100) NOT NULL COMMENT '新闻分类名',
  `pid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `news_cate`
--

INSERT INTO `news_cate` (`cate_id`, `cate_name`, `pid`) VALUES
(1, '江湖须知', 0),
(5, '江湖须知', 1),
(6, '江湖告示', 1),
(7, '江湖推介', 1),
(8, '江湖故事', 1);

-- --------------------------------------------------------

--
-- 表的结构 `reward`
--

CREATE TABLE IF NOT EXISTS `reward` (
  `reward_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '悬赏编号',
  `re_image` varchar(255) NOT NULL COMMENT '悬赏封面图',
  `re_title` varchar(150) NOT NULL COMMENT '悬赏标题',
  `re_content` text COMMENT '悬赏内容',
  `author` varchar(255) DEFAULT NULL COMMENT '许愿者',
  `re_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '悬赏状态',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `end_time` int(10) unsigned NOT NULL COMMENT '结束时间',
  `undertake` varchar(255) DEFAULT NULL COMMENT '揭榜人',
  PRIMARY KEY (`reward_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `reward`
--

INSERT INTO `reward` (`reward_id`, `re_image`, `re_title`, `re_content`, `author`, `re_status`, `add_time`, `end_time`, `undertake`) VALUES
(10, 'Uploads/reward/2017-09-27/59cb371093315.jpg', '测试', '测试', '44Gk5b6u5YeJ5b6S55y45oSP5rWF5oya5Y2K', 1, 1506490128, 1506700800, NULL),
(11, 'Uploads/reward/2017-09-27/59cb38610e22a.jpg', '悬赏1', '悬赏详情', '44Gk5b6u5YeJ5b6S55y45oSP5rWF5oya5Y2K', 0, 1506490464, 1506700800, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `solive`
--

CREATE TABLE IF NOT EXISTS `solive` (
  `solive_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '直播编号',
  `so_title` varchar(150) NOT NULL COMMENT '直播标题',
  `so_detail` varchar(255) NOT NULL COMMENT '直播简介',
  `so_author` varchar(80) NOT NULL COMMENT '发布者',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `so_link` text NOT NULL COMMENT '直播链接',
  `img` varchar(255) NOT NULL COMMENT '封面图',
  PRIMARY KEY (`solive_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `solive`
--

INSERT INTO `solive` (`solive_id`, `so_title`, `so_detail`, `so_author`, `add_time`, `so_link`, `img`) VALUES
(6, '直播', '直播', '王建1', 1506156258, '<p><iframe frameborder="0" width="640" height="498" src="https://v.qq.com/iframe/player.html?vid=o0014eg8yxo&tiny=0&auto=0" allowfullscreen=""></iframe></p>', 'Uploads/solive/2017-09-23/59c6288925a60.jpg'),
(7, '测试', '测试', '王建', 1506331734, '<p><iframe frameborder="0" width="640" height="498" src="https://v.qq.com/iframe/player.html?vid=o0014eg8yxo&tiny=0&auto=0" allowfullscreen=""></iframe></p>', 'Uploads/solive/2017-09-25/59c8cc570a239.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `token_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '令牌id',
  `tok_num` char(6) NOT NULL COMMENT '令牌编号',
  `tok_level` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '令牌等级1:欢喜令2：义士令3：英雄令4：大侠令5：大谦令',
  `bind_time` int(10) unsigned NOT NULL COMMENT '绑定时间',
  PRIMARY KEY (`token_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `token`
--

INSERT INTO `token` (`token_id`, `tok_num`, `tok_level`, `bind_time`) VALUES
(1, '524104', 1, 1506690100),
(2, '123456', 4, 0),
(3, '123456', 3, 0),
(4, '253696', 4, 1506687485),
(7, '369582', 5, 1506687447);

-- --------------------------------------------------------

--
-- 表的结构 `trade`
--

CREATE TABLE IF NOT EXISTS `trade` (
  `trade_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '行业id',
  `trade` varchar(25) NOT NULL COMMENT '行业',
  PRIMARY KEY (`trade_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='行业表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `trade`
--

INSERT INTO `trade` (`trade_id`, `trade`) VALUES
(1, '林业'),
(2, '牧业'),
(3, '工业'),
(4, '金融业');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
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
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `open_id`, `avatar`, `user_name`, `sex`, `info_id`, `trade_type`, `company`, `hobby`, `token_id`, `code`, `integral`, `reputation`) VALUES
(33, 'oz3UUuMvXTkhIji5cNnJox3FBEmA', 'http://wap.manjianghu.com/Uploads/user/2017-09-29/1506697738.jpeg', '5ZWK5a6e5omT5a6e55qE', 1, 12, NULL, NULL, NULL, 4, 'http://wap.manjianghu.com/Uploads/QRcode/oz3UUuMvXTkhIji5cNnJox3FBEmA.png', 74, 38),
(30, 'oz3UUuOxd8pB1Rms7k6hN9F8NAxo', 'http://wx.qlogo.cn/mmopen/vi_32/euqhROf5icb79TtgjOPdeQ9eQCKuJg2nt6109WaACEhmbvUyll8tCjzUKuMGOGicPzHIpQlwzrUUazk0K9W46oRQ/0', 'Wmg=', 1, NULL, NULL, NULL, NULL, NULL, 'http://wap.manjianghu.com/Uploads/QRcode/oz3UUuOxd8pB1Rms7k6hN9F8NAxo.png', 0, 0),
(31, 'oz3UUuAMVxYRdVQJtDcZWXsEIOEU', 'http://wx.qlogo.cn/mmopen/vi_32/23uGjp1UchZSbLhXAsXKe49oLZqr5zpBib21WlUvUJicDJKd64u1eeDOxB3eWXffbtYWkGBHOFz1d8v6zDySQAhQ/0', '44Gk5b6u5YeJ5b6S55y45oSP5rWF5oya5Y2K', 1, 11, NULL, NULL, NULL, 7, 'http://wap.manjianghu.com/Uploads/QRcode/oz3UUuAMVxYRdVQJtDcZWXsEIOEU.png', 144, 322),
(29, 'oz3UUuAMW4lxrdgHqGvN804zq5rE', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTI8G1cTqOrfpLywtdZ65VN5EuYjL8GsYAZibBSUVT8pwBicS6xR3pgEujVdqVvIo2w6ory0EF4cOibAg/0', '5Z2a5p6cLi4u', 1, 14, NULL, NULL, NULL, 1, 'http://wap.manjianghu.com/Uploads/QRcode/oz3UUuAMW4lxrdgHqGvN804zq5rE.png', 4, 4),
(34, 'oz3UUuBZdIrDtgmVAvaNpwe2yUEE', 'http://wx.qlogo.cn/mmopen/vi_32/GXxd8JuzJOmmV1hzYSC3sduicGfR8WQcR8hY4SicqAEhlIjflfwUKqL3iaUdRxRsf1YXiaoj1ybWZ95Wah0rOzuCOg/0', 'Um9vbQ==', 1, NULL, NULL, NULL, NULL, NULL, 'http://wap.manjianghu.com/Uploads/QRcode/oz3UUuBZdIrDtgmVAvaNpwe2yUEE.png', 0, 0),
(35, 'oz3UUuHVg7fFCTD8GXKB6D0urOl0', 'http://wx.qlogo.cn/mmopen/vi_32/IjZlRHk3KTIoFgT1hMHpu3oDam4mmtnqLZxxjeeRjiaZOljsg02fEf14ENDb08mz2X9c4Kvn9O8tQaatrGprMcg/0', 'QXJ0aGFz', 1, NULL, NULL, NULL, NULL, NULL, 'http://wap.manjianghu.com/Uploads/QRcode/oz3UUuHVg7fFCTD8GXKB6D0urOl0.png', 0, 0),
(37, 'oz3UUuAbx5C9E5piFRRgzM810mQw', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJWrw3dUByKrLiaBeSJqSAD8Ch0rT5jRWYib9icc4EekkVibIy1Msr2KhRs6Yjo4d8Y1ibYckMZKZgW8gw/0', '6L+95qKm77yG6LaK', 2, NULL, NULL, NULL, NULL, NULL, 'http://wap.manjianghu.com/Uploads/QRcode/oz3UUuAbx5C9E5piFRRgzM810mQw.png', 0, 0),
(36, 'oz3UUuGayRlVS9pLi77hAD4rMCvQ', 'http://wx.qlogo.cn/mmopen/vi_32/TLVBIdIKoI1G4YOrmibn1fKeHQ8ZAvbZxImaGjFxM1icZgXypiblE3ft44ibLLGTSIaDP0I1CmOGdUaRxcnNr6oiamw/0', 'aWYgb25seQ==', 1, 13, NULL, NULL, NULL, NULL, 'http://wap.manjianghu.com/Uploads/QRcode/oz3UUuGayRlVS9pLi77hAD4rMCvQ.png', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `info_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '地址信息编号',
  `name` varchar(150) NOT NULL COMMENT '收货人姓名',
  `phone` char(11) NOT NULL COMMENT '手机号',
  `area` varchar(225) NOT NULL COMMENT '地区',
  `ad_detail` varchar(255) DEFAULT NULL COMMENT '详细地址',
  `postcode` char(6) DEFAULT NULL COMMENT '邮编',
  PRIMARY KEY (`info_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `user_info`
--

INSERT INTO `user_info` (`info_id`, `name`, `phone`, `area`, `ad_detail`, `postcode`) VALUES
(13, '叶建国', '13438864763', '四川省 成都市 青羊区', '蜀汉路', '610000'),
(10, '王建', '18408210474', '北京 北京市 东城区', '11号', '610000'),
(12, '小二', '18408210474', '北京 北京市 东城区', '111', '610000'),
(11, '王建', '18408210462', '四川省 成都市 金牛区', '11', '610000'),
(14, '刘萧', '18782922873', '四川省 成都市 锦江区', '天府3街', '110120');
