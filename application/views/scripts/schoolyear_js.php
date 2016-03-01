<script type="text/javascript" src="<?php echo asset_url() ?>plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url() ?>plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo asset_url() ?>plugins/data-tables/DT_bootstrap.js"></script>


<script src="<?php echo asset_url() ?>mes_scripts/schoolyear_manager.js"></script>

<script>
	var schoolyear;

	jQuery(document).ready(function() {   
		
	   schoolyear = new Schoolyear();
	   schoolyear.init_listing();
	});
</script>