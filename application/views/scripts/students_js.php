<script type="text/javascript" src="<?php echo asset_url() ?>plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url() ?>plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo asset_url() ?>plugins/data-tables/DT_bootstrap.js"></script>


<script src="<?php echo asset_url() ?>mes_scripts/students_manager.js"></script>

<script>
	var students;

	jQuery(document).ready(function() {   
	   App.init();

	   students = new Students();
	   students.init_listing();
	});
</script>