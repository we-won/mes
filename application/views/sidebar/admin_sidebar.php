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

<li class="<?php echo ($this->uri->segment(1) == 'schedules' ? 'start active ' : '' ) ?>">
	<a href="<?php echo base_url( '/schedules') ?>">
		<i class="fa fa-calendar-plus-o"></i>
		<span class="title">Class schedules</span>
		<span class="selected"></span>
	</a>
</li>

<li class="<?php echo ($this->uri->segment(1) == 'management' ? 'start active ' : '' ) ?>">
	<a href="<?php echo base_url( '/management') ?>">
		<i class="fa fa-database"></i>
		<span class="title">Management</span>
		<span class="selected"></span>
	</a>
</li>