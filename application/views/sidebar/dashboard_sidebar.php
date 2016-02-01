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
				<li class="<?php echo ($this->uri->segment(2) == 'dashboard' ? 'start active ' : '' ) ?>">
					<a href="<?php echo base_url('/dashboard') ?>">
						<i class="fa fa-home"></i>
						<span class="title">Dashboard</span>
						<span class="selected"></span>
					</a>
				</li>
				
				<li class="<?php echo ($this->uri->segment(2) == 'users' ? 'start active ' : '' ) ?>">
					<a href="<?php echo base_url( '/users') ?>">
						<i class="fa fa-users"></i>
						<span class="title">Users</span>
						<span class="selected"></span>
					</a>
				</li>

				<li class="<?php echo ($this->uri->segment(2) == 'courses' ? 'start active ' : '' ) ?>">
					<a href="<?php echo base_url( '/courses') ?>">
						<i class="fa fa-graduation-cap"></i>
						<span class="title">Courses</span>
						<span class="selected"></span>
					</a>
				</li>

				<li class="<?php echo ($this->uri->segment(2) == 'subjects' ? 'start active ' : '' ) ?>">
					<a href="<?php echo base_url( '/subjects') ?>">
						<i class="fa fa-book"></i>
						<span class="title">Subjects</span>
						<span class="selected"></span>
					</a>
				</li>

				<li class="<?php echo ($this->uri->segment(2) == 'schedules' ? 'start active ' : '' ) ?>">
					<a href="<?php echo base_url( '/schedules') ?>">
						<i class="fa fa-calendar-plus-o"></i>
						<span class="title">Class schedules</span>
						<span class="selected"></span>
					</a>
				</li>

				<li class="<?php echo ($this->uri->segment(2) == 'management' ? 'start active ' : '' ) ?>">
					<a href="<?php echo base_url( '/management') ?>">
						<i class="fa fa-database"></i>
						<span class="title">Management</span>
						<span class="selected"></span>
					</a>
				</li>


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