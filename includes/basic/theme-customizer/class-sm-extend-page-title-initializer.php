<?php
/**
 * Page title extend Theme Customizer Initialize class.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * These modules are needed to load this class.
 */
require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-extend-post-title-base-initializer.php';

/**
 * Class for Page title extend theme customizer initialize.
 *
 * @since 3.0.0
 */
class SM_Extend_Page_Title_Initializer extends SM_Extend_Post_Title_Base_Initializer {
	/**
	 * Sets up a new instance.
	 *
	 * @since 3.0.0
	 */
	public function __construct() {
		parent::__construct( 'page', __( 'Page', 'sketchpad-modified' ), __( 'page', 'sketchpad-modified' ) );
	}


	/**
	 * Return whether the page title be extend or not.
	 *
	 * @since  3.0.0
	 * @return boolean
	 */
	public static function is_extend_sketchpad_title():bool {
		return get_theme_mod( 'sketchpad_page_title_extend_enable', self::DEFAULT_SKETCHPAD_PAGE_TITLE_EXTEND_ENABLE );
	}

	/**
	 * Return the extend string.
	 *
	 * @since  3.0.0
	 * @return string
	 */
	public static function get_sketchpad_title_extend():string {
		return get_theme_mod( 'sketchpad_page_title_extend', self::DEFAULT_SKETCHPAD_PAGE_TITLE_EXTEND );
	}
}
