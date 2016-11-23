<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.');

/**
 * 数据库连接类
 * @author 冬天的秘密
 * @link http://blog.itpk.cn
 */

class WebDBConnection {

	public $db;
	public function __construct() {
		$this->db = WebDBManager::GET_INSTANCE();
	}

	public static function GET_DB() {
		return WebDBManager::GET_INSTANCE();
	}

}

?>