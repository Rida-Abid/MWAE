<?php
/**
 * Slider Section options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

// Add Slider section
$wp_customize->add_section( 'raise_charity_slider_section', array(
	'title'             => esc_html__( 'Main Slider','raise-charity' ),
	'description'       => esc_html__( 'Slider Section options.', 'raise-charity' ),
	'panel'             => 'raise_charity_front_page_panel',
	'priority' 			=> 10,
) );

// Slider content enable control and setting
$wp_customize->add_setting( 'raise_charity_theme_options[slider_section_enable]', array(
	'default'			=> 	$options['slider_section_enable'],
	'sanitize_callback' => 'raise_charity_sanitize_switch_control',
) );

$wp_customize->add_control( new Raise_Charity_Switch_Control( $wp_customize, 'raise_charity_theme_options[slider_section_enable]', array(
	'label'             => esc_html__( 'Slider Section Enable', 'raise-charity' ),
	'section'           => 'raise_charity_slider_section',
	'on_off_label' 		=> raise_charity_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[slider_section_enable]', array(
		'selector'            => '#featured-slider-section .tooltiptext',
		'settings'            => 'raise_charity_theme_options[slider_section_enable]',
    ) );
}

// Slider btn label setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[slider_btn_label]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['slider_btn_label'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'raise_charity_theme_options[slider_btn_label]', array(
	'label'           	=> esc_html__( 'Slider Button Label', 'raise-charity' ),
	'section'        	=> 'raise_charity_slider_section',
	'active_callback' 	=> 'raise_charity_is_slider_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[slider_btn_label]', array(
		'selector'            => '#featured-slider-section .read-more a.first',
		'settings'            => 'raise_charity_theme_options[slider_btn_label]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_slider_btn_label_partial',
    ) );
}

for ( $i = 1; $i <= 3; $i++ ) :

	// slider pages drop down chooser control and setting
	$wp_customize->add_setting( 'raise_charity_theme_options[slider_content_page_' . $i . ']', array(
		'sanitize_callback' => 'raise_charity_sanitize_page',
	) );

	$wp_customize->add_control( new Raise_Charity_Dropdown_Chooser( $wp_customize, 'raise_charity_theme_options[slider_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'raise-charity' ), $i ),
		'section'           => 'raise_charity_slider_section',
		'choices'			=> raise_charity_page_choices(),
		'active_callback'	=> 'raise_charity_is_slider_section_enable',
	) ) );

	// Alt btn label setting and control
	$wp_customize->add_setting( 'raise_charity_theme_options[slider_alt_btn_label_' . $i . ']', array(
		'sanitize_callback' => 'sanitize_text_field',
		) );

	$wp_customize->add_control( 'raise_charity_theme_options[slider_alt_btn_label_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Alternative Button Label %d', 'raise-charity' ), $i ),
		'section'        	=> 'raise_charity_slider_section',
		'active_callback' 	=> 'raise_charity_is_slider_section_enable',
		'type'				=> 'text',
		) );

	// Slider btn label setting and control
	$wp_customize->add_setting( 'raise_charity_theme_options[slider_alt_btn_url_' . $i . ']', array(
		'sanitize_callback' => 'sanitize_text_field',
		) );

	$wp_customize->add_control( 'raise_charity_theme_options[slider_alt_btn_url_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Alternative Button Link %d', 'raise-charity' ), $i ),
		'section'        	=> 'raise_charity_slider_section',
		'active_callback' 	=> 'raise_charity_is_slider_section_enable',
		'type'				=> 'url',
		) );

endfor;