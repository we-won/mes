
<?php echo $this->nativesession->flashdata( '_students' ); ?>

<div class="portlet box grey">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-students"></i>Students
		</div>

	</div>
	<div class="portlet-body">

		<div class="tab-pane">
			<div class="table-toolbar">
				<div class="btn-group">
					<a href="<?php echo base_url( 'students/new' ) ?>" class="btn orange">
					Add New <i class="fa fa-plus"></i>
					</a>
				</div>
			</div>

			<table class="table table-striped table-bordered table-advance table-hover" id="tbl_students" data-source="<?php echo base_url( 'students_controller/listings') ?>"> 
				<thead>
					<tr>
						<th>Userame</th>
						<th>Name</th>
						<th>Role</th>
						<th>Date added</th>
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