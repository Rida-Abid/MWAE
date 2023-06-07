<?php
/**
* Partial functions
*
* @package Theme Palace
* @subpackage Raise Charity
* @since Raise Charity 1.0.0
*/

if ( ! function_exists( 'raise_charity_nav_btn_txt_partial' ) ) :
    // nav_btn_txt
    function raise_charity_nav_btn_txt_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['nav_btn_txt'] );
    }
endif;
if ( ! function_exists( 'raise_charity_copyright_text_partial' ) ) :
    // copyright_text
    function raise_charity_copyright_text_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['copyright_text'] );
    }
endif;

if ( ! function_exists( 'raise_charity_slider_btn_label_partial' ) ) :
    // slider title
    function raise_charity_slider_btn_label_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['slider_btn_label'] );
    }
endif;

if ( ! function_exists( 'raise_charity_about_information_text_partial' ) ) :
    // about_information_text
    function raise_charity_about_information_text_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['about_information_text'] );
    }
endif;

if ( ! function_exists( 'raise_charity_about_btn_title_partial' ) ) :
    // about btn title
    function raise_charity_about_btn_title_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['about_btn_title'] );
    }
endif;

if ( ! function_exists( 'raise_charity_recent_cause_title_partial' ) ) :
    //recent cause title
    function raise_charity_recent_cause_title_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['recent_cause_title'] );
    }
endif;

if ( ! function_exists( 'raise_charity_recent_cause_sub_title_partial' ) ) :
    //recent cause sub title
    function raise_charity_recent_cause_sub_title_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['recent_cause_sub_title'] );
    }
endif;

if ( ! function_exists( 'raise_charity_service_title_partial' ) ) :
    // service_title
    function raise_charity_service_title_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['service_title'] );
    }
endif;

if ( ! function_exists( 'raise_charity_service_sub_title_partial' ) ) :
    // service_sub_title
    function raise_charity_service_sub_title_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['service_sub_title'] );
    }
endif;

if ( ! function_exists( 'raise_charitymotion_button_partial' ) ) :
    // promotion_button
    function raise_charitymotion_button_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['promotion_button'] );
    }
endif;

if ( ! function_exists( 'raise_charity_team_title_partial' ) ) :
    // team_title
    function raise_charity_team_title_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['team_title'] );
    }
endif;

if ( ! function_exists( 'raise_charity_team_sub_title_partial' ) ) :
    // team_sub_title
    function raise_charity_team_sub_title_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['team_sub_title'] );
    }
endif;

if ( ! function_exists( 'raise_charity_latest_posts_title_partial' ) ) :
    // latest_posts_title
    function raise_charity_latest_posts_title_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['latest_posts_title'] );
    }
endif;

if ( ! function_exists( 'raise_charity_latest_posts_sub_title_partial' ) ) :
    // latest_posts_sub_title
    function raise_charity_latest_posts_sub_title_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['latest_posts_sub_title'] );
    }
endif;

if ( ! function_exists( 'raise_charity_contact_title_partial' ) ) :
    // contact_title
    function raise_charity_contact_title_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['contact_title'] );
    }
endif;

if ( ! function_exists( 'raise_charity_contact_sub_title_partial' ) ) :
    // contact_sub_title
    function raise_charity_contact_sub_title_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['contact_sub_title'] );
    }
endif;

if ( ! function_exists( 'raise_charity_read_more_text_partial' ) ) :
    // read_more_text
    function raise_charity_read_more_text_partial() {
        $options = raise_charity_get_theme_options();
        return esc_html( $options['read_more_text'] );
    }
endif;