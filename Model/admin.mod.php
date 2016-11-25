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

$WebMenu = $mysqli->db->executeQuery("SELECT * FROM  `spe_system` WHERE `name` = 'menu'", true);
if($WebMenu) {
	$tomenu = $WebMenu['box'];
}

$WebLinks = $mysqli->db->executeQuery("SELECT * FROM  `spe_system` WHERE `name` = 'links'", true);
if($WebLinks) {
	$links = $WebLinks['box'];
}

# ======> Login status
if(isset($_COOKIE['user_check'])) $Admin = $mysqli->db->executeQuery("SELECT * FROM `spe_user` WHERE `user_check` = '{$_COOKIE['user_check']}'", true);

if($Admin) {
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
				$ip = getIP();
				$user_check = base64_encode(md5("SPEBLOG" . getRandString(12, 0) . $date));
				setcookie('user_check', $user_check, time() + (60 * 60 * 24 * 30));
				$login = $mysqli->db->executeQuery("UPDATE `spe_user` SET `user_check` = '{$user_check}', `sign_ip` = '{$ip}', `createdate` = $data WHERE `username` = '{$username}' AND `password` = '{$password}'") > 0 ? true:false;
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
	} elseif ($action == "setSystem") {
		header("content-type:text/plain; charset=utf-8");
		$result = array();
		$sitename = param_filter("sitename");
		$keywords = param_filter("keywords");
		$description = param_filter("description");
		$setSystem = $mysqli->db->executeMultiQuery(
			"UPDATE `spe_config` SET `value` =  '{$sitename}' WHERE `key` = 'sitename';".
			"UPDATE `spe_config` SET `value` =  '{$keywords}' WHERE `key` = 'keywords';".
			"UPDATE `spe_config` SET `value` =  '{$description}' WHERE `key` = 'description';"
			);
		if($setSystem) {
			$result['code'] = 1;
		} else {
			$result['code'] = 0;
		}
		exit(json_encode($result));
	} elseif ($action == "setMenu") {
		header("content-type:text/plain; charset=utf-8");
		$result = array();
		$menuhtm = $_POST['menuhtm'];
		$setMenu = $mysqli->db->executeQuery("UPDATE `spe_system` SET `box` = '{$menuhtm}' WHERE `name` = 'menu'") > 0 ? true:false;
		if($setMenu) {
			$result['code'] = 1;
		} else {
			$result['code'] = 0;
		}
		exit(json_encode($result));
	} elseif ($action == "setLinks") {
		header("content-type:text/plain; charset=utf-8");
		$result = array();
		$linkshtm = $_POST['linkshtm'];
		$setMenu = $mysqli->db->executeQuery("UPDATE `spe_system` SET `box` = '{$linkshtm}' WHERE `name` = 'links'") > 0 ? true:false;
		if($setMenu) {
			$result['code'] = 1;
		} else {
			$result['code'] = 0;
		}
		exit(json_encode($result));
	}
}

require VIEW_ROUTE . "common/header.inc.php";
$Admin ? require VIEW_ROUTE . "admin/admin.index.inc.php" : require VIEW_ROUTE . "admin/admin.login.inc.php";
require VIEW_ROUTE . "common/footer.inc.php";
?>