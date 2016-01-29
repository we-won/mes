$(document).ready( function () {
	
	$('select#country_id').change(function () {
		$('#language').val( $('select#country_id  option[value="'+$(this).val()+'"]').data('code') );
	});

} );