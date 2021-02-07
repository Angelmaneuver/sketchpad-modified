<?php
/**
 * Extend method.
 *
 * @package sketchpad - modified
 * @subpackage filter
 * @since 1.0.0
 */

/**
 * The style attribute is removed
 *
 * @param String|Array $return Tag cloud as a string or an array, depending on 'format' argument.
 * @return String|Array If $return is a String, then the converted HTML.
 * @see https://developer.wordpress.org/reference/hooks/wp_tag_cloud/
 */
function sm_tag_cloud( $return ) {
	return preg_replace( '/\s*?style="[^"]+?"/i', '', $return );
}

add_filter( 'wp_tag_cloud', 'sm_tag_cloud', 10 );
