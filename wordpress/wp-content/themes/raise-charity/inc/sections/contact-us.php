<?php
/**
 * Contact section
 *
 * This is the template for the content of contact section
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */
if ( ! function_exists( 'raise_charity_add_contact_section' ) ) :
    /**
    * Add contact section
    *
    *@since Raise Charity 1.0.0
    */
    function raise_charity_add_contact_section() {
        $options = raise_charity_get_theme_options();

        // Check if contact is enabled on frontpage
        $contact_enable = apply_filters( 'raise_charity_section_status', true, 'contact_section_enable' );


        if ( true !== $contact_enable ) {
           return false;
        }

        // Render contact section now.
        raise_charity_render_contact_section();
    }
endif;

if ( ! function_exists( 'raise_charity_render_contact_section' ) ) :
  /**
   * Start contact section
   *
   * @return string contact content
   * @since Raise Charity 1.0.0
   *
   */
   function raise_charity_render_contact_section() {
        
        $options = raise_charity_get_theme_options();

        $contact_title = !empty( $options['contact_title'] ) ? $options['contact_title'] : '';
        $contact_sub_title = !empty( $options['contact_sub_title'] ) ? $options['contact_sub_title'] : '';
        $contact_image = !empty( $options['contact_image'] ) ? $options['contact_image'] : '';

        ?>

       <div id="contact-section" class="relative page-section" style="background-image: url('<?php echo esc_url( $contact_image ); ?>');">
                <div class="overlay"></div>
                <div class="wrapper">
                <?php if ( is_customize_preview()):
                raise_charity_section_tooltip( 'contact-section' );
                endif; ?>
                    <div class="section-header">
                    <?php if( !empty( $contact_title ) ): ?>
                        <h2 class="section-title"><?php echo esc_html( $contact_title ); ?></h2>
                    <?php endif;
                        if( !empty( $contact_sub_title ) ):
                     ?>
                        <p class="section-subtitle"><?php echo esc_html( $contact_sub_title ); ?></p>
                    <?php endif; ?>
                    </div><!-- .section-header -->

                    <?php if( class_exists('WPCF7') && !empty( $options['contact_form_shortcode'] )) : ?>

                    <div class="section-content">
                        <?php echo do_shortcode( $options['contact_form_shortcode'] ); ?>
                    </div><!-- .section-content -->

                    <?php endif; ?>

                </div><!-- .wrapper -->
            </div><!-- #contact-section -->

    <?php }
endif;

