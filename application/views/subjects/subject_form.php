
<div class="portlet box grey ">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i><small><?php echo $title; ?></small>
		</div>
	</div>
	<div class="portlet-body form">
		<br>
		<div class="col-sm-12">
			<?php echo $this->nativesession->flashdata( '_subjects' ); ?>
			<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
		</div>

		<form id="frmsubject" role="form" class="form-horizontal" method="post" action="" data-base="<?php echo base_url( $this->uri->segment(2) .'/'. $this->uri->segment(3) ) ?>" enctype="multipart/form-data">
			<div class="form-body">


				<div class="row">

					<div class="col-sm-9">
						<h4 class="form-section">Subject Information</h4>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Code</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="subject[code]" value="<?php echo isset($subject) ? $subject['code'] : ''; ?>">
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Title</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="subject[title]" value="<?php echo isset($subject) ? $subject['title'] : ''; ?>"> 
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Description</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="subject[description]" value="<?php echo isset($subject) ? $subject['description'] : ''; ?>"> 
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Units</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="subject[units]" value="<?php echo isset($subject) ? $subject['units'] : ''; ?>"> 
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Prerequisites</label>
								<div class="col-sm-10">
									<select class="erSubjects form-control" id="selected_subjects" multiple="multiple">
										<?php $values = ""; if (isset($prerequisites)) : ?>
											<?php foreach($prerequisites as $prerequisite) : ?>
												<?php $values .= $prerequisite['prerequisite_id'] . ","; ?>
												 <option value="<?php echo $prerequisite['prerequisite_id'] ?>" selected="selected"><?php echo $prerequisite['title'] ?></option>
											<?php endforeach; ?>
										<?php endif; ?>
									</select>
									<input type="hidden" class="form-control er-form-control" name="prerequisite[ids]" id="prerequisites" readonly="" value="<?php echo $values; ?>">
								</div>
							</div>
						</div>

						<br/><br/><br/><br/><br/><br/>

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