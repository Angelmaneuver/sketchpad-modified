<?php
/**
 * Theme API: Admin Page Setting Theme Customizer Initialize class.
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
 * Class for Admin Page Setting theme customizer initialize.
 *
 * @since 2.1.0
 */
class SM_Admin_Page_Setting_Initializer extends SM_Abstract_Theme_Customizer_Initializer {
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
			'sketchpad_admin_page_setting_section' => array(
				'title'       => __( 'Admin Page Setting', 'sketchpad-modified' ),
				'description' => __( 'Please enter if you want to background image for the admin panel.', 'sketchpad-modified' ),
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
			'sketchpad_admin_page_background_image'            => array( 'default' => false,                                               'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_checkbox' ),
			'sketchpad_admin_page_background_image_url'        => array( 'default' => null,                                                'transport' => 'postMessage', 'sanitize_callback' => 'esc_url_raw' ),
			'sketchpad_admin_page_background_image_color'      => array( 'defult'  => Sm_Basic_Constant::ADMIN_BACKGROUND_COLOR,           'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color' ),
			'sketchpad_admin_page_background_image_opacity'    => array( 'default' => 0.5,                                                 'transport' => 'postMessage', 'sanitize_callback' => 'esc_html' ),
			'sketchpad_admin_background_image_opacity_targets' => array( 'default' => Sm_Basic_Constant::ADMIN_BACKGROUND_OPACITY_TARGETS, 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_text_field' ),
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
			'sketchpad_admin_page_background_image'                         => array( 'setting' => 'sketchpad_admin_page_background_image',             'section' => 'sketchpad_admin_page_setting_section', 'label' => __( 'Activate the background image setting in the admin panel.', 'sketchpad-modified' ),                                                                                                              'type' => 'checkbox', 'priority' => 0 ),
			parent::WP_OBJECT_START_WITH . '001'                            => new WP_Customize_Upload_Control( $wp_customize, 'sketchpad_admin_page_background_image_url',
				array( 'setting' => 'sketchpad_admin_page_background_image_url', 'section' => 'sketchpad_admin_page_setting_section', 'label'   => __( 'Background', 'sketchpad-modified' ) . __( 'Image', 'sketchpad-modified' ), )
			),
			parent::WP_OBJECT_START_WITH . '002'                            => new WP_Customize_Color_Control( $wp_customize, 'sketchpad_admin_page_background_image_color',
				array( 'setting' => 'sketchpad_admin_page_background_image_color', 'section' => 'sketchpad_admin_page_setting_section', 'label'   => __( 'Color', 'sketchpad-modified' ), )
			),
			'sketchpad_admin_background_image_color_reset_button'           => array( 'settings' => array(),                                            'section' => 'sketchpad_admin_page_setting_section',                                                                                                                                                                                                                  'type' => 'button',  'input_attrs' => array( 'value' => __( 'Reset', 'sketchpad-modified' ), 'class' => 'button button-primary', ) ),
			'sketchpad_admin_page_background_image_opacity'                 => array( 'setting'  => 'sketchpad_admin_page_background_image_opacity',    'section' => 'sketchpad_admin_page_setting_section', 'label' => __( 'Opacity', 'sketchpad-modified' ),                                                   'description' => __( 'The more you slide to the left, the higher the transparency.', 'sketchpad-modified' ), 'type' => 'range',   'input_attrs' => array( 'min' => 0, 'max' => 1, 'step' => 0.01 ) ),
			'sketchpad_admin_background_image_opacity_reset_button'         => array( 'settings' => array(),                                            'section' => 'sketchpad_admin_page_setting_section',                                                                                                                                                                                                                  'type' => 'button',  'input_attrs' => array( 'value' => __( 'Reset', 'sketchpad-modified' ), 'class' => 'button button-primary' ) ),
			'sketchpad_admin_background_image_opacity_targets'              => array( 'setting'  => 'sketchpad_admin_background_image_opacity_targets', 'section' => 'sketchpad_admin_page_setting_section', 'label' => __( 'Transparent DOM', 'sketchpad-modified' ),                                           'description' => __( 'Enter the DOM element you want to make transparent.', 'sketchpad-modified' ),          'type' => 'textarea' ),
			'sketchpad_admin_background_image_opacity_targets_reset_button' => array( 'settings' => array(),                                            'section' => 'sketchpad_admin_page_setting_section',                                                                                                                                                                                                                  'type' => 'button',  'input_attrs' => array( 'value' => __( 'Reset', 'sketchpad-modified' ), 'class' => 'button button-primary' ) ),
		);
		// @codingStandardsIgnoreEnd
	}

}
