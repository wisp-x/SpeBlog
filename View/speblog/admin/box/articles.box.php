<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.'); ?>
<div id="articles">
	<blockquote>
		<p>文章管理</p>
	</blockquote>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>标题</th>
				<th>作者</th>
				<th>发布时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if($WebBlog) { ?>
			<?php for($i = 0; $i < count($WebBlog); $i++) { ?>
			<tr id="blog-word-<?php echo $WebBlog[$i]['id'] ?>">
				<td><?php echo $WebBlog[$i]['title'] ?></td>
				<td><?php echo $WebBlog[$i]['author'] ?></td>
				<td><?php echo date("Y-m-d H:i:s", $WebBlog[$i]['createdate']) ?></td>
				<td>
					<button type="button" onclick="editArticle('<?php echo $WebBlog[$i]['id'] ?>')" class="btn btn-default btn-xs" data-toggle="modal" data-target="#editArticle">编辑</button>
					<button type="button" onclick="delArticle('<?php echo $WebBlog[$i]['id'] ?>')" class="btn btn-danger btn-xs">删除</button>
				</td>
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
	<!-- 模态框（Modal） -->
	<div class="modal fade" id="editArticle" tabindex="-1" role="dialog" aria-labelledby="myEditArticle" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
					<h4 class="modal-title" id="myEditArticle">编辑文章</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
					<label>标题</label>
					<input type="text" id="editArticles_title" class="form-control" placeholder="">
				</div>
				<!--引入wangEditor.css-->
				<link rel="stylesheet" type="text/css" href="View/speblog/plugin/wangEditor-2.1.22/dist/css/wangEditor.min.css">
				
				<!-- Editor Start -->
				<div id="editor-container" style="width:100%">
			        <div id="editor-trigger" style="height:350px;max-height:500px;"></div>
			    </div>
			    <!-- End Editor -->
			    
			    <!--引入jquery和wangEditor.js-->
				<script type="text/javascript" src="View/speblog/plugin/wangEditor-2.1.22/dist/js/lib/jquery-1.10.2.min.js"></script>
				<script type="text/javascript" src="View/speblog/plugin/wangEditor-2.1.22/dist/js/wangEditor.min.js"></script>
			    <script type="text/javascript">
			        // 阻止输出log
			        wangEditor.config.printLog = false;
			
			        var editor = new wangEditor('editor-trigger');
			
			        // 表情显示项
			        editor.config.emotionsShow = 'value';
			        editor.config.emotions = {
			            'default': {
			                title: '默认',
			                data: 'View/speblog/plugin/wangEditor-2.1.22/emotions.data'
			            }
			        };

			        // 插入代码时的默认语言
			        // editor.config.codeDefaultLang = 'html'

			        // 只粘贴纯文本
			        // editor.config.pasteText = true;

			        // 跨域上传
			        // editor.config.uploadImgUrl = 'http://localhost:8012/upload';

			        // 第三方上传
			        // editor.config.customUpload = true;

			        editor.create();
			    </script>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-primary">提交更改</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal -->
	</div>
</div>