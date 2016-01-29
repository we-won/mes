
var Erectus = function () {

var handleGallery = function (){

    $('body').on('click', '#tab_gallery', function() {
        
        var uloads = $(this).data( 'uploads' );
        var source = $(this).data( 'source' );

        handleGalleryAjax( uloads, source ); 

    } );

}

var handleWysihtml5 = function () {
	if (!jQuery().wysihtml5) {
		return;
	}
	if ($('.wysihtml5').size() > 0) {
		$('.wysihtml5').wysihtml5({
			"stylesheets": ["assets/backend/assets/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
		});
	}
}



var handleGalleryAjax = function ( uloads, source  ) {

        $.ajax( {
            'type'        : 'POST',
            'url'         : source,
            'dataType'    : 'json',
            beforeSend  : function() {
                 // $( '#content_gallery' ).html( '' );
                 // $( '#content_gallery' ).append( '<p>loading gallery... please be patient</p>' );
            },
            success : function(data) {
                // $( '#content_gallery' ).html( '' );
                $( data.results ).each(function( i, item ) {
                    // alert( item.username  );
                    $( '#content_gallery' ).append( '<div class="col-md-3 col-sm-4 mix category_1">'+
                                                      '<div class="mix-inner">'+
                                                        '<img class="img-responsive" src="'+uloads+'/'+item.filename+item.file_ext+'" alt="">'+
                                                        '<div class="mix-details">'+
                                                          '<h4><span><small>Entry from</small></span><br><br>' + ( ( item.username != '' ) ? item.username : item.email ) + '</h4>'+
                                                          '<a class="mix-preview fancybox-button" href="'+uloads+'/'+item.filename+item.file_ext+'" title="Drawing entry from '+ ( ( item.username != '' ) ? item.username : item.email ) +'" data-rel="fancybox-button"><i class="fa fa-search"></i></a>'+
                                                        '</div>'+
                                                      '</div>'+
                                                    '</div>' );
                  // console.log(i + " => " + item);
                });

                $('.mix-grid').mixitup();
                // console.log( data.page );
                // alert( $('#pagination').data( 'page' ) );
                if( data.page == 0 )
                { 
                    $('#pagination').fadeOut();
                }
                
            }
        } );
}
	
var handleGalleryPagination = function () {
        
        $('body').on('click', 'button#pagination', function() {

              var page = ( parseInt( $( this ).attr( 'data-page' ) ) + 1 );

              var uloads = $('#tab_gallery').data( 'uploads' );
              var source = $('#tab_gallery').data( 'source' ) + '/' + page;

              handleGalleryAjax( uloads, source ); 

              $( this ).attr( 'data-page', page );   

       } );
}

return {

        //main function to initiate the theme
        init: function () {

          handleGalleryPagination();
          handleGallery();
          
       		     
       },
	   initWysihtml5 : function (){
			handleWysihtml5();
	   }

    };

}();