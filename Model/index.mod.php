<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.');

/**
 * SpeBlog 逻辑处理
 * @author 熊二哈
 * @link http://www.xlogs.cn
 */

global $mod;
global $action;
global $mysqli;

$WebConfig = $mysqli->db->executeQuery("SELECT * FROM  `spe_config`", true);
if($WebConfig) {
	$title = "首页";
	$sitename = $WebConfig[0]['value'];
	$keywords = $WebConfig[1]['value'];
	$description = $WebConfig[2]['value'];
}

require VIEW_ROUTE . "common/header.inc.php";
require VIEW_ROUTE . "index.inc.php";
require VIEW_ROUTE . "common/footer.inc.php";
?>