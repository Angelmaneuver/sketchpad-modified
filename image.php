<?php
/**
 * The template for displaying all single images posts.
 *
 * @package sketchpad
 * @since   1.0.0
 */

get_header(); ?>
	<main>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<header>
					<?php
					if ( is_singular() ) {
						do_action( 'sketchpad_modified_breadcrumb' );
					}
					?>
					<div class="post-header">
						<h3 class="post-title"><?php the_title(); ?></h3>
					</div><!--.post-header-->
					<div class="post-meta">
						<span>
							<time class="post-date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php echo get_the_date(); ?></time>
							<?php edit_post_link( __( 'edit', 'sketchpad-modified' ) ); ?>
						</span>
						<span class="by-author">
							<?php
							esc_html_e( 'posted by ', 'sketchpad-modified' );
							the_author_posts_link();
							if ( has_category() ) {
								esc_html_e( ' in ', 'sketchpad-modified' );
								the_category( ', ' );
							}
							?>
						</span>
					</div><!--.post-meta-->
				</header>
				<div class="post-content">
					<p>
						<?php
						$metadata = wp_get_attachment_metadata();
						the_esc_html_a(
							sprintf(
								/* translators: %s: image size */
								__( 'Full size is %s pixels', 'sketchpad-modified' ),
								sprintf(
									/* translators: %1$s: full size image url, %2$s: title, %3$s: image width, %4$s: image height */
									'<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
									wp_get_attachment_url(),
									esc_attr( __( 'Link to full-size image', 'sketchpad-modified' ) ),
									$metadata['width'],
									$metadata['height']
								)
							)
						);
						?>
					</p>
					<div class="attachment">
						<a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" title="<?php the_title_attribute( array( 'before' => __( 'Click to full-size image: ', 'sketchpad-modified' ) ) ); ?>" rel="attachment">
							<?php echo wp_get_attachment_image( $post->ID, 'large' ); ?>
						</a>
						<?php
						if ( has_excerpt() ) {
							the_excerpt();
						} else {
							the_content();
						}
						?>
					</div>
					<div class="pagination"> <!--Attachments navigation-->
						<?php
						previous_image_link( false, '&laquo; ' . __( 'Previous Image', 'sketchpad-modified' ) . '' );
						echo '&nbsp;';
						next_image_link( false, '' . __( 'Next Image', 'sketchpad-modified' ) . ' &raquo;' );
						?>
					</div>
				</div><!--.post-content-->
				<footer>
					<?php
					wp_link_pages(
						array( /* post pagination */
							'before' => '<div class="pagination">' . __( 'Pages:', 'sketchpad-modified' ),
							'after'  => '</div>',
						)
					);
					/* display if has tags */
					if ( has_tag() ) {
						echo '<div class="post-tag">';
						the_tags( __( 'Tags: ', 'sketchpad-modified' ), ' ' );
						echo '</div>';
					}
					?>
				<div class="post-navigation">
					<div class="prev-post"><?php previous_post_link( '<span>&larr;</span><span>%link</span>' ); ?></div><!--Previous post navigation-->
					<div class="next-post"><?php next_post_link( '<span>&rarr;</span><span>%link</span>' ); ?></div><!--Next post navigation-->
				</div>
				</footer>
			</article>
			<?php
			comments_template();
		endwhile;
		?>
	</main>
<?php
get_sidebar();
get_footer();
