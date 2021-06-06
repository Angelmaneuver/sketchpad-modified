<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package sketchpad
 * @since   1.7.0
 */

get_header(); ?>
	<main id="articles">
		<?php
		get_template_part(
			'template/articles',
			'',
			array(
				'not_articles_post_title' => __( 'Not Found...', 'sketchpad-modified' ),
				'not_articles_message'    => __( 'Try using the search form', 'sketchpad-modified' ),
			)
		);
		?>
	</main>
<?php
get_sidebar();
get_footer();
