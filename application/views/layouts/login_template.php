<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Erectus The Game | Game World Login</title>
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
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo asset_url() ?>plugins/select2/select2_metro.css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo asset_url() ?>css/style-erectus.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url() ?>css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url() ?>css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url() ?>css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url() ?>css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo asset_url() ?>css/pages/login.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url() ?>css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
  <link rel="shortcut icon" href="<?php echo asset_img() ?>/favicon.ico">
</head>
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">

	<!-- CONTENT -->
	<?php echo $template['body']; ?>
	<!-- END OF CONTENT -->
	
	<div class="clearfix"></div>
	
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 2015 &copy; Maata Games
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
	<script src="<?php echo asset_url() ?>plugins/respond.min.js"></script>
	<script src="<?php echo asset_url() ?>plugins/excanvas.min.js"></script> 
	<![endif]-->
<script src="<?php echo asset_url() ?>plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo asset_plugins() ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo asset_plugins() ?>jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo asset_url() ?>plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo asset_url() ?>scripts/app.js" type="text/javascript"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo asset_plugins() ?>validator/dist/js/bootstrapValidator.js"></script>
<script src="<?php echo asset_url() ?>pages/login.js"></script>




<!-- END PAGE LEVEL SCRIPTS -->
<script>
		jQuery(document).ready(function() {     
		  App.init();
		  LoginValidation.init();
		  // Login.init();
		  // LoginValidation.init();
		});
	</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>