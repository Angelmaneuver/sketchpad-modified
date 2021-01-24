<?php
/**
 * RSS.
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
function sketchpad_customize4rss_register( $wp_customize ) {
	$wp_customize->add_section(
		'sketchpad_rss_section',
		array(
			'title'       => __( 'Sketchpad - modified RSS Feed Setting', 'sketchpad-modified' ),
			'description' => __( 'Set whether to output an eye-catching image to RSS Feed.', 'sketchpad-modified' ),
			'priority'    => 1000,
		)
	);
	$wp_customize->add_setting(
		'sketchpad_rss_output_post_tumbnail',
		array(
			'default'           => false,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sketchpad_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'sketchpad_rss_output_post_tumbnail',
		array(
			'setting' => 'sketchpad_rss_output_post_tumbnail',
			'section' => 'sketchpad_rss_section',
			'label'   => __( 'output eye-catching image', 'sketchpad-modified' ),
			'type'    => 'checkbox',
		)
	);
	$wp_customize->add_setting(
		'sketchpad_rss_output_media_content_tag',
		array(
			'default'           => false,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sketchpad_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'sketchpad_rss_output_media_content_tag',
		array(
			'setting' => 'sketchpad_rss_output_media_content_tag',
			'section' => 'sketchpad_rss_section',
			'label'   => __( 'to incluede the "media:content" tag', 'sketchpad-modified' ),
			'type'    => 'checkbox',
		)
	);
	$wp_customize->add_setting(
		'sketchpad_rss_output_enclosure_tag',
		array(
			'default'           => false,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sketchpad_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'sketchpad_rss_output_enclosure_tag',
		array(
			'setting' => 'sketchpad_rss_output_enclosure_tag',
			'section' => 'sketchpad_rss_section',
			'label'   => __( 'to incluede the "enclosure" tag', 'sketchpad-modified' ),
			'type'    => 'checkbox',
		)
	);
	$wp_customize->add_setting(
		'sketchpad_rss_media_image_size',
		array(
			'defualt'           => 'thumbnail',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sketchpad_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'sketchpad_rss_media_image_size',
		array(
			'settings' => 'sketchpad_rss_media_image_size',
			'section'  => 'sketchpad_rss_section',
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
}

add_action( 'customize_register', 'sketchpad_customize4rss_register', 100 );
