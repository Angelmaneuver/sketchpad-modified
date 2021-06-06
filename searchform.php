<?php
/**
 * The template for displaying search form
 *
 * @package sketchpad
 * @since   1.9.0
 */

?>
<form class="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input class="search-text" size="17" type="search" name="s" placeholder="<?php esc_attr_e( 'Enter search keyword', 'sketchpad-modified' ); ?>" value="<?php the_search_query(); ?>">
	<input class="search-button" type="submit" value="<?php esc_html_e( 'search', 'sketchpad-modified' ); ?>">
</form>
