<?php
/**
 * Add an element to the body tag function.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * These modules are needed to load this function.
 */
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-insert-body-tag-initializer.php';

/**
 * Add an element to the body tag.
 *
 * @since  3.0.0
 * @return void
 */
function sketchpad_body_insert_body():void {
	$insert_body_directly_under = SM_Insert_Body_Tag_Initializer::get_sketchpad_insert_body_html();

	if ( '' !== $insert_body_directly_under ) {
		$value = <<<EOM
{$insert_body_directly_under}

EOM;
		hazardous_echo( $value );
	}
}

$insert_body_priority = SM_Insert_Body_Tag_Initializer::get_sketchpad_insert_priority();

add_filter( 'wp_body_open', 'sketchpad_body_insert_body', $insert_body_priority );
