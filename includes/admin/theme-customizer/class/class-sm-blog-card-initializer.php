<?php
/**
 * Theme API: Blog Card Theme Customizer Initialize class.
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
 * Class for Blog Card theme customizer initialize.
 *
 * @since 2.1.0
 */
class SM_Blog_Card_Initializer extends SM_Abstract_Theme_Customizer_Initializer {
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
			'sketchpad_blog_card_section' => array(
				'title'       => __( 'Blog Card Setting', 'sketchpad-modified' ),
				'description' => __( 'Configure settings for the Blog Card.', 'sketchpad-modified' ),
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
			'sketchpad_blog_card_image_size_setting_enable'      => array( 'default' => false,                                       'sanitize_callback' => 'sketchpad_sanitize_checkbox' ),
			'sketchpad_blog_card_image_size'                     => array( 'default' => 'thumbnail',                                 'sanitize_callback' => 'sketchpad_sanitize_select' ),
			'sketchpad_blog_card_image_form_type_setting_enable' => array( 'default' => false,         'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_checkbox' ),
			'sketchpad_blog_card_image_form'                     => array( 'default' => 'rectangular', 'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_select' ),
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
			'sketchpad_blog_card_image_size_setting_enable'      => array( 'setting'  => 'sketchpad_blog_card_image_size_setting_enable',      'section' => 'sketchpad_blog_card_section', 'label' => __( 'Blog Card Image Size setting enable', 'sketchpad-modified' ),                                                                                                                    'type' => 'checkbox' ),
			'sketchpad_blog_card_image_size'                     => array( 'settings' => 'sketchpad_blog_card_image_size',                     'section' => 'sketchpad_blog_card_section', 'label' => __( 'Image Size', 'sketchpad-modified' ),                               'choices' => array( 'thumbnail' => 'thumbnail', 'medium' => 'medium', 'large' => 'large', 'full' => 'full' ), 'type' => 'select' ),
			'sketchpad_blog_card_image_form_type_setting_enable' => array( 'setting'  => 'sketchpad_blog_card_image_form_type_setting_enable', 'section' => 'sketchpad_blog_card_section', 'label' => __( 'Blog Card Image Form Type setting enable', 'sketchpad-modified' ),                                                                                                               'type' => 'checkbox' ),
			'sketchpad_blog_card_image_form'                     => array( 'settings' => 'sketchpad_blog_card_image_form',                     'section' => 'sketchpad_blog_card_section', 'label' => __( 'Form Type', 'sketchpad-modified' ),                                'choices' => array( 'rectangular' => 'rectangular', 'square' => 'square' ),                                   'type' => 'select' ),
		);
		// @codingStandardsIgnoreEnd
	}

}
