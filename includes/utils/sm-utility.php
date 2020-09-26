<?php
/**
 * Utility.
 *
 * @package sketchpad - modified
 * @subpackage utils
 * @since 1.0.0
 */

/**
 * get current url.
 *
 */
function sketchpad_get_current_url() {
	return home_url() . $_SERVER['REQUEST_URI'];
}

/**
 * content to more read convert.
 *
 * @param string $post_content Post Content.
 * @param string $link         Post link.
 */
function sketchpad_content2more_read( $post_content, $link ) {
  $more_text = esc_html( __('more &raquo;', 'sketchpad-modified' ) );
  $split_content = get_extended( $post_content );
  $content = wp_strip_all_tags( $split_content['main'] );
  if ( $split_content['extended'] !== "" ) {
    $content = <<< EOM
    {$content} <a href="{$link}">{$more_text}</a>
EOM;
  }

  return $content;
}

/**
 * color code to rgba convert.
 *
 * @param string $color_code Color code.
 */
function sketchpad_color_code2rgba( $color_code ) {
  $hex = preg_replace( '/#/', '', $color_code );
  $rgba['red']   = hexdec( substr( $hex, 0, 2 ) );
  $rgba['green'] = hexdec( substr( $hex, 2, 2 ) );
  $rgba['blue']  = hexdec( substr( $hex, 4, 2 ) );

  return $rgba;
}
