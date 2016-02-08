<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">

<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>MONCAST | <?php echo (isset($title)) ? $title : 'Official' ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="MobileOptimized" content="320">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<?php echo asset_plugins() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_plugins() ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url() ?>plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- MORE CSS -->
<?php echo ( isset( $template['partials']['more_css'] ) ? $template['partials']['more_css'] : '' ); ?>
<!-- END OF MORE CSS -->

<!-- BEGIN THEME STYLES -->
<link href="<?php echo asset_url() ?>css/style-erectus.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url() ?>css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url() ?>css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url() ?>css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url() ?>css/themes/brown.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo asset_url() ?>css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo asset_img() ?>/favicon.ico">

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">

<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<!-- <a class="navbar-brand" href="#">
			<img src="<?php echo asset_url() ?>img/logo.png" alt="logo" class="img-responsive"/>
		</a> -->
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<img src="<?php echo asset_url() ?>img/menu-toggler.png" alt=""/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav pull-right">
			
			<!-- BEGIN INBOX DROPDOWN -->
			<li class="dropdown" id="header_inbox_bar">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<i class="fa fa-envelope"></i>
				<span class="badge">
					0
				</span>
				</a>
				<ul class="dropdown-menu extended inbox">
					<li>
						<p>
							You have 0 new messages
						</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller" style="height: 250px;">
							<li>
								<a href="inbox.html?a=view">
								<span class="photo">
									<img src="<?php echo asset_url() ?>img/avatar.png" alt=""/>
								</span>
								<span class="subject">
									<span class="from">
										
									</span>
									<span class="time">
										Just Now
									</span>
								</span>
								<span class="message">
									 Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh...
								</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="external">
						<a href="inbox.html">See all messages <i class="m-icon-swapright"></i></a>
					</li>
				</ul>
			</li>
			<!-- END INBOX DROPDOWN -->

			<!-- BEGIN USER LOGIN DROPDOWN -->
			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<img alt="" src="<?php echo asset_url() ?>img/avatar_small.png"/>
				<span class="username">
					<?php echo $this->nativesession->get( 'username' ); ?>
				</span>
				<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="#"><i class="fa fa-user"></i> My Profile</a>
					</li>
					<!-- <li>
						<a href="#"><i class="fa fa-calendar"></i> My Calendar</a>
					</li> -->
					<!-- <li>
						<a href="#"><i class="fa fa-envelope"></i> My Inbox
						<span class="badge badge-danger">
							3
						</span>
						</a>
					</li> -->
					<li class="divider">
					</li>
					<li>
						<a href="javascript:;" id="trigger_fullscreen"><i class="fa fa-move"></i> Full Screen</a>
					</li>
					<!-- <li>
						<a href="#"><i class="fa fa-lock"></i> Lock Screen</a>
					</li> -->
					<li>
						<a href="<?php echo base_url( '/logout') ?>"><i class="fa fa-key"></i> Log Out</a>
					</li>
				</ul>
			</li>
			<!-- END USER LOGIN DROPDOWN -->
		</ul>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix"></div>
  
<!-- BEGIN CONTAINER -->
<div class="page-container">
	
	<!-- MORE JS -->
	<?php echo ( isset( $template['partials']['sidebar'] ) ? $template['partials']['sidebar'] : '' ); ?>
	<!-- END OF MORE JS -->

	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">

			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					<?php echo ( isset($title) ? $title : '' ) ?> <small><?php echo ( isset($subtitle) ? $subtitle : '' ) ?></small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url( '/dashboard') ?>">Home</a>
							<!-- <i class="fa fa-angle-right"></i> -->
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			
			<div class="row">
				<div class="col-md-12">
					<!-- CONTENT -->
					<?php echo $template['body']; ?>
					<!-- END OF CONTENT -->
				</div>
			</div>
			

		</div>
	</div>

</div><!-- END OF PAGE CONTAINER -->





<!-- BEGIN FOOTER -->
<div class="footer">
	<div class="footer-inner">
		 <?php echo date('Y') ?> &copy; MONCAST - LGU Monkayo.
	</div>
	<div class="footer-tools">
		<span class="go-top">
			<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div>

<!-- MODAL -->
<?php echo ( isset( $template['partials']['curriculum_edit_modal'] ) ? $template['partials']['curriculum_edit_modal'] : '' ); ?>

<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo asset_url() ?>plugins/respond.min.js"></script>
<script src="<?php echo asset_url() ?>plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo asset_url() ?>plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<script src="<?php echo asset_url() ?>plugins/bootbox/bootbox.min.js" type="text/javascript"></script>

<link href="<?php echo asset_plugins() ?>bootstrap-duallistbox/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo asset_plugins() ?>bootstrap-duallistbox/js/jquery.bootstrap.js" type="text/javascript"/></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo asset_url() ?>scripts/app.js"></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo asset_url() ?>pages/common.js"></script>

<!-- MORE JS -->
<?php echo ( isset( $template['partials']['more_js'] ) ? $template['partials']['more_js'] : '' ); ?>
<!-- END OF MORE JS -->




</body>
<!-- END BODY -->
</html>