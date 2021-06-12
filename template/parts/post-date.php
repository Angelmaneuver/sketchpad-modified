<?php
/**
 * The template for parts - post date.
 *
 * @package sketchpad
 * @since   2.1.0
 */

?>
<?php
if ( is_singular() ) {
	printf( '<a href="%1$s" title="%2$s">%3$s</a>', esc_url( ( is_singular() ) ? get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) : get_the_permalink() ), the_title_attribute( 'echo=0' ), get_the_date() );
} else {
	the_esc_html_a( '<a href="' . get_permalink() . '">' . get_the_date() . '</a>' );
}
