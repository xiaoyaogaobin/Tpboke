/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50723
 Source Host           : localhost:3306
 Source Schema         : tp5

 Target Server Type    : MySQL
 Target Server Version : 50723
 File Encoding         : 65001

 Date: 07/01/2019 20:48:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `title_img` varchar(255) NOT NULL COMMENT '文章图片',
  `is_hot` varchar(4) DEFAULT '0' COMMENT '是否热门 1热门 0不热门',
  `is_top` varchar(4) DEFAULT '0' COMMENT '是否置顶 1置顶 0 不置顶',
  `cate_id` int(10) DEFAULT NULL COMMENT '栏目',
  `user_id` int(10) DEFAULT NULL COMMENT '作者',
  `content` text NOT NULL COMMENT '文章内容',
  `pv` int(10) NOT NULL DEFAULT '0' COMMENT '阅读量',
  `status` varchar(4) NOT NULL DEFAULT '1' COMMENT '是否隐藏显示文章',
  `create_at` int(10) NOT NULL COMMENT '文章创建时间',
  `update_at` int(10) NOT NULL COMMENT '文章修改时间',
  `destrin` varchar(100) DEFAULT '' COMMENT '文章描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of articles
-- ----------------------------
BEGIN;
INSERT INTO `articles` VALUES (1, '创投商学府sdd', '20190107/721c41ab458f047148445ef0ce13e513.png', '0', '0', 1, 10, '{美好的一天从我做起}', 36, '1', 1546683417, 1546683417, '美好明天再等待我们');
INSERT INTO `articles` VALUES (2, '创投商学府d', '20190105/41ca2fed3669bb31be8512fa1b22319f.png', '0', '0', 1, 10, 'sdfsdfsdfsdf', 5, '1', 1546694582, 1546694582, 'fdsfsdf');
INSERT INTO `articles` VALUES (3, '美好的明天开始', '20190107/ecb3af3f58dce8be089f4964bc90c688.png', '0', '0', 1, 10, '{<h1 id=\"h1--\"><a name=\"美好的明天从我们开始哦，你要的记得我哦\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>美好的明天从我们开始哦，你要的记得我哦</h1><p><a href=\"http://www.baidu.com\" title=\"美好记录\"><img src=\"/uploads/20190106/27c0bbc4193d25ecd3736dec1eb03610.png\" alt=\"美好记录\" title=\"美好记录\"></a></p>\r\n}', 134, '1', 1546748641, 1546748641, '记得我的意思');
INSERT INTO `articles` VALUES (4, '创投商学府', '20190107/740f6fdc0aca721a1e6bb2fa4d8eaa2c.png', '0', '0', 1, 10, '{<h1 id=\"h1-sdfsfsdfdsf\"><a name=\"sdfsfsdfdsf\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>sdfsfsdfdsf</h1>}', 10, '1', 1546758829, 1546758829, 'fdsfsdf');
INSERT INTO `articles` VALUES (5, '实体店', '20190106/caa1e0788c828e3a79b2d8ba6668826c.png', '0', '0', 1, 10, '<ol>\r\n<li>ddf第三方</li></ol>\r\n', 63, '1', 1546761181, 1546761181, '记得我的意思');
COMMIT;

-- ----------------------------
-- Table structure for categorys
-- ----------------------------
DROP TABLE IF EXISTS `categorys`;
CREATE TABLE `categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '栏目标题',
  `user_id` int(10) DEFAULT NULL COMMENT '作者',
  `sort` int(4) DEFAULT NULL COMMENT '栏目排序',
  `status` enum('1','0') DEFAULT '1' COMMENT '是否隐藏栏目',
  `create_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_at` int(10) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categorys
-- ----------------------------
BEGIN;
INSERT INTO `categorys` VALUES (1, 'php', 10, 1, '1', NULL, NULL);
INSERT INTO `categorys` VALUES (2, 'JavaScript', 10, 2, '1', NULL, NULL);
INSERT INTO `categorys` VALUES (3, '曲面电视', 10, 3, '1', 1546841963, 1546841963);
COMMIT;

-- ----------------------------
-- Table structure for collection
-- ----------------------------
DROP TABLE IF EXISTS `collection`;
CREATE TABLE `collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `article_id` int(11) NOT NULL COMMENT '文章id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of collection
-- ----------------------------
BEGIN;
INSERT INTO `collection` VALUES (28, 10, 1);
INSERT INTO `collection` VALUES (29, 10, 5);
INSERT INTO `collection` VALUES (30, 10, 4);
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `usename` varchar(29) NOT NULL COMMENT '用户名字',
  `password` varchar(200) NOT NULL COMMENT '用户密码',
  `status` char(255) NOT NULL DEFAULT '1' COMMENT '是否启用',
  `is_admin` smallint(4) NOT NULL DEFAULT '0' COMMENT '是否是管理员',
  `create_at` int(40) NOT NULL COMMENT '创建时间',
  `update_at` int(40) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES (10, 'admin', 'eaeb8c1250f18a13b72c212ceb85f4cfc100f817', '1', 1, 1546656859, 1546656859);
INSERT INTO `user` VALUES (11, 'gaobin', '3c95bdc9f35401106611b2bfa1fa44044a937c4d', '1', 0, 1546684706, 1546684706);
INSERT INTO `user` VALUES (12, 'admind', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1', 0, 1546684796, 1546684796);
INSERT INTO `user` VALUES (13, 'admindd', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1', 0, 1546684796, 1546684796);
COMMIT;

-- ----------------------------
-- Table structure for web
-- ----------------------------
DROP TABLE IF EXISTS `web`;
CREATE TABLE `web` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '网站标题',
  `keywords` varchar(100) NOT NULL COMMENT '网站关键字',
  `description` varchar(200) NOT NULL COMMENT '网站描述',
  `is_open` enum('1','0') DEFAULT '1' COMMENT '网站是否开启',
  `is_users` enum('1','0') DEFAULT '1' COMMENT '网站是否注册',
  `is_comment` enum('1','0') NOT NULL DEFAULT '1' COMMENT '网站是否开启评论',
  `create_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web
-- ----------------------------
BEGIN;
INSERT INTO `web` VALUES (1, '创投商学府', '创投', '美好的一天等待我们到来', '1', '0', '1', 1546862725, 1546862725);
COMMIT;

-- ----------------------------
-- Table structure for zan
-- ----------------------------
DROP TABLE IF EXISTS `zan`;
CREATE TABLE `zan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `article_id` int(11) NOT NULL COMMENT '文章id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zan
-- ----------------------------
BEGIN;
INSERT INTO `zan` VALUES (30, 10, 5);
INSERT INTO `zan` VALUES (31, 10, 4);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
