<?php if ($status == E_RESERVED) : ?>
	<span class="label label-primary">RESERVED</span>
<?php elseif ($status == E_ENROLLED) : ?>
	<span class="label label-success">ENROLLED</span>
<?php elseif ($status == E_CANCELED) : ?>
	<span class="label label-danger">CANCELED</span>
<?php endif; ?>