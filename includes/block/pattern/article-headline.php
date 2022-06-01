<?php
/**
 * Article headline block pattern.
 *
 * @package    Sketchpad
 * @subpackage block
 * @since      3.0.0
 */

return array(
	'title'      => __( 'Article Headline', 'sketchpad-modified' ),
	'categories' => array( 'query' ),
	'blockTypes' => array( 'core/template-part/header' ),
	'content'    => '<!-- wp:group {"tagName":"header","style":{"spacing":{"blockGap":"0%"}}} -->
					<header class="wp-block-group"><!-- wp:post-title {"isLink":true,"className":"is-style-sketchpad1"} /-->

					<!-- wp:separator {"opacity":"css","backgroundColor":"sketchpad-heading-font-color","className":"is-style-sketchpad2"} -->
					<hr class="wp-block-separator has-text-color has-sketchpad-heading-font-color-color has-css-opacity has-sketchpad-heading-font-color-background-color has-background is-style-sketchpad2"/>
					<!-- /wp:separator -->

					<!-- wp:columns {"isStackedOnMobile":false,"style":{"spacing":{"margin":{"top":"0.31rem","bottom":"0rem"}}}} -->
					<div class="wp-block-columns is-not-stacked-on-mobile" style="margin-top:0.31rem;margin-bottom:0rem"><!-- wp:column -->
					<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0.3125rem"}},"layout":{"type":"flex","allowOrientation":false,"flexWrap":"nowrap"}} -->
					<div class="wp-block-group"><!-- wp:post-date /-->

					<!-- wp:sketchpad-modified-blocks/post-edit-link {"label":"\u003cem\u003eedit\u003c/em\u003e"} /--></div>
					<!-- /wp:group --></div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0.3125rem"}},"layout":{"type":"flex","allowOrientation":false,"justifyContent":"right"}} -->
					<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem"}},"textColor":"sketchpad-meta-data-font-color"} -->
					<p class="has-sketchpad-meta-data-font-color-color has-text-color" style="font-size:0.75rem">posted by</p>
					<!-- /wp:paragraph -->

					<!-- wp:post-author {"showAvatar":false} /-->

					<!-- wp:sketchpad-modified-blocks/group {"isShowHasCategory":true} -->
					<div class="wp-block-sketchpad-modified-blocks-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem"}},"textColor":"sketchpad-meta-data-font-color"} -->
					<p class="has-sketchpad-meta-data-font-color-color has-text-color" style="font-size:0.75rem">in</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:sketchpad-modified-blocks/group -->

					<!-- wp:post-terms {"term":"category","className":"is-style-sketchpad1"} /--></div>
					<!-- /wp:group --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns --></header>
					<!-- /wp:group -->',
);
