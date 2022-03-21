<?php
/**
 * Header logo block pattern.
 *
 * @package    Sketchpad
 * @subpackage block
 * @since      3.0.0
 */

return array(
	'title'      => __( 'Default header', 'sketchpad-modified' ),
	'categories' => array( 'header' ),
	'blockTypes' => array( 'core/template-part/header' ),
	'content'    => '<!-- wp:image {"sizeSlug":"large","style":{"spacing":{"margin":{"bottom":"0px"}}}} -->
					 <figure class="wp-block-image size-large" style="margin-bottom:0px;">
					 <img src="/wp-content/themes/sketchpad-modified/assets/images/bg-logo.webp" alt="' . __( 'Header logo image', 'sketchpad-modified' ) . '"/>
					 </figure>
					 <!-- /wp:image -->',
);
