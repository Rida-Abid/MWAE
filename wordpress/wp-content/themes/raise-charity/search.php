<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */

get_header(); 
?>

<div id="inner-content-wrapper" class="wrapper page-section">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="archive-blog-wrapper <?php echo esc_attr( $options['blog_page_column'] ); ?> clear">
				<?php
				if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif; ?>
					</div>
					<?php  
			/**
			* Hook - raise_charity_action_pagination.
			*
			* @hooked raise_charity_pagination 
			*/
			do_action( 'raise_charity_action_pagination' ); 

			/**
			* Hook - raise_charity_infinite_loader_spinner_action.
			*
			* @hooked raise_charity_infinite_loader_spinner 
			*/
			do_action( 'raise_charity_infinite_loader_spinner_action' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php  
	if ( raise_charity_is_sidebar_enable() ) {
		get_sidebar();
	}
	?>
</div><!-- .wrapper -->
<?php
get_footer();
