
<?php echo $this->nativesession->flashdata( '_schoolyear' ); ?>

<div class="portlet box grey">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-users"></i>School Year & Semester
		</div>

	</div>
	<div class="portlet-body">

		<div class="tab-pane">
			<div class="table-toolbar">
				<div class="btn-group">
					<a href="<?php echo base_url( 'schoolyear/new' ) ?>" class="btn orange">
					Add New <i class="fa fa-plus"></i>
					</a>
				</div>
			</div>

			<table class="table table-striped table-bordered table-advance table-hover" id="tbl_schoolyear" data-source="<?php echo base_url( 'schoolyear_controller/listings') ?>"> 
				<thead>
					<tr>
						<th>Code</th>
						<th>Year</th>
						<th>Semester</th>
						<th>Date added</th>
						<th>Status</th>
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