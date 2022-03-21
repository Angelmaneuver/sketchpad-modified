<?php
/**
 * Block patterns.
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
		'header' => array( 'label' => 'Headers' ),
		'footer' => array( 'label' => 'Footers' ),
		'query'  => array( 'label' => 'Query' ),
		'pages'  => array( 'label' => 'Pages' ),
		'frame'  => array( 'label' => __( 'Frames', 'sketchpad-modified' ) ),
	);

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}

	$block_patterns = array(
		'header-logo',
		'header1',
		'header2',
		'contents',
		'contents-main',
		'sidebar',
	);

	foreach ( $block_patterns as $block_pattern ) {
		$pattern_file = get_theme_file_path( '/includes/block/pattern/' . $block_pattern . '.php' );

		register_block_pattern(
			'sketchpad-modified/' . $block_pattern,
			require $pattern_file
		);
	}
};

add_action( 'admin_init', 'register_sketchpad_block_patterns' );
