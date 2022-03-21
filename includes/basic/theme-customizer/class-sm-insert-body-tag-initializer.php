<?php
/**
 * Add an element to the head body Theme Customizer Initialize class.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * These modules are needed to load this class.
 */
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-abstract-theme-customizer-initializer.php';
require_once get_template_directory() . '/includes/basic/theme-customizer/sanitizer/non.php';

/**
 * Class for Add an element to the body tag theme customizer initialize.
 *
 * @since 3.0.0
 */
class SM_Insert_Body_Tag_Initializer extends SM_Abstract_Theme_Customizer_Initializer {
	/**
	 * Sets up a new instance.
	 *
	 * @since 3.0.0
	 */
	public function __construct() {
		parent::__construct( 'sketchpad_basic_panel' );
	}

	/**
	 * Return the sections definition.
	 *
	 * @since  3.0.0
	 * @return array
	 */
	protected function get_sections():array {
		return array(
			array(
				'id'          => 'sketchpad_body_section',
				'title'       => __( 'Body Tag Setting', 'sketchpad-modified' ),
				'description' => __( 'Please enter if you want to insert in directly under the body tag', 'sketchpad-modified' ),
			),
		);
	}

	/**
	 * Return the settings definition.
	 *
	 * @since  3.0.0
	 * @return array
	 */
	protected function get_settings():array {
		// @codingStandardsIgnoreStart
		return array(
			array(
				'key'               => 'sketchpad_body_insert_directly_under_body',
				'default'           => '',
				'sanitize_callback' => 'sketchpad_non_sanitize'
			),
			array(
				'key'               => 'sketchpad_body_insert_directly_under_body_priority',
				'default'           => 10,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'absint',
			),
		);
		// @codingStandardsIgnoreEnd
	}

	/**
	 * Return the controls definition.
	 *
	 * @since  3.0.0
	 * @param  WP_Customize_Manager $wp_customize given by the "customize_register" hook.
	 * @return array
	 */
	protected function get_controls( WP_Customize_Manager $wp_customize ):array {
		// @codingStandardsIgnoreStart
		return array(
			'sketchpad_body_insert_directly_under_body' => array(
				'setting' => 'sketchpad_body_insert_directly_under_body',
				'section' => 'sketchpad_body_section',
				'label'   => __( 'Directly Under the Body Tag', 'sketchpad-modified' ),
				'type'    => 'textarea'
			),
			'sketchpad_body_insert_directly_under_body_priority' => array(
				'setting'     => 'sketchpad_body_insert_under_body_priority',
				'section'     => 'sketchpad_body_section',
				'label'       => __( 'Priority', 'sketchpad-modified' ),
				'description' => __( 'The more you slide to the left, the faster it will be output to directly under the Body tag.', 'sketchpad-modified' ),
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 10,
					'step' => 1
				),
			),
		);
		// @codingStandardsIgnoreEnd
	}

	/**
	 * Return the html string.
	 *
	 * @since  3.0.0
	 * @return string
	 */
	public static function get_sketchpad_insert_body_html():string {
		return get_theme_mod( 'sketchpad_body_insert_directly_under_body', '' );
	}

	/**
	 * Return the output priority.
	 *
	 * @since  3.0.0
	 * @return integer
	 */
	public static function get_sketchpad_insert_priority():int {
		return get_theme_mod( 'sketchpad_body_insert_under_body_priority', 10 );
	}
}
