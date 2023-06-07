<?php
/**
 * Recent Cause Section options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

// Add Recent Cause section
$wp_customize->add_section( 'raise_charity_recent_cause_section', array(
	'title'             => esc_html__( 'Recent Cause','raise-charity' ),
	'description'       => esc_html__( 'Recent Cause Section options.', 'raise-charity' ),
	'panel'             => 'raise_charity_front_page_panel',
	'priority' 			=> 30,

) );

// Recent Cause content enable control and setting
$wp_customize->add_setting( 'raise_charity_theme_options[recent_cause_section_enable]', array(
	'default'			=> 	$options['recent_cause_section_enable'],
	'sanitize_callback' => 'raise_charity_sanitize_switch_control',
) );

$wp_customize->add_control( new Raise_Charity_Switch_Control( $wp_customize, 'raise_charity_theme_options[recent_cause_section_enable]', array(
	'label'             => esc_html__( 'Recent Cause Section Enable', 'raise-charity' ),
	'section'           => 'raise_charity_recent_cause_section',
	'on_off_label' 		=> raise_charity_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[recent_cause_section_enable]', array(
		'selector'            => '#recent-cause-section .tooltiptext',
		'settings'            => 'raise_charity_theme_options[recent_cause_section_enable]',
    ) );
}

// Recent Cause section title setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[recent_cause_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['recent_cause_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'raise_charity_theme_options[recent_cause_title]', array(
	'label'           	=> esc_html__( 'Section Title', 'raise-charity' ),
	'section'        	=> 'raise_charity_recent_cause_section',
	'active_callback' 	=> 'raise_charity_is_recent_cause_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[recent_cause_title]', array(
		'selector'            => '#recent-cause-section h2.section-title',
		'settings'            => 'raise_charity_theme_options[recent_cause_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_recent_cause_title_partial',
    ) );
}

// Recent Cause section title setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[recent_cause_sub_title]', array(
	'sanitize_callback' => 'wp_kses_post',
	'default'			=> $options['recent_cause_sub_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'raise_charity_theme_options[recent_cause_sub_title]', array(
	'label'           	=> esc_html__( 'Section Sub Title', 'raise-charity' ),
	'section'        	=> 'raise_charity_recent_cause_section',
	'active_callback' 	=> 'raise_charity_is_recent_cause_section_enable',
	'type'				=> 'textarea',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[recent_cause_sub_title]', array(
		'selector'            => '#recent-cause-section p.section-subtitle',
		'settings'            => 'raise_charity_theme_options[recent_cause_sub_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_recent_cause_sub_title_partial',
    ) );
}

// Recent Cause btn label setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[recent_cause_btn_label]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['recent_cause_btn_label'],
) );

$wp_customize->add_control( 'raise_charity_theme_options[recent_cause_btn_label]', array(
	'label'           	=> esc_html__( 'Recent Cause Button Label', 'raise-charity' ),
	'section'        	=> 'raise_charity_recent_cause_section',
	'active_callback' 	=> 'raise_charity_is_recent_cause_section_enable',
	'type'				=> 'text',
) );

for ( $i = 1; $i <= 3; $i++ ) :

	// recent_cause posts drop down chooser control and setting
	$wp_customize->add_setting( 'raise_charity_theme_options[recent_cause_content_post_' . $i . ']', array(
		'sanitize_callback' => 'raise_charity_sanitize_page',
	) );

	$wp_customize->add_control( new Raise_Charity_Dropdown_Chooser( $wp_customize, 'raise_charity_theme_options[recent_cause_content_post_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'raise-charity' ), $i ),
		'section'           => 'raise_charity_recent_cause_section',
		'choices'			=> raise_charity_post_choices(),
		'active_callback'	=> 'raise_charity_is_recent_cause_section_enable',
	) ) );

endfor;