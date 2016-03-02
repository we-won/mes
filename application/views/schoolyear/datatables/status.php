<?php
	$color = $is_active == 1 ? 'btn-success' : 'btn-warning';
	$message = $is_active == 1 ? '' : 'Are you sure you want to activate this school year/semester? <br/> Currently active school year will deactivated.';
	$dataUrl = $is_active == 1 ? '' : base_url( 'schoolyear/' . $id . '/update_stat' );
	$btn = $is_active == 1 ? 'active' : 'inactive';
	$fa = $is_active == 1 ? 'fa-check' : 'fa-circle-o';
?>

<a href="javascript:void(0)" 
	class="btn btn-xs <?php echo $color; ?> btn-removable" 
	data-id="<?php echo $id ?>" 
	data-message="<?php echo $message; ?>" 
	data-url="<?php echo $dataUrl; ?>">
	<i class="fa <?php echo $fa; ?>" ></i> 
	<?php echo $btn; ?>
</a>
