<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.');

/**
 * SpeBlog 配置文件
 * @author 熊二哈
 * @link http://www.xlogs.cn
 */

/**
 * 数据库配置
 * DBHOST	数据库主机
 * DBUSER	数据库用户名
 * DBPASS	数据库密码
 * DBBASE	数据库名字
 * DBPORT	数据库端口
 * DBCODE	数据库编码
 */
define('DBHOST', 'localhost');
define('DBUSER', 'speblog');
define('DBPASS', 'speblog');
define('DBBASE', 'speblog');
define('DBPORT', '3306');
define('DBCODE', 'utf8');

/**
 * 其他配置
 * INDEX_SUFFIX		首页标题后缀
 */
define('INDEX_SUFFIX', '〆我在纯白的世界里做着有关救赎的梦');

/**
 * 系统文件夹
 */
define('ROOT', dirname(__FILE__) . "/");
define('MODEL_ROUTE', ROOT . 'Model/');
define('CONTROLLER_ROUTE', ROOT . 'Controller/');
define('CLASS_ROUTE', ROOT . 'Class/');
define('DB_ROUTE', ROOT . 'Class/db/');
define('TOOLS_ROUTE', ROOT . 'Class/tools/');

/**
 * 默认模板
 * @var unknown
 */
define('VIEW_ROUTE', ROOT . 'View/speblog/');

?>