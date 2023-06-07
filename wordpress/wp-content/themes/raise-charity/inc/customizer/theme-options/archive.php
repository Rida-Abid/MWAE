<?php
/**
 * Archive options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

// Add archive section
$wp_customize->add_section( 'raise_charity_archive_section', array(
	'title'             => esc_html__( 'Blog/Archive','raise-charity' ),
	'description'       => esc_html__( 'Archive section options.', 'raise-charity' ),
	'panel'             => 'raise_charity_theme_options_panel',
) );

// features content type control and setting
$wp_customize->add_setting( 'raise_charity_theme_options[blog_page_column]', array(
	'default'          	=> $options['blog_page_column'],
	'sanitize_callback' => 'raise_charity_sanitize_select',
) );

$wp_customize->add_control( 'raise_charity_theme_options[blog_page_column]', array(
	'label'             => esc_html__( 'Column Layout', 'raise-charity' ),
	'section'           => 'raise_charity_archive_section',
	'type'				=> 'select',
	'choices'			=> array( 
		'col-2'		=> esc_html__( 'Two Column', 'raise-charity' ),
		'col-3'		=> esc_html__( 'Three Column', 'raise-charity' ),
	),
) );

// Blog btn label setting and control
$wp_customize->add_setting( 'raise_charity_theme_options[blog_page_post_btn]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['blog_page_post_btn'],
) );

$wp_customize->add_control( 'raise_charity_theme_options[blog_page_post_btn]', array(
	'label'           	=> esc_html__( 'Blog Post Button', 'raise-charity' ),
	'section'        	=> 'raise_charity_archive_section',
	'type'				=> 'text',
) );


