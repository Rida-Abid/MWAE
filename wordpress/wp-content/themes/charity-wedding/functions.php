<?php
if ( ! function_exists( 'charity_wedding_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function charity_wedding_setup() {
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( 
            array(
                'secondary' 		=> esc_html__( 'Secondary', 'raise-charity' ),
                'social' 		    => esc_html__( 'Social', 'raise-charity' ),
            )
        );

	}
endif;

add_action( 'after_setup_theme', 'charity_wedding_setup', 20 );


if ( ! function_exists( 'charity_wedding_enqueue_styles' ) ) :

	function charity_wedding_enqueue_styles() {
		wp_enqueue_style( 'charity-wedding-style-parent', get_template_directory_uri() . '/style.css' );

		wp_enqueue_style( 'charity-wedding-style', get_stylesheet_directory_uri() . '/style.css', array( 'charity-wedding-style-parent' ), '1.0.0' );

		wp_enqueue_script( 'charity-wedding-custom', get_theme_file_uri() . '/custom.js', array(), '1.0', true );

		wp_enqueue_style( 'charity-wedding-fonts', charity_wedding_fonts_url(), array(), null );
	}

endif;
add_action( 'wp_enqueue_scripts', 'charity_wedding_enqueue_styles', 99 );


function charity_wedding_customize_control_style() {

	wp_enqueue_style( 'charity-wedding-customize-controls', get_theme_file_uri() . '/customizer-control.css' );

}
add_action( 'customize_controls_enqueue_scripts', 'charity_wedding_customize_control_style' );

if ( !function_exists( 'charity_wedding_block_editor_styles' ) ):

	function charity_wedding_block_editor_styles() {
		wp_enqueue_style( 'charity-wedding-fonts', charity_wedding_fonts_url(), array(), null );
	}

endif;

add_action( 'enqueue_block_editor_assets', 'charity_wedding_block_editor_styles' );


if ( ! function_exists( 'charity_wedding_fonts_url' ) ) :

function charity_wedding_fonts_url() {
	
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	if ( 'off' !== _x( 'on', 'raleway font: on or off', 'charity-wedding' ) ) {
		$fonts[] = 'Raleway:400,500,600,700';
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


if ( ! function_exists( 'charity_weding_site_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function charity_weding_site_navigation() {
		$options = raise_charity_get_theme_options();
        if(!get_theme_mod('topbar_section_enable')) {
            return ;
        } ?>

        <div id="top-navigation" class="relative">
            <div class="wrapper">
                <nav id="secondary-navigation" class="main-navigation" role="navigation" aria-label="<?php echo __('Secondary Menu', 'charity-wedding')?>">
                    <button class="menu-toggle" aria-controls="secondary-menu" aria-expanded="false">
                        <span class="menu-label"><?php _e( 'Top', 'charity-wedding' )?></span>
                        <?php
                            echo raise_charity_get_svg( array( 'icon' => 'menu' ) );
                            echo raise_charity_get_svg( array( 'icon' => 'close' ) );
                        ?>	
                    </button>

                    <?php 
                        wp_nav_menu( 
                            array(
                                'theme_location' => 'secondary',
                                'container' => 'ul',
                                'menu_class' => 'menu nav-menu',
                                'menu_id' => 'secondary-menu',
                                'echo' => true,
                                'fallback_cb' => 'raise_charity_menu_fallback_cb',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            )
                        );
                        if( has_nav_menu( 'social' ) ){
                            wp_nav_menu( 
                                array(
                                    'theme_location' => 'social',
                                    'container' => 'div',
                                    'container_class' => 'social-icons ',
                                    'echo' => true,
                                    'link_before' => '<span class="screen-reader-text">',
                                    'link_after' => '</span>',
                                    'fallback_cb' => false,
                                )
                            );
                        }
                    ?>

                </nav><!-- .main-navigation-->
            </div><!-- .wrapper -->
        </div><!-- #top-navigation -->
		<?php
	}
endif;

add_action( 'raise_charity_header_action', 'charity_weding_site_navigation', 10 );

require get_theme_file_path() . '/inc/customizer.php';

require get_theme_file_path() . '/inc/front-sections/slider.php';

require get_theme_file_path() . '/inc/front-sections/service.php';

require get_theme_file_path() . '/inc/front-sections/contact-us.php';

require get_theme_file_path() . '/inc/front-sections/latest-posts.php';

require get_theme_file_path() . '/inc/front-sections/featured-posts.php';

require get_theme_file_path() . '/inc/front-sections/gallery.php';

require get_theme_file_path() . '/inc/front-sections/event.php';

require get_theme_file_path() . '/inc/front-sections/sponsor.php';

require get_theme_file_path() . '/inc/front-sections/cta.php';