<?php
/**
 * Block styles.
 *
 * @package    Sketchpad
 * @subpackage block
 * @since      3.0.0
 */

/**
 * Theme custom block style register.
 *
 * @since  3.0.0
 * @return void
 */
function register_sketchpad_block_styles():void {
	// Theme specific styles.
	batch_register_sketchpad_specific_block_styles(
		require get_theme_file_path( '/includes/block/style/specific/sketchpad.php' )
	);

	batch_register_sketchpad_specific_block_styles(
		require get_theme_file_path( '/includes/block/style/specific/postit.php' ),
		'-postit',
		' - Postit',
		false
	);

	// Option style.
	$option_styles = array(
		'core/column',
		'core/group',
		'core/heading',
		'core/paragraph',
	);

	foreach ( $option_styles as $style ) {
		$style_file = get_theme_file_path( '/includes/block/style/' . $style . '.php' );

		batch_register_sketchpad_block_styles(
			$style,
			require $style_file
		);
	}
};

add_action( 'init', 'register_sketchpad_block_styles' );

/**
 * Batch register for styles.
 *
 * @since 3.0.0
 * @param string $block_name   Block type name including namespace.
 * @param array  $block_styles Array of block style definitions to register.
 * @return void
 */
function batch_register_sketchpad_block_styles( string $block_name, array $block_styles ):void {
	foreach ( $block_styles as $style ) {
		$style_name  = $style['name'];
		$style_label = $style['label'];

		register_sketchpad_block_style_by_style_handle( $block_name, $style_name, $style_label );
	}
}

/**
 * Batch register for specific styles.
 *
 * @since 3.0.0
 * @param array  $block_styles     Array of block style definitions to register.
 * @param string $additional_name  Name to be given additionally to the block style to be batch registered.
 * @param string $additional_lable Lable to be given additionally to the block style to be batch registered.
 * @param bool   $assign_number    Whether to give sequential numbers to name and label.
 * @return void
 */
function batch_register_sketchpad_specific_block_styles(
	array $block_styles,
	string $additional_name = '',
	string $additional_lable = '',
	bool $assign_number = true
):void {
	$style_name  = 'sketchpad';
	$style_label = __( 'Sketchpad Style', 'sketchpad-modified' );

	foreach ( $block_styles as $style ) {
		$name   = $style['name'];
		$number = isset( $style['number'] ) ? $style['number'] : 1;

		for ( $i = 1; $i <= $number; $i++ ) {
			register_sketchpad_block_style_by_style_handle(
				$name,
				"{$style_name}{$additional_name}" . ( $assign_number ? "{$i}" : '' ),
				"{$style_label}{$additional_lable}" . ( $assign_number ? "{$i}" : '' ),
			);
		}
	}
}

/**
 * Wrapper methods (register_block_style).
 *
 * @since  3.0.0
 * @param  string $block_name  Block type name including namespace.
 * @param  string $style_name  Style name.
 * @param  string $style_label Label.
 * @return boolean True if the block style was registered with success and false otherwise.
 * @see    https://developer.wordpress.org/reference/functions/register_block_style/
 */
function register_sketchpad_block_style_by_style_handle(
	string $block_name,
	string $style_name,
	string $style_label
):bool {
	return register_block_style(
		$block_name,
		array(
			'name'         => $style_name,
			'label'        => $style_label,
			'style_handle' => 'sketchpad-style',
		)
	);
}

/**
 * Enqueue stylesheets by blocks.
 *
 * @since  3.0.0
 * @return void
 */
function enqueue_sketchpad_block_styles():void {
	// Common Setting.
	$extension = '.min.css';

	// Core block stylesheets.
	$specific_prefix  = 'sketchpad';
	$css_directory    = 'assets/stylesheets/css/core/';
	$stylesheets_file = get_theme_file_path( '/includes/block/enqueue/core.php' );

	foreach ( require $stylesheets_file as $style ) {
		enqueue_sketchpad_block_style(
			$style['name'],
			"{$specific_prefix}-{$style['handle']}",
			"{$css_directory}{$style['src']}{$extension}",
			( isset( $style['path_set'] ) && $style['path_set'] ? true : false )
		);
	}

	// Sketchpad modified Blocks's stylesheets.
	$sketcpad_modified_blocks_css_directory = 'assets/stylesheets/css/sketchpad-modified-blocks/';
	$stylesheets_file                       = get_theme_file_path( '/includes/block/enqueue/sketchpad-modified-blocks.php' );

	foreach ( require $stylesheets_file as $style ) {
		enqueue_sketchpad_block_style(
			$style['name'],
			"{$style['handle']}",
			"{$sketcpad_modified_blocks_css_directory}{$style['src']}{$extension}",
			( isset( $style['path_set'] ) && $style['path_set'] ? true : false )
		);
	}

	// Jetpack's stylesheets.
	$jetpack_css_directory = 'assets/stylesheets/css/jetpack/';
	$stylesheets_file      = get_theme_file_path( '/includes/block/enqueue/jetpack.php' );

	foreach ( require $stylesheets_file as $style ) {
		enqueue_sketchpad_block_style(
			$style['name'],
			"{$style['handle']}",
			"{$jetpack_css_directory}{$style['src']}{$extension}",
			( isset( $style['path_set'] ) && $style['path_set'] ? true : false )
		);
	}
}

add_action( 'after_setup_theme', 'enqueue_sketchpad_block_styles' );

/**
 * Wrapper methods (wp_enqueue_block_style).
 *
 * @since  3.0.0
 * @param  string  $block_name The block-name, including namespace.
 * @param  string  $handle     The handle name of the stylesheets to enqueue.
 * @param  string  $src        The file path of the stylesheets to enqueue.
 * @param  boolean $path_set   True if allow inline loading of stylesheets.
 * @return void
 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_block_style/
 */
function enqueue_sketchpad_block_style( string $block_name, string $handle, string $src, bool $path_set ):void {
	wp_enqueue_block_style(
		$block_name,
		array(
			'handle' => $handle,
			'src'    => get_theme_file_uri( $src ),
			'path'   => ( $path_set ? get_theme_file_path( $src ) : $path_set ),
			'ver'    => (string) filemtime( get_theme_file_path( $src ) ),
		)
	);
}
