
<div class="portlet box grey ">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i><small><?php echo $title; ?></small>
		</div>
	</div>
	<div class="portlet-body form">
		<br>
		<div class="col-sm-12">
			<?php echo $this->nativesession->flashdata( '_schedule' ); ?>
			<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
		</div>
		
		<form id="frmschedule" role="form" class="form-horizontal" method="post" action="" data-base="<?php echo base_url( $this->uri->segment(2) .'/'. $this->uri->segment(3) ) ?>" enctype="multipart/form-data">
			<div class="form-body">
				<div class="row">

					<div class="col-sm-8">
						<h4 class="form-section">Schedule Form</h4>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Subject</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="schedule[subject_id]" value="<?php echo isset($schedule) ? $schedule['subject_id'] : ''; ?>">
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Monday</label>
								<div class="col-sm-2">
									<input type="text" class="timepicker_slider form-control" placeholder="Start Time" />
									
								</div>
								<div class="col-sm-2">
									<input type="text" class="timepicker_slider form-control" placeholder="End Time"  />
								</div>
								<div class="col-sm-2">
									<a href="#" class="btn btn-info" id="btn-add"><i class="fa fa-check-square" ></i></a>
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Tuesday</label>
								<div class="col-sm-2">
									<input type="text" class="timepicker_slider form-control" placeholder="Start Time" />
									
								</div>
								<div class="col-sm-2">
									<input type="text" class="timepicker_slider form-control" placeholder="End Time"  />
								</div>
								<div class="col-sm-2">
									<a href="#" class="btn btn-info" id="btn-add"><i class="fa fa-check-square" ></i></a>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Wednesday</label>
								<div class="col-sm-2">
									<input type="text" class="timepicker_slider form-control" placeholder="Start Time" />
									
								</div>
								<div class="col-sm-2">
									<input type="text" class="timepicker_slider form-control" placeholder="End Time"  />
								</div>
								<div class="col-sm-2">
									<a href="#" class="btn btn-info" id="btn-add"><i class="fa fa-check-square" ></i></a>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Thursday</label>
								<div class="col-sm-2">
									<input type="text" class="timepicker_slider form-control" placeholder="Start Time" />
									
								</div>
								<div class="col-sm-2">
									<input type="text" class="timepicker_slider form-control" placeholder="End Time"  />
								</div>
								<div class="col-sm-2">
									<a href="#" class="btn btn-info" id="btn-add"><i class="fa fa-check-square" ></i></a>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Friday</label>
								<div class="col-sm-2">
									<input type="text" class="timepicker_slider form-control" placeholder="Start Time" />
									
								</div>
								<div class="col-sm-2">
									<input type="text" class="timepicker_slider form-control" placeholder="End Time"  />
								</div>
								<div class="col-sm-2">
									<a href="#" class="btn btn-info" id="btn-add"><i class="fa fa-check-square" ></i></a>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Saturday</label>
								<div class="col-sm-2">
									<input type="text" class="timepicker_slider form-control" placeholder="Start Time" />
									
								</div>
								<div class="col-sm-2">
									<input type="text" class="timepicker_slider form-control" placeholder="End Time"  />
								</div>
								<div class="col-sm-2">
									<a href="#" class="btn btn-info" id="btn-add"><i class="fa fa-check-square" ></i></a>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Sunday</label>
								<div class="col-sm-2">
									<input type="text" class="timepicker_slider form-control" placeholder="Start Time" />
									
								</div>
								<div class="col-sm-2">
									<input type="text" class="timepicker_slider form-control" placeholder="End Time"  />
								</div>
								<div class="col-sm-2">
									<a href="#" class="btn btn-info" id="btn-add"><i class="fa fa-check-square" ></i></a>
								</div>
							</div>
						</div>
					</div>

					<div class="clearfix"></div>

				</div>

			</div>

			<div class="form-actions">
				<div class="pull-right">
					<button type="button" class="btn default" onclick="window.location.href='<?php echo base_url( $this->uri->segment(1) ) ?>'">Cancel</button>
					<button type="submit" class="btn red">Submit</button>
				</div>
				
			</div>
		</form>
	</div>
</div>
