<?php
/**
 * Theme API: Insert Body Tag Theme Customizer Initialize class.
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
 * Class for Insert Body Tag theme customizer initialize.
 *
 * @since 2.1.0
 */
class SM_Insert_Body_Tag_Initializer extends SM_Abstract_Theme_Customizer_Initializer {
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
			'sketchpad_body_section' => array(
				'title'       => __( 'Body Tag Setting', 'sketchpad-modified' ),
				'description' => __( 'Please enter if you want to insert in directly under the body tag', 'sketchpad-modified' ),
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
			'sketchpad_body_insert_directly_under_body'          => array( 'default' => '',                               'sanitize_callback' => 'sketchpad_non_sanitize' ),
			'sketchpad_body_insert_directly_under_body_priority' => array( 'default' => 10, 'transport' => 'postMessage', 'sanitize_callback' => 'absint' ),
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
			'sketchpad_body_insert_directly_under_body'          => array( 'setting' => 'sketchpad_body_insert_directly_under_body', 'section' => 'sketchpad_body_section', 'label' => __( 'Directly Under the Body Tag', 'sketchpad-modified' ),                                                                                                                                              'type' => 'textarea' ),
			'sketchpad_body_insert_directly_under_body_priority' => array( 'setting' => 'sketchpad_body_insert_under_body_priority', 'section' => 'sketchpad_body_section', 'label' => __( 'Priority', 'sketchpad-modified' ),                    'description' => __( 'The more you slide to the left, the faster it will be output to directly under the Body tag.', 'sketchpad-modified' ), 'type' => 'range', 'input_attrs' => array( 'min' => 0, 'max' => 10, 'step' => 1 ) ),
		);
		// @codingStandardsIgnoreEnd
	}
}
