<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.');

global $mysqli;

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = 10;//每页显示条数
$pageNow = ($page - 1) * $pageSize;
$replyNum = $mysqli->db->executeQuery("SELECT * FROM  `spe_comment` ORDER BY `createdate` DESC", true, true);
$replys = $mysqli->db->executeQuery("SELECT * FROM  `spe_comment` ORDER BY `createdate` DESC LIMIT {$pageNow}, {$pageSize}", true, true);

$pageno = new Page(count($replyNum), 5, $page, $pageSize);

?>
<div id="replys">
	<blockquote>
		<p>评论管理</p>
		<footer>系统共有 <?php echo count($replyNum) ?> 个评论</footer>
	</blockquote>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>文章链接</th>
				<th>昵称</th>
				<th>邮箱</th>
				<th>链接</th>
				<th>内容</th>
				<th>时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if($replys) { ?>
		<?php for($i = 0; $i < count($replys); $i++) { ?>
			<tr id="replys-<?php echo $replys[$i]['id'] ?>">
				<td><a target="_blank" href="index.php?article=<?php echo $replys[$i]['article_id'] ?>">点击查看</a></td>
				<td><?php echo $replys[$i]['name'] ?></td>
				<td><?php echo $replys[$i]['mail'] ?></td>
				<td><?php echo $replys[$i]['url'] ?></td>
				<td><?php echo mb_substr(strip_tags($replys[$i]['box']) , 0 , 10) . "..." ?></td>
				<td><?php echo date("Y-m-d H:i:s", $replys[$i]['createdate']) ?></td>
				<td><button type="button" onclick="delReplys('<?php echo $replys[$i]['id'] ?>')" class="btn btn-danger btn-xs">删除</button></td>
			</tr>
		<?php } ?>
		<?php } ?>
		</tbody>
	</table>
	<div class="text-center" style="margin-top: 10px;">
		<nav>
  			<ul class="pagination">
			<?php echo $pageno->showPages(1); ;?>
			</ul>
		</nav>
	</div>
</div>