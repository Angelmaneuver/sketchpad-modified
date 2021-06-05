<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package sketchpad
 * @since   1.7.0
 */

get_header(); ?>
	<main>
		<article <?php post_class(); ?>>
			<header>
				<h3 class="post-title"><?php esc_html_e( 'Page not Found...', 'sketchpad-modified' ); ?></h3>
			</header>
			<p><?php esc_html_e( 'Try using the search form', 'sketchpad-modified' ); ?></p>
			<?php echo get_search_form(); ?>
		</article>
	</main>
<?php
get_sidebar();
get_footer();
