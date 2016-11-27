<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.'); ?>
<div id="addarticles">
	<blockquote>
		<p>新建文章</p>
	</blockquote>
	<div class="form-group">
		<label>标题</label>
		<input type="text" id="articles_title" class="form-control" placeholder="">
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
	<br/><button type="button" id="addArticle" class="btn btn-default">发布</button>
</div>