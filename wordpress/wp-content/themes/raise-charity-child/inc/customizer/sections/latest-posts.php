<?php
/**
 * Latest Posts Section options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

// Add Latest Posts section
$wp_customize->add_section( 'raise_charity_latest_posts_section', array(
	'title'             => esc_html__( 'Latest Posts','raise-charity' ),
	'description'       => esc_html__( 'Latest Posts Section options.', 'raise-charity' ),
	'panel'             => 'raise_charity_front_page_panel',
	'priority' 			=> 70,

) );

// Latest Posts content enable control and setting
$wp_customize->add_setting( 'raise_charity_theme_options[latest_posts_section_enable]', array(
	'default'			=> 	$options['latest_posts_section_enable'],
	'sanitize_callback' => 'raise_charity_sanitize_switch_control',
) );

$wp_customize->add_control( new Raise_Charity_Switch_Control( $wp_customize, 'raise_charity_theme_options[latest_posts_section_enable]', array(
	'label'             => esc_html__( 'Latest Posts Section Enable', 'raise-charity' ),
	'section'           => 'raise_charity_latest_posts_section',
	'on_off_label' 		=> raise_charity_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[latest_posts_section_enable]', array(
		'selector'            => '#latest-posts-section .tooltiptext',
		'settings'            => 'raise_charity_theme_options[latest_posts_section_enable]',
    ) );
}

// Latest Posts btn label setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[latest_posts_title]', array(
	'sanitize_callback' => 'wp_kses_post',
	'default'			=> $options['latest_posts_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'raise_charity_theme_options[latest_posts_title]', array(
	'label'           	=> esc_html__( 'Section Title', 'raise-charity' ),
	'section'        	=> 'raise_charity_latest_posts_section',
	'active_callback' 	=> 'raise_charity_is_latest_posts_section_enable',
	'type'				=> 'textarea',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[latest_posts_title]', array(
		'selector'            => '#latest-posts-section h2.section-title',
		'settings'            => 'raise_charity_theme_options[latest_posts_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_latest_posts_title_partial',
    ) );
}

// Latest Posts btn label setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[latest_posts_sub_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['latest_posts_sub_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'raise_charity_theme_options[latest_posts_sub_title]', array(
	'label'           	=> esc_html__( 'Section Sub Title', 'raise-charity' ),
	'section'        	=> 'raise_charity_latest_posts_section',
	'active_callback' 	=> 'raise_charity_is_latest_posts_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'raise_charity_theme_options[latest_posts_sub_title]', array(
		'selector'            => '#latest-posts-section p.section-subtitle',
		'settings'            => 'raise_charity_theme_options[latest_posts_sub_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'raise_charity_latest_posts_sub_title_partial',
    ) );
}

// Latest Posts btn label setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[latest_posts_btn_text]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['latest_posts_btn_text'],
) );

$wp_customize->add_control( 'raise_charity_theme_options[latest_posts_btn_text]', array(
	'label'           	=> esc_html__( 'Button Label', 'raise-charity' ),
	'section'        	=> 'raise_charity_latest_posts_section',
	'active_callback' 	=> 'raise_charity_is_latest_posts_section_enable',
	'type'				=> 'text',
) );

// Latest Posts content type control and setting
$wp_customize->add_setting( 'raise_charity_theme_options[latest_posts_content_type]', array(
	'default'          	=> $options['latest_posts_content_type'],
	'sanitize_callback' => 'raise_charity_sanitize_select',
) );

$wp_customize->add_control( 'raise_charity_theme_options[latest_posts_content_type]', array(
	'label'             => esc_html__( 'Content Type', 'raise-charity' ),
	'section'           => 'raise_charity_latest_posts_section',
	'type'				=> 'select',
	'active_callback' 	=> 'raise_charity_is_latest_posts_section_enable',
	'choices'			=> array(
		'post'      => esc_html__( 'Post', 'raise-charity' ),
		'category'  => esc_html__( 'Category', 'raise-charity' ),
		),
) );

for ( $i = 1; $i <= 3; $i++ ) :

	// latest_posts posts drop down chooser control and setting
	$wp_customize->add_setting( 'raise_charity_theme_options[latest_posts_content_post_' . $i . ']', array(
		'sanitize_callback' => 'raise_charity_sanitize_page',
	) );

	$wp_customize->add_control( new Raise_Charity_Dropdown_Chooser( $wp_customize, 'raise_charity_theme_options[latest_posts_content_post_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'raise-charity' ), $i ),
		'section'           => 'raise_charity_latest_posts_section',
		'choices'			=> raise_charity_post_choices(),
		'active_callback'	=> 'raise_charity_is_latest_posts_section_content_post_enable',
	) ) );

endfor;

// Add dropdown category setting and control.
$wp_customize->add_setting(  'raise_charity_theme_options[latest_posts_content_category]', array(
	'sanitize_callback' => 'raise_charity_sanitize_single_category',
) ) ;

$wp_customize->add_control( new Raise_Charity_Dropdown_Taxonomies_Control( $wp_customize,'raise_charity_theme_options[latest_posts_content_category]', array(
	'label'             => esc_html__( 'Select Category', 'raise-charity' ),
	'description'      	=> esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'raise-charity' ),
	'section'           => 'raise_charity_latest_posts_section',
	'type'              => 'dropdown-taxonomies',
	'active_callback'	=> 'raise_charity_is_latest_posts_section_content_category_enable'
) ) );