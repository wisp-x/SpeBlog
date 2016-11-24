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
	$title = "后台管理";
	$sitename = $WebConfig[0]['value'];
	$keywords = $WebConfig[1]['value'];
	$description = $WebConfig[2]['value'];
}

# ======> Login status
if(isset($_COOKIE['user_check'])) $Admin = $mysqli->db->executeQuery("SELECT * FROM `spe_user` WHERE `user_check` = '{$_COOKIE['user_check']}'", true);

# ======> Processing AJAX requests
if($action == "login") {
	header("content-type:text/plain; charset=utf-8");
	$result = array();
	$username = param_filter("username");
	$password = md5(param_filter("password"));
	if(!is_empty($username) && !is_empty($password)) {
		$login = $mysqli->db->executeQuery("SELECT * FROM `spe_user` WHERE `username` = '{$username}' AND `password` = '{$password}'") > 0 ? true:false;
		if($login) {
			$data = time();
			$user_check = base64_encode(md5("SPEBLOG" . getRandString(12, 0) . $date));
			setcookie('user_check', $user_check, time() + (60 * 60 * 24 * 30));
			$login = $mysqli->db->executeQuery("UPDATE `spe_user` SET `user_check` = '{$user_check}' WHERE `username` = '{$username}' AND `password` = '{$password}'") > 0 ? true:false;
			if($login) {
				$result['code'] = 1;
			}
		} else {
			$result['code'] = 0;
		}
	}
	exit(json_encode($result));
} elseif ($action == "logout") {
	header("content-type:text/plain; charset=utf-8");
	$result = array();
	setcookie('user_check', '', time() - 3600);
	$result['code'] = 1;
	exit(json_encode($result));
}

require VIEW_ROUTE . "common/header.inc.php";
$Admin ? require VIEW_ROUTE . "admin/admin.index.inc.php" : require VIEW_ROUTE . "admin/admin.login.inc.php";
require VIEW_ROUTE . "common/footer.inc.php";
?>