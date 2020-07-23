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
			'label'					=> __( 'Under Line', 'sketchpad-modified' ),
		)
	);
	register_block_style(
		'core/heading',
		array(
			'name'					=> 'mtb0',
			'label'					=> __( 'Close the gap between the two', 'sketchpad-modified' ),
		)
	);
	register_block_style(
		'core/heading',
		array(
			'name'					=> 'mt0',
			'label'					=> __( 'Close the gap to the top', 'sketchpad-modified' ),
		)
	);

	// paragraph
	register_block_style(
		'core/paragraph',
		array(
			'name'					=> 'mb0',
			'label'					=> __( 'Close the gap between the two', 'sketchpad-modified' ),
		)
	);

	// image
	register_block_style(
		'core/image',
		array(
			'name'					=> 'image-postit',
			'label'					=> __( 'Postit', 'sketchpad-modified' ),
		)
	);

	// group
	register_block_style(
		'core/group',
		array(
			'name'					=> 'indent',
			'label'					=> __( 'Indent', 'sketchpad-modified' ),
		)
	);
};

add_action( 'init', 'register_sketchpad_common_block_style' );