<?php
/**
 * Service Section options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

// Add Service section
$wp_customize->add_section( 'raise_charity_service_section', array(
	'title'             => esc_html__( 'Services','raise-charity' ),
	'description'       => esc_html__( 'Services Section options.', 'raise-charity' ),
	'panel'             => 'raise_charity_front_page_panel',
	'priority' 			=> 40,

) );

// Service content enable control and setting
$wp_customize->add_setting( 'raise_charity_theme_options[service_section_enable]', array(
	'default'			=> 	$options['service_section_enable'],
	'sanitize_callback' => 'raise_charity_sanitize_switch_control',
) );

$wp_customize->add_control( new Raise_Charity_Switch_Control( $wp_customize, 'raise_charity_theme_options[service_section_enable]', array(
	'label'             => esc_html__( 'Service Section Enable', 'raise-charity' ),
	'section'           => 'raise_charity_service_section',
	'on_off_label' 		=> raise_charity_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[service_section_enable]', array(
		'selector'            => '#service-section .tooltiptext',
		'settings'            => 'raise_charity_theme_options[service_section_enable]',
    ) );
}

// service title setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[service_title]',
	array(
		'default'       		=> $options['service_title'],
		'sanitize_callback'		=> 'sanitize_text_field',
		'transport'				=> 'postMessage',
	)
);
$wp_customize->add_control( 'raise_charity_theme_options[service_title]',
    array(
		'label'      			=> esc_html__( 'Section Title', 'raise-charity' ),
		'section'    			=> 'raise_charity_service_section',
		'type'		 			=> 'text',
		'active_callback'		=> 'raise_charity_is_service_section_enable',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[service_title]', array(
		'selector'            => '#service-section h2.section-title',
		'settings'            => 'raise_charity_theme_options[service_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_service_title_partial',
    ) );
}

// service title setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[service_sub_title]',
	array(
		'default'       		=> $options['service_sub_title'],
		'sanitize_callback'		=> 'wp_kses_post',
		'transport'				=> 'postMessage',
	)
);
$wp_customize->add_control( 'raise_charity_theme_options[service_sub_title]',
    array(
		'label'      			=> esc_html__( 'Section Sub Title', 'raise-charity' ),
		'section'    			=> 'raise_charity_service_section',
		'type'		 			=> 'textarea',
		'active_callback'		=> 'raise_charity_is_service_section_enable',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[service_sub_title]', array(
		'selector'            => '#service-section p.section-subtitle',
		'settings'            => 'raise_charity_theme_options[service_sub_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_service_sub_title_partial',
    ) );
}

$wp_customize->add_setting( 'raise_charity_theme_options[service_image]', array(
		'sanitize_callback' => 'raise_charity_sanitize_image'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'raise_charity_theme_options[service_image]',
			array(
			'label'       		=> esc_html__( 'Service Image ', 'raise-charity' ),
			'section'     		=> 'raise_charity_service_section',
			'active_callback'	=> 'raise_charity_is_service_section_enable',
	) ) );

for ( $i = 1; $i <= 3; $i++ ) :

	// service note control and setting
	$wp_customize->add_setting( 'raise_charity_theme_options[service_content_icon_' . $i . ']', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Raise_Charity_Icon_Picker( $wp_customize, 'raise_charity_theme_options[service_content_icon_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Icon %d', 'raise-charity' ), $i ),
		'section'           => 'raise_charity_service_section',
		'active_callback'	=> 'raise_charity_is_service_section_enable',
	) ) );

	// service posts drop down chooser control and setting
	$wp_customize->add_setting( 'raise_charity_theme_options[service_content_post_' . $i . ']', array(
		'sanitize_callback' => 'raise_charity_sanitize_page',
	) );

	$wp_customize->add_control( new Raise_Charity_Dropdown_Chooser( $wp_customize, 'raise_charity_theme_options[service_content_post_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'raise-charity' ), $i ),
		'section'           => 'raise_charity_service_section',
		'choices'			=> raise_charity_post_choices(),
		'active_callback'	=> 'raise_charity_is_service_section_enable',
	) ) );

endfor;