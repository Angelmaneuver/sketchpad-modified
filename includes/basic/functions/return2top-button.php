<?php
/**
 * Return to top button function.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * These modules are needed to load this function.
 */
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-return2top-button-initializer.php';

/**
 * Scripts and styles enqueue process.
 *
 * @return void
 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 */
function sketchpad_output_return2top_button_script() {
	wp_register_style(
		'sketchpad-return2top-style',
		get_template_directory_uri() . '/assets/stylesheets/css/theme/return2top.min.css',
		array(),
		(string) filemtime( get_template_directory() . '/assets/stylesheets/css/theme/return2top.min.css' ),
		'all'
	);

	$background_color       = SM_Return2Top_Button_Initializer::get_sketchpad_return2top_button_background_color();
	$hover_background_color = SM_Return2Top_Button_Initializer::get_sketchpad_return2top_button_hover_background_color();
	$border_color           = SM_Return2Top_Button_Initializer::get_sketchpad_return2top_button_border_color();

	wp_add_inline_style(
		'sketchpad-return2top-style',
		".return2top{background-color:{$background_color};border-color:{$border_color};} .return2top:hover{background-color:{$hover_background_color};}"
	);

	wp_enqueue_style( 'sketchpad-return2top-style' );

	wp_enqueue_script(
		'sketchpad-return2top-script',
		get_template_directory_uri() . '/assets/js/sketchpad-return2top.js',
		array( 'jquery' ),
		(string) filemtime( get_template_directory() . '/assets/js/sketchpad-return2top.js' ),
		true
	);
}

/**
 * Output return to top button html.
 *
 * @since  3.0.0
 * @return void
 */
function sketchpad_output_return2top_button():void {
	$mark  = SM_Return2Top_Button_Initializer::get_sketchpad_return2top_button_mark();
	$value = <<<EOM
<button class="return2top">{$mark}</button>

EOM;

	hazardous_echo( $value );
}

if ( SM_Return2Top_Button_Initializer::is_enable_sketchpad_return2top_button() ) {
	add_action( 'wp_enqueue_scripts', 'sketchpad_output_return2top_button_script' );
	add_filter( 'wp_footer', 'sketchpad_output_return2top_button' );
}
