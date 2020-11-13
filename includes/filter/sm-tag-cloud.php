<?php
/**
 * Method to extend wp_tag_cloud.
 *
 * @package sketchpad - modified
 * @subpackage filter
 * @since 1.0.0
 */

function sm_tag_cloud( $output ){
  $output = preg_replace( '/\s*?style="[^"]+?"/i', '', $output );
  return $output;
}

add_filter( 'wp_tag_cloud', 'sm_tag_cloud', 10 );
