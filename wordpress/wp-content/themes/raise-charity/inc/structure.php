<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

$options = raise_charity_get_theme_options();


if ( ! function_exists( 'raise_charity_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since Raise Charity 1.0.0
	 */
	function raise_charity_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'raise_charity_doctype', 'raise_charity_doctype', 10 );


if ( ! function_exists( 'raise_charity_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function raise_charity_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif;
	}
endif;
add_action( 'raise_charity_before_wp_head', 'raise_charity_head', 10 );

if ( ! function_exists( 'raise_charity_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function raise_charity_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'raise-charity' ); ?></a>
			<div class="menu-overlay"></div>

		<?php
	}
endif;
add_action( 'raise_charity_page_start_action', 'raise_charity_page_start', 10 );

if ( ! function_exists( 'raise_charity_header_start' ) ) :
	/**
	 * Header start html codes
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function raise_charity_header_start() {
		$options = raise_charity_get_theme_options();
		?>
		
		<header id="masthead" class="site-header" role="banner">
		<div class="wrapper">
		<?php
	}
endif;
add_action( 'raise_charity_header_action', 'raise_charity_header_start', 20 );

if ( ! function_exists( 'raise_charity_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function raise_charity_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'raise_charity_page_end_action', 'raise_charity_page_end', 10 );

if ( ! function_exists( 'raise_charity_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function raise_charity_site_branding() {
		$options  = raise_charity_get_theme_options();
		$header_txt_logo_extra = $options['header_txt_logo_extra'];		
		?>
		
		
		<div class="site-branding">
			<?php if ( in_array( $header_txt_logo_extra, array( 'show-all', 'logo-title', 'logo-tagline' ) )  ) { ?>
				<div class="site-logo">
					<?php the_custom_logo(); ?>
				</div>
			<?php } 
			if ( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title', 'show-all', 'tagline-only', 'logo-tagline' ) ) ) : ?>
				<div id="site-identity">
					<?php
					if( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title' ) )  ) {
						if ( raise_charity_is_latest_posts() || raise_charity_is_frontpage() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
						endif;
					} 
					if ( in_array( $header_txt_logo_extra, array( 'show-all', 'tagline-only', 'logo-tagline' ) ) ) {
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
						<?php
						endif; 
					}?>
				</div>
			<?php endif; ?>
		</div><!-- .site-branding -->
		
		<?php
	}
endif;
add_action( 'raise_charity_header_action', 'raise_charity_site_branding', 20 );

if ( ! function_exists( 'raise_charity_site_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function raise_charity_site_navigation() {
		$options = raise_charity_get_theme_options();
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Primary Menu">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="menu-label"><?php esc_html_e( 'Menu', 'raise-charity' ); ?></span>
				<?php
				echo raise_charity_get_svg( array( 'icon' => 'menu' ) );
				echo raise_charity_get_svg( array( 'icon' => 'close' ) );
				?>					
			</button>

			<?php  
				$search = '';
					$search = '<li class="search-menu"><a href="#">';
					$search .= raise_charity_get_svg( array( 'icon' => 'search' ) );
					$search .= raise_charity_get_svg( array( 'icon' => 'close' ) );
					$search .= '</a><div id="search" style="display: none;">';
					$search .= get_search_form( $echo = false );
					$search .= '</div></li>';

                $button = '';
				if ( $options['nav_btn'] && (!empty( $options['nav_btn_url'] ) && !empty( $options['nav_btn_txt'] ) ) ) :

					$button = '<li><a href="'. esc_url( $options['nav_btn_url'] ) .'"  class="custom-button">'
                        . esc_html( $options['nav_btn_txt'] ) .'</a>
                        </li>';
				endif;

				$button .= $search;

        		wp_nav_menu( array(
        			'theme_location' => 'primary',
        			'container' => 'div',
        			'menu_class' => 'menu nav-menu',
        			'menu_id' => 'primary-menu',
        			'echo' => true,
        			'fallback_cb' => 'raise_charity_menu_fallback_cb',
        			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s'  . $button . '</ul>',
        		) );
        	?>
		</nav><!-- #site-navigation -->
		</div><!-- .wrapper -->
		<?php
	}
endif;
add_action( 'raise_charity_header_action', 'raise_charity_site_navigation', 30 );


if ( ! function_exists( 'raise_charity_header_end' ) ) :
	/**
	 * Header end html codes
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function raise_charity_header_end() {
		?>
</div><!-- .wrapper -->
</header><!-- #masthead -->
		<?php
	}
endif;

add_action( 'raise_charity_header_action', 'raise_charity_header_end', 50 );

if ( ! function_exists( 'raise_charity_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function raise_charity_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'raise_charity_content_start_action', 'raise_charity_content_start', 10 );

if ( ! function_exists( 'raise_charity_header_image' ) ) :
	/**
	 * Header Image codes
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function raise_charity_header_image() {
		$options  = raise_charity_get_theme_options();
		if ( raise_charity_is_frontpage() )
			return;
		$header_image = get_header_image();
		$class = '';
		if ( is_singular() ) :
			$class = ( has_post_thumbnail() || ! empty( $header_image ) ) ? '' : 'header-media-disabled';
		else :
			$class = ! empty( $header_image ) ? '' : 'header-media-disabled';
		endif;
		
		if ( is_singular() && has_post_thumbnail() ) : 
			$header_image = get_the_post_thumbnail_url( get_the_id(), 'full' );
    	endif; ?>

    		<div id="page-site-header" class="relative <?php echo esc_attr( $class ); ?>" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
	    		
	            <div class="overlay"></div>
	            <div class="header-wrapper">
		            <div class="wrapper">
		                <header class="page-header">
		                    <?php echo raise_charity_custom_header_banner_title(); ?>
		                </header>

		                <?php raise_charity_add_breadcrumb(); ?>
		            </div><!-- .wrapper -->
	            </div><!-- .header-wrapper -->
	        </div><!-- #page-site-header -->
    	  	
	<?php
	}
endif;
add_action( 'raise_charity_header_image_action', 'raise_charity_header_image', 10 );

if ( ! function_exists( 'raise_charity_add_breadcrumb' ) ) :
	/**
	 * Add breadcrumb.
	 *
	 * @since Raise Charity 1.0.0
	 */
	function raise_charity_add_breadcrumb() {
		$options = raise_charity_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		
		// Bail if Home Page.
		if ( raise_charity_is_frontpage() ) {
			return;
		}

		echo '<div id="breadcrumb-list" >';
				/**
				 * raise_charity_simple_breadcrumb hook
				 *
				 * @hooked raise_charity_simple_breadcrumb -  10
				 *
				 */
				do_action( 'raise_charity_simple_breadcrumb' );
		echo '</div><!-- #breadcrumb-list -->';
		return;
	}
endif;

if ( ! function_exists( 'raise_charity_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function raise_charity_content_end() {
		?>
		</div><!-- #content -->
		<?php
	}
endif;
add_action( 'raise_charity_content_end_action', 'raise_charity_content_end', 10 );

if ( ! function_exists( 'raise_charity_footer_start' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function raise_charity_footer_start() {
		?>
		<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
	}
endif;
add_action( 'raise_charity_footer', 'raise_charity_footer_start', 10 );

if ( ! function_exists( 'raise_charity_footer_site_info' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function raise_charity_footer_site_info() {
		$options = raise_charity_get_theme_options();
		$theme_data = wp_get_theme();
		$search = array( '[the-year]', '[site-link]' );

        $replace = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );

        $options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );

		$copyright_text = $options['copyright_text'] ? $options['copyright_text'] : '';
		?>

		<div class="site-info">
            <div class="wrapper">
                <span>
					<?php echo raise_charity_santize_allow_tag( $copyright_text ); ?>
				
					<?php echo esc_html__( ' All Rights Reserved | ', 'raise-charity' ) . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'raise-charity' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( ucwords( $theme_data->get( 'Author' ) ) ) .'</a>' ?>
                </span>
            </div><!-- .wrapper -->    
        </div><!-- .site-info -->

		<?php
	}
endif;
add_action( 'raise_charity_footer', 'raise_charity_footer_site_info', 40 );

if ( ! function_exists( 'raise_charity_footer_scroll_to_top' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function raise_charity_footer_scroll_to_top() {
		$options  = raise_charity_get_theme_options();
		?>
			<div class="backtotop"><?php echo raise_charity_get_svg( array( 'icon' => 'up' ) ); ?></div>
		<?php
	}
endif;
add_action( 'raise_charity_footer', 'raise_charity_footer_scroll_to_top', 40 );

if ( ! function_exists( 'raise_charity_footer_end' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function raise_charity_footer_end() {
		?>
		</footer>
		<div class="popup-overlay"></div>
		<?php
	}
endif;
add_action( 'raise_charity_footer', 'raise_charity_footer_end', 100 );

if ( ! function_exists( 'raise_charity_infinite_loader_spinner' ) ) :
	/**
	 *
	 * @since Raise Charity 1.0.0
	 *
	 */
	function raise_charity_infinite_loader_spinner() { 
		global $post;
		$options = raise_charity_get_theme_options();
		if ( $options['pagination_type'] == 'infinite' ) :
			if ( count( $post ) > 0 ) {
				echo '<div class="blog-loader">' . raise_charity_get_svg( array( 'icon' => 'spinner-umbrella' ) ) . '</div>';
			}
		endif;
	}
endif;
add_action( 'raise_charity_infinite_loader_spinner_action', 'raise_charity_infinite_loader_spinner', 10 );
