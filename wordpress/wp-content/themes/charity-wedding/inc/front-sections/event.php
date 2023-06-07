<?php
/**
 * Event section
 *
 * This is the template for the content of event section
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */
if ( ! function_exists( 'charity_wedding_add_event_section' ) ) :
    /**
    * Add event section
    *
    *@since Raise Charity 1.0.0
    */
    function charity_wedding_add_event_section() {
        // Check if event is enabled on frontpage

        if ( get_theme_mod( 'event_section_enable' ) == false ) {
            return false;
        }
   
        // Get event section details
        $section_details = array();
        $section_details = apply_filters( 'charity_wedding_filter_event_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render event section now.
        charity_wedding_render_event_section( $section_details );
    }
endif;

if ( ! function_exists( 'charity_wedding_get_event_section_details' ) ) :
    /**
    * event section details.
    *
    * @since Raise Charity 1.0.0
    * @param array $input event section details.
    */
    function charity_wedding_get_event_section_details( $input ) {
        $options = raise_charity_get_theme_options();

        // Content type.
        $content = array();
        $page_ids = array();
        for ( $i = 1; $i <= 4; $i++ ) {
            if ( ! empty( get_theme_mod( 'event_content_page_' . $i ) ) ) :
                $page_ids[] = get_theme_mod( 'event_content_page_' . $i );
            endif;
        }
        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => 4,
            'orderby'           => 'post__in',
        );                     

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
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
// event section content details.
add_filter( 'charity_wedding_filter_event_section_details', 'charity_wedding_get_event_section_details' );


if ( ! function_exists( 'charity_wedding_render_event_section' ) ) :
  /**
   * Start event section
   *
   * @return string event content
   * @since Raise Charity 1.0.0
   *
   */
   function charity_wedding_render_event_section( $content_details = array() ) {
        $options = raise_charity_get_theme_options();

       if ( empty( $content_details ) ) {
            return;
        } ?>

        <div id="event-section" class="relative page-section">
            <div class="wrapper">
            <?php if ( is_customize_preview()):
                raise_charity_section_tooltip( 'event-section' );
            endif; ?>
                <div class="section-header">
                    <?php if(!empty( get_theme_mod( 'event_title' ) )) echo '<h2 class="section-title">'.esc_html( get_theme_mod( 'event_title' ) ).'</h2>';
                    if(!empty( get_theme_mod( 'event_subtitle' ) )) echo '<p class="section-subtitle">'.esc_html( get_theme_mod( 'event_subtitle' ) ).'</p>'; ?>
                </div><!-- .section-header -->

                <div class="section-content clear">
                <?php foreach ( $content_details as $content ) : ?>

                    <article>
                        <div class="event-wrapper">
                            <div class="entry-container">
                                <span class="posted-on">
                                    <?php raise_charity_posted_on( $content['id'] ); ?>
                                </span><!-- .posted-on -->

                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                </header>

                                <div class="entry-content">
                                    <p><?php echo wp_kses_post( $content['excerpt'] ); ?></p>
                                </div><!-- .entry-content -->
                            </div><!-- .entry-container -->
                        </div><!-- .event-wrapper -->
                    </article>
                    <?php endforeach; ?>

                </div><!-- .col-2 -->
            </div><!-- .wrapper -->
        </div><!-- #event-section -->

    <?php }
endif;