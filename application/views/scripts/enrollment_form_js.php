<script type="text/javascript" src="<?php echo asset_url() ?>plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url() ?>plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo asset_url() ?>plugins/data-tables/DT_bootstrap.js"></script>


<script src="<?php echo asset_url() ?>mes_scripts/enrollment_manager.js"></script>
<script src="<?php echo asset_url() ?>mes_scripts/courses_manager.js"></script>

<script>
	var enrollment;
	var courses;

	jQuery(document).ready(function() {   
		
	   enrollment = new Enrollment();
	   enrollment.init_enroll_schedule();
	   enrollment.init_student_select2(1);

	   courses = new Courses();
	   courses.init_course_select2(1);

	   
	});
</script>