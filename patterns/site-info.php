<?php
/**
 * Title:       Site Info
 * Slug:        sketchpad-modified/site-info
 * Inserter:    yes
 * Categories:  footer
 * Keywords:    site info
 * Block Types: sketchpad-modified/site-info
 *
 * @package  Sketchpad
 * @since    3.0.0
 */

?>

<span>
	<?php echo esc_html( '&copy; ' . date_i18n( 'Y ' ) . get_bloginfo( 'name' ) ); ?>
	<span class="developer"><?php echo sprintf( 'Powered by %s', '<a href = "' . esc_url( 'https://github.com/Angelmaneuver/sketchpad-modified' ) . '" target="_blank" rel="noopener noreferrer">Angelmaneuver</a>' ); ?></span>
	<span class="original"><?php echo sprintf( ' (Original is %s) ', '<a href = "' . esc_url( 'https://bestweblayout.com/' ) . '" target="_blank" rel="noopener noreferrer">BestWebLayout</a>' ); ?></span>
	<span class="wordpress"><?php echo sprintf( 'and %s', '<a href = "' . esc_url( 'https://wordpress.org/' ) . '" target="_blank" rel="noopener noreferrer">WordPress</a>' ); ?></span>
</span>
