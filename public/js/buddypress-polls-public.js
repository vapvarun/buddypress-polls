(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	
     jQuery( document ).ready(
		function(){

			var poll_html = $( '.bpolls-polls-option-html' ).html();
			var option_html = $('.bpolls-option').html();

			$(
				function() {
					$('.bpolls-sortable').sortable({
						handle: '.bpolls-sortable-handle'
					});
					$('.bpolls-sortable').disableSelection();
				}
			);

			/*==============================================
			=            add new poll option js            =
			==============================================*/
			
			$( document ).on(
				'click', '.bpolls-add-option', function(){
					var clonedObj = $( this ).parent().siblings().find( '.bpolls-option:first' ).clone().insertAfter( $( this ).parent().siblings().find( '.bpolls-option:last' ) );
					clonedObj.find( 'input' ).each(
						function(){
							this.value = '';
							this.placeholder = '';
						}
					);
					if (clonedObj.length == 0) {
					  $('.bpolls-sortable').html('<div class="bpolls-option">'+option_html+'</div>');
					}
				}
			);
			
			/*=====  End of add new poll option js  ======*/

			/*==========================================
			=            delete poll option            =
			==========================================*/
			
			$( document ).on(
				'click', '.bpolls-option-delete', function(){
					$(this).parent('.bpolls-option').remove();
				}
			);
			
			/*=====  End of delete poll option  ======*/
			
			/*============================================
			=            Show hide poll panel            =
			============================================*/
			
			$( document ).on(
				'click', '.bpolls-icon', function(){
					$('.bpolls-polls-option-html').slideToggle( 500 );
				}
			);
			
			/*=====  End of Show hide poll panel  ======*/

			/*==================================================================
			=            clear html and toggle on poll cancellation            =
			==================================================================*/
			
			$( document ).on(
				'click', '.bpolls-cancel', function(){
					$( '.bpolls-polls-option-html' ).html(poll_html);
					$('.bpolls-polls-option-html').slideUp( 500 );
					$('.bpolls-sortable').sortable({
						handle: '.bpolls-sortable-handle'
					});
					$('.bpolls-sortable').disableSelection();
				}
			);
			
			/*=====  End of clear html and toggle on poll cancellation  ======*/
			
			/*==========================================================
			=            solve glitch on post update submit            =
			==========================================================*/
			
			$( "#aw-whats-new-submit" ).click(
				function(){
					if ($( '.bpolls-polls-option-html' ).is( ':visible' )) {
						$( '.bpolls-polls-option-html' ).slideToggle( 500 );
					}
				}
			);
			
			/*=====  End of solve glitch on post update submit  ======*/		
		}
	 );	   

})( jQuery );
