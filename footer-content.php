<?php
/**
 * The template for displaying the footer
 *
 * @subpackage Sketchpad
 * @since      Sketchpad - modified 1.0
 */
?>
<div class="footer">
  <div class="site-info">
    <span class="left">
      <?php echo '&copy; ' . date_i18n( 'Y ' ) . get_bloginfo( 'name' ); ?>
    </span>
    <span class="right">
      <span class="developer"><?php printf( __( 'Powered by %s', 'sketchpad-modified' ), '<a href = "' . esc_url( 'https://github.com/Angelmaneuver/sketchpad-modified' ) . '" target="_blank" rel="noopener noreferrer">' . esc_html( 'Angelmaneuver' ). '</a>' ); ?></span>
      <span class="original"><?php printf( __( ' (Original is %s) ', 'sketchpad-modified' ), '<a href = "' . esc_url( 'https://bestweblayout.com/' ) . '" target="_blank" rel="noopener noreferrer">BestWebLayout</a>' ); ?></span>
      <span class="wordpress"><?php printf( __( 'and %s', 'sketchpad-modified' ), '<a href = "' . esc_url( 'https://wordpress.org/' ) . '" target="_blank" rel="noopener noreferrer">WordPress</a>' ); ?></span>
    </span>
  </div><!--.site-info-->
</div><!--.footer-->
