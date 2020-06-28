<?php
/**
 * The template for displaying all single images posts.
 *
 * @subpackage Sketchpad
 * @since      Sketchpad - modified 1.0
 */

get_header(); ?>
	<main>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<header>
					<?php if ( is_singular() ) { do_action( 'sketchpad_modified_breadcrumb' ); } ?>
					<div class="post-header">
						<h3 class="post-title"><?php the_title(); ?></h3>
					</div><!--.post-header-->
					<div class="post-meta">
						<time class="post-date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php echo get_the_date(); ?></time>
						<?php edit_post_link( __( 'edit', 'sketchpad-modified' ) ); ?>
						<span class="by-author">
							<?php _e( 'posted by ', 'sketchpad-modified' );
							the_author_posts_link();
							if ( has_category() ) {
								_e( ' in ', 'sketchpad-modified' );
								the_category( ', ' );
							} ?>
						</span>
					</div><!--.post-meta-->
				</header>
				<div class="post-content">
					<p>
						<?php $metadata = wp_get_attachment_metadata();
						printf( __( 'Full size is %s pixels', 'sketchpad-modified' ),
							sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
								wp_get_attachment_url(),
								esc_attr( __( 'Link to full-size image', 'sketchpad-modified' ) ),
								$metadata['width'],
								$metadata['height']
							)
						); ?>
					</p>
					<div class="attachment">
						<a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" title="<?php the_title_attribute( array( 'before' => __( 'Click to full-size image: ', 'sketchpad-modified' ) ) ); ?>" rel="attachment">
							<?php echo wp_get_attachment_image( $post->ID, 'large' ); ?>
						</a>
						<?php if ( has_excerpt() ) {
							the_excerpt();
						} else {
							the_content();
						} ?>
					</div>
					<div class="pagination"> <!--Attachments navigation-->
						<?php previous_image_link( false, '&laquo; ' . __( 'Previous Image', 'sketchpad-modified' ) . '' );
						echo '&nbsp;';
						next_image_link( false, '' . __( 'Next Image', 'sketchpad-modified' ) . ' &raquo;' ); ?>
					</div>
				</div><!--.post-content-->
				<footer>
					<?php wp_link_pages( array( /*post pagination*/
						'before' => '<div class="pagination">' . __( 'Pages:', 'sketchpad-modified' ),
						'after'  => '</div>',
					) );
					/* display if has tags */
					if ( has_tag() ) {
						echo '<div class="post-tag">';
						the_tags( __( 'Tags: ', 'sketchpad-modified' ) );
						echo '</div>';
					} ?>
					<p class="prev-post"><?php previous_post_link( '&larr;%link' ); ?></p><!--Previous post navigation-->
					<p class="next-post"><?php next_post_link( '%link&rarr;' ); ?></p><!--Next post navigation-->
				</footer>
			</article>
			<?php comments_template();
		endwhile; ?>
	</main>
<?php get_sidebar();
get_footer();
