<?php
/**
 * Contact Section options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

// Add Contact section
$wp_customize->add_section( 'raise_charity_contact_section', array(
	'title'             => esc_html__( 'Contact Section','raise-charity' ),
	'description'       => esc_html__( 'Contact Section options.', 'raise-charity' ),
	'panel'             => 'raise_charity_front_page_panel',
	'priority' 			=> 80,

	) );

// Contact content enable control and setting
$wp_customize->add_setting( 'raise_charity_theme_options[contact_section_enable]', array(
	'default'			=> 	$options['contact_section_enable'],
	'sanitize_callback' => 'raise_charity_sanitize_switch_control',
	) );

$wp_customize->add_control( new Raise_Charity_Switch_Control( $wp_customize, 'raise_charity_theme_options[contact_section_enable]', array(
	'label'             => esc_html__( 'Contact Section Enable', 'raise-charity' ),
	'section'           => 'raise_charity_contact_section',
	'on_off_label' 		=> raise_charity_switch_options(),
	'priority' 			=> 10, 
	) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[contact_section_enable]', array(
		'selector'            => '#contact-section .tooltiptext',
		'settings'            => 'raise_charity_theme_options[contact_section_enable]',
    ) );
}

// top description setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[contact_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['contact_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'raise_charity_theme_options[contact_title]', array(
	'label'           	=> esc_html__( 'Section Title', 'raise-charity' ),
	'section'        	=> 'raise_charity_contact_section',
	'active_callback' 	=> 'raise_charity_is_contact_section_enable',
	'type'				=> 'text',
	'priority' 			=> 20, 

) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[contact_title]', array(
		'selector'            => '#contact-section h2.section-title',
		'settings'            => 'raise_charity_theme_options[contact_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_contact_title_partial',
    ) );
}

// top description setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[contact_sub_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['contact_sub_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'raise_charity_theme_options[contact_sub_title]', array(
	'label'           	=> esc_html__( 'Section Sub Title', 'raise-charity' ),
	'section'        	=> 'raise_charity_contact_section',
	'active_callback' 	=> 'raise_charity_is_contact_section_enable',
	'type'				=> 'text',
	'priority' 			=> 30, 

) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[contact_sub_title]', array(
		'selector'            => '#contact-section p.section-subtitle',
		'settings'            => 'raise_charity_theme_options[contact_sub_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_contact_sub_title_partial',
    ) );
}

// contact image setting and control.
$wp_customize->add_setting( 'raise_charity_theme_options[contact_image]', array(
	'sanitize_callback' => 'raise_charity_sanitize_image'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'raise_charity_theme_options[contact_image]',
		array(
		'label'       		=> esc_html__( 'Contact BG Image', 'raise-charity' ),
		'section'     		=> 'raise_charity_contact_section',
		'active_callback'	=> 'raise_charity_is_contact_section_enable',
		'priority' 			=> 40, 

) ) );

// top description setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[contact_form_shortcode]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['contact_form_shortcode'],
) );

$wp_customize->add_control( 'raise_charity_theme_options[contact_form_shortcode]', array(
	'label'           	=> esc_html__( 'Contact Form Short', 'raise-charity' ),
	'description'		=> esc_html__( 'Get the form shortcode from contact form 7(CF7) plugin example [contact-form-7 id="3088" title="Untitled"] :', 'raise-charity' ),
	'section'        	=> 'raise_charity_contact_section',
	'active_callback' 	=> 'raise_charity_is_contact_section_enable',
	'type'				=> 'text',
	'priority' 			=> 50, 

) );