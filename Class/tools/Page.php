<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.');
/**
 * 分页工具类
 * @author 熊二哈
 * @link http://www.xlogs.cn
 */
class PageUtil {

	private $limit;
	private $count;
	private $pageno;
	private $maxpage;

	private function setLimit($limit) {
		if (!is_numeric($limit) || $limit <= 1) {
			$this->limit = 1;
		} else {
			$this->limit = $limit;
		}
	}

	/**
	 * 每页数据显示的最大限制
	 * @return number
	 */
	public function getLimit() {
		return $this->limit;
	}

	private function setCount($count) {
		if (!is_numeric($count) || $count <= 0) {
			$this->count = 0;
		} else {
			$this->count = $count;
		}
	}

	/**
	 * 所有数据的记录数
	 * @return number
	 */
	public function getCount() {
		return $this->count;
	}

	private function setPageno($pageno) {
		if (!is_numeric($pageno) || $pageno <= 1) {
			$this->pageno = 1;
		} elseif ($pageno > $this->maxpage) {
			$this->pageno = $this->maxpage;
		} else {
			$this->pageno = $pageno;
		}
	}

	/**
	 * 当前正确的页数
	 * @return number
	 */
	public function getPageno() {
		return $this->pageno;
	}

	private function setMaxpage() {
		$maxpage = ceil($this->count / $this->limit);
		$this->maxpage = ($maxpage == 0) ? 1 : $maxpage;
	}

	/**
	 * 最大页数
	 * @return number
	 */
	public function getMaxpage() {
		return $this->maxpage;
	}

	/**
	 * 分页偏移量
	 * @return number
	 */
	public function getOffset() {
		return ($this->pageno - 1) * $this->limit;
	}

	/**
	 * 初始化分页工具
	 * @param number $pageno
	 * @param number $limit
	 * @param number $count
	 */
	public function __construct($pageno, $limit, $count) {
		$this->setCount($count);
		$this->setLimit($limit);
		$this->setMaxpage();
		$this->setPageno($pageno);
	}

	/**
	 * 第一页的页数
	 * @return number
	 */
	public function getFirstPage() {
		return 1;
	}

	/**
	 * 最后一页的页数
	 * @return number
	 */
	public function getLastPage() {
		return $this->maxpage;
	}

	/**
	 * 判断当前页是否还有上一页
	 * @return boolean
	 */
	public function isHasPreviousPage() {
		if ($this->pageno - 1 <= 0) {
			return false;
		}
		return true;
	}

	/**
	 * 判断当前页是否还有下一页
	 * @return boolean
	 */
	public function isHasNextPage() {
		if ($this->pageno + 1 > $this->maxpage) {
			return false;
		}
		return true;
	}

	/**
	 * 获取正确的上一页的页数
	 * @return number
	 */
	public function getPreviousPage() {
		if ($this->pageno - 1 <= 0) {
			return 1;
		}
		return $this->pageno - 1;
	}

	/**
	 * 获取正确的下一页的页数
	 * @return number
	 */
	public function getNextPage() {
		if ($this->pageno + 1 > $this->maxpage) {
			return $this->maxpage;
		}
		return $this->pageno + 1;
	}

	public function getPageHtml($id, $class, $url, $param, $pagenoName) {
		$html = '<ul id="' . $id . '" class="' . $class . '">';
		if ($this->getPageno() == 1) {
			$html .= '<li><a class="const nao" href="javascript:void(0)">首页</a><li>';
			$html .= '<li><a class="const nao" href="javascript:void(0)">上页</a><li>';
		} else {
			$html .= '<li><a class="const" href="' . $url . '?' . (is_empty($param)?'':$param.'&') . $pagenoName . '=1">首页</a><li>';
			$html .= '<li><a class="const" href="' . $url . '?' . (is_empty($param)?'':$param.'&') . $pagenoName . '=' . $this->getPreviousPage() . '">上页</a><li>';
		}
		for ($i = 1; $i <= $this->maxpage; $i++) {
			if ($i == $this->getPageno()) {
				$html .= '<li><a class="dynamic selected" href="javascript:void(0)">' . $i . '</a></li>';
			} elseif ($i == 1 || ($i >= $this->getPageno() - 2 && $i <= $this->getPageno() + 2) || $i == $this->getMaxpage()) {
				$html .= '<li><a class="dynamic" href="' . $url . '?' . (is_empty($param)?'':$param.'&') . $pagenoName . '=' . $i . '">' . $i . '</a></li>';
			} elseif ($i == $this->getPageno() - 3 || $i == $this->getPageno() + 3) {
				$html .= '<li>...</li>';
			} else {
				continue;
			}
		}
		if ($this->getPageno() == $this->getMaxpage()) {
			$html .= '<li><a class="const nao" href="javascript:void(0)">下页</a><li>';
			$html .= '<li><a class="const nao" href="javascript:void(0)">尾页</a><li>';
		} else {
			$html .= '<li><a class="const" href="' . $url . '?' . (is_empty($param)?'':$param.'&') . $pagenoName . '=' . $this->getNextPage() . '">下页</a><li>';
			$html .= '<li><a class="const" href="' . $url . '?' . (is_empty($param)?'':$param.'&') . $pagenoName . '=' . $this->getMaxpage() . '">尾页</a><li>';
		}
		$html .= '</ul>';
		return $html;
	}

}

?>