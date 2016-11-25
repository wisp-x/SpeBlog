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

-- ----------------------------
--  Table structure for `spe_user`
-- ----------------------------
DROP TABLE IF EXISTS `spe_user`;
CREATE TABLE `spe_user` (
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '用户ID',
	`username` VARCHAR(16) NOT NULL UNIQUE COMMENT '账号昵称',
	`password` VARCHAR(32) NOT NULL COMMENT '账号密码',
	`user_check` VARCHAR(64) NULL COMMENT '登录状态',
	`sign_ip` VARCHAR(15) NOT NULL COMMENT '最后登录IP',
	`createdate` INT NOT NULL COMMENT '最后登录时间'
) ENGINE = MyISAM DEFAULT CHARSET = utf8 COLLATE utf8_general_ci;

-- ----------------------------
--  Records of `spe_user`
-- ----------------------------
INSERT INTO `spe_user` (`username`, `password`, `user_check`, `sign_ip`, `createdate`) VALUES ('admin', 'e10adc3949ba59abbe56e057f20f883e', '', '172.168.0.1', '123456');

-- ----------------------------
--  Table structure for `spe_system`
-- ----------------------------
DROP TABLE IF EXISTS `spe_system`;
CREATE TABLE `spe_system` (
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '导航ID',
	`name` VARCHAR(16) NOT NULL UNIQUE COMMENT '名称',
	`box` TEXT NOT NULL COMMENT 'Menu'
) ENGINE = MyISAM DEFAULT CHARSET = utf8 COLLATE utf8_general_ci;

-- ----------------------------
--  Records of `spe_system`
-- ----------------------------
INSERT INTO `spe_system` (`name`, `box`) VALUES (
'menu',
'<a href="javascript:void(0)">菜单</a>
<a href="javascript:void(0)">菜单</a>
<a href="javascript:void(0)">菜单</a>
<a href="javascript:void(0)">菜单</a>'
);

INSERT INTO `spe_system` (`name`, `box`) VALUES (
'links',
'<p class="text-center">
<a href="javascript:void(0)" target="_blank">友情链接</a>
<a href="javascript:void(0)" target="_blank">友情链接</a>
<a href="javascript:void(0)" target="_blank">友情链接</a>
<a href="javascript:void(0)" target="_blank">友情链接</a>
</p>'
);

INSERT INTO `spe_system` (`name`, `box`) VALUES ('css', '');


