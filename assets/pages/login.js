var LoginValidation = function () {

    return {

        //main function to initiate the module
        init: function () {
            
            // $('.login-form').data('bootstrapValidator').resetForm(true);
           
        	$('.login-form').bootstrapValidator({
			        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
			        feedbackIcons: {
			            valid: 'glyphicon glyphicon-ok',
			            invalid: 'glyphicon glyphicon-remove',
			            validating: 'glyphicon glyphicon-refresh'
			        },
			        fields: {
			            "data[username]": {
			                message: 'The username is not valid',
			                validators: {
			                    notEmpty: {
			                        message: 'The username is required and cannot be empty'
			                    }			                   
			                }
			            },

			            "data[password]": {
			                validators: {
			                    notEmpty: {
			                        message: 'The password is required and cannot be empty'
			                    }
			                }
			            }

			        }
			    }).on('success.form.bv', function(e) {
			            // Prevent form submission
			            e.preventDefault();

			            // Get the form instance
			            var $form = $(e.target);

			            // Get the BootstrapValidator instance
			            var bv = $form.data('bootstrapValidator');

			            // Use Ajax to submit form data
			            $.post($form.attr('action'), $form.serialize(), function(result) {
			            	
			            	// alert(result.errors);
			            	if( result.errors == false )
			            	{
			            		$('#erLoginModal .alert').html( result.message );
			            		$('#erLoginModal .alert').addClass( 'alert-danger' );
			            		$('#erLoginModal .alert').removeClass( 'hide' );

			            		$('.login-form').data('bootstrapValidator').resetForm(true);
			            	}
			            	else
			            	{
			            		$('#erLoginModal .alert').html( 'Please wait... redirecting...' );
			            		$('#erLoginModal .alert').addClass( 'alert-success' );
			            		$('#erLoginModal .alert').removeClass( 'hide' );
			            		
			            		window.location.replace( result.url );

			            		$('.login-form').data('bootstrapValidator').resetForm(true);

			            		

			            	}
			                
			            }, 'json');
			            
			        });


        }

    };

}();