<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.'); ?>
	<div id="me">
		<center>
			<div>
				<a href="javascript:setBackGroUnd('me')"><img id="avatar" alt="ME" class="img-circle" src="/View/speblog/img/avatar.jpg"></a>
			</div>
		</center>
	</div>
	<div id="menu" class="text-center">
		<?php echo $tomenu ;?>
	</div>
	<div id="box" class="container">
		<div class="row">
			<div id="blog" class="col-md-10 col-md-offset-1">
				<?php if($WebBlog) { ;?>
				<?php for($i = 0; $i < count($WebBlog); $i++) { ;?>
				<?php $article = ""; ;?>
				<?php $id = $WebBlog[$i]['id']; ;?>
				<?php $title = $WebBlog[$i]['title']; ;?>
				<?php $box = $WebBlog[$i]['box']; ;?>
				<?php $createdate = date("Y-m-d H:i:s", $WebBlog[$i]['createdate']); ;?>
				<?php $author = $WebBlog[$i]['author']; ;?>
				<?php $article .= "<div class=\"blog-word\">"; ;?>
				<?php $article .= "		<h3><a href=\"?article={$id}\">{$title}</a></h3><br/>"; ;?>
				<?php $article .= 		htmlspecialchars(mb_substr($box , 0 , 100) . "...") . "<br/>"; ;?>
				<?php $article .= "		<br/><span class=\"text-danger\">{$createdate} by {$author}</span>"; ;?>
				<?php $article .= "</div>"; ;?>
				<?php echo $article; ;?>
				<?php 	} ;?>
				<?php } ;?>
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