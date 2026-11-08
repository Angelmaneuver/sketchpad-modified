<?php
/**
 * Extends the core functionality of WordPress.
 *
 * @package    Sketchpad
 * @subpackage filter
 * @since      3.1.0
 */

/**
 * Apply image-specific output attributes.
 *
 * @param  string $block_content The block content about to be appended.
 * @param  array  $block         The full block, including name and attributes.
 * @return string                Filtering results.
 * @see    https://developer.wordpress.org/reference/hooks/render_block_this-name/
 */
function render_block_image_sketchpad_filter( string $block_content, array $block ): string {
	$is_header_image     = ! empty( $block['attrs']['className'] ) && str_contains( $block['attrs']['className'], 'sketchpad-header-image' );
	$has_fetch_priority  = array_key_exists( 'sketchpadFetchPriority', $block['attrs'] );
	$fetch_priority      = $block['attrs']['sketchpadFetchPriority'] ?? ( $is_header_image ? 'high' : '' );
	$fetch_priority      = in_array( $fetch_priority, array( 'high', 'low', 'auto' ), true ) ? $fetch_priority : '';
	$unitless_dimensions = array();
	foreach ( array( 'width', 'height' ) as $dimension ) {
		if ( 'none' !== ( $block['attrs'][ 'sketchpad' . ucfirst( $dimension ) . 'Unit' ] ?? 'px' ) ) {
			continue;
		}

		$value = $block['attrs'][ $dimension ] ?? '';
		if ( preg_match( '/^(\d+)px$/', (string) $value, $matches ) ) {
			$unitless_dimensions[ $dimension ] = $matches[1];
		}
	}

	if ( '' === $fetch_priority && ! $has_fetch_priority && empty( $unitless_dimensions ) ) {
		return $block_content;
	}

	if ( ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
		return (string) preg_replace_callback(
			'/<img\b[^>]*>/i',
			static function ( array $matches ) use ( $fetch_priority, $has_fetch_priority, $unitless_dimensions ): string {
				$image = $matches[0];
				if ( '' !== $fetch_priority ) {
					$attribute = ' fetchpriority="' . esc_attr( $fetch_priority ) . '"';
					if ( preg_match( '/\sfetchpriority="[^"]*"/i', $image ) ) {
						$image = (string) preg_replace( '/\sfetchpriority="[^"]*"/i', $attribute, $image, 1 );
					} else {
						$image = (string) preg_replace( '/<img\b/i', '<img' . $attribute, $image, 1 );
					}
				} elseif ( $has_fetch_priority ) {
					$image = (string) preg_replace( '/\sfetchpriority="[^"]*"/i', '', $image, 1 );
				}

				$image = (string) preg_replace_callback(
					'/\sstyle=(["\'])(.*?)\1/i',
					static function ( array $style_matches ) use ( $unitless_dimensions ): string {
						$style = $style_matches[2];
						foreach ( array_keys( $unitless_dimensions ) as $dimension ) {
							$style = (string) preg_replace( '/(^|;)\s*' . $dimension . '\s*:[^;]*/i', '$1', $style );
						}

						$style = trim( $style, " \t\n\r\0\x0B;" );
						return '' === $style ? '' : ' style=' . $style_matches[1] . $style . $style_matches[1];
					},
					$image,
					1
				);

				foreach ( $unitless_dimensions as $dimension => $value ) {
					$attribute = ' ' . $dimension . '="' . esc_attr( $value ) . '"';
					$pattern   = '/\s' . $dimension . '="[^"]*"/i';
					if ( preg_match( $pattern, $image ) ) {
						$image = (string) preg_replace( $pattern, $attribute, $image, 1 );
					} else {
						$image = (string) preg_replace( '/\s*\/?>$/', $attribute . '>', $image, 1 );
					}
				}

				return $image;
			},
			$block_content,
			1
		);
	}

	$processor = new WP_HTML_Tag_Processor( $block_content );
	if ( $processor->next_tag( 'img' ) ) {
		if ( '' !== $fetch_priority ) {
			$processor->set_attribute( 'fetchpriority', $fetch_priority );
		} elseif ( $has_fetch_priority ) {
			$processor->remove_attribute( 'fetchpriority' );
		}

		foreach ( $unitless_dimensions as $dimension => $value ) {
			$processor->set_attribute( $dimension, $value );
		}

		$style = $processor->get_attribute( 'style' );
		if ( is_string( $style ) ) {
			foreach ( array_keys( $unitless_dimensions ) as $dimension ) {
				$style = (string) preg_replace( '/(^|;)\s*' . $dimension . '\s*:[^;]*/i', '$1', $style );
			}

			$style = trim( $style, " \t\n\r\0\x0B;" );
			if ( '' === $style ) {
				$processor->remove_attribute( 'style' );
			} else {
				$processor->set_attribute( 'style', $style );
			}
		}

		$block_content = $processor->get_updated_html();
	}

	return $block_content;
}

add_filter( 'render_block_core/image', 'render_block_image_sketchpad_filter', 10, 2 );

/**
 * Mark template export requests so their template parts can be adjusted.
 *
 * @param  mixed           $response The current response, if any.
 * @param  array           $handler  The matched REST handler.
 * @param  WP_REST_Request $request  The current request.
 * @return mixed                     The unchanged response.
 */
function sketchpad_mark_template_export_request( $response, array $handler, WP_REST_Request $request ) {
	if ( '/wp-block-editor/v1/export' === $request->get_route() ) {
		$GLOBALS['sketchpad_template_export_request'] = true;
	}

	return $response;
}

add_filter( 'rest_request_before_callbacks', 'sketchpad_mark_template_export_request', 10, 3 );

/**
 * Apply saved image attributes to template parts included in a theme export.
 *
 * @param  WP_Block_Template[] $templates     The queried templates.
 * @param  array               $query         Arguments used to retrieve templates.
 * @param  string              $template_type The template post type.
 * @return WP_Block_Template[]                Updated templates.
 */
function sketchpad_filter_exported_template_parts( array $templates, array $query, string $template_type ): array {
	if ( empty( $GLOBALS['sketchpad_template_export_request'] ) || 'wp_template_part' !== $template_type ) {
		return $templates;
	}

	foreach ( $templates as $template ) {
		$template->content = serialize_blocks( sketchpad_filter_exported_image_blocks( parse_blocks( $template->content ) ) );
	}

	return $templates;
}

add_filter( 'get_block_templates', 'sketchpad_filter_exported_template_parts', 10, 3 );

/**
 * Apply image output attributes recursively while preserving block comments.
 *
 * @param  array $blocks Parsed blocks.
 * @return array         Updated parsed blocks.
 */
function sketchpad_filter_exported_image_blocks( array $blocks ): array {
	foreach ( $blocks as &$block ) {
		if ( 'core/image' === $block['blockName'] ) {
			$block['innerHTML'] = render_block_image_sketchpad_filter( $block['innerHTML'], $block );
			if ( isset( $block['innerContent'][0] ) ) {
				$block['innerContent'][0] = $block['innerHTML'];
			}
		}

		if ( ! empty( $block['innerBlocks'] ) ) {
			$block['innerBlocks'] = sketchpad_filter_exported_image_blocks( $block['innerBlocks'] );
		}
	}

	return $blocks;
}
