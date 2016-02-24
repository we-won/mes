<li class="<?php echo ($this->uri->segment(1) == 'users' ? 'start active ' : '' ) ?>">
	<a href="<?php echo base_url( '/users') ?>">
		<i class="fa fa-users"></i>
		<span class="title">Users</span>
		<span class="selected"></span>
	</a>
</li>

<li class="<?php echo ($this->uri->segment(1) == 'subjects' ? 'start active ' : '' ) ?>">
	<a href="<?php echo base_url( '/subjects') ?>">
		<i class="fa fa-book"></i>
		<span class="title">Subjects</span>
		<span class="selected"></span>
	</a>
</li>

<li class="<?php echo ($this->uri->segment(1) == 'courses' ? 'start active ' : '' ) ?>">
	<a href="<?php echo base_url( '/courses') ?>">
		<i class="fa fa-graduation-cap"></i>
		<span class="title">Courses</span>
		<span class="selected"></span>
	</a>
</li>

<li class="<?php echo ( ($this->uri->segment(1) == 'schoolyear' ||  $this->uri->segment(1) == 'management') ? 'start active ' : '' ) ?>">
	<a href="javascript:;"><i class="fa fa-building"></i><span class="title">Management</span>
		<?php if( $this->uri->segment(1) == 'management' ) : ?>
		<span class="selected">	</span>
		<?php endif; ?>
		<span class="arrow <?php echo ( $this->uri->segment(1) == 'management' ? 'open ' : '' ) ?>"></span>
	</a>
	<ul class="sub-menu">
		<li class="<?php echo ( ($this->uri->segment(1) == 'schoolyear') ? 'active ' : '' ) ?>">
			<a href="<?php echo base_url('/schoolyear') ?>">School Year</a>
		</li>
	</ul>
</li>