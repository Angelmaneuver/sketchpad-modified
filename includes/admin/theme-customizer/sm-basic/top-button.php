<?php
/**
 * Top button.
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
function sketchpad_customize4top_button_register( $wp_customize ) {
	$wp_customize->add_section( 'sketchpad_top_button_section', array(
    'title'							=> __( 'Top Button Setting', 'sketchpad-modified' ),
    'description'       => __( 'Configure settings for the button that returns to the top of the page.', 'sketchpad-modified' ),
    'panel'             => SmBasicConstantClass::PANEL,
	) );
	$wp_customize->add_setting( 'sketchpad_top_button_enable', array(
		'default'						=> false,
		'sanitize_callback'	=> 'sketchpad_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'sketchpad_top_button_enable', array(
		'setting'						=> 'sketchpad_top_button_enable',
		'section'						=> 'sketchpad_top_button_section',
		'label'							=> __( 'Top Button enable', 'sketchpad-modified' ),
		'type'							=> 'checkbox',
  ) );
  $wp_customize->add_setting( 'sketchpad_top_button_mark', array(
		'default'						=> sketchpad_sanitize_top_button_template( SmBasicConstantClass::TOP_BUTTON_MARK ),
		'sanitize_callback'	=> 'sketchpad_sanitize_top_button_template',
	) );
	$wp_customize->add_control( 'sketchpad_top_button_mark', array(
		'setting'						=> 'sketchpad_top_button_mark',
		'section'						=> 'sketchpad_top_button_section',
    'label'							=> __( 'Top Button Mark', 'sketchpad-modified' ),
		'type'							=> 'text',
	) );
  $wp_customize->add_setting( 'sketchpad_top_button_background_color', array(
		'default'						=> SmBasicConstantClass::TOP_BUTTON_BACKGROUND_COLOR,
		'sanitize_callback'	=> 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sketchpad_top_button_background_color', array(
		'setting'						=> 'sketchpad_top_button_background_color',
		'section'						=> 'sketchpad_top_button_section',
    'label'							=> __( 'Top Button Background Color', 'sketchpad-modified' ),
	) ) );
  $wp_customize->add_setting( 'sketchpad_top_button_hover_background_color', array(
		'default'						=> SmBasicConstantClass::TOP_BUTTON_HOVER_BACKGROUND_COLOR,
		'sanitize_callback'	=> 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sketchpad_top_button_hover_background_color', array(
    'setting'						=> 'sketchpad_top_button_hover_background_color',
    'section'						=> 'sketchpad_top_button_section',
    'label'     				=> __( 'Top Button Hover Background Color', 'sketchpad-modified' ),
  ) ) );
  $wp_customize->add_setting( 'sketchpad_top_button_border_color', array(
		'defult'					  => SmBasicConstantClass::TOP_BUTTON_BORDER_COLOR,
		'sanitize_callback'	=> 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sketchpad_top_button_border_color', array(
		'setting'					=> 'sketchpad_top_button_border_color',
		'section'					=> 'sketchpad_top_button_section',
    'label'						=> __( 'Top Button Border Color', 'sketchpad-modified' ),
  ) ) );
}

add_action( 'customize_register', 'sketchpad_customize4top_button_register', 100 );
