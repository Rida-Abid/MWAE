<?php
/**
 * Menu options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'raise_charity_menu', array(
	'title'             => esc_html__('Header Menu','raise-charity'),
	'description'       => esc_html__( 'Header Menu options.', 'raise-charity' ),
	'panel'             => 'nav_menus',
) );

// button enable setting and control.
$wp_customize->add_setting( 'raise_charity_theme_options[nav_btn]', array(
	'sanitize_callback' => 'raise_charity_sanitize_switch_control',
	'default'           => $options['nav_btn'],
) );

$wp_customize->add_control( new Raise_Charity_Switch_Control( $wp_customize, 'raise_charity_theme_options[nav_btn]', array(
	'label'             => esc_html__( 'Enable Button', 'raise-charity' ),
	'section'           => 'raise_charity_menu',
	'on_off_label' 		=> raise_charity_switch_options(),
) ) );

// button text setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[nav_btn_txt]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['nav_btn_txt'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'raise_charity_theme_options[nav_btn_txt]', array(
	'label'           	=> esc_html__( 'Button Label', 'raise-charity' ),
	'active_callback' 	=> 'raise_charity_is_nav_btn_enable',
	'section'        	=> 'raise_charity_menu',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[nav_btn_txt]', array(
		'selector'            => '#site-menu li.custom-menu-item a',
		'settings'            => 'raise_charity_theme_options[nav_btn_txt]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_nav_btn_txt_partial',
    ) );
}

// button url setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[nav_btn_url]', array(
	'sanitize_callback' => 'esc_url_raw',
	'default'			=> $options['nav_btn_url'],
) );

$wp_customize->add_control( 'raise_charity_theme_options[nav_btn_url]', array(
	'label'           	=> esc_html__( 'Button URL', 'raise-charity' ),
	'section'        	=> 'raise_charity_menu',
	'active_callback' 	=> 'raise_charity_is_nav_btn_enable',
	'type'				=> 'url'
) );