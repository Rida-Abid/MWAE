<?php
/**
 * Theme Palace functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

if ( ! function_exists( 'raise_charity_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function raise_charity_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Theme Palace, use a find and replace
		 * to change 'raise-charity' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'raise-charity' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		add_theme_support( 'register_block_pattern' ); 

		add_theme_support( 'register_block_style' ); 

		// Enable support for footer widgets.
		add_theme_support( 'footer-widgets', 4 );

		add_theme_support( "responsive-embeds" );

		// Enable excerpt for page.
		add_post_type_support( 'page', 'excerpt' );

		// Load Footer Widget Support.
		require_if_theme_supports( 'footer-widgets', get_template_directory() . '/inc/footer-widgets.php' );
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 600, 600, true );

		// Set the default content width.
		$GLOBALS['content_width'] = 525;
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' 		=> esc_html__( 'Primary', 'raise-charity' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'raise_charity_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// This setup supports logo, site-title & site-description
		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 120,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );


		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( '/assets/css/editor-style' . raise_charity_min() . '.css', raise_charity_fonts_url() ) );

		// Gutenberg support
		add_theme_support( 'editor-color-palette', array(
	       	array(
				'name' => esc_html__( 'Blue', 'raise-charity' ),
				'slug' => 'blue',
				'color' => '#2c7dfa',
	       	),
	       	array(
	           	'name' => esc_html__( 'Green', 'raise-charity' ),
	           	'slug' => 'green',
	           	'color' => '#07d79c',
	       	),
	       	array(
	           	'name' => esc_html__( 'Orange', 'raise-charity' ),
	           	'slug' => 'orange',
	           	'color' => '#ff8737',
	       	),
	       	array(
	           	'name' => esc_html__( 'Black', 'raise-charity' ),
	           	'slug' => 'black',
	           	'color' => '#2f3633',
	       	),
	       	array(
	           	'name' => esc_html__( 'Grey', 'raise-charity' ),
	           	'slug' => 'grey',
	           	'color' => '#82868b',
	       	),
	   	));

		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-font-sizes', array(
		   	array(
		       	'name' => esc_html__( 'small', 'raise-charity' ),
		       	'shortName' => esc_html__( 'S', 'raise-charity' ),
		       	'size' => 12,
		       	'slug' => 'small'
		   	),
		   	array(
		       	'name' => esc_html__( 'regular', 'raise-charity' ),
		       	'shortName' => esc_html__( 'M', 'raise-charity' ),
		       	'size' => 16,
		       	'slug' => 'regular'
		   	),
		   	array(
		       	'name' => esc_html__( 'larger', 'raise-charity' ),
		       	'shortName' => esc_html__( 'L', 'raise-charity' ),
		       	'size' => 36,
		       	'slug' => 'larger'
		   	),
		   	array(
		       	'name' => esc_html__( 'huge', 'raise-charity' ),
		       	'shortName' => esc_html__( 'XL', 'raise-charity' ),
		       	'size' => 48,
		       	'slug' => 'huge'
		   	)
		));
		add_theme_support('editor-styles');
		add_theme_support( 'wp-block-styles' );
	}
endif;
add_action( 'after_setup_theme', 'raise_charity_setup', 10 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function raise_charity_content_width() {

	$content_width = $GLOBALS['content_width'];


	$sidebar_position = raise_charity_layout();
	switch ( $sidebar_position ) {

	  case 'no-sidebar':
	    $content_width = 1170;
	    break;

	  case 'left-sidebar':
	  case 'right-sidebar':
	    $content_width = 819;
	    break;

	  default:
	    break;
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1170;
	}

	/**
	 * Filter Raise Charity content width of the theme.
	 *
	 * @since Raise Charity 1.0.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'raise_charity_content_width', $content_width );
}
add_action( 'template_redirect', 'raise_charity_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function raise_charity_widgets_init() {
	$options = raise_charity_get_theme_options();
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'raise-charity' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'raise-charity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebars( 4, array(
		'name'          => esc_html__( 'Optional Sidebar %d', 'raise-charity' ),
		'id'            => 'optional-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'raise-charity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'raise_charity_widgets_init' );


if ( ! function_exists( 'raise_charity_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function raise_charity_fonts_url() {
	$options = raise_charity_get_theme_options();
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Architects Daughter, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Architects Daughter font: on or off', 'raise-charity' ) ) {
		$fonts[] = 'Architects Daughter';
	}

	/* translators: If there are characters in your language that are not supported by Lora, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lora font: on or off', 'raise-charity' ) ) {
		$fonts[] = 'Lora';
	}

	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'raise-charity' ) ) {
		$fonts[] = 'Poppins:400,500,600,700';
	}

	/* translators: If there are characters in your language that are not supported by Cinzel, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Cinzel font: on or off', 'raise-charity' ) ) {
		$fonts[] = 'Cinzel:400,600,700';
	}

	/* translators: If there are characters in your language that are not supported by Great Vibes, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Great Vibes font: on or off', 'raise-charity' ) ) {
		$fonts[] = 'Great Vibes';
	}

	$query_args = array(
		'family' => urlencode( implode( '|', $fonts ) ),
		'subset' => urlencode( $subsets ),
	);

	if ( $fonts ) {
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}
endif;

/**
 * Add preconnect for Google Fonts.
 *
 * @since Raise Charity 1.0.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function raise_charity_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'raise-charity-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'raise_charity_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function raise_charity_scripts() {
	$options = raise_charity_get_theme_options();
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'raise-charity-fonts', wptt_get_webfont_url( raise_charity_fonts_url() ), array(), null );

	// slick
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick' . raise_charity_min() . '.css' );
	
	// slick theme
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme' . raise_charity_min() . '.css' );
	
	// FontAwesome
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/font-awesome' . raise_charity_min() . '.css' );

	// blocks
	wp_enqueue_style( 'raise-charity-blocks', get_template_directory_uri() . '/assets/css/blocks' . raise_charity_min() . '.css' );

	wp_enqueue_style( 'raise-charity-style', get_stylesheet_uri() );
	
	// Load the html5 shiv.
	wp_enqueue_script( 'raise-charity-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . raise_charity_min() . '.js', array(), '20160412', true );

	wp_enqueue_script( 'raise-charity-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
	
	$raise_charity_l10n = array(
		'quote'          => raise_charity_get_svg( array( 'icon' => 'quote-right' ) ),
		'expand'         => esc_html__( 'Expand child menu', 'raise-charity' ),
		'collapse'       => esc_html__( 'Collapse child menu', 'raise-charity' ),
		'icon'           => raise_charity_get_svg( array( 'icon' => 'down', 'fallback' => true ) ),
	);
	
	wp_localize_script( 'raise-charity-navigation', 'raise_charity_l10n', $raise_charity_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//slick
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/js/slick' . raise_charity_min() . '.js', array( 'jquery' ), '', true );
	
	wp_enqueue_script( 'raise-charity-custom', get_template_directory_uri() . '/assets/js/custom' . raise_charity_min() . '.js', array( 'jquery' ), '20151215', true );

}
add_action( 'wp_enqueue_scripts', 'raise_charity_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 *
 * @since Raise Charity 1.0.0
 */
function raise_charity_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'raise-charity-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks' . raise_charity_min() . '.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'raise-charity-fonts', wptt_get_webfont_url( raise_charity_fonts_url() ), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'raise_charity_block_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load core file
 */
require get_template_directory() . '/inc/core.php';