<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */
$options = raise_charity_get_theme_options();
$class = has_post_thumbnail() ? '' : 'no-post-thumbnail';
?>


<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear ' . $class ); ?>>
    <div class="entry-container">
        <div class="entry-content">
            <?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'raise-charity' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'raise-charity' ),
					'after'  => '</div>',
				) );
			?>
        </div><!-- .entry-content -->
    </div><!-- .entry-container -->

    <div class="entry-meta">
       <?php if ( ! $options['single_post_hide_author'] ) :
			echo raise_charity_author_meta();
		endif; 

		if ( ! $options['single_post_hide_date'] ) :
			raise_charity_posted_on(); 
		endif; ?>

            <?php raise_charity_entry_footer(); ?>   
    </div><!-- .entry-meta -->
</article>
