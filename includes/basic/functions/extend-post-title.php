<?php
/**
 * Extends the Post title function.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * These modules are needed to load this function.
 */
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-extend-post-title-initializer.php';
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-extend-page-title-initializer.php';

/**
 * Rearrange the categories list structure.
 *
 * @param  string   $block_content The block content about to be appended.
 * @param  array    $block         The full block, including name and attributes.
 * @param  WP_Block $instance      The block instance.
 * @return string   Filtering results.
 * @see    https://developer.wordpress.org/reference/hooks/render_block_this-name/
 */
function render_block_post_title_sketchpad_filter( string $block_content, array $block, WP_Block $instance ): string {
	if ( ! isset( $instance->context['postId'] ) ) {
		return $block_content;
	}

	$post_type = get_post_type( $instance->context['postId'] );
	$is_link   = isset( $block['attrs']['isLink'] ) ? $block['attrs']['isLink'] : false;

	preg_match(
		'/(?P<open><h(?P<rank>\d)(?:.*?)>)(?P<value>.*?)(?P<close><\/h\d>)/s',
		$block_content,
		$h,
	);

	if ( $is_link ) {
		preg_match(
			'/(?P<open><a(?:.*?)>)(?P<value>.*?)(?P<close><\/a>)/s',
			$h['value'],
			$a,
		);
	} else {
		$a = array(
			'open'  => '',
			'value' => $h['value'],
			'close' => '',
		);
	}

	if ( 'post' === $post_type && SM_Extend_Post_Title_Initializer::is_extend_sketchpad_title() ) {
		$a['value'] = str_replace(
			'{title}',
			$a['value'],
			SM_Extend_Post_Title_Initializer::get_sketchpad_title_extend()
		);
	} elseif ( 'page' === $post_type && SM_Extend_Page_Title_Initializer::is_extend_sketchpad_title() ) {
		$a['value'] = str_replace(
			'{title}',
			$a['value'],
			SM_Extend_Page_Title_Initializer::get_sketchpad_title_extend()
		);
	} else {
		return $block_content;
	}

	return "{$h['open']}{$a['open']}{$a['value']}{$a['close']}{$h['close']}";
}

add_filter( 'render_block_core/post-title', 'render_block_post_title_sketchpad_filter', 10, 3 );
