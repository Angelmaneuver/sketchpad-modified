<?php
/**
 * Extends the core functionality of WordPress.
 *
 * @package    Sketchpad
 * @subpackage filter
 * @since      3.0.0
 */

/**
 * Rearrange the categories list structure.
 *
 * @param  string   $block_content The block content about to be appended.
 * @param  array    $block         The full block, including name and attributes.
 * @param  WP_Block $instance      The block instance.
 * @return string   Filtering results.
 * @see    https://developer.wordpress.org/reference/hooks/render_block_this-name/
 */
function render_block_categories_sketchpad_filter( string $block_content, array $block, WP_Block $instance ): string {
	return preg_replace( '/(<li(?:.*?)?>)(.*?)(<\/li>|<ul)/s', '${1}<div class="cat-item">${2}</div>${3}', $block_content );
}

add_filter( 'render_block_core/categories', 'render_block_categories_sketchpad_filter', 10, 3 );
