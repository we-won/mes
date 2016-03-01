
<?php echo $this->nativesession->flashdata( '_enrollment' ); ?>

<div class="portlet box grey">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-edge"></i>Enrollment 
			<?php $sem_w = ''; 
				if ($sem == 1) $sem_w = '1st Sem'; 
				elseif ($sem == 2) $sem_w = '2nd Sem'; 
				else $sem_w = 'summer'; ?>
			[<small><?php echo $sy . ' - ' . ($sy + 1) . ' : ' . $sem_w; ?></small>]
		</div>

	</div>
	<div class="portlet-body">

		<div class="tab-pane">
			<div class="table-toolbar">
				<div class="btn-group">
					<a href="<?php echo base_url( 'enrollment/new' ) ?>" class="btn orange">
					Add New <i class="fa fa-plus"></i>
					</a>
				</div>
			</div>

			<table class="table table-striped table-bordered table-advance table-hover" id="tbl_enrollment" data-source="<?php echo base_url( 'enrollment_controller/listings') ?>"> 
				<thead>
					<tr>
						<th>Student ID</th>
						<th>Student</th>
						<th>Course</th>
						<th>Year</th>
						<th>Status</th>
						<th>Added</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->