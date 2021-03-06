<li class="<?php echo ($this->uri->segment(1) == 'students' ? 'start active ' : '' ) ?>">
	<a href="<?php echo base_url( '/students') ?>">
		<i class="fa fa-users"></i>
		<span class="title">Students</span>
		<span class="selected"></span>
	</a>
</li>

<li class="<?php echo ($this->uri->segment(1) == 'sections' ? 'start active ' : '' ) ?>">
	<a href="<?php echo base_url( '/sections') ?>">
		<i class="fa fa-list-alt"></i>
		<span class="title">Sections</span>
		<span class="selected"></span>
	</a>
</li>

<li class="<?php echo ($this->uri->segment(1) == 'schedule' ? 'start active ' : '' ) ?>">
	<a href="<?php echo base_url( '/schedule') ?>">
		<i class="fa fa-calendar-plus-o"></i>
		<span class="title">Class schedules</span>
		<span class="selected"></span>
	</a>
</li>

<li class="<?php echo ($this->uri->segment(1) == 'enrollment' ? 'start active ' : '' ) ?>">
	<a href="<?php echo base_url( '/enrollment') ?>">
		<i class="fa fa-user-plus"></i>
		<span class="title">Enroll</span>
		<span class="selected"></span>
	</a>
</li>
