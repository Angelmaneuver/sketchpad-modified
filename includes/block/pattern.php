<?php
/**
 * Block pattern.
 *
 * @package    Sketchpad
 * @subpackage block
 * @since      3.0.0
 */

/**
 * Theme block pattern register.
 *
 * @since  3.0.0
 * @return void
 */
function register_sketchpad_block_patterns():void {
	$block_pattern_categories = array(
		'sidebar' => array(
			'label' => __( 'sidebar', 'sketchpad-modified' ),
		),
	);

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}
};

add_action( 'admin_init', 'register_sketchpad_block_patterns' );
