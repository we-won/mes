
<?php echo $this->nativesession->flashdata( '_subjects' ); ?>

<div class="portlet box grey">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-graduation-cap"></i>Subjects
		</div>

	</div>
	<div class="portlet-body">

		<div class="tab-pane">
			<div class="table-toolbar">
				<div class="btn-group">
					<a href="<?php echo base_url( 'subjects/new' ) ?>" class="btn orange">
					Add New <i class="fa fa-plus"></i>
					</a>
				</div>
			</div>

			<table class="table table-striped table-bordered table-advance table-hover" id="tbl_subjects" data-source="<?php echo base_url( 'subjects_controller/listings') ?>"> 
				<thead>
					<tr>
						<th>Code</th>
						<th>Title</th>
						<th>Description</th>
						<th>Units</th>
						<th>Prerequisite</th>
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