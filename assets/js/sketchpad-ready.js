( function( $ ){
	'use strict';

	$( document ).ready( function() {

		/** Hamburger menu button event */
		$( '.hamburger_menu' + '.close' ).hide();

		$( '.hamburger_menu' ).on( 'click', function() {
			let is_menu = $( 'div#main-content' ).hasClass( 'show_sidebar' );

			if( !is_menu ){
				$( 'div#main-content' ).data( 'scroll-position', $( document ).scrollTop() );
				$( '.hamburger_menu' + '.open' ).hide();
				$( '.hamburger_menu' + '.close' ).show();
			}

			$( 'div#main-content' ).toggleClass( 'show_sidebar' );

			if( is_menu ){
				$( '.hamburger_menu' + '.open' ).show();
				$( '.hamburger_menu' + '.close' ).hide();
				$( 'body, html' ).animate( { scrollTop: $( 'div#main-content' ).data( 'scroll-position' ) }, 500);
			}
		} );

		/** TOC Widget's event at Hamburger menu */
		$( 'div.sidebar ul.wp-block-sketchpad-modified-blocks-table-of-contents a' ).on( 'click', function() {
			let is_menu = $( 'div#main-content' ).hasClass( 'show_sidebar' );

			if( is_menu ){
				$( 'div#main-content' ).toggleClass( 'show_sidebar' );
				$( '.hamburger_menu' + '.open' ).show();
				$( '.hamburger_menu' + '.close' ).hide();
			}
		} );
	} );

	$( window ).on( 'load', function() {
		height_adjustment();

		const element  = $( 'main' ).get( 0 );
		const observer = new ResizeObserver( ( entries ) => {
			height_adjustment();
		});

		if ( element ) {
			observer.observe( element );
		}
	});

	/** Auto height setting for left vertical background image. */
	function height_adjustment() {
		const main = $( 'main' );

		main.parent().height( function( i, val ){
			return Math.ceil( ( val > main.height() ? val : main.height() ) / 74 ) * 74;
		});
	}
})( jQuery );
