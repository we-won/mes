<a href="<?php echo base_url( 'courses/' . $id . '/edit'  ) ?>" class="btn btn-xs  btn-info"><i class="fa fa-pencil" ></i> Edit</a>
<a href="javascript:void(0)" class="btn btn-xs btn-danger  btn-removable" data-id="<?php echo $id ?>" data-message="Are you sure you want to remove this record?" data-url="<?php echo base_url( 'courses/' . $id . '/delete' ) ?>"><i class="fa fa-times" ></i> Delete</a>
