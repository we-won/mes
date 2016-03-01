
<div class="portlet box grey ">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i><small><?php echo $title; ?></small>
		</div>
	</div>
	<div class="portlet-body form">
		<br>
		<div class="col-sm-12">
			<?php echo $this->nativesession->flashdata( '_schoolyear' ); ?>
			<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
		</div>

		<form id="frmschoolyear" role="form" class="form-horizontal" method="post" action="" data-base="<?php echo base_url( $this->uri->segment(2) .'/'. $this->uri->segment(3) ) ?>" enctype="multipart/form-data">
			<div class="form-body">


				<div class="row">

					<div class="col-sm-9">
						<h4 class="form-section">Schoolyear Information</h4>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Year</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="schoolyear[year]" value="<?php echo isset($schoolyear) ? $schoolyear['year'] : $year; ?>">
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Semester</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="schoolyear[sem]" value="<?php echo isset($schoolyear) ? $schoolyear['sem'] : $sem; ?>"> 
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
