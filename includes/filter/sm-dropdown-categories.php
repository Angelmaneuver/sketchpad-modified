<?php
/**
 * Method to extend wp_dropdown_categories.
 *
 * @package sketchpad - modified
 * @subpackage filter
 * @since 1.0.0
 */

function sm_dropdown_categories( $output, $args ){
  if( isset( $args['sketchpad_multiple'] ) && $args['sketchpad_multiple'] ){
    $after = '<select multiple'
              . ( (isset( $args['sketchpad_size'] ) ) ? ' size="' . $args['sketchpad_size'] . '"' : '' );
    $output = str_replace( '<select', $after, $output );

    $selected = is_array( $args['sketchpad_selected'] ) ? $args['sketchpad_selected'] : explode( ",", $args['sketchpad_selected'] );
    foreach( array_map( 'trim', $selected ) as $value ){
      $output = str_replace( "value=\"{$value}\"", "value=\"{$value}\" selected", $output );
    }
  }

  return $output;
}

add_filter( 'wp_dropdown_cats', 'sm_dropdown_categories', 10, 2 );
