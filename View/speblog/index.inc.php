<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.');

/**
 * SpeBlog 公共首页模板
 * @author 熊二哈
 * @link http://www.xlogs.cn
 */

global $mysqli;

$articleID = $_GET['article'];

if(!is_empty($articleID)) {
	# =======> 获取文章详情
	$articles = $mysqli->db->executeQuery("SELECT * FROM `spe_articles` WHERE `id` = {$articleID}", true, true);
	if($articles) {
		# =======> 获取该文章评论
		$comment = $mysqli->db->executeQuery("SELECT * FROM `spe_comment` WHERE `article_id` = {$articles[0]['id']} ORDER BY `createdate` DESC", true, true);
	}
}
?>
	<div id="me">
		<center>
			<div>
				<a href="javascript:setBackGroUnd('me')"><img id="avatar" alt="ME" class="img-circle" src="/View/speblog/img/avatar.jpg"></a>
			</div>
		</center>
	</div>
	<div id="menu" class="text-center">
		<?php echo $tomenu ?>
	</div>
	<div id="box" class="container">
		<div class="row">
		<?php if(is_empty($articleID)) { ?>
			<div id="blog" class="col-md-10 col-md-offset-1">
				<?php if($WebBlog) { ?>
				<?php for($i = 0; $i < count($WebBlog); $i++) { ?>
				<div class="blog-word">
					<h3><a href="?article=<?php echo $WebBlog[$i]['id'] ?>"><?php echo $WebBlog[$i]['title'] ?></a></h3><br/>
					<?php echo htmlspecialchars(mb_substr(strip_tags($WebBlog[$i]['box']) , 0 , 100) . "...") ?><br/></br/>
					<span class="text-danger"><?php echo date("Y-m-d H:i:s", $WebBlog[$i]['createdate']) ?> by <?php echo $WebBlog[$i]['author'] ?></span>
				</div>
				<?php } ?>
				<?php } ?>
			</div>
			<div class="text-center" style="margin-top: 10px;">
				<nav>
		  			<ul class="pagination">
					<?php echo $pageno->showPages(1) ?>
					</ul>
				</nav>
			</div>
		<?php } else { ?>
		<?php if($articles) { ?>
			<div class="col-md-10 col-md-offset-1">
				<div id="blog-detail">
					<div class="text-center">
						<h3><b><?php echo $articles[0]['title'] ?></b></h3>
					</div><hr/>
					<div>
						<?php echo $articles[0]['box'] ?>
					</div>
				</div>
				<div id="comment">
				<?php if ($comment) { ?>
					<?php for($i = 0; $i < count($comment); $i++) { ?>
						<div class="comments">
							<div>
								<a target="_blank" href="<?php echo $comment[$i]['url'] ?>"><?php echo $comment[$i]['name'] ?></a> <span class="text-danger"><?php echo date("Y-m-d H:i:s", $comment[$i]['createdate']) ?></span> <a class="text-right" href="javascript:alert('开发中')">回复</a>
								<br/><?php echo htmlspecialchars($comment[$i]['box']) ?>
							</div>
						</div>
						<br/>
					<?php } ?>
				<?php } ?>
					<?php if($whecomment == 1) { ?>
					<div class="row">
						<p><div class="col-md-8">
							<div>
								<textarea class="form-control" id="comment_txt" rows="7"></textarea>
							</div>
						</div>
						<p><div class="col-md-4">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
									<input class="form-control" id="comment_name" type="text" placeholder="昵称"/>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
									<input class="form-control" id="comment_email" type="text" placeholder="email"/>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-external-link"></i></div>
									<input class="form-control" id="comment_url" type="text" value="http://" placeholder="链接"/>
								</div>
							</div>
							<p><button type="button" onclick="comment_up('<?php echo $articles[0]['id'] ?>')" class="btn btn-primary btn-block">提交评论</button>
						</div>
					</div>
					<?php } else { ?>
						<div class="text-center"><i class="fa fa-lock"></i> 管理员关闭了评论功能</div>
					<?php } ?>
				</div>
			</div>
			<?php } else { ?>
			<div class="text-center"><h3><i class="fa fa-frown-o"></i> 未找到该文章</h3></div>
			<?php } ?>
		<?php } ?>
		</div>
	</div>