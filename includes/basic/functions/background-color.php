<?php
/**
 * Background color customize function.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * These modules are needed to load this function.
 */
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-color-setting-initializer.php';

/**
 * Return the background color code.
 *
 * @since  3.0.0
 * @return string Background color style.
 */
function get_sketchpad_background_color():string {
	$background_color = SM_Color_Setting_Initializer::get_sketchpad_background_color();

	return "body{background-color:{$background_color};}";
}

/**
 * Styles enqueue.
 *
 * @since  3.0.0
 * @return void
 */
function sketchpad_background_color_style():void {
	wp_add_inline_style( 'sketchpad-style', get_sketchpad_background_color() );
}

/**
 * Editor styles enqueue.
 *
 * @since  3.0.0
 * @return void
 */
function sketchpad_admin_background_color_style():void {
	wp_add_inline_style( 'wp-editor', 'html[dir] ' . get_sketchpad_background_color() );
}

if ( SM_Color_Setting_Initializer::is_set_sketchpad_background_color() ) {
	add_action( 'wp_enqueue_scripts', 'sketchpad_background_color_style' );
}
