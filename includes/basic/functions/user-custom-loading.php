<?php
/**
 * User custom loading function.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * User custom stylesheets enqueue process.
 *
 * @return void
 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 */
function sketchpad_user_custom_style() {
	$base_url  = get_template_directory_uri() . '/user/css/';
	$base_path = get_template_directory() . '/user/css/';
	$settings  = require get_template_directory() . '/user/css/settings.php';

	foreach ( $settings as $setting ) {
		$handle     = isset( $setting['handle'] ) ? $setting['handle'] : '';
		$filename   = isset( $setting['filename'] ) ? $setting['filename'] : '';
		$media      = isset( $setting['media'] ) ? $setting['media'] : 'all';
		$target_url = isset( $setting['target_url'] ) ? $setting['target_url'] : 'all';

		if ( empty( $handle ) ) {
			continue;
		}

		if ( empty( $filename ) ) {
			continue;
		}

		if ( ! file_exists( $base_path . $filename ) ) {
			continue;
		}

		if ( 'all' !== $target_url && ! strpos( get_the_permalink(), strtolower( rawurlencode( $target_url ) ) ) ) {
			continue;
		}

		wp_enqueue_style(
			$handle,
			$base_url . $filename,
			array(),
			(string) filemtime( $base_path . $filename, ),
			$media
		);
	}
}

add_action( 'wp_enqueue_scripts', 'sketchpad_user_custom_style' );
