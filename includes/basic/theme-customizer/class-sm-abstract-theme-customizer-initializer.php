<?php
/**
 * Abstract Theme Customizer Initialize class.
 *
 * @package    Sketchpad
 * @subpackage theme customizer
 * @since      3.0.0
 */

/**
 * Class for abstract theme customizer initialize.
 *
 * @since 3.0.0
 */
abstract class SM_Abstract_Theme_Customizer_Initializer {
	const WP_OBJECT_START_WITH = 'WP_OBJECT';

	/**
	 * Panel name to be registered.
	 *
	 * @since  3.0.0
	 * @access private
	 * @var    string  $panel Panel name to be registered.
	 */
	private $panel = '';

	/**
	 * Sets up a new instance.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  string $panel Panel name to be registered.
	 */
	public function __construct( string $panel ) {
		$this->panel = $panel;
	}

	/**
	 * Return the sections definition (abstract method).
	 *
	 * @since  3.0.0
	 * @return array
	 */
	abstract protected function get_sections():array;

	/**
	 * Return the settings definition (abstract method).
	 *
	 * @since  3.0.0
	 * @return array
	 */
	abstract protected function get_settings():array;

	/**
	 * Return the controls definition (abstract method).
	 *
	 * @since  3.0.0
	 * @param  WP_Customize_Manager $wp_customize given by the "customize_register" hook.
	 * @return array
	 */
	abstract protected function get_controls( WP_Customize_Manager $wp_customize ):array;

	/**
	 * Sets up a theme customizer.
	 *
	 * @since  3.0.0
	 * @param  WP_Customize_Manager $wp_customize given by the "customize_register" hook.
	 * @return void
	 */
	public function init( WP_Customize_Manager $wp_customize ):void {
		foreach ( $this->get_sections() as $section ) {
			$id = $section['id'];
			unset( $section['id'] );

			$args          = $section;
			$args['panel'] = $this->panel;

			$wp_customize->add_section( $id, $args );
		}

		foreach ( $this->get_settings() as $setting ) {
			$this->add_setting( $wp_customize, $setting );
		}

		foreach ( $this->get_controls( $wp_customize ) as $key => $value ) {
			$this->add_control( $wp_customize, $key, $value );
		}
	}

	/**
	 * Add a customize setting.
	 *
	 * @since  3.0.0
	 * @param  WP_Customize_Manager $wp_customize Given by the "customize_register" hook.
	 * @param  array                $setting      Parameter of the setting.
	 * @return void
	 */
	private function add_setting( WP_Customize_Manager $wp_customize, array $setting ):void {
		if ( array_key_exists( 'key', $setting ) ) {
			$key = $setting['key'];
			unset( $setting['key'] );

			if ( array_key_exists( 'sanitize_callback', $setting ) ) {
				$sanitizer = $setting['sanitize_callback'];
				unset( $setting['sanitize_callback'] );

				$wp_customize->add_setting(
					$key,
					array_merge(
						$setting,
						array(
							'sanitize_callback' => $sanitizer,
						)
					)
				);
			}
		}
	}

	/**
	 * Add a customize control.
	 *
	 * @since  3.0.0
	 * @param  WP_Customize_Manager       $wp_customize given by the "customize_register" hook.
	 * @param  string                     $key          ID of the control to be added.
	 * @param  WP_Customize_Control|array $value        Customize Control object, or Parameter of the control.
	 * @return void
	 */
	private function add_control( WP_Customize_Manager $wp_customize, string $key, $value ):void {
		if ( 0 === strpos( $key, self::WP_OBJECT_START_WITH ) ) {
			$wp_customize->add_control( $value );
		} else {
			$wp_customize->add_control( $key, $value );
		}
	}
}
