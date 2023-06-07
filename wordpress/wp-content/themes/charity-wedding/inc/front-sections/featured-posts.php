<?php
/**
 * Featured Posts section
 *
 * This is the template for the content of featured_posts section
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */
if ( ! function_exists( 'charity_wedding_add_featured_posts_section' ) ) :
    /**
    * Add featured_posts section
    *
    *@since Raise Charity 1.0.0
    */
    function charity_wedding_add_featured_posts_section() {
        // Check if featured_posts is enabled on frontpage

        if ( get_theme_mod( 'featured_posts_section_enable' ) == false ) {
            return false;
        }
   
        // Get featured_posts section details
        $section_details = array();
        $section_details = apply_filters( 'charity_wedding_filter_featured_posts_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render featured_posts section now.
        charity_wedding_render_featured_posts_section( $section_details );
    }
endif;

if ( ! function_exists( 'charity_wedding_get_featured_posts_section_details' ) ) :
    /**
    * featured_posts section details.
    *
    * @since Raise Charity 1.0.0
    * @param array $input featured_posts section details.
    */
    function charity_wedding_get_featured_posts_section_details( $input ) {
        $options = raise_charity_get_theme_options();

        // Content type.
        $content = array();
        $page_ids = array();
        for ( $i = 1; $i <= 2; $i++ ) {
            if ( ! empty( get_theme_mod( 'featured_posts_content_page_' . $i ) ) ) :
                $page_ids[] = get_theme_mod( 'featured_posts_content_page_' . $i );
            endif;
        }
        
        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => 2,
            'orderby'           => 'post__in',
        );                    

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'large' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-590x650.jpg';
                $page_post['excerpt']   = raise_charity_trim_content( 15 );

                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();
   
            
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// featured_posts section content details.
add_filter( 'charity_wedding_filter_featured_posts_section_details', 'charity_wedding_get_featured_posts_section_details' );


if ( ! function_exists( 'charity_wedding_render_featured_posts_section' ) ) :
  /**
   * Start featured_posts section
   *
   * @return string featured_posts content
   * @since Raise Charity 1.0.0
   *
   */
   function charity_wedding_render_featured_posts_section( $content_details = array() ) {
        $options = raise_charity_get_theme_options();

       if ( empty( $content_details ) ) {
            return;
        } ?>

        <div id="featured-posts-section" class="relative page-section">
            <div class="wrapper">
            <?php if ( is_customize_preview()):
                raise_charity_section_tooltip( 'featured-posts-section' );
            endif; ?>
                <div class="col-2 clear">
                <?php foreach ( $content_details as $content ) : ?>

                    <article>
                        <div class="featured-post-item">
                            <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
                                <a href="<?php echo esc_url( $content['url'] ); ?>" class="post-thumbnail-link" title="<?php echo esc_attr($content['title']); ?>"></a>
                            </div><!-- .featured-image -->

                            <header class="entry-header">
                                <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                            </header>
                        </div><!-- .featured-post-item -->
                    </article>
                <?php endforeach; ?>

                </div><!-- .col-2 -->
            </div><!-- .wrapper -->
        </div><!-- #featured-posts-section -->

    <?php }
endif;