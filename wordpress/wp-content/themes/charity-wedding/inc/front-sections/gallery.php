<?php
/**
 * Featured Posts section
 *
 * This is the template for the content of gallery section
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */
if ( ! function_exists( 'charity_wedding_add_gallery_section' ) ) :
    /**
    * Add gallery section
    *
    *@since Raise Charity 1.0.0
    */
    function charity_wedding_add_gallery_section() {
        // Check if gallery is enabled on frontpage

        if ( get_theme_mod( 'gallery_section_enable' ) == false ) {
            return false;
        }
   
        // Get gallery section details
        $section_details = array();
        $section_details = apply_filters( 'charity_wedding_filter_gallery_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render gallery section now.
        charity_wedding_render_gallery_section( $section_details );
    }
endif;

if ( ! function_exists( 'charity_wedding_get_gallery_section_details' ) ) :
    /**
    * gallery section details.
    *
    * @since Raise Charity 1.0.0
    * @param array $input gallery section details.
    */
    function charity_wedding_get_gallery_section_details( $input ) {
        $options = raise_charity_get_theme_options();

        // Content type.
        $content = array();
        $cat_id = ! empty( get_theme_mod( 'gallery_content_category' ) ) ? get_theme_mod( 'gallery_content_category' ) : '';
        $args = array(
            'post_type'             => 'post',
            'posts_per_page'        => 6,
            'cat'                   => absint( $cat_id ),
            'ignore_sticky_posts'   => true,
        );                    

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'medium_large' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-590x650.jpg';

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
// gallery section content details.
add_filter( 'charity_wedding_filter_gallery_section_details', 'charity_wedding_get_gallery_section_details' );


if ( ! function_exists( 'charity_wedding_render_gallery_section' ) ) :
  /**
   * Start gallery section
   *
   * @return string gallery content
   * @since Raise Charity 1.0.0
   *
   */
   function charity_wedding_render_gallery_section( $content_details = array() ) {
        $options = raise_charity_get_theme_options();

       if ( empty( $content_details ) ) {
            return;
        } ?>

        <div id="gallery-section" class="relative page-section">
            <div class="wrapper">
            <?php if ( is_customize_preview()):
                raise_charity_section_tooltip( 'gallery-section' );
            endif; ?>
                <div class="section-header">
                    <?php if(!empty( get_theme_mod( 'gallery_title' ) )) echo '<h2 class="section-title">'.esc_html( get_theme_mod( 'gallery_title' ) ).'</h2>';
                    if(!empty( get_theme_mod( 'gallery_subtitle' ) )) echo '<p class="section-subtitle">'.esc_html( get_theme_mod( 'gallery_subtitle' ) ).'</p>'
                    ?>
                </div><!-- .section-header -->

                <div class="section-content col-3 clear">
                <?php foreach ( $content_details as $content ) : ?>

                    <article>
                        <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
                            <header class="entry-header">
                                <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                            </header>
                        </div><!-- .featured-image -->
                    </article>
                    <?php endforeach; ?>

                </div><!-- .col-3 -->
            </div><!-- .wrapper -->
        </div><!-- #gallery-section -->

    <?php }
endif;