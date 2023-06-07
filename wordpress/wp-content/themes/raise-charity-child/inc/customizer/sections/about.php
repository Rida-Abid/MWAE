<?php
/**
 * About Section options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

// Add About section
$wp_customize->add_section( 'raise_charity_about_section', array(
	'title'             => esc_html__( 'About Us','raise-charity' ),
	'description'       => esc_html__( 'About Us Section options.', 'raise-charity' ),
	'panel'             => 'raise_charity_front_page_panel',
	'priority' 			=> 20,
	
) );

// About content enable control and setting
$wp_customize->add_setting( 'raise_charity_theme_options[about_section_enable]', array(
	'default'			=> 	$options['about_section_enable'],
	'sanitize_callback' => 'raise_charity_sanitize_switch_control',
) );

$wp_customize->add_control( new Raise_Charity_Switch_Control( $wp_customize, 'raise_charity_theme_options[about_section_enable]', array(
	'label'             => esc_html__( 'About Section Enable', 'raise-charity' ),
	'section'           => 'raise_charity_about_section',
	'on_off_label' 		=> raise_charity_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[about_section_enable]', array(
		'selector'            => '#about-section .tooltiptext',
		'settings'            => 'raise_charity_theme_options[about_section_enable]',
    ) );
}

// about sub title setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[about_information_text]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['about_information_text'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'raise_charity_theme_options[about_information_text]', array(
	'label'           	=> esc_html__( 'Information Text', 'raise-charity' ),
	'section'        	=> 'raise_charity_about_section',
	'active_callback' 	=> 'raise_charity_is_about_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[about_information_text]', array(
		'selector'            => '#about-section div.info-wrapper',
		'settings'            => 'raise_charity_theme_options[about_information_text]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_about_information_text_partial',
    ) );
}

// about posts drop down chooser control and setting
$wp_customize->add_setting( 'raise_charity_theme_options[about_content_post]', array(
	'sanitize_callback' => 'raise_charity_sanitize_page',
) );

$wp_customize->add_control( new Raise_Charity_Dropdown_Chooser( $wp_customize, 'raise_charity_theme_options[about_content_post]', array(
	'label'             => esc_html__( 'Select Post', 'raise-charity' ),
	'section'           => 'raise_charity_about_section',
	'choices'			=> raise_charity_post_choices(),
	'active_callback'	=> 'raise_charity_is_about_section_enable',
) ) );

// about btn title setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[about_btn_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['about_btn_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'raise_charity_theme_options[about_btn_title]', array(
	'label'           	=> esc_html__( 'Button Label', 'raise-charity' ),
	'section'        	=> 'raise_charity_about_section',
	'active_callback' 	=> 'raise_charity_is_about_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[about_btn_title]', array(
		'selector'            => '#about-section div.read-more a',
		'settings'            => 'raise_charity_theme_options[about_btn_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_about_btn_title_partial',
    ) );
}