
<?php echo $this->nativesession->flashdata( '_courses' ); ?>

<div class="portlet box grey">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-graduation-cap"></i>Section Management
		</div>

	</div>
	<div class="portlet-body">

		<div class="tab-pane">
			<div class="table-toolbar"></div>

			<table class="table table-striped table-bordered table-advance table-hover" id="tbl_courses" data-source="<?php echo base_url( 'sections_controller/listings') ?>"> 
				<thead>
					<tr>
						<th>Code</th>
						<th>Title</th>
						<th>Description</th>
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