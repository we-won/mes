var Students = (function() 
{
	var _obj;

	function Students() 
	{
		_obj = this;
	}
	
	Students.prototype.init_listing = function()
	{
		if (!jQuery().dataTable) {
			alert('error');
            return;
        }

            // begin first table
            $('#tbl_students').dataTable({
                "sDom" : "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", //default layout without horizontal scroll(remove this setting to enable horizontal scroll for the table)
                "aLengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"] // change per page values here
                ],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": $('table#tbl_students').data('source'),
                // set the initial value
                "iDisplayLength": 10,
                "sPaginationType": "bootstrap_full_number",
                "oLanguage": {
                    "sProcessing": '<i class="fa fa-coffee"></i>&nbsp;Please wait...',
                    "sLengthMenu": "_MENU_ records",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ],
                "fnInitComplete": function(oSettings, json) {

                    if (jQuery(".fancybox-button").size() > 0) {
                        jQuery(".fancybox-button").fancybox({
                            groupAttr: 'data-rel',
                            prevEffect: 'none',
                            nextEffect: 'none',
                            closeBtn: true,
                            helpers: {
                                title: {
                                    type: 'inside'
                                }
                            }
                        });
                    }

                },
            });


            jQuery('#tbl_students_wrapper .dataTables_filter input').addClass("form-control input-medium"); // modify table search input
            jQuery('#tbl_students_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown

            // handle record edit/remove
            $('body').on('click', '#tbl_students_wrapper .btn-editable', function() {
                alert('Edit record with id:' + $(this).attr("data-id"));
            });

            $('body').on('click', '.btn-removable', function() {
                var msg = $(this).data('message');
                var url = $(this).data('url');
                     bootbox.confirm(msg, function(result) {
                     if(result){
                        window.location.replace(url);
                    }
                }); 

            });
	}

    Students.prototype.init_student_select2 = function(maxLength)
    {
        var count = 0;
        function formatStudentRepoSelection (repo) {
          $('#students_selected').val( $("#selected_students").val() );

          count++;
          
          return '(' + repo.number + ') ' + repo.lastname + ', ' + repo.firstname + ', ' + repo.middlename[0] || repo.text;
        }

        function formatStudentRepo (repo) {
            if (repo.loading) return repo.text;

             var markup = '<div class="clearfix">' +
                            '<div class="col-sm-12 no-space">' +
                             repo.lastname + ', ' + repo.firstname + ' ' + repo.middlename[0] +
                            '</div>';

            return markup;
        }

        $(".erStudents").select2({
            maximumSelectionLength: maxLength,
            placeholder: "Student",
            ajax: {
                url: "/mes/students_controller/get_students",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                return {
                  q: params.term, // search term
                  page: params.page
                };
                },
                processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                  results: data.items,
                  pagination: {
                    more: (params.page * 30) < data.total_count
                  }
                };
                },
                cache: true
                },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 0,
            templateResult: formatStudentRepo,
            templateSelection: formatStudentRepoSelection
        });
        
         $(".erStudents").on("select2:unselect", function (e) {  
            count--;
            
            if (count == 0) {
                $('#students_selected').attr('value', ''); 
            }
        });
    }

	return Students;
})();