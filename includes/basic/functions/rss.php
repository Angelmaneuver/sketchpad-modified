<?php
/**
 * RSS feed setting function.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * These modules are needed to load this function.
 */
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-rss-initializer.php';

/**
 * Customizing the namespaces of RSS feeds.
 *
 * @since  3.0.0
 * @return void
 */
function sketchpad_rss_namespaces():void {
	if ( SM_RSS_Initializer::is_output_post_tumbnail() ) {
		$value = <<<EOM
xmlns:media="http://search.yahoo.com/mrss/"

EOM;
		hazardous_echo( $value );
	}
}

add_action( 'rss2_ns', 'sketchpad_rss_namespaces' );

/**
 * Output eye catching images to RSS feeds.
 *
 * @since  3.0.0
 * @return void
 */
function sketchpad_rss_output_thumbnail():void {
	global $post;

	if (
		! SM_RSS_Initializer::is_output_post_tumbnail() ||
		! has_post_thumbnail( $post->ID )
	) {
		return;
	}

	$thumbnail_id       = get_post_thumbnail_id( $post->ID );
	$thumbnail_path     = get_attached_file( $thumbnail_id );
	$thumbnail_info     = wp_get_attachment_image_src( $thumbnail_id, SM_RSS_Initializer::get_rss_media_image_size() );
	$thumbnail_mimetype = wp_check_filetype( $thumbnail_path )['type'];
	$thumbnail_length   = filesize( $thumbnail_path );
	$value              = null;

	if ( SM_RSS_Initializer::is_output_media_content_tag() ) {
		$value = <<<EOM
<enclosure url="{$thumbnail_info[0]}" length="{$thumbnail_length}" type="{$thumbnail_mimetype}" />
EOM;
	}

	if ( SM_RSS_Initializer::is_output_enclosure_tag() ) {
		$value .= <<<EOM
<media:content url="{$thumbnail_info[0]}" width="{$thumbnail_info[1]}" height="{$thumbnail_info[2]}" type="{$thumbnail_mimetype}" medium="image" />
EOM;
	}

	if ( isset( $value ) ) {
		$value .= <<<EOM


EOM;
		hazardous_echo( $value );
	}
}

add_action( 'rss2_item', 'sketchpad_rss_output_thumbnail' );

/**
 * Customizing the excerpt of RSS feeds.
 *
 * @since  3.0.0
 * @return string
 * @see    https://developer.wordpress.org/reference/functions/the_excerpt_rss/
 */
function sketchpad_rss_excerpt():string {
	return wp_strip_all_tags( get_the_sketchpad_excerpt() );
}

add_filter( 'the_excerpt_rss', 'sketchpad_rss_excerpt' );