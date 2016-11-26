<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.'); ?>
	<div id="admin_header">
		<b><h3>SpeBlog - 后台管理</h3></b>
	</div>
	<!-- Stack the columns on mobile by making one full-width and the other half-width -->
	<div class="row">
	  <div id="admin_menu" class="col-md-1">
	  	<ul class="nav nav-pills nav-stacked" role="tablist">
	  		<?php $_GET['menu'] == "" ? $menu = "index" : $menu = $_GET['menu'];?>
	  		<li role="presentation" id="admin_li"><b><i class="fa fa-user-secret"></i> <?php echo $Admin['username']; ;?></b></li>
			<li role="presentation" class="<?php echo $menu == "index" ? "active" : false;?>"><a href="?mod=admin&menu=index"><i class="fa fa-server fa-fw"></i> 系统信息</a></li>
			<li role="presentation" class="<?php echo $menu == "system" ? "active" : false;?>"><a href="?mod=admin&menu=system"><i class="fa fa-cog fa-fw"></i> 系统设置</a></li>
			<li role="presentation" class="<?php echo $menu == "menus" ? "active" : false;?>"><a href="?mod=admin&menu=menus"><i class="fa fa-navicon fa-fw"></i> 导航管理</a></li>
			<li role="presentation" class="<?php echo $menu == "addarticles" ? "active" : false;?>"><a href="?mod=admin&menu=addarticles"><i class="fa fa-pagelines fa-fw"></i> 新建文章</a></li>
			<li role="presentation" class="<?php echo $menu == "articles" ? "active" : false;?>"><a href="?mod=admin&menu=articles"><i class="fa fa-pagelines fa-fw"></i> 文章管理</a></li>
			<li role="presentation" class="<?php echo $menu == "replys" ? "active" : false;?>"><a href="?mod=admin&menu=replys"><i class="fa fa-comments fa-fw"></i> 评论管理</a></li>
			<li role="presentation" class="<?php echo $menu == "links" ? "active" : false;?>"><a href="?mod=admin&menu=links"><i class="fa fa-link fa-fw"></i> 链接管理</a></li>
			<li role="presentation" class="<?php echo $menu == "user" ? "active" : false;?>"><a href="?mod=admin&menu=user"><i class="fa fa-user fa-fw"></i> 账号管理</a></li>
			<li role="presentation" class="<?php echo $menu == "css" ? "active" : false;?>"><a href="?mod=admin&menu=css"><i class="fa fa-css3 fa-fw"></i> 自定义CSS</a></li>
			<li role="presentation"><a href="javascript:logout()" role="button"><i class="fa fa-sign-out fa-fw"></i> 退出后台</a></li>
		</ul>
	  </div>
	  <div id="admin_box" class="col-md-11">
		<?php if ($menu == "index") { ;?>
		<?php require VIEW_ROUTE . 'admin/box/index.box.php';?>
		<?php } elseif ($menu == "system") { ;?>
		<?php require VIEW_ROUTE . 'admin/box/system.box.php';?>
		<?php } elseif ($menu == "menus") { ;?>
		<?php require VIEW_ROUTE . 'admin/box/menus.box.php';?>
		<?php } elseif ($menu == "addarticles") { ;?>
		<?php require VIEW_ROUTE . 'admin/box/addarticles.box.php';?>
		<?php } elseif ($menu == "articles") { ;?>
		<?php require VIEW_ROUTE . 'admin/box/articles.box.php';?>
		<?php } elseif ($menu == "replys") { ;?>
		<?php require VIEW_ROUTE . 'admin/box/replys.box.php';?>
		<?php } elseif ($menu == "links") { ;?>
		<?php require VIEW_ROUTE . 'admin/box/links.box.php';?>
		<?php } elseif ($menu == "user") { ;?>
		<?php require VIEW_ROUTE . 'admin/box/user.box.php';?>
		<?php } elseif ($menu == "css") { ;?>
		<?php require VIEW_ROUTE . 'admin/box/css.box.php';?>
		<?php } ;?>
	  </div>
	</div>