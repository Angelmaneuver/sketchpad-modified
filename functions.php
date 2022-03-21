<?php
/**
 * Functions and definitions.
 *
 * @package Sketchpad
 * @since   3.0.0
 */

if ( ! isset( $content_width ) ) {
	$content_width = 590;
}

/**
 * WordPress initialize timing process.
 *
 * @return void
 * @see    https://developer.wordpress.org/reference/hooks/init/
 */
function sketchpad_init():void {
	/** This theme supports to category and tag the page. */
	register_taxonomy_for_object_type( 'category', 'page' );
	register_taxonomy_for_object_type( 'post_tag', 'page' );
}

add_action( 'init', 'sketchpad_init' );

/**
 * Theme setup process.
 *
 * @return void
 * @see    https://developer.wordpress.org/reference/hooks/after_setup_theme/
 */
function sketchpad_setup():void {
	/** Makes Sketchpad available for translation. */
	load_theme_textdomain( 'sketchpad-modified', get_template_directory() . '/languages' );

	/** This theme supports to default gutenberg block style. */
	add_theme_support( 'wp-block-styles' );
	add_editor_style( 'style.css' );

	/** This theme supports a variety of post formats. */
	add_theme_support(
		'post-formats',
		array(
			'aside',
			'gallery',
			'image',
			'link',
			'quote',
			'status',
			'video',
			'audio',
			'chat',
		)
	);
}

add_action( 'after_setup_theme', 'sketchpad_setup' );

/**
 * Resource hints set process.
 *
 * @param  array  $urls          URLs to print for resource hints.
 * @param  string $relation_type The relation type the URLs are printed for, e.g. 'preconnect' or 'prerender'.
 * @return array                 After conversion the URLs.
 * @see    https://developer.wordpress.org/reference/hooks/wp_resource_hints/
 */
function sketchpad_resource_hints( $urls, $relation_type ): array {
	if ( ! is_admin() ) {
		if ( 'dns-prefetch' === $relation_type ) {
			$urls[] = '//fonts.gstatic.com';
		}

		asort( $urls, SORT_STRING );
	}

	return $urls;
}

add_filter( 'wp_resource_hints', 'sketchpad_resource_hints', 10, 2 );

/**
 * Scripts and styles enqueue process.
 *
 * @return void
 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 */
function sketchpad_script() {
	wp_enqueue_style(
		'google-open-sans',
		'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;1,300;1,400&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'google-montserrat',
		'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,300;1,400&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'dashicons' );

	wp_register_style(
		'sketchpad-style',
		get_template_directory_uri() . '/style.css',
		array(),
		(string) filemtime( get_template_directory() . '/style.css' ),
		'all'
	);

	wp_enqueue_style( 'sketchpad-style' );

	wp_enqueue_script(
		'sketchpad-script',
		get_template_directory_uri() . '/assets/js/sketchpad-ready.js',
		array( 'jquery' ),
		(string) filemtime( get_template_directory() . '/assets/js/sketchpad-ready.js' ),
		true
	);
}

add_action( 'wp_enqueue_scripts', 'sketchpad_script' );

/**
 * Admin Scripts and styles enqueue process.
 *
 * @return void
 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 */
function sketchpad_admin_script() {
	wp_register_style(
		'sketchpad-admin-style',
		get_template_directory_uri() . '/assets/stylesheets/css/admin/style_admin.css',
		array(),
		(string) filemtime( get_template_directory() . '/assets/stylesheets/css/admin/style_admin.css' ),
		'all'
	);
	wp_enqueue_style( 'sketchpad-admin-style' );
}

add_action( 'admin_enqueue_scripts', 'sketchpad_admin_script' );

/**
 * Editor Script and styles enqueue process.
 *
 * @return void
 * @see    https://developer.wordpress.org/reference/hooks/enqueue_block_editor_assets/
 */
function sketchpad_editor_script() {
	wp_enqueue_style(
		'sketchpad-editor-style',
		get_template_directory_uri() . '/assets/stylesheets/css/editor/block_editor_style.css',
		array(),
		(string) filemtime( get_template_directory() . '/assets/stylesheets/css/editor/block_editor_style.css' ),
		'all'
	);
}

add_action( 'enqueue_block_editor_assets', 'sketchpad_editor_script' );

add_filter( 'jetpack_implode_frontend_css', '__return_false' );

require get_template_directory() . '/includes/load.php';
