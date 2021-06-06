<?php
/**
 * The template for articles
 *
 * @package sketchpad
 * @since   2.1.0
 */

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
			<h3 class="post-title"><?php echo esc_html( $args['not_articles_post_title'] ); ?></h3>
		</header>
		<p><?php echo esc_html( $args['not_articles_message'] ); ?></p>
		<?php echo get_search_form(); ?>
	</article>
<?php endif; /* have_posts */ ?>
