<?php
/**
 * The template for displaying Archive pages
 *
 * @package sketchpad
 * @since   1.0.0
 */

get_header(); ?>
	<main id="articles">
		<?php do_action( 'sketchpad_modified_breadcrumb' ); ?>
		<h2 class="page-title"><?php the_archive_title(); ?></h2>
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
