<?php
/**
 * team section
 *
 * This is the template for the content of team section
 *
 * @team Theme Palace
 * @subteam Raise Charity
 * @since Raise Charity 1.0.0
 */
if ( ! function_exists( 'raise_charity_add_team_section' ) ) :
    /**
    * Add team section
    *
    *@since Raise Charity 1.0.0
    */
    function raise_charity_add_team_section() {
        $options = raise_charity_get_theme_options();
        // Check if team is enabled on frontpage
        $team_enable = apply_filters( 'raise_charity_section_status', true, 'team_section_enable' );


        if ( true !== $team_enable ) {
            return false;
        }
        // Get team section details
        $section_details = array();
        $section_details = apply_filters( 'raise_charity_filter_team_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render team section now.
        raise_charity_render_team_section( $section_details );
    }
endif;

if ( ! function_exists( 'raise_charity_get_team_section_details' ) ) :
    /**
    * team section details.
    *
    * @since Raise Charity 1.0.0
    * @param array $input team section details.
    */
    function raise_charity_get_team_section_details( $input ) {
        $options = raise_charity_get_theme_options();
        
        $content = array();
    
        $page_ids = array();

        for ( $i = 1; $i <= 3; $i++ ) {
            if ( ! empty( $options['team_content_page_' . $i] ) )
                $page_ids[] = $options['team_content_page_' . $i];
        }

        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => 3,
            'orderby'           => 'post__in',
            );

            // Run The Loop.
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : 
                while ( $query->have_posts() ) : $query->the_post();
                    $page_post['title']     = get_the_title();
                    $page_post['url']       = get_the_permalink();
                    $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'large' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-590x650.jpg';

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
// team section content details.
add_filter( 'raise_charity_filter_team_section_details', 'raise_charity_get_team_section_details' );


if ( ! function_exists( 'raise_charity_render_team_section' ) ) :
  /**
   * Start team section
   *
   * @return string team content
   * @since Raise Charity 1.0.0
   *
   */
   function raise_charity_render_team_section( $content_details = array() ) {
        $options = raise_charity_get_theme_options();
        $team_title = ! empty( $options['team_title'] ) ? $options['team_title'] : '';
        $team_sub_title = ! empty( $options['team_sub_title'] ) ? $options['team_sub_title'] : '';
        
        if ( empty( $content_details ) ) {
            return;
        } 
        ?> 
           
        <div id="team-section" class="relative page-section">
            <div class="wrapper">
                <?php if ( is_customize_preview()):
                raise_charity_section_tooltip( 'team-section' );
                endif; ?>
                <div class="section-header">
                <?php if( !empty( $team_title ) ): ?>
                    <h2 class="section-title"><?php echo esc_html( $team_title ) ?></h2>
                <?php endif;
                    if( !empty( $team_sub_title ) ):
                 ?>
                    <p class="section-subtitle"><?php echo esc_html( $team_sub_title ) ?></p>
                <?php endif; ?>
                </div><!-- .section-header -->

                <div class="section-content col-3 clear">

                <?php $i = 1; foreach ( $content_details as $content ) : ?>

                    <article>
                        <div class="team-item-wrapper">
                            <div class="featured-image">
                                <img src="<?php echo esc_url( $content['image'] ); ?>" alt="team <?php echo esc_attr( $i+1 ); ?>">
                            </div><!-- .featured-image -->

                            <div class="entry-container">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ) ; ?>"><?php echo esc_html( $content['title'] ) ; ?></a></h2>
                                    <?php if ( !empty( $options['team_position_'.$i] )): ?>
                                    <span class="team-position"><?php echo esc_html( $options['team_position_'.$i] ) ; ?></span>
                                <?php endif; ?>
                                </header>

                                <?php if( !empty( $options['team_btn_url_'.$i] ) && !empty( $options['team_btn_'.$i] ) ): ?>
                                <div class="read-more">
                                    <a href="<?php echo esc_url( $options['team_btn_url_'.$i] ) ; ?>" class="btn"><?php echo esc_html( $options['team_btn_'.$i] ) ; ?></a>
                                </div><!-- .read-more -->
                            <?php endif; ?>
                            </div><!-- .entry-container -->
                        </div><!-- team-item-wrapper -->
                    </article>

                <?php $i++; endforeach; ?>

                </div><!-- .col-3 -->
            </div><!-- .wrapper -->
        </div><!-- #team-section -->


    <?php }
endif;