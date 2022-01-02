<?php
/**
 * Sketchpad - modified Block style.
 *
 * @package    sketchpad
 * @subpackage sm-style
 * @since      2.1.0
 */

/**
 * Custom block style register.
 */
function register_sketchpad_block_style() {
	// @codingStandardsIgnoreStart

	// heading.
	register_block_style( 'core/heading', array( 'name' => 'under-line',  'label' => __( 'Under Line', 'sketchpad-modified' ) ) );
	register_block_style( 'core/heading', array( 'name' => 'mtb0',        'label' => __( 'Close the gap between the two', 'sketchpad-modified' ) ) );
	register_block_style( 'core/heading', array( 'name' => 'mt0',         'label' => __( 'Close the gap to the top', 'sketchpad-modified' ) ) );
	register_block_style( 'core/heading', array( 'name' => 'h5',          'label' => __( 'Font style h5', 'sketchpad-modified' ) ) );
	register_block_style( 'core/heading', array( 'name' => 'h5-and-mtb0', 'label' => __( 'Font sytle h5 and close the gap between the two', 'sketchpad-modified' ) ) );
	register_block_style( 'core/heading', array( 'name' => 'h5-and-mt0',  'label' => __( 'Font sytle h5 and close the gap to the top', 'sketchpad-modified' ) ) );

	// paragraph.
	register_block_style( 'core/paragraph', array( 'name' => 'mb0',                           'label' => __( 'Close the gap between the two', 'sketchpad-modified' ) ) );
	register_block_style( 'core/paragraph', array( 'name' => 'text-indent',                   'label' => __( 'Single character indentation', 'sketchpad-modified' ) ) );
	register_block_style( 'core/paragraph', array( 'name' => 'single-character-line-spacing', 'label' => __( 'Open one character between line', 'sketchpad-modified' ) ) );
	register_block_style( 'core/paragraph', array( 'name' => 'black-border',                  'label' => __( 'Black single line', 'sketchpad-modified' ) ) );
	register_block_style( 'core/paragraph', array( 'name' => 'black-double-border',           'label' => __( 'Black double line', 'sketchpad-modified' ) ) );
	register_block_style( 'core/paragraph', array( 'name' => 'r18-paragraph',                 'label' => __( 'Change the display to R18.', 'sketchpad-modified' ) ) );

	// image.
	register_block_style( 'core/image', array( 'name' => 'image-postit', 'label' => __( 'Postit', 'sketchpad-modified' ) ) );

	// columns.
	register_block_style( 'core/columns', array( 'name' => 'mtb0', 'label' => __( 'Close the gap between the two', 'sketchpad-modified' ) ) );

	// group.
	register_block_style( 'core/group', array( 'name' => 'indent', 'label' => __( 'Indent', 'sketchpad-modified' ) ) );

	// @codingStandardsIgnoreEnd
};

add_action( 'init', 'register_sketchpad_block_style' );
