<?php
/**
 * Extends the core functionality of WordPress.
 *
 * @package    Sketchpad
 * @subpackage filter
 * @since      3.0.0
 */

/**
 * Added a class that uses the taxonomy name as its name.
 *
 * @param  array $classes  An array of body class names.
 * @param  array $class    An array of additional class names added to the body.
 * @return array Filtering results.
 * @see    https://developer.wordpress.org/reference/hooks/body_class/
 */
function body_class_sketchpad_filter( array $classes, array $class ): array {
	if ( is_singular() ) {
		$classes = array_merge( $classes, get_the_sketchpad_taxonomy_slug_list_4_class() );
	}

	return $classes;
}

add_filter( 'body_class', 'body_class_sketchpad_filter', 10, 2 );

/**
 * Added a class that uses the taxonomy name as its name (for editor).
 *
 * @param  string $classes Space-separated list of CSS classes.
 * @return string Filtering results.
 * @see    https://developer.wordpress.org/reference/hooks/admin_body_class/
 */
function admin_body_class_sketchpad_filter( string $classes ): string {
	global $post_type;

	if ( 'post' === $post_type || 'page' === $post_type ) {
		$classes .= implode( ' ', get_the_sketchpad_taxonomy_slug_list_4_class() );
	}

	return $classes;
}

if ( is_admin() ) {
	add_filter( 'admin_body_class', 'admin_body_class_sketchpad_filter', 10 );
}

/**
 * Return the taxonomy list (for class attribute).
 *
 * @since  3.0.0
 * @param  string $category_prefix A prefix to identify that the source is a category.
 * @param  string $tag_prefix      A prefix to identify that the source is a tags.
 * @return array  Taxonomy list for class attribute.
 */
function get_the_sketchpad_taxonomy_slug_list_4_class(
	string $category_prefix = 'category-',
	string $tag_prefix = 'tag-'
):array {
	$temporary  = array();
	$categories = get_the_category();
	$tags       = get_the_tags();

	if ( $categories ) {
		foreach ( $categories as $category ) {
			$temporary[] = "{$category_prefix}{$category->slug}";
		}
	}

	if ( $tags ) {
		foreach ( $tags as $tag ) {
			$temporary[] = "{$tag_prefix}{$tag->slug}";
		}
	}

	return $temporary;
}
