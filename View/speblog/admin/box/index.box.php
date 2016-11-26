<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.'); ?>
<div id="index">
	<table class="table">
		<thead>
			<tr>
				<th>名称</th>
				<th>状态</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>系统时间</td>
				<td><?php echo date("Y-m-d H:i:s", time()); ;?></td>
			</tr>
			<tr>
				<td>系统类型</td>
				<td><?php echo php_uname('s'); ;?></td>
			</tr>
			<tr>
				<td>系统版本</td>
				<td><?php echo php_uname('r'); ;?></td>
			</tr>
			<tr>
				<td>PHP 版本</td>
				<td><?php echo PHP_VERSION; ;?></td>
			</tr>
			<tr>
				<td>通信协议</td>
				<td><?php echo $_SERVER['SERVER_PROTOCOL']; ;?></td>
			</tr>
			<tr>
				<td>网站名称</td>
				<td><?php echo $sitename; ;?></td>
			</tr>
			<tr>
				<td>网站域名</td>
				<td><?php echo $_SERVER['HTTP_HOST']; ;?></td>
			</tr>
			<tr>
				<td>网站 IP</td>
				<td><?php echo GetHostByName($_SERVER['SERVER_NAME']); ;?></td>
			</tr>
			<tr>
				<td>网站端口</td>
				<td><?php echo $_SERVER["SERVER_PORT"]; ;?></td>
			</tr>
			<tr>
				<td>网站根目录</td>
				<td><?php echo ROOT; ;?></td>
			</tr>
			<tr>
				<td>最大上传值</td>
				<td><?php echo ini_get('upload_max_filesize'); ;?></td>
			</tr>
		</tbody>
	</table>
</div>