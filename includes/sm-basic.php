<?php
/**
 * Sketchpad - modified Basic.
 *
 * @package    sketchpad
 * @subpackage sm-basic
 * @since      2.1.0
 */

/**
 * These modules are needed to load this function.
 */
require get_template_directory() . '/includes/admin/theme-customizer/sm-basic/class-sm-basic-constant.php';

/**
 * Set up the panel.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function sketchpad_customizer4basic_register( $wp_customize ) {
	$wp_customize->add_panel(
		Sm_Basic_Constant::PANEL,
		array(
			'title'    => __( 'Sketchpad - modified Basic Setting', 'sketchpad-modified' ),
			'priority' => 1000,
		)
	);
}

if ( is_admin() || is_customize_preview() ) {
	add_action( 'customize_register', 'sketchpad_customizer4basic_register', 10 );

	require get_template_directory() . '/includes/admin/theme-customizer/class/class-sm-admin-page-setting-initializer.php';
	require get_template_directory() . '/includes/admin/theme-customizer/class/class-sm-insert-head-tag-initializer.php';
	require get_template_directory() . '/includes/admin/theme-customizer/class/class-sm-insert-body-tag-initializer.php';
	require get_template_directory() . '/includes/admin/theme-customizer/class/class-sm-blog-card-initializer.php';
	require get_template_directory() . '/includes/admin/theme-customizer/class/class-sm-return2top-button-initializer.php';
	require get_template_directory() . '/includes/admin/theme-customizer/class/class-sm-hamburger-menu-button-initializer.php';
	add_action( 'customize_register', array( new SM_Admin_Page_Setting_Initializer(), 'init' ), 100 );
	add_action( 'customize_register', array( new SM_Insert_Head_Tag_Initializer(), 'init' ), 100 );
	add_action( 'customize_register', array( new SM_Insert_Body_Tag_Initializer(), 'init' ), 100 );
	add_action( 'customize_register', array( new SM_Blog_Card_Initializer(), 'init' ), 100 );
	add_action( 'customize_register', array( new SM_Return2Top_Button_Initializer(), 'init' ), 100 );
	add_action( 'customize_register', array( new SM_Hamburger_Menu_Button_Initializer(), 'init' ), 100 );

	require get_template_directory() . '/includes/admin/theme-customizer/sm-basic/admin-page-setting.php';
}

/**
 * Insert head tag.
 *
 * @subpackage insert-head-tag
 * @since      2.1.0
 */
function sketchpad_head_insert_head() {
	$insert_head = get_theme_mod( 'sketchpad_head_insert_head', '' );

	if ( '' !== $insert_head ) {
		$value = <<<EOM
{$insert_head}

EOM;
		hazardous_echo( $value );
	}
}

$insert_head_priority = get_theme_mod( 'sketchpad_head_insert_priority', 10 );

add_filter( 'wp_head', 'sketchpad_head_insert_head', $insert_head_priority );
add_filter( 'admin_head', 'sketchpad_head_insert_head', $insert_head_priority );
add_filter( 'embed_head', 'sketchpad_head_insert_head', $insert_head_priority );

/**
 * Insert Body tag.
 *
 * @subpackage insert-body-tag
 * @since      2.1.0
 */
function sketchpad_body_insert_body() {
	$insert_body_directly_under = get_theme_mod( 'sketchpad_body_insert_directly_under_body', '' );

	if ( '' !== $insert_body_directly_under ) {
		$value = <<<EOM
{$insert_body_directly_under}

EOM;
		hazardous_echo( $value );
	}
}

$insert_body_directly_under_priority = get_theme_mod( 'sketchpad_body_insert_directly_under_body_priority', 10 );

add_filter( 'wp_body_open', 'sketchpad_body_insert_body', $insert_body_directly_under_priority );

/**
 * Add to embed css.
 *
 * @subpackage blog-card
 * @since      2.1.0
 */
function sketchpad_embed_styles() {
	wp_enqueue_style(
		'wp-oembed-embed',
		get_template_directory_uri() . '/sketchpad-embed-template.css',
		array(),
		(string) filemtime( get_template_directory() . '/sketchpad-embed-template.css' ),
		'all'
	);
}

/**
 * Customize to blog card image size.
 *
 * @subpackage blog-card
 * @since      2.1.0
 * @param      string $image_size   Thumbnail image size.
 * @param      int    $thumbnail_id Attachment ID.
 * @return     string Thumbnail image size after filtering.
 * @see        https://developer.wordpress.org/reference/hooks/embed_thumbnail_image_size/
 */
function sketchpad_blog_card_image_size( $image_size, $thumbnail_id ) {
	return get_theme_mod( 'sketchpad_blog_card_image_size_setting_enable', false ) === true ? get_theme_mod( 'sketchpad_blog_card_image_size', 'thumbnail' ) : $image_size;
}

/**
 * Customize to blog card image form.
 *
 * @subpackage blog-card
 * @since      2.1.0
 * @param      string $shape        image shape. Either 'rectangular' or 'square'.
 * @param      int    $thumbnail_id Attachment ID.
 * @return     string image shape after filtering.
 * @see        https://developer.wordpress.org/reference/hooks/embed_thumbnail_image_shape/
 */
function sketchpad_blog_card_image_form( $shape, $thumbnail_id ) {
	return get_theme_mod( 'sketchpad_blog_card_image_form_type_setting_enable', false ) === true ? get_theme_mod( 'sketchpad_blog_card_image_form', 'rectangular' ) : $shape;
}

/**
 * Customize to blog card image content.
 *
 * @subpackage blog-card
 * @since      2.1.0
 * @return     string content string after filtering.
 * @see        https://developer.wordpress.org/reference/functions/the_excerpt_embed/
 */
function sketchpad_blog_card_content() {
	global $post;
	return sketchpad_content2more_read( $post->post_content, esc_url( get_permalink( $post ) ) );
}

add_action( 'embed_head', 'sketchpad_embed_styles' );
add_filter( 'embed_thumbnail_image_size', 'sketchpad_blog_card_image_size', 10, 2 );
add_filter( 'embed_thumbnail_image_shape', 'sketchpad_blog_card_image_form', 10, 2 );
add_filter( 'the_excerpt_embed', 'sketchpad_blog_card_content' );

/**
 * Output return to top button method wrapper.
 *
 * @subpackage return2top-button
 * @since      2.1.0
 */
function sketchpad_return2top_button() {
	if ( get_theme_mod( 'sketchpad_top_button_enable', false ) ) {
		sketchpad_output_return2top_button();
	}
}

/**
 * Output return to top button html.
 *
 * @subpackage return2top-button
 * @since      2.1.0
 */
function sketchpad_output_return2top_button() {
	$background_color = get_theme_mod( 'sketchpad_top_button_background_color', Sm_Basic_Constant::RETURN2TOP_BUTTON_BACKGROUND_COLOR );
	$hover            = 'onMouseOut="this.style.background=' . "'" . $background_color . "';" . '" onClick="this.style.background=' . "'" . $background_color . "';" . '" onMouseOver="this.style.background=' . "'" . get_theme_mod( 'sketchpad_top_button_hover_background_color', Sm_Basic_Constant::RETURN2TOP_BUTTON_HOVER_BACKGROUND_COLOR ) . "'" . ';"';
	$border           = get_theme_mod( 'sketchpad_top_button_border_color', Sm_Basic_Constant::RETURN2TOP_BUTTON_BORDER_COLOR );
	$mark             = get_theme_mod( 'sketchpad_top_button_mark', sketchpad_sanitize_button_template( Sm_Basic_Constant::RETURN2TOP_BUTTON_MARK ) );

	$value = <<<EOM
<button class="top_button" style="background-color:{$background_color}; border: 1px solid {$border};" {$hover}>{$mark}</button>

EOM;

	hazardous_echo( $value );
}

add_filter( 'wp_footer', 'sketchpad_return2top_button' );

/**
 * Output hamburger menu button method wrapper.
 *
 * @subpackage hamburger-menu-button
 * @since      2.1.0
 */
function sketchpad_hamburger_menu_button() {
	if ( get_theme_mod( 'sketchpad_hamburger_menu_button_enable', false ) ) {
		sketchpad_output_hamburger_menu_button();
	}
}

/**
 * Output hamburger menu button html.
 *
 * @subpackage hamburger-menu-button
 * @since      2.1.0
 */
function sketchpad_output_hamburger_menu_button() {
	$background_color = get_theme_mod( 'sketchpad_hamburger_menu_button_background_color', Sm_Basic_Constant::HAMBURGER_MENU_BUTTON_BACKGROUND_COLOR );
	$hover            = 'onMouseOut="this.style.background=' . "'" . $background_color . "';" . '" onClick="this.style.background=' . "'" . $background_color . "';" . '" onMouseOver="this.style.background=' . "'" . get_theme_mod( 'sketchpad_hamburger_menu_button_hover_background_color', Sm_Basic_Constant::HAMBURGER_MENU_BUTTON_HOVER_BACKGROUND_COLOR ) . "'" . ';"';
	$border           = get_theme_mod( 'sketchpad_hamburger_menu_button_border_color', Sm_Basic_Constant::HAMBURGER_MENU_BUTTON_BORDER_COLOR );
	$open_mark        = get_theme_mod( 'sketchpad_hamburger_menu_button_open_mark', sketchpad_sanitize_button_template( Sm_Basic_Constant::HAMBURGER_MENU_BUTTON_OPEN_MARK ) );
	$close_mark       = get_theme_mod( 'sketchpad_hamburger_menu_button_close_mark', sketchpad_sanitize_button_template( Sm_Basic_Constant::HAMBURGER_MENU_BUTTON_CLOSE_MARK ) );

	$value = <<<EOM
<button class="hamburger_menu open" style="background-color:{$background_color}; border: 1px solid {$border};" {$hover}>{$open_mark}</button>
<button class="hamburger_menu close" style="background-color:{$background_color}; border: 1px solid {$border};" {$hover}>{$close_mark}</button>

EOM;

	hazardous_echo( $value );
}

add_filter( 'wp_footer', 'sketchpad_hamburger_menu_button' );
