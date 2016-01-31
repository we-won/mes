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
				
				<li class="<?php echo ($this->uri->segment(2) == 'units' ? 'start active ' : '' ) ?>">
					<a href="<?php echo base_url( '/units') ?>">
						<i class="fa fa-home"></i>
						<span class="title">Units</span>
						<span class="selected"></span>
					</a>
				</li>
				
				<li class="<?php echo ( $this->uri->segment(2) == 'buildings' ? 'active ' : '' ) ?>">
					<a href="javascript:;"><i class="fa fa-building"></i><span class="title">Buildings</span>
						<?php if( $this->uri->segment(2) == 'buildings' ) { ?>
						<span class="selected">	</span>
						<?php } ?>
						<span class="arrow <?php echo ( $this->uri->segment(2) == 'buildings' ? 'open ' : '' ) ?>"></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php echo ( ($this->uri->segment(3) == 'buildings') && ($this->uri->segment(2) == 'contest') ? 'active ' : '' ) ?>">
							<a href="<?php echo base_url(  '/buildings') ?>">Buildings</a>
						</li>
						<li class="<?php echo ( ($this->uri->segment(3) == 'building-levels') && ($this->uri->segment(2) == 'buildings') ? 'active ' : '' ) ?>">
							<a href="<?php echo base_url(  '/buildings/building-levels') ?>">Building Levels</a>
						</li>
					</ul>
				</li>


				
				
				<li class="<?php echo ( $this->uri->segment(2) == 'contest' ? 'active ' : '' ) ?>">
					<a href="javascript:;"><i class="fa fa-puzzle-piece"></i><span class="title">Contest</span>
						<?php if( $this->uri->segment(2) == 'contest' ) { ?>
						<span class="selected">	</span>
						<?php } ?>
						<span class="arrow <?php echo ( $this->uri->segment(2) == 'contest' ? 'open ' : '' ) ?>"></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php echo ( ($this->uri->segment(3) == 'names') && ($this->uri->segment(2) == 'contest') ? 'active ' : '' ) ?>">
							<a href="<?php echo base_url(  '/contest/names') ?>">Names</a>
						</li>
						<li class="<?php echo ( ($this->uri->segment(3) == 'drawings') && ($this->uri->segment(2) == 'contest') ? 'active ' : '' ) ?>">
							<a href="<?php echo base_url(  '/contest/drawings') ?>">Drawings</a>
						</li>
					</ul>
				</li>
				

				<li class="<?php echo ($this->uri->segment(2) == 'users' ? 'start active ' : '' ) ?>">
					<a href="<?php echo base_url(  '/users') ?>">
						<i class="fa fa-users"></i>
						<span class="title">Users </span>
					</a>
				</li>

				<li class="<?php echo ($this->uri->segment(2) == 'language' ? 'start active ' : '' ) ?>">
					<a href="<?php echo base_url(  '/language') ?>">
						<i class="fa fa-flag"></i>
						<span class="title">Language </span>
					</a>
				</li>

				<li class="<?php echo ($this->uri->segment(2) == 'translations' ? 'start active ' : '' ) ?>">
					<a href="<?php echo base_url(  '/translations') ?>">
						<i class="fa fa-language"></i>
						<span class="title">Translation </span>
					</a>
				</li>

				<li class="<?php echo ($this->uri->segment(2) == 'news' ? 'start active ' : '' ) ?>">
					<a href="<?php echo base_url(  '/news') ?>">
						<i class="fa fa-language"></i>
						<span class="title">News</span>
					</a>
				</li>

				<li class="<?php echo ($this->uri->segment(2) == 'servers' ? 'start active ' : '' ) ?>">
					<a href="<?php echo base_url(  '/servers') ?>">
						<i class="fa fa-language"></i>
						<span class="title">Servers </span>
					</a>
				</li>

				<li class="<?php echo ( $this->uri->segment(2) == 'management' ? 'active ' : '' ) ?>">
					<a href="javascript:;"><i class="fa fa-building"></i><span class="title">Management</span>
						<?php if( $this->uri->segment(2) == 'management' ) { ?>
						<span class="selected">	</span>
						<?php } ?>
						<span class="arrow <?php echo ( $this->uri->segment(2) == 'management' ? 'open ' : '' ) ?>"></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php echo ( ($this->uri->segment(3) == 'payments-service') && ($this->uri->segment(2) == 'management') ? 'active ' : '' ) ?>">
							<a href="<?php echo base_url(  '/management/payments-service') ?>">Payments Services</a>
						</li>
					</ul>
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