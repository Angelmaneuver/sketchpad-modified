<?php
/**
 * Basic customize function.
 *
 * @package    Sketchpad
 * @subpackage basic
 * @since      3.0.0
 */

/**
 * These modules are needed to load this function.
 */
require get_template_directory() . '/includes/basic/functions/insert-head-tag.php';
require get_template_directory() . '/includes/basic/functions/insert-body-tag.php';
require get_template_directory() . '/includes/basic/functions/background-color.php';
require get_template_directory() . '/includes/basic/functions/return2top-button.php';
require get_template_directory() . '/includes/basic/functions/rss.php';

if ( current_user_can( 'edit_theme_options' ) & ( is_admin() || is_customize_preview() ) ) {
	/**
	 * These modules are needed to load this function.
	 */
	require_once get_template_directory() . '/includes/basic/theme-customizer/class-sm-admin-page-setting-initializer.php';
	require_once get_template_directory() . '/includes/basic/functions/admin-page-setting.php';

	/**
	 * Set up the panel.
	 *
	 * @since 3.0.0
	 * @param WP_Customize_Manager $wp_customize The Customizer object.
	 */
	function sketchpad_customizer4basic_register( $wp_customize ) {
		$wp_customize->add_panel(
			'sketchpad_basic_panel',
			array(
				'title'    => __( 'Site Setting', 'sketchpad-modified' ),
				'priority' => 1010,
			)
		);
	}

	add_action( 'customize_register', array( new SM_Admin_Page_Setting_Initializer(), 'init' ), 10 );
	add_action( 'customize_register', 'sketchpad_customizer4basic_register', 10 );
	add_action( 'customize_register', array( new SM_Insert_Head_Tag_Initializer(), 'init' ), 100 );
	add_action( 'customize_register', array( new SM_Insert_Body_Tag_Initializer(), 'init' ), 100 );
	add_action( 'customize_register', array( new SM_Color_Setting_Initializer(), 'init' ), 100 );
	add_action( 'customize_register', array( new SM_Return2Top_Button_Initializer(), 'init' ), 100 );
	add_action( 'customize_register', array( new SM_RSS_Initializer(), 'init' ), 10 );
}
