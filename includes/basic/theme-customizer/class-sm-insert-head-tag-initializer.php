<?php
/**
 * Add an element to the head tag Theme Customizer Initialize class.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * These modules are needed to load this class.
 */
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-abstract-theme-customizer-initializer.php';
require_once get_template_directory() . '/includes/basic/theme-customizer/sanitizer/head.php';

/**
 * Class for Add an element to the head tag theme customizer initialize.
 *
 * @since 3.0.0
 */
class SM_Insert_Head_Tag_Initializer extends SM_Abstract_Theme_Customizer_Initializer {
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
				'id'          => 'sketchpad_head_section',
				'title'       => __( 'Head Tag Setting', 'sketchpad-modified' ),
				'description' => __( 'Please enter if you want to insert in the head tag', 'sketchpad-modified' ),
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
				'key'               => 'sketchpad_head_insert_head',
				'default'           => '',
				'sanitize_callback' => 'sketchpad_sanitize_head'
			),
			array(
				'key'               => 'sketchpad_head_insert_priority',
				'default'           => 10,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'absint'
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
			'sketchpad_head_insert_head' => array(
				'setting' => 'sketchpad_head_insert_head',
				'section' => 'sketchpad_head_section',
				'type'    => 'textarea'
			),
			'sketchpad_head_insert_priority' => array(
				'setting'     => 'sketchpad_head_insert_priority',
				'section'     => 'sketchpad_head_section',
				'label'       => __( 'Priority', 'sketchpad-modified' ),
				'description' => __( 'The more you slide to the left, the faster it will be output to the Head tag.', 'sketchpad-modified' ),
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
	public static function get_sketchpad_insert_head_html():string {
		return get_theme_mod( 'sketchpad_head_insert_head', '' );
	}

	/**
	 * Return the output priority.
	 *
	 * @since  3.0.0
	 * @return integer
	 */
	public static function get_sketchpad_insert_priority():int {
		return get_theme_mod( 'sketchpad_head_insert_priority', 10 );
	}
}
