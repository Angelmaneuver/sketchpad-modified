<?php
/**
 * Theme API: Abstract Theme Customizer Initialize class.
 *
 * @package    sketchpad
 * @subpackage theme customizer
 * @since      2.1.0
 */

/**
 * Class for abstract theme customizer initialize.
 *
 * @since 2.1.0
 */
abstract class SM_Abstract_Theme_Customizer_Initializer {
	/**
	 * Sets up a new instance.
	 */
	public function __construct() {}

	/**
	 * Return the panels definition (abstract method).
	 *
	 * @return array array( string $id, array $args )
	 */
	abstract protected function get_panels();

	/**
	 * Return the sections definition (abstract method).
	 *
	 * @return array array( string $id, array $args )
	 */
	abstract protected function get_sections();

	/**
	 * Return the settings definition (abstract method).
	 *
	 * @return array array( string $id, array $args )
	 */
	abstract protected function get_settings();

	/**
	 * Return the controls definition (abstract method).
	 *
	 * @return array array( string $id, array $args )
	 */
	abstract protected function get_controls();

	/**
	 * Sets up a theme customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize given by the "customize_register" hook.
	 * @return void
	 */
	public function init( WP_Customize_Manager $wp_customize ) {
		foreach ( $this->get_panels() as $key => $value ) {
			$wp_customize->add_panel( $key, $value );
		}

		foreach ( $this->get_sections() as $key => $value ) {
			$wp_customize->add_section( $key, $value );
		}

		foreach ( $this->get_settings() as $key => $value ) {
			$wp_customize->add_setting( $key, $value );
		}

		foreach ( $this->get_controls() as $key => $value ) {
			$wp_customize->add_control( $key, $value );
		}
	}
}
