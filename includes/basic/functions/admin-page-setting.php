<?php
/**
 * Admin page customize function.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      2.1.0
 */

/**
 * These modules are needed to load this function.
 */
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-admin-page-setting-initializer.php';

/**
 * Return the Style for admin panel.
 *
 * @since  3.0.0
 * @return string
 */
function get_sketchpad_admin_page_background_style():string {
	$image_url = SM_Admin_Page_Setting_Initializer::get_image_url();
	$rgba      = SM_Admin_Page_Setting_Initializer::get_rgba();
	$opacity   = SM_Admin_Page_Setting_Initializer::get_opacity();
	$targets   = SM_Admin_Page_Setting_Initializer::get_opacity_targets();

	return <<<EOM
#wpwrap:before {
	content:" ";
	position: fixed;
	top: 0;
	left: 0;
	width:100%;
	height:100%;
	background-image:
		linear-gradient(rgba({$rgba}, {$opacity}), rgba({$rgba}, {$opacity})), url("{$image_url}");
		background-repeat: no-repeat;
	background-size: cover;
}
{$targets} {
	background-color: rgba(255, 255, 255, 0) !important;
}
EOM;
}

/**
 * Admin page styles enqueue.
 *
 * @since  3.0.0
 * @return void
 */
function sketchpad_admin_page_background_style():void {
	wp_add_inline_style( 'sketchpad-admin-style', get_sketchpad_admin_page_background_style() );
}

if ( SM_Admin_Page_Setting_Initializer::is_admin_page_background() ) {
	add_action( 'admin_enqueue_scripts', 'sketchpad_admin_page_background_style' );
}

/**
 * Enqueue the additional JavaScript for the admin panel.
 *
 * @since  2.1.0
 * @return void
 */
function sketchpad_admin_page_setting_control_js():void {
	wp_enqueue_script(
		'sm-admin-page-setting-control',
		get_template_directory_uri() . '/assets/js/sm-admin-page-setting-control.js',
		array(
			'jquery',
			'customize-controls',
		),
		(string) filemtime( get_template_directory() . '/assets/js/sm-admin-page-setting-control.js' ),
		'all'
	);
}

add_action( 'customize_controls_enqueue_scripts', 'sketchpad_admin_page_setting_control_js' );

/**
 * Add a nonce for this theme customizer.
 *
 * @since  2.1.0
 * @param  string[] $nonces Array of refreshed nonces for save and preview actions.
 * @return string[] Array of refreshed nonces for save and preview actions.
 * @see             https://developer.wordpress.org/reference/hooks/customize_refresh_nonces/
 */
function sketchpad_refresh_nonces_admin_background_reset( array $nonces ):array {
	$nonces['sketchpad-modified-admin-background-reset'] = wp_create_nonce( 'sketchpad-modified-admin-background-reset' );
	return $nonces;
}

add_action( 'wp_ajax_sketchpad_ajax_admin_background_reset', 'sketchpad_ajax_admin_background_reset' );

/**
 * Ajax handler for reset buttons.
 *
 * @since  2.1.0
 * @return void
 */
function sketchpad_ajax_admin_background_reset():void {
	check_ajax_referer( 'sketchpad-modified-admin-background-reset', 'security', true );

	if ( ! current_user_can( 'edit_theme_options' ) || ! isset( $_POST['id'] ) || empty( $_POST['id'] ) ) {
		wp_die( -1 );
	}

	$id    = sanitize_text_field( wp_unslash( $_POST['id'] ) );
	$key   = null;
	$value = null;

	switch ( $id ) {
		case 'sketchpad_admin_background_image_color_reset_button':
			$key   = 'sketchpad_admin_page_background_image_color';
			$value = SM_Admin_Page_Setting_Initializer::DEFAULT_ADMIN_BACKGROUND_COLOR;
			break;
		case 'sketchpad_admin_background_image_opacity_reset_button':
			$key   = 'sketchpad_admin_page_background_image_opacity';
			$value = SM_Admin_Page_Setting_Initializer::DEFAULT_ADMIN_BACKGROUND_OPACITY;
			break;
		case 'sketchpad_admin_background_image_opacity_targets_reset_button':
			$key   = 'sketchpad_admin_background_image_opacity_targets';
			$value = SM_Admin_Page_Setting_Initializer::DEFAULT_OPACITY_TARGETS;
			break;
	}

	$data = wp_json_encode( array( $key => $value ) );

	wp_send_json_success( array( 'data' => $data ) );
}

add_filter( 'customize_refresh_nonces', 'sketchpad_refresh_nonces_admin_background_reset' );
