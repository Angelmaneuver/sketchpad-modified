<?php
/**
 * Sketchpad - modified Basic option Common Block Style Functions and definitions.
 *
 * @subpackage Sketchpad - modified 1.0
 * @since      Sketchpad - modified 1.0
 */

// custom block style register
function register_sketchpad_common_block_style() {
	// heading
	register_block_style(
		'core/heading',
		array(
			'name'					=> 'under-line',
			'label'					=> __( 'Under Line' ),
		)
	);

	// paragraph
	register_block_style(
		'core/paragraph',
		array(
			'name'					=> 'mb0',
			'label'					=> __( 'Close the gap between the two' ),
		)
	);

	// image
	register_block_style(
		'core/image',
		array(
			'name'					=> 'image-postit',
			'label'					=> __( 'Postit' ),
		)
	);
};

add_action( 'init', 'register_sketchpad_common_block_style' );
