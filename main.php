<?php

/**
 * SpeBlog 程序入口
 * @author 熊二哈
 * @link http://www.xlogs.cn
 */

#session_start();
define('SPEBLOG', 'SPEBLOG');

if (!file_exists("config.php") || (file_exists("config.php") && file_get_contents("config.php") == "")) header("location:install/index.php");

require 'config.php';

function __autoload($className) {
	$pathUrl = DB_ROUTE;
	$file = $pathUrl . $className . ".php";
	if(file_exists($file)) require_once($file);
}

$mysqli = new WebDBConnection();

require TOOLS_ROUTE . "Tools.php";
require TOOLS_ROUTE . "Page.php";
require CONTROLLER_ROUTE . "Controller.php";

?>