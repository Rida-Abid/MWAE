<?php
/**
 * Team Section options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

// Add Team section
$wp_customize->add_section( 'raise_charity_team_section', array(
	'title'             => esc_html__( 'Teams','raise-charity' ),
	'description'       => esc_html__( 'Teams Section options.', 'raise-charity' ),
	'panel'             => 'raise_charity_front_page_panel',
	'priority' 			=> 60,

) );

// Team content enable control and setting
$wp_customize->add_setting( 'raise_charity_theme_options[team_section_enable]', array(
	'default'			=> 	$options['team_section_enable'],
	'sanitize_callback' => 'raise_charity_sanitize_switch_control',
) );

$wp_customize->add_control( new Raise_Charity_Switch_Control( $wp_customize, 'raise_charity_theme_options[team_section_enable]', array(
	'label'             => esc_html__( 'Team Section Enable', 'raise-charity' ),
	'section'           => 'raise_charity_team_section',
	'on_off_label' 		=> raise_charity_switch_options(),
) ) );


if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[team_section_enable]', array(
		'selector'            => '#team-section .tooltiptext',
		'settings'            => 'raise_charity_theme_options[team_section_enable]',
    ) );
}

// team title setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[team_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['team_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'raise_charity_theme_options[team_title]', array(
	'label'           	=> esc_html__( 'Title', 'raise-charity' ),
	'section'        	=> 'raise_charity_team_section',
	'active_callback' 	=> 'raise_charity_is_team_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[team_title]', array(
		'selector'            => '#team-section h2.section-title',
		'settings'            => 'raise_charity_theme_options[team_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_team_title_partial',
    ) );
}
// team sub_title setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[team_sub_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['team_sub_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'raise_charity_theme_options[team_sub_title]', array(
	'label'           	=> esc_html__( 'Sub Title', 'raise-charity' ),
	'section'        	=> 'raise_charity_team_section',
	'active_callback' 	=> 'raise_charity_is_team_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[team_sub_title]', array(
		'selector'            => '#team-section p.section-subtitle',
		'settings'            => 'raise_charity_theme_options[team_sub_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_team_sub_title_partial',
    ) );
}

for ( $i = 1; $i <= 3; $i++ ) :

	// team pages drop down chooser control and setting
	$wp_customize->add_setting( 'raise_charity_theme_options[team_content_page_' . $i . ']', array(
		'sanitize_callback' => 'raise_charity_sanitize_page',
	) );

	$wp_customize->add_control( new Raise_Charity_Dropdown_Chooser( $wp_customize, 'raise_charity_theme_options[team_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'raise-charity' ), $i ),
		'section'           => 'raise_charity_team_section',
		'choices'			=> raise_charity_page_choices(),
		'active_callback'	=> 'raise_charity_is_team_section_enable',
	) ) );

	// team custom content
	$wp_customize->add_setting( 'raise_charity_theme_options[team_position_' . $i . ']', array(
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'raise_charity_theme_options[team_position_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Position %d', 'raise-charity' ), $i ),
		'section'           => 'raise_charity_team_section',
		'active_callback'	=> 'raise_charity_is_team_section_enable',
	) );

	// team title setting and control
	$wp_customize->add_setting( 'raise_charity_theme_options[team_btn_' . $i . ']', array(
		'sanitize_callback' => 'sanitize_text_field',
		) );

	$wp_customize->add_control( 'raise_charity_theme_options[team_btn_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Profile Button %d', 'raise-charity' ), $i ),
		'section'        	=> 'raise_charity_team_section',
		'active_callback' 	=> 'raise_charity_is_team_section_enable',
		'type'				=> 'text',
		) );

	// team title setting and control
	$wp_customize->add_setting( 'raise_charity_theme_options[team_btn_url_' . $i . ']', array(
		'sanitize_callback' => 'esc_url_raw',
		) );

	$wp_customize->add_control( 'raise_charity_theme_options[team_btn_url_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Profile Button Link %d', 'raise-charity' ), $i ),
		'section'        	=> 'raise_charity_team_section',
		'active_callback' 	=> 'raise_charity_is_team_section_enable',
		'type'				=> 'url',
		) );

	// team hr setting and control
	$wp_customize->add_setting( 'raise_charity_theme_options[team_hr_'. $i .']', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( new Raise_Charity_Customize_Horizontal_Line( $wp_customize, 'raise_charity_theme_options[team_hr_'. $i .']',
		array(
			'section'         => 'raise_charity_team_section',
			'active_callback' => 'raise_charity_is_team_section_enable',
			'type'			  => 'hr'
	) ) );
endfor;