<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.'); ?>
<div id="system">
	<blockquote>
		<p>修改资料</p>
	</blockquote>
	<div class="form-group">
		<label>用户名</label>
		<input type="text" id="username" class="form-control" value="<?php echo $username ;?>" placeholder="昵称">
	</div>
	<button type="button" id="setData" class="btn btn-default">修改资料</button><hr/>
	<blockquote>
		<p>修改密码</p>
	</blockquote>
	<div class="form-group">
		<label>旧密码：</label>
		<input type="password" id="password1" class="form-control" placeholder="******">
	</div>
	<div class="form-group">
		<label>新密码：</label>
		<input type="password" id="password2" class="form-control" placeholder="******">
	</div>
	<div class="form-group">
		<label>确认新密码：</label>
		<input type="password" id="password3" class="form-control" placeholder="******">
	</div>
	<button type="button" id="setPassWord" class="btn btn-default">修改密码</button>
</div>