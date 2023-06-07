<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Theme Palace
	 * @subpackage Raise Charity
	 * @since Raise Charity 1.0.0
	 */

	/**
	 * raise_charity_doctype hook
	 *
	 * @hooked raise_charity_doctype -  10
	 *
	 */
	do_action( 'raise_charity_doctype' );

?>
<head>
<?php
	/**
	 * raise_charity_before_wp_head hook
	 *
	 * @hooked raise_charity_head -  10
	 *
	 */
	do_action( 'raise_charity_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>

<?php
	/**
	 * raise_charity_page_start_action hook
	 *
	 * @hooked raise_charity_page_start -  10
	 *
	 */
	do_action( 'raise_charity_page_start_action' ); 

	/**
	 * raise_charity_header_action hook
	 *
	 * @hooked raise_charity_header_start -  10
	 * @hooked raise_charity_site_branding -  20
	 * @hooked raise_charity_site_navigation -  30
	 * @hooked raise_charity_header_end -  50
	 *
	 */
	do_action( 'raise_charity_header_action' );

	/**
	 * raise_charity_content_start_action hook
	 *
	 * @hooked raise_charity_content_start -  10
	 *
	 */
	do_action( 'raise_charity_content_start_action' );

	/**
	 * raise_charity_header_image_action hook
	 *
	 * @hooked raise_charity_header_image -  10
	 *
	 */
	do_action( 'raise_charity_header_image_action' );

	if ( raise_charity_is_frontpage() ) {
    	$options = raise_charity_get_theme_options();
		
    	$sorted = array();
			$sortable = 'slider,featured_posts,service,gallery,event,latest_posts,contact,sponsor,cta';
			$sorted = explode( ',' , $sortable );

		foreach ( $sorted as $section ) {
			if ( $section == 'featured_posts' || $section == 'gallery' || $section == 'event' || $section == 'cta' || $section == 'sponsor' ) {
				add_action( 'charity_wedding_primary_content', 'charity_wedding_add_'. $section .'_section' );
			}else{
				add_action( 'charity_wedding_primary_content', 'raise_charity_add_'. $section .'_section' );
			}
		}

		do_action( 'charity_wedding_primary_content' );
	}