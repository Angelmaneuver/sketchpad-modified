<?php
/**
 * Utility.
 *
 * @package sketchpad - modified
 * @subpackage utils
 * @since 1.0.0
 */

/**
 * Get current url.
 *
 * @since 1.0.0
 */
function sketchpad_get_current_url() {
	return home_url() . $_SERVER['REQUEST_URI'];
}

/**
 * Content to more read convert.
 *
 * @since 1.0.0
 * @param string $post_content Post Content.
 * @param string $link         Post link.
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
 * @since 1.0.0
 * @param string $color_code Color code.
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
