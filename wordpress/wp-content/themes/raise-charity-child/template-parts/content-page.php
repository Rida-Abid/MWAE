<?php
/**
 * Template part for displaying page content in page.php.
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

    <div class="post-wrapper">
    	<?php if ( raise_charity_is_frontpage() ) : ?>
			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
			</header><!-- .entry-header -->
		<?php endif; ?>
    	<div class="entry-container">
			<div class="entry-content">
				<?php
					the_content();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'raise-charity' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<?php if ( get_edit_post_link() ) : ?>
				<footer class="entry-footer">
					<?php
						edit_post_link(
							sprintf(
								/* translators: %s: Name of current post */
								esc_html__( 'Edit %s', 'raise-charity' ),
								the_title( '<span class="screen-reader-text">"', '"</span>', false )
							),
							'<span class="edit-link">',
							'</span>'
						);
					?>
				</footer><!-- .entry-footer -->
			<?php endif; ?>
		</div><!-- .entry-container -->
	</div><!-- .post-wrapper -->
</article><!-- #post-## -->
