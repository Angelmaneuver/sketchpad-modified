<?php
/**
 * Admin Page Setting Theme Customizer Initialize class.
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
 * Class for Admin Page Setting theme customizer initialize.
 *
 * @since 3.0.0
 */
class SM_Admin_Page_Setting_Initializer extends SM_Abstract_Theme_Customizer_Initializer {
	const DEFAULT_ADMIN_BACKGROUND_COLOR   = '#FFFFFF';
	const DEFAULT_ADMIN_BACKGROUND_OPACITY = 0.5;
	const DEFAULT_OPACITY_TARGETS          = <<<EOM
body,
.postbox, #activity-widget, #the-comment-list, .comment-item, .community-events ul,
.edit-post-header,
.components-notice,
.interface-interface-skeleton__content, .edit-post-visual-editor, .editor-styles-wrapper, .edit-post-visual-editor__content-area > div,
.edit-post-layout__footer
EOM;

	/**
	 * Sets up a new instance.
	 *
	 * @since 3.0.0
	 */
	public function __construct() {
		parent::__construct( '' );
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
				'id'          => 'sketchpad_admin_page_setting_section',
				'title'       => __( 'Admin Page Setting', 'sketchpad-modified' ),
				'description' => __( 'Please enter if you want to background image for the admin panel.', 'sketchpad-modified' ),
				'priority'    => 1000,
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
				'key'               => 'sketchpad_admin_page_background_image',
				'default'           => false,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sketchpad_sanitize_checkbox',
			),
			array(
				'key'               => 'sketchpad_admin_page_background_image_url',
				'default'           => null,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
			),
			array(
				'key'               => 'sketchpad_admin_page_background_image_color',
				'defult'            => self::DEFAULT_ADMIN_BACKGROUND_COLOR,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			),
			array(
				'key'               => 'sketchpad_admin_page_background_image_opacity',
				'default'           => self::DEFAULT_ADMIN_BACKGROUND_OPACITY,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_html',
			),
			array(
				'key'               => 'sketchpad_admin_background_image_opacity_targets',
				'default'           => self::DEFAULT_OPACITY_TARGETS,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
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
			'sketchpad_admin_page_background_image' => array(
				'setting'  => 'sketchpad_admin_page_background_image',
				'section'  => 'sketchpad_admin_page_setting_section',
				'label'    => __( 'Activate the background image setting in the admin panel.', 'sketchpad-modified' ),
				'type'     => 'checkbox',
				'priority' => 0,
			),
			parent::WP_OBJECT_START_WITH . '001'    => new WP_Customize_Upload_Control(
				$wp_customize,
				'sketchpad_admin_page_background_image_url',
				array(
					'setting' => 'sketchpad_admin_page_background_image_url',
					'section' => 'sketchpad_admin_page_setting_section',
					'label'   => __( 'Background', 'sketchpad-modified' ) . __( 'Image', 'sketchpad-modified' ),
				)
			),
			parent::WP_OBJECT_START_WITH . '002'    => new WP_Customize_Color_Control(
				$wp_customize,
				'sketchpad_admin_page_background_image_color',
				array(
					'setting' => 'sketchpad_admin_page_background_image_color',
					'section' => 'sketchpad_admin_page_setting_section',
					'label'   => __( 'Color', 'sketchpad-modified' ),
				)
			),
			'sketchpad_admin_background_image_color_reset_button' => array(
				'settings'    => array(),
				'section'     => 'sketchpad_admin_page_setting_section',
				'type'        => 'button',
				'input_attrs' => array(
					'value' => __( 'Reset', 'sketchpad-modified' ),
					'class' => 'button button-primary',
				),
			),
			'sketchpad_admin_page_background_image_opacity' => array(
				'setting'     => 'sketchpad_admin_page_background_image_opacity',
				'section'     => 'sketchpad_admin_page_setting_section',
				'label'       => __( 'Opacity', 'sketchpad-modified' ),
				'description' => __( 'The more you slide to the left, the higher the transparency.', 'sketchpad-modified' ),
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 1,
					'step' => 0.01,
				),
			),
			'sketchpad_admin_background_image_opacity_reset_button' => array(
				'settings'    => array(),
				'section'     => 'sketchpad_admin_page_setting_section',
				'type'        => 'button',
				'input_attrs' => array(
					'value' => __( 'Reset', 'sketchpad-modified' ),
					'class' => 'button button-primary',
				),
			),
			'sketchpad_admin_background_image_opacity_targets' => array(
				'setting'     => 'sketchpad_admin_background_image_opacity_targets',
				'section'     => 'sketchpad_admin_page_setting_section',
				'label'       => __( 'Transparent DOM', 'sketchpad-modified' ),
				'description' => __( 'Enter the DOM element you want to make transparent.', 'sketchpad-modified' ),
				'type'        => 'textarea',
			),
			'sketchpad_admin_background_image_opacity_targets_reset_button' => array(
				'settings'    => array(),
				'section'     => 'sketchpad_admin_page_setting_section',
				'type'        => 'button',
				'input_attrs' => array(
					'value' => __( 'Reset', 'sketchpad-modified' ),
					'class' => 'button button-primary',
				),
			),
		);
	}

	/**
	 * Return whether the admin background image be set or not.
	 *
	 * @since  3.0.0
	 * @return boolean
	 */
	public static function is_admin_page_background():bool {
		return get_theme_mod( 'sketchpad_admin_page_background_image', false ) && ! empty( self::get_image_url() );
	}

	/**
	 * Return the background image url.
	 *
	 * @since  3.0.0
	 * @return string|null
	 */
	public static function get_image_url():?string {
		return get_theme_mod( 'sketchpad_admin_page_background_image_url', null );
	}

	/**
	 * Return the background rgba code.
	 *
	 * @since  3.0.0
	 * @return string
	 */
	public static function get_rgba():string {
		return implode(
			',',
			get_sketchpad_color_code2rgba(
				get_theme_mod(
					'sketchpad_admin_page_background_image_color',
					self::DEFAULT_ADMIN_BACKGROUND_COLOR
				)
			)
		);
	}

	/**
	 * Return the opacity.
	 *
	 * @since  3.0.0
	 * @return float
	 */
	public static function get_opacity():float {
		return get_theme_mod( 'sketchpad_admin_page_background_image_opacity', self::DEFAULT_ADMIN_BACKGROUND_OPACITY );
	}

	/**
	 * Return the opacity targets.
	 *
	 * @since  3.0.0
	 * @return string
	 */
	public static function get_opacity_targets():string {
		return get_theme_mod( 'sketchpad_admin_background_image_opacity_targets', self::DEFAULT_OPACITY_TARGETS );
	}
}
