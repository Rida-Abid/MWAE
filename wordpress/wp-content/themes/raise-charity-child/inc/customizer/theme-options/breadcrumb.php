<?php
/**
 * Breadcrumb options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

$wp_customize->add_section( 'raise_charity_breadcrumb', array(
	'title'             => esc_html__( 'Breadcrumb','raise-charity' ),
	'description'       => esc_html__( 'Breadcrumb section options.', 'raise-charity' ),
	'panel'             => 'raise_charity_theme_options_panel',
) );

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'raise_charity_theme_options[breadcrumb_enable]', array(
	'sanitize_callback' => 'raise_charity_sanitize_switch_control',
	'default'          	=> $options['breadcrumb_enable'],
) );

$wp_customize->add_control( new Raise_Charity_Switch_Control( $wp_customize, 'raise_charity_theme_options[breadcrumb_enable]', array(
	'label'            	=> esc_html__( 'Enable Breadcrumb', 'raise-charity' ),
	'section'          	=> 'raise_charity_breadcrumb',
	'on_off_label' 		=> raise_charity_switch_options(),
) ) );

// Breadcrumb separator setting and control.
$wp_customize->add_setting( 'raise_charity_theme_options[breadcrumb_separator]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
	'default'          	=> $options['breadcrumb_separator'],
) );

$wp_customize->add_control( 'raise_charity_theme_options[breadcrumb_separator]', array(
	'label'            	=> esc_html__( 'Separator', 'raise-charity' ),
	'active_callback' 	=> 'raise_charity_is_breadcrumb_enable',
	'section'          	=> 'raise_charity_breadcrumb',
) );
