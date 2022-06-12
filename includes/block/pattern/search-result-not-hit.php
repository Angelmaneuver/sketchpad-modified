<?php
/**
 * Search result not hit block pattern.
 *
 * @package    Sketchpad
 * @subpackage block
 * @since      3.0.0
 */

return array(
	'title'      => __( 'Search Result Not Hit', 'sketchpad-modified' ),
	'categories' => array( 'query' ),
	'blockTypes' => array( 'core/template-part/search-result-not-hit' ),
	'content'    => '<!-- wp:query-no-results -->
					<!-- wp:group {"style":{"spacing":{"blockGap":"0.3125rem"}}} -->
					<div class="wp-block-group"><!-- wp:heading {"level":3} -->
					<h3></h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph -->
					<p></p>
					<!-- /wp:paragraph -->

					<!-- wp:search {"label":"検索","showLabel":false,"buttonText":"","className":"is-style-sketchpad2"} /--></div>
					<!-- /wp:group -->
					<!-- /wp:query-no-results -->',
);
