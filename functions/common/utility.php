<?php
/**
 * Sketchpad - modified Utility.
 *
 * @subpackage Sketchpad - modified 1.0
 * @since      Sketchpad - modified 1.0
 */

/**
 * Content to More Read Convert.
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
 * Color code to rgba Convert.
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
