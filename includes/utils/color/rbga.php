<?php
/**
 * Extends the core functionality of WordPress.
 *
 * @package    Sketchpad
 * @subpackage color
 * @since      3.0.0
 */

/**
 * Color code to rgba convert.
 *
 * @since  2.1.0
 * @param  string $color_code Color code.
 * @return array  RGB Array.
 *                [0] or ['red']   : Red
 *                [1] or ['green'] : Green
 *                [2] or ['blue']  : Blue
 */
function get_sketchpad_color_code2rgba( $color_code ):array {
	$hex           = preg_replace( '/#/', '', $color_code );
	$rgba['red']   = hexdec( substr( $hex, 0, 2 ) );
	$rgba['green'] = hexdec( substr( $hex, 2, 2 ) );
	$rgba['blue']  = hexdec( substr( $hex, 4, 2 ) );

	return $rgba;
}
