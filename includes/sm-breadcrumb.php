<?php
/**
 * Sketchpad - modified Breadcrumb.
 *
 * @package    sketchpad
 * @subpackage sm-breadcrumb
 * @since      2.1.0
 */

/**
 * These modules are needed to load this function.
 */
require get_template_directory() . '/includes/class/class-sm-breadcrumb.php';

if ( current_user_can( 'edit_theme_options' ) & ( is_admin() || is_customize_preview() ) ) {
	require get_template_directory() . '/includes/admin/theme-customizer/class/class-sm-breadcrumb-initializer.php';
	add_action( 'customize_register', array( new SM_Breadcrumb_Initializer(), 'init' ), 100 );
}

/**
 * Output breadcrumb method wrapper.
 *
 * @since 2.1.0
 */
function sketchpad_breadcrumb() {
	if ( get_theme_mod( 'sketchpad_breadcrumb_output_breadcrumb', false ) && ! ( is_home() || is_front_page() ) ) {
		sketchpad_output_breadcrumb();
	}
}

/**
 * Output breadcrumb.
 *
 * @since 2.1.0
 */
function sketchpad_output_breadcrumb() {
	$wp_obj     = get_queried_object();
	$separator  = sprintf(
		' %s ',
		esc_html( get_theme_mod( 'sketchpad_breadcrumb_separator', SM_Breadcrumb::SEPARATOR ) )
	);
	$breadcrumb = new SM_Breadcrumb(
		$separator,
		sketchpad_sanitize_breadcrumb_template( get_theme_mod( 'sketchpad_breadcrumb_around_the_tag', SM_Breadcrumb::AROUND_THE_TAG ) ),
		sketchpad_sanitize_breadcrumb_template( get_theme_mod( 'sketchpad_breadcrumb_close_tag', SM_Breadcrumb::CLOSE_TAG ) )
	);

	if ( get_theme_mod( 'sketchpad_breadcrumb_output_home', true ) ) {
		$replacement = array(
			'%link%'     => esc_url( home_url() ),
			'%position%' => $breadcrumb->get_layer(),
		);

		$breadcrumb->push(
			str_replace(
				array_keys( $replacement ),
				array_values( $replacement ),
				get_theme_mod( 'sketchpad_breadcrumb_homepage_template', sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::HOME_PAGE ) )
			)
		);
	}

	if ( is_attachment() ) {
		$breadcrumb->regist_link(
			get_theme_mod( 'sketchpad_breadcrumb_media_type_template', sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::MEDIA_TYPE ) ),
			apply_filters( 'the_title', $wp_obj->post_title ),
			apply_filters( 'the_title', $wp_obj->post_title ),
			get_the_permalink()
		);
	} elseif ( is_single() ) {
		$post_id    = $wp_obj->ID;
		$post_type  = $wp_obj->post_type;
		$post_title = apply_filters( 'the_title', $wp_obj->post_title );

		if ( 'post' !== $post_type ) {
			$taxonomies = 'category';
		} else {
			$taxonomies = 'category';
		}

		$terms = get_the_terms( $post_id, $taxonomies );

		if ( count( $terms ) === 1 ) {
			$format = get_theme_mod(
				'sketchpad_breadcrumb_taxonomies_category_template',
				sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::CATEGORY )
			);

			if ( 0 !== $terms[0]->parent ) {
				$tree = array_reverse( get_ancestors( $terms[0]->term_id, $taxonomies ) );

				foreach ( $tree as $term_id ) {
					$name = esc_html( get_term( $term_id, $taxonomies )->name );

					$breadcrumb->regist_link( $format, $name, $name, get_term_link( $term_id, $taxonomies ) );
				}
			}

			$name = $terms[0]->name;
			$breadcrumb->regist_link( $format, $name, $name, get_term_link( $terms[0]->term_id, $taxonomies ) );
		}

		$breadcrumb->regist_link(
			get_theme_mod( 'sketchpad_breadcrumb_post_type_template', sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::POST_TYPE ) ),
			$post_title,
			$post_title,
			get_the_permalink()
		);
	} elseif ( is_page() || is_home() ) {
		$page_id    = $wp_obj->ID;
		$page_title = apply_filters( 'the_title', $wp_obj->post_title );

		if ( 0 !== $wp_obj->post_parent ) {
			$tree = array_reverse( get_post_ancestors( $page_id ) );

			foreach ( $tree as $page_id ) {
				$name = get_the_title( $page_id );

				$breadcrumb->regist_link(
					get_theme_mod( 'sketchpad_breadcrumb_page_type_template', sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::PAGE_TYPE ) ),
					$name,
					$name,
					get_permalink( $page_id )
				);
			}
		}

		$breadcrumb->regist_link(
			get_theme_mod( 'sketchpad_breadcrumb_page_type_template', sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::PAGE_TYPE ) ),
			$page_title,
			$page_title,
			get_the_permalink()
		);
	} elseif ( is_author() ) {
		$title = $wp_obj->display_name;

		$breadcrumb->regist_link(
			get_theme_mod( 'sketchpad_breadcrumb_other_author_template', sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::AUTHOR ) ),
			$title,
			$title,
			get_the_current_url()
		);
	} elseif ( is_date() ) {
		$year   = get_query_var( 'year' );
		$month  = get_query_var( 'monthnum' );
		$day    = get_query_var( 'day' );
		$format = get_theme_mod( 'sketchpad_breadcrumb_other_date_template', sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::DATE ) );

		if ( 0 < $year ) {
			$breadcrumb->regist_link( $format, $year, $year, get_year_link( $year ) );
		}

		if ( 0 < $month ) {
			$breadcrumb->regist_link( $format, $month, $month, get_month_link( $year, $month ) );
		}

		if ( 0 < $day ) {
			$breadcrumb->regist_link( $format, $day, $day, get_day_link( $year, $month, $day ) );
		}
	} elseif ( is_archive() ) {
		$term_id    = $wp_obj->term_id;
		$term_name  = $wp_obj->name;
		$parent     = $wp_obj->parent;
		$taxonomies = $wp_obj->taxonomy;
		$format     = (
			'category' === $taxonomies
			? get_theme_mod(
				'sketchpad_breadcrumb_taxonomies_category_template',
				sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::CATEGORY )
			) : get_theme_mod(
				'sketchpad_breadcrumb_taxonomies_tag_template',
				sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::TAG )
			)
		);

		if ( 0 !== $parent ) {
			$tree = array_reverse( get_ancestors( $term_id, $taxonomies ) );

			foreach ( $tree as $term_id ) {
				$name = get_term( $term_id, $taxonomies )->name;

				$breadcrumb->regist_link( $format, $name, $name, get_term_link( $term_id, $taxonomies ) );
			}
		}

		$breadcrumb->regist_link( $format, $term_name, $term_name, get_the_current_url() );
	} elseif ( is_search() || is_404() ) {
		$title = get_search_query();

		$breadcrumb->regist_link(
			get_theme_mod( 'sketchpad_breadcrumb_other_search_template', sketchpad_sanitize_breadcrumb_template( SM_Breadcrumb::SEARCH ) ),
			$title,
			$title,
			get_the_current_url()
		);
	}

	hazardous_echo( $breadcrumb->get_breadcrumbs() );
}

add_action( 'sketchpad_modified_breadcrumb', 'sketchpad_breadcrumb' );
