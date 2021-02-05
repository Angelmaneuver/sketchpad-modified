<?php
/**
 * Sanitizer for theme customizers.
 *
 * @package sketchpad - modified
 * @subpackage utils
 * @since 1.0.0
 */

/**
 * Checkbox sanitizer.
 *
 * @param value                $checked The Customize Setting value.
 * @param WP_Customize_Setting $setting The Customize Setting object (not use).
 */
function sketchpad_sanitize_checkbox( $checked, $setting ) {
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Radio, Selectbox sanitizer.
 *
 * @param value                $input   The Customize Setting value.
 * @param WP_Customize_Setting $setting The Customize Setting object.
 */
function sketchpad_sanitize_select( $input, $setting ) {
	$input   = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;

	return array_key_exists( $input, $choices ) ? $input : $setting->default;
}

/**
 * Button template sanitizer.
 *
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

/**
 * Breadcrumb template sanitizer.
 *
 * @param value $input The customize setting value.
 */
function sketchpad_sanitize_breadcrumb_template( $input ) {
	$allow = array(
		'a'    => array(
			'class'    => array(),
			'id'       => array(),
			'style'    => array(),
			'href'     => array(),
			'title'    => array(),
			'property' => array(),
			'typeof'   => array(),
		),
		'span' => array(
			'class'    => array(),
			'id'       => array(),
			'style'    => array(),
			'vocab'    => array(),
			'property' => array(),
			'typeof'   => array(),
		),
		'div'  => array(
			'class'    => array(),
			'id'       => array(),
			'style'    => array(),
			'vocab'    => array(),
			'property' => array(),
			'typeof'   => array(),
		),
		'meta' => array(
			'property' => array(),
			'content'  => array(),
		),
	);

	return wp_kses( $input, $allow );
}
