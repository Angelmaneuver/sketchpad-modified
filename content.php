<?php
/**
 * The template for displaying the content
 *
 * @package sketchpad
 * @since   1.0.0
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
			<h3 class="post-title">
				<?php
				if ( is_singular() && ! is_page() ) {
					the_title();
					echo '<span class="r18 fa-stack"><i class="fas fa-ban fa-stack-2x"></i><span class="fa-stack-1x">18</span></span>';
				} elseif ( is_page() ) {
					esc_html_e( 'Page: ', 'sketchpad-modified' );
					the_title();
					echo '<span class="r18 fa-stack"><i class="fas fa-ban fa-stack-2x"></i><span class="fa-stack-1x">18</span></span>';
				} else {
					the_esc_html_a( '<a href="' . get_permalink() . '">' . get_the_title() . '<span class="r18 fa-stack"><i class="fas fa-ban fa-stack-2x"></i><span class="fa-stack-1x">18</span></span></a>' );
					the_esc_html_a( '<a class="external" href="' . get_permalink() . '" rel="noopener" target="_blank"></a>' );
				}
				?>
			</h3>
		</div><!--.post-header-->
		<div class="post-meta">
			<?php
			if ( is_page() ) {
				if ( is_singular() ) {
					?>
					<span>
						<time class="post-date" datetime="<?php the_modified_time( 'Y-m-d' ); ?>"><?php the_modified_date(); ?></time>
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
					<?php
				}
			} else {
				?>
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
			<?php } ?>
		</div><!--.post-meta-->
	</header>
	<div class="post-content">
		<?php
		if ( is_singular() ) {
			the_content();
		} else {
			if ( has_post_thumbnail() ) {
				?>
				<div class="thumb-box"><a class="thumb-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a></div>
				<?php
			}
			the_excerpt();
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
					<a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'more', 'sketchpad-modified' ); ?> &raquo;</a>
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
