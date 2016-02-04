
<div class="portlet box grey ">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i><?php echo $title; ?>
		</div>
	</div>
	<div class="portlet-body form">
		<br>
		<div class="col-sm-12">
			<?php echo $this->nativesession->flashdata( '_users' ); ?>
			<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
		</div>

		<form id="frmuser" role="form" class="form-horizontal" method="post" action="" data-base="<?php echo base_url( $this->uri->segment(2) .'/'. $this->uri->segment(3) ) ?>" enctype="multipart/form-data">
			<div class="form-body">


				<div class="row">

					<div class="col-sm-9">
						<h4 class="form-section">User Information</h4>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Username</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="user[username]" value="<?php echo isset($user) ? $user['username'] : ''; ?>">
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">First Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="user[firstname]" value="<?php echo isset($user) ? $user['firstname'] : ''; ?>"> 
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Last Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="user[lastname]" value="<?php echo isset($user) ? $user['lastname'] : ''; ?>"> 
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label col-sm-4" for="">Role</label>
								<div class="col-sm-8">
									<select class="form-control" name="user[account_type]" id="account_type">
										<?php $val = isset( $user ) ? $user['account_type'] : ''; ?>
										<option value="administrator" <?php echo ( $val == 'administrator' ) ? 'selected' : '' ?> >Administrator</option>
										<option value="registrar" <?php echo ( $val == 'registrar' ) ? 'selected' : '' ?> >Registrar</option>
										<option value="cashier" <?php echo ( $val == 'cashier' ) ? 'selected' : '' ?> >Cashier</option>
									</select>
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
