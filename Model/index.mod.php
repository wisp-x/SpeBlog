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
	$version = $WebConfig[3]['value'];
	$whecomment = $WebConfig[4]['value'];
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

# ======> 如果评论组件开启/这里判断一下是为了防止恶意模拟提交评论
if($whecomment == 1) {
	if($action == "comment_up") {
		header("content-type:text/plain; charset=utf-8");
		$result = array();
		$article_id = htmlspecialchars(param_filter("article_id"));
		$name = htmlspecialchars(param_filter("name"));
		$mail = htmlspecialchars(param_filter("mail"));
		$url = htmlspecialchars(param_filter("url"));
		$txt = htmlspecialchars(param_filter("txt"));
		$date = time();
		$ip = getIP();
		if(!is_empty($article_id) && !is_empty($name) && !is_empty($mail) && !is_empty($url) && !is_empty($txt)) {
			$comment = $mysqli->db->executeQuery("INSERT INTO `spe_comment` (`article_id`, `reply_id`, `name`, `mail`, `url`, `box`, `ip`, `createdate`) VALUES ({$article_id}, '', '{$name}', '{$mail}', '{$url}', '{$txt}', '{$ip}', {$date})") > 0 ? true:false;
			if($comment) $result['code'] = 1;
		}
		exit(json_encode($result));
	}
}

require VIEW_ROUTE . "common/header.inc.php";
require VIEW_ROUTE . "index.inc.php";
require VIEW_ROUTE . "common/footer.inc.php";
?>