<?php
/**
 * Extend method.
 *
 * @package sketchpad - modified
 * @subpackage filter
 * @since 1.0.0
 */

/**
 * List categories.
 *
 * @param String $output HTML output.
 * @param Array  $args   An array of taxonomy-listing arguments. See wp_list_categories() for information on accepted arguments.
 * @return String Converted HTML.
 * @see https://developer.wordpress.org/reference/hooks/wp_list_categories/
 */
function sm_list_categories( $output, $args ) {
	return preg_replace( '/(<li(?: .+?)?>)(.*?)(<\/li>|<ul)/s', '${1}<div class="cat-item">${2}</div>${3}', $output );
}

add_filter( 'wp_list_categories', 'sm_list_categories', 10, 2 );

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
