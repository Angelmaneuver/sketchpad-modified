<?php
/**
 * Theme Color Setting Customizer Initialize class.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * These modules are needed to load this class.
 */
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-abstract-theme-customizer-initializer.php';
require_once get_template_directory() . '/includes/basic/theme-customizer/sanitizer/checkbox.php';

/**
 * Class for theme color setting customizer initialize.
 *
 * @since 3.0.0
 */
class SM_Color_Setting_Initializer extends SM_Abstract_Theme_Customizer_Initializer {
	const DEFAULT_SKETCHPAD_BACKGROUND_COLOR_ENABLE = true;
	const DEFAULT_SKETCHPAD_BACKGROUND_COLOR        = '#AF9F88';

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
				'id'          => 'sketchpad_background_color_setting_section',
				'title'       => __( 'Background Color Setting', 'sketchpad-modified' ),
				'description' => __( 'Please enter if you want to background color setting.', 'sketchpad-modified' ),
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
		return array(
			array(
				'key'               => 'sketchpad_background_color_enable',
				'default'           => self::DEFAULT_SKETCHPAD_BACKGROUND_COLOR_ENABLE,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sketchpad_sanitize_checkbox',
			),
			array(
				'key'               => 'sketchpad_background_color',
				'default'           => self::DEFAULT_SKETCHPAD_BACKGROUND_COLOR,
				'sanitize_callback' => 'sanitize_hex_color',
			),
		);
	}

	/**
	 * Return the controls definition.
	 *
	 * @since  3.0.0
	 * @param  WP_Customize_Manager $wp_customize given by the "customize_register" hook.
	 * @return array
	 */
	protected function get_controls( WP_Customize_Manager $wp_customize ):array {
		return array(
			'sketchpad_background_color_enable'  => array(
				'setting'  => 'sketchpad_background_color_enable',
				'section'  => 'sketchpad_background_color_setting_section',
				'label'    => __( 'Background color setting enable', 'sketchpad-modified' ),
				'type'     => 'checkbox',
				'priority' => 0,
			),
			parent::WP_OBJECT_START_WITH . '001' => new WP_Customize_Color_Control(
				$wp_customize,
				'sketchpad_background_color',
				array(
					'setting'  => 'sketchpad_background_color',
					'section'  => 'sketchpad_background_color_setting_section',
					'label'    => __( 'Color', 'sketchpad-modified' ),
					'priority' => 1,
				)
			),
		);
	}

	/**
	 * Return whether the background color be set or not.
	 *
	 * @since  3.0.0
	 * @return boolean
	 */
	public static function is_set_sketchpad_background_color():bool {
		return get_theme_mod( 'sketchpad_background_color_enable', self::DEFAULT_SKETCHPAD_BACKGROUND_COLOR_ENABLE );
	}

	/**
	 * Return the background color.
	 *
	 * @since  3.0.0
	 * @return string
	 */
	public static function get_sketchpad_background_color():string {
		return get_theme_mod( 'sketchpad_background_color', self::DEFAULT_SKETCHPAD_BACKGROUND_COLOR );
	}
}
