<?php
/**
 * Featured Posts section
 *
 * This is the template for the content of sponsor section
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */
if ( ! function_exists( 'charity_wedding_add_sponsor_section' ) ) :
    /**
    * Add sponsor section
    *
    *@since Raise Charity 1.0.0
    */
    function charity_wedding_add_sponsor_section() {
        // Check if sponsor is enabled on frontpage

        if ( get_theme_mod( 'sponsor_section_enable' ) == false ) {
            return false;
        }
   
        // Get sponsor section details
        $section_details = array();
        $section_details = apply_filters( 'charity_wedding_filter_sponsor_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render sponsor section now.
        charity_wedding_render_sponsor_section( $section_details );
    }
endif;

if ( ! function_exists( 'charity_wedding_get_sponsor_section_details' ) ) :
    /**
    * sponsor section details.
    *
    * @since Raise Charity 1.0.0
    * @param array $input sponsor section details.
    */
    function charity_wedding_get_sponsor_section_details( $input ) {
        $options = raise_charity_get_theme_options();
        // Content type.
        $content = array();
        // Run The Loop.
        for ( $i = 1; $i <= 5; $i++) : 

            $page_post['url']       = !empty( get_theme_mod( 'sponsor_url_'.$i.'' ) ) ? get_theme_mod( 'sponsor_url_'.$i.'' )  : '';
            $page_post['image']     = !empty( get_theme_mod( 'sponsor_image_'.$i.'' ) ) ? get_theme_mod( 'sponsor_image_'.$i.'' )  : '';
            // Push to the main array.
            array_push( $content, $page_post );
        endfor;
   
        if ( ! empty( $content ) ) {
            $input = $content;
        }

        return $input;
    }
endif;
// sponsor section content details.
add_filter( 'charity_wedding_filter_sponsor_section_details', 'charity_wedding_get_sponsor_section_details' );


if ( ! function_exists( 'charity_wedding_render_sponsor_section' ) ) :
  /**
   * Start sponsor section
   *
   * @return string sponsor content
   * @since Raise Charity 1.0.0
   *
   */
   function charity_wedding_render_sponsor_section( $content_details = array() ) {
        $options = raise_charity_get_theme_options();

       if ( empty( $content_details ) ) {
            return;
        } ?>
            <div id="sponsor-section" class="relative page-section same-background">
                <div class="wrapper">
                <?php if ( is_customize_preview()):
                    raise_charity_section_tooltip( 'sponsor-section' );
                endif; ?>

                    <div class="section-header">
                        <?php if(!empty( get_theme_mod( 'sponsor_title' ) )) echo '<h2 class="section-title">'.esc_html( get_theme_mod( 'sponsor_title' ) ).'</h2>';
                        if(!empty( get_theme_mod( 'sponsor_sub_title' ) )) echo '<p class="section-subtitle">'.esc_html( get_theme_mod( 'sponsor_sub_title' ) ).'</p>'
                        ?>
                    </div><!-- .section-header -->

                    <div class="section-content col-5 clear">
                    <?php foreach ( $content_details as $content ) : ?>
                        <article>
                            <div class="featured-image">
                                <a href="<?php echo esc_url( $content['url'] ); ?>" target="_blank"><img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>"></a>
                            </div><!-- .featured-image -->
                        </article>
                    <?php endforeach; ?>
                    </div><!-- .col-5 -->                        
                </div><!-- .wrapper -->
            </div><!-- #sponsor-section -->
    <?php }
endif;