<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.'); ?>
<div id="system">
	  <div class="form-group">
	    <label>网站名称</label>
	    <input type="text" id="sitename" class="form-control" value="<?php echo $sitename ;?>" placeholder="SpeBlog">
	  </div>
	  <div class="form-group">
	    <label>SEO关键字</label>
	    <input type="text" id="keywords" class="form-control" value="<?php echo $keywords ;?>" placeholder="SpeBlog,博客">
	  </div>
	  <div class="form-group">
	    <label>SEO描述</label>
	    <input type="text" id="description" class="form-control" value="<?php echo $description ;?>" placeholder="SpeBlog">
	  </div>
	  <button type="button" id="setSystem" class="btn btn-default">修改</button>
</div>