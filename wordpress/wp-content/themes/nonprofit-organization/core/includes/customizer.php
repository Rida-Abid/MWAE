<?php

if ( class_exists("Kirki")){

	// LOGO

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'nonprofit_organization_logo_resizer',
		'label'       => esc_html__( 'Adjust Your Logo Size ', 'nonprofit-organization' ),
		'section'     => 'title_tagline',
		'default'     => 70,
		'choices'     => [
			'min'  => 10,
			'max'  => 300,
			'step' => 10,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'nonprofit_organization_enable_logo_text',
		'section'     => 'title_tagline',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Site Title and Tagline', 'nonprofit-organization' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'nonprofit_organization_display_header_title',
		'label'       => esc_html__( 'Site Title Enable / Disable Button', 'nonprofit-organization' ),
		'section'     => 'title_tagline',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'nonprofit-organization' ),
			'off' => esc_html__( 'Disable', 'nonprofit-organization' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'nonprofit_organization_display_header_text',
		'label'       => esc_html__( 'Tagline Enable / Disable Button', 'nonprofit-organization' ),
		'section'     => 'title_tagline',
		'default'     => false,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'nonprofit-organization' ),
			'off' => esc_html__( 'Disable', 'nonprofit-organization' ),
		],
	] );

	// FONT STYLE TYPOGRAPHY

	Kirki::add_panel( 'nonprofit_organization_panel_id', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'Typography', 'nonprofit-organization' ),
	) );

	Kirki::add_section( 'nonprofit_organization_font_style_section', array(
		'title'      => esc_attr__( 'Typography Option',  'nonprofit-organization' ),
		'priority'   => 2,
		'capability' => 'edit_theme_options',
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'nonprofit_organization_all_headings_typography',
		'section'     => 'nonprofit_organization_font_style_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading Of All Sections',  'nonprofit-organization' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'global', array(
		'type'        => 'typography',
		'settings'    => 'nonprofit_organization_all_headings_typography',
		'label'       => esc_attr__( 'Heading Typography',  'nonprofit-organization' ),
		'description' => esc_attr__( 'Select the typography options for your heading.',  'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_font_style_section',
		'priority'    => 10,
		'default'     => array(
			'font-family'    => '',
			'variant'        => '',
		),
		'output' => array(
			array(
				'element' => array( 'h1','h2','h3','h4','h5','h6', ),
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'nonprofit_organization_body_content_typography',
		'section'     => 'nonprofit_organization_font_style_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Body Content',  'nonprofit-organization' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'global', array(
		'type'        => 'typography',
		'settings'    => 'nonprofit_organization_body_content_typography',
		'label'       => esc_attr__( 'Content Typography',  'nonprofit-organization' ),
		'description' => esc_attr__( 'Select the typography options for your content.',  'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_font_style_section',
		'priority'    => 10,
		'default'     => array(
			'font-family'    => '',
			'variant'        => '',
		),
		'output' => array(
			array(
				'element' => array( 'body', ),
			),
		),
	) );

	// PANEL

	Kirki::add_panel( 'nonprofit_organization_panel_id', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'Theme Options', 'nonprofit-organization' ),
	) );

	// Additional Settings

	Kirki::add_section( 'nonprofit_organization_Additional_settings', array(
	    'title'          => esc_html__( 'Additional Settings', 'nonprofit-organization' ),
	    'description'    => esc_html__( 'Scroll To Top', 'nonprofit-organization' ),
	    'panel'          => 'nonprofit_organization_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'nonprofit_organization_scroll_enable_setting',
		'label'       => esc_html__( 'Here you can enable or disable your scroller.', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_Additional_settings',
		'default'     => '0',
		'priority'    => 10,
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'menu_text_transform_nonprofit_organization',
		'label'       => esc_html__( 'Menus Text Transform', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_Additional_settings',
		'default'     => 'UPPERCASE',
		'placeholder' => esc_html__( 'Choose an option', 'nonprofit-organization' ),
		'choices'     => [
			'CAPITALISE' => esc_html__( 'CAPITALISE', 'nonprofit-organization' ),
			'UPPERCASE' => esc_html__( 'UPPERCASE', 'nonprofit-organization' ),
			'LOWERCASE' => esc_html__( 'LOWERCASE', 'nonprofit-organization' ),

		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'nonprofit_organization_container_width',
		'label'       => esc_html__( 'Theme Container Width', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_Additional_settings',
		'default'     => 100,
		'choices'     => [
			'min'  => 50,
			'max'  => 100,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'nonprofit_organization_sticky_header',
		'label'       => esc_html__( 'Here you can enable or disable your Sticky Header.', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_Additional_settings',
		'default'     => false,
		'priority'    => 10,
	] );

	// Woocommerce Settings

	Kirki::add_section( 'nonprofit_organization_woocommerce_settings', array(
			'title'          => esc_html__( 'Woocommerce Settings', 'nonprofit-organization' ),
			'description'    => esc_html__( 'Shop Page', 'nonprofit-organization' ),
			'panel'          => 'nonprofit_organization_panel_id',
			'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'nonprofit_organization_shop_sidebar',
		'label'       => esc_html__( 'Here you can enable or disable shop page sidebar.', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_woocommerce_settings',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'nonprofit_organization_product_sidebar',
		'label'       => esc_html__( 'Here you can enable or disable product page sidebar.', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_woocommerce_settings',
		'default'     => '1',
		'priority'    => 10,
	] );


	// POST SECTION

	Kirki::add_section( 'nonprofit_organization_section_post', array(
	    'title'          => esc_html__( 'Post Settings', 'nonprofit-organization' ),
	    'description'    => esc_html__( 'Here you can get different post settings', 'nonprofit-organization' ),
	    'panel'          => 'nonprofit_organization_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'nonprofit_organization_enable_post_heading',
		'section'     => 'nonprofit_organization_section_post',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Post Settings.', 'nonprofit-organization' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'nonprofit_organization_blog_admin_enable',
		'label'       => esc_html__( 'Post Author Enable / Disable Button', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_section_post',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'nonprofit-organization' ),
			'off' => esc_html__( 'Disable', 'nonprofit-organization' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'nonprofit_organization_blog_comment_enable',
		'label'       => esc_html__( 'Post Comment Enable / Disable Button', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_section_post',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'nonprofit-organization' ),
			'off' => esc_html__( 'Disable', 'nonprofit-organization' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'nonprofit_organization_post_excerpt_number',
		'label'       => esc_html__( 'Post Content Range', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_section_post',
		'default'     => 15,
		'choices'     => [
			'min'  => 0,
			'max'  => 25,
			'step' => 1,
		],
	] );

	// HEADER SECTION

	Kirki::add_section( 'nonprofit_organization_section_header', array(
	    'title'          => esc_html__( 'Header Settings', 'nonprofit-organization' ),
	    'description'    => esc_html__( 'Here you can add header information.', 'nonprofit-organization' ),
	    'panel'          => 'nonprofit_organization_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'nonprofit_organization_header_phone_support_heading',
		'section'     => 'nonprofit_organization_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Phone Number', 'nonprofit-organization' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'nonprofit_organization_phone_support_text',
		'section'  => 'nonprofit_organization_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'nonprofit_organization_phone_support',
		'section'  => 'nonprofit_organization_section_header',
		'default'  => '',
		'sanitize_callback' => 'nonprofit_organization_sanitize_phone_number',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'nonprofit_organization_header_email_support_heading',
		'section'     => 'nonprofit_organization_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Email Address', 'nonprofit-organization' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'nonprofit_organization_email_support_text',
		'section'  => 'nonprofit_organization_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'nonprofit_organization_email_support',
		'section'  => 'nonprofit_organization_section_header',
		'default'  => '',
		'sanitize_callback' => 'sanitize_email',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'nonprofit_organization_header_location_heading',
		'section'     => 'nonprofit_organization_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Location', 'nonprofit-organization' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'nonprofit_organization_location_text',
		'section'  => 'nonprofit_organization_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'nonprofit_organization_location',
		'section'  => 'nonprofit_organization_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'nonprofit_organization_header_donation_heading',
		'section'     => 'nonprofit_organization_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Donation Button', 'nonprofit-organization' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'nonprofit_organization_donation_text',
		'section'  => 'nonprofit_organization_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'link',
		'settings' => 'nonprofit_organization_donation_link',
		'section'  => 'nonprofit_organization_section_header',
		'default'  => '',
	] );

	// SLIDER SECTION

	Kirki::add_section( 'nonprofit_organization_blog_slide_section', array(
        'title'          => esc_html__( ' Slider Settings', 'nonprofit-organization' ),
        'description'    => esc_html__( 'You have to select post category to show slider.', 'nonprofit-organization' ),
        'panel'          => 'nonprofit_organization_panel_id',
        'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'nonprofit_organization_enable_heading',
		'section'     => 'nonprofit_organization_blog_slide_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Slider', 'nonprofit-organization' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'nonprofit_organization_blog_box_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_blog_slide_section',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'nonprofit-organization' ),
			'off' => esc_html__( 'Disable', 'nonprofit-organization' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'nonprofit_organization_title_unable_disable',
		'label'       => esc_html__( 'Slide Title Enable / Disable', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_blog_slide_section',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'nonprofit-organization' ),
			'off' => esc_html__( 'Disable', 'nonprofit-organization' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'nonprofit_organization_button_unable_disable',
		'label'       => esc_html__( 'Slide Button Enable / Disable', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_blog_slide_section',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'nonprofit-organization' ),
			'off' => esc_html__( 'Disable', 'nonprofit-organization' ),
		],
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'nonprofit_organization_slider_heading',
		'section'     => 'nonprofit_organization_blog_slide_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Slider', 'nonprofit-organization' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'settings'    => 'nonprofit_organization_blog_slide_number',
		'label'       => esc_html__( 'Number of slides to show', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_blog_slide_section',
		'default'     => 3,
		'choices'     => [
			'min'  => 0,
			'max'  => 5,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'select',
		'settings'    => 'nonprofit_organization_blog_slide_category',
		'label'       => esc_html__( 'Select the category to show slider ( Image Dimension 1600 x 600 )', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_blog_slide_section',
		'default'     => '',
		'placeholder' => esc_html__( 'Select an category...', 'nonprofit-organization' ),
		'priority'    => 10,
		'choices'     => nonprofit_organization_get_categories_select(),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    => 'Extra Slider Text',
		'settings' => 'nonprofit_organization_extra_text',
		'section'  => 'nonprofit_organization_blog_slide_section',
		'default'  => '',
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'nonprofit_organization_slider_content_alignment',
		'label'       => esc_html__( 'Slider Content Alignment', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_blog_slide_section',
		'default'     => 'LEFT-ALIGN',
		'placeholder' => esc_html__( 'Choose an option', 'nonprofit-organization' ),
		'choices'     => [
			'LEFT-ALIGN' => esc_html__( 'LEFT-ALIGN', 'nonprofit-organization' ),
			'CENTER-ALIGN' => esc_html__( 'CENTER-ALIGN', 'nonprofit-organization' ),
			'RIGHT-ALIGN' => esc_html__( 'RIGHT-ALIGN', 'nonprofit-organization' ),

		],
	] );

	// FEATURED CAMPAIGNS SECTION

	Kirki::add_section( 'nonprofit_organization_featured_campaigns_section', array(
	    'title'          => esc_html__( 'Featured Campaigns Settings', 'nonprofit-organization' ),
	    'description'    => esc_html__( 'Here you can add campaigns post.', 'nonprofit-organization' ),
	    'panel'          => 'nonprofit_organization_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'nonprofit_organization_enable_heading',
		'section'     => 'nonprofit_organization_featured_campaigns_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Featured Campaigns',  'nonprofit-organization' ) . '</h3>',
		'priority'    => 1,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'nonprofit_organization_featured_campaigns_section_enable',
		'label'       => esc_html__( 'Section Enable / Disable',  'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_featured_campaigns_section',
		'default'     => '0',
		'priority'    => 2,
		'choices'     => [
			'on'  => esc_html__( 'Enable',  'nonprofit-organization' ),
			'off' => esc_html__( 'Disable',  'nonprofit-organization' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
        'type'     => 'text',
        'settings' => 'nonprofit_organization_featured_campaigns_heading' ,
        'label'    => esc_html__( 'Heading',  'nonprofit-organization' ),
        'section'  => 'nonprofit_organization_featured_campaigns_section',
    ] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'nonprofit_organization_featured_campaigns_cat_heading',
		'section'     => 'nonprofit_organization_featured_campaigns_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( ' Category Dropdown', 'nonprofit-organization' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'settings'    => 'nonprofit_organization_featured_campaigns_number',
		'label'       => esc_html__( 'Number of post to show', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_featured_campaigns_section',
		'default'     => 3,
		'choices'     => [
			'min'  => 0,
			'max'  => 80,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'select',
		'settings'    => 'nonprofit_organization_featured_campaigns_category',
		'label'       => esc_html__( 'Select the category to show left side post', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_featured_campaigns_section',
		'default'     => '',
		'placeholder' => esc_html__( 'Select an category...', 'nonprofit-organization' ),
		'priority'    => 10,
		'choices'     => nonprofit_organization_get_categories_select(),
	] );

	// FOOTER SECTION

	Kirki::add_section( 'nonprofit_organization_footer_section', array(
        'title'          => esc_html__( 'Footer Settings', 'nonprofit-organization' ),
        'description'    => esc_html__( 'Here you can change copyright text', 'nonprofit-organization' ),
        'panel'          => 'nonprofit_organization_panel_id',
        'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'nonprofit_organization_footer_text_heading',
		'section'     => 'nonprofit_organization_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Text', 'nonprofit-organization' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'nonprofit_organization_footer_text',
		'section'  => 'nonprofit_organization_footer_section',
		'default'  => '',
		'priority' => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'nonprofit_organization_footer_enable_heading',
		'section'     => 'nonprofit_organization_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Footer Link', 'nonprofit-organization' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'nonprofit_organization_copyright_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_footer_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'nonprofit-organization' ),
			'off' => esc_html__( 'Disable', 'nonprofit-organization' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
	'type'        => 'custom',
	'settings'    => 'nonprofit_organization_footer_text_heading_2',
	'section'     => 'nonprofit_organization_footer_section',
	'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Alignment', 'nonprofit-organization' ) . '</h3>',
	'priority'    => 10,
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'nonprofit_organization_copyright_text_alignment',
		'label'       => esc_html__( 'Copyright text Alignment', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_footer_section',
		'default'     => 'LEFT-ALIGN',
		'placeholder' => esc_html__( 'Choose an option', 'nonprofit-organization' ),
		'choices'     => [
			'LEFT-ALIGN' => esc_html__( 'LEFT-ALIGN', 'nonprofit-organization' ),
			'CENTER-ALIGN' => esc_html__( 'CENTER-ALIGN', 'nonprofit-organization' ),
			'RIGHT-ALIGN' => esc_html__( 'RIGHT-ALIGN', 'nonprofit-organization' ),

		],
	] );

	Kirki::add_field( 'theme_config_id', [
	'type'        => 'custom',
	'settings'    => 'nonprofit_organization_footer_text_heading_1',
	'section'     => 'nonprofit_organization_footer_section',
	'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Background Color', 'nonprofit-organization' ) . '</h3>',
	'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'color',
		'settings'    => 'nonprofit_organization_copyright_bg',
		'label'       => __( 'Choose Your Copyright Background Color', 'nonprofit-organization' ),
		'section'     => 'nonprofit_organization_footer_section',
		'default'     => '',
	] );
}
