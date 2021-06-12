<?php
/**
 * Sketchpad - modified Admin page setting.
 *
 * @package    sketchpad
 * @subpackage sm-basic
 * @since      2.1.0
 */

/**
 * Insert a admin style.
 *
 * @since 2.1.0
 */
function sketchpad_admin_style() {
	$image_url = get_theme_mod( 'sketchpad_admin_page_background_image_url', null );
	$opacity   = get_theme_mod( 'sketchpad_admin_page_background_image_opacity', 0.5 );
	$rgba      = implode( ',', sketchpad_color_code2rgba( get_theme_mod( 'sketchpad_admin_page_background_image_color', Sm_Basic_Constant::ADMIN_BACKGROUND_COLOR ) ) );
	$targets   = get_theme_mod( 'sketchpad_admin_background_image_opacity_targets', Sm_Basic_Constant::ADMIN_BACKGROUND_OPACITY_TARGETS );

	if ( get_theme_mod( 'sketchpad_admin_page_background_image', false ) && ! empty( $image_url ) ) {
		$value = <<<EOM
<style type="text/css">
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
	</style>

EOM;
		hazardous_e( $value );
	}
}

/**
 * Additional loading script.
 *
 * @since 2.1.0
 */
function sketchpad_admin_page_setting_control_js() {
	wp_enqueue_script(
		'sm-admin-page-setting-control',
		get_template_directory_uri() . '/js/sm-admin-page-setting-control.js',
		array(
			'jquery',
			'customize-controls',
		),
		(string) filemtime( get_template_directory() . '/js/sm-admin-page-setting-control.js' ),
		'all'
	);
}

/**
 * Add a nonce for this theme customizer.
 *
 * @since 2.1.0
 * @param string[] $nonces Array of refreshed nonces for save and preview actions.
 * @see   https://developer.wordpress.org/reference/hooks/customize_refresh_nonces/
 */
function sketchpad_refresh_nonces_admin_background_reset( $nonces ) {
	$nonces['sketchpad-modified-admin-background-reset'] = wp_create_nonce( 'sketchpad-modified-admin-background-reset' );
	return $nonces;
}

/**
 * Ajax handler for reset buttons.
 *
 * @since 2.1.0
 */
function sketchpad_ajax_admin_background_reset() {
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
			$value = Sm_Basic_Constant::ADMIN_BACKGROUND_COLOR;
			break;
		case 'sketchpad_admin_background_image_opacity_reset_button':
			$key   = 'sketchpad_admin_page_background_image_opacity';
			$value = 0.5;
			break;
		case 'sketchpad_admin_background_image_opacity_targets_reset_button':
			$key   = 'sketchpad_admin_background_image_opacity_targets';
			$value = Sm_Basic_Constant::ADMIN_BACKGROUND_OPACITY_TARGETS;
			break;
	}

	$data = wp_json_encode( array( $key => $value ) );

	wp_send_json_success( array( 'data' => $data ) );
}

add_action( 'admin_print_styles', 'sketchpad_admin_style' );
add_action( 'customize_controls_enqueue_scripts', 'sketchpad_admin_page_setting_control_js' );
add_action( 'wp_ajax_sketchpad_ajax_admin_background_reset', 'sketchpad_ajax_admin_background_reset' );

add_filter( 'customize_refresh_nonces', 'sketchpad_refresh_nonces_admin_background_reset' );
