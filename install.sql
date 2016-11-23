SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `spe_config`
-- ----------------------------
DROP TABLE IF EXISTS `spe_config`;
CREATE TABLE `spe_config` (
	`key` varchar(32) NOT NULL,
	`value` varchar(255) NOT NULL DEFAULT '',
	PRIMARY KEY (`key`),
	UNIQUE KEY `key` (`key`)
) ENGINE = MyISAM DEFAULT CHARSET = utf8 COLLATE utf8_general_ci;

-- ----------------------------
--  Records of `spe_config`
-- ----------------------------
BEGIN;
INSERT INTO `spe_config` VALUES ('sitename', 'SpeBlog'), ('keywords', 'SpeBlog,Blog,简约博客'), ('description', 'SpeBlog，简约、快速的视觉体验');
COMMIT;