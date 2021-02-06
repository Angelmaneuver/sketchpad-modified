( function( $ ){
	'use strict';

	$( document ).ready( function() {
		height_adjustment();

		/** Hamburger menu button event */
		$( '.hamburger_menu' + '.close' ).hide();

		$( '.hamburger_menu' ).click( function(){
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
		});

		/** TOC+ Widget's event at Hamburger menu */
		$( 'ul.toc_widget_list a' ).click( function(){
			let is_menu = $( 'div#main-content' ).hasClass( 'show_sidebar' );

			if( is_menu ){
				$( 'div#main-content' ).toggleClass( 'show_sidebar' );
				$( '.hamburger_menu' + '.open' ).show();
				$( '.hamburger_menu' + '.close' ).hide();
			}
		});

		/** Return to Top button event */
		let return2top_button = $( '.top_button' );

		$( window ).scroll( function(){
			if( $( this ).scrollTop() > 100 ){
				return2top_button.fadeIn();
			}else{
				return2top_button.fadeOut();
			}
		});

		return2top_button.click( function(){
			$( 'body, html' ).animate( { scrollTop: 0} , 500 );
			return false;
		});
	});

	$( document.body ).on( 'post-load', function () {
		height_adjustment();
	});

	/** Auto height .content for left vertical background image */
	function height_adjustment() {
		$( ".content" ).height( function( i, val ){
			return Math.ceil( val / 74 ) * 74;
		});
		let h = $( ".content" ).height();
		$( ".main-content" ).height( h );
	}

})( jQuery );

/**
 * Overwrite/bypass <iframe></iframe> height limit imposed by Wordpress
 * Original idea from bypass-iframe-height-limit plugin by Justin Carboneau
 * Adapted from original /wp-includes/js/wp-embed.js
 */
( function( window, document ) {
	'use strict';

	var supportedBrowser = false;

	// Verify if browser is supported
	if ( document.querySelector ) {
		if ( window.addEventListener ) {
			supportedBrowser = true;
		}
	}

	/** @namespace owihl */
	window.owihl = window.owihl || {};

	if ( !!window.owihl.OverwriteIframeHeightLimit ) {
		return;
	}

	window.owihl.OverwriteIframeHeightLimit = function( e ) {
		var data = e.data;

		// Check if all needed data is provided
		if ( !( data.secret || data.message || data.value ) ) {
			return;
		}

		// Check if data secret is alphanumeric
		if ( /[^a-zA-Z0-9]/.test( data.secret ) ) {
			return;
		}

		// Select all iframes
		var iframes = document.querySelectorAll( 'iframe[data-secret="' + data.secret + '"]' ), i, source;

		for ( i = 0; i < iframes.length; i++ ) {
			source = iframes[i];

			if ( e.source !== source.contentWindow ) {
				continue;
			}

			if ( 'height' === data.message ) {
				// wp-embed.js clears any added inline styls, that's why we need to create a style element
				var styleElem = document.getElementById( 'owihl-style-' + source.getAttribute( 'data-secret' ) );
				var css = 'iframe.wp-embedded-content[data-secret="' + source.getAttribute( 'data-secret' ) + '"] { height: ' + parseInt( data.value, 10 ) + 'px; }';

				if ( styleElem ) {
					styleElem.innerHTML = css;
				} else {
					var head = document.head || document.getElementsByTagName( 'head' )[0],
							style = document.createElement( 'style' );

					style.type = 'text/css';
					style.id = 'owihl-style-' + source.getAttribute( 'data-secret' );
					style.appendChild( document.createTextNode( css ) );

					head.appendChild( style );
				}
			}
		}
	};

	if ( supportedBrowser ) {
		window.addEventListener( 'message', window.owihl.OverwriteIframeHeightLimit, false );
	} else {
		console.log( 'Wordpress <iframe> limit is still present because the browser is not supported.' );
		console.log( 'For more information : https://medium.com/@wlarch/overwrite-and-bypass-wordpress-iframe-height-dimension-limit-using-javascript-9d5035c89e37' );
	}
} )( window, document );
