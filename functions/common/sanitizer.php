<?php
/**
 * Sanitize of Theme Customizer.
 *
 * @subpackage Sketchpad - modified 1.0
 * @since      Sketchpad - modified 1.0
 */

/**
 * Checkbox sanitizer.
 *
 * @param value                 $checked The Customize Setting value.
 * @param WP_Customize_Setting  $setting The Customize Setting object (not use).
 */
function sketchpad_sanitize_checkbox( $checked, $setting ) {
  return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Radio, Selectbox sanitizer.
 * 
 * @param value                 $input   The Customize Setting value.
 * @param WP_Customize_Setting  $setting The Customize Setting object.
 */
function sketchpad_sanitize_select( $input, $setting ) {
  $input = sanitize_key( $input );
  $choices = $setting->manager->get_control( $setting->id )->choices;
  return array_key_exists( $input, $choices ) ? $input : $setting->default;
}
