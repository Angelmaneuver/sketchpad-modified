<?php
/**
 * Sanitizer for theme customizers.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * Radio, Selectbox sanitizer.
 *
 * @since 3.0.0
 * @param value                $input   The Customize Setting value.
 * @param WP_Customize_Setting $setting The Customize Setting object.
 */
function sketchpad_sanitize_select( $input, $setting ) {
	$input   = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;

	return array_key_exists( $input, $choices ) ? $input : $setting->default;
}
