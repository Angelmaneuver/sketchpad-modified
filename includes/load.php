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
require get_template_directory() . '/includes/filter/sm-dropdown-categories.php';
require get_template_directory() . '/includes/filter/sm-tag-cloud.php';

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

/**
 * Widgets.
 */
require get_template_directory() . '/includes/widgets/class-sm-widget-recent-posts.php';

/**
 * Register Recent Posts Widgets.
 *
 * @since 2.1.0
 * @see   widgets/class-sm-widget-recent-posts.php
 */
function register_sketchpad_recent_posts_widgets() {
	register_widget( 'SM_Widget_Recent_Posts' );
}

add_action( 'widgets_init', 'register_sketchpad_recent_posts_widgets' );
