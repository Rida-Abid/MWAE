<?php
/**
* Homepage (Static ) options
*
* @package Theme Palace
* @subpackage Raise Charity
* @since Raise Charity 1.0.0
*/

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'raise_charity_theme_options[enable_frontpage_content]', array(
	'sanitize_callback'   => 'raise_charity_sanitize_checkbox',
	'default'             => $options['enable_frontpage_content'],
) );

$wp_customize->add_control( 'raise_charity_theme_options[enable_frontpage_content]', array(
	'label'       	=> esc_html__( 'Enable Content', 'raise-charity' ),
	'description' 	=> esc_html__( 'Check to enable content on static front page only.', 'raise-charity' ),
	'section'     	=> 'static_front_page',
	'type'        	=> 'checkbox',
	'active_callback' => 'raise_charity_is_static_homepage_enable',
) );