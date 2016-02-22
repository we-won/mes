<?php
	$color = $is_active == 1 ? 'btn-success' : 'btn-warning';
	$message = $is_active == 1 ? 'deactivate' : 'activate';
	$btn = $is_active == 1 ? 'active' : 'inactive';
	$fa = $is_active == 1 ? 'fa-check' : 'fa-circle-o';
?>

<a href="javascript:void(0)" class="btn btn-xs <?php echo $color; ?> btn-removable" data-id="<?php echo $id ?>" data-message="Are you sure you want to <?php echo $message; ?> this school year/semester?" data-url="<?php echo base_url( 'schoolyear/' . $id . '/update_stat' ) ?>"><i class="fa <?php echo $fa; ?>" ></i> <?php echo $btn; ?></a>
