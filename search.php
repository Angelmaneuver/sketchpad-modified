<?php
/**
 * The template for displaying Search Results pages
 *
 * @package sketchpad
 * @since   1.0.0
 */

get_header(); ?>
	<main id="articles">
		<?php do_action( 'sketchpad_modified_breadcrumb' ); ?>
		<h2 class="page-title">
		<?php
		esc_html_e( 'Search results for: ', 'sketchpad-modified' );
		echo '&laquo;', get_search_query(), '&raquo;';
		?>
		</h2>
		<?php
		get_template_part(
			'template/articles',
			'',
			array(
				'not_articles_post_title' => __( 'Sorry, no results for your search request...', 'sketchpad-modified' ),
				'not_articles_message'    => __( 'Try to search again', 'sketchpad-modified' ),
			)
		);
		?>
	</main>
<?php
get_sidebar();
get_footer();
