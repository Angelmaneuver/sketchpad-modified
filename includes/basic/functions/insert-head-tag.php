<?php
/**
 * Add an element to the head tag function.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * These modules are needed to load this function.
 */
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-insert-head-tag-initializer.php';

/**
 * Add an element to the head tag.
 *
 * @since  3.0.0
 * @return void
 */
function sketchpad_head_insert_head():void {
	$insert_head = SM_Insert_Head_Tag_Initializer::get_sketchpad_insert_head_html();

	if ( '' !== $insert_head ) {
		$value = <<<EOM
{$insert_head}

EOM;
		hazardous_echo( $value );
	}
}

$insert_head_priority = SM_Insert_Head_Tag_Initializer::get_sketchpad_insert_priority();

add_filter( 'wp_head', 'sketchpad_head_insert_head', $insert_head_priority );
add_filter( 'admin_head', 'sketchpad_head_insert_head', $insert_head_priority );
add_filter( 'embed_head', 'sketchpad_head_insert_head', $insert_head_priority );
