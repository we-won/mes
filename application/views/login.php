

<div class="col-sm-6 er-logo-content">
	<img src="<?php echo asset_url() ?>img/logo-lg.png" alt=""/>
	<img src="<?php echo asset_url() ?>img/logo-text.png" alt=""/>
	<h4 class="form-title">Game world manager</h4>
</div>

<div class="col-sm-6 er-info-content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="<?php echo base_url('login') ?>" method="post">
		<h3 class="form-title">Login to your account</h3>
		<div class="alert alert-danger display-hide" id="erLoginModal">
			<button class="close" data-close="alert"></button>
			<span>
				 Enter any username and password.
			</span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="data[username]"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="data[password]"/>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
			<input type="checkbox" name="remember" value="1"/> Remember me </label>
			<button type="submit" class="btn orange pull-right">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END LOGIN FORM -->
</div>