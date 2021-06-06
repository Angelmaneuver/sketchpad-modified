<?php
/**
 * The template for displaying the footer
 *
 * @package sketchpad
 * @since   2.1.0
 */

?>
<div class="footer">
	<div class="site-info">
		<span class="left"><?php echo esc_html( '&copy; ' . date_i18n( 'Y ' ) . get_bloginfo( 'name' ) ); ?></span>
		<span class="right">
			<?php /* translators: %s: developer site url */ ?>
			<span class="developer"><?php the_esc_html_a( sprintf( __( 'Powered by %s', 'sketchpad-modified' ), '<a href = "' . esc_url( 'https://github.com/Angelmaneuver/sketchpad-modified' ) . '" target="_blank" rel="noopener noreferrer">Angelmaneuver</a>' ) ); ?></span>
			<?php /* translators: %s: original developer site url */ ?>
			<span class="original"><?php the_esc_html_a( sprintf( __( ' (Original is %s) ', 'sketchpad-modified' ), '<a href = "' . esc_url( 'https://bestweblayout.com/' ) . '" target="_blank" rel="noopener noreferrer">BestWebLayout</a>' ) ); ?></span>
			<?php /* translators: %s: WordPress site url */ ?>
			<span class="wordpress"><?php the_esc_html_a( sprintf( __( 'and %s', 'sketchpad-modified' ), '<a href = "' . esc_url( 'https://wordpress.org/' ) . '" target="_blank" rel="noopener noreferrer">WordPress</a>' ) ); ?></span>
		</span>
	</div><!--.site-info-->
</div><!--.footer-->
