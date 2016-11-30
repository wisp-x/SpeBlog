<?php

/**
 * SpeBlog 安装程序
 * @author 熊二哈
 * @link http://www.xlogs.cn
 */

$Step = $_GET['step'];

$config_file = "../config.php";

if (!file_exists($config_file) && file_get_contents($config_file) == "") {
	exit("程序已安装，重新安装请清空 config.php 文件");
}

switch ($Step) {
	case 1:
		$title = "安装环境检测";
		$is_support_curl = function_exists('curl_init');
		$is_support_mysqli = class_exists('mysqli');
		$php_version_ge530 = strnatcasecmp(PHP_VERSION, '5.3.0') >= 0 ? true : false;
		$is_support_config_writable = is_writable($config_file);
		if (!$is_support_curl || !$is_support_mysqli || !$php_version_ge530) {
			$tip = "<div class=\"alert alert-danger text-center\" role=\"alert\"><i class=\"fa fa-warning\"></i> 你必须保证每项通过才能安装 </div>";
			break;
		} elseif (!$is_support_config_writable) {
			$tip = "<div class=\"alert alert-danger text-center\" role=\"alert\"><i class=\"fa fa-warning\"></i> 请检查 config.php 文件是否存在或可写 </div>";
			break;
		}
		break;
	case 2:
		$title = "数据库配置";
		$state = $_GET['state'];
		if ($state == "connect") {
			$db_host = $_POST['db_host'];
			$db_base = $_POST['db_base'];
			$db_user = $_POST['db_user'];
			$db_pass = $_POST['db_pass'];
			$db_port = $_POST['db_port'];
			$db_code = "utf8";
			$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_base, $db_port);
			$mysqli->set_charset($db_code);
			if (mysqli_connect_errno()) {
				$tip = "<div class=\"alert alert-danger text-center\" role=\"alert\"><i class=\"fa fa-warning\"></i> 数据库连接失败</div>";
				break;
			}
			$_sql = file_get_contents('install.sql');
			$_arr = explode(';', $_sql);
			foreach ($_arr as $_value) {
				$mysqli->query($_value . ';');
			}
			$mysqli->close();
			$mysqli = null;
			$file_put_contents = file_put_contents($config_file, "<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.');\r\n\r\n/**\r\n * SpeBlog 配置文件\r\n * @author 熊二哈\r\n * @link http://www.xlogs.cn\r\n */\r\n\r\n/**\r\n * 数据库配置\r\n * DBHOST	数据库主机\r\n * DBUSER	数据库用户名\r\n * DBPASS	数据库密码\r\n * DBBASE	数据库名字\r\n * DBPORT	数据库端口\r\n * DBCODE	数据库编码\r\n */\r\n\r\ndefine('DBHOST', '{$db_host}');\r\ndefine('DBUSER', '{$db_user}');\r\ndefine('DBPASS', '{$db_pass}');\r\ndefine('DBBASE', '{$db_base}');\r\ndefine('DBPORT', '{$db_port}');\r\ndefine('DBCODE', '{$db_code}');\r\n\r\n/**\r\n * 其他配置\r\n * INDEX_SUFFIX		首页标题后缀\r\n */\r\ndefine('INDEX_SUFFIX', '〆我在纯白的世界里做着有关救赎的梦');\r\n\r\n/**\r\n * 系统文件夹\r\n */\r\ndefine('ROOT', dirname(__FILE__) . '/');\r\ndefine('MODEL_ROUTE', ROOT . 'Model/');\r\ndefine('CONTROLLER_ROUTE', ROOT . 'Controller/');\r\ndefine('CLASS_ROUTE', ROOT . 'Class/');\r\ndefine('DB_ROUTE', ROOT . 'Class/db/');\r\ndefine('TOOLS_ROUTE', ROOT . 'Class/tools/');\r\n\r\n/**\r\n * 默认模板\r\n * @var unknown\r\n */\r\ndefine('VIEW_ROUTE', ROOT . 'View/speblog/');\r\n?>");
			if ($file_put_contents) {
				header("location: ?step=3");
				break;
			}
			$tip = "<div class=\"alert alert-danger text-center\" role=\"alert\"><i class=\"fa fa-warning\"></i> 配置文件写入失败</div>";
			break;
		}
		break;
	case 3:
		$title = "安装成功";
		break;
	default:
		$title = "安装向导";
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>SPE BLOG - INSTALL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/View/speblog/img/favicon.ico" mce_href="/View/speblog/img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style rel="stylesheet">
	body{font-family:"宋体","新宋体";color:#555;background:#f3f3f3;word-break:break-all;font-size:1.5em;padding-top:70px}
	.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6{margin-top:0}
	a{outline:0;text-decoration:none;blr:expression(this.onFocus=this.blur())}
	a:link{text-decoration:none}
	a:visited{text-decoration:none}
	a:hover{text-decoration:none}
	a:active{text-decoration:none}
	#permit{height:250px;overFlow-y:scroll;overFlow-x:hidden}
	.tip-green{color:green}
	.tip-red{color:red}
	@media (max-width:768px){body{padding-top:20px}}
  </style>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-primary">
			<div class="panel-heading text-center">SpeBlog - <?php echo $title ?></div>
				<div class="panel-body">
					<?php echo isset($tip) ? $tip : false ?>
					<?php if ($Step == 1) { ?>
					<div>
						<table class="table table-striped">
							<thead>
								<tr>
									<th class="text-right" style="width:160px;">函数名称</th>
									<th class="text-left">检测状态</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-right">Curl:</td>
									<td class="text-left"><?php echo $is_support_curl ? "<span class=\"tip-green\">支持 <i class=\"fa fa-check fa-fw\">" : "<span class=\"tip-red\">不可用 <i class=\"fa fa-times fa-fw\">" ?></i></span></td>
								</tr>
								<tr>
									<td class="text-right">Mysqli:</td>
									<td class="text-left"><?php echo $is_support_mysqli ? "<span class=\"tip-green\">支持 <i class=\"fa fa-check fa-fw\">" : "<span class=\"tip-red\">不可用 <i class=\"fa fa-times fa-fw\">" ?></i></span></td>
								</tr>
								<tr>
									<td class="text-right">PHP5.3.0 或以上:</td>
									<td class="text-left"><?php echo $php_version_ge530 ? "<span class=\"tip-green\">支持 <i class=\"fa fa-check fa-fw\">" : "<span class=\"tip-red\">不可用 <i class=\"fa fa-times fa-fw\">" ?></i></span></td>
								</tr>
								<tr>
									<td class="text-right">配置文件:</td>
									<td class="text-left"><?php echo $is_support_config_writable ? "<span class=\"tip-green\">可写 <i class=\"fa fa-check fa-fw\">" : "<span class=\"tip-red\">不可写 <i class=\"fa fa-times fa-fw\">" ?></i></span></td>
								</tr>
							</tbody>
						</table>
						<a href="?step=2" class="btn btn-primary btn-block" <?php echo $is_support_curl && $is_support_mysqli && $php_version_ge530 && $is_support_config_writable ? true : "disabled=\"disabled\"" ?> role="button">下一步</a>
					</div>
					<?php } elseif ($Step == 2) { ?>
					<div>
						<form role="form" action="?step=2&state=connect" method="post">
							<div class="form-group">
								<label for="db_host">数据库连接地址</label>
								<input type="text" class="form-control" name="db_host" id="db_host" placeholder="localhost">
							</div>
							<div class="form-group">
								<label for="db_base">数据库名</label>
								<input type="text" class="form-control" name="db_base" id="db_base" placeholder="speblog">
							</div>
							<div class="form-group">
								<label for="db_user">数据库用户名</label>
								<input type="text" class="form-control" name="db_user" id="db_user" placeholder="root">
							</div>
							<div class="form-group">
								<label for="db_pass">数据库密码</label>
								<input type="password" class="form-control" name="db_pass" id="db_pass" placeholder="root">
							</div>
							<div class="form-group">
								<label for="db_port">数据库端口</label>
								<input type="text" class="form-control" name="db_port" id="dbPort" value="3306" placeholder="3306">
							</div>
							<button type="submit" class="btn btn-primary btn-block">下一步</button>
						</form>
					</div>
					<?php } elseif ($Step == 3) { ?>
					<div>
						<h3>SpeBlog 安装成功</h3>
						<p> -> 默认密码: <span class="text-danger">admin</span></p>
						<p> -> 默认密码: <span class="text-danger">admin</span></p>
						<p> -> 后台地址: <span class="text-danger">http://<?php echo $_SERVER['HTTP_HOST'] ?>/?mod=admin</span></p>
						<p>请尽快登录后台修改密码</p>
						<a href="../" class="btn btn-success btn-block" role="button">访问首页</a>
						<a href="../?mod=admin" class="btn btn-success btn-block" role="button">访问后台</a>
					</div>
					<?php } else { ?>
					<div>
						<h2 class="text-center" style="padding-bottom: 6px;border-bottom: 1px solid #DDD;"><strong>欢迎使用 SpeBlog</strong></h2>
						<div id="permit">
							<p>安装程序前请阅读以下条款：</p>
							<p>版权所有 &copy; 2016 <a target="_blank" href="http://www.xlogs.cn">亦痕</a> 保留所有权利</p>
							<p>I. 协议规定的约束和限制</p>
							<p>
								不得将本软件用于商业用途（包括但不限于企业网站、经营性网站、以营利为目或实现盈利的网站）。<br/>
								不得对本软件或与之关联的商业授权进行出租、出售、抵押或发放子许可证。<br/>
								禁止在产品的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于重新分发。<br/>
								如果您未能遵守本协议的条款，您的授权将被终止，所许可的权利将被收回，同时您应承担相应法律责任。<br/>
							</p>
							<p>II. 有限担保和免责声明</p>
							<p>
								本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。<br/>
								用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未购买产品技术服务之前，我们不承诺提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。<br/>
								程序作者本人不对使用本软件构建的网站中或者论坛中的文章或信息承担责任，全部责任由您自行承担。<br/>
								一旦您开始安装SpeBlog，即被视为完全理解并接受本协议的各项条款，在享有上述条款授予的权利的同时，受到相关的约束和限制。<br/>
								协议许可范围以外的行为，将直接违反本授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。<br/>
								本许可协议条款的解释，效力及纠纷的解决，适用于中华人民共和国大陆法律。<br/>
								<p class="text-right"> <a target="_blank" href="http://www.speblog.ga">SpeBlog</a> -> </p>
							</p>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" id="permitOk"> 我同意并遵循以上协议
							</label>
						</div>
						<a href="?step=1" id="go" class="btn btn-primary btn-block" role="button">下一步</a>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
  <script type="text/javascript" src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
  <script type="text/javascript">
	$(function(){
		$("#go").attr("disabled", true);
		$("#permitOk").change(function(){
			if($("#permitOk").is(':checked')) {
				$("#go").attr("disabled", false);
			} else {
				$("#go").attr("disabled", true);
			}
		});
	});
  </script>
</html>