<?php
/**
 * Insert body tag.
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
function sketchpad_customize4insert_body_tag_register( $wp_customize ) {
	$wp_customize->add_section(
		'sketchpad_body_section',
		array(
			'title'       => __( 'Body Tag Setting', 'sketchpad-modified' ),
			'description' => __( 'Please enter if you want to insert in directly under the body tag', 'sketchpad-modified' ),
			'panel'       => Sm_Basic_Constant::PANEL,
		)
	);
	$wp_customize->add_setting(
		'sketchpad_body_insert_directly_under_body',
		array(
			'default'           => '',
			'sanitize_callback' => 'sketchpad_sanitize_body',
		)
	);
	$wp_customize->add_control(
		'sketchpad_body_insert_directly_under_body',
		array(
			'setting' => 'sketchpad_body_insert_directly_under_body',
			'section' => 'sketchpad_body_section',
			'label'   => __( 'Directly Under the Body Tag', 'sketchpad-modified' ),
			'type'    => 'textarea',
		)
	);
	$wp_customize->add_setting(
		'sketchpad_body_insert_directly_under_body_priority',
		array(
			'default'           => 10,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'sketchpad_body_insert_directly_under_body_priority',
		array(
			'setting'     => 'sketchpad_body_insert_under_body_priority',
			'section'     => 'sketchpad_body_section',
			'label'       => __( 'Priority', 'sketchpad-modified' ),
			'description' => __( 'The more you slide to the left, the faster it will be output to directly under the Body tag.', 'sketchpad-modified' ),
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 10,
				'step' => 1,
			),
		)
	);
}

/**
 * Body tag sanitizer.
 *
 * @param value $value The customize setting value.
 * @see https://developer.wordpress.org/reference/classes/wp_customize_setting/__construct/
 */
function sketchpad_sanitize_body( $value ) {
	return $value;
}

add_action( 'customize_register', 'sketchpad_customize4insert_body_tag_register', 100 );
