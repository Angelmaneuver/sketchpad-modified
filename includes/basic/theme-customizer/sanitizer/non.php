<?php
/**
 * Sanitizer for theme customizers.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * Non sanitizer.
 * This method does't sanitize.
 *
 * @since 3.0.0
 * @param value $value The customize setting value.
 */
function sketchpad_non_sanitize( $value ) {
	return $value;
}
