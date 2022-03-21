<?php
/**
 * Sanitizer for theme customizers.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * Button template sanitizer.
 *
 * @since 3.0.0
 * @param value $input The customize setting value.
 */
function sketchpad_sanitize_button_template( $input ) {
	$allow = array(
		'a'    => array(
			'class' => array(),
			'id'    => array(),
			'style' => array(),
			'href'  => array(),
			'title' => array(),
			'alt'   => array(),
		),
		'span' => array(
			'class' => array(),
			'id'    => array(),
			'style' => array(),
		),
		'div'  => array(
			'class' => array(),
			'id'    => array(),
			'style' => array(),
		),
		'i'    => array(
			'class' => array(),
			'id'    => array(),
			'style' => array(),
		),
	);

	return wp_kses( $input, $allow );
}
