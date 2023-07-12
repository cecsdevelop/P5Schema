jQuery(document).ready(function(){

    jQuery("#url-select").on('change', function(){
        jQuery("#title").val(jQuery(this).val());
        jQuery("#url").val(jQuery(this).val());
    });

    jQuery("#url").on('focusout', function(){
        jQuery("#title").val(jQuery(this).val());
    });


    jQuery('.reset_button').on('click', function(){
        jQuery('#schema').val('');
        jQuery("#title").val('');
    });
});