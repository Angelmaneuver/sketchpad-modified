<?php
/**
 * Blog card.
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
function sketchpad_customize4blog_card_register( $wp_customize ) {
	$wp_customize->add_section(
		'sketchpad_blog_card_section',
		array(
			'title'       => __( 'Blog Card Setting', 'sketchpad-modified' ),
			'description' => __( 'Configure settings for the Blog Card.', 'sketchpad-modified' ),
			'panel'       => Sm_Basic_Constant::PANEL,
		)
	);
	$wp_customize->add_setting(
		'sketchpad_blog_card_image_size_setting_enable',
		array(
			'default'           => false,
			'sanitize_callback' => 'sketchpad_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'sketchpad_blog_card_image_size_setting_enable',
		array(
			'setting' => 'sketchpad_blog_card_image_size_setting_enable',
			'section' => 'sketchpad_blog_card_section',
			'label'   => __( 'Blog Card Image Size setting enable', 'sketchpad-modified' ),
			'type'    => 'checkbox',
		)
	);
	$wp_customize->add_setting(
		'sketchpad_blog_card_image_size',
		array(
			'default'           => 'thumbnail',
			'sanitize_callback' => 'sketchpad_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'sketchpad_blog_card_image_size',
		array(
			'settings' => 'sketchpad_blog_card_image_size',
			'section'  => 'sketchpad_blog_card_section',
			'label'    => __( 'Image Size', 'sketchpad-modified' ),
			'choices'  => array(
				'thumbnail' => 'thumbnail',
				'medium'    => 'medium',
				'large'     => 'large',
				'full'      => 'full',
			),
			'type'     => 'select',
		)
	);
	$wp_customize->add_setting(
		'sketchpad_blog_card_image_form_type_setting_enable',
		array(
			'default'           => false,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sketchpad_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'sketchpad_blog_card_image_form_type_setting_enable',
		array(
			'setting' => 'sketchpad_blog_card_image_form_type_setting_enable',
			'section' => 'sketchpad_blog_card_section',
			'label'   => __( 'Blog Card Image Form Type setting enable', 'sketchpad-modified' ),
			'type'    => 'checkbox',
		)
	);
	$wp_customize->add_setting(
		'sketchpad_blog_card_image_form',
		array(
			'default'           => 'rectangular',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sketchpad_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'sketchpad_blog_card_image_form',
		array(
			'settings' => 'sketchpad_blog_card_image_form',
			'section'  => 'sketchpad_blog_card_section',
			'label'    => __( 'Form Type', 'sketchpad-modified' ),
			'choices'  => array(
				'rectangular' => 'rectangular',
				'square'      => 'square',
			),
			'type'     => 'select',
		)
	);
}

add_action( 'customize_register', 'sketchpad_customize4blog_card_register', 100 );
