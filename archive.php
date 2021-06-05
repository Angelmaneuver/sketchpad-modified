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
		<h2 class="page-title">
			<?php the_archive_title(); ?>
		</h2>
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;
			?>
			<div class="pagination"><!--page pagination-->
				<?php
				global $wp_query;
				$big = 999999999; // need an unlikely integer.
				the_paginate_links(
					array(
						'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'    => '?paged=%#%',
						'current'   => max( 1, get_query_var( 'paged' ) ),
						'total'     => $wp_query->max_num_pages,
						'prev_text' => '&laquo;',
						'next_text' => '&raquo;',
					)
				);
				?>
			</div><!--.pagination-->
		<?php else : ?>
			<article <?php post_class(); ?>>
				<header>
					<h3 class="post-title"><?php esc_html_e( 'Not Found...', 'sketchpad-modified' ); ?></h3>
				</header>
				<p><?php esc_html_e( 'Try using the search form', 'sketchpad-modified' ); ?></p>
				<?php echo get_search_form(); ?>
			</article>
		<?php endif; /*have_posts*/ ?>
	</main>
<?php
get_sidebar();
get_footer();
