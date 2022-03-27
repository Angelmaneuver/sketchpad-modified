( function( $ ){
	'use strict';

	$( document ).ready( function() {

		/** Return to Top button event */
		const return2top_button = $( '.return2top' );

		$( window ).on( 'scroll', function() {
			if( $( this ).scrollTop() > 100 ){
				return2top_button.fadeIn();
			}else{
				return2top_button.fadeOut();
			}
		} );

		return2top_button.on( 'click', function() {
			$( 'body, html' ).animate( { scrollTop: 0 } , 500 );
			return false;
		} );
	} );

})( jQuery );
