<?php
/**
 * Contents block pattern.
 *
 * @package    Sketchpad
 * @subpackage block
 * @since      3.0.0
 */

return array(
	'title'      => __( 'Contents', 'sketchpad-modified' ),
	'categories' => array( 'frame' ),
	'blockTypes' => array( 'core/template-part/frame' ),
	'content'    => '<!-- wp:group {"layout":{"contentSize":"55.625rem"},"style":{"spacing":{"margin":{"top":"0rem","bottom":"0rem"}}}} -->
					 <div class="wp-block-group" style="margin-top:0rem;margin-bottom:0rem;"></div>
					 <!-- /wp:group -->',
);
