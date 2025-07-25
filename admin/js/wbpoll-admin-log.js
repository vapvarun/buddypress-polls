if (typeof wp !== 'undefined' && wp.i18n) {
    const { __ } = wp.i18n;
}

(function( $ ) {
	'use strict';

	$(function() {
			$('.open_log').on('click', function(){
                var id = $(this).data('id');
                $('.opendetails-'+id).show();
            });
            $('.close').on('click', function(){
                $('.openmodal').hide();
            });

            $('.delete_log').on('click', function(){
                var log_id = $(this).data('id');
                $.ajax({
                    url: wbpolladminsingleObj.ajaxurl,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'wbpoll_log_delete',                        
                        log_id: log_id,
                        ajax_nonce: wbpolladminsingleObj.nonce
                    },
                    success: function (response) {
                            location.reload();	
                    },
                });
                
            });
		});
        
})( jQuery );