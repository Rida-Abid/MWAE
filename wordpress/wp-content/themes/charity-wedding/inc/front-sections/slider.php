<?php
/**
 * Slider section
 *
 * This is the template for the content of slider section
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */
if ( ! function_exists( 'raise_charity_add_slider_section' ) ) :
    /**
    * Add slider section
    *
    *@since Raise Charity 1.0.0
    */
    function raise_charity_add_slider_section() {
    	$options = raise_charity_get_theme_options();
        // Check if slider is enabled on frontpage
        $slider_enable = apply_filters( 'raise_charity_section_status', true, 'slider_section_enable' );

        if ( true !== $slider_enable ) {
            return false;
        }
        // Get slider section details
        $section_details = array();
        $section_details = apply_filters( 'raise_charity_filter_slider_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render slider section now.
        raise_charity_render_slider_section( $section_details );
    }
endif;

if ( ! function_exists( 'raise_charity_get_slider_section_details' ) ) :
    /**
    * slider section details.
    *
    * @since Raise Charity 1.0.0
    * @param array $input slider section details.
    */
    function raise_charity_get_slider_section_details( $input ) {
        $options = raise_charity_get_theme_options();

        $content = array();
        $page_ids = array();
        for ( $i = 1; $i <= 3; $i++ ) {
            if ( ! empty( $options['slider_content_page_' . $i] ) )
                $page_ids[] = $options['slider_content_page_' . $i];
        }
        
        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => absint( 3 ),
            'orderby'           => 'post__in',
        );  

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = raise_charity_trim_content( 30 );
                $page_post['image']  	= has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-590x650.jpg';

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
// slider section content details.
add_filter( 'raise_charity_filter_slider_section_details', 'raise_charity_get_slider_section_details' );


if ( ! function_exists( 'raise_charity_render_slider_section' ) ) :
  /**
   * Start slider section
   *
   * @return string slider content
   * @since Raise Charity 1.0.0
   *
   */
   function raise_charity_render_slider_section( $content_details = array() ) {
        $options = raise_charity_get_theme_options();
        $btn_label = ! empty( $options['slider_btn_label'] ) ? $options['slider_btn_label'] : '';

        if ( empty( $content_details ) ) {
            return;
        } ?>
            <div id="blog-slider-section" class="slider-section">
                <div class="blog-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 800, "dots": true, "arrows":false, "autoplay": false, "draggable": true, "fade": false, "adaptiveHeight": true }'>
                <?php foreach ($content_details as $content ) : ?>
                    
                    <article style="background-image:url('<?php echo esc_url( $content['image'] ); ?>');">
                        <div class="overlay"></div>
                        <div class="wrapper">
                            <div class="blog-content-wrapper">
                                <div class="entry-container">
                                    <div class="entry-meta">
                                        <span class="posted-on">
                                            <?php raise_charity_posted_on( $content['id'] ); ?>
                                        </span><!-- .posted-on -->
                                    </div><!-- .entry-meta -->

                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                    </header>

                                    <?php if( !empty( $btn_label ) ): ?>
                                        <div class="read-more">
                                            <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn"><?php echo esc_html( $btn_label ); ?></a>
                                        </div><!-- .read-more -->
                                    <?php endif; ?>
                                </div><!-- .entry-container -->
                            </div><!-- .blog-content-wrapper -->
                        </div><!-- .wrapper -->
                    </article>
                    
                <?php endforeach; ?>
                </div><!-- .blog-slider -->
            </div><!-- #blog-slider-section -->
    <?php }
endif;