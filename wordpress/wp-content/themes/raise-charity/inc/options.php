<?php
/**
 * Theme Palace options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

/**
 * List of pages for page choices.
 * @return Array Array of page ids and name.
 */
function raise_charity_page_choices() {
    $pages = get_pages();
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'raise-charity' );
    foreach ( $pages as $page ) {
        $choices[ $page->ID ] = $page->post_title;
    }
    return  $choices;
}

/**
 * List of posts for post choices.
 * @return Array Array of post ids and name.
 */
function raise_charity_post_choices() {
    $posts = get_posts( array( 'numberposts' => -1 ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'raise-charity' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    return  $choices;
}

/**
 * List of events for post choices.
 * @return Array Array of post ids and name.
 */
function raise_charity_event_choices() {
    $posts = get_posts( array( 'numberposts' => -1, 'post_type' => 'tp-event' ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'raise-charity' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    wp_reset_postdata();
    return  $choices;
}



if ( ! function_exists( 'raise_charity_selected_sidebar' ) ) :
    /**
     * Sidebars options
     * @return array Sidbar positions
     */
    function raise_charity_selected_sidebar() {
        $raise_charity_selected_sidebar = array(
            'sidebar-1'             => esc_html__( 'Default Sidebar', 'raise-charity' ),
            'optional-sidebar'      => esc_html__( 'Optional Sidebar 1', 'raise-charity' ),
            'optional-sidebar-2'    => esc_html__( 'Optional Sidebar 2', 'raise-charity' ),
            'optional-sidebar-3'    => esc_html__( 'Optional Sidebar 3', 'raise-charity' ),
            'optional-sidebar-4'    => esc_html__( 'Optional Sidebar 4', 'raise-charity' ),
        );

        $output = apply_filters( 'raise_charity_selected_sidebar', $raise_charity_selected_sidebar );

        return $output;
    }
endif;

if ( ! function_exists( 'raise_charity_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function raise_charity_site_layout() {
        $raise_charity_site_layout = array(
            'wide-layout'  => get_template_directory_uri() . '/assets/images/full.png',
            'boxed-layout' => get_template_directory_uri() . '/assets/images/boxed.png',
        );

        $output = apply_filters( 'raise_charity_site_layout', $raise_charity_site_layout );
        return $output;
    }
endif;


if ( ! function_exists( 'raise_charity_global_sidebar_position' ) ) :
    /**
     * Global Sidebar position
     * @return array Global Sidebar positions
     */
    function raise_charity_global_sidebar_position() {
        $raise_charity_global_sidebar_position = array(
            'right-sidebar' => get_template_directory_uri() . '/assets/images/right.png',
            'no-sidebar'    => get_template_directory_uri() . '/assets/images/full.png',
        );

        $output = apply_filters( 'raise_charity_global_sidebar_position', $raise_charity_global_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'raise_charity_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function raise_charity_sidebar_position() {
        $raise_charity_sidebar_position = array(
            'right-sidebar' => get_template_directory_uri() . '/assets/images/right.png',
            'no-sidebar'    => get_template_directory_uri() . '/assets/images/full.png',
        );

        $output = apply_filters( 'raise_charity_sidebar_position', $raise_charity_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'raise_charity_pagination_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function raise_charity_pagination_options() {
        $raise_charity_pagination_options = array(
            'numeric'   => esc_html__( 'Numeric', 'raise-charity' ),
            'default'   => esc_html__( 'Default(Older/Newer)', 'raise-charity' ),
        );

        $output = apply_filters( 'raise_charity_pagination_options', $raise_charity_pagination_options );

        return $output;
    }
endif;


if ( ! function_exists( 'raise_charity_switch_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function raise_charity_switch_options() {
        $arr = array(
            'on'        => esc_html__( 'Enable', 'raise-charity' ),
            'off'       => esc_html__( 'Disable', 'raise-charity' )
        );
        return apply_filters( 'raise_charity_switch_options', $arr );
    }
endif;

if ( ! function_exists( 'raise_charity_hide_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function raise_charity_hide_options() {
        $arr = array(
            'on'        => esc_html__( 'Yes', 'raise-charity' ),
            'off'       => esc_html__( 'No', 'raise-charity' )
        );
        return apply_filters( 'raise_charity_hide_options', $arr );
    }
endif;

