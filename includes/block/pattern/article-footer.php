<?php
/**
 * Article footer block pattern.
 *
 * @package    Sketchpad
 * @subpackage block
 * @since      3.0.0
 */

return array(
	'title'      => __( 'Article Footer', 'sketchpad-modified' ),
	'categories' => array( 'query' ),
	'blockTypes' => array( 'core/template-part/footer' ),
	'content'    => '<!-- wp:group {"tagName":"footer","style":{"spacing":{"padding":{"top":"0rem","bottom":"0.625rem"}}}} -->
					<footer class="wp-block-group" style="padding-top:0rem;padding-bottom:0.625rem"><!-- wp:post-terms {"term":"post_tag","separator":"","className":"is-style-sketchpad1"} /-->

					<!-- wp:sketchpad-modified-blocks/post-navigation-links {"textColor":"sketchpad-basic-font-color"} -->
					<div class="wp-block-sketchpad-modified-blocks-post-navigation-links has-sketchpad-basic-font-color-color has-text-color"><!-- wp:post-navigation-link {"type":"previous","label":"←","showTitle":true} /-->

					<!-- wp:post-navigation-link {"label":"→","showTitle":true} /--></div>
					<!-- /wp:sketchpad-modified-blocks/post-navigation-links -->

					<!-- wp:separator {"opacity":"css","backgroundColor":"sketchpad-heading-font-color","className":"is-style-sketchpad2 is-style-no-change"} -->
					<hr class="wp-block-separator has-text-color has-sketchpad-heading-font-color-color has-css-opacity has-sketchpad-heading-font-color-background-color has-background is-style-sketchpad2 is-style-no-change"/>
					<!-- /wp:separator -->

					<!-- wp:group {"style":{"spacing":{"margin":{"top":"0.5rem","bottom":"0%"}}}} -->
					<div class="wp-block-group" style="margin-top:0.5rem;margin-bottom:0%"><!-- wp:comments-query-loop -->
					<div class="wp-block-comments-query-loop"><!-- wp:comments-title /-->

					<!-- wp:comment-template -->
					<!-- wp:columns {"style":{"spacing":{"blockGap":"1rem"}}} -->
					<div class="wp-block-columns"><!-- wp:column {"width":"40px","style":{"spacing":[]}} -->
					<div class="wp-block-column" style="flex-basis:40px"><!-- wp:avatar {"size":40,"style":{"border":{"radius":"20px"}}} /--></div>
					<!-- /wp:column -->

					<!-- wp:column {"style":{"spacing":{"blockGap":"0.5rem"}}} -->
					<div class="wp-block-column"><!-- wp:comment-author-name {"style":{"typography":{"fontSize":"0.875rem","fontStyle":"italic","fontWeight":"700"}},"fontFamily":"sketchpad-arial-font"} /-->

					<!-- wp:group {"style":{"spacing":{"margin":{"top":"0px","bottom":"0px"},"blockGap":"1rem"}},"layout":{"type":"flex"}} -->
					<div class="wp-block-group" style="margin-top:0px;margin-bottom:0px"><!-- wp:comment-date {"format":"Y年n月j日 h:i A","isLink":false,"style":{"typography":{"fontSize":"0.75rem"}}} /-->

					<!-- wp:comment-edit-link {"style":{"typography":{"fontSize":"0.75rem"}}} /--></div>
					<!-- /wp:group -->

					<!-- wp:comment-content /-->

					<!-- wp:comment-reply-link {"style":{"typography":{"fontSize":"0.75rem"}}} /--></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns -->
					<!-- /wp:comment-template -->

					<!-- wp:comments-pagination {"className":"is-style-sketchpad1","layout":{"type":"flex","justifyContent":"center"}} -->
					<!-- wp:comments-pagination-previous {"label":"«"} /-->

					<!-- wp:comments-pagination-numbers /-->

					<!-- wp:comments-pagination-next {"label":"»"} /-->
					<!-- /wp:comments-pagination -->

					<!-- wp:post-comments-form /--></div>
					<!-- /wp:comments-query-loop --></div>
					<!-- /wp:group --></footer>
					<!-- /wp:group -->',
);
