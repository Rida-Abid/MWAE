<?php

/*-----------------------------------------------------------------------------------*/
/* Enqueue script and styles */
/*-----------------------------------------------------------------------------------*/

function nonprofit_organization_enqueue_google_fonts() {

	require_once get_theme_file_path( 'core/includes/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'google-fonts-nunito',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' ),
		array(),
		'1.0'
	);
}
add_action( 'wp_enqueue_scripts', 'nonprofit_organization_enqueue_google_fonts' );

if (!function_exists('nonprofit_organization_enqueue_scripts')) {

	function nonprofit_organization_enqueue_scripts() {

		wp_enqueue_style(
			'bootstrap-css',
			get_template_directory_uri() . '/css/bootstrap.css',
			array(),'4.5.0'
		);

		wp_enqueue_style(
			'fontawesome-css',
			get_template_directory_uri() . '/css/fontawesome-all.css',
			array(),'4.5.0'
		);

		wp_enqueue_style(
			'owl.carousel-css',
			get_template_directory_uri() . '/css/owl.carousel.css',
			array(),'2.3.4'
		);

		wp_enqueue_style('nonprofit-organization-style', get_stylesheet_uri(), array() );

		wp_enqueue_style(
			'nonprofit-organization-media-css',
			get_template_directory_uri() . '/css/media.css',
			array(),'2.3.4'
		);

		wp_enqueue_style(
			'nonprofit-organization-woocommerce-css',
			get_template_directory_uri() . '/css/woocommerce.css',
			array(),'2.3.4'
		);

		wp_enqueue_style(
			'dashicons',
			get_template_directory_uri(),
			array(),'2.3.4'
		);

		wp_enqueue_script(
			'nonprofit-organization-navigation',
			esc_url( get_template_directory_uri() ) . '/js/navigation.js',
			FALSE,
			'1.0',
			TRUE
		);

		wp_enqueue_script(
			'owl.carousel-js',
			get_template_directory_uri() . '/js/owl.carousel.js',
			array('jquery'),
			'2.3.4',
			TRUE
		);

		wp_enqueue_script(
			'nonprofit-organization-script',
			get_template_directory_uri() . '/js/script.js',
			array('jquery'),
			'1.0',
			TRUE
		);

		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

		$nonprofit_organization_css = '';

		if ( get_header_image() ) :

			$nonprofit_organization_css .=  '
				.top-header{
					background-image: url('.esc_url(get_header_image()).');
					-webkit-background-size: cover !important;
					-moz-background-size: cover !important;
					-o-background-size: cover !important;
					background-size: cover !important;
				}';

		endif;

		wp_add_inline_style( 'nonprofit-organization-style', $nonprofit_organization_css );

	// Theme Customize CSS.
	require get_template_directory(). '/core/includes/inline.php';
	wp_add_inline_style( 'nonprofit-organization-style',$nonprofit_organization_custom_css );

	}

	add_action( 'wp_enqueue_scripts', 'nonprofit_organization_enqueue_scripts' );
}

/*-----------------------------------------------------------------------------------*/
/* Setup theme */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('nonprofit_organization_after_setup_theme')) {

	function nonprofit_organization_after_setup_theme() {

		if ( ! isset( $nonprofit_organization_content_width ) ) $nonprofit_organization_content_width = 900;

		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main menu', 'nonprofit-organization' ),
		));

		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'align-wide' );
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support( 'wp-block-styles' );
		add_theme_support('post-thumbnails');
		add_theme_support( 'custom-background', array(
		  'default-color' => 'f3f3f3'
		));

		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 70,
		) );

		add_theme_support( 'custom-header', array(
			'header-text' => false,
			'width' => 1920,
			'height' => 100
		));

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_editor_style( array( '/css/editor-style.css' ) );
	}

	add_action( 'after_setup_theme', 'nonprofit_organization_after_setup_theme', 999 );

}
require get_template_directory() .'/core/includes/main.php';
require get_template_directory() .'/core/includes/tgm.php';
require get_template_directory() . '/core/includes/customizer.php';
load_template( trailingslashit( get_template_directory() ) . '/core/includes/class-upgrade-pro.php' );
require get_template_directory() .'/core/includes/meta-data.php';

/*-----------------------------------------------------------------------------------*/
/* Enqueue theme logo style */
/*-----------------------------------------------------------------------------------*/
function nonprofit_organization_logo_resizer() {

    $nonprofit_organization_theme_logo_size_css = '';
    $nonprofit_organization_logo_resizer = get_theme_mod('nonprofit_organization_logo_resizer');

	$nonprofit_organization_theme_logo_size_css = '
		.custom-logo{
			height: '.esc_attr($nonprofit_organization_logo_resizer).'px !important;
			width: '.esc_attr($nonprofit_organization_logo_resizer).'px !important;
		}
	';
    wp_add_inline_style( 'nonprofit-organization-style',$nonprofit_organization_theme_logo_size_css );

}
add_action( 'wp_enqueue_scripts', 'nonprofit_organization_logo_resizer' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Global color style */
/*-----------------------------------------------------------------------------------*/
function nonprofit_organization_global_color() {

    $theme_color_css = '';
    $nonprofit_organization_copyright_bg = get_theme_mod('nonprofit_organization_copyright_bg');

	$theme_color_css = '
    .copyright {
			background: '.esc_attr($nonprofit_organization_copyright_bg).';
		}
	';
    wp_add_inline_style( 'nonprofit-organization-style',$theme_color_css );
    wp_add_inline_style( 'nonprofit-organization-woocommerce-css',$theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'nonprofit_organization_global_color' );

/*-----------------------------------------------------------------------------------*/
/* Get post comments */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('nonprofit_organization_comment')) :
    /**
     * Template for comments and pingbacks.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     */
    function nonprofit_organization_comment($comment, $args, $depth){

        if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) : ?>

            <li id="comment-<?php comment_ID(); ?>" <?php comment_class('media'); ?>>
            <div class="comment-body">
                <?php esc_html_e('Pingback:', 'nonprofit-organization');
                comment_author_link(); ?><?php edit_comment_link(__('Edit', 'nonprofit-organization'), '<span class="edit-link">', '</span>'); ?>
            </div>

        <?php else : ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body media mb-4">
                <a class="pull-left" href="#">
                    <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
                </a>
                <div class="media-body">
                    <div class="media-body-wrap card">
                        <div class="card-header">
                            <h5 class="mt-0"><?php /* translators: %s: author */ printf('<cite class="fn">%s</cite>', get_comment_author_link() ); ?></h5>
                            <div class="comment-meta">
                                <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                                    <time datetime="<?php comment_time('c'); ?>">
                                        <?php /* translators: %s: Date */ printf( esc_attr('%1$s at %2$s', '1: date, 2: time', 'nonprofit-organization'), esc_attr( get_comment_date() ), esc_attr( get_comment_time() ) ); ?>
                                    </time>
                                </a>
                                <?php edit_comment_link( __( 'Edit', 'nonprofit-organization' ), '<span class="edit-link">', '</span>' ); ?>
                            </div>
                        </div>

                        <?php if ('0' == $comment->comment_approved) : ?>
                            <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'nonprofit-organization'); ?></p>
                        <?php endif; ?>

                        <div class="comment-content card-block">
                            <?php comment_text(); ?>
                        </div>

                        <?php comment_reply_link(
                            array_merge(
                                $args, array(
                                    'add_below' => 'div-comment',
                                    'depth' => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before' => '<footer class="reply comment-reply card-footer">',
                                    'after' => '</footer><!-- .reply -->'
                                )
                            )
                        ); ?>
                    </div>
                </div>
            </article>

            <?php
        endif;
    }
endif; // ends check for nonprofit_organization_comment()

if (!function_exists('nonprofit_organization_widgets_init')) {

	function nonprofit_organization_widgets_init() {

		register_sidebar(array(

			'name' => esc_html__('Sidebar','nonprofit-organization'),
			'id'   => 'nonprofit-organization-sidebar',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'nonprofit-organization'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Footer sidebar','nonprofit-organization'),
			'id'   => 'nonprofit-organization-footer-sidebar',
			'description'   => esc_html__('This sidebar will be shown next at the bottom of your content.', 'nonprofit-organization'),
			'before_widget' => '<div id="%1$s" class="col-lg-3 col-md-3 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

	}

	add_action( 'widgets_init', 'nonprofit_organization_widgets_init' );

}

function nonprofit_organization_get_categories_select() {
	$nonprofit_organization_teh_cats = get_categories();
	$results = array();
	$nonprofit_organization_count = count($nonprofit_organization_teh_cats);
	for ($i=0; $i < $nonprofit_organization_count; $i++) {
	if (isset($nonprofit_organization_teh_cats[$i]))
  		$results[$nonprofit_organization_teh_cats[$i]->slug] = $nonprofit_organization_teh_cats[$i]->name;
	else
  		$nonprofit_organization_count++;
	}
	return $results;
}

function nonprofit_organization_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'nonprofit_organization_loop_columns', 999);
if (!function_exists('nonprofit_organization_loop_columns')) {
	function nonprofit_organization_loop_columns() {
		return 3; // 3 products per row
	}
}

//redirect
Function nonprofit_organization_notice(){
    global $pagenow;
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
   		wp_safe_redirect( admin_url("themes.php?page=nonprofit-organization-guide-page") );
   	}
}
add_action('after_setup_theme', 'nonprofit_organization_notice');

?>
