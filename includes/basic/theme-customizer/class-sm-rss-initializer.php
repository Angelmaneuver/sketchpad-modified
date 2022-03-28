<?php
/**
 * RSS feed setting Theme Customizer Initialize class.
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
require_once get_template_directory() . '/includes/basic/theme-customizer/sanitizer/select.php';

/**
 * Class for RSS feed setting theme customizer initialize.
 *
 * @since 3.0.0
 */
class SM_RSS_Initializer extends SM_Abstract_Theme_Customizer_Initializer {
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
				'id'          => 'sketchpad_rss_section',
				'title'       => __( 'RSS Feed Setting', 'sketchpad-modified' ),
				'description' => __( 'Set whether to output an eye-catching image to RSS Feed.', 'sketchpad-modified' ),
				'priority'    => 1020,
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
				'key'               => 'sketchpad_rss_output_post_tumbnail',
				'default'           => false,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sketchpad_sanitize_checkbox',

			),
			array(
				'key'               => 'sketchpad_rss_output_media_content_tag',
				'default'           => false,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sketchpad_sanitize_checkbox',

			),
			array(
				'key'               => 'sketchpad_rss_output_enclosure_tag',
				'default'           => false,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sketchpad_sanitize_checkbox',

			),
			array(
				'key'               => 'sketchpad_rss_media_image_size',
				'default'           => 'thumbnail',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sketchpad_sanitize_select',
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
			'sketchpad_rss_output_post_tumbnail'     => array(
				'setting' => 'sketchpad_rss_output_post_tumbnail',
				'section' => 'sketchpad_rss_section',
				'label'   => __( 'output eye-catching image', 'sketchpad-modified' ),
				'type'    => 'checkbox',
			),
			'sketchpad_rss_output_media_content_tag' => array(
				'setting' => 'sketchpad_rss_output_media_content_tag',
				'section' => 'sketchpad_rss_section',
				'label'   => __( 'to incluede the "media:content" tag', 'sketchpad-modified' ),
				'type'    => 'checkbox',
			),
			'sketchpad_rss_output_enclosure_tag'     => array(
				'setting' => 'sketchpad_rss_output_enclosure_tag',
				'section' => 'sketchpad_rss_section',
				'label'   => __( 'to incluede the "enclosure" tag', 'sketchpad-modified' ),
				'type'    => 'checkbox',
			),
			'sketchpad_rss_media_image_size'         => array(
				'setting' => 'sketchpad_rss_media_image_size',
				'section' => 'sketchpad_rss_section',
				'label'   => __( 'Image Size', 'sketchpad-modified' ),
				'choices' => array(
					'thumbnail' => 'thumbnail',
					'medium'    => 'medium',
					'large'     => 'large',
					'full'      => 'full',
				),
				'type'    => 'select',
			),
		);
	}

	/**
	 * Return whether to output eye-catching images in RSS feed.
	 *
	 * @since  3.0.0
	 * @return boolean
	 */
	public static function is_output_post_tumbnail():bool {
		return (
			get_theme_mod( 'sketchpad_rss_output_post_tumbnail', false )
			&& ( self::is_output_media_content_tag() || self::is_output_enclosure_tag() )
		);
	}

	/**
	 * Return the output image size to RSS feed.
	 *
	 * @since  3.0.0
	 * @return string
	 */
	public static function get_rss_media_image_size():string {
		return get_theme_mod( 'sketchpad_rss_media_image_size', 'thumbnail' );
	}

	/**
	 * Return whether to output media content tag in RSS feed.
	 *
	 * @since  3.0.0
	 * @return boolean
	 */
	public static function is_output_media_content_tag():bool {
		return get_theme_mod( 'sketchpad_rss_output_media_content_tag', false );
	}

	/**
	 * Return whether to output enclosure tag in RSS feed.
	 *
	 * @since  3.0.0
	 * @return boolean
	 */
	public static function is_output_enclosure_tag():bool {
		return get_theme_mod( 'sketchpad_rss_output_enclosure_tag', false );
	}
}
