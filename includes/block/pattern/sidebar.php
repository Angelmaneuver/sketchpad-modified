<?php
/**
 * Sidebar block pattern.
 *
 * @package    Sketchpad
 * @subpackage block
 * @since      3.0.0
 */

return array(
	'title'      => __( 'Sidebar', 'sketchpad-modified' ),
	'categories' => array( 'frame' ),
	'blockTypes' => array( 'core/template-part/frame' ),
	'content'    => '<!-- wp:group {"tagName":"section","style":{"spacing":{"padding":{"top":"0.94rem","bottom":"0.94rem","right":"0.63rem","left":"1.25rem"}}}} -->
					 <section class="wp-block-group" style="padding-top:0.94rem;padding-right:0.63rem;padding-bottom:0.94rem;padding-left:1.25rem"><!-- wp:heading {"className":"is-style-sketchpad-sidebar1"} -->
					 <h2 class="is-style-sketchpad-sidebar1"></h2>
					 <!-- /wp:heading --></section>
					 <!-- /wp:group -->',
);
