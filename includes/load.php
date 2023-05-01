<?php
/**
 * These functions are needed to load this theme.
 *
 * @package Sketchpad
 * @since   2.1.0
 */

/**
 * Common function libraries.
 */
require get_template_directory() . '/includes/utils/load.php';

/**
 * Filters.
 */
require get_template_directory() . '/includes/filter/load.php';

/**
 * Blocks.
 */
require get_template_directory() . '/includes/block/styles.php';
require get_template_directory() . '/includes/block/pattern.php';

/**
 * Theme basic features.
 */
require get_template_directory() . '/includes/basic/load.php';
