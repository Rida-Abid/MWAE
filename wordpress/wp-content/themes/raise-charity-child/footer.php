<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

/**
 * raise_charity_footer_primary_content hook
 *
 * @hooked raise_charity_add_contact_section -  10
 *
 */
do_action( 'raise_charity_footer_primary_content' );

/**
 * raise_charity_content_end_action hook
 *
 * @hooked raise_charity_content_end -  10
 *
 */
do_action( 'raise_charity_content_end_action' );

/**
 * raise_charity_content_end_action hook
 *
 * @hooked raise_charity_footer_start -  10
 * @hooked raise_charity_footer_widgets->add_footer_widgets -  20
 * @hooked raise_charity_footer_site_info -  40
 * @hooked raise_charity_footer_end -  100
 *
 */
do_action( 'raise_charity_footer' );

/**
 * raise_charity_page_end_action hook
 *
 * @hooked raise_charity_page_end -  10
 *
 */
do_action( 'raise_charity_page_end_action' ); 

?>

<?php wp_footer(); ?>

</body>
</html>
