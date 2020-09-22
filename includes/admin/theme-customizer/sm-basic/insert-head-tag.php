<?php
/**
 * Insert head tag.
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
function sketchpad_customize4insert_head_tag_register( $wp_customize ) {
  $wp_customize->add_section( 'sketchpad_head_section', array(
    'title'							=> __( 'Head Tag Setting', 'sketchpad-modified' ),
    'description'       => __( 'Please enter if you want to insert in the head tag', 'sketchpad-modified' ),
    'panel'             => SmBasicConstantClass::PANEL,
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
}

/**
 * Head tag sanitizer.
 * 
 * @param value $input The customize setting value.
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

add_action( 'customize_register', 'sketchpad_customize4insert_head_tag_register', 100 );
