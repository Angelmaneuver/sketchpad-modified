<?php
/**
 * Article excerpt block pattern.
 *
 * @package    Sketchpad
 * @subpackage block
 * @since      3.0.0
 */

return array(
	'title'      => __( 'Article Excerpt', 'sketchpad-modified' ),
	'categories' => array( 'query' ),
	'blockTypes' => array( 'core/template-part/excerpt' ),
	'content'    => '<!-- wp:group {"tagName":"section"} -->
					<section class="wp-block-group"><!-- wp:columns {"style":{"spacing":{"blockGap":"0%"}}} -->
					<div class="wp-block-columns"><!-- wp:column {"className":"is-style-fit-content"} -->
					<div class="wp-block-column is-style-fit-content"><!-- wp:group -->
					<div class="wp-block-group"><!-- wp:post-featured-image {"isLink":true,"className":"is-style-sketchpad1"} /--></div>
					<!-- /wp:group --></div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:post-excerpt {"moreText":"more »","className":"is-style-sketchpad1"} /--></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns --></section>
					<!-- /wp:group -->',
);
