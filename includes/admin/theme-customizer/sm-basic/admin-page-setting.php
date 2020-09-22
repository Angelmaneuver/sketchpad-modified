<?php
/**
 * Admin page setting.
 *
 * @package sketchpad - modified
 * @subpackage sm-basic
 * @since 1.0.0
 */

/**
 * Set up the section.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function sketchpad_customize4admin_page_setting_register( $wp_customize ) {
  $wp_customize->add_section( 'sketchpad_admin_page_setting_section', array(
    'title'							=> __( 'Admin Page Setting', 'sketchpad-modified' ),
    'description'       => __( 'Please enter if you want to background image for the admin panel.', 'sketchpad-modified' ),
    'panel'             => SmBasicConstantClass::PANEL,
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
		'defult'					  => SmBasicConstantClass::ADMIN_BACKGROUND_COLOR,
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
		'default'						=> SmBasicConstantClass::ADMIN_BACKGROUND_OPACITY_TARGETS,
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
 * Insert a admin style.
 *
 */
function sketchpad_admin_style() {
  $image_url = get_theme_mod ( 'sketchpad_admin_page_background_image_url', NULL );
  $opacity = get_theme_mod ( 'sketchpad_admin_page_background_image_opacity', 0.01 );
  $rgba = implode ( ',', sketchpad_color_code2rgba( get_theme_mod ( 'sketchpad_admin_page_background_image_color', SmBasicConstantClass::ADMIN_BACKGROUND_COLOR ) ) );
  $targets = get_theme_mod ( 'sketchpad_admin_background_image_opacity_targets', SmBasicConstantClass::ADMIN_BACKGROUND_OPACITY_TARGETS );

  if ( get_theme_mod ( 'sketchpad_admin_page_background_image', false ) && !empty ( $image_url ) ) {
    echo <<<EOM
<style type="text/css">
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

add_action( 'customize_register', 'sketchpad_customize4admin_page_setting_register', 100 );
add_action( 'admin_print_styles', 'sketchpad_admin_style' );
