<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'raise_charity_reset_section', array(
	'title'             => esc_html__('Reset all settings','raise-charity'),
	'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'raise-charity' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'raise_charity_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'raise_charity_sanitize_checkbox',
	'transport'			  => 'postMessage',
) );

$wp_customize->add_control( 'raise_charity_theme_options[reset_options]', array(
	'label'             => esc_html__( 'Check to reset all settings', 'raise-charity' ),
	'section'           => 'raise_charity_reset_section',
	'type'              => 'checkbox',
) );
