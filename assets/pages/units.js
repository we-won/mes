

$('body').on('click', '#add_cost', function(){

	var commodity_id = $('#commodity').val();
	var commodity = $('#commodity option[value="'+commodity_id+'"]').text();
	var unit_cost = $('#unit_cost').val();
	var unit_cost_action = '<button type="button" class="btn btn-xs" id="cost_edit"><i class="fa fa-pencil"></i> edit</button> <button type="button"  class="btn btn-xs" id="cost_delete"><i class="fa fa-times"></i> Deleted</button>';

	var d = new Date();
    var n = d.getTime();

    var isDuplicate = 0;
    $('table#unitCommodity tbody tr').each(function(){
    	if( $(this).find('td:eq(0) input').val() == commodity_id )
    	{
            bootbox.alert("Commodity already added!");
            isDuplicate++;    
    		return false;

    	}
    	// alert(element.find('td:eq(0) input').val());
    });

    if( isDuplicate == 0 )
    {
    	$('table#unitCommodity tbody').append('<tr id="temp_'+n+'">'+
			'<td><label>'+commodity+'</label><input type="hidden" name="unit_cost[temp_'+n+'][commodity_id]" value="'+commodity_id+'" readonly=""></td>'+
			'<td><label>'+unit_cost+'</label><input type="hidden" name="unit_cost[temp_'+n+'][amount]" value="'+unit_cost+'"  readonly=""></td>'+
			'<td>'+unit_cost_action+'<input type="hidden" name="unit_cost[temp_'+n+'][unit_id]" value="temp_'+n+'"  readonly=""></td>'+
		+'</tr>');
    }
	

});


$('table#unitCommodity').on('click', 'button#cost_edit', function(){
	
	var id = $(this).parent().parent('tr').attr('id');
	var commodity_id = $(this).parent().parent('tr').find('td:eq(0) input').val();
	var unit_cost = $(this).parent().parent('tr').find('td:eq(1) input').val();
	
	$('#commodity option[value="'+commodity_id+'"]').prop('selected', true);
	$('#unit_cost').val(unit_cost);
	$('#unit_cost_id').val(id);

	$('#cost_action').html('<button type="button" class="btn red btn-sm" id="modify_cost">Update Cost</button>');
	
});

$('body').on('click', '#modify_cost', function(){

	var table = $('table#unitCommodity tbody');

	var commodity_id = $('#commodity').val();
	var commodity = $('#commodity option[value="'+commodity_id+'"]').text();
	var unit_cost = $('#unit_cost').val();
	var id = $('#unit_cost_id').val();

	$('tr#' + id).find('td:eq(0) label').text(commodity);
	$('tr#' + id).find('td:eq(0) input').val(commodity_id);
	$('tr#' + id).find('td:eq(1) input').val(unit_cost);
	$('tr#' + id).find('td:eq(1) label').text(unit_cost);

	$('#unit_cost').val('');
	$('#unit_cost_id').val('');

	$('#cost_action').html('<button type="button" class="btn red btn-sm" id="add_cost">Add Cost</button>');

});

$('table#unitCommodity').on('click', 'button#cost_delete', function(){

	var id = $(this).parent().parent('tr').attr('id');

	$('tr#' + id).remove();

});

