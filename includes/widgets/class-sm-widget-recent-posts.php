<?php
/**
 * Widget API: SM_Widget_Recent_Posts class
 *
 * @package Sketchpad - modified
 * @subpackage widgets
 * @since 1.0.0
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 1.0.0
 *
 * @see WP_Widget
 */
class SM_Widget_Recent_Posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'sm_widget_recent_entries',
			'description'                 => __( 'Your site&#8217;s most recent Posts. (Sketchpad - modified)', 'sketchpad-modified' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'sm_recent-posts', __( 'Recent Posts (Sketchpad - modified)', 'sketchpad-modified' ), $widget_ops );
		$this->alt_option_name = 'sm_widget_recent_entries';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$default_title = __( 'Recent Posts', 'sketchpad-modified' );
		$title         = isset( $instance['title'] ) ? $instance['title'] : $default_title;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$add_slug              = isset( $instance['add_slug'] ) ? $instance['add_slug'] : false;
		$not_show_current_post = isset( $instance['not_show_current_post'] ) ? $instance['not_show_current_post'] : false;
		$show_date             = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$show_categories       = isset( $instance['show_categories'] ) ? $instance['show_categories'] : array();
		$show_thumbnail        = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : false;

		$base_condition = array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		);

		$option_condition = array();

		if ( $not_show_current_post && is_single() ) {
			$option_condition['post__not_in'] = array( get_the_ID() );
		}

		if ( ! empty( $show_categories && ! in_array( 0, $show_categories ) ) ) {
			$option_condition['category__in'] = $show_categories;
		}

		$r = new WP_Query(
			/**
			 * Filters the arguments for the Recent Posts widget.
			 *
			 * @since 1.0.0
			 *
			 * @see WP_Query::get_posts()
			 *
			 * @param array $args     An array of arguments used to retrieve the recent posts.
			 * @param array $instance Array of settings for the current widget.
			 */
			apply_filters(
				'widget_posts_args',
				array_merge( $base_condition, $option_condition ),
				$instance
			)
		);

		if ( ! $r->have_posts() ) {
			return;
		}
		?>

		<?php echo $args['before_widget']; ?>

		<?php
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$format = current_theme_supports( 'html5', 'navigation-widgets' ) ? 'html5' : 'xhtml';

		/** This filter is documented in wp-includes/widgets/class-wp-nav-menu-widget.php */
		$format = apply_filters( 'navigation_widgets_format', $format );

		if ( 'html5' === $format ) {
			// The title may be filtered: Strip out HTML and make sure the aria-label is never empty.
			$title      = trim( wp_all_strip_tags( $title ) );
			$aria_label = $title ? $title : $default_title;
			echo '<nav role="navigation" aria-label="' . esc_attr( $aria_label ) . '">';
		}
		?>

		<ul>
			<?php foreach ( $r->posts as $recent_post ) : ?>
				<?php
				$post_title   = get_the_title( $recent_post->ID );
				$title        = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
				$tags         = get_the_tags( $recent_post->ID );
				$tags2class   = ' class="' . $this->alt_option_name . '" ';
				$aria_current = '';

				if ( get_queried_object_id() === $recent_post->ID ) {
					$aria_current = ' aria-current="page"';
				}

				if ( $add_slug && $tags ) {
					$slugs = array();
					foreach ( $tags as $tag ) {
						$slugs[] = esc_attr( 'tag-' . $tag->slug );
					}
					$tags2class = ' class="' . $this->alt_option_name . ' ' . implode( ' ', $slugs ) . '" ';
				}

				$thumbnail = get_the_post_thumbnail( $recent_post->ID, array( 130, 130 ) );
				?>
				<li<?php echo $tags2class; ?>>
					<a href="<?php the_permalink( $recent_post->ID ); ?>"<?php echo $aria_current; ?>>
						<?php echo ( $show_thumbnail && ! empty( $thumbnail ) ) ? $thumbnail : ''; ?>
						<span class="post-title"><?php echo $title; ?></span>
					</a>
					<?php if ( $show_date ) : ?>
						<span class="post-date"><?php echo get_the_date( '', $recent_post->ID ); ?></span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php
		if ( 'html5' === $format ) {
			echo '</nav>';
		}

		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                          = $old_instance;
		$instance['title']                 = sanitize_text_field( $new_instance['title'] );
		$instance['number']                = (int) $new_instance['number'];
		$instance['add_slug']              = isset( $new_instance['add_slug'] ) ? (bool) $new_instance['add_slug'] : false;
		$instance['not_show_current_post'] = isset( $new_instance['not_show_current_post'] ) ? (bool) $new_instance['not_show_current_post'] : false;
		$instance['show_date']             = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_categories']       = isset( $new_instance['show_categories'] ) ? array_map( 'absint', $new_instance['show_categories'] ) : array();
		$instance['show_thumbnail']        = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title                 = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number                = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$add_slug              = isset( $instance['add_slug'] ) ? (bool) $instance['add_slug'] : false;
		$not_show_current_post = isset( $instance['not_show_current_post'] ) ? (bool) $instance['not_show_current_post'] : false;
		$show_date             = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$show_categories       = isset( $instance['show_categories'] ) ? $instance['show_categories'] : array();
		$categories            = count(
			get_categories(
				array(
					'hierarchical' => true,
					'number'       => 10,
				)
			)
		);
		$categories            = ( 10 > $categories ) ? $categories + 1 : $categories;
		$show_thumbnail        = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : false;
		?>

		<h4><?php _e( 'Display Options', 'sketchpad-modified' ); ?></h4>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $add_slug ); ?> id="<?php echo $this->get_field_id( 'add_slug' ); ?>" name="<?php echo $this->get_field_name( 'add_slug' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'add_slug' ); ?>"><?php _e( 'Output the tag to the class.', 'sketchpad-modified' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $not_show_current_post ); ?> id="<?php echo $this->get_field_id( 'not_show_current_post' ); ?>" name="<?php echo $this->get_field_name( 'not_show_current_post' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'not_show_current_post' ); ?>"><?php _e( 'Don\'t show the currently viewed articles in the list.', 'sketchpad-modified' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Show the date of posting.', 'sketchpad-modified' ); ?></label>
		</p>
		<h4><?php _e( 'Filter by categories', 'sketchpad-modified' ); ?></h4>
		<p>
			<?php
			wp_dropdown_categories(
				array(
					'name'               => $this->get_field_name( 'show_categories[]' ),
					'id'                 => $this->get_field_id( 'show_categories' ),
					'class'              => 'widefat',
					'depth'              => 0,
					'show_option_all'    => __( 'Show all categories.', 'sketchpad-modified' ),
					'selected'           => false,
					'hide_if_empty'      => true,
					'hierarchical'       => true,
					'echo'               => true,
					'sketchpad_multiple' => true,
					'sketchpad_size'     => $categories,
					'sketchpad_selected' => $show_categories,
				)
			);
			?>
		</p>
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_thumbnail ); ?> id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>"><?php _e( 'Display a thumbnail image.', 'sketchpad-modified' ); ?></label>
		</p>
		<?php
	}
}
