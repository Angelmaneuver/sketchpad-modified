<?php
/**
 * Contens main block pattern.
 *
 * @package    Sketchpad
 * @subpackage block
 * @since      3.0.0
 */

return array(
	'title'      => __( 'Contents main', 'sketchpad-modified' ),
	'categories' => array( 'frame' ),
	'blockTypes' => array( 'core/template-part/frame' ),
	'content'    => '<!-- wp:group {"style":{"spacing":{"margin":{"top":"0rem","bottom":"0rem"}}},"layout":{"contentSize":"55.625rem"}} -->
					 <div class="wp-block-group" style="margin-top:0rem;margin-bottom:0rem"><!-- wp:columns {"isStackedOnMobile":false} -->
					 <div class="wp-block-columns is-not-stacked-on-mobile"><!-- wp:column {"width":"6rem","style":{"spacing":{"margin":{"left":"0px"}}},"className":"is-style-sketchpad3"} -->
					 <div class="wp-block-column is-style-sketchpad3" style="margin-left:0px;flex-basis:6rem"></div>
					 <!-- /wp:column -->
					 <!-- wp:column {"width":"36.875rem","style":{"spacing":{"padding":{"top":"0rem","right":"2.94rem","bottom":"1.88rem","left":"0px"},"margin":{"left":"0px"}}},"backgroundColor":"sketchpad-sketchpad-background","className":"is-style-sketchpad4"} -->
					 <div class="wp-block-column is-style-sketchpad4 has-sketchpad-sketchpad-background-background-color has-background" style="margin-left:0px;padding-top:0rem;padding-right:2.94rem;padding-bottom:1.88rem;padding-left:0px;flex-basis:36.875rem"><!-- wp:query {"queryId":18,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","categoryIds":[],"tagIds":[],"order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"tagName":"main","layout":{"inherit":false}} -->
					 <main class="wp-block-query"></main>
					 <!-- /wp:query --></div>
					 <!-- /wp:column -->
					 <!-- wp:column {"width":"12.3125rem","style":{"spacing":{"margin":{"left":"-2.5rem"}}}} -->
					 <div class="wp-block-column" style="margin-left:-2.5rem;flex-basis:12.3125rem"></div>
					 <!-- /wp:column --></div>
					 <!-- /wp:columns --></div>
					 <!-- /wp:group -->',
);
