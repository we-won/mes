
<div class="portlet box grey ">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i><small><?php echo $title; ?></small>
		</div>
	</div>
	<div class="portlet-body form">
		<br>
		<div class="col-sm-12">
			<?php echo $this->nativesession->flashdata( '_students' ); ?>
			<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
		</div>

		<form id="frmstudent" role="form" class="form-horizontal" method="post" action="" data-base="<?php echo base_url( $this->uri->segment(2) .'/'. $this->uri->segment(3) ) ?>" enctype="multipart/form-data">
			<div class="form-body">


				<div class="row">

					<div class="col-sm-9">
						<h4 class="form-section">Student Information</h4>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Student Number</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="student[number]" value="<?php echo isset($student) ? $student['number'] : $id; ?>">
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">First Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="student[firstname]" value="<?php echo isset($student) ? $student['firstname'] : ''; ?>"> 
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Middle Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="student[middlename]" value="<?php echo isset($student) ? $student['middlename'] : ''; ?>"> 
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Last Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="student[lastname]" value="<?php echo isset($student) ? $student['lastname'] : ''; ?>"> 
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
