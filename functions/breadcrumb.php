<?php
/**
 * Sketchpad - modified Breadcrumb part of Functions and definitions.
 *
 * @subpackage Sketchpad - modified 1.0
 * @since      Sketchpad - modified 1.0
 */

/**
 * Constant Class for this functions.
 */
class BreadcrumbDefualtClass {
  const SEPARATOR       = '>';
  const AROUND_THE_TAG  = '<div class="breadcrumbs">';
  const CLOSE_TAG       = '</div>';
  const HOME_PAGE       = '<span><a title="Go Home" href="%link%"><span>Home</span></a></span>';
  const POST_TYPE       = '<span><a title="Go %title%" href="%link%"><span>%htitle%</span></a></span>';
  const PAGE_TYPE       = self::POST_TYPE;
  const MEDIA_TYPE      = self::POST_TYPE;
  const CATEGORY        = '<span><a title="Go %title% category archive" href="%link%"><span>%htitle%</span></a></span>';
  const TAG             = '<span><a title="Go %title% tag archive" href="%link%"><span>%htitle%</span></a></span>';
  const AUTHOR          = '<span><span><a title="Go to the first page of the %title% article" href="%link%">%htitle%</a></span></span>';
  const DATE            = '<span><a title="Go %title% archive" href="%link%"><span>%htitle%</span></a></span>';
  const SEARCH          = '<span><span><a title="Go to the first page of the search %title% result" href="%link%">%htitle%</a></span></span>';
}

/**
 * Set up the Sketchpad - modifed Breadcrumb settings via customizer.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function sketchpad_customize2breadcrumb_register( $wp_customize ) {
  // General
	$wp_customize->add_panel( 'sketchpad_breadcrumb_panel', array(
    'title'							=> __( 'Sketchpad - modified Breadcrumb Setting', 'sketchpad-modified' ),
		'priority'					=> 1020,
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
		'default'						=> sanitize_text_field( BreadcrumbDefualtClass::SEPARATOR ),
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
		'default'						=> sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::AROUND_THE_TAG ),
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
		'default'						=> sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::CLOSE_TAG ),
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
		'default'						=> sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::HOME_PAGE ),
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
		'default'						=> sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::POST_TYPE ),
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
		'default'						=> sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::PAGE_TYPE ),
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
		'default'						=> sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::MEDIA_TYPE ),
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
		'default'						=> sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::CATEGORY ),
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
		'default'						=> sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::TAG ),
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
		'default'						=> sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::AUTHOR ),
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
		'default'						=> sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::DATE ),
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
		'default'						=> sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::SEARCH ),
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

/**
 * Breadcrumb Template sanitizer.
 * 
 * @param value                 $input   The Customize Setting value.
 */
function sketchpad_sanitize_breadcrumb_template( $input ) {
  $allow = array(
    'a'     => array(
                'class'     => array(),
                'id'        => array(),
                'style'     => array(),
                'href'      => array(),
                'title'     => array(),
                'property'  => array(),
                'typeof'    => array(),
               ),
    'span'  => array(
                'class'     => array(),
                'id'        => array(),
                'style'     => array(),
                'vocab'     => array(),
                'property'  => array(),
                'typeof'    => array(),
               ),
    'div'   => array(
                'class'     => array(),
                'id'        => array(),
                'style'     => array(),
                'vocab'     => array(),
                'property'  => array(),
                'typeof'    => array(),
               ),
    'meta'  => array(
                'property'  => array(),
                'content'   => array(),
               ),
           );
    return wp_kses( $input, $allow );
}

// output breadcrump method wrapper
function sketchpad_breadcrumb() {
  if ( get_theme_mod( 'sketchpad_breadcrumb_output_breadcrumb', false ) && !( is_home() || is_front_page() ) ) {
    sketchpad_output_breadcrumb();
  }
}

// output breadcrump
function sketchpad_output_breadcrumb() {
  $wp_obj = get_queried_object();

  $breadcrumb_separator = esc_html( get_theme_mod( 'sketchpad_breadcrumb_separator', sanitize_text_field( BreadcrumbDefualtClass::SEPARATOR ) ) );
  $breadcrumb_content = 1;
  $breadcurmb_separate_defualt = sprintf( ' %s ', $breadcrumb_separator );
  $breadcurmb_currnet_page_link = esc_url( sketchpad_get_current_url() );
  $breadcrumb_temp = '';

  // output around the tag
  echo sketchpad_sanitize_breadcrumb_template( get_theme_mod( 'sketchpad_breadcrumb_around_the_tag', BreadcrumbDefualtClass::AROUND_THE_TAG ) );

  // output home to breadcrumbs
  if ( get_theme_mod ( 'sketchpad_breadcrumb_output_home', true ) ) {
    $replacement = array(
      '%link%'      => esc_url( home_url() ),
      '%position%'  => $breadcrumb_content,
    );

    echo str_replace( array_keys( $replacement ), array_values( $replacement), get_theme_mod ( 'sketchpad_breadcrumb_homepage_template', sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::HOME_PAGE ) ) );

    $breadcrumb_content += 1;
    $breadcrumb_temp = $breadcurmb_separate_defualt;
  }

  // case : attachment
  if ( is_attachment() ) {
    $replacement = array(
      '%title%'     => apply_filters( 'the_title', $wp_obj->post_title ),
      '%htitle%'    => apply_filters( 'the_title', $wp_obj->post_title ),
      '%link%'      => $breadcurmb_currnet_page_link,
      '%position%'  => $breadcrumb_content,
    );

    echo $breadcrumb_temp . str_replace( array_keys( $replacement ), array_values( $replacement), get_theme_mod ( 'sketchpad_breadcrumb_media_type_template', sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::MEDIA_TYPE ) ) );

  // case : post
  } elseif ( is_single() ) {
    $post_id    = $wp_obj->ID;
    $post_type  = $wp_obj->post_type;
    $post_title = apply_filters( 'the_title', $wp_obj->post_title );

    // case : custom post type
    if ( $post_type !== 'post' ) {
      $taxonomies = 'category';
    // case : normal post
    } else {
      $taxonomies = 'category';
    }

    $terms = get_the_terms( $post_id, $taxonomies );

    // output category breadcrumbs only for one category
    if ( count( $terms ) == 1 ) {
      $breadcrumb_taxonomies_template = get_theme_mod ( 'sketchpad_breadcrumb_taxonomies_category_template', sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::CATEGORY ) );

      if ( $terms[0]->parent != 0 ) {

        $taxonomies_tree = array_reverse( get_ancestors( $terms[0]->term_id, $taxonomies ) );

        foreach ( $taxonomies_tree as  $term_id ) {
          $taxonomies_name = esc_html( get_term($term_id, $taxonomies)->name );
          $replacement = array(
            '%title%'     => $taxonomies_name,
            '%htitle%'    => $taxonomies_name,
            '%link%'      => esc_url( get_term_link( $term_id, $taxonomies ) ),
            '%position%'  => $breadcrumb_content,
          );

          echo $breadcrumb_temp . str_replace( array_keys( $replacement ), array_values( $replacement), $breadcrumb_taxonomies_template );

          $breadcrumb_content += 1;
          $breadcrumb_temp = $breadcurmb_separate_defualt;
        }
      }

      $taxonomies_name = esc_html( $terms[0]->name );
      $replacement = array(
        '%title%'     => $taxonomies_name,
        '%htitle%'    => $taxonomies_name,
        '%link%'      => esc_url( get_term_link( $terms[0]->term_id, $taxonomies ) ),
        '%position%'  => $breadcrumb_content,
      );

      echo $breadcrumb_temp . str_replace( array_keys( $replacement ), array_values( $replacement), $breadcrumb_taxonomies_template );

      $breadcrumb_content += 1;
      $breadcrumb_temp = $breadcurmb_separate_defualt;
    }

    $title_name = esc_html( $post_title );
    $replacement = array(
      '%title%'     => $title_name,
      '%htitle%'    => $title_name,
      '%link%'      => $breadcurmb_currnet_page_link,
      '%position%'  => $breadcrumb_content,
    );

    echo $breadcrumb_temp . str_replace( array_keys( $replacement ), array_values( $replacement), get_theme_mod ( 'sketchpad_breadcrumb_post_type_template', sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::POST_TYPE ) ) );

  // case : page
  } elseif ( is_page() || is_home() ) {
    $page_id    = $wp_obj->ID;
    $page_title = apply_filters( 'the_title', $wp_obj->post_title );

    if ( $wp_obj->post_parent != 0 ) {
      $page_tree = array_reverse( get_post_ancestors( $page_id ) );

      foreach( $page_tree as $page_id ) {
        $title_name = esc_html( get_the_title( $page_id ) );
        $replacement = array(
          '%title%'     => $title_name,
          '%htitle%'    => $title_name,
          '%link%'      => esc_url( get_permalink( $page_id ) ),
          '%position%'  => $breadcrumb_content,
        );

        echo $breadcrumb_temp . str_replace( array_keys( $replacement ), array_values( $replacement), get_theme_mod ( 'sketchpad_breadcrumb_page_type_template', sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::PAGE_TYPE ) ) );

        $breadcrumb_content += 1;
        $breadcrumb_temp = $breadcurmb_separate_defualt;
        }
    }

    $replacement = array(
      '%title%'     => $page_title,
      '%htitle%'    => $page_title,
      '%link%'      => $breadcurmb_currnet_page_link,
      '%position%'  => $breadcrumb_content,
    );

    echo $breadcrumb_temp . str_replace( array_keys( $replacement ), array_values( $replacement), get_theme_mod ( 'sketchpad_breadcrumb_page_type_template', sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::PAGE_TYPE ) ) );

  // case : post type archive
  } elseif ( is_post_type_archive() ) {

  // case : author archive
  } elseif ( is_author() ) {
    $page_title = esc_html( $wp_obj->display_name );
    $replacement = array(
      '%title%'     => $page_title,
      '%htitle%'    => $page_title,
      '%link%'      => $breadcurmb_currnet_page_link,
      '%position%'  => $breadcrumb_content,
    );

    echo $breadcrumb_temp . str_replace( array_keys( $replacement ), array_values( $replacement), get_theme_mod ( 'sketchpad_breadcrumb_other_author_template', sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::AUTHOR ) ) );
    
  // case : date arvhive
  } elseif ( is_date() ) {
    $year  = get_query_var('year');
    $month = get_query_var('monthnum');
    $day   = get_query_var('day');

    $breadcrumb_date_template = get_theme_mod ( 'sketchpad_breadcrumb_other_date_template', sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::DATE ) );

    if ( $year > 0 ) {
      $replacement = array(
        '%title%'     => $year,
        '%htitle%'    => $year,
        '%link%'      => esc_url( get_year_link( $yaer ) ),
        '%position%'  => $breadcrumb_content,
      );

      echo $breadcrumb_temp . str_replace( array_keys( $replacement ), array_values( $replacement), $breadcrumb_date_template );

      $breadcrumb_content += 1;
      $breadcrumb_temp = $breadcurmb_separate_defualt;
    }
    
    if ( $month > 0) {
      $replacement = array(
        '%title%'     => $month,
        '%htitle%'    => $month,
        '%link%'      => esc_url( get_month_link( $year, $month ) ),
        '%position%'  => $breadcrumb_content,
      );

      echo $breadcrumb_temp . str_replace( array_keys( $replacement ), array_values( $replacement), $breadcrumb_date_template );

      $breadcrumb_content += 1;
      $breadcrumb_temp = $breadcurmb_separate_defualt;
    }
    
    if ( $day > 0) {
      $replacement = array(
        '%title%'     => $day,
        '%htitle%'    => $day,
        '%link%'      => $breadcurmb_currnet_page_link,
        '%position%'  => $breadcrumb_content,
      );

      echo $breadcrumb_temp . str_replace( array_keys( $replacement ), array_values( $replacement), $breadcrumb_date_template );
    }

  // case : term archive
  } elseif ( is_archive() ) {
    $term_id   = $wp_obj->term_id;
    $term_name = $wp_obj->name;
    $parent = $wp_obj->parent;
    $taxonomies  = $wp_obj->taxonomy;

    $breadcrumb_taxonomies_template = ( $taxonomies == 'category' ) ? get_theme_mod ( 'sketchpad_breadcrumb_taxonomies_category_template', sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::CATEGORY ) ) : get_theme_mod ( 'sketchpad_breadcrumb_taxonomies_tag_template', sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::TAG ) ) ;

    if ( $parent != 0 ) {

      $taxonomies_tree = array_reverse( get_ancestors( $term_id, $taxonomies ) );

      foreach ( $taxonomies_tree as  $term_id ) {
        $taxonomies_name = esc_html( get_term($term_id, $taxonomies)->name );
        $replacement = array(
          '%title%'     => $taxonomies_name,
          '%htitle%'    => $taxonomies_name,
          '%link%'      => esc_url( get_term_link( $term_id, $taxonomies ) ),
          '%position%'  => $breadcrumb_content,
        );

        echo $breadcrumb_temp . str_replace( array_keys( $replacement ), array_values( $replacement), $breadcrumb_taxonomies_template );

        $breadcrumb_content += 1;
        $breadcrumb_temp = $breadcurmb_separate_defualt;
      }
    }

    $taxonomies_name = esc_html( $term_name );
    $replacement = array(
      '%title%'     => $taxonomies_name,
      '%htitle%'    => $taxonomies_name,
      '%link%'      => $breadcurmb_currnet_page_link,
      '%position%'  => $breadcrumb_content,
    );

    echo $breadcrumb_temp . str_replace( array_keys( $replacement ), array_values( $replacement), $breadcrumb_taxonomies_template );

  // case : search result
  } elseif ( is_search() || is_404 ) {
    $page_title = esc_html( get_search_query() );
    $replacement = array(
      '%title%'     => $page_title,
      '%htitle%'    => $page_title,
      '%link%'      => $breadcrumb_current_page_link,
      '%position%'  => $breadcrumb_content,
    );

    echo $breadcrumb_temp . str_replace( array_keys( $replacement ), array_values( $replacement), get_theme_mod ( 'sketchpad_breadcrumb_other_search_template', sketchpad_sanitize_breadcrumb_template( BreadcrumbDefualtClass::SEARCH ) ) );
  }

  // output close tag
  echo sketchpad_sanitize_breadcrumb_template( get_theme_mod( 'sketchpad_breadcrumb_close_tag', BreadcrumbDefualtClass::CLOSE_TAG ) );
}

add_action( 'customize_register', 'sketchpad_customize2breadcrumb_register', 100 );
add_action( 'sketchpad_modified_breadcrumb', 'sketchpad_breadcrumb' );
