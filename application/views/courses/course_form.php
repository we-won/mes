
<div class="portlet box grey ">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i><small><?php echo $title; ?></small>
		</div>
	</div>
	<div class="portlet-body form">
		<br>
		<div class="col-sm-12">
			<?php echo $this->nativesession->flashdata( '_courses' ); ?>
			<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
		</div>

		<form id="frmcourse" role="form" class="form-horizontal" method="post" action="" data-base="<?php echo base_url( $this->uri->segment(2) .'/'. $this->uri->segment(3) ) ?>" enctype="multipart/form-data">
			<div class="form-body">


				<div class="row">

					<div class="col-sm-9">
						<h4 class="form-section">Course Information</h4>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Code</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="course[code]" value="<?php echo isset($course) ? $course['code'] : ''; ?>">
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Title</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="course[title]" value="<?php echo isset($course) ? $course['title'] : ''; ?>"> 
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Description</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="course[description]" value="<?php echo isset($course) ? $course['description'] : ''; ?>"> 
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for=""> </label>
								
							</div>
						</div>
						
					</div>

					<?php if (isset($course)) : ?>			
					<div class="clearfix"></div>
					<br/><br/>

					<div class="col-sm-9">
						<h4 class="form-section">Curriculum <a href="<?php echo base_url( 'courses/new' ) ?>" class="btn orange">View Full Curriculum  <i class="fa fa-file-text"></i></a>
							
						</h4>

						<div class="col-sm-12">
							<table class="table table-striped table-bordered table-advance table-hover" id="tbl_curriculum" data-source="<?php echo base_url( 'courses_controller/curriculum_listing/' . (isset($course) ? $course['id'] : '0')) ?>"> 
								<thead>
									<tr>
										<th>Year</th>
										<th>Semester</th>
										<th>Subjects</th>
										<th>Total Units</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						
					</div>
					<?php endif; ?>

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
