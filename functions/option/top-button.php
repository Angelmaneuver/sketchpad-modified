<?php
/**
 * Sketchpad - modified Basic option Top button part of Functions and definitions.
 *
 * @subpackage Sketchpad - modified 1.0
 * @since      Sketchpad - modified 1.0
 */

/**
 * Constant Class for this functions.
 */
class TopButtonDefualtClass {
  const TOP_BUTTON_MARK                   = 'TOP';
  const TOP_BUTTON_BACKGROUND_COLOR       = '#4169e1';
  const TOP_BUTTON_HOVER_BACKGROUND_COLOR = '#dc143c';
  const TOP_BUTTON_BORDER_COLOR           = '#ffffff';
}

/**
 * Set up the Sketchpad - modified Top button settings via customizer.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function sketchpad_customize2top_button_register( $wp_customize ) {
	$wp_customize->add_section( 'sketchpad_top_button_section', array(
    'title'							=> __( 'Top Button Setting', 'sketchpad-modified' ),
    'description'       => __( 'Configure settings for the button that returns to the top of the page.', 'sketchpad-modified' ),
    'panel'             => 'sketchpad_basic_panel',
	) );
	$wp_customize->add_setting( 'sketchpad_top_button_enable', array(
		'default'						=> false,
		'sanitize_callback'	=> 'sketchpad_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'sketchpad_top_button_enable', array(
		'setting'						=> 'sketchpad_top_button_enable',
		'section'						=> 'sketchpad_top_button_section',
		'label'							=> __( 'Top Button enable', 'sketchpad-modified' ),
		'type'							=> 'checkbox',
  ) );
  $wp_customize->add_setting( 'sketchpad_top_button_mark', array(
		'default'						=> sketchpad_sanitize_top_button_template( TopButtonDefualtClass::TOP_BUTTON_MARK ),
		'sanitize_callback'	=> 'sketchpad_sanitize_top_button_template',
	) );
	$wp_customize->add_control( 'sketchpad_top_button_mark', array(
		'setting'						=> 'sketchpad_top_button_mark',
		'section'						=> 'sketchpad_top_button_section',
    'label'							=> __( 'Top Button Mark', 'sketchpad-modified' ),
		'type'							=> 'text',
	) );
  $wp_customize->add_setting( 'sketchpad_top_button_background_color', array(
		'default'						=> TopButtonDefualtClass::TOP_BUTTON_BACKGROUND_COLOR,
		'sanitize_callback'	=> 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sketchpad_top_button_background_color', array(
		'setting'						=> 'sketchpad_top_button_background_color',
		'section'						=> 'sketchpad_top_button_section',
    'label'							=> __( 'Top Button Background Color', 'sketchpad-modified' ),
	) ) );
  $wp_customize->add_setting( 'sketchpad_top_button_hover_background_color', array(
		'default'						=> TopButtonDefualtClass::TOP_BUTTON_HOVER_BACKGROUND_COLOR,
		'sanitize_callback'	=> 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sketchpad_top_button_hover_background_color', array(
    'setting'						=> 'sketchpad_top_button_hover_background_color',
    'section'						=> 'sketchpad_top_button_section',
    'label'     				=> __( 'Top Button Hover Background Color', 'sketchpad-modified' ),
  ) ) );
  $wp_customize->add_setting( 'sketchpad_top_button_border_color', array(
		'defult'					  => TopButtonDefualtClass::TOP_BUTTON_BORDER_COLOR,
		'sanitize_callback'	=> 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sketchpad_top_button_border_color', array(
		'setting'					=> 'sketchpad_top_button_border_color',
		'section'					=> 'sketchpad_top_button_section',
    'label'						=> __( 'Top Button Border Color', 'sketchpad-modified' ),
  ) ) );
}

/**
 * Top button Template sanitizer.
 * 
 * @param value                 $input   The Customize Setting value.
 */
function sketchpad_sanitize_top_button_template( $input ) {
  $allow = array(
    'a'     => array(
                'class'     => array(),
                'id'        => array(),
                'style'     => array(),
                'href'      => array(),
                'title'     => array(),
                'alt'       => array(),
               ),
    'span'  => array(
                'class'     => array(),
                'id'        => array(),
                'style'     => array(),
               ),
    'div'   => array(
                'class'     => array(),
                'id'        => array(),
                'style'     => array(),
               ),
    'i'     => array(
                'class'     => array(),
                'id'        => array(),
                'style'     => array(),
               ),
  );
  return wp_kses( $input, $allow );
}

// output top button method wrapper
function sketchpad_top_button() {
  if( get_theme_mod( 'sketchpad_top_button_enable', false ) ) {
    sketchpad_output_top_button();
  }
}

// output top button html
function sketchpad_output_top_button() {
  $background_color = get_theme_mod( 'sketchpad_top_button_background_color', TopButtonDefualtClass::TOP_BUTTON_BACKGROUND_COLOR );
  $hover = 'onMouseOut="this.style.background=' . "'" . $background_color . "';" . '" ' . 'onMouseOver="this.style.background=' . "'" . get_theme_mod( 'sketchpad_top_button_hover_background_color', TopButtonDefualtClass::TOP_BUTTON_HOVER_BACKGROUND_COLOR ) . "'" . ';"';
  $border = get_theme_mod( 'sketchpad_top_button_border_color', TopButtonDefualtClass::TOP_BUTTON_BORDER_COLOR );
  $mark = get_theme_mod ( 'sketchpad_top_button_mark', sketchpad_sanitize_top_button_template( TopButtonDefualtClass::TOP_BUTTON_MARK ) );
  echo <<<EOM
  <button class="top_button" style="background-color:{$background_color}; border: 1px solid {$border};" {$hover} onClick="return false;">{$mark}</button>
EOM;
  ?>
<script type="text/javascript">(function($){let top_button = $('.top_button');top_button.hide();$(window).scroll(function(){if($(this).scrollTop() > 100){top_button.fadeIn();}else{top_button.fadeOut();}});top_button.click(function(){$('body, html').animate({scrollTop: 0}, 500);return false;});})(jQuery);</script>
  <?php
}

add_action( 'customize_register', 'sketchpad_customize2top_button_register', 120 );
add_filter( 'wp_footer', 'sketchpad_top_button' );
