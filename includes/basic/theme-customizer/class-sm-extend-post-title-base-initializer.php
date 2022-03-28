<?php
/**
 * Post title extend Base Theme Customizer Initialize class.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * These modules are needed to load this class.
 */
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-abstract-theme-customizer-initializer.php';
require_once get_template_directory() . '/includes/basic/theme-customizer/sanitizer/non.php';

/**
 * Class for Post title extend theme customizer initialize.
 *
 * @since 3.0.0
 */
abstract class SM_Extend_Post_Title_Base_Initializer extends SM_Abstract_Theme_Customizer_Initializer {
	const DEFAULT_SKETCHPAD_PAGE_TITLE_EXTEND_ENABLE = false;
	const DEFAULT_SKETCHPAD_PAGE_TITLE_EXTEND        = '{title}';

	/**
	 * Post type.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string    $post_type Post type string.
	 */
	protected $post_type = '';

	/**
	 * Label for Post type string.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string    $label4post_type Label for post type string.
	 */
	protected $label4post_type = '';

	/**
	 * Sets up a new instance.
	 *
	 * @since 3.0.0
	 * @param string $post_type       Post type string.
	 */
	public function __construct( string $post_type ) {
		parent::__construct( 'sketchpad_post_panel' );

		$this->post_type = $post_type;
	}

	/**
	 * Return the sections definition.
	 *
	 * @since  3.0.0
	 * @return array
	 */
	protected function get_sections():array {
		return array(
			array(
				'id'          => "sketchpad_{$this->post_type}_section",
				'title'       => sprintf(
					/* translators: %1$s: Post type */
					__( '%1$s Title Setting', 'sketchpad-modified' ),
					$this->get_title()
				),
				'description' => sprintf(
					/* translators: %1$s: Post type */
					__( 'Please enter if you want to add text to all %1$s titles.', 'sketchpad-modified' ),
					$this->get_label()
				),
			),
		);
	}

	/**
	 * Return the settings definition.
	 *
	 * @since  3.0.0
	 * @return array
	 */
	protected function get_settings():array {
		return array(
			array(
				'key'               => "sketchpad_{$this->post_type}_title_extend_enable",
				'default'           => self::DEFAULT_SKETCHPAD_PAGE_TITLE_EXTEND_ENABLE,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sketchpad_sanitize_checkbox',
			),
			array(
				'key'               => "sketchpad_{$this->post_type}_title_extend",
				'default'           => self::DEFAULT_SKETCHPAD_PAGE_TITLE_EXTEND,
				'sanitize_callback' => 'sketchpad_non_sanitize',
			),
		);
	}

	/**
	 * Return the controls definition.
	 *
	 * @since  3.0.0
	 * @param  WP_Customize_Manager $wp_customize given by the "customize_register" hook.
	 * @return array
	 */
	protected function get_controls( WP_Customize_Manager $wp_customize ):array {
		return array(
			"sketchpad_{$this->post_type}_title_extend_enable" => array(
				'setting'  => "sketchpad_{$this->post_type}_title_extend_enable",
				'section'  => "sketchpad_{$this->post_type}_section",
				'label'    => sprintf(
					/* translators: %1$s: Post type */
					__( '%1$s title extend enable', 'sketchpad-modified' ),
					$this->get_title()
				),
				'type'     => 'checkbox',
				'priority' => 0,
			),
			"sketchpad_{$this->post_type}_title_extend" => array(
				'setting'     => "sketchpad_{$this->post_type}_title_extend",
				'section'     => "sketchpad_{$this->post_type}_section",
				'label'       => sprintf(
					/* translators: %1$s: Post type */
					__( 'Extend all %1$s titles', 'sketchpad-modified' ),
					$this->get_label()
				),
				'description' => sprintf(
					/* translators: %1$s: Post type */
					__( '* The title of the %1$s is set at location specified by the "{title}" keyword.', 'sketchpad-modified' ),
					$this->get_label()
				),
				'type'        => 'textarea',
			),
		);
	}

	/**
	 * Return the title string.
	 *
	 * @since  3.0.0
	 * @return string
	 */
	abstract protected function get_title():string;

	/**
	 * Return the label string.
	 *
	 * @since  3.0.0
	 * @return string
	 */
	abstract protected function get_label():string;
}
