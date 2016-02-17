<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper text-center">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->					
					<div class="clearfix"></div>
					<br/>
					<div class="image-logo">
						<img src="<?php echo asset_img() ?>logo_icon_big.png" style="max-width:130px;width:100%" />	
					</div>
					<div class="text-logo">
						<img src="<?php echo asset_url() ?>img/logo-text.png" style="max-width:200px;width:100%" />
					</div>

					<div class="clearfix"></div>
					<br/>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="<?php echo ($this->uri->segment(1) == 'dashboard' ? 'start active ' : '' ) ?>">
					<a href="<?php echo base_url('/dashboard') ?>">
						<i class="fa fa-home"></i>
						<span class="title">Dashboard</span>
						<span class="selected"></span>
					</a>
				</li>
				
				<?php
					switch ($this->nativesession->get('account_type')) {
						case ADMIN:
							include 'admin_sidebar.php'; 
							break;
						case REGISTRAR:
							include 'registrar_sidebar.php'; 
							break;
						case CASHIER:
							break;
					}	
				?>

				<li class="">
					<a href="<?php echo base_url(  '/logout') ?>">
						<i class="fa fa-lock"></i>
						<span class="title">Logout</span>
					</a>
				</li>
				
				
				
			
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->