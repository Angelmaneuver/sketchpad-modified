<?php
/**
 * The template for displaying the content
 * 
 * @subpackage Sketchpad
 * @since      Sketchpad - modified 1.0
 */
?>
<article <?php post_class(); ?>>
	<header>
		<?php if ( is_singular() ) { do_action( 'sketchpad_modified_breadcrumb' ); } ?>
		<div class="post-header">
			<h3 class="post-title">
				<?php if ( is_singular() && ! is_page() ) {
					the_title();
					echo '<span class="r18 fa-stack"><i class="fas fa-ban fa-stack-2x"></i><span class="fa-stack-1x">18</span></span>';
				} elseif ( is_page() ) {
					_e( 'Page: ', 'sketchpad' );
					the_title();
					echo '<span class="r18 fa-stack"><i class="fas fa-ban fa-stack-2x"></i><span class="fa-stack-1x">18</span></span>';
				} else {
					echo '<a href="' . get_permalink() . '">' . get_the_title() . '<span class="r18 fa-stack"><i class="fas fa-ban fa-stack-2x"></i><span class="fa-stack-1x">18</span></span></a>';
				} ?>
			</h3>
		</div><!--.post-header-->
		<div class="post-meta">
			<?php if ( is_page() ) {
				if ( is_singular() ) { ?>
					<time class="post-date" datetime="<?php the_modified_time( 'Y-m-d' ); ?>"><?php echo get_the_modified_date() ?></time>
					<span class="by-author">
					<?php _e( 'posted by ', 'sketchpad' );
					the_author_posts_link();
					if ( has_category() ) {
						_e( ' in ', 'sketchpad' );
						the_category( ', ' );
					} ?>
				</span>
				<?php }
				edit_post_link( __( 'edit', 'sketchpad' ) );
			} else { ?>
				<time class="post-date" datetime="<?php the_time( 'Y-m-d' ); ?>">
					<?php if ( is_singular() ) {
						printf( '<a href="%1$s" title="%2$s">%3$s</a>', esc_url( ( is_singular() ) ? get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) : get_the_permalink() ), the_title_attribute( 'echo=0' ), get_the_date() );
					} else {
						echo '<a href="' . get_permalink() . '">' . get_the_date() . '</a>';
					} ?>
				</time>
				<?php edit_post_link( __( 'edit', 'sketchpad' ) ); ?>
				<span class="by-author">
					<?php _e( 'posted by ', 'sketchpad' );
					the_author_posts_link();
					if ( has_category() ) {
						_e( ' in ', 'sketchpad' );
						the_category( ', ' );
					} ?>
				</span>
			<?php } ?>
		</div><!--.post-meta-->
	</header>
	<div class="post-content">
		<?php if ( is_singular() ) {
			the_content();
		} else {
			if ( has_post_thumbnail() ) { ?>
				<div class="thumb-box"><a class="thumb-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a></div>
			<?php }
			the_excerpt();
		} ?>
	</div><!--.post-content-->
	<footer>
		<?php /*post pagination*/
		wp_link_pages( array(
			'before' => '<div class="pagination">' . __( 'Pages:', 'sketchpad' ),
			'after'  => '</div>',
		) );
		if ( ! is_singular() ) { ?>
			<div class="post-footer">
				<?php if ( get_comments_number() > 0 ) { ?>
					<a class="comments-link" href="<?php the_permalink(); ?>#comments"><?php _e( 'read comments', 'sketchpad' );
						echo ' (' . ( get_comments_number() ) . ')'; ?></a>
				<?php } ?>
				<a class="more-link" href="<?php the_permalink(); ?>"><?php _e( 'more', 'sketchpad' ) ?> &raquo;</a>
			</div><!--.post-footer-->
		<?php }
		if ( has_tag() ) { /* display if has tags */
			echo '<div class="post-tag">';
			the_tags( __( 'Tags: ', 'sketchpad' ), ' ' );
			echo '</div>';
		} ?>
	</footer>
</article>
