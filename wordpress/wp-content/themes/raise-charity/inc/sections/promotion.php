<?php
/**
 * Promotion section
 *
 * This is the template for the content of promotion section
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */
if ( ! function_exists( 'raise_charity_add_promotion_section' ) ) :
    /**
    * Add promotion section
    *
    *@since Raise Charity 1.0.0
    */
    function raise_charity_add_promotion_section() {
    	$options = raise_charity_get_theme_options();
        // Check if promotion is enabled on frontpage
        $promotion_enable = apply_filters( 'raise_charity_section_status', true, 'promotion_section_enable' );

        if ( true !== $promotion_enable ) {
            return false;
        }
        // Get promotion section details
        $section_details = array();
        $section_details = apply_filters( 'raise_charity_filter_promotion_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render promotion section now.
        raise_charity_render_promotion_section( $section_details );
    }
endif;

if ( ! function_exists( 'raise_charity_get_promotion_section_details' ) ) :
    /**
    * promotion section details.
    *
    * @since Raise Charity 1.0.0
    * @param array $input promotion section details.
    */
    function raise_charity_get_promotion_section_details( $input ) {
        $options = raise_charity_get_theme_options();
        
        $content = array();
        $page_id = ! empty( $options['promotion_content_page'] ) ? $options['promotion_content_page'] : '';
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
                    $page_post['excerpt']   = raise_charity_trim_content( 7 );
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
// promotion section content details.
add_filter( 'raise_charity_filter_promotion_section_details', 'raise_charity_get_promotion_section_details' );


if ( ! function_exists( 'raise_charity_render_promotion_section' ) ) :
  /**
   * Start promotion section
   *
   * @return string promotion content
   * @since Raise Charity 1.0.0
   *
   */
function raise_charity_render_promotion_section( $content_details = array() ) {
    $options = raise_charity_get_theme_options();
    $promotion_image = ! empty( $options['promotion_image'] ) ? $options['promotion_image'] : '';

    if ( empty( $content_details ) ) {
        return;
    } 
    ?>
    <?php foreach ( $content_details as $content ): ?>

        <div id="promotion-section" class="relative page-section" style="background-image: url('<?php echo esc_url( $promotion_image ); ?>');">
            <div class="overlay"></div>
            <div class="wrapper">
              <?php if ( is_customize_preview()):
                raise_charity_section_tooltip( 'promotion-section' );
                endif; ?>
                <?php if( !empty( $content['title'] ) ): ?>
                    <header class="entry-header">
                        <h2 class="entry-title"><?php echo esc_html( $content['title'] ) ; ?></h2>
                    </header>
                <?php endif; 
                if( !empty( $content['excerpt'] ) ):
                    ?>

                <div class="entry-content">
                    <p><?php echo wp_kses_post( $content['excerpt'] ) ; ?></p>
                </div><!-- .entry-content -->
            <?php endif; ?>

            <?php if ( ! empty( $options['promotion_button'] ) && !empty( $content['url'] ) ): ?>
                <div class="read-more">
                    <a href="<?php echo esc_url( $content['url'] ) ; ?>" class="btn"><?php echo esc_html( $options['promotion_button'] ) ; ?></a>
                </div>
            <?php endif; ?>
        </div><!-- .wrapper -->
    </div><!-- #promotion-section -->

    <?php 
    endforeach;
}
endif;

