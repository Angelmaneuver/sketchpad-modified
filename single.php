<?php
/**
 * The template for displaying all single posts
 *
 * @subpackage Sketchpad
 * @since      Sketchpad 1.7
 */

get_header(); ?>
	<main>
		<?php while ( have_posts() ) : the_post();
			get_template_part( 'content', get_post_format() ); ?>
			<div class="post-navigation">
				<div class="prev-post"><?php previous_post_link( '<span>&larr;</span><span>%link</span>' ); ?></div><!--Previous post navigation-->
				<div class="next-post"><?php next_post_link( '<span>&rarr;</span><span>%link</span>' ); ?></div><!--Next post navigation-->
			</div>
			<?php comments_template();
		endwhile; ?>
	</main>
<?php get_sidebar();
get_footer();
