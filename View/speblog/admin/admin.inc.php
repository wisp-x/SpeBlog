<?php if (!defined('SPEBLOG')) exit('You can not directly access the file.');?>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-success">
					<div class="panel-heading"><h2>后台登录</h2></div>
					<div class="panel-body">
						<p><div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" id="username" class="form-control" placeholder="后台账号">
						</div>
						<p><div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							<input type="password" id="password" class="form-control" placeholder="密码">
						</div>
						<br/><a href="javascript:alert('开发中')" id="login" class="btn btn-primary btn-lg btn-block" role="button">登录</a>
					</div>
				</div>
			</div>
		</div>
	</div>