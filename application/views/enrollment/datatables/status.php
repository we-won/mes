<?php if ($status == RESERVED) : ?>
	<span class="label label-primary">RESERVED</span>
<?php elseif ($status == ENROLLED) : ?>
	<span class="label label-success">ENROLLED</span>
<?php elseif ($status == CANCELED) : ?>
	<span class="label label-danger">CANCELED</span>
<?php endif; ?>