var Courses = (function() 
{
	var _obj;

	function Courses() 
	{
		_obj = this;
	}
	
	Courses.prototype.init_listing = function()
	{
		if (!jQuery().dataTable) {
			alert('error');
            return;
        }

            // begin first table
            $('#tbl_courses').dataTable({
                "sDom" : "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", //default layout without horizontal scroll(remove this setting to enable horizontal scroll for the table)
                "aLengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"] // change per page values here
                ],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": $('table#tbl_courses').data('source'),
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


            jQuery('#tbl_courses_wrapper .dataTables_filter input').addClass("form-control input-medium"); // modify table search input
            jQuery('#tbl_courses_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown

            // handle record edit/remove
            $('body').on('click', '#tbl_courses_wrapper .btn-editable', function() {
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

    Courses.prototype.init_curriculum_listing = function()
    {
        if (!jQuery().dataTable) {
            alert('error');
            return;
        }
            $("#tbl_curriculum").dataTable().fnDestroy();

            // begin first table
            $('#tbl_curriculum').dataTable({
                "sDom" : "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", //default layout without horizontal scroll(remove this setting to enable horizontal scroll for the table)
                "aLengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"] // change per page values here
                ],
                "bProcessing": true,
                "bServerSide": true,
                "bPaginate": false,
                "bFilter": false,
                "sAjaxSource": $('table#tbl_curriculum').data('source'),
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


            jQuery('#tbl_curriculum_wrapper .dataTables_filter input').addClass("form-control input-medium"); // modify table search input
            jQuery('#tbl_curriculum_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown

            // handle record edit/remove
            $('body').on('click', '#tbl_curriculum_wrapper .btn-editable', function() {
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

    Courses.prototype.handle_edit_curriculum = function() 
    {
        $('body').on('click', '.mesEditCurriculum', function(){

            var course = $(this).attr('data-course');
            var year = $(this).attr('data-year');
            var sem = $(this).attr('data-sem');
            
            $('#curriculumEditForm').html('loading...');

            $('#mesSmModal').modal({backdrop: 'static'});
            $('#mesSmModal .modal-content').load('/mes/courses_controller/edit_curriculum/', {'course' : course, 'year' : year, 'sem' : sem}, function(data) {
                
                var curriculumEdit = $('select[name="duallistbox_curriculumEdit[]"]').bootstrapDualListbox();
                
                $("#curriculumEditForm").submit(function() {

                    $('#save-curriculum-button').button('loading');

                    var subjects = $('[name="duallistbox_curriculumEdit[]"]').val();
                    
                    if (subjects) {
                        subjects = subjects.join(',');
                    } else {
                        subjects = null;
                    }
                    
                    $.post('/mes/courses_controller/save_curriculum/', {'course' : course, 'year' : year, 'sem' : sem, 'subjects' : subjects}, function(data) {
                       
                        _obj.init_curriculum_listing();
                        $('#save-curriculum-button').button('reset');
                         $('#mesSmModal').modal('hide');
                    });

                    return false;
                });
            });

            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
            });
        });
    }

    Courses.prototype.init_course_select2 = function(maxLength)
    {
        var count = 0;
        function formatCourseRepoSelection (repo) {
          $('#courses_selected').val( $("#selected_courses").val() );

          count++;

          return repo.description || repo.text;
        }

        function formatCourseRepo (repo) {
            if (repo.loading) return repo.text;

             var markup = '<div class="clearfix">' +
                            '<div class="col-sm-12 no-space">' +
                             repo.description +
                            '</div>';

            return markup;
        }

        $(".erCourses").select2({
            maximumSelectionLength: maxLength,
            placeholder: "Course",
            ajax: {
                url: "/mes/courses_controller/get_courses",
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
            templateResult: formatCourseRepo,
            templateSelection: formatCourseRepoSelection
        });

        $(".erCourses").on("select2:unselect", function (e) {  
            count--;
            
            if (count == 0) {
                $('#courses_selected').attr('value', ''); 
            }
        });
        
        /*$(document).on('click', ".select2-selection__choice__remove", function() {
            if ($('.select2-selection__choice').length == 0) {
               $('#courses_selected').attr('value', '');
            }
        });*/
    }

     Courses.prototype.init_sections_listing = function()
    {
        if (!jQuery().dataTable) {
            alert('error');
            return;
        }
            $("#tbl_sections").dataTable().fnDestroy();

            // begin first table
            $('#tbl_sections').dataTable({
                "sDom" : "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", //default layout without horizontal scroll(remove this setting to enable horizontal scroll for the table)
                "aLengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"] // change per page values here
                ],
                "bProcessing": true,
                "bServerSide": true,
                "bPaginate": false,
                "bFilter": false,
                "sAjaxSource": $('table#tbl_sections').data('source'),
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


            jQuery('#tbl_sections_wrapper .dataTables_filter input').addClass("form-control input-medium"); // modify table search input
            jQuery('#tbl_sections_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown

            // handle record edit/remove
            $('body').on('click', '#tbl_sections_wrapper .btn-editable', function() {
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

    Courses.prototype.section_form_init = function(event)
    {
        function the_thing() {
            var year = $(event).find('select[name="section[year]"]').val();
            var code = $(event).find('select[name="section[section]"]').val();
            var title = $(event).find('input#course-title').val();

            $(event).find('input#section-name').val(title + "" + year + "" + code);
        }
        
        the_thing();

        $(event).find('select[name="section[year]"]').change(function() {
            the_thing();
        });

        $(event).find('select[name="section[section]"]').change(function() {
            the_thing();
        });
    }

    Courses.prototype.handle_new_sections = function() 
    {
        $('body').on('click', '#new-section', function(e){

            var course = $(this).attr('data-course');
            
            $('#sectionsEditForm').html('loading...');

            $('#mesSmModal').modal({backdrop: 'static'});
            $('#mesSmModal .modal-content').load('/mes/sections_controller/new_section/', {'course' : course}, function(data) {
                
                var obj = $('#mesSmModal .modal-content');

                _obj.section_form_init(this);

                $("#sectionForm").submit(function() {
                    $(this).find('button[type="submit"]').button('loading');

                    var year = $(obj).find('select[name="section[year]"]').val();
                    var code = $(obj).find('select[name="section[section]"]').val();
                    var limit = $(obj).find('input[name="section[limit]"]').val();
                    var course = $(obj).find('input#course-id').val();

                    $.post('/mes/sections_controller/save_section/', {'course' : course, 'year' : year, 'code' : code, 'limit' : limit}, function(data) {
                        console.log(data);
                        _obj.init_sections_listing();

                        $('#save-section-button').button('reset');
                        $('#mesSmModal').modal('hide');
                    }, 'json');
                });
               
            });

            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
            });
        });
    }

    Courses.prototype.handle_edit_sections = function() 
    {
        $('body').on('click', '.mesEditSections', function(){

            var course = $(this).attr('data-course');
            var year = $(this).attr('data-year');
            var sem = $(this).attr('data-sem');
            
            $('#sectionsEditForm').html('loading...');

            $('#mesSmModal').modal({backdrop: 'static'});
            $('#mesSmModal .modal-content').load('/mes/courses_controller/edit_section/', {'course' : course, 'year' : year, 'sem' : sem}, function(data) {
                
                $("#sectionEditForm").submit(function() {

                    $('#save-section-button').button('loading');
                    
                    $.post('/mes/courses_controller/save_section/', {'course' : course, 'year' : year, 'sem' : sem, 'subjects' : subjects}, function(data) {
                       
                        _obj.init_section_listing();
                        $('#save-section-button').button('reset');
                         $('#mesSmModal').modal('hide');
                    });

                    return false;
                });
            });

            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
            });
        });
    }

	return Courses;
})();