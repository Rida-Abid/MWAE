<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'raise_charity_single_post_section', array(
	'title'             => esc_html__( 'Single Post','raise-charity' ),
	'description'       => esc_html__( 'Options to change the single posts globally.', 'raise-charity' ),
	'panel'             => 'raise_charity_theme_options_panel',
) );

// Tourableve date meta setting and control.
$wp_customize->add_setting( 'raise_charity_theme_options[single_post_hide_date]', array(
	'default'           => $options['single_post_hide_date'],
	'sanitize_callback' => 'raise_charity_sanitize_switch_control',
) );

$wp_customize->add_control( new Raise_Charity_Switch_Control( $wp_customize, 'raise_charity_theme_options[single_post_hide_date]', array(
	'label'             => esc_html__( 'Hide Date', 'raise-charity' ),
	'section'           => 'raise_charity_single_post_section',
	'on_off_label' 		=> raise_charity_hide_options(),
) ) );

// Tourableve author meta setting and control.
$wp_customize->add_setting( 'raise_charity_theme_options[single_post_hide_author]', array(
	'default'           => $options['single_post_hide_author'],
	'sanitize_callback' => 'raise_charity_sanitize_switch_control',
) );

$wp_customize->add_control( new Raise_Charity_Switch_Control( $wp_customize, 'raise_charity_theme_options[single_post_hide_author]', array(
	'label'             => esc_html__( 'Hide Author', 'raise-charity' ),
	'section'           => 'raise_charity_single_post_section',
	'on_off_label' 		=> raise_charity_hide_options(),
) ) );