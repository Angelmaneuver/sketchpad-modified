<?php
/**
 * These functions are needed to load sketchpad - modified Theme.
 *
 * @package sketchpad
 * @since   2.1.0
 */

/**
 * Utils.
 */
require get_template_directory() . '/includes/utils/sm-utility.php';
require get_template_directory() . '/includes/utils/sm-sanitizer.php';

/**
 * Filters.
 */
require get_template_directory() . '/includes/filter/sm-categories.php';

/**
 * Block styles.
 */
require get_template_directory() . '/includes/block-style/sm-style.php';

/**
 * Functions.
 */
require get_template_directory() . '/includes/sm-basic.php';
require get_template_directory() . '/includes/sm-breadcrumb.php';
require get_template_directory() . '/includes/sm-rss.php';
