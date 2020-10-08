<?php
/**
 * These functions are needed to load sketchpad - modified Theme.
 *
 * @package sketchpad - modified
 * @since 1.0.0
 */

// utils
require get_template_directory() . '/includes/utils/sm-utility.php';
require get_template_directory() . '/includes/utils/sm-sanitizer.php';

// filter
require get_template_directory() . '/includes/filter/sm-dropdown-categories.php';

// block style
require get_template_directory() . '/includes/block-style/sm-style.php';

// functions
require get_template_directory() . '/includes/sm-basic.php';
require get_template_directory() . '/includes/sm-breadcrumb.php';
require get_template_directory() . '/includes/sm-rss.php';

// widgets
require get_template_directory() . '/includes/widgets/class-sm-widget-recent-posts.php';

function register_sketchpad_recent_posts_widgets() {
  register_widget( 'SM_Widget_Recent_Posts' );
}

add_action( 'widgets_init', 'register_sketchpad_recent_posts_widgets' );
