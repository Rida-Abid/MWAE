<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  Raise Charity 1.0.0
 * @access public
 */
final class Raise_Charity_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since Raise Charity 1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since Raise Charity 1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since Raise Charity 1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since Raise Charity 1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require trailingslashit( get_template_directory() ) . 'inc/customizer/upgrade-to-pro/section-pro.php' ;

		// Register custom section types.
		$manager->register_section_type( 'Raise_Charity_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Raise_Charity_Customize_Section_Pro(
				$manager,
				'raise-charity',
				array(
					'title'    => esc_html__( 'Raise Charity Pro','raise-charity' ),
					'pro_text' => esc_html__( 'Go Pro','raise-charity' ),
					'pro_url'  => esc_url( 'https://themepalace.com/downloads/raise-charity-pro/' )
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since Raise Charity 1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'raise-charity-go-pro-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/upgrade-to-pro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'raise-charity-go-pro-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/upgrade-to-pro/customize-controls.css' );
	}
}

// Doing this customizer thang!
Raise_Charity_Customize::get_instance();
