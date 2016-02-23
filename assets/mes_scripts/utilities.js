
var Utilities = function () {

    var HandleSubjectSearch = function(){

        $(".erSubjects").select2({
            maximumSelectionLength: 1,
            placeholder: "Select Subject",
            ajax: {
                url: "./subjects_controller/get_subjects",
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
            minimumInputLength: 1,
            templateResult: formatSubjectRepo,
            templateSelection: formatSubjectRepoSelection
        });
    }


	return {
        initSubjectSearch: function (){
            HandleSubjectSearch();
        }
	};

}();


function formatSubjectRepoSelection (repo) {

  $('#trading_user_town_id').val( $("#trading_towns").val() );
  $('#trading_user_town_id').attr('coor', repo.coor );

  return repo.COORDINATES || repo.text;
}

function formatSubjectRepo (repo) {
    if (repo.loading) return repo.text;

     var markup = '<div class="clearfix">' +
                    '<div class="col-sm-12 no-space">' +
                     '<img src="./assets/images/story/erectus.png" class="img-circle" width="30"> ' + repo.COORDINATES +
                    '</div>';

    return markup;
}