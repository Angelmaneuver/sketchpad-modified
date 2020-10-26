<?php
/**
 * Sketchpad - modified Basic.
 *
 * @package sketchpad - modified
 * @subpackage sm-basic
 * @since 1.0.0
 */

require get_template_directory() . '/includes/admin/theme-customizer/sm-basic/class-sm-basic-constant.php';

if( is_admin() || is_customize_preview() ){
  /**
   * Set up the panel.
   *
   * @param WP_Customize_Manager $wp_customize The Customizer object.
   */
  function sketchpad_customizer4basic_register( $wp_customize ) {
    $wp_customize->add_panel( SmBasicConstantClass::PANEL, array(
      'title'							=> __( 'Sketchpad - modified Basic Setting', 'sketchpad-modified' ),
      'priority'					=> 1000,
    ) );
  }

  add_action( 'customize_register', 'sketchpad_customizer4basic_register', 10 );

  require get_template_directory() . '/includes/admin/theme-customizer/sm-basic/admin-page-setting.php';
  require get_template_directory() . '/includes/admin/theme-customizer/sm-basic/insert-head-tag.php';
  require get_template_directory() . '/includes/admin/theme-customizer/sm-basic/blog-card.php';
  require get_template_directory() . '/includes/admin/theme-customizer/sm-basic/top-button.php';
}

/**
 * Insert head tag.
 *
 * @subpackage insert-head-tag
 * @since 1.0.0
 */
function sketchpad_head_insert_head() {
  $insert_head = get_theme_mod( 'sketchpad_head_insert_head', '' );

  if( $insert_head != '' ) {
    echo <<<EOM
    {$insert_head}
    
EOM;
  }
}

add_filter( 'wp_head', 'sketchpad_head_insert_head' );
add_filter( 'admin_head', 'sketchpad_head_insert_head' );
add_filter( 'embed_head', 'sketchpad_head_insert_head' );

/**
 * Add to embed css.
 *
 * @subpackage blog-card
 * @since 1.0.0
 */
function sketchpad_embed_styles() {
  wp_enqueue_style( 'wp-oembed-embed', get_template_directory_uri() . '/sketchpad-embed-template.css' );
}

/**
 * Customize to blog card image size.
 *
 * @subpackage blog-card
 * @since 1.0.0
 */
function sketchpad_blog_card_image_size( $image_size, $thumbnail_id ) {
  return get_theme_mod ( 'sketchpad_blog_card_image_size_setting_enable', false ) === true ? get_theme_mod( 'sketchpad_blog_card_image_size', 'thumbnail' ) : $image_size;
}

/**
 * Customize to blog card image form.
 *
 * @subpackage blog-card
 * @since 1.0.0
 */
function sketchpad_blog_card_image_form( $shape, $thumbnail_id ) {
  return get_theme_mod ( 'sketchpad_blog_card_image_form_type_setting_enable', false ) === true ? get_theme_mod( 'sketchpad_blog_card_image_form', 'rectangular' ) : $shape;
}

/**
 * Customize to blog card image content.
 *
 * @subpackage blog-card
 * @since 1.0.0
 */
function sketchpad_blog_card_content( $content ) {
  global $post;

  return sketchpad_content2more_read( $post->post_content, esc_url( get_permalink( $post ) ) );
}

add_action( 'embed_head', 'sketchpad_embed_styles' );
add_filter( 'embed_thumbnail_image_size', 'sketchpad_blog_card_image_size', 10, 2 );
add_filter( 'embed_thumbnail_image_shape', 'sketchpad_blog_card_image_form', 10, 2 );
add_filter( 'the_excerpt_embed', 'sketchpad_blog_card_content' );

/**
 * Output top button method wrapper.
 *
 * @subpackage top-button
 * @since 1.0.0
 */
function sketchpad_top_button() {
  if( get_theme_mod( 'sketchpad_top_button_enable', false ) ) {
    sketchpad_output_top_button();
  }
}

/**
 * Output top button html.
 *
 * @subpackage top-button
 * @since 1.0.0
 */
function sketchpad_output_top_button() {
  $background_color = get_theme_mod( 'sketchpad_top_button_background_color', SmBasicConstantClass::TOP_BUTTON_BACKGROUND_COLOR );
  $hover = 'onMouseOut="this.style.background=' . "'" . $background_color . "';" . '" ' . 'onMouseOver="this.style.background=' . "'" . get_theme_mod( 'sketchpad_top_button_hover_background_color', SmBasicConstantClass::TOP_BUTTON_HOVER_BACKGROUND_COLOR ) . "'" . ';"';
  $border = get_theme_mod( 'sketchpad_top_button_border_color', SmBasicConstantClass::TOP_BUTTON_BORDER_COLOR );
  $mark = get_theme_mod ( 'sketchpad_top_button_mark', sketchpad_sanitize_top_button_template( SmBasicConstantClass::TOP_BUTTON_MARK ) );
  echo <<<EOM
  <button class="top_button" style="background-color:{$background_color}; border: 1px solid {$border};" {$hover} onClick="return false;">{$mark}</button>
EOM;
  ?>
<script type="text/javascript">(function($){let top_button = $('.top_button');top_button.hide();$(window).scroll(function(){if($(this).scrollTop() > 100){top_button.fadeIn();}else{top_button.fadeOut();}});top_button.click(function(){$('body, html').animate({scrollTop: 0}, 500);return false;});})(jQuery);</script>
  <?php
}

add_filter( 'wp_footer', 'sketchpad_top_button' );
