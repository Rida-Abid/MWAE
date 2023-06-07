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
$class = has_post_thumbnail() ? '' : 'no-post-thumbnail';
$options = raise_charity_get_theme_options();
$btn = !empty( $options['blog_page_post_btn'] ) ? $options['blog_page_post_btn'] : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
    <div class="post-wrapper">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url( 'post-thumbnail' ); ?>');">
                <a href="<?php the_permalink(); ?>" class="post-thumbnail-link"></a>
            </div><!-- .featured-image -->
        <?php endif; ?>

        <div class="entry-container">
                <?php raise_charity_posted_on(); ?>
            <header class="entry-header">
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </header>

            <div class="entry-content">
                <p><?php the_excerpt(); ?></p>
            </div><!-- .entry-content -->
            <div class="read-more">
                <a href="<?php the_permalink(); ?>" class="btn"><?php echo esc_html( $btn ); ?></a>
            </div><!-- .read-more -->
        </div><!-- .entry-container -->
    </div><!-- .post-wrapper -->
</article>