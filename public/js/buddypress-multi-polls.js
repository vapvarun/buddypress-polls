jQuery( document ).ready(function() {
    jQuery('.poll-image').on( "click", function() {
        var dataid = jQuery(this).data('id');
        jQuery('.lightbox-'+dataid).show();
    });
    jQuery('.close').on( "click", function() {
        var dataid = jQuery(this).data('id');
        jQuery('.lightbox-'+dataid).hide();
    });
});


