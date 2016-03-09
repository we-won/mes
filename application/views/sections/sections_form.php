
<div class="portlet box grey ">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i><small><?php echo $title; ?></small>
		</div>
	</div>
	<div class="portlet-body form">
		<br>

		<form id="frmcourse" role="form" class="form-horizontal" method="post" action="" data-base="<?php echo base_url( $this->uri->segment(2) .'/'. $this->uri->segment(3) ) ?>" enctype="multipart/form-data">
			<div class="form-body">


				<div class="row">

					<div class="col-sm-9">
						<h4 class="form-section">Course Information</h4>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Code</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" disabled value="<?php echo isset($course) ? $course['code'] : ''; ?>">
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Title</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" disabled value="<?php echo isset($course) ? $course['title'] : ''; ?>"> 
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Description</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" disabled value="<?php echo isset($course) ? $course['description'] : ''; ?>"> 
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
						<h4 class="form-section">Sections</h4>

						<div class="col-sm-12">
							<div class="table-toolbar">
								<div class="btn-group">
									<button type="button" class="btn btn-warning" id="new-section" data-course="<?php echo isset($course) ? $course['id'] : ''; ?>">Add New <i class="fa fa-plus"></i></button>
								</div>
							</div>
							<table class="table table-striped table-bordered table-advance table-hover" id="tbl_sections" data-source="<?php echo base_url( 'sections_controller/sections_listing/' . (isset($course) ? $course['id'] : '0')) ?>"> 
								<thead>
									<tr>
										<th>Section</th>
										<th>Year</th>
										<th>Code</th>
										<th>Students</th>
										<th>Limit</th>
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
					<button type="button" class="btn default" onclick="window.location.href='<?php echo base_url( $this->uri->segment(1) ) ?>'">Back</button>
				</div>
				
			</div>
		</form>
	</div>
</div>
