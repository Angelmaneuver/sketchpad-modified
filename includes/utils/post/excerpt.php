<?php
/**
 * Extends the core functionality of WordPress.
 *
 * @package    Sketchpad
 * @subpackage post
 * @since      3.0.0
 */

/**
 * Retrieve the post excerpt.
 *
 * @since  3.0.0
 * @param  int|WP_Post|null $post      Post ID or WP_Post object. Default is global $post.
 * @param  string|null      $more_text What to append if $text needs to be trimmed. Default '…'.
 * @param  integer          $num_words Number of words.
 * @return string
 */
function get_the_sketchpad_excerpt( $post = null, $more_text = null, $num_words = 55 ):string {
	$_post   = get_post( $post );
	$excerpt = '';

	if ( ! ( $_post instanceof WP_Post ) ) {
		return '';
	} elseif ( has_excerpt() ) {
		$excerpt = $_post->post_excerpt;
	} else {
		list(
			'main'      => $main,
			'extended'  => $extended,
			'more_text' => $is_more
		)        = get_extended( $_post->post_content );
		$excerpt = apply_filters( 'the_content', $main );
		$excerpt = empty( $is_more ) ? wp_trim_words( $main ) : $excerpt;
	}

	return $excerpt;
}
