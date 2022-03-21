<?php
/**
 * Extends the core functionality of WordPress.
 *
 * @package    Sketchpad
 * @subpackage http
 * @since      3.0.0
 */

/**
 * Wrapper methods (echo).
 * This method echo without sanitize.
 *
 * @since  2.1.0
 * @param  string $value Content to be output.
 * @return void
 */
function hazardous_echo( $value ):void {
	if ( isset( $value ) ) {
		// @codingStandardsIgnoreStart
		echo $value;
		// @codingStandardsIgnoreEnd
	}
}
