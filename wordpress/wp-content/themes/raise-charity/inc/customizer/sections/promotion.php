<?php
/**
 * Promotion Section options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

// Add Promotion section
$wp_customize->add_section( 'raise_charity_promotion_section', array(
	'title'             => esc_html__( 'Promotion','raise-charity' ),
	'description'       => esc_html__( 'Promotion Section options.', 'raise-charity' ),
	'panel'             => 'raise_charity_front_page_panel',
	'priority' 			=> 50,

) );

// Promotion content enable control and setting
$wp_customize->add_setting( 'raise_charity_theme_options[promotion_section_enable]', array(
	'default'			=> 	$options['promotion_section_enable'],
	'sanitize_callback' => 'raise_charity_sanitize_switch_control',
) );

$wp_customize->add_control( new Raise_Charity_Switch_Control( $wp_customize, 'raise_charity_theme_options[promotion_section_enable]', array(
	'label'             => esc_html__( 'Promotion Section Enable', 'raise-charity' ),
	'section'           => 'raise_charity_promotion_section',
	'on_off_label' 		=> raise_charity_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[promotion_section_enable]', array(
		'selector'            => '#promotion-section .tooltiptext',
		'settings'            => 'raise_charity_theme_options[promotion_section_enable]',
    ) );
}

// promotion number control and setting
$wp_customize->add_setting( 'raise_charity_theme_options[promotion_image]', array(
	'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'raise_charity_theme_options[promotion_image]', array(
	'label'             => esc_html__( 'Background Image', 'raise-charity' ),
	'section'           => 'raise_charity_promotion_section',
	'active_callback'   => 'raise_charity_is_promotion_section_enable',
) ) );

// promotion pages drop down chooser control and setting
$wp_customize->add_setting( 'raise_charity_theme_options[promotion_content_page]', array(
	'sanitize_callback' => 'raise_charity_sanitize_page',
) );

$wp_customize->add_control( new Raise_Charity_Dropdown_Chooser( $wp_customize, 'raise_charity_theme_options[promotion_content_page]', array(
	'label'             => esc_html__( 'Select Page', 'raise-charity' ),
	'section'           => 'raise_charity_promotion_section',
	'choices'			=> raise_charity_page_choices(),
	'active_callback'	=> 'raise_charity_is_promotion_section_enable',
) ) );

// promotion title setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[promotion_button]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['promotion_button'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'raise_charity_theme_options[promotion_button]', array(
	'label'           	=> esc_html__( 'Promotion Button', 'raise-charity' ),
	'section'        	=> 'raise_charity_promotion_section',
	'active_callback' 	=> 'raise_charity_is_promotion_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[promotion_button]', array(
		'selector'            => '#promotion-section .read-more a',
		'settings'            => 'raise_charity_theme_options[promotion_button]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_promotion_button_partial',
    ) );
}