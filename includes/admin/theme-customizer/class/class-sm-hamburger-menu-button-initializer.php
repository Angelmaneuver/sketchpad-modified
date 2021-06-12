<?php
/**
 * Theme API: Hamburger Menu Button Theme Customizer Initialize class.
 *
 * @package    sketchpad
 * @subpackage theme customizer
 * @since      2.1.0
 */

/**
 * These modules are needed to load this class.
 */
require_once get_template_directory() . '/includes/admin/theme-customizer/class/class-sm-abstract-theme-customizer-initializer.php';

/**
 * Class for Hamburger Menu Button theme customizer initialize.
 *
 * @since 2.1.0
 */
class SM_Hamburger_Menu_Button_Initializer extends SM_Abstract_Theme_Customizer_Initializer {
	/**
	 * Return the panels definition.
	 *
	 * @return array array( string $id, array $args )
	 */
	protected function get_panels() {
		return array();
	}

	/**
	 * Return the sections definition.
	 *
	 * @return array array( string $id, array $args )
	 */
	protected function get_sections() {
		return array(
			'sketchpad_hamburger_menu_button_section' => array(
				'title'       => __( 'Hamburger menu Button Setting', 'sketchpad-modified' ),
				'description' => __( 'Configure settings for the button that hamburger menu of the page.', 'sketchpad-modified' ),
				'panel'       => Sm_Basic_Constant::PANEL,
			),
		);
	}

	/**
	 * Return the settings definition.
	 *
	 * @return array array( string $id, array $args )
	 */
	protected function get_settings() {
		// @codingStandardsIgnoreStart
		return array(
			'sketchpad_hamburger_menu_button_enable'                 => array( 'default' => false,                                                                                     'sanitize_callback' => 'sketchpad_sanitize_checkbox' ),
			'sketchpad_hamburger_menu_button_open_mark'              => array( 'default' => sketchpad_sanitize_button_template( Sm_Basic_Constant::HAMBURGER_MENU_BUTTON_OPEN_MARK ),  'sanitize_callback' => 'sketchpad_sanitize_button_template' ),
			'sketchpad_hamburger_menu_button_close_mark'             => array( 'default' => sketchpad_sanitize_button_template( Sm_Basic_Constant::HAMBURGER_MENU_BUTTON_CLOSE_MARK ), 'sanitize_callback' => 'sketchpad_sanitize_button_template' ),
			'sketchpad_hamburger_menu_button_background_color'       => array( 'default' => Sm_Basic_Constant::HAMBURGER_MENU_BUTTON_BACKGROUND_COLOR,                                 'sanitize_callback' => 'sanitize_hex_color' ),
			'sketchpad_hamburger_menu_button_hover_background_color' => array( 'default' => Sm_Basic_Constant::HAMBURGER_MENU_BUTTON_HOVER_BACKGROUND_COLOR,                           'sanitize_callback' => 'sanitize_hex_color' ),
			'sketchpad_hamburger_menu_button_border_color'           => array( 'default' => Sm_Basic_Constant::HAMBURGER_MENU_BUTTON_BORDER_COLOR,                                     'sanitize_callback' => 'sanitize_hex_color' ),
		);
		// @codingStandardsIgnoreEnd
	}

	/**
	 * Return the controls definition.
	 *
	 * @param  WP_Customize_Manager $wp_customize given by the "customize_register" hook.
	 * @return array array( string $id, array $args )
	 */
	protected function get_controls( WP_Customize_Manager $wp_customize ) {
		// @codingStandardsIgnoreStart
		return array(
			'sketchpad_hamburger_menu_button_enable'     => array( 'setting' => 'sketchpad_hamburger_menu_button_enable',     'section' => 'sketchpad_hamburger_menu_button_section', 'label' => __( 'Hamburger menu Button enable', 'sketchpad-modified' ),     'type' => 'checkbox' ),
			'sketchpad_hamburger_menu_button_open_mark'  => array( 'setting' => 'sketchpad_hamburger_menu_button_open_mark',  'section' => 'sketchpad_hamburger_menu_button_section', 'label' => __( 'Hamburger menu Button Open Mark', 'sketchpad-modified' ),  'type' => 'text' ),
			'sketchpad_hamburger_menu_button_close_mark' => array( 'setting' => 'sketchpad_hamburger_menu_button_close_mark', 'section' => 'sketchpad_hamburger_menu_button_section', 'label' => __( 'Hamburger menu Button Close Mark', 'sketchpad-modified' ), 'type'    => 'text' ),
			parent::WP_OBJECT_START_WITH . '001'         => new WP_Customize_Color_Control(
				$wp_customize,
				'sketchpad_hamburger_menu_button_background_color',
				array(
					'setting' => 'sketchpad_hamburger_menu_button_background_color',
					'section' => 'sketchpad_hamburger_menu_button_section',
					'label'   => __( 'Hamburger menu Button Background Color', 'sketchpad-modified' ),
				)
			),
			parent::WP_OBJECT_START_WITH . '002'         => new WP_Customize_Color_Control(
				$wp_customize,
				'sketchpad_hamburger_menu_button_hover_background_color',
				array(
					'setting' => 'sketchpad_hamburger_menu_button_hover_background_color',
					'section' => 'sketchpad_hamburger_menu_button_section',
					'label'   => __( 'Hamburger menu Button Hover Background Color', 'sketchpad-modified' ),
				)
			),
			parent::WP_OBJECT_START_WITH . '003'         => new WP_Customize_Color_Control(
				$wp_customize,
				'sketchpad_hamburger_menu_button_border_color',
				array(
					'setting' => 'sketchpad_hamburger_menu_button_border_color',
					'section' => 'sketchpad_hamburger_menu_button_section',
					'label'   => __( 'Hamburger menu Button Border Color', 'sketchpad-modified' ),
				)
			),
		);
		// @codingStandardsIgnoreEnd
	}

}
