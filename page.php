<?php
/**
 * The template for displaying all pages
 *
 * @package sketchpad
 * @since   1.7.0
 */

get_header(); ?>
	<main>
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'content', get_post_format() );
			comments_template();
		endwhile;
		?>
	</main>
<?php
get_sidebar();
get_footer();
