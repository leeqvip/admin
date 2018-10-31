<?php

use Phinx\Migration\AbstractMigration;

class DbInit extends AbstractMigration
{
<<<<<<< HEAD
<<<<<<< HEAD
    protected $tablePrefix = '';

=======
    protected $tablePrefix='';
>>>>>>> 5167ddb510d524886cc7b365feec18fd3844092c
=======
    protected $tablePrefix = '';

>>>>>>> b7180f45a453a8a1c0c80361df4db1fa4fae0a08
    /**
     * Migrate Up.
     */
    public function up()
    {
        if ($this->getAdapter()->hasOption('table_prefix')) {
            $this->tablePrefix = $this->getAdapter()->getOption('table_prefix');
        }

        $this->execute(
            <<<EOT

-- ----------------------------
-- Table structure for techadmin_adminers
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}adminers`;
CREATE TABLE `{$this->tablePrefix}adminers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_account` varchar(50) NOT NULL COMMENT '用户名',
  `admin_password` varchar(255) NOT NULL COMMENT '密码',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `login_at` timestamp NULL DEFAULT NULL,
  `login_ip` varchar(255) DEFAULT NULL,
  `status` tinyint(255) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for techadmin_adminers_roles
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}adminers_roles`;
CREATE TABLE `{$this->tablePrefix}adminers_roles` (
  `role_id` int(11) NOT NULL,
  `adminer_id` int(11) NOT NULL,
  KEY `admin_role_users_role_id_user_id_index` (`role_id`,`adminer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- ----------------------------
-- Table structure for techadmin_advertisings
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}advertisings`;
CREATE TABLE `{$this->tablePrefix}advertisings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `block` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT '_blank',
  `sort` tinyint(255) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(255) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;



-- ----------------------------
-- Table structure for techadmin_advertisings_blocks
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}advertisings_blocks`;
CREATE TABLE `{$this->tablePrefix}advertisings_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `block` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of techadmin_advertisings_blocks
-- ----------------------------
INSERT INTO `{$this->tablePrefix}advertisings_blocks` VALUES ('1', '首页轮播图', 'banner');

-- ----------------------------
-- Table structure for techadmin_articles
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}articles`;
CREATE TABLE `{$this->tablePrefix}articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `type` tinyint(5) DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `summary` tinytext,
  `image` varchar(255) DEFAULT NULL,
  `content` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(255) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for techadmin_categorys
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}categorys`;
CREATE TABLE `{$this->tablePrefix}categorys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'list',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- ----------------------------
-- Table structure for techadmin_configs
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}configs`;
CREATE TABLE `{$this->tablePrefix}configs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `model` varchar(255) DEFAULT 'text',
  `key` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'site',
  `desc` varchar(255) DEFAULT NULL,
  `system` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for techadmin_links
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}links`;
CREATE TABLE `{$this->tablePrefix}links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `block` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT '_blank',
  `sort` tinyint(255) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(255) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for techadmin_links_blocks
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}links_blocks`;
CREATE TABLE `{$this->tablePrefix}links_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `block` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of techadmin_links_blocks
-- ----------------------------
INSERT INTO `{$this->tablePrefix}links_blocks` VALUES ('1', '友情链接', 'friendlink');

-- ----------------------------
-- Table structure for techadmin_menus
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}menus`;
CREATE TABLE `{$this->tablePrefix}menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uri` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ----------------------------
-- Table structure for techadmin_navs
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}navs`;
CREATE TABLE `{$this->tablePrefix}navs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uri` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8_unicode_ci DEFAULT '_self',
  `sort` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ----------------------------
-- Table structure for techadmin_operation_logs
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}operation_logs`;
CREATE TABLE `{$this->tablePrefix}operation_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adminer_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `method` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `input` text COLLATE utf8_unicode_ci,
  `useragent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_operation_log_user_id_index` (`adminer_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=780 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for techadmin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}permissions`;
CREATE TABLE `{$this->tablePrefix}permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `http_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ----------------------------
-- Table structure for techadmin_roles
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}roles`;
CREATE TABLE `{$this->tablePrefix}roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for techadmin_roles_permissions
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}roles_permissions`;
CREATE TABLE `{$this->tablePrefix}roles_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ----------------------------
-- Table structure for techadmin_single
-- ----------------------------
DROP TABLE IF EXISTS `{$this->tablePrefix}single`;
CREATE TABLE `{$this->tablePrefix}single` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `type` tinyint(5) DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `summary` tinytext,
  `image` varchar(255) DEFAULT NULL,
  `content` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(255) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


INSERT INTO `techadmin_menus` VALUES ('1', '0', '控制台', 'am-icon-home', '/dashboard', '1', null, null);
INSERT INTO `techadmin_menus` VALUES ('2', '0', '安全管理', 'am-icon-user-secret', '', '2', null, null);
INSERT INTO `techadmin_menus` VALUES ('3', '2', '管理员', '', '/auth/adminer', '3', null, null);
INSERT INTO `techadmin_menus` VALUES ('4', '2', '角色', '', '/auth/role', '4', null, null);
INSERT INTO `techadmin_menus` VALUES ('5', '2', '权限', '', '/auth/permission', '5', null, null);
INSERT INTO `techadmin_menus` VALUES ('8', '0', '内容管理', 'am-icon-file-text', '/logs', '7', null, null);
INSERT INTO `techadmin_menus` VALUES ('11', '8', '栏目', '', '/category', '7', null, null);
INSERT INTO `techadmin_menus` VALUES ('12', '8', '文章', '', '/article', '7', null, null);
INSERT INTO `techadmin_menus` VALUES ('17', '0', '常规管理', 'am-icon-cog', '', '2', null, null);
INSERT INTO `techadmin_menus` VALUES ('18', '17', '系统配置', null, '/config', '0', null, null);
INSERT INTO `techadmin_menus` VALUES ('19', '8', '单页', null, '/single', '0', null, null);
INSERT INTO `techadmin_menus` VALUES ('20', '2', '操作日志', null, '/auth/log', '0', null, null);
INSERT INTO `techadmin_menus` VALUES ('21', '8', '导航', null, '/nav', '0', null, null);
INSERT INTO `techadmin_menus` VALUES ('22', '0', '营销工具', 'am-icon-send', '', '10', null, null);
INSERT INTO `techadmin_menus` VALUES ('23', '22', '广告', null, '/advertising', '0', null, null);
INSERT INTO `techadmin_menus` VALUES ('24', '22', '链接', null, '/link', '0', null, null);

INSERT INTO `techadmin_adminers` VALUES (1, 'admin', '\$2y\$10\$V18y/rcfTm5cMv2sOaLR..ZrKVEE3U/klNHaMi6ji/wdKE8esNz1i', '2018-09-12 17:20:27', '2018-09-21 16:26:49', '2018-09-21 16:26:49', '127.0.0.1', '1');
INSERT INTO `techadmin_permissions` VALUES ('1', '所有权限', 'ALL', '/*', '2018-09-14 13:55:31', '2018-09-14 13:56:05');
INSERT INTO `techadmin_roles` VALUES ('1', '超级管理员', '2018-09-20 16:14:01', '2018-09-20 16:14:01');
INSERT INTO `techadmin_roles_permissions` VALUES ('1', '1');
INSERT INTO `techadmin_adminers_roles` VALUES ('1', '1');
EOT
<<<<<<< HEAD
<<<<<<< HEAD
=======


>>>>>>> 5167ddb510d524886cc7b365feec18fd3844092c
=======
>>>>>>> b7180f45a453a8a1c0c80361df4db1fa4fae0a08
            );
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
    }
}
