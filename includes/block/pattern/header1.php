<?php
/**
 * Header logo block pattern.
 *
 * @package    Sketchpad
 * @subpackage block
 * @since      3.0.0
 */

return array(
	'title'      => __( 'header1', 'sketchpad-modified' ),
	'categories' => array( 'frame' ),
	'blockTypes' => array( 'core/template-part/frame' ),
	'content'    => '<!-- wp:columns {"isStackedOnMobile":false,"style":{"spacing":{"margin":{"top":"0rem","bottom":"0rem"}}}} -->
					 <div class="wp-block-columns is-not-stacked-on-mobile" style="margin-top:0rem;margin-bottom:0rem"><!-- wp:column {"width":"1.125rem","style":{"spacing":{"margin":{"left":"0px"}}}} -->
					 <div class="wp-block-column" style="margin-left:0px;flex-basis:1.125rem"></div>
					 <!-- /wp:column -->
					 <!-- wp:column {"width":"44.6875rem","style":{"spacing":{"margin":{"left":"0px"}}}} -->
					 <div class="wp-block-column" style="margin-left:0px;flex-basis:44.6875rem"><!-- wp:image {"sizeSlug":"large","style":{"spacing":{"margin":{"bottom":"0px"}}}} -->
					 <figure class="wp-block-image size-large" style="margin-bottom:0px"><img src="/wp-content/themes/sketchpad-modified/assets/images/bg-logo.webp" alt="Header logo image"/></figure>
					 <!-- /wp:image --></div>
					 <!-- /wp:column -->
					 <!-- wp:column {"width":"9.8125rem","style":{"spacing":{"margin":{"left":"0px"}}}} -->
					 <div class="wp-block-column" style="margin-left:0px;flex-basis:9.8125rem"></div>
					 <!-- /wp:column --></div>
					 <!-- /wp:columns -->',
);
