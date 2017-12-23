
// form show hide 

jQuery(document).ready(function(){
		jQuery('.up-n-quiz').click(function(){
			jQuery('.home_form').toggle();
		});
});

// show selected image 

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            jQuery('#img_disp').prop('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
//  onclick event select image popup
jQuery(function () {
    jQuery("#imgInp").change(function () {
    	jQuery('#img_disp').css('display','inline');
        readURL(this);
        jQuery('.fa-user').hide();
    });
});

// show password
jQuery(document).ready(function(){



    jQuery('#showpass').click(function(){
        if(jQuery('#showpass:checkbox:checked').length > 0){
            jQuery('#password').attr('type','text');
        }else{
            jQuery('#password').attr('type','password');
        }
    });
   


// accordion


    jQuery('.accordion').click(function(){
        jQuery(this).next('.panel').addClass('act');

       if( jQuery(this).next('.panel').hasClass('act')){
           jQuery(this).next('.panel').toggle('slow');
           jQuery('.panel').removeClass('act');
       }else{
           jQuery('.panel').hide('slow');
       }




    });


}); // end document .ready  #####################

// teadher registration validation 
        function validate_tform(){
            var error = 0;
            var message="";
            var email =  jQuery('input[name="email"]').val();
            var conf_email = jQuery('input[name="conf_email"]').val();
            var class_name = jQuery('select[name="class_name"]').val();

            if(email == ""){
                jQuery('input[name="email"]').css('border-color','red');
                var message = message + 'Email required.\n\r';
                var  error =+error + +1;
            }else{
                if(email != conf_email ){
                    jQuery( 'input[name="email"]' ).css( 'border-color','red' );
                    var message = message + 'Please Confirm Email address.\n\r';
                    var  error =+error + +1;
                }
            }
            if( class_name == '0' ){
               jQuery( 'select[name="class_name"]' ).css( 'border-color','red' );
               var message = message + 'Please select class name.';
               var  error =+error + +1;
            }
            if(error > 0){
                alert( message );
                return false
            }else{     
            alert( 'Form submitted successfully.' );           
                return true;

            }
        }        

 function check(cls) {    
    jQuery('.'+cls+ " input[type=checkbox]").prop('checked', true);
}    
function uncheck(cls) {
    jQuery('.'+cls+ " input[type=checkbox]").prop('checked', false);
}     