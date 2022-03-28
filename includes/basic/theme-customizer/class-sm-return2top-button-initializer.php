<?php
/**
 * Return to Top Button Theme Customizer Initialize class.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * These modules are needed to load this class.
 */
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-abstract-theme-customizer-initializer.php';
require_once get_template_directory() . '/includes/basic/theme-customizer/sanitizer/button.php';
require_once get_template_directory() . '/includes/basic/theme-customizer/sanitizer/checkbox.php';

/**
 * Class for Return to Top Button theme customizer initialize.
 *
 * @since 3.0.0
 */
class SM_Return2Top_Button_Initializer extends SM_Abstract_Theme_Customizer_Initializer {
	const DEFAULT_BUTTON_MARK                   = '<span class="dashicons dashicons-arrow-up-alt2"></span>';
	const DEFAULT_BUTTON_BACKGROUND_COLOR       = '#999999';
	const DEFAULT_BUTTON_HOVER_BACKGROUND_COLOR = '#666666';
	const DEFAULT_BUTTON_BORDER_COLOR           = '#ffffff';

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
				'id'          => 'sketchpad_top_button_section',
				'title'       => __( 'Top Button Setting', 'sketchpad-modified' ),
				'description' => __( 'Configure settings for the button that returns to the top of the page.', 'sketchpad-modified' ),
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
				'key'               => 'sketchpad_top_button_enable',
				'default'           => false,
				'sanitize_callback' => 'sketchpad_sanitize_checkbox',
			),
			array(
				'key'               => 'sketchpad_top_button_mark',
				'default'           => sketchpad_sanitize_button_template( self::DEFAULT_BUTTON_MARK ),
				'sanitize_callback' => 'sketchpad_sanitize_button_template',
			),
			array(
				'key'               => 'sketchpad_top_button_background_color',
				'default'           => self::DEFAULT_BUTTON_BACKGROUND_COLOR,
				'sanitize_callback' => 'sanitize_hex_color',
			),
			array(
				'key'               => 'sketchpad_top_button_hover_background_color',
				'default'           => self::DEFAULT_BUTTON_HOVER_BACKGROUND_COLOR,
				'sanitize_callback' => 'sanitize_hex_color',
			),
			array(
				'key'               => 'sketchpad_top_button_border_color',
				'default'           => self::DEFAULT_BUTTON_BORDER_COLOR,
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
			'sketchpad_top_button_enable'        => array(
				'setting'  => 'sketchpad_top_button_enable',
				'section'  => 'sketchpad_top_button_section',
				'label'    => __( 'Top Button enable', 'sketchpad-modified' ),
				'type'     => 'checkbox',
				'priority' => 0,
			),
			'sketchpad_top_button_mark'          => array(
				'setting' => 'sketchpad_top_button_mark',
				'section' => 'sketchpad_top_button_section',
				'label'   => __( 'Top Button Mark', 'sketchpad-modified' ),
				'type'    => 'text',
			),
			parent::WP_OBJECT_START_WITH . '001' => new WP_Customize_Color_Control(
				$wp_customize,
				'sketchpad_top_button_background_color',
				array(
					'setting' => 'sketchpad_top_button_background_color',
					'section' => 'sketchpad_top_button_section',
					'label'   => __( 'Top Button Background Color', 'sketchpad-modified' ),
				)
			),
			parent::WP_OBJECT_START_WITH . '002' => new WP_Customize_Color_Control(
				$wp_customize,
				'sketchpad_top_button_hover_background_color',
				array(
					'setting' => 'sketchpad_top_button_hover_background_color',
					'section' => 'sketchpad_top_button_section',
					'label'   => __( 'Top Button Hover Background Color', 'sketchpad-modified' ),
				)
			),
			parent::WP_OBJECT_START_WITH . '003' => new WP_Customize_Color_Control(
				$wp_customize,
				'sketchpad_top_button_border_color',
				array(
					'setting' => 'sketchpad_top_button_border_color',
					'section' => 'sketchpad_top_button_section',
					'label'   => __( 'Top Button Border Color', 'sketchpad-modified' ),
				)
			),
		);
	}

	/**
	 * Return whether the return to top button be enable or not.
	 *
	 * @since  3.0.0
	 * @return boolean
	 */
	public static function is_enable_sketchpad_return2top_button():bool {
		return get_theme_mod( 'sketchpad_top_button_enable', false );
	}

	/**
	 * Return the return to top button mark.
	 *
	 * @since  3.0.0
	 * @return string
	 */
	public static function get_sketchpad_return2top_button_mark():string {
		return get_theme_mod( 'sketchpad_top_button_mark', sketchpad_sanitize_button_template( self::DEFAULT_BUTTON_MARK ) );
	}

	/**
	 * Return the return to top button background color.
	 *
	 * @since  3.0.0
	 * @return string
	 */
	public static function get_sketchpad_return2top_button_background_color():string {
		return get_theme_mod( 'sketchpad_top_button_background_color', self::DEFAULT_BUTTON_BACKGROUND_COLOR );
	}

	/**
	 * Return the background color when the mouse is hovering over the return to top button.
	 *
	 * @since  3.0.0
	 * @return string
	 */
	public static function get_sketchpad_return2top_button_hover_background_color():string {
		return get_theme_mod( 'sketchpad_top_button_hover_background_color', self::DEFAULT_BUTTON_HOVER_BACKGROUND_COLOR );
	}

	/**
	 * Return the return to top button border color.
	 *
	 * @since  3.0.0
	 * @return string
	 */
	public static function get_sketchpad_return2top_button_border_color():string {
		return get_theme_mod( 'sketchpad_top_button_border_color', self::DEFAULT_BUTTON_BORDER_COLOR );
	}
}
