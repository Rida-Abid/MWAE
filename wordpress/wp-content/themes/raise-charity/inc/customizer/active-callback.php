<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

if ( ! function_exists( 'raise_charity_is_breadcrumb_enable' ) ) :
	/**
	 * Check if breadcrumb is enabled.
	 *
	 * @since Raise Charity 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function raise_charity_is_breadcrumb_enable( $control ) {
		return $control->manager->get_setting( 'raise_charity_theme_options[breadcrumb_enable]' )->value();
	}
endif;

if ( ! function_exists( 'raise_charity_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since Raise Charity 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function raise_charity_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'raise_charity_theme_options[pagination_enable]' )->value();
	}
endif;

if ( ! function_exists( 'raise_charity_is_static_homepage_enable' ) ) :
	/**
	 * Check if static homepage is enabled.
	 *
	 * @since Raise Charity 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function raise_charity_is_static_homepage_enable( $control ) {
		return ( 'page' == $control->manager->get_setting( 'show_on_front' )->value() );
	}
endif;

if ( ! function_exists( 'raise_charity_is_nav_btn_enable' ) ) :
	
	function raise_charity_is_nav_btn_enable( $control ) {
	return ( $control->manager->get_setting( 'raise_charity_theme_options[nav_btn]' )->value() );
}
endif;

/**
 * Front Page Active Callbacks
 */


/*==================Slider===============*/

/**
 * Check if slider section is enabled.
 *
 * @since Raise Charity 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function raise_charity_is_slider_section_enable( $control ) {
	return ( $control->manager->get_setting( 'raise_charity_theme_options[slider_section_enable]' )->value() );
}

/*==================About=====================*/

/**
 * Check if about section is enabled.
 *
 * @since Raise Charity 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function raise_charity_is_about_section_enable( $control ) {
	return ( $control->manager->get_setting( 'raise_charity_theme_options[about_section_enable]' )->value() );
}

/*==================Recent Causes===============*/

/**
 * Check if recent_cause section is enabled.
 *
 * @since Raise Charity 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function raise_charity_is_recent_cause_section_enable( $control ) {
	return ( $control->manager->get_setting( 'raise_charity_theme_options[recent_cause_section_enable]' )->value() );
}

/*=====================Service====================*/

/**
* Check if service section is enabled.
*
* @since Raise Charity 1.0.0
* @param WP_Customize_Control $control WP_Customize_Control instance.
* @return bool Whether the control is active to the current preview.
*/
function raise_charity_is_service_section_enable( $control ) {
	return ( $control->manager->get_setting( 'raise_charity_theme_options[service_section_enable]' )->value() );
}

/*=======================Promotion========================*/
/**
 * Check if promotion section is enabled.
 *
 * @since raise_charity 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function raise_charity_is_promotion_section_enable( $control ) {
	return ( $control->manager->get_setting( 'raise_charity_theme_options[promotion_section_enable]' )->value() );
}

/*===============Team======================*/


/**
 * Check if team section is enabled.
 *
 * @since Raise Charity 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function raise_charity_is_team_section_enable( $control ) {
	return ( $control->manager->get_setting( 'raise_charity_theme_options[team_section_enable]' )->value() );
}

/*=========================Latest Posts==================*/

/**
 * Check if latest_posts section is enabled.
 *
 * @since Raise Charity 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function raise_charity_is_latest_posts_section_enable( $control ) {
	return ( $control->manager->get_setting( 'raise_charity_theme_options[latest_posts_section_enable]' )->value() );
}

/**
 * Check if latest_posts section content type is category.
 *
 * @since Raise Charity 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function raise_charity_is_latest_posts_section_content_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'raise_charity_theme_options[latest_posts_content_type]' )->value();
	return raise_charity_is_latest_posts_section_enable( $control ) && ( 'category' == $content_type );
}

/**
 * Check if latest_posts section content type is post.
 *
 * @since Raise Charity 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function raise_charity_is_latest_posts_section_content_post_enable( $control ) {
	$content_type = $control->manager->get_setting( 'raise_charity_theme_options[latest_posts_content_type]' )->value();
	return raise_charity_is_latest_posts_section_enable( $control ) && ( 'post' == $content_type );
}

/*==================Contact Us===============*/

/**
 * Check if contact section is enabled.
 *
 * @since Raise Charity 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function raise_charity_is_contact_section_enable( $control ) {
	return ( $control->manager->get_setting( 'raise_charity_theme_options[contact_section_enable]' )->value() );
}