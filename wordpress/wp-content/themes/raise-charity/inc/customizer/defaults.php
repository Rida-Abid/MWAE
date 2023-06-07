<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 * @return array An array of default values
 */

function raise_charity_get_default_theme_options() {
	$theme_data = wp_get_theme();
	$raise_charity_default_options = array(
		// Color Options
		'header_title_color'			=> '#000',
		'header_tagline_color'			=> '#666',
		'header_txt_logo_extra'			=> 'show-all',
	
		// breadcrumb
		'breadcrumb_enable'				=> true,
		'breadcrumb_separator'			=> '/',
		
		// layout 
		'site_layout'         			=> 'wide-layout',
		'sidebar_position'         		=> 'right-sidebar',
		'post_sidebar_position' 		=> 'right-sidebar',
		'page_sidebar_position' 		=> 'right-sidebar',
		
		//menu
		'nav_btn'						=> true,
		'nav_btn_txt' 					=> esc_html__( 'Donate Now', 'raise-charity' ),
		'nav_btn_url' 					=> '#',

		// excerpt options
		'long_excerpt_length'           => 25,
		
		// pagination options
		'pagination_enable'         	=> true,
		'pagination_type'         		=> 'default',

		// footer options
		'copyright_text'           		=> sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s', '1: Year, 2: Site Title with home URL', 'raise-charity' ), '[the-year]', '[site-link]' ),
		
		// reset options
		'reset_options'      			=> false,
		
		// homepage options
		'enable_frontpage_content' 		=> false,

		// homepage sections sortable
		'sortable' 						=> 'slider,about,recent_cause,service,promotion,team,latest_posts,contact',

		// blog/archive options
		'your_latest_posts_title' 		=> esc_html__( 'Blogs', 'raise-charity' ),
		'blog_page_column'					=> 'col-2',
		'blog_page_post_btn' 			=> esc_html__( 'Read More', 'raise-charity' ),

		// single post theme options
		'single_post_hide_date' 		=> false,
		'single_post_hide_author'		=> false,

		/* Front Page */

		// Slider
		'slider_section_enable'		=> false,
		'slider_btn_label'			=> esc_html__( 'Read More', 'raise-charity' ),

		// about
		'about_section_enable'			=> false,
		'about_information_text'		=> esc_html__( 'More Than 365000+ People Were Helped', 'raise-charity' ),
		'about_btn_title'				=> esc_html__( 'Become A Volunteer', 'raise-charity' ),

		// Recent Causes
		'recent_cause_section_enable'		=> false,
		'recent_cause_title'				=> esc_html__( 'Our Recent Causes', 'raise-charity' ),
		'recent_cause_sub_title'			=> esc_html__( 'Children and poor people are at high risk of severe malnutrition & no education.', 'raise-charity' ),
		'recent_cause_content_type'			=> 'post',
		'recent_cause_btn_label'			=> esc_html__( 'Explore More', 'raise-charity' ),

		// service
		'service_section_enable'		=> false,
		'service_title'					=> esc_html('How Can You Help Us', 'raise-charity'),
		'service_sub_title'				=> esc_html('Children and poor people are at high risk of severe malnutrition & no education.', 'raise-charity'),

		//promotion
		'promotion_section_enable'			=> false,
		'promotion_content_type'			=> 'page',
		'promotion_button'					=> esc_html('Join Now', 'raise-charity'),

		// team
		'team_section_enable'		=> false,
		'team_title'				=> esc_html('Meet Our Volunteers', 'raise-charity'),
		'team_sub_title'			=> esc_html('Children and poor people are at high risk of severe malnutrition & no education.', 'raise-charity'),

		// latest_posts
		'latest_posts_section_enable'	=> false,
		'latest_posts_content_type'		=> 'category',
		'latest_posts_title'			=> esc_html__( 'Latest News Update', 'raise-charity' ),
		'latest_posts_sub_title'		=> esc_html__( 'Children and poor people are at high risk of severe malnutrition & no education.', 'raise-charity' ),
		'latest_posts_btn_text'			=> esc_html__( 'Read More', 'raise-charity' ),

		// Contact Us
		'contact_section_enable'		=> false,
		'contact_title'					=> __( 'Get in Touch', 'raise-charity' ),
		'contact_sub_title'				=> __( 'Children and poor people are at high risk of severe malnutrition & no education.', 'raise-charity' ),
		'contact_form_shortcode'		=> __( '[contact-form-7 id="3088" title="Untitled"]', 'raise-charity' ),

	);

	$output = apply_filters( 'raise_charity_default_theme_options', $raise_charity_default_options );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}