<?php

/**
 * SpeBlog
 * @author 熊二哈
 * @link http://www.xlogs.cn
 */

require 'main.php';

$mod = param_filter("mod", "index");
$action = param_filter("action");

Controller::init(MODEL_ROUTE . $mod, $action);

?>