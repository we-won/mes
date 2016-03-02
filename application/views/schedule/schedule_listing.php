
<?php echo $this->nativesession->flashdata( '_schedule' ); ?>

<div class="portlet box grey">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-calendar-plus-o"></i>Schedule
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
					<a href="<?php echo base_url( 'schedule/new' ) ?>" class="btn orange">
					Add New <i class="fa fa-plus"></i>
					</a>
				</div>
			</div>

			<table class="table table-striped table-bordered table-advance table-hover" id="tbl_schedule" data-source="<?php echo base_url( 'schedule_controller/listings') ?>"> 
				<thead>
					<tr>
						<th>Subject</th>
						<th>Schedule</th>
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