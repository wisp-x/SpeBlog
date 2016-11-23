<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.');

/**
 * SpeBlog 静态工具类
 * @author 熊二哈
 * @link http://www.xlogs.cn
 */

Class Tools {

	/**
	 * 判断某个值是不是为空或者为NULL
	 * @param string $param
	 * @return boolean
	 */
	public static function is_empty($param) {
		return ($param == null || trim($param) == "") ? true : false;
	}

	/**
	 * 处理页面接收的参数，防止SQL注入
	 * @param string $param 接收的参数
	 * @param unknown $defVal 当没有此参数时的默认值
	 * @param boolean $is_bool 接收的参数是否转换为0/1（一般当参数的值为true、false、0、1时使用）
	 * @return unknown 返回经过处理的参数值
	 */
	public static function param_filter($param, $defVal = null, $is_bool = false) {
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
	public static function param_filter_checkbox($param, $defVal = null) {
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
	public static function param_is_exits($param) {
		return isset($_GET["$param"]) ? true : (isset($_POST["$param"]) ? true : false);
	}

	/**
	 * 获取访问者IP地址
	 * @return Ambigous <string, unknown>
	 */
	public static function getIP() {
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
	public static function isHttps() {
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
	public static function get_microtime($start_microtime, $end_microtime) {
		list($smt, $snt) = explode(' ', $start_microtime);
		list($emt, $ent) = explode(' ', $end_microtime);
		if ($snt == $ent) {
			return intval(floatval($emt) * 1000) - intval(floatval($smt) * 1000);
		}
		return ($ent - $snt) * 1000 + intval(floatval($emt) * 1000) - intval(floatval($smt) * 1000);
	}

}
?>