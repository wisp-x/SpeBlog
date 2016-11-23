<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.');
/**
 * SpeBlog 控制器
 * @author 熊二哈
 * @link http://www.xlogs.cn
 */

Class Controller {
	
	private $mod = "";
	private $action = "";

	public static function init($mod, $action = "") {
		require_once $mod . ".mod.php";
	}
}
?>