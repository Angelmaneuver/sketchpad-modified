<?php
/**
 * Sketchpad - modified Basic option Blog card part of Functions and definitions.
 *
 * @subpackage Sketchpad - modified 1.0
 * @since      Sketchpad - modified 1.0
 */

/**
 * Set up the Sketchpad - modified Blog card settings via customizer.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function sketchpad_customize2blog_card_register( $wp_customize ) {
	$wp_customize->add_section( 'sketchpad_blog_card_section', array(
    'title'							=> __( 'Blog Card Setting', 'sketchpad-modified' ),
    'description'       => __( 'Configure settings for the Blog Card.', 'sketchpad-modified' ),
    'panel'             => 'sketchpad_basic_panel',
  ) );
	$wp_customize->add_setting( 'sketchpad_blog_card_image_size_setting_enable', array(
		'default'						=> false,
		'sanitize_callback'	=> 'sketchpad_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'sketchpad_blog_card_image_size_setting_enable', array(
		'setting'						=> 'sketchpad_blog_card_image_size_setting_enable',
		'section'						=> 'sketchpad_blog_card_section',
		'label'							=> __( 'Blog Card Image Size setting enable', 'sketchpad-modified' ),
		'type'							=> 'checkbox',
  ) );
	$wp_customize->add_setting( 'sketchpad_blog_card_image_size', array(
		'default'						=> 'thumbnail',
		'sanitize_callback'	=> 'sketchpad_sanitize_select',
	) );
	$wp_customize->add_control( 'sketchpad_blog_card_image_size', array(
		'settings'					=> 'sketchpad_blog_card_image_size',
		'section'						=> 'sketchpad_blog_card_section',
		'label'							=> __( 'Image Size', 'sketchpad-modified' ),
		'choices'						=> array(
			'thumbnail'	=> 'thumbnail',
			'medium'		=> 'medium',
			'large'			=> 'large',
			'full'			=> 'full',
		),
		'type'							=> 'select',
	) );
	$wp_customize->add_setting( 'sketchpad_blog_card_image_form_type_setting_enable', array(
		'default'						=> false,
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'sketchpad_blog_card_image_form_type_setting_enable', array(
		'setting'						=> 'sketchpad_blog_card_image_form_type_setting_enable',
		'section'						=> 'sketchpad_blog_card_section',
		'label'							=> __( 'Blog Card Image Form Type setting enable', 'sketchpad-modified' ),
		'type'							=> 'checkbox',
  ) );
	$wp_customize->add_setting( 'sketchpad_blog_card_image_form', array(
		'default'						=> 'rectangular',
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_select',
	) );
	$wp_customize->add_control( 'sketchpad_blog_card_image_form', array(
		'settings'					=> 'sketchpad_blog_card_image_form',
		'section'						=> 'sketchpad_blog_card_section',
		'label'							=> __( 'Form Type', 'sketchpad-modified' ),
		'choices'						=> array(
			'rectangular'	=> 'rectangular',
			'square'      => 'square',
		),
		'type'							=> 'select',
	) );
}

// add to embed css
function sketchpad_embed_styles() {
  wp_enqueue_style( 'wp-oembed-embed', get_template_directory_uri() . '/sketchpad-embed-template.min.css' );
}

// customize to blog card image size
function sketchpad_blog_card_image_size( $image_size, $thumbnail_id ) {
  return get_theme_mod ( 'sketchpad_blog_card_image_size_setting_enable', false ) === true ? get_theme_mod( 'sketchpad_blog_card_image_size', 'thumbnail' ) : $image_size;
}

// customize to blog card image form
function sketchpad_blog_card_image_form( $shape, $thumbnail_id ) {
  return get_theme_mod ( 'sketchpad_blog_card_image_form_type_setting_enable', false ) === true ? get_theme_mod( 'sketchpad_blog_card_image_form', 'rectangular' ) : $shape;
}

// customize to blog card content
function sketchpad_blog_card_content( $content ) {
  global $post;

  return sketchpad_content2more_read( $post->post_content, esc_url( get_permalink( $post ) ) );
}

add_action( 'customize_register', 'sketchpad_customize2blog_card_register', 110 );
add_action( 'embed_head', 'sketchpad_embed_styles' );
add_filter( 'embed_thumbnail_image_size', 'sketchpad_blog_card_image_size', 10, 2 );
add_filter( 'embed_thumbnail_image_shape', 'sketchpad_blog_card_image_form', 10, 2 );
add_filter( 'the_excerpt_embed', 'sketchpad_blog_card_content' );
