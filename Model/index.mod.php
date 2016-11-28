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
	$sitename = $WebConfig[0]['value'];
	$keywords = $WebConfig[1]['value'];
	$description = $WebConfig[2]['value'];
}

$WebMenu = $mysqli->db->executeQuery("SELECT * FROM  `spe_system` WHERE `name` = 'menu'", true);
if($WebMenu) $tomenu = $WebMenu['box'];

$WebLinks = $mysqli->db->executeQuery("SELECT * FROM  `spe_system` WHERE `name` = 'links'", true);
if($WebLinks) $links = $WebLinks['box'];

$WebCss = $mysqli->db->executeQuery("SELECT * FROM  `spe_system` WHERE `name` = 'css'", true);
if($WebCss) $css = $WebCss['box'];

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = 5;//每页显示条数
$pageNow = ($page - 1) * $pageSize;
$BlogNum = $mysqli->db->executeQuery("SELECT * FROM  `spe_articles` ORDER BY `createdate` DESC", true, true);
$WebBlog = $mysqli->db->executeQuery("SELECT * FROM  `spe_articles` ORDER BY `createdate` DESC LIMIT {$pageNow}, {$pageSize}", true, true);

$pageno = new Page(count($BlogNum), 5, $page, $pageSize);

require VIEW_ROUTE . "common/header.inc.php";
require VIEW_ROUTE . "index.inc.php";
require VIEW_ROUTE . "common/footer.inc.php";
?>