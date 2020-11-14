<?php
/**
 * Sketchpad - modified Breadcrumb.
 *
 * @package sketchpad - modified
 * @subpackage sm-breadcrumb
 * @since 1.0.0
 */

require get_template_directory() . '/includes/admin/theme-customizer/class-sm-breadcrumb-constant.php';

if( is_admin() || is_customize_preview() ){
  require get_template_directory() . '/includes/admin/theme-customizer/sm-breadcrumb.php';
}

/**
 * Output breadcrumb method wrapper.
 *
 * @subpackage sm-breadcrumb
 * @since 1.0.0
 */
function sketchpad_breadcrumb() {
  if ( get_theme_mod( 'sketchpad_breadcrumb_output_breadcrumb', false ) && !( is_home() || is_front_page() ) ) {
    sketchpad_output_breadcrumb();
  }
}

/**
 * Output breadcrumb.
 *
 * @subpackage sm-breadcrumb
 * @since 1.0.0
 */
function sketchpad_output_breadcrumb() {
  $wp_obj = get_queried_object();

  $breadcrumb_content = 1;
  $breadcrumb_separator = sprintf( ' %s ', esc_html( get_theme_mod( 'sketchpad_breadcrumb_separator', SmBreadcrumbConstantClass::SEPARATOR ) ) );
  $breadcurmb_currnet_page_link = esc_url( sketchpad_get_current_url() );

  // around tag
  $breadcrumb_temp = sketchpad_sanitize_breadcrumb_template( get_theme_mod( 'sketchpad_breadcrumb_around_the_tag', SmBreadcrumbConstantClass::AROUND_THE_TAG ) );

  // home
  if ( get_theme_mod ( 'sketchpad_breadcrumb_output_home', true ) ) {
    $replacement = array(
      '%link%'      => esc_url( home_url() ),
      '%position%'  => $breadcrumb_content,
    );
    $breadcrumb_home = str_replace( array_keys( $replacement ), array_values( $replacement), get_theme_mod ( 'sketchpad_breadcrumb_homepage_template', sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::HOME_PAGE ) ) );

    $breadcrumb_content += 1;
    $breadcrumb_temp .= $breadcrumb_home . $breadcrumb_separator;
  }

  // attachment
  if ( is_attachment() ) {
    $replacement = array(
      '%title%'     => apply_filters( 'the_title', $wp_obj->post_title ),
      '%htitle%'    => apply_filters( 'the_title', $wp_obj->post_title ),
      '%link%'      => $breadcurmb_currnet_page_link,
      '%position%'  => $breadcrumb_content,
    );
    $breadcrumb_attachment = str_replace( array_keys( $replacement ), array_values( $replacement), get_theme_mod ( 'sketchpad_breadcrumb_media_type_template', sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::MEDIA_TYPE ) ) );

    $breadcrumb_content += 1;
    $breadcrumb_temp .= $breadcrumb_attachment;

  // post
  } elseif ( is_single() ) {
    $post_id    = $wp_obj->ID;
    $post_type  = $wp_obj->post_type;
    $post_title = apply_filters( 'the_title', $wp_obj->post_title );

    // custom post type
    if ( $post_type !== 'post' ) {
      $taxonomies = 'category';

    // normal post type
    } else {
      $taxonomies = 'category';
    }

    $terms = get_the_terms( $post_id, $taxonomies );

    // output category breadcrumbs only for one category
    if ( count( $terms ) == 1 ) {
      $breadcrumb_taxonomies_template = get_theme_mod ( 'sketchpad_breadcrumb_taxonomies_category_template', sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::CATEGORY ) );

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
          $breadcrumb_categories = str_replace( array_keys( $replacement ), array_values( $replacement), $breadcrumb_taxonomies_template );

          $breadcrumb_content += 1;
          $breadcrumb_temp .= $breadcrumb_categories . $breadcrumb_separator;
        }
      }

      $taxonomies_name = esc_html( $terms[0]->name );
      $replacement = array(
        '%title%'     => $taxonomies_name,
        '%htitle%'    => $taxonomies_name,
        '%link%'      => esc_url( get_term_link( $terms[0]->term_id, $taxonomies ) ),
        '%position%'  => $breadcrumb_content,
      );
      $breadcrumb_categories = str_replace( array_keys( $replacement ), array_values( $replacement), $breadcrumb_taxonomies_template );

      $breadcrumb_content += 1;
      $breadcrumb_temp .= $breadcrumb_categories . $breadcrumb_separator;
    }

    $title_name = esc_html( $post_title );
    $replacement = array(
      '%title%'     => $title_name,
      '%htitle%'    => $title_name,
      '%link%'      => $breadcurmb_currnet_page_link,
      '%position%'  => $breadcrumb_content,
    );
    $breadcrumb_post = str_replace( array_keys( $replacement ), array_values( $replacement), get_theme_mod ( 'sketchpad_breadcrumb_post_type_template', sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::POST_TYPE ) ) );

    $breadcrumb_content += 1;
    $breadcrumb_temp .= $breadcrumb_post;

  // page
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
        $breadcrumb_page = str_replace( array_keys( $replacement ), array_values( $replacement), get_theme_mod ( 'sketchpad_breadcrumb_page_type_template', sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::PAGE_TYPE ) ) );

        $breadcrumb_content += 1;
        $breadcrumb_temp .= $breadcrumb_page . $breadcrumb_separator;
        }
    }

    $replacement = array(
      '%title%'     => $page_title,
      '%htitle%'    => $page_title,
      '%link%'      => $breadcurmb_currnet_page_link,
      '%position%'  => $breadcrumb_content,
    );
    $breadcrumb_page = str_replace( array_keys( $replacement ), array_values( $replacement), get_theme_mod ( 'sketchpad_breadcrumb_page_type_template', sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::PAGE_TYPE ) ) );

    $breadcrumb_content += 1;
    $breadcrumb_temp .= $breadcrumb_page;

  // post type archive
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
    $breadcrumb_author = str_replace( array_keys( $replacement ), array_values( $replacement), get_theme_mod ( 'sketchpad_breadcrumb_other_author_template', sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::AUTHOR ) ) );

    $breadcrumb_content += 1;
    $breadcrumb_temp .= $breadcrumb_author;
    
  // date arvhive
  } elseif ( is_date() ) {
    $year  = get_query_var('year');
    $month = get_query_var('monthnum');
    $day   = get_query_var('day');

    $breadcrumb_date_template = get_theme_mod ( 'sketchpad_breadcrumb_other_date_template', sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::DATE ) );

    if ( $year > 0 ) {
      $replacement = array(
        '%title%'     => $year,
        '%htitle%'    => $year,
        '%link%'      => esc_url( get_year_link( $yaer ) ),
        '%position%'  => $breadcrumb_content,
      );
      $breadcrumb_date = str_replace( array_keys( $replacement ), array_values( $replacement), $breadcrumb_date_template );

      $breadcrumb_content += 1;
      $breadcrumb_temp .= $breadcrumb_date;
    }
    
    if ( $month > 0) {
      $replacement = array(
        '%title%'     => $month,
        '%htitle%'    => $month,
        '%link%'      => esc_url( get_month_link( $year, $month ) ),
        '%position%'  => $breadcrumb_content,
      );
      $breadcrumb_date = str_replace( array_keys( $replacement ), array_values( $replacement), $breadcrumb_date_template );

      $breadcrumb_content += 1;
      $breadcrumb_temp .=  $breadcrumb_separator . $breadcrumb_date;
    }
    
    if ( $day > 0) {
      $replacement = array(
        '%title%'     => $day,
        '%htitle%'    => $day,
        '%link%'      => $breadcurmb_currnet_page_link,
        '%position%'  => $breadcrumb_content,
      );
      $breadcrumb_date = str_replace( array_keys( $replacement ), array_values( $replacement), $breadcrumb_date_template );

      $breadcrumb_content += 1;
      $breadcrumb_temp .=  $breadcrumb_separator . $breadcrumb_date;
    }

  // term archive
  } elseif ( is_archive() ) {
    $term_id   = $wp_obj->term_id;
    $term_name = $wp_obj->name;
    $parent = $wp_obj->parent;
    $taxonomies  = $wp_obj->taxonomy;

    $breadcrumb_taxonomies_template = ( $taxonomies == 'category' ) ? get_theme_mod ( 'sketchpad_breadcrumb_taxonomies_category_template', sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::CATEGORY ) ) : get_theme_mod ( 'sketchpad_breadcrumb_taxonomies_tag_template', sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::TAG ) ) ;

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
        $breadcrumb_taxonomies = str_replace( array_keys( $replacement ), array_values( $replacement), $breadcrumb_taxonomies_template );

        $breadcrumb_content += 1;
        $breadcrumb_temp .= $breadcrumb_taxonomies . $breadcrumb_separator;
      }
    }

    $taxonomies_name = esc_html( $term_name );
    $replacement = array(
      '%title%'     => $taxonomies_name,
      '%htitle%'    => $taxonomies_name,
      '%link%'      => $breadcurmb_currnet_page_link,
      '%position%'  => $breadcrumb_content,
    );
    $breadcrumb_taxonomies = str_replace( array_keys( $replacement ), array_values( $replacement), $breadcrumb_taxonomies_template );

    $breadcrumb_content += 1;
    $breadcrumb_temp .= $breadcrumb_taxonomies;

  // search result
  } elseif ( is_search() || is_404 ) {
    $page_title = esc_html( get_search_query() );
    $replacement = array(
      '%title%'     => $page_title,
      '%htitle%'    => $page_title,
      '%link%'      => $breadcrumb_current_page_link,
      '%position%'  => $breadcrumb_content,
    );
    $breadcrumb_search_result = str_replace( array_keys( $replacement ), array_values( $replacement), get_theme_mod ( 'sketchpad_breadcrumb_other_search_template', sketchpad_sanitize_breadcrumb_template( SmBreadcrumbConstantClass::SEARCH ) ) );

    $breadcrumb_content += 1;
    $breadcrumb_temp .= $breadcrumb_search_result;
  }

  // close tag
  $breadcrumb_temp .= sketchpad_sanitize_breadcrumb_template( get_theme_mod( 'sketchpad_breadcrumb_close_tag', SmBreadcrumbConstantClass::CLOSE_TAG ) );

  echo $breadcrumb_temp;
}

add_action( 'sketchpad_modified_breadcrumb', 'sketchpad_breadcrumb' );
