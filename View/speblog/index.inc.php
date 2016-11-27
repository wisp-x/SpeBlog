<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.'); ?>
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
			<div id="blog" class="col-md-10 col-md-offset-1">
				<?php if($WebBlog) { ?>
				<?php for($i = 0; $i < count($WebBlog); $i++) { ?>
				<div class="blog-word">
					<h3><a href="?article=<?php echo $WebBlog[$i]['id'] ?>"><?php echo $WebBlog[$i]['title'] ?></a></h3><br/>
					<?php echo htmlspecialchars(mb_substr($WebBlog[$i]['box'] , 0 , 100) . "...") ?><br/></br/>
					<span class="text-danger"><?php echo date("Y-m-d H:i:s", $WebBlog[$i]['createdate']) ?> by <?php echo $WebBlog[$i]['author'] ?></span>
				</div>
				<?php 	} ?>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="text-center" style="margin-top: 10px;">
		<nav>
  			<ul class="pagination">
			<?php echo $pageno->showPages(1); ;?>
			</ul>
		</nav>
	</div>