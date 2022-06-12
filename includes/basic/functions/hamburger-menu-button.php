<?php
/**
 * Hamburger menu button function.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * These modules are needed to load this function.
 */
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-hamburger-menu-button-initializer.php';

/**
 * Scripts and styles enqueue process.
 *
 * @return void
 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 */
function sketchpad_output_hamburger_menu_button_script() {
	wp_register_style(
		'sketchpad-hamburger-menu-button-style',
		get_template_directory_uri() . '/assets/stylesheets/css/theme/hamburger_menu.min.css',
		array(),
		(string) filemtime( get_template_directory() . '/assets/stylesheets/css/theme/hamburger_menu.min.css' ),
		'screen'
	);

	$background_color       = SM_Hamburger_Menu_Button_Initializer::get_sketchpad_hamburger_menu_button_background_color();
	$hover_background_color = SM_Hamburger_Menu_Button_Initializer::get_sketchpad_hamburger_menu_button_hover_background_color();
	$border_color           = SM_Hamburger_Menu_Button_Initializer::get_sketchpad_hamburger_menu_button_border_color();

	wp_add_inline_style(
		'sketchpad-hamburger-menu-button-style',
		".hamburger{background-color:{$background_color};border-color:{$border_color};} .hamburger:hover{background-color:{$hover_background_color};}"
	);

	wp_enqueue_style( 'sketchpad-hamburger-menu-button-style' );
}

/**
 * Output hamburger menu button html.
 *
 * @since  3.0.0
 * @return void
 */
function sketchpad_output_hamburger_menu_button():void {
	$open_mark  = SM_Hamburger_Menu_Button_Initializer::get_sketchpad_hamburger_menu_button_open_mark();
	$close_mark = SM_Hamburger_Menu_Button_Initializer::get_sketchpad_hamburger_menu_button_close_mark();
	$value      = <<<EOM
<button class="hamburger"><div class="open">{$open_mark}</div><div class="close">{$close_mark}</div></button>

EOM;

	hazardous_echo( $value );
}

if ( SM_Return2Top_Button_Initializer::is_enable_sketchpad_return2top_button() ) {
	add_action( 'wp_enqueue_scripts', 'sketchpad_output_hamburger_menu_button_script' );
	add_filter( 'wp_footer', 'sketchpad_output_hamburger_menu_button' );
}
