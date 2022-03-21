<?php
/**
 * Sanitizer for theme customizers.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * Checkbox sanitizer.
 *
 * @since 3.0.0
 * @param value                $checked The Customize Setting value.
 * @param WP_Customize_Setting $setting The Customize Setting object (not use).
 */
function sketchpad_sanitize_checkbox( $checked, $setting ):bool {
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}
