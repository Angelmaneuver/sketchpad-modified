<?php
/**
 * Extend method.
 *
 * @package sketchpad - modified
 * @subpackage filter
 * @since 1.0.0
 */

/**
 * Select list categories.
 *
 * @param String $output HTML output.
 * @param Array  $parsed_args Arguments used to build the drop-down.
 * @return String Converted HTML.
 * @see https://developer.wordpress.org/reference/hooks/wp_dropdown_cats/
 */
function sm_dropdown_categories( $output, $parsed_args ) {
	if ( isset( $parsed_args['sketchpad_multiple'] ) && $parsed_args['sketchpad_multiple'] ) {
		$after    = '<select multiple'
					. ( ( isset( $parsed_args['sketchpad_size'] ) ) ? ' size="' . $parsed_args['sketchpad_size'] . '"' : '' );
		$output   = str_replace( '<select', $after, $output );
		$selected = is_array( $parsed_args['sketchpad_selected'] )
					? $parsed_args['sketchpad_selected']
					: explode(
						',',
						$parsed_args['sketchpad_selected']
					);
		foreach ( array_map( 'trim', $selected ) as $value ) {
			$output = str_replace( "value=\"{$value}\"", "value=\"{$value}\" selected", $output );
		}
	}

	return $output;
}

add_filter( 'wp_dropdown_cats', 'sm_dropdown_categories', 10, 2 );
