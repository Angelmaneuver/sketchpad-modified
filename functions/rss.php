<?php
/**
 * Sketchpad - modified RSS part of Functions and definitions.
 *
 * @subpackage Sketchpad - modified 1.0
 * @since      Sketchpad - modified 1.0
 */

/**
 * Set up the Sketchpad - modified RSS Feed settings via customizer.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function sketchpad_customize2rss_register( $wp_customize ) {
	$wp_customize->add_section( 'sketchpad_rss_section', array(
		'title'							=> __( 'Sketchpad - modified RSS Feed Setting', 'sketchpad-modified' ),
		'description'				=> __( 'Set whether to output an eye-catching image to RSS Feed.', 'sketchpad-modified' ),
		'priority'					=> 1040,
	) );
	$wp_customize->add_setting( 'sketchpad_rss_output_post_tumbnail', array(
		'default'						=> false,
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'sketchpad_rss_output_post_tumbnail', array(
		'setting'						=> 'sketchpad_rss_output_post_tumbnail',
		'section'						=> 'sketchpad_rss_section',
		'label'							=> __( 'output eye-catching image', 'sketchpad-modified' ),
		'type'							=> 'checkbox',
	) );
	$wp_customize->add_setting( 'sketchpad_rss_output_media_content_tag', array(
		'default'						=> false,
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'sketchpad_rss_output_media_content_tag', array(
		'setting'						=> 'sketchpad_rss_output_media_content_tag',
		'section'						=> 'sketchpad_rss_section',
		'label'							=> __( 'to incluede the "media:content" tag', 'sketchpad-modified' ),
		'type'							=> 'checkbox',
	) );
	$wp_customize->add_setting( 'sketchpad_rss_output_enclosure_tag', array(
		'default'						=> false,
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'sketchpad_rss_output_enclosure_tag', array(
		'setting'						=> 'sketchpad_rss_output_enclosure_tag',
		'section'						=> 'sketchpad_rss_section',
		'label'							=> __( 'to incluede the "enclosure" tag', 'sketchpad-modified' ),
		'type'							=> 'checkbox',
	) );
	$wp_customize->add_setting( 'sketchpad_rss_media_image_size', array(
		'defualt'						=> 'thumbnail',
		'transport'					=> 'postMessage',
		'sanitize_callback'	=> 'sketchpad_sanitize_select',
	) );
	$wp_customize->add_control( 'sketchpad_rss_media_image_size', array(
		'settings'					=> 'sketchpad_rss_media_image_size',
		'section'						=> 'sketchpad_rss_section',
		'label'							=> __( 'Image Size', 'sketchpad-modified' ),
		'choices'						=> array(
			'thumbnail'	=> 'thumbnail',
			'medium'		=> 'medium',
			'large'			=> 'large',
			'full'			=> 'full',
		),
		'type'							=> 'select',
	) );
}

// sketchpad - modified support RSS Feed namespaces.
function sketchpad_support_rss_namespaces() {
	echo <<<EOM
	xmlns:media="http://search.yahoo.com/mrss/"
EOM;
}

// customize to rss feed
function sketchpad_content_feed( $content ) {
  global $post;

	$permalink = esc_url( get_permalink( $post ) );
	
	$content = sketchpad_content2more_read( $post->post_content, $permalink );

	if ( get_theme_mod ( 'sketchpad_rss_output_post_tumbnail', false ) ) {

		if ( has_post_thumbnail ( $post->ID ) ) {
			$thumbnail = sketchpad_get_thumbnail_info( $post->ID, get_theme_mod ( 'sketchpad_rss_media_image_size', 'thumbnail' ) );
			$thumbnail_url = esc_url( $thumbnail['url'] );
			$thumbnail_alt = esc_attr( $thumbnail['alt'] );
			$thumbnail_width = esc_attr( $thumbnail['width'] );
			$thumbnail_height = esc_attr( $thumbnail['height'] );
			$content = <<<EOM

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

// output media element to rss feed
function sketchpad_output_thumbnail_element_2_feed() {
	if ( get_theme_mod ( 'sketchpad_rss_output_post_tumbnail', true ) ) {
		global $post;

		if ( has_post_thumbnail ( $post->ID ) ) {
			$thumbnail = sketchpad_get_thumbnail_info( $post->ID, get_theme_mod ( 'sketchpad_rss_media_image_size', 'thumbnail' ) );
			$thumbnail_url = esc_url( $thumbnail['url'] );
			$thumbnail_width = esc_attr( $thumbnail['width'] );
			$thumbnail_height = esc_attr( $thumbnail['height'] );
			$thumbnail_size = esc_attr( $thumbnail['size'] );
			$thumbnail_mimetype = esc_attr( $thumbnail['mimetype'] );

			if ( get_theme_mod ( 'sketchpad_rss_output_media_content_tag', false ) ) {
				echo <<<EOM
				<enclosure url="{$thumbnail_url}" length="{$thumbnail_size}" type="{$thumbnail_mimetype}" />
EOM;
			}

			if ( get_theme_mod ( 'sketchpad_rss_output_enclosure_tag', false ) ) {
				echo <<<EOM
				<media:content url="{$thumbnail_url}" width="{$thumbnail_width}" height="{$thumbnail_height}" type="{$thumbnail_mimetype}" medium="image" />
EOM;
			}
		}
	}
}

// get post thumbnail information
function sketchpad_get_thumbnail_info( $post_id, $thumbnail_size ) {
	$thumbnail_id = get_post_thumbnail_id( $post_id );
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, $thumbnail_size );
	$alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true ) == "" ? get_post($thumbnail_id)->post_title : get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
	$mimetype = wp_check_filetype( $thumbnail[0] )['type'];
	$filesize = filesize( str_replace( esc_url( home_url( '/' ) ), ABSPATH, $thumbnail[0] ) );

	$thumbnail_info = array(
		'url'				=> $thumbnail[0],
		'width'			=> $thumbnail[1],
		'height'		=> $thumbnail[2],
		'alt'				=> $alt,
		'mimetype'	=> $mimetype,
		'size'			=> $filesize,
	);

	return $thumbnail_info;
}

add_action( 'customize_register', 'sketchpad_customize2rss_register', 100 );
add_action( 'rss2_ns', 'sketchpad_support_rss_namespaces' );
add_action( 'rss2_item', 'sketchpad_output_thumbnail_element_2_feed');
add_filter( 'the_excerpt_rss', 'sketchpad_content_feed' );
add_filter( 'the_content_feed', 'sketchpad_content_feed' );
