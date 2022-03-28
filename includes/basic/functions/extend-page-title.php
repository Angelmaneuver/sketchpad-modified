<?php
/**
 * Extends the Page title function.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * These modules are needed to load this function.
 */
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-extend-page-title-initializer.php';

/**
 * Add text to the page title.
 *
 * @since  3.0.0
 * @param  string  $title The post title.
 * @param  integer $id    The post ID.
 * @return string  Filtering results.
 */
function the_title_page_sketchpad_filter( string $title, int $id ):string {
	if ( ! ( ( is_home() || is_archive() || is_search() || is_singular() ) && 'page' === get_post_type( $id ) ) ) {
		return $title;
	}

	return str_replace( '{title}', $title, SM_Extend_Page_Title_Initializer::get_sketchpad_title_extend() );
}

if ( SM_Extend_Page_Title_Initializer::is_extend_sketchpad_title() ) {
	add_action( 'the_title', 'the_title_page_sketchpad_filter', 10, 2 );
}
