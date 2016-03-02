<?php if ($status != E_CANCELED) : ?>
	<a href="<?php echo base_url( 'enrollment/' . $id . '/edit'  ) ?>" class="btn btn-xs  btn-info"><i class="fa fa-pencil" ></i> Edit</a>
	<a href="javascript:void(0)" class="btn btn-xs btn-danger btn-removable" data-id="<?php echo $id ?>" data-message="Are you sure you want to cancel this enrollment?" data-url="<?php echo base_url( 'enrollment/' . $id . '/cancel' ) ?>"><i class="fa fa-times" ></i> Cancel</a>
<?php else : ?>
	<a href="javascript:void(0)" class="btn btn-xs btn-success btn-removable" data-id="<?php echo $id ?>" data-message="Are you sure you want to re-enroll this student?" data-url="<?php echo base_url( 'enrollment/' . $id . '/reenroll' ) ?>"><i class="fa fa-check" ></i> Re-enroll</a>
<?php endif; ?>