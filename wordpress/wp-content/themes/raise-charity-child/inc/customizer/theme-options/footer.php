<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

// Footer Section
$wp_customize->add_section( 'raise_charity_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'raise-charity' ),
		'priority'   			=> 900,
		'panel'      			=> 'raise_charity_theme_options_panel',
	)
);

// footer text
$wp_customize->add_setting( 'raise_charity_theme_options[copyright_text]',
	array(
		'default'       		=> $options['copyright_text'],
		'sanitize_callback'		=> 'raise_charity_santize_allow_tag',
		'transport'				=> 'postMessage',
	)
);
$wp_customize->add_control( 'raise_charity_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'raise-charity' ),
		'section'    			=> 'raise_charity_section_footer',
		'type'		 			=> 'textarea',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[copyright_text]', array(
		'selector'            => '.site-info span',
		'settings'            => 'raise_charity_theme_options[copyright_text]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_copyright_text_partial',
    ) );
}