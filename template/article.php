<?php
/**
 * The template for displaying the other type content
 *
 * @package sketchpad
 * @since   2.1.0
 */

?>
<article <?php post_class(); ?>>
	<header>
		<?php
		if ( is_singular() ) {
			do_action( 'sketchpad_modified_breadcrumb' );
		}
		?>
		<div class="post-header">
			<h3 class="post-title"><?php get_template_part( 'template/parts/headline' ); ?></h3>
		</div><!--.post-header-->
		<div class="post-meta">
			<span>
				<time class="post-date" datetime="<?php the_time( 'Y-m-d' ); ?>">
					<?php get_template_part( 'template/parts/post-date' ); ?>
				</time>
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
		<?php
		if ( is_singular() ) {
			the_content();
		} else {
			if ( $args['excerpt'] ) {
				the_excerpt();
			} else {
				the_content();
			}
		}
		?>
	</div><!--.post-content-->
	<footer>
		<?php
		/* post pagination */
		wp_link_pages(
			array(
				'before' => '<div class="pagination">',
				'after'  => '</div>',
			)
		);
		if ( ! is_singular() ) {
			?>
			<div class="post-footer">
				<span>
					<?php if ( get_comments_number() > 0 ) { ?>
						<a class="comments-link" href="<?php the_permalink(); ?>#comments">
						<?php
						esc_html_e( 'read comments', 'sketchpad-modified' );
						echo esc_html( ' (' . ( get_comments_number() ) . ')' );
						?>
						</a>
					<?php } ?>
				</span>
				<span>
					<?php if ( $args['excerpt'] ) { ?>
						<a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'more', 'sketchpad-modified' ); ?> &raquo;</a>
					<?php } ?>
				</span>
			</div><!--.post-footer-->
			<?php
		}
		if ( has_tag() ) { /* display if has tags */
			echo '<div class="post-tag">';
			the_tags( __( 'Tags: ', 'sketchpad-modified' ), ' ' );
			echo '</div>';
		}
		?>
	</footer>
</article>
