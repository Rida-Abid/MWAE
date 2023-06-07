<?php
/**
 * Demo Import.
 *
 * This is the template that includes all the other files for core featured of Theme Palace
 *
 * @package Theme Palace
 * @subpackage Raise Charity 
 * @since Raise Charity  1.0.0
 */

function raise_charity_ctdi_plugin_page_setup( $default_settings ) {
    $default_settings['menu_title']  = esc_html__( 'Theme Palace Demo Import' , 'raise-charity' );

    return $default_settings;
}
add_filter( 'cp-ctdi/plugin_page_setup', 'raise_charity_ctdi_plugin_page_setup' );


function raise_charity_ctdi_plugin_intro_text( $default_text ) {
    $default_text .= sprintf( '<p class="about-description">%1$s <a href="%2$s">%3$s</a></p>', esc_html__( 'Demo content files for Raise Charity Theme.', 'raise-charity' ),
    esc_url( 'https://themepalace.com/instructions/themes/raise-charity/' ), esc_html__( 'Click here for Demo File download', 'raise-charity' ) );
    return $default_text;
}
add_filter( 'cp-ctdi/plugin_intro_text', 'raise_charity_ctdi_plugin_intro_text' );