<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @subpackage Sketchpad
 * @since      Sketchpad 1.7
 */

get_header(); ?>
	<main>
		<article <?php post_class(); ?>>
			<header>
				<h3 class="post-title"><?php _e( 'Page not Found...', 'sketchpad-modified' ); ?></h3>
			</header>
			<p><?php _e( 'Try using the search form', 'sketchpad-modified' ); ?></p>
			<?php echo get_search_form(); ?>
		</article>
	</main>
<?php get_sidebar();
get_footer();
