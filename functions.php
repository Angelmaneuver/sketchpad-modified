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

	/** This theme supports for wide alignment. */
	add_theme_support( 'align-wide' );

	/** Adds RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );

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

	/** This theme supports custom logo image. */
	$args = array(
		'width'              => 715,
		'height'             => 117,
		'uploads'            => true,
		'default-text-color' => '776B53',
		'header-text'        => true,
		'default-image'      => get_template_directory_uri() . '/images/bg-logo.png',
	);

	add_theme_support( 'custom-header', $args );

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 72,
			'width'       => 162,
			'flex-height' => false,
			'flex-width'  => false,
			'header-text' => array( 'site-title', 'site-description' ),
		)
	);

	/** This theme supports custom background color and image. */
	add_theme_support( 'custom-background', array( 'default-color' => 'AF9F88' ) );

	/** This theme supports manage the document title tag. */
	add_theme_support( 'title-tag' );

	/* This theme supports to JetPack's infinite scroll. */
	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'articles',
			'footer'    => false,
			'wrapper'   => false,
		)
	);

	/** This theme supports to style the visual editor. */
	add_theme_support( 'editor-styles' );
	add_editor_style( get_template_directory_uri() . '/style-editor.css' );
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

/**
 * Scripts and styles enqueue process.
 *
 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 */
function sketchpad_script() {
	wp_enqueue_style(
		'google-open-sans',
		'//fonts.googleapis.com/css?family=Open+Sans',
		array()
	);

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
 * Style for site title.
 */
function sketchpad_header() { ?>
	<style type="text/css">
		<?php if ( ! display_header_text() ) { ?>
			div#main-content > div#wrapper > header .header h1.site-title,
			div#main-content > div#wrapper > header .header h2.site-description {
				display: none;
			}
		<?php } else { ?>
			.site-title a,
			.site-title p,
			.site-description {
				color: <?php echo '#' . get_header_textcolor(); ?>;
			}
		<?php } ?>
	</style>
	<?php
}

add_action( 'init', 'sketchpad_init' );
add_action( 'after_setup_theme', 'sketchpad_setup' );
add_action( 'widgets_init', 'register_sketchpad_widgets' );
add_action( 'widget_text', 'do_shortcode' );
add_action( 'wp_enqueue_scripts', 'sketchpad_script' );
add_action( 'admin_enqueue_scripts', 'sketchpad_admin_script' );
add_action( 'wp_head', 'sketchpad_header' );

require get_template_directory() . '/includes/load.php';
