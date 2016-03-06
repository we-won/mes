
<div class="portlet box grey ">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i><small><?php echo $title; ?></small>
		</div>
	</div>
	<div class="portlet-body form">
		<br>
		<div class="col-sm-12">
			<?php echo $this->nativesession->flashdata( '_enrollment' ); ?>
			<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
		</div>

		<form id="frmenrollment" role="form" class="form-horizontal" method="post" action="" data-base="<?php echo base_url( $this->uri->segment(2) .'/'. $this->uri->segment(3) ) ?>" enctype="multipart/form-data">
			<div class="form-body">


				<div class="row">

					<div class="col-sm-9">
						<h4 class="form-section">Enrollment Information</h4>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Student</label>
								<div class="col-sm-10">
									<?php if (isset($enrollment)) : ?>
										<input type="text" disabled class="form-control" value="<?php echo '(' . $enrollment['student_number'] . ') ' . $enrollment['student_name']; ?>">
										<input type="hidden" class="form-control er-form-control" name="enrollment[student_id]" readonly="" value="<?php echo $enrollment['student_id']; ?>">
									<?php else : ?>
										<select class="erStudents form-control" id="selected_students" multiple="multiple"></select>
										<input type="hidden" class="form-control er-form-control" name="enrollment[student_id]" id="students_selected" readonly="" value="">
									<?php endif; ?>

									
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Course</label>
								<div class="col-sm-10">
									<select class="erCourses <?php echo isset($new) ? 'enrollment-course-select2' : ''; ?> form-control" id="selected_courses" multiple="multiple">
										<?php if (isset($enrollment)) : ?>
												<option value="<?php echo $enrollment['course_id'] ?>" selected="selected"><?php echo $enrollment['course_description'] ?></option>
										<?php endif; ?>
									</select>
									<input type="hidden" class="form-control er-form-control" name="enrollment[course_id]" id="courses_selected" readonly="" value="<?php echo isset($enrollment) ? $enrollment['course_id'] : ''; ?>">
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Year</label>
								<div class="col-sm-10">
									 <select class="form-control" name="enrollment[year]" id="<?php echo isset($new) ? 'enrollment-year-select' : ''; ?>">
									 	<?php for ($i = 1; $i <= 5; ++$i) : ?>
									 		<option <?php echo (isset($enrollment) && $enrollment['year'] == $i) ? 'selected' : ''; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
									 	<?php endfor; ?>
									  </select>
								</div>
							</div>
						</div>

					</div>
	
					<div class="clearfix"></div>
					<br/><br/>

					<div class="col-sm-9">
						<h4 class="form-section">Class Schedules</h4>

						<!--<form id="enrollSchedule" action="" method="post">-->
							<select multiple="multiple" name="duallistbox_enrollSchedule[]" id="enrollment-schedule-duallistbox">
								<?php foreach ($schedules as $schedule) :  ?>
								<option <?php echo isset($schedule->selected) ? $schedule->selected : ''; ?> value="<?php echo $schedule->id; ?>" id="<?php echo $schedule->id; ?>" class="enrollment_subject_schedule">
									<?php echo $schedule->subject_title; ?>
									- <?php echo $schedule->schedule; ?>
								</option>
								<?php endforeach; ?>
							</select>
							<br>
						<!--</form>-->

					</div>

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
