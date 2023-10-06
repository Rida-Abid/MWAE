<?php

/**
 *
 * @link              https://piecalendar.com
 * @since             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       Pie Calendar
 * Plugin URI:        https://piecalendar.com
 * Description:       Turn any post type into a calendar event and display it on a calendar.
 * Version:           1.1.1
 * Author:            Elijah Mills & Jonathan Jernigan
 * Author URI:        https://piecalendar.com/about
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       piecal
 * Domain Path:       /languages
 * Requires PHP: 7.4
 * Requires at least: 5.9
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'PIECAL_VERSION', '1.1.1' );
define( 'PIECAL_PATH', plugin_dir_url( __FILE__ ) );
define( 'PIECAL_DIR', plugin_dir_path( __FILE__ ) );

// Includes
include_once( PIECAL_DIR . 'includes/metabox.php' );

// File for registering & rendering shortcode.
include_once( PIECAL_DIR . '/includes/shortcode.php' );

// Register scripts & styles
function piecal_register_scripts_and_styles() {
	wp_register_script( 'alpinejs', PIECAL_PATH . 'vendor/alpine.3.11.1.js', ['alpinefocus'] );
	wp_register_script( 'alpinefocus', PIECAL_PATH . 'vendor/alpine.focus.3.11.1.js' );
	wp_register_script( 'fullcalendar', PIECAL_PATH . 'vendor/fullcalendar.6.1.4.js' );
	wp_register_script( 'fullcalendar-locales', PIECAL_PATH . 'vendor/fullcalendar.locales-all.global.min.js' );
	wp_register_style('piecalCSS', PIECAL_PATH . 'css/piecal.css');
	wp_register_style('piecalThemeDarkCSS', PIECAL_PATH . 'css/piecal-theme-dark.css');
	wp_register_style('piecalThemeDarkCSSAdaptive', PIECAL_PATH . 'css/piecal-theme-dark-adaptive.css');
}
add_action('wp_enqueue_scripts', 'piecal_register_scripts_and_styles');

// Defer Alpine script
add_filter( 'script_loader_tag', function ( $tag, $handle ) {

    if ( !in_array($handle, ['alpinejs', 'alpinefocus']) )
        return $tag;

    return str_replace( ' src', ' defer="defer" src', $tag );
}, 10, 2 );


// Register required post meta fields.
add_action( 'init', function() {
	register_post_meta( '', '_piecal_is_event', [
		'show_in_rest' => true,
		'single' => true,
		'type' => 'boolean',
        'auth_callback' => function() { 
            return current_user_can('edit_posts');
        }
	] );
    register_post_meta( '', '_piecal_start_date', [
		'show_in_rest' => true,
		'single' => true,
		'type' => 'string',
        'auth_callback' => function() { 
            return current_user_can('edit_posts');
        }
	] );
    register_post_meta( '', '_piecal_end_date', [
		'show_in_rest' => true,
		'single' => true,
		'type' => 'string',
        'auth_callback' => function() { 
            return current_user_can('edit_posts');
        }
	] );
	register_post_meta( '', '_piecal_is_allday', [
		'show_in_rest' => true,
		'single' => true,
		'type' => 'boolean',
        'auth_callback' => function() { 
            return current_user_can('edit_posts');
        }
	] );

} );


// Load our custom meta script for Gutenberg
add_action( 'enqueue_block_editor_assets', function() {
    if( !post_type_supports( get_post_type(), 'custom-fields' ) ) return;

	wp_enqueue_script(
		'piecalendar-custom-meta-plugin', 
		PIECAL_PATH . '/build/index.js', 
		[ 'wp-edit-post' ],
		false,
		false
	);
} );

// Localize some information in Gutenberg for access in our custom meta script & blocks
function piecal_gutenberg_vars() {
    wp_localize_script(
		'piecalendar-custom-meta-plugin',
        'piecalGbVars',
        array(
			'isWooActive' => is_plugin_active( 'woocommerce/woocommerce.php' ),
			'isEddActive' => is_plugin_active( 'easy-digital-downloads/easy-digital-downloads.php' ),
			'explicitAllowedPostTypes' => apply_filters('piecal_explicit_allowed_post_types', [])
		)
    );
}
add_action( 'enqueue_block_editor_assets', 'piecal_gutenberg_vars' );

// Add link for Pro on plugins page
function piecal_add_plugin_row_meta( $plugin_meta, $plugin_file ) {

	// If we are not on the correct plugin, abort.
	if ( 'pie-calendar/plugin.php' !== $plugin_file ) {
		return $plugin_meta;
	}

	$get_pro  = '<a href="https://piecalendar.com/?utm_campaign=upgrade&utm_source=plugin-page&utm_medium=upgrade-to-pro" aria-label="' . esc_attr( __( 'Navigate to the Pie Calendar website to purchase the Pro version.', 'piecal' ) ) . '" target="_blank" style="color: #D53637; font-weight: bold">';
	$get_pro .= __( 'Upgrade to Pro', 'piecal' );
	$get_pro .= '</a>';

	$row_meta = array(
		'get_pro' => apply_filters('piecal_get_pro_plugin_meta_link', $get_pro)
	);

	$plugin_meta = array_merge( $plugin_meta, $row_meta );

	return $plugin_meta;
}
add_filter( 'plugin_row_meta', 'piecal_add_plugin_row_meta', 10, 2 );
 
/**
 * Load plugin textdomain.
 */
function piecal_load_textdomain() {
  load_plugin_textdomain( 'piecal', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

add_action( 'init', 'piecal_load_textdomain' );

/**
 * Set script translations
 * This doesn't work yet.
 */
// add_action( 'wp_enqueue_scripts', 'piecal_load_js_translations', 100 );

// function piecal_load_js_translations() {
//     wp_set_script_translations( 
//          'piecalendar-custom-meta-plugin',
//          'piecal',
//          plugin_dir_path( __FILE__ ) . 'languages'
//     );
// }
