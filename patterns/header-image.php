<?php
/**
 * Title:       Header Image
 * Slug:        sketchpad-modified/header-image
 * Inserter:    yes
 * Categories:  header
 * Keywords:    header image
 * Block Types: sketchpad-modified/header-image
 *
 * @package  Sketchpad
 * @since    3.0.0
 */

?>
<!-- wp:image {"linkDestination":"none"} -->
<figure class="wp-block-image"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/bg-logo.webp' ); ?>" alt="<?php echo esc_html__( 'Header image', 'sketchpad-modified' ); ?>"></figure>
<!-- /wp:image -->
