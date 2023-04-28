(function ($) {
	'use strict';
	$( document ).ready(
		function () {
			//page scroll
			$( window ).on(
				'scroll',
				function (e) {
					if ($( window ).scrollTop() >= 30) {
						$( 'div.wb-backend_container_header' ).addClass( 'fixed-header' );
					} else {
						$( 'div.wb-backend_container_header' ).removeClass( 'fixed-header' );
					}
				}
			);//end scroll
		}
	);//end dom ready
})( jQuery );
