<?php
/**
 * Layout options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'raise_charity_layout', array(
	'title'               => esc_html__('Layout','raise-charity'),
	'description'         => esc_html__( 'Layout section options.', 'raise-charity' ),
	'panel'               => 'raise_charity_theme_options_panel',
) );

// Site layout setting and control.
$wp_customize->add_setting( 'raise_charity_theme_options[site_layout]', array(
	'sanitize_callback'   => 'raise_charity_sanitize_select',
	'default'             => $options['site_layout'],
) );

$wp_customize->add_control(  new Raise_Charity_Custom_Radio_Image_Control ( $wp_customize, 'raise_charity_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'raise-charity' ),
	'section'             => 'raise_charity_layout',
	'choices'			  => raise_charity_site_layout(),
) ) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'raise_charity_theme_options[sidebar_position]', array(
	'sanitize_callback'   => 'raise_charity_sanitize_select',
	'default'             => $options['sidebar_position'],
) );

$wp_customize->add_control(  new Raise_Charity_Custom_Radio_Image_Control ( $wp_customize, 'raise_charity_theme_options[sidebar_position]', array(
	'label'               => esc_html__( 'Global Sidebar Position', 'raise-charity' ),
	'section'             => 'raise_charity_layout',
	'choices'			  => raise_charity_global_sidebar_position(),
) ) );

// Post sidebar position setting and control.
$wp_customize->add_setting( 'raise_charity_theme_options[post_sidebar_position]', array(
	'sanitize_callback'   => 'raise_charity_sanitize_select',
	'default'             => $options['post_sidebar_position'],
) );

$wp_customize->add_control(  new Raise_Charity_Custom_Radio_Image_Control ( $wp_customize, 'raise_charity_theme_options[post_sidebar_position]', array(
	'label'               => esc_html__( 'Posts Sidebar Position', 'raise-charity' ),
	'section'             => 'raise_charity_layout',
	'choices'			  => raise_charity_sidebar_position(),
) ) );

// Post sidebar position setting and control.
$wp_customize->add_setting( 'raise_charity_theme_options[page_sidebar_position]', array(
	'sanitize_callback'   => 'raise_charity_sanitize_select',
	'default'             => $options['page_sidebar_position'],
) );

$wp_customize->add_control( new Raise_Charity_Custom_Radio_Image_Control( $wp_customize, 'raise_charity_theme_options[page_sidebar_position]', array(
	'label'               => esc_html__( 'Pages Sidebar Position', 'raise-charity' ),
	'section'             => 'raise_charity_layout',
	'choices'			  => raise_charity_sidebar_position(),
) ) );