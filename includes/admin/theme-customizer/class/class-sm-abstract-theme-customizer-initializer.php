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
	const WP_OBJECT_START_WITH = 'WP_OBJECT';

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
	 * @param  WP_Customize_Manager $wp_customize given by the "customize_register" hook.
	 * @return array array( string $id, WP_Customize_Control|array $value Customize Control object, or Parameter of the control )
	 */
	abstract protected function get_controls( WP_Customize_Manager $wp_customize );

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
			$this->add_setting( $wp_customize, $key, $value );
		}

		foreach ( $this->get_controls( $wp_customize ) as $key => $value ) {
			$this->add_control( $wp_customize, $key, $value );
		}
	}

	/**
	 * Add a customize setting.
	 *
	 * @param  WP_Customize_Manager $wp_customize given by the "customize_register" hook.
	 * @param  string               $key          ID of the setting to be added.
	 * @param  array                $value        Parameter of the setting.
	 * @return void
	 */
	private function add_setting(
		WP_Customize_Manager $wp_customize,
		string $key,
		array $value
	) {
		if ( array_key_exists( 'sanitize_callback', $value ) ) {
			$sanitizer = $value['sanitize_callback'];
			unset( $value['sanitize_callback'] );

			$wp_customize->add_setting(
				$key,
				array_merge(
					$value,
					array(
						'sanitize_callback' => $sanitizer,
					)
				)
			);
		}
	}

	/**
	 * Add a customize control.
	 *
	 * @param  WP_Customize_Manager       $wp_customize given by the "customize_register" hook.
	 * @param  string                     $key          ID of the control to be added.
	 * @param  WP_Customize_Control|array $value        Customize Control object, or Parameter of the control.
	 * @return void
	 */
	private function add_control(
		WP_Customize_Manager $wp_customize,
		string $key,
		$value
	) {
		if ( 0 === strpos( $key, self::WP_OBJECT_START_WITH ) ) {
			$wp_customize->add_control( $value );
		} else {
			$wp_customize->add_control( $key, $value );
		}
	}
}
