<?php
/**
 * Theme API: Insert Head Tag Theme Customizer Initialize class.
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
 * Class for Insert Head Tag theme customizer initialize.
 *
 * @since 2.1.0
 */
class SM_Insert_Head_Tag_Initializer extends SM_Abstract_Theme_Customizer_Initializer {
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
			'sketchpad_head_section' => array(
				'title'       => __( 'Head Tag Setting', 'sketchpad-modified' ),
				'description' => __( 'Please enter if you want to insert in the head tag', 'sketchpad-modified' ),
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
			'sketchpad_head_insert_head'     => array( 'default' => '',                               'sanitize_callback' => 'sketchpad_sanitize_head' ),
			'sketchpad_head_insert_priority' => array( 'default' => 10, 'transport' => 'postMessage', 'sanitize_callback' => 'absint' ),
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
			'sketchpad_head_insert_head'     => array( 'setting' => 'sketchpad_head_insert_head',     'section' => 'sketchpad_head_section',                                                                                                                                                                                  'type' => 'textarea' ),
			'sketchpad_head_insert_priority' => array( 'setting' => 'sketchpad_head_insert_priority', 'section' => 'sketchpad_head_section', 'label' => __( 'Priority', 'sketchpad-modified' ), 'description' => __( 'The more you slide to the left, the faster it will be output to the Head tag.', 'sketchpad-modified' ), 'type' => 'range',      'input_attrs' => array( 'min' => 0, 'max' => 10, 'step' => 1 ) ),
		);
		// @codingStandardsIgnoreEnd
	}

}
