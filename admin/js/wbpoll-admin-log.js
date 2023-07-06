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
                    url: wbpollpublic.ajaxurl,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'wbpoll_log_delete',                        
                        log_id: log_id,
                        ajax_nonce: wbpollpublic.ajax_nonce,
                    },
                    success: function (response) {
                            location.reload();	
                    },
                });
                
            });
		});
        
})( jQuery );