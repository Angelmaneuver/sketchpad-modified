<?php
/**
 * Sketchpad - modified Basic part of Functions and definitions.
 *
 * @subpackage Sketchpad - modified 1.0
 * @since      Sketchpad - modified 1.0
 */

/**
 * Constant Class for this functions.
 */
class BasicDefualtClass {
  const ADMIN_BACKGROUND_COLOR = '#000000';
  const ADMIN_BACKGROUND_OPACITY_TARGETS = '.postbox, #activity-widget, #the-comment-list, .comment-item, .community-events ul,'
                                            . '.edit-post-header,'
                                            . '.components-notice,'
                                            . '.interface-interface-skeleton__content, .edit-post-visual-editor, .editor-styles-wrapper,'
                                            . '.interface-interface-skeleton__sidebar, .components-panel__header, .interface-complementary-area-header, .interface-complementary-area, .edit-post-sidebar, .edit-post-sidebar__panel-tabs, .components-panel,'
                                            . '.edit-post-layout__footer';
}

/**
 * Set up the Sketchpad - modified Basic settings via customizer.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function sketchpad_customize2basic_register( $wp_customize ) {
  // panel
  $wp_customize->add_panel( 'sketchpad_basic_panel', array(
    'title'							=> __( 'Sketchpad - modified Basic Setting', 'sketchpad-modified' ),
    'priority'					=> 1000,
  ) );
  // head section
  $wp_customize->add_section( 'sketchpad_head_section', array(
    'title'							=> __( 'Head Tag Setting', 'sketchpad-modified' ),
    'description'       => __( 'Please enter if you want to insert in the head tag', 'sketchpad-modified' ),
    'panel'             => 'sketchpad_basic_panel',
  ) );
  $wp_customize->add_setting( 'sketchpad_head_insert_head', array(
    'default'						=> '',
    'sanitize_callback'	=> 'sketchpad_sanitize_head',
  ) );
  $wp_customize->add_control( 'sketchpad_head_insert_head', array(
    'setting'						=> 'sketchpad_head_insert_head',
    'section'						=> 'sketchpad_head_section',
    'type'							=> 'textarea',
  ) );
  // admin page setting section
  $wp_customize->add_section( 'sketchpad_admin_page_setting_section', array(
    'title'							=> __( 'Admin Page Setting', 'sketchpad-modified' ),
    'description'       => __( 'Please enter if you want to background image for the admin panel.', 'sketchpad-modified' ),
    'panel'             => 'sketchpad_basic_panel',
  ) );
  $wp_customize->add_setting( 'sketchpad_admin_page_background_image', array(
		'default'						=> false,
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'sketchpad_admin_page_background_image', array(
		'setting'						=> 'sketchpad_admin_page_background_image',
		'section'						=> 'sketchpad_admin_page_setting_section',
		'label'							=> __( 'Activate the background image setting in the admin panel.', 'sketchpad-modified' ),
		'type'							=> 'checkbox',
	) );
  $wp_customize->add_setting( 'sketchpad_admin_page_background_image_url', array(
    'default'						=> NULL,
		'transport'					=> 'postMessage',
    'sanitize_callback'	=> 'esc_url_raw',
  ) );
  $wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'sketchpad_admin_page_background_image_url', array(
    'setting'						=> 'sketchpad_admin_page_background_image_url',
    'section'						=> 'sketchpad_admin_page_setting_section',
    'label'             => __( 'Background' ) . __( 'Image' ) ,
  ) ) );
  $wp_customize->add_setting( 'sketchpad_admin_page_background_image_color', array(
		'defult'					  => BasicDefualtClass::ADMIN_BACKGROUND_COLOR,
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sketchpad_admin_page_background_image_color', array(
		'setting'	          => 'sketchpad_admin_page_background_image_color',
		'section'					  => 'sketchpad_admin_page_setting_section',
    'label'						  => __( 'Color' ),
  ) ) );
  $wp_customize->add_setting( 'sketchpad_admin_page_background_image_opacity', array(
    'default'						=> 0.01,
		'transport'					=> 'postMessage',
    'sanitize_callback'	=> 'esc_html',
  ) );
	$wp_customize->add_control( 'sketchpad_admin_page_background_image_opacity', array(
		'setting'						=> 'sketchpad_admin_page_background_image_opacity',
		'section'						=> 'sketchpad_admin_page_setting_section',
    'label'							=> __( 'Opacity', 'sketchpad-modified' ),
    'description'       => __( 'The more you slide to the left, the higher the transparency.', 'sketchpad-modified' ),
    'type'							=> 'range',
    'input_attrs'       => array(
      'min'  => 0.01,
      'max'  => 1,
      'step' => 0.01,
    ),
	) );
  $wp_customize->add_setting( 'sketchpad_admin_background_image_opacity_targets', array(
		'default'						=> BasicDefualtClass::ADMIN_BACKGROUND_OPACITY_TARGETS,
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sketchpad_admin_background_image_opacity_targets', array(
		'setting'						=> 'sketchpad_admin_background_image_opacity_targets',
		'section'						=> 'sketchpad_admin_page_setting_section',
    'label'							=> __( 'Transparent DOM', 'sketchpad-modified' ),
    'description'       => __( 'Enter the DOM element you want to make transparent.', 'sketchpad-modified' ),
		'type'							=> 'textarea',
	) );
}

/**
 * insert head sanitizer.
 * 
 * @param value                 $input   The Customize Setting value.
 */
function sketchpad_sanitize_head( $input ) {
  $allow = array(
    'link'    => array(
                  'rel'         => array(),
                  'type'        => array(),
                  'href'        => array(),
                  'media'       => array(),
                 ),
    'script'  => array(
                  'type'        => array(),
                  'src'         => array(),
                  'crossorigin' => array(),
                 ),
  );
  return wp_kses( $input, $allow );
}

/* insert head tag */
function sketchpad_head_insert_head() {
  $insert_head = get_theme_mod( 'sketchpad_head_insert_head', '' );

  if( $insert_head != '' ) {
    echo <<<EOM
    {$insert_head}
    
EOM;
  }
}

/* insert admin style */
function sketchpad_admin_style() {
  $image_url = get_theme_mod ( 'sketchpad_admin_page_background_image_url', NULL );
  $opacity = get_theme_mod ( 'sketchpad_admin_page_background_image_opacity', 0.01 );
  $rgba = implode ( ',', sketchpad_color_code2rgba( get_theme_mod ( 'sketchpad_admin_page_background_image_color', BasicDefualtClass::ADMIN_BACKGROUND_COLOR ) ) );
  $targets = get_theme_mod ( 'sketchpad_admin_background_image_opacity_targets', BasicDefualtClass::ADMIN_BACKGROUND_OPACITY_TARGETS );

  if ( get_theme_mod ( 'sketchpad_admin_page_background_image', false ) && !empty ( $image_url ) ) {
    echo <<<EOM
    <style>
      #wpwrap:before {
        content:" ";
        position: fixed;
        top: 0;
        left: 0;
        width:100%;
        height:100%;
        background-image:
        linear-gradient(rgba({$rgba}, {$opacity}), rgba({$rgba}, {$opacity})),
          url("{$image_url}");
          background-repeat: no-repeat;
          background-size: cover;
        }
        {$targets} {
          background-color: rgba(255, 255, 255, 0.1) !important;
        }
    </style>
EOM;
  }
}

add_action( 'customize_register', 'sketchpad_customize2basic_register', 100 );
add_filter( 'wp_head', 'sketchpad_head_insert_head' );
add_filter( 'admin_head', 'sketchpad_head_insert_head' );
add_filter( 'embed_head', 'sketchpad_head_insert_head' );

add_action('admin_print_styles', 'sketchpad_admin_style');

get_template_part( 'functions/option/custom-block-style' );
get_template_part( 'functions/option/top-button' );
get_template_part( 'functions/option/blog-card' );
