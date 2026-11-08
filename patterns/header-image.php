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
<!-- wp:image {"width":"715px","height":"117px","scale":"cover","linkDestination":"none","sketchpadWidthUnit":"none","sketchpadHeightUnit":"none","sketchpadFetchPriority":"high"} -->
<figure class="wp-block-image is-resized"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/bg-logo.webp' ); ?>" alt="<?php echo esc_attr__( 'Header image', 'sketchpad-modified' ); ?>" style="object-fit:cover" width="715" height="117" fetchpriority="high"/></figure>
<!-- /wp:image -->
