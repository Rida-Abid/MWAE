<?php
/**
 * Service section
 *
 * This is the template for the content of service section
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */
if ( ! function_exists( 'raise_charity_add_service_section' ) ) :
    /**
    * Add service section
    *
    *@since Raise Charity 1.0.0
    */
    function raise_charity_add_service_section() {
        $options = raise_charity_get_theme_options();
        // Check if service is enabled on frontpage
        $service_enable = apply_filters( 'raise_charity_section_status', true, 'service_section_enable' );

        if ( true !== $service_enable ) {
            return false;
        }
        // Get service section details
        $section_details = array();
        $section_details = apply_filters( 'raise_charity_filter_service_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render service section now.
        raise_charity_render_service_section( $section_details );
    }
endif;

if ( ! function_exists( 'raise_charity_get_service_section_details' ) ) :
    /**
    * service section details.
    *
    * @since Raise Charity 1.0.0
    * @param array $input service section details.
    */
    function raise_charity_get_service_section_details( $input ) {
        $options = raise_charity_get_theme_options();
        
        $content = array();
        $post_ids = array();

        for ( $i = 1; $i <= 3; $i++ ) {
            if ( ! empty( $options['service_content_post_' . $i] ) )
                $post_ids[] = $options['service_content_post_' . $i];
        }
        
        $args = array(
            'post_type'         => 'post',
            'post__in'          => ( array ) $post_ids,
            'posts_per_page'    => 3,
            'orderby'           => 'post__in',
            'ignore_sticky_posts'   => true,
        );

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = raise_charity_trim_content( 15 );
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : '';

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
// service section content details.
add_filter( 'raise_charity_filter_service_section_details', 'raise_charity_get_service_section_details' );


if ( ! function_exists( 'raise_charity_render_service_section' ) ) :
  /**
   * Start service section
   *
   * @return string service content
   * @since Raise Charity 1.0.0
   *
   */
   function raise_charity_render_service_section( $content_details = array() ) {
        $options = raise_charity_get_theme_options();
        $image = ! empty( $options['service_image'] ) ? $options['service_image'] : '';
        $service_title = ! empty( $options['service_title'] ) ? $options['service_title'] : '';
        $service_sub_title = ! empty( $options['service_sub_title'] ) ? $options['service_sub_title'] : '';

        if ( empty( $content_details ) ) {
            return;
        } 
        ?> 

        <div id="service-section" class="relative page-section">
            <div class="wrapper">
                <?php if ( is_customize_preview()):
                    raise_charity_section_tooltip( 'service-section' );
                endif; ?>
                <div class="service-section-wrap">

                <?php if( !empty( $image ) ): ?>
                    <div class="featured-image" style="background-image: url('<?php echo esc_url( $image ); ?>');"></div>
                <?php endif; ?>

                    <div class="section-container">
                        <div class="section-header">
                            <?php if( !empty( $service_title ) ): ?>
                                <h2 class="section-title"><?php echo esc_html( $service_title ); ?></h2>
                            <?php endif;
                            if( !empty( $service_sub_title ) ): ?>
                                <p class="section-subtitle"><?php echo esc_html( $service_sub_title ); ?></p>
                            <?php endif; ?>
                        </div><!-- .section-header -->

                        <div class="section-content col-3 clear">
                        <?php $i = 1; foreach ( $content_details as $content ) : ?>
                            
                            <article>
                                <div class="service-item-wrapper">
                                    <div class="icon-container">
                                        <a href="<?php echo esc_url( $content['url'] ); ?>"><i class="fa <?php echo ! empty( $options['service_content_icon_' . $i] ) ? esc_attr( $options['service_content_icon_' . $i] ) : 'fa-handshake-o'; ?>"></i></a>
                                    </div><!-- .icon-container -->

                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                    </header>

                                    <div class="entry-content">
                                        <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                    </div><!-- .entry-content -->
                                </div><!-- service-item-wrapper -->
                            </article>

                        <?php $i++; endforeach; ?>
                        </div><!-- .section-content -->
                    </div><!-- .section-container -->
                </div><!-- .service-section-wrap -->
            </div><!-- .wrapper -->
        </div><!-- #service-section -->

    <?php }
endif;