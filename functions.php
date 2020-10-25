<?php
/**
 * Functions and definitions.
 *
 * @subpackage sketchpad
 * @since      1.0.0
 */

if ( ! isset( $content_width ) ) {
	$content_width = 590;
}

function sketchpad_init() {
	/* This theme supports to category and tag the page. */
	register_taxonomy_for_object_type( 'category', 'page' );
	register_taxonomy_for_object_type( 'post_tag', 'page' );
}

function sketchpad_setup() {
	/* Makes Sketchpad available for translation */
	load_theme_textdomain( 'sketchpad-modified', get_template_directory() . '/languages' );

	/* This theme support wp_nav_menu() in one location */
	register_nav_menu( 'primary', __( 'Primary menu', 'sketchpad-modified' ) );

	/* This theme supports for post thumbnails */
	add_theme_support( 'post-thumbnails' );

	/* Adds RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );

	/* This theme supports a variety of post formats */
	add_theme_support( 'post-formats', array(
		'aside',
		'gallery',
		'image',
		'link',
		'quote',
		'status',
		'video',
		'audio',
		'chat',
	) );

	/* This theme supports custom logo image. */
	$args = array(
		'width'              => 715,
		'height'             => 117,
		'uploads'            => true,
		'default-text-color' => '776B53',
		'header-text'        => true,
		'default-image'      => get_template_directory_uri() . '/images/bg-logo.png',
	);
	add_theme_support( 'custom-header', $args );

	/* This theme supports custom background color and image. */
	add_theme_support( 'custom-background', array( 'default-color' => 'AF9F88' ) );

	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-logo', array(
		'height'      => 72,
		'width'       => 162,
		'flex-height' => false,
		'flex-width'  => false,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	/* This theme supports to JetPack's infinite scroll. */
	add_theme_support( 'infinite-scroll', array(
		'container' => 'articles',
		'footer'    => false,
		'wrapper'   => false,
	) );

	/* This theme supports to style the visual editor. */
	add_theme_support( 'editor-styles' );
	add_editor_style( get_template_directory_uri() . '/style-editor.min.css' );
}

function register_sketchpad_widgets() {
	/* This theme support widget sidebar. */
	register_sidebar( array(
		'name'          => __( 'Right Sidebar Widget', 'sketchpad-modified' ),
		'id'            => 'sidebar',
		'description'   => __( 'Right Widget Area', 'sketchpad-modified' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<header><h4 class="widgettitle">',
		'after_title'   => '</h4></header>',
	) );
}

/* Load scripts and styles */
function sketchpad_script() {
	wp_enqueue_style( 'google-open-sans', '//fonts.googleapis.com/css?family=Open+Sans', array() );
	wp_enqueue_style( 'sketchpad-style', get_template_directory_uri() . '/style.min.css' );

	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/* Auto calculate height */
	wp_enqueue_script( 'sketchpad-script', get_template_directory_uri() . '/js/sketchpad-ready.js', array( 'jquery' ), false, true );
}

/* style for site title */
function sketchpad_header() { ?>
	<style type="text/css">
		<?php if ( ! display_header_text() ) { ?>
			.site-title,
			.site-description {
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
<?php }

add_action( 'init', 'sketchpad_init' );
add_action( 'after_setup_theme', 'sketchpad_setup' );
add_action( 'widgets_init', 'register_sketchpad_widgets' );
add_action( 'widget_text', 'do_shortcode' );
add_action( 'wp_enqueue_scripts', 'sketchpad_script' );
add_action( 'wp_head', 'sketchpad_header' );

require get_template_directory() . '/includes/load.php';
