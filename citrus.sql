/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100132
Source Host           : localhost:3306
Source Database       : citrus

Target Server Type    : MYSQL
Target Server Version : 100132
File Encoding         : 65001

Date: 2019-11-14 18:17:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES ('1', 'igorn', '$2a$10$K7I8YS.dXb3R2bG75B2bKOgJg2lzUv3lYqTI9wEi5kCHSRgBXGtna');
INSERT INTO `admin_users` VALUES ('2', 'citrusTest', '$2a$10$qZikpmL27bQHesyCMHT1sueEjAFTYHCmVtzYWV0L/lC2WW2UyCY6.');

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('1', 'Marko Maric', 'mare@test.com', 'Pomorandza je ok', '1');
INSERT INTO `comments` VALUES ('2', 'Pera Peric', 'pera@tes.com', 'Limun je ok', '1');
INSERT INTO `comments` VALUES ('3', 'Igor  Nikolic', 'igor@test.com', 'Dobro izgledaju ove vocke', '1');
INSERT INTO `comments` VALUES ('4', 'novi', 'a@a.com', 'neodobren. za brisanje', '0');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', 'limun', 'des limun', 'limun.jpg');
INSERT INTO `products` VALUES ('2', 'pomorandza', 'des pomorandza', 'pomorandza.jpg');
INSERT INTO `products` VALUES ('3', 'grejp', 'des grejp', 'grejp.jpg');
INSERT INTO `products` VALUES ('4', 'nar', 'des nar', 'nar.jpg');
INSERT INTO `products` VALUES ('7', 'ananas', 'des ananas', 'ananas.jpg');
INSERT INTO `products` VALUES ('8', 'lubenica', 'des lubenica', 'lubenica.jpg');
