<?php
/**
 * Sanitizer for theme customizers.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * Head tag sanitizer.
 *
 * @since 3.0.0
 * @param value $value The customize setting value.
 */
function sketchpad_sanitize_head( $value ) {
	$allow = array(
		'link'   => array(
			'rel'   => array(),
			'type'  => array(),
			'href'  => array(),
			'media' => array(),
		),
		'script' => array(
			'type'        => array(),
			'src'         => array(),
			'crossorigin' => array(),
		),
	);

	return wp_kses( $value, $allow );
}
