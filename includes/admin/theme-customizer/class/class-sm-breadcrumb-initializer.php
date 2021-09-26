<?php
/**
 * Theme API: Breadcrumb Theme Customizer Initialize class.
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
 * Class for Breadcrumb theme customizer initialize.
 *
 * @since 2.1.0
 */
class SM_Breadcrumb_Initializer extends SM_Abstract_Theme_Customizer_Initializer {
	/**
	 * Return the panels definition.
	 *
	 * @return array array( string $id, array $args )
	 */
	protected function get_panels() {
		return array(
			'sketchpad_breadcrumb_panel' => array(
				'title'    => __( 'Sketchpad modified Breadcrumb Setting', 'sketchpad-modified' ),
				'priority' => 1000,
			),
		);
	}

	/**
	 * Return the sections definition.
	 *
	 * @return array array( string $id, array $args )
	 */
	protected function get_sections() {
		return array(
			'sketchpad_breadcrumb_general_section'    => array(
				'title' => __( 'General', 'sketchpad-modified' ),
				'panel' => 'sketchpad_breadcrumb_panel',
			),
			'sketchpad_breadcrumb_posttype_section'   => array(
				'title' => __( 'Post Type', 'sketchpad-modified' ),
				'panel' => 'sketchpad_breadcrumb_panel',
			),
			'sketchpad_breadcrumb_taxonomies_section' => array(
				'title' => __( 'Taxonomies', 'sketchpad-modified' ),
				'panel' => 'sketchpad_breadcrumb_panel',
			),
			'sketchpad_breadcrumb_other_section'      => array(
				'title' => __( 'Other', 'sketchpad-modified' ),
				'panel' => 'sketchpad_breadcrumb_panel',
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
			'sketchpad_breadcrumb_output_breadcrumb'            => array( 'default' => false,                                                                   'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_checkbox' ),
			'sketchpad_breadcrumb_separator'                    => array( 'default' => sanitize_text_field( SM_Breadcrumb::SEPARATOR ),                         'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_text_field' ),
			'sketchpad_breadcrumb_around_the_tag'               => array( 'default' => sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::AROUND_THE_TAG ), 'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_breadcrumb_template' ),
			'sketchpad_breadcrumb_close_tag'                    => array( 'default' => sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::CLOSE_TAG ),      'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_breadcrumb_template' ),
			'sketchpad_breadcrumb_homepage_template'            => array( 'default' => sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::HOME_PAGE ),      'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_breadcrumb_template' ),
			'sketchpad_breadcrumb_output_home'                  => array( 'default' => true,                                                                    'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_checkbox' ),
			'sketchpad_breadcrumb_post_type_template'           => array( 'default' => sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::POST_TYPE ),      'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_breadcrumb_template' ),
			'sketchpad_breadcrumb_page_type_template'           => array( 'default' => sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::PAGE_TYPE ),      'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_breadcrumb_template' ),
			'sketchpad_breadcrumb_media_type_template'          => array( 'default' => sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::MEDIA_TYPE ),     'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_breadcrumb_template' ),
			'sketchpad_breadcrumb_taxonomies_category_template' => array( 'default' => sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::CATEGORY ),       'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_breadcrumb_template' ),
			'sketchpad_breadcrumb_taxonomies_tag_template'      => array( 'default' => sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::TAG ),            'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_breadcrumb_template' ),
			'sketchpad_breadcrumb_other_author_template'        => array( 'default' => sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::AUTHOR ),         'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_breadcrumb_template' ),
			'sketchpad_breadcrumb_other_date_template'          => array( 'default' => sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::DATE ),           'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_breadcrumb_template' ),
			'sketchpad_breadcrumb_other_search_template'        => array( 'default' => sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::SEARCH ),         'transport' => 'postMessage', 'sanitize_callback' => 'sketchpad_sanitize_breadcrumb_template' ),
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
			'sketchpad_breadcrumb_output_breadcrumb'            => array( 'setting' => 'sketchpad_breadcrumb_output_breadcrumb',            'section' => 'sketchpad_breadcrumb_general_section',    'label' => __( 'output breadcrumb', 'sketchpad-modified' ),                                                                                                        'type' => 'checkbox' ),
			'sketchpad_breadcrumb_separator'                    => array( 'setting' => 'sketchpad_breadcrumb_separator',                    'section' => 'sketchpad_breadcrumb_general_section',    'label' => __( 'Breadcrumb Separator', 'sketchpad-modified' ),           'description' => __( 'Placed between each piece of breadcrumbs.', 'sketchpad-modified' ), 'type' => 'text' ),
			'sketchpad_breadcrumb_around_the_tag'               => array( 'setting' => 'sketchpad_breadcrumb_around_the_tag',               'section' => 'sketchpad_breadcrumb_general_section',    'label' => __( 'Breadcrumb around the tag', 'sketchpad-modified' ),                                                                                                'type' => 'text' ),
			'sketchpad_breadcrumb_close_tag'                    => array( 'setting' => 'sketchpad_breadcrumb_close_tag',                    'section' => 'sketchpad_breadcrumb_general_section',    'label' => __( 'Breadcrumb close tag', 'sketchpad-modified' ),                                                                                                     'type' => 'text' ),
			'sketchpad_breadcrumb_homepage_template'            => array( 'setting' => 'sketchpad_breadcrumb_homepage_template',            'section' => 'sketchpad_breadcrumb_general_section',    'label' => __( 'Homepage Template', 'sketchpad-modified' ),                                                                                                        'type' => 'textarea' ),
			'sketchpad_breadcrumb_output_home'                  => array( 'setting' => 'sketchpad_breadcrumb_output_home',                  'section' => 'sketchpad_breadcrumb_general_section',    'label' => __( 'include homepage in breadcrumb', 'sketchpad-modified' ),                                                                                           'type' => 'checkbox' ),
			'sketchpad_breadcrumb_post_type_template'           => array( 'setting' => 'sketchpad_breadcrumb_post_type_template',           'section' => 'sketchpad_breadcrumb_posttype_section',   'label' => __( 'Post Template', 'sketchpad-modified' ),                                                                                                            'type' => 'textarea' ),
			'sketchpad_breadcrumb_page_type_template'           => array( 'setting' => 'sketchpad_breadcrumb_page_type_template',           'section' => 'sketchpad_breadcrumb_posttype_section',   'label' => __( 'Page Template', 'sketchpad-modified' ),                                                                                                            'type' => 'textarea' ),
			'sketchpad_breadcrumb_media_type_template'          => array( 'setting' => 'sketchpad_breadcrumb_media_type_template',          'section' => 'sketchpad_breadcrumb_posttype_section',   'label' => __( 'Media Template', 'sketchpad-modified' ),                                                                                                           'type' => 'textarea' ),
			'sketchpad_breadcrumb_taxonomies_category_template' => array( 'setting' => 'sketchpad_breadcrumb_taxonomies_category_template', 'section' => 'sketchpad_breadcrumb_taxonomies_section', 'label' => __( 'Category Template', 'sketchpad-modified' ),                                                                                                        'type' => 'textarea' ),
			'sketchpad_breadcrumb_taxonomies_tag_template'      => array( 'setting' => 'sketchpad_breadcrumb_taxonomies_tag_template',      'section' => 'sketchpad_breadcrumb_taxonomies_section', 'label' => __( 'Tag Template', 'sketchpad-modified' ),                                                                                                             'type' => 'textarea' ),
			'sketchpad_breadcrumb_other_author_template'        => array( 'setting' => 'sketchpad_breadcrumb_other_author_template',        'section' => 'sketchpad_breadcrumb_other_section',      'label' => __( 'Author Template', 'sketchpad-modified' ),                                                                                                          'type' => 'textarea' ),
			'sketchpad_breadcrumb_other_date_template'          => array( 'setting' => 'sketchpad_breadcrumb_other_date_template',          'section' => 'sketchpad_breadcrumb_other_section',      'label' => __( 'Date Template', 'sketchpad-modified' ),                                                                                                            'type' => 'textarea' ),
			'sketchpad_breadcrumb_other_search_template'        => array( 'setting' => 'sketchpad_breadcrumb_other_search_template',        'section' => 'sketchpad_breadcrumb_other_section',      'label' => __( 'Search Template', 'sketchpad-modified' ),                                                                                                          'type' => 'textarea' ),
		);
		// @codingStandardsIgnoreEnd
	}

}
