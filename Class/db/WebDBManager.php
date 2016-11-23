<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.');

/**
 * 数据库操作类
 * @author 冬天的秘密
 * @link http://blog.itpk.cn
 */

class WebDBManager extends AbstractDBManager {

	public static function &GET_INSTANCE(){
		static $manager_;

		if ($manager_ == null) {
			$manager_ = new WebDBManager();
			$manager_->init(DBHOST, DBUSER, DBPASS, DBBASE, DBPORT, DBCODE);
		}

		return $manager_;
	}

}

?>