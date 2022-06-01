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
	'content'    => '<!-- wp:group {"tagName":"footer","style":{"spacing":{"blockGap":"1.25rem"}}} -->
					<footer class="wp-block-group"><!-- wp:sketchpad-modified-blocks/post-comments-count {"isLink":true,"anchor":"comments","beforeText":"read comments (","afterText":")","style":{"typography":{"fontSize":"0.75rem"}},"fontFamily":"sketchpad-arial-font"} /-->

					<!-- wp:post-terms {"term":"post_tag","separator":"","className":"is-style-sketchpad1"} /--></footer>
					<!-- /wp:group -->',
);
