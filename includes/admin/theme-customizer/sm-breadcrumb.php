<?php
/**
 * Breadcrumb.
 *
 * @package sketchpad - modified
 * @subpackage sm-breadcrumb
 * @since 1.0.0
 */

/**
 * Set up the section.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function sketchpad_customize4breadcrumb_register( $wp_customize ) {
  // General
	$wp_customize->add_panel( 'sketchpad_breadcrumb_panel', array(
    'title'							=> __( 'Sketchpad - modified Breadcrumb Setting', 'sketchpad-modified' ),
		'priority'					=> 1000,
	) );
	$wp_customize->add_section( 'sketchpad_breadcrumb_general_section', array(
    'title'							=> __( 'General', 'sketchpad-modified' ),
    'panel'             => 'sketchpad_breadcrumb_panel',
		'priority'					=> 0,
	) );
  $wp_customize->add_setting( 'sketchpad_breadcrumb_output_breadcrumb', array(
		'default'						=> false,
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'sketchpad_breadcrumb_output_breadcrumb', array(
		'setting'						=> 'sketchpad_breadcrumb_output_breadcrumb',
		'section'						=> 'sketchpad_breadcrumb_general_section',
		'label'							=> __( 'output breadcrumb', 'sketchpad-modified' ),
		'type'							=> 'checkbox',
  ) );
	$wp_customize->add_setting( 'sketchpad_breadcrumb_separator', array(
		'default'						=> sanitize_text_field( SmBreadcrumbConstantClass::SEPARATOR ),
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sketchpad_breadcrumb_separator', array(
		'setting'						=> 'sketchpad_breadcrumb_separator',
		'section'						=> 'sketchpad_breadcrumb_general_section',
		'label'							=> __( 'Breadcrumb Separator', 'sketchpad-modified' ),
    'description'       => __( 'Placed between each piece of breadcrumbs.', 'sketchpad-modified' ),
		'type'							=> 'text',
  ) );
  $wp_customize->add_setting( 'sketchpad_breadcrumb_around_the_tag', array(
		'default'						=> sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::AROUND_THE_TAG ),
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_breadcrumb_template',
	) );
	$wp_customize->add_control( 'sketchpad_breadcrumb_around_the_tag', array(
		'setting'						=> 'sketchpad_breadcrumb_around_the_tag',
		'section'						=> 'sketchpad_breadcrumb_general_section',
    'label'							=> __( 'Breadcrumb around the tag', 'sketchpad-modified' ),
		'type'							=> 'text',
	) );
  $wp_customize->add_setting( 'sketchpad_breadcrumb_close_tag', array(
		'default'						=> sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::CLOSE_TAG ),
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_breadcrumb_template',
	) );
	$wp_customize->add_control( 'sketchpad_breadcrumb_close_tag', array(
		'setting'						=> 'sketchpad_breadcrumb_close_tag',
		'section'						=> 'sketchpad_breadcrumb_general_section',
    'label'							=> __( 'Breadcrumb close tag', 'sketchpad-modified' ),
		'type'							=> 'text',
	) );
  $wp_customize->add_setting( 'sketchpad_breadcrumb_homepage_template', array(
		'default'						=> sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::HOME_PAGE ),
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_breadcrumb_template',
	) );
	$wp_customize->add_control( 'sketchpad_breadcrumb_homepage_template', array(
		'setting'						=> 'sketchpad_breadcrumb_homepage_template',
		'section'						=> 'sketchpad_breadcrumb_general_section',
    'label'							=> __( 'Homepage Template', 'sketchpad-modified' ),
		'type'							=> 'textarea',
	) );
  $wp_customize->add_setting( 'sketchpad_breadcrumb_output_home', array(
		'default'						=> true,
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'sketchpad_breadcrumb_output_home', array(
		'setting'						=> 'sketchpad_breadcrumb_output_home',
		'section'						=> 'sketchpad_breadcrumb_general_section',
		'label'							=> __( 'include homepage in breadcrumb', 'sketchpad-modified' ),
		'type'							=> 'checkbox',
  ) );
  // Post Type
	$wp_customize->add_section( 'sketchpad_breadcrumb_posttype_section', array(
    'title'							=> __( 'Post Type', 'sketchpad-modified' ),
    'panel'             => 'sketchpad_breadcrumb_panel',
		'priority'					=> 20,
	) );
	$wp_customize->add_setting( 'sketchpad_breadcrumb_post_type_template', array(
		'default'						=> sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::POST_TYPE ),
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_breadcrumb_template',
	) );
	$wp_customize->add_control( 'sketchpad_breadcrumb_post_type_template', array(
		'setting'						=> 'sketchpad_breadcrumb_post_type_template',
		'section'						=> 'sketchpad_breadcrumb_posttype_section',
		'label'							=> __( 'Post Template', 'sketchpad-modified' ),
		'type'							=> 'textarea',
  ) );
	$wp_customize->add_setting( 'sketchpad_breadcrumb_page_type_template', array(
		'default'						=> sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::PAGE_TYPE ),
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_breadcrumb_template',
	) );
	$wp_customize->add_control( 'sketchpad_breadcrumb_page_type_template', array(
		'setting'						=> 'sketchpad_breadcrumb_page_type_template',
		'section'						=> 'sketchpad_breadcrumb_posttype_section',
		'label'							=> __( 'Page Template', 'sketchpad-modified' ),
		'type'							=> 'textarea',
  ) );
	$wp_customize->add_setting( 'sketchpad_breadcrumb_media_type_template', array(
		'default'						=> sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::MEDIA_TYPE ),
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_breadcrumb_template',
	) );
	$wp_customize->add_control( 'sketchpad_breadcrumb_media_type_template', array(
		'setting'						=> 'sketchpad_breadcrumb_media_type_template',
		'section'						=> 'sketchpad_breadcrumb_posttype_section',
		'label'							=> __( 'Media Template', 'sketchpad-modified' ),
		'type'							=> 'textarea',
  ) );
  // Taxonomies
	$wp_customize->add_section( 'sketchpad_breadcrumb_taxonomies_section', array(
    'title'							=> __( 'Taxonomies', 'sketchpad-modified' ),
    'panel'             => 'sketchpad_breadcrumb_panel',
		'priority'					=> 40,
	) );
	$wp_customize->add_setting( 'sketchpad_breadcrumb_taxonomies_category_template', array(
		'default'						=> sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::CATEGORY ),
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_breadcrumb_template',
	) );
	$wp_customize->add_control( 'sketchpad_breadcrumb_taxonomies_category_template', array(
		'setting'						=> 'sketchpad_breadcrumb_taxonomies_category_template',
		'section'						=> 'sketchpad_breadcrumb_taxonomies_section',
		'label'							=> __( 'Category Template', 'sketchpad-modified' ),
		'type'							=> 'textarea',
  ) );
	$wp_customize->add_setting( 'sketchpad_breadcrumb_taxonomies_tag_template', array(
		'default'						=> sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::TAG ),
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_breadcrumb_template',
	) );
	$wp_customize->add_control( 'sketchpad_breadcrumb_taxonomies_tag_template', array(
		'setting'						=> 'sketchpad_breadcrumb_taxonomies_tag_template',
		'section'						=> 'sketchpad_breadcrumb_taxonomies_section',
		'label'							=> __( 'Tag Template', 'sketchpad-modified' ),
		'type'							=> 'textarea',
  ) );
  // Other
	$wp_customize->add_section( 'sketchpad_breadcrumb_other_section', array(
    'title'							=> __( 'Other', 'sketchpad-modified' ),
    'panel'             => 'sketchpad_breadcrumb_panel',
		'priority'					=> 60,
	) );
	$wp_customize->add_setting( 'sketchpad_breadcrumb_other_author_template', array(
		'default'						=> sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::AUTHOR ),
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_breadcrumb_template',
	) );
	$wp_customize->add_control( 'sketchpad_breadcrumb_other_author_template', array(
		'setting'						=> 'sketchpad_breadcrumb_other_author_template',
		'section'						=> 'sketchpad_breadcrumb_other_section',
		'label'							=> __( 'Author Template', 'sketchpad-modified' ),
		'type'							=> 'textarea',
  ) );
	$wp_customize->add_setting( 'sketchpad_breadcrumb_other_date_template', array(
		'default'						=> sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::DATE ),
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_breadcrumb_template',
	) );
	$wp_customize->add_control( 'sketchpad_breadcrumb_other_date_template', array(
		'setting'						=> 'sketchpad_breadcrumb_other_date_template',
		'section'						=> 'sketchpad_breadcrumb_other_section',
		'label'							=> __( 'Date Template', 'sketchpad-modified' ),
		'type'							=> 'textarea',
  ) );
	$wp_customize->add_setting( 'sketchpad_breadcrumb_other_search_template', array(
		'default'						=> sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::SEARCH ),
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_breadcrumb_template',
	) );
	$wp_customize->add_control( 'sketchpad_breadcrumb_other_search_template', array(
		'setting'						=> 'sketchpad_breadcrumb_other_search_template',
		'section'						=> 'sketchpad_breadcrumb_other_section',
		'label'							=> __( 'Search Template', 'sketchpad-modified' ),
		'type'							=> 'textarea',
  ) );
}

add_action( 'customize_register', 'sketchpad_customize4breadcrumb_register', 100 );
