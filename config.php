<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.');

/**
 * SpeBlog 配置文件
 * @author 熊二哈
 * @link http://www.xlogs.cn
 */

/**
 * 数据库配置（编码统一为UTF-8）
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
 * 网站安装二级目录(如果您安装本程序是在二级目录下，请配置二级目录名称)
 */
define('WEBSITE', "demo");

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