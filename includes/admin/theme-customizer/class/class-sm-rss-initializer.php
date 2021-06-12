<?php
/**
 * Theme API: RSS Theme Customizer Initialize class.
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
 * Class for RSS theme customizer initialize.
 *
 * @since 2.1.0
 */
class SM_RSS_Initializer extends SM_Abstract_Theme_Customizer_Initializer {
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
			'sketchpad_rss_section' => array(
				'title'       => __( 'Sketchpad - modified RSS Feed Setting', 'sketchpad-modified' ),
				'description' => __( 'Set whether to output an eye-catching image to RSS Feed.', 'sketchpad-modified' ),
				'priority'    => 1000,
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
			'sketchpad_rss_output_post_tumbnail'     => array( 'default' => false,       'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_checkbox' ),
			'sketchpad_rss_output_media_content_tag' => array( 'default' => false,       'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_checkbox' ),
			'sketchpad_rss_output_enclosure_tag'     => array( 'default' => false,       'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_checkbox' ),
			'sketchpad_rss_media_image_size'         => array( 'default' => 'thumbnail', 'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_select' ),
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
			'sketchpad_rss_output_post_tumbnail'     => array( 'setting' => 'sketchpad_rss_output_post_tumbnail',     'section' => 'sketchpad_rss_section', 'label' => __( 'output eye-catching image', 'sketchpad-modified' ),                                                                                                                         'type' => 'checkbox' ),
			'sketchpad_rss_output_media_content_tag' => array( 'setting' => 'sketchpad_rss_output_media_content_tag', 'section' => 'sketchpad_rss_section', 'label' => __( 'to incluede the "media:content" tag', 'sketchpad-modified' ),                                                                                                               'type' => 'checkbox' ),
			'sketchpad_rss_output_enclosure_tag'     => array( 'setting' => 'sketchpad_rss_output_enclosure_tag',     'section' => 'sketchpad_rss_section', 'label' => __( 'to incluede the "enclosure" tag', 'sketchpad-modified' ),                                                                                                                   'type' => 'checkbox' ),
			'sketchpad_rss_media_image_size'         => array( 'setting' => 'sketchpad_rss_media_image_size',         'section' => 'sketchpad_rss_section', 'label' => __( 'Image Size', 'sketchpad-modified' ),                          'choices' => array( 'thumbnail' => 'thumbnail', 'medium' => 'medium', 'large' => 'large', 'full' => 'full' ), 'type' => 'select' ),
		);
		// @codingStandardsIgnoreEnd
	}
}
