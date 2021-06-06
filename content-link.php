<?php
/**
 * The template for displaying the Link content
 *
 * @package sketchpad
 * @since   1.0.0
 */

?>
<article <?php post_class(); ?>>
	<header>
		<div class="post-header">
			<h3 class="post-title">
				<?php
				if ( is_singular() ) {
					the_title();
				} else {
					the_esc_html_a( '<a href="' . get_permalink() . '">' . get_the_title() . '</a>' );
				}
				?>
			</h3>
		</div><!--.post-header-->
		<div class="post-meta">
			<span>
				<time class="post-date" datetime="<?php the_time( 'Y-m-d' ); ?>">
					<?php
					if ( is_singular() ) {
						printf( '<a href="%1$s" title="%2$s">%3$s</a>', esc_url( ( is_singular() ) ? get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) : get_the_permalink() ), the_title_attribute( 'echo=0' ), get_the_date() );
					} else {
						the_esc_html_a( '<a href="' . get_permalink() . '">' . get_the_date() . '</a>' );
					}
					?>
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
			the_post_thumbnail( 'featured-image' );
		} else {
			if ( has_post_thumbnail() ) {
				?>
				<a class="thumb-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
				<?php
			}
		}
		the_content();
		?>
	</div><!--.post-content-->
	<footer>
		<?php
		/* post pagination */
		wp_link_pages(
			array(
				'before' => '<div class="pagination">' . __( 'Pages:', 'sketchpad-modified' ),
				'after'  => '</div>',
			)
		);
		if ( ! is_singular() && ( get_comments_number() > 0 ) ) {
			?>
			<div class="post-footer">
				<a class="comments-link" href="<?php the_permalink(); ?>#comments">
				<?php
				esc_html_e( 'read comments', 'sketchpad-modified' );
				echo esc_html( ' (' . ( get_comments_number() ) . ')' );
				?>
				</a>
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
