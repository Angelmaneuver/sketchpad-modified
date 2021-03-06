<?php
/**
 * Utility.
 *
 * @package    sketchpad
 * @subpackage sm-utils
 * @since      2.1.0
 */

/**
 * Wrapper methods (paginate_links).
 * This method does the escape and echo.
 *
 * @since 2.1.0
 * @param array $args paginate_link's parameter.
 * @see   https://developer.wordpress.org/reference/functions/paginate_links/
 */
function the_paginate_links( $args ): void {
	the_esc_html_paginate_links( paginate_links( $args ) );
}

/**
 * Wrapper methods (paginate_comments_links).
 * This method does the escape and echo.
 *
 * @since 2.1.0
 * @param array $args paginate_comments_links's parameter.
 * @see   https://developer.wordpress.org/reference/functions/paginate_comments_links/
 */
function the_paginate_comments_links( $args ): void {
	the_esc_html_paginate_links( paginate_comments_links( $args ) );
}

/**
 * Escaping a paginate html strings and output it.
 *
 * @since 2.1.0
 * @param string $string paginate html strings.
 */
function the_esc_html_paginate_links( $string ): void {
	echo wp_kses(
		$string,
		array(
			'span' => array(
				'class'        => array(),
				'aria-current' => array(),
			),
			'a'    => array(
				'class' => array(),
				'href'  => array(),
			),
		),
	);
}

/**
 * Escaping a link (a tag) html strings and output it.
 *
 * @since 2.1.0
 * @param string $string link html (a tag) strings.
 */
function the_esc_html_a( $string ): void {
	echo wp_kses(
		$string,
		array(
			'span' => array(
				'class' => array(),
			),
			'a'    => array(
				'class'  => array(),
				'title'  => array(),
				'href'   => array(),
				'rel'    => array(),
				'target' => array(),
			),
			'i'    => array(
				'class'       => array(),
				'aria-hidden' => array(),
			),
		),
	);
}

/**
 * Wrapper methods (echo).
 * This method echo without sanitize.
 *
 * @since 2.1.0
 * @param string $value Content to be output.
 */
function hazardous_echo( $value ) {
	if ( isset( $value ) ) {
		// @codingStandardsIgnoreStart
		echo $value;
		// @codingStandardsIgnoreEnd
	}
}

/**
 * Get the current url.
 *
 * @since  2.1.0
 * @return string current url.
 */
function get_the_current_url() {
	$request_uri = '';

	if ( isset( $_SERVER['REQUEST_URI'] ) ) {
		// @codingStandardsIgnoreStart
		$request_uri = wp_unslash( $_SERVER['REQUEST_URI'] );
		// @codingStandardsIgnoreEnd
	}

	return home_url() . $request_uri;
}

/**
 * Content to more read convert.
 *
 * @since  2.1.0
 * @param  string $post_content Post Content.
 * @param  string $link         Post link.
 * @return string String up to the read more tag.
 */
function sketchpad_content2more_read( $post_content, $link ) {
	$more_text     = esc_html( __( 'more &raquo;', 'sketchpad-modified' ) );
	$split_content = get_extended( $post_content );
	$content       = wp_strip_all_tags( $split_content['main'] );

	if ( '' !== $split_content['extended'] ) {
		$content = <<< EOM
	{$content} <a href="{$link}">{$more_text}</a>
EOM;
	}

	return $content;
}

/**
 * Color code to rgba convert.
 *
 * @since  2.1.0
 * @param  string $color_code Color code.
 * @return array RGB Array.
 *               [0] or ['red']   : Red
 *               [1] or ['green'] : Green
 *               [2] or ['blue']  : Blue
 */
function sketchpad_color_code2rgba( $color_code ) {
	$hex           = preg_replace( '/#/', '', $color_code );
	$rgba['red']   = hexdec( substr( $hex, 0, 2 ) );
	$rgba['green'] = hexdec( substr( $hex, 2, 2 ) );
	$rgba['blue']  = hexdec( substr( $hex, 4, 2 ) );

	return $rgba;
}
