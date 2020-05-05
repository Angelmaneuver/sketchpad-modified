<?php
/**
 * Sketchpad - modified ShortCode part of Functions and definitions.
 *
 * @subpackage Sketchpad - modified 1.0
 * @since      Sketchpad - modified 1.0
 */

// has_tag customize for sketchpad - modified
function sketchpad_has_tag( $atts ) {
  $tag = $atts['tag'];
  $true = $atts['true'];
  $false = $atts['false'];
  $result = '';

  if( $tag != '' && ( $true != '' || $false != '' ) ) {
    $result = has_tag( $tag ) ? $true : $false;
  }

  return $result;
}

// return avatar
function sketchpad_get_avatar( $atts ) {
  $id_or_email = $atts['id_or_email'];
  $size = $atts['size'];
  $default = $atts['default'];
  $alt = $atts['alt'];
  $args = $atts['args'];
  return get_avatar( $id_or_email, $size, $default, $alt, $args );
}

// return copy button
function sketchpad_copy_button( $atts ) {
  $target = $atts['target'];
  $result = '';

  if( $target != '' ) {
    $result = '<button class="sketchpad-copy-button" data-clipboard-target="' . $target . '" onClick="return false;"><div class="fa-stack"><i class="fas fa-square fa-stack-2x"></i><i class="fas fa-copy fa-stack-1x fa-inverse"></i></div></button>';
  }

  return $result;
}

// return tag list
function sketchpad_tag_cloud( $atts ) {
  $args = array(
    'smallest'                  => 8,
    'largest'                   => 22,
    'unit'                      => 'pt',
    'number'                    => 0,
    'format'                    => 'list',
    'separator'                 => "\n",
    'orderby'                   => 'name',
    'order'                     => 'ASC',
    'exclude'                   => null,
    'include'                   => null,
    'topic_count_text_callback' => default_topic_count_text,
    'link'                      => 'view',
    'taxonomy'                  => 'post_tag',
    'echo'                      => false,
    'child_of'                  => null,
  );

  return wp_tag_cloud( is_array( $atts ) ? array_merge( $args, $atts ) : $args );
}

add_shortcode( 'sketchpad_get_current_url', 'sketchpad_get_current_url' );
add_shortcode( 'sketchpad_get_feed_link', 'get_feed_link' );
add_shortcode( 'sketchpad_has_tag', 'sketchpad_has_tag' );
add_shortcode( 'sketchpad_get_avatar', 'sketchpad_get_avatar' );
add_shortcode( 'sketchpad_copy_button', 'sketchpad_copy_button' );
add_shortcode( 'sketchpad_tag_cloud', 'sketchpad_tag_cloud' );
