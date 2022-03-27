( function( $ ){
	'use strict';

	$( document ).ready( function() {

		/** Hamburger menu button event */
		$( '.hamburger' ).on( 'click', function() {
			const root       = $( 'body' );
			const element    = $( '.hamburger' );
			const is_sidebar = root.hasClass( 'sidebar-on-display' );

			if( !is_sidebar ){
				element.find( '.open' ).hide();
				element.find( '.close' ).show()
				root.data( 'scroll-position', $( document ).scrollTop() );
				$( 'body, html' ).animate( { scrollTop: 0 }, 0 );
			}

			root.toggleClass( 'sidebar-on-display' );

			if( is_sidebar ){
				element.find( '.open' ).show();
				element.find( '.close' ).hide()
				$( 'body, html' ).animate( { scrollTop: root.data( 'scroll-position' ) }, 500 );
			}
		} );

		/** TOC Widget's event at Hamburger menu */
		$( '.wp-block-sketchpad-modified-blocks-table-of-contents a' ).on( 'click', function() {
			const root       = $( 'body' );
			const element    = $( '.hamburger' );
			const is_sidebar = root.hasClass( 'sidebar-on-display' );

			if( is_sidebar ){
				root.toggleClass( 'sidebar-on-display' );
				element.find( '.open' ).show();
				element.find( '.close' ).hide()

			}
		} );
	} );

	$( window ).on( 'load', function () {
		const mainHeight     = $( 'main' );
		const contentHeight  = $( '.wp-site-blocks > section > .wp-block-columns' );
		const mainBackground = $( '.wp-site-blocks > section > .wp-block-columns .wp-block-column.is-style-sketchpad-left' );

		if (
			mainHeight.get( 0 ) instanceof Element &&
			contentHeight.get( 0 ) instanceof Element &&
			mainBackground.get( 0 ) instanceof Element
		) {
			height_adjustment(
				contentHeight,
				( mainHeight.height() > contentHeight.height() ? mainHeight : contentHeight ),
				mainBackground
			);

			new ResizeObserver( ( entries ) => {
				height_adjustment(
					contentHeight,
					( mainHeight.height() > contentHeight.height() ? mainHeight : contentHeight ),
					mainBackground
				);
			} ).observe( mainHeight.get( 0 ) );
		}

		const footerHeight     = $( '.wp-site-blocks > footer .wp-block-columns.is-style-sketchpad-footer .wp-block-column.is-style-sketchpad-center' );
		const footerBackground = $( '.wp-site-blocks > footer .wp-block-columns.is-style-sketchpad-footer .wp-block-column.is-style-sketchpad-left' );

		if (
			footerHeight.get( 0 ) instanceof Element &&
			footerBackground.get( 0 ) instanceof Element
		) {
			height_adjustment( footerHeight, footerHeight, footerBackground );
		}
	} );

	/** Auto height setting for left vertical background image. */
	function height_adjustment( adjustment, survey, background ) {
		const base = survey.height() > 74 ? round( ( background.width() / 97 ) * 74 ) : 74;

		adjustment.height( function( index, height ){
			return round( Math.ceil( survey.height() / base ) * base );
		} );
	}

	function round( number ) {
		return (
			Math.round(
				Number( ( Math.abs( number ) * 1 ).toPrecision( 15 ) )
			) / 1 * Math.sign( number )
		);
	}
})( jQuery );
