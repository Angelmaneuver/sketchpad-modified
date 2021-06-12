<?php
/**
 * Sketchpad - modified RSS.
 *
 * @package    sketchpad
 * @subpackage sm-rss
 * @since      2.1.0
 */

/**
 * Set up the panel.
 */
if ( is_admin() || is_customize_preview() ) {
	require get_template_directory() . '/includes/admin/theme-customizer/sm-rss.php';
}

/**
 * Support rss feed namespaces.
 *
 * @since 2.1.0
 */
function sketchpad_support_rss_namespaces() {
	if ( get_theme_mod( 'sketchpad_rss_output_post_tumbnail', false ) ) {
		$value = <<<EOM
xmlns:media="http://search.yahoo.com/mrss/"

EOM;
		hazardous_e( $value );
	}
}

/**
 * Customize to rss feed.
 *
 * @since 2.1.0
 * @param String $content The Post content strings.
 */
function sketchpad_content_feed( $content ) {
	global $post;

	$permalink = esc_url( get_permalink( $post ) );

	if ( get_option( 'rss_use_excerpt' ) ) {
		$content = sketchpad_content2more_read( $post->post_content, $permalink );
	}

	if ( get_theme_mod( 'sketchpad_rss_output_post_tumbnail', false ) ) {

		if ( has_post_thumbnail( $post->ID ) ) {
			$thumbnail        = sketchpad_get_thumbnail_info( $post->ID, get_theme_mod( 'sketchpad_rss_media_image_size', 'thumbnail' ) );
			$thumbnail_url    = esc_url( $thumbnail['url'] );
			$thumbnail_alt    = esc_attr( $thumbnail['alt'] );
			$thumbnail_width  = esc_attr( $thumbnail['width'] );
			$thumbnail_height = esc_attr( $thumbnail['height'] );
			$content          = <<<EOM

			<div>
				<a href="{$permalink}">
					<figure>
						<img src="{$thumbnail_url}" alt="{$thumbnail_alt}" width="{$thumbnail_width}" height="{$thumbnail_height}" />
					</figure>
				</a>
			</div>
			{$content}
EOM;
		}
	}

	return $content;
}

/**
 * Output media element to rss feed.
 *
 * @since 2.1.0
 */
function sketchpad_output_thumbnail_element_2_feed() {
	if ( get_theme_mod( 'sketchpad_rss_output_post_tumbnail', false ) ) {
		global $post;

		if ( has_post_thumbnail( $post->ID ) ) {
			$thumbnail          = sketchpad_get_thumbnail_info( $post->ID, get_theme_mod( 'sketchpad_rss_media_image_size', 'thumbnail' ) );
			$thumbnail_url      = esc_url( $thumbnail['url'] );
			$thumbnail_width    = esc_attr( $thumbnail['width'] );
			$thumbnail_height   = esc_attr( $thumbnail['height'] );
			$thumbnail_size     = esc_attr( $thumbnail['size'] );
			$thumbnail_mimetype = esc_attr( $thumbnail['mimetype'] );
			$value              = null;

			if ( get_theme_mod( 'sketchpad_rss_output_media_content_tag', false ) ) {
				$value = <<<EOM
<enclosure url="{$thumbnail_url}" length="{$thumbnail_size}" type="{$thumbnail_mimetype}" />

EOM;
			}

			if ( get_theme_mod( 'sketchpad_rss_output_enclosure_tag', false ) ) {
				$value .= <<<EOM
<media:content url="{$thumbnail_url}" width="{$thumbnail_width}" height="{$thumbnail_height}" type="{$thumbnail_mimetype}" medium="image" />

EOM;
			}

			if ( isset( $value ) ) {
				hazardous_e( $value );
			}
		}
	}
}

/**
 * Get post thumbnail information.
 *
 * @since 2.1.0
 * @param String $post_id        The Post id strings.
 * @param Object $thumbnail_size The Post thumbnail image size.
 */
function sketchpad_get_thumbnail_info( $post_id, $thumbnail_size ) {
	$thumbnail_id   = get_post_thumbnail_id( $post_id );
	$thumbnail      = wp_get_attachment_image_src( $thumbnail_id, $thumbnail_size );
	$alt            = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true ) === '' ? get_post( $thumbnail_id )->post_title : get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
	$mimetype       = wp_check_filetype( $thumbnail[0] )['type'];
	$filesize       = filesize( str_replace( esc_url( home_url( '/' ) ), ABSPATH, $thumbnail[0] ) );
	$thumbnail_info = array(
		'url'      => $thumbnail[0],
		'width'    => $thumbnail[1],
		'height'   => $thumbnail[2],
		'alt'      => $alt,
		'mimetype' => $mimetype,
		'size'     => $filesize,
	);

	return $thumbnail_info;
}

add_action( 'rss2_ns', 'sketchpad_support_rss_namespaces' );
add_action( 'rss2_item', 'sketchpad_output_thumbnail_element_2_feed' );
add_filter( 'the_excerpt_rss', 'sketchpad_content_feed' );
add_filter( 'the_content_feed', 'sketchpad_content_feed' );
