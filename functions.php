<?php
/**
 * Functions and definitions.
 *
 * @package sketchpad
 * @since 1.0.0
 */

if ( ! isset( $content_width ) ) {
	$content_width = 590;
}

/**
 * WordPress initialize timing process.
 *
 * @see https://developer.wordpress.org/reference/hooks/init/
 */
function sketchpad_init() {
	/** This theme supports to category and tag the page. */
	register_taxonomy_for_object_type( 'category', 'page' );
	register_taxonomy_for_object_type( 'post_tag', 'page' );
}

/**
 * Theme setup process.
 *
 * @see https://developer.wordpress.org/reference/hooks/after_setup_theme/
 */
function sketchpad_setup() {
	/** Makes Sketchpad available for translation. */
	load_theme_textdomain( 'sketchpad-modified', get_template_directory() . '/languages' );

	/** This theme support wp_nav_menu() in one location. */
	register_nav_menu( 'primary', __( 'Primary menu', 'sketchpad-modified' ) );

	/** This theme supports for post thumbnails. */
	add_theme_support( 'post-thumbnails' );

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

	/** This theme supports for wide alignment. */
	add_theme_support( 'align-wide' );

	/** This theme supports for responsive. */
	add_theme_support( 'responsive-embeds' );

	/** Adds RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );

	/** This theme supports custom logo image. */
	$args = array(
		'width'              => 715,
		'height'             => 117,
		'uploads'            => true,
		'default-text-color' => '776B53',
		'header-text'        => true,
		'default-image'      => get_template_directory_uri() . '/images/bg-logo.webp',
	);

	add_theme_support( 'custom-header', $args );

	$args = array(
		'height'      => 72,
		'width'       => 162,
		'flex-height' => false,
		'flex-width'  => false,
		'header-text' => array( 'site-title', 'site-description' ),
	);

	add_theme_support( 'custom-logo', $args );

	/** This theme supports custom background color and image. */
	add_theme_support( 'custom-background', array( 'default-color' => 'AF9F88' ) );

	/** This theme supports manage the document title tag. */
	add_theme_support( 'title-tag' );

	/** This theme supports for html5. */
	$args = array(
		'script',
		'style',
	);

	add_theme_support( 'html5', $args );

	/* This theme supports to JetPack's infinite scroll. */
	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'articles',
			'footer'    => false,
			'wrapper'   => false,
		)
	);

	/** This theme supports to default gutenberg block style. */
	add_theme_support( 'wp-block-styles' );

	/** This theme supports to style the visual editor. */
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style-editor.css' );
}

/**
 * Resource hints set process.
 *
 * @param  array  $urls          URLs to print for resource hints.
 * @param  string $relation_type The relation type the URLs are printed for, e.g. 'preconnect' or 'prerender'.
 * @return array                 After conversion the URLs.
 *
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

/**
 * Style for site title.
 */
function sketchpad_header() {
	$value = '<style>';

	if ( ! display_header_text() ) {
		$value .= 'div#main-content > div#wrapper > header .header h1.site-title, div#main-content > div#wrapper > header .header h2.site-description { display: none; }';
	} else {
		$value .= '.site-title a, .site-title p, .site-description { color: #' . esc_html( get_header_textcolor() ) . ' }';
	}

	$value .= <<<EOM
</style>

EOM;

	hazardous_echo( $value );
}

/**
 * Scripts and styles enqueue process.
 *
 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 */
function sketchpad_script() {
	wp_enqueue_style(
		'google-open-sans',
		'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;1,300;1,400&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style(
		'sketchpad-style',
		get_template_directory_uri() . '/style.css',
		array(),
		(string) filemtime( get_template_directory() . '/style.css' ),
		'all'
	);

	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script(
		'sketchpad-script',
		get_template_directory_uri() . '/js/sketchpad-ready.js',
		array( 'jquery' ),
		(string) filemtime( get_template_directory() . '/js/sketchpad-ready.js' ),
		true
	);
}

/**
 * Scripts and styles enqueue process for admin.
 *
 * @see https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
 */
function sketchpad_admin_script() {
	wp_enqueue_style(
		'sketchpad-admin-style',
		get_template_directory_uri() . '/style-admin.css',
		array(),
		(string) filemtime( get_template_directory() . '/style-admin.css' ),
		'all'
	);
}

/**
 * Widgets initialize timing process.
 *
 * @see https://developer.wordpress.org/reference/hooks/widgets_init/
 */
function register_sketchpad_widgets() {
	/** This theme support widget sidebar. */
	register_sidebar(
		array(
			'name'          => __( 'Right Sidebar Widget', 'sketchpad-modified' ),
			'id'            => 'sidebar',
			'description'   => __( 'Right Widget Area', 'sketchpad-modified' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<header><h4 class="widgettitle">',
			'after_title'   => '</h4></header>',
		)
	);
}

add_action( 'init', 'sketchpad_init' );
add_action( 'after_setup_theme', 'sketchpad_setup' );
add_filter( 'wp_resource_hints', 'sketchpad_resource_hints', 10, 2 );
add_action( 'wp_head', 'sketchpad_header' );
add_action( 'wp_enqueue_scripts', 'sketchpad_script' );
add_action( 'admin_enqueue_scripts', 'sketchpad_admin_script' );
add_action( 'widgets_init', 'register_sketchpad_widgets' );
add_action( 'widget_text', 'do_shortcode' );

add_filter( 'jetpack_implode_frontend_css', '__return_false' );

require get_template_directory() . '/includes/load.php';
