<?php
/**
 * Theme API: Other Setting Theme Customizer Initialize class.
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
 * Class for Other Setting theme customizer initialize.
 *
 * @since 2.1.0
 */
class SM_Other_Setting_Initializer extends SM_Abstract_Theme_Customizer_Initializer {
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
			'sketchpad_other_setting_section' => array(
				'title'       => __( 'Other Setting Setting', 'sketchpad-modified' ),
				'description' => __( 'Configure settings for Other setting of the page.', 'sketchpad-modified' ),
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
			'sketchpad_other_setting_wlwmanifest_disable' => array( 'default' => false, 'sanitize_callback' => 'sketchpad_sanitize_checkbox' ),
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
			'sketchpad_other_setting_wlwmanifest_disable' => array( 'setting' => 'sketchpad_other_setting_wlwmanifest_disable', 'section' => 'sketchpad_other_setting_section', 'label' => __( 'Remove the wlwmanifest.xml link', 'sketchpad-modified' ), 'type' => 'checkbox', 'priority' => 0 ),
		);
		// @codingStandardsIgnoreEnd
	}

}
