<?php
/**
 * The template for parts - headline.
 *
 * @package sketchpad
 * @since   2.1.0
 */

?>
<?php

$headline = (
	( is_singular() && is_page() ? __( 'Page: ', 'sketchpad-modified' ) : '' ) .
	get_the_title() .
	get_theme_mod( 'sketchpad_other_setting_additional_headlines', '' )
);

if ( ! is_singular() ) {
	$headline = '<a href="' . get_permalink() . '">' . $headline . '</a>';

	if ( get_theme_mod( 'sketchpad_other_setting_external_link_enable', false ) ) {
		$headline .= '<a class="external" href="' . get_permalink() . '" rel="noopener" target="_blank"></a>';
	}
}

hazardous_echo( $headline );
