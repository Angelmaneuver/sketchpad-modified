<?php
/**
 * Header logo block pattern.
 *
 * @package    Sketchpad
 * @subpackage block
 * @since      3.0.0
 */

return array(
	'title'      => __( 'header2', 'sketchpad-modified' ),
	'categories' => array( 'frame' ),
	'blockTypes' => array( 'core/template-part/frame' ),
	'content'    => '<!-- wp:columns {"isStackedOnMobile":false,"style":{"spacing":{"margin":{"top":"0rem","bottom":"0rem"}}}} -->
					 <div class="wp-block-columns is-not-stacked-on-mobile" style="margin-top:0rem;margin-bottom:0rem"><!-- wp:column {"width":"1.125rem","style":{"spacing":{"margin":{"left":"0px"}}}} -->
					 <div class="wp-block-column" style="margin-left:0px;flex-basis:1.125rem"></div>
					 <!-- /wp:column -->
					 <!-- wp:column {"width":"4.875rem","style":{"spacing":{"margin":{"left":"0px"}}},"backgroundColor":"sketchpad-sketchpad-background","className":"is-style-sketchpad1"} -->
					 <div class="wp-block-column is-style-sketchpad1 has-sketchpad-sketchpad-background-background-color has-background" style="margin-left:0px;flex-basis:4.875rem"></div>
					 <!-- /wp:column -->
					 <!-- wp:column {"width":"36.875rem","style":{"spacing":{"margin":{"left":"0px"},"padding":{"top":"1.06rem","bottom":"0.31rem"}}},"backgroundColor":"sketchpad-sketchpad-background"} -->
					 <div class="wp-block-column has-sketchpad-sketchpad-background-background-color has-background" style="margin-left:0px;padding-top:1.06rem;padding-bottom:0.31rem;flex-basis:36.875rem"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
					 <div class="wp-block-columns are-vertically-aligned-center" style="margin-top:0px;margin-bottom:0px"><!-- wp:column {"verticalAlignment":"center"} -->
					 <div class="wp-block-column is-vertically-aligned-center"><!-- wp:site-title {"className":"is-style-sketchpad1"} /-->
					 <!-- wp:site-tagline /--></div>
					 <!-- /wp:column -->
					 <!-- wp:column {"verticalAlignment":"center"} -->
					 <div class="wp-block-column is-vertically-aligned-center"><!-- wp:search {"label":"検索","showLabel":false,"placeholder":"Enter search keyword","buttonText":"検索","buttonUseIcon":true,"className":"is-style-sketchpad1"} /--></div>
					 <!-- /wp:column --></div>
					 <!-- /wp:columns -->
					 <!-- wp:spacer {"height":"20px"} -->
					 <div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
					 <!-- /wp:spacer -->
					 <!-- wp:separator {"color":"sketchpad-border-color-1","className":"is-style-sketchpad1"} -->
					 <hr class="wp-block-separator has-text-color has-background has-sketchpad-border-color-1-background-color has-sketchpad-border-color-1-color is-style-sketchpad1"/>
					 <!-- /wp:separator --></div>
					 <!-- /wp:column -->
					 <!-- wp:column {"width":"2.9375rem","style":{"spacing":{"margin":{"left":"0px"}}},"backgroundColor":"sketchpad-sketchpad-background","className":"is-style-sketchpad2"} -->
					 <div class="wp-block-column is-style-sketchpad2 has-sketchpad-sketchpad-background-background-color has-background" style="margin-left:0px;flex-basis:2.9375rem"></div>
					 <!-- /wp:column -->
					 <!-- wp:column {"width":"9.8125rem","style":{"spacing":{"margin":{"left":"0px"}}}} -->
					 <div class="wp-block-column" style="margin-left:0px;flex-basis:9.8125rem"></div>
					 <!-- /wp:column --></div>
					 <!-- /wp:columns -->',
);
