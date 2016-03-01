
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
									<select class="erSubjects form-control" id="selected_subjects" multiple="multiple">
										<?php if (isset($schedule)) : ?>
												 <option value="<?php echo $schedule['subject_id'] ?>" selected="selected"><?php echo $schedule['description'] ?></option>
										<?php endif; ?>
									</select>
									<input type="hidden" class="form-control er-form-control" name="schedule[subject_id]" id="subjects_selected" readonly="" value="<?php echo isset($schedule) ? $schedule['subject_id'] : ''; ?>">
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Monday <?php echo $time[0]['day']; ?></label>
								<div class="col-sm-2">
									<input type="text" id="monday" name="day[start_time][]" class="timepicker_slider form-control" placeholder="Start Time" />
								</div>
								<div class="col-sm-2">
									<input type="text" name="day[end_time][]" class="timepicker_slider form-control" placeholder="End Time"  />
								</div>
								<div class="col-sm-2">
									<input name="day[chk][]" type="checkbox" value="1" />
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Tuesday</label>
								<div class="col-sm-2">
									<input type="text" name="day[start_time][]" class="timepicker_slider form-control" placeholder="Start Time" />
									
								</div>
								<div class="col-sm-2">
									<input type="text" name="day[end_time][]" class="timepicker_slider form-control" placeholder="End Time"  />
								</div>
								<div class="col-sm-2">
									<input name="day[chk][]" type="checkbox" value="2" />
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Wednesday</label>
								<div class="col-sm-2">
									<input type="text" name="day[start_time][]" class="timepicker_slider form-control" placeholder="Start Time" />
									
								</div>
								<div class="col-sm-2">
									<input type="text" name="day[end_time][]" class="timepicker_slider form-control" placeholder="End Time"  />
								</div>
								<div class="col-sm-2">
									<input name="day[chk][]" type="checkbox" value="3" />
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Thursday</label>
								<div class="col-sm-2">
									<input type="text" name="day[start_time][]" class="timepicker_slider form-control" placeholder="Start Time" />
									
								</div>
								<div class="col-sm-2">
									<input type="text" name="day[end_time][]" class="timepicker_slider form-control" placeholder="End Time"  />
								</div>
								<div class="col-sm-2">
									<input name="day[chk][]" type="checkbox" value="4" />
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Friday</label>
								<div class="col-sm-2">
									<input type="text" name="day[start_time][]" class="timepicker_slider form-control" placeholder="Start Time" />
									
								</div>
								<div class="col-sm-2">
									<input type="text" name="day[end_time][]" class="timepicker_slider form-control" placeholder="End Time"  />
								</div>
								<div class="col-sm-2">
									<input name="day[chk][]" type="checkbox" value="5" />
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Saturday</label>
								<div class="col-sm-2">
									<input type="text" name="day[start_time][]" class="timepicker_slider form-control" placeholder="Start Time" />
									
								</div>
								<div class="col-sm-2">
									<input type="text" name="day[end_time][]" class="timepicker_slider form-control" placeholder="End Time"  />
								</div>
								<div class="col-sm-2">
									<input name="day[chk][]" type="checkbox" value="6" />
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Sunday</label>
								<div class="col-sm-2">
									<input type="text" name="day[start_time][]" class="timepicker_slider form-control" placeholder="Start Time" />
									
								</div>
								<div class="col-sm-2">
									<input type="text" name="day[end_time][]" class="timepicker_slider form-control" placeholder="End Time"  />
								</div>
								<div class="col-sm-2">
									<input name="day[chk][]" type="checkbox" value="7" />
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
