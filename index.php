<?php

/**
 * SpeBlog
 * @author 熊二哈
 * @link http://www.xlogs.cn
 */

require 'main.php';

$mod = Tools::param_filter("mod", "index");
$action = Tools::param_filter("action");

$title = "SpeBlog";

Controller::init(MODEL_ROUTE . $mod, $action);

?>