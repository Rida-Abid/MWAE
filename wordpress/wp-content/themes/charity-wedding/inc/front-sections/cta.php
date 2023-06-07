<?php
/**
 * Featured Posts section
 *
 * This is the template for the content of cta section
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */
if ( ! function_exists( 'charity_wedding_add_cta_section' ) ) :
    /**
    * Add cta section
    *
    *@since Raise Charity 1.0.0
    */
    function charity_wedding_add_cta_section() {
        // Check if cta is enabled on frontpage

        if ( get_theme_mod( 'cta_section_enable' ) == false ) {
            return false;
        }
   
        // Get cta section details
        $section_details = array();
        $section_details = apply_filters( 'charity_wedding_filter_cta_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render cta section now.
        charity_wedding_render_cta_section( $section_details );
    }
endif;

if ( ! function_exists( 'charity_wedding_get_cta_section_details' ) ) :
    /**
    * cta section details.
    *
    * @since Raise Charity 1.0.0
    * @param array $input cta section details.
    */
    function charity_wedding_get_cta_section_details( $input ) {
        $options = raise_charity_get_theme_options();

        // Content type.
        $content = array();
        $page_id = null;
        if ( ! empty( get_theme_mod( 'cta_content_page' ) ) ) :
            $page_id = get_theme_mod( 'cta_content_page' );
        endif;
        
        $args = array(
            'post_type'         => 'page',
            'page_id'           => $page_id,
            'posts_per_page'    => 1,
        );                   

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();

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
// cta section content details.
add_filter( 'charity_wedding_filter_cta_section_details', 'charity_wedding_get_cta_section_details' );


if ( ! function_exists( 'charity_wedding_render_cta_section' ) ) :
  /**
   * Start cta section
   *
   * @return string cta content
   * @since Raise Charity 1.0.0
   *
   */
   function charity_wedding_render_cta_section( $content_details = array() ) {
        $options = raise_charity_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } 
        $btn_label = ! empty( get_theme_mod('cta_btn_title') ) ? get_theme_mod('cta_btn_title') : '';
        $content = $content_details[0]; ?>

        <div id="call-to-action" class="relative page-section">
            <div class="wrapper">
            <?php if ( is_customize_preview()):
                raise_charity_section_tooltip( 'call-to-action' );
            endif; ?>

                <div class="section-header">
                    <h2 class="section-title"><?php echo esc_html( $content['title'] ); ?></h2>
                </div><!-- .section-header -->

                <?php if( !empty( $btn_label ) ): ?>
                    <div class="read-more">
                        <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn"><?php echo esc_html( $btn_label )?></a>
                    </div><!-- .read-more -->
                <?php endif; ?>
            </div><!-- .wrapper  -->
        </div><!-- #call-to-action -->

    <?php }
endif;