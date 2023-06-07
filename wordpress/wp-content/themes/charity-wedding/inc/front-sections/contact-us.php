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
                    <div class="section-header">
                        <?php if( !empty( $contact_title ) ): ?>
                            <h2 class="section-title"><?php echo esc_html( $contact_title ); ?></h2>
                        <?php endif;
                        if( !empty( $contact_sub_title ) ): ?>
                            <p class="section-subtitle"><?php echo esc_html( $contact_sub_title ); ?></p>
                        <?php endif; ?>
                    </div><!-- .section-header -->

                    <div class="section-content col-2">
                        <article>
                            <div class="contact-information">
                                <ul>
                                    <?php if(!empty( get_theme_mod( 'contact_us_number' ) )) : ?>
                                        <li>
                                            <i class="fa fa-phone"></i>
                                            <span><?php _e( 'Phone Number:', 'charity-wedding' ); ?></span>
                                            <p id="number"><?php echo esc_html( get_theme_mod( 'contact_us_number' ) ); ?></p>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(!empty( get_theme_mod( 'contact_us_email' ) )) : ?>
                                        <li>
                                            <i class="fa fa-envelope"></i>
                                            <span><?php _e( 'Email:', 'charity-wedding' ); ?></span>
                                            <p id="email"><?php echo esc_html( get_theme_mod( 'contact_us_email' ) ); ?></p>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(!empty( get_theme_mod( 'contact_us_address' ) )) : ?>
                                        <li>
                                            <i class="fa fa-map-marker"></i>
                                            <span><?php _e( 'Location:', 'charity-wedding' ); ?></span>
                                            <p id="address"><?php echo esc_html( get_theme_mod( 'contact_us_address' ) ); ?></p>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <?php if(!empty( get_theme_mod( 'contact_map_shortcode', '[wpgmza id="1"]' ) ) ) : ?>
                                <div id="map">
                                    <?php echo do_shortcode( get_theme_mod( 'contact_map_shortcode', '[wpgmza id="1"]' ) ); ?>
                                </div>
                            <?php endif; ?>
                        </article>
                        <?php if( class_exists('WPCF7') && !empty( $options['contact_form_shortcode'] )) : ?>
                            <article>
                                <?php echo do_shortcode( $options['contact_form_shortcode'] ); ?>
                            </article><!-- .section-content -->
                        <?php endif; ?>
                       
                    </div><!-- .section-content -->
                    
                </div><!-- .wrapper -->
            </div><!-- #contact-section -->

    <?php }
endif;

