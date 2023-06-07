<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'raise_charity_excerpt_section', array(
	'title'             => esc_html__( 'Excerpt','raise-charity' ),
	'description'       => esc_html__( 'Excerpt section options.', 'raise-charity' ),
	'panel'             => 'raise_charity_theme_options_panel',
) );


// long Excerpt length setting and control.
$wp_customize->add_setting( 'raise_charity_theme_options[long_excerpt_length]', array(
	'sanitize_callback' => 'raise_charity_sanitize_number_range',
	'validate_callback' => 'raise_charity_validate_long_excerpt',
	'default'			=> $options['long_excerpt_length'],
) );

$wp_customize->add_control( 'raise_charity_theme_options[long_excerpt_length]', array(
	'label'       		=> esc_html__( 'Blog Page Excerpt Length', 'raise-charity' ),
	'description' 		=> esc_html__( 'Total words to be displayed in archive page/search page.', 'raise-charity' ),
	'section'     		=> 'raise_charity_excerpt_section',
	'type'        		=> 'number',
	'input_attrs' 		=> array(
		'style'       => 'width: 80px;',
		'max'         => 100,
		'min'         => 5,
	),
) );
