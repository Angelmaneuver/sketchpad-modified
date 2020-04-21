<?php
/**
 * Sketchpad - modified Basic part of Functions and definitions.
 *
 * @subpackage Sketchpad - modified 1.0
 * @since      Sketchpad - modified 1.0
 */

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

add_action( 'customize_register', 'sketchpad_customize2basic_register', 100 );
add_filter( 'wp_head', 'sketchpad_head_insert_head' );

get_template_part( 'functions/option/top-button' );
