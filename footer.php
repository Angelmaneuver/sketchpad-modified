<?php
/**
 * The template for displaying the footer
 *
 * @subpackage Sketchpad
 * @since      Sketchpad 1.7
 */
?>
</div><!--.content-->
<footer>
	<div class="footer">
		<div class="site-info">
			<span class="left">
				<?php echo '&copy; ' . date_i18n( 'Y ' ) . get_bloginfo( 'name' ); ?>
			</span>
			<span class="right">
				<?php printf( __( 'Powered by %s (Original is %s) and %s', 'sketchpad' ), '<a href = "' . esc_url( wp_get_theme()->get( 'Author URI' ) ) . '" target="_blank" rel="noopener noreferrer">' . esc_html( wp_get_theme()->get( 'Author' ) ). '</a>', '<a href = "' . esc_url( 'https://bestweblayout.com/' ) . '" target="_blank" rel="noopener noreferrer">BestWebLayout</a>', '<a href = "' . esc_url( 'https://wordpress.org/' ) . '" target="_blank" rel="noopener noreferrer">WordPress</a>' ); ?>
			</span>
		</div><!--.site-info-->
	</div><!--.footer-->
</footer>
</div><!--#wrapper-->
</div><!--#main-->
<?php wp_footer(); ?>
</body>
</html>
