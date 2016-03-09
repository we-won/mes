
<?php echo $this->nativesession->flashdata( '_courses' ); ?>

<div class="portlet box grey">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-graduation-cap"></i>Section Management
			<?php $sem_w = ''; 
				if ($sem == 1) $sem_w = '1st Sem'; 
				elseif ($sem == 2) $sem_w = '2nd Sem'; 
				else $sem_w = 'summer'; ?>
			[<small><?php echo $sy . ' - ' . ($sy + 1) . ' : ' . $sem_w; ?></small>]
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