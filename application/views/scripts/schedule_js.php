<script type="text/javascript" src="<?php echo asset_url() ?>plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url() ?>plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo asset_url() ?>plugins/data-tables/DT_bootstrap.js"></script>

		<script type="text/javascript" src="<?php echo asset_url() ?>plugins/timepicker/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo asset_url() ?>plugins/timepicker/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="<?php echo asset_url() ?>plugins/timepicker/jquery-ui-timepicker-addon-i18n.min.js"></script>
		<script type="text/javascript" src="<?php echo asset_url() ?>plugins/timepicker/jquery-ui-sliderAccess.js"></script>


<script src="<?php echo asset_url() ?>mes_scripts/schedule_manager.js"></script>

<script>
	var schedule;

	jQuery(document).ready(function() {   
	   App.init();

	   schedule = new Schedule();
	   schedule.init_listing();
	   schedule.add_schedule();
	});
</script>