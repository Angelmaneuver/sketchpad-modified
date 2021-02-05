<?php
/**
 * Hamburger menu button.
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
function sketchpad_customize4hamburger_menu_button_register( $wp_customize ) {
	$wp_customize->add_section(
		'sketchpad_hamburger_menu_button_section',
		array(
			'title'       => __( 'Hamburger menu Button Setting', 'sketchpad-modified' ),
			'description' => __( 'Configure settings for the button that hamburger menu of the page.', 'sketchpad-modified' ),
			'panel'       => Sm_Basic_Constant::PANEL,
		)
	);
	$wp_customize->add_setting(
		'sketchpad_hamburger_menu_button_enable',
		array(
			'default'           => false,
			'sanitize_callback' => 'sketchpad_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'sketchpad_hamburger_menu_button_enable',
		array(
			'setting' => 'sketchpad_hamburger_menu_button_enable',
			'section' => 'sketchpad_hamburger_menu_button_section',
			'label'   => __( 'Hamburger menu Button enable', 'sketchpad-modified' ),
			'type'    => 'checkbox',
		)
	);
	$wp_customize->add_setting(
		'sketchpad_hamburger_menu_button_open_mark',
		array(
			'default'           => sketchpad_sanitize_button_template( Sm_Basic_Constant::HAMBURGER_MENU_BUTTON_OPEN_MARK ),
			'sanitize_callback' => 'sketchpad_sanitize_button_template',
		)
	);
	$wp_customize->add_control(
		'sketchpad_hamburger_menu_button_open_mark',
		array(
			'setting' => 'sketchpad_hamburger_menu_button_open_mark',
			'section' => 'sketchpad_hamburger_menu_button_section',
			'label'   => __( 'Hamburger menu Button Open Mark', 'sketchpad-modified' ),
			'type'    => 'text',
		)
	);
	$wp_customize->add_setting(
		'sketchpad_hamburger_menu_button_close_mark',
		array(
			'default'           => sketchpad_sanitize_button_template( Sm_Basic_Constant::HAMBURGER_MENU_BUTTON_CLOSE_MARK ),
			'sanitize_callback' => 'sketchpad_sanitize_button_template',
		)
	);
	$wp_customize->add_control(
		'sketchpad_hamburger_menu_button_close_mark',
		array(
			'setting' => 'sketchpad_hamburger_menu_button_close_mark',
			'section' => 'sketchpad_hamburger_menu_button_section',
			'label'   => __( 'Hamburger menu Button Close Mark', 'sketchpad-modified' ),
			'type'    => 'text',
		)
	);
	$wp_customize->add_setting(
		'sketchpad_hamburger_menu_button_background_color',
		array(
			'default'           => Sm_Basic_Constant::HAMBURGER_MENU_BUTTON_BACKGROUND_COLOR,
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sketchpad_hamburger_menu_button_background_color',
			array(
				'setting' => 'sketchpad_hamburger_menu_button_background_color',
				'section' => 'sketchpad_hamburger_menu_button_section',
				'label'   => __( 'Hamburger menu Button Background Color', 'sketchpad-modified' ),
			)
		)
	);
	$wp_customize->add_setting(
		'sketchpad_hamburger_menu_button_hover_background_color',
		array(
			'default'           => Sm_Basic_Constant::HAMBURGER_MENU_BUTTON_HOVER_BACKGROUND_COLOR,
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sketchpad_hamburger_menu_button_hover_background_color',
			array(
				'setting' => 'sketchpad_hamburger_menu_button_hover_background_color',
				'section' => 'sketchpad_hamburger_menu_button_section',
				'label'   => __( 'Hamburger menu Button Hover Background Color', 'sketchpad-modified' ),
			)
		)
	);
	$wp_customize->add_setting(
		'sketchpad_hamburger_menu_button_border_color',
		array(
			'defult'            => Sm_Basic_Constant::HAMBURGER_MENU_BUTTON_BORDER_COLOR,
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sketchpad_hamburger_menu_button_border_color',
			array(
				'setting' => 'sketchpad_hamburger_menu_button_border_color',
				'section' => 'sketchpad_hamburger_menu_button_section',
				'label'   => __( 'Hamburger menu Button Border Color', 'sketchpad-modified' ),
			)
		)
	);
}

add_action( 'customize_register', 'sketchpad_customize4hamburger_menu_button_register', 100 );
