jQuery( document.body ).on(
	'submit',
	'.wbpoll-form',
	function (e) {
		alert( 'helo' );
		e.preventDefault();

		var $element = jQuery( this );

		let defaultConfig = {
			// class of the parent element where the error/success class is added
			classTo: 'wbpoll_extra_field_wrap',
			errorClass: 'has-danger',
			successClass: 'has-success',
			// class of the parent element where error text element is appended
			errorTextParent: 'wbpoll_extra_field_wrap',
			// type of element to create for the error text
			errorTextTag: 'p',
			// class of the error text element
			errorTextClass: 'text-help'
		};

		var pristine = new Pristine( $element[0], defaultConfig );
		var valid    = pristine.validate(); // returns true or false

		if ( ! valid) {
			e.preventDefault();
		} else {
			wbpoll_formsubmit( $element, $ );
		}

	}
);

function wbpoll_formsubmit($element, $) {
	var $submit_btn = $element.find( '.wbpoll_vote_btn' );
	var wrapper     = $element.closest( '.wbpoll_wrapper' );
	var $_this_busy = Number( $submit_btn.attr( 'data-busy' ) );

	var poll_id    = $submit_btn.attr( 'data-post-id' );
	var reference  = $submit_btn.attr( 'data-reference' );
	var chart_type = $submit_btn.attr( 'data-charttype' );
	var security   = $submit_btn.attr( 'data-security' );

	var user_answer = $element.find( 'input.wbpoll_single_answer:checked' ).serialize();

	if ($_this_busy === 0) {

		$submit_btn.attr( 'data-busy', '1' );
		$submit_btn.prop( 'disabled', true );

		wrapper.find( '.wbvoteajaximage' ).removeClass( 'wbvoteajaximagecustom' );

		var user_answer_trim = user_answer.trim();

		if (typeof user_answer !== 'undefined' && user_answer_trim.length !== 0) { // if one answer given
			wrapper.find( '.wbpoll-qresponse' ).hide();

			jQuery.ajax(
				{
					type: 'post',
					dataType: 'json',
					url: wbpollpublic.ajaxurl,
					data: $element.serialize() + '&user_answer=' + $.base64.btoa( user_answer ),
					success: function (data, textStatus, XMLHttpRequest) {
						if (Number( data.error ) === 0) {
							try { //the data for all graphs
								if (data.show_result === 1) {
									wrapper.append( data.html );
								}

								wrapper.find( '.wbpoll-qresponse' ).show();
								wrapper.find( '.wbpoll-qresponse' ).removeClass( 'wbpoll-qresponse-alert wbpoll-qresponse-error wbpoll-qresponse-success' );
								wrapper.find( '.wbpoll-qresponse' ).addClass( 'wbpoll-qresponse-success' );
								wrapper.find( '.wbpoll-qresponse' ).html( '<p>' + data.text + '</p>' );

								wrapper.find( '.wbpoll_answer_wrapper' ).hide();
							} catch (e) {

							}

						}// end of if not voted
						else {
							wrapper.find( '.wbpoll-qresponse' ).show();
							wrapper.find( '.wbpoll-qresponse' ).removeClass( 'wbpoll-qresponse-alert wbpoll-qresponse-error wbpoll-qresponse-success' );
							wrapper.find( '.wbpoll-qresponse' ).addClass( 'wbpoll-qresponse-error' );
							wrapper.find( '.wbpoll-qresponse' ).html( '<p>' + data.text + '</p>' );
						}

						$submit_btn.attr( 'data-busy', '0' );
						$submit_btn.prop( 'disabled', false );
						wrapper.find( '.wbvoteajaximage' ).addClass( 'wbvoteajaximagecustom' );
					}//end of success
				}
			)//end of ajax

		} else {

			//if no answer given
			$submit_btn.show();
			$submit_btn.attr( 'data-busy', 0 );
			$submit_btn.prop( 'disabled', false );
			wrapper.find( '.wbvoteajaximage' ).addClass( 'wbvoteajaximagecustom' );

			var error_result = wbpollpublic.no_answer_error;

			wrapper.find( '.wbpoll-qresponse' ).show();
			wrapper.find( '.wbpoll-qresponse' ).removeClass( 'wbpoll-qresponse-alert wbpoll-qresponse-error wbpoll-qresponse-success' );
			wrapper.find( '.wbpoll-qresponse' ).addClass( 'wbpoll-qresponse-alert' );
			wrapper.find( '.wbpoll-qresponse' ).html( error_result );
		}
	}// end of this data busy
}

jQuery( document ).ready(function() {
		jQuery( '.poll-image' ).on("click",	function() {
				var dataid = jQuery( this ).data( 'id' );
				jQuery( '.lightbox-' + dataid ).show();
			}
		);
		jQuery( '.close' ).on("click", function() {
				var dataid = jQuery( this ).data( 'id' );
				jQuery( '.lightbox-' + dataid ).hide();
			}
		);
	});
