<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.');

/**
 * SpeBlog 工具方法
 * @author 熊二哈
 * @link http://www.xlogs.cn
 */

/**
 * 判断某个值是不是为空或者为NULL
 * @param string $param
 * @return boolean
 */
function is_empty($param) {
	return ($param == null || trim($param) == "") ? true : false;
}

/**
 * 处理页面接收的参数，防止SQL注入
 * @param string $param 接收的参数
 * @param unknown $defVal 当没有此参数时的默认值
 * @param boolean $is_bool 接收的参数是否转换为0/1（一般当参数的值为true、false、0、1时使用）
 * @return unknown 返回经过处理的参数值
 */
function param_filter($param, $defVal = null, $is_bool = false) {
	$return_param = $defVal;
	if (isset($_GET["$param"])) {
		$return_param = $_GET["$param"];
	} elseif (isset($_POST["$param"])) {
		$return_param = $_POST["$param"];
	}
	if ($is_bool) {
		return ($return_param == null || $return_param == "false" || $return_param === "0" || $return_param == "") ? false : true;
	}
	return ($return_param == null) ? null : trim(addslashes($return_param));
}

/**
 * 处理通过POST表单的checkbox值
 * @param string $param
 * @return array
 */
function param_filter_checkbox($param, $defVal = null) {
	$return_array = $defVal;
	if (isset($_POST["$param"])) {
		$return_params = $_POST["$param"];
		if (is_array($return_params)) {
			$return_array = array();
			foreach ($return_params as $return_param) {
				array_push($return_array, trim(addslashes($return_param)));
			}
		}
	}
	return $return_array;
}

/**
 * 判断是否接收到某参数
 * @param string $param
 * @return boolean
 */
function param_is_exits($param) {
	return isset($_GET["$param"]) ? true : (isset($_POST["$param"]) ? true : false);
}

/**
 * 获取访问者IP地址
 * @return Ambigous <string, unknown>
 */
function getIP() {
	$ip = "";
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
		$ip = getenv("HTTP_CLIENT_IP");
	} else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	} else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
		$ip = getenv("REMOTE_ADDR");
	} else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
		$ip = $_SERVER['REMOTE_ADDR'];
	} else {
		$ip = "unknown";
	}
	if (strpos($ip, ',')) {
		$ipArr = explode(',', $ip);
		$ip = $ipArr[0];
	}
	return $ip;
}

/**
 * 判断当前访问的是不是HTTPS
 * @return boolean
 */
function isHttps() {
	if (!isset($_SERVER['HTTPS'])) {
		return false;
	}
	if ($_SERVER['HTTPS'] === 1) {				//Apache
		return true;
	} elseif ($_SERVER['HTTPS'] === 'on') {		//IIS
		return true;
	} elseif ($_SERVER['SERVER_PORT'] == 443) {	//其他
		return true;
	}
	return false;
}

/**
 * 获取传入的开始和结束microtime()，获取两个时间相差的毫秒值
 * @param $start_microtime
 * @param $end_microtime
 * @return number
 */
function get_microtime($start_microtime, $end_microtime) {
	list($smt, $snt) = explode(' ', $start_microtime);
	list($emt, $ent) = explode(' ', $end_microtime);
	if ($snt == $ent) {
		return intval(floatval($emt) * 1000) - intval(floatval($smt) * 1000);
	}
	return ($ent - $snt) * 1000 + intval(floatval($emt) * 1000) - intval(floatval($smt) * 1000);
}

/**
 * 生成随机字符串
 * @param int $length 生成的随机字符长度
 * @param int $type 生成随机字符的类型： 0为大小写字母加数字，1为小写字母，2为大写字母，3为大小写字母，4为数字，5为小写字母加数字，6为大写字母加数字
 * @return string | int
 */
function getRandString($length = 12, $type = 0) {
	$lower	= range('a', 'z');
	$upper	= range('A', 'Z');
	$number	= range(0, 9);

	if($type == 0) {
		$chars = array_merge($lower, $upper, $number);
	} elseif($type == 1) {
		$chars = $lower;
	} elseif($type == 2) {
		$chars = $upper;
	} elseif($type == 3) {
		$chars = array_merge($lower, $upper);
	} elseif($type == 4) {
		$chars = $number;
	} elseif($type == 5) {
		$chars = array_merge($lower, $number);
	} elseif($type == 6) {
		$chars = array_merge($upper, $number);
	}

	shuffle($chars);
	$char_keys	= array_rand($chars, $length);
	shuffle($char_keys);

	$rand = '';
	foreach($char_keys as $key) {
		$rand .= $chars[$key];
	}
	return $rand;
}
?>