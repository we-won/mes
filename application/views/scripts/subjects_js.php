<script type="text/javascript" src="<?php echo asset_url() ?>plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url() ?>plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo asset_url() ?>plugins/data-tables/DT_bootstrap.js"></script>


<script src="<?php echo asset_url() ?>mes_scripts/subjects_manager.js"></script>

<script>
	var subjects;

	jQuery(document).ready(function() {   
		
		subjects = new Subjects();
		subjects.init_listing();
        subjects.init_subject_select2(3);
	});
</script>