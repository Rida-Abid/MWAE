<?php
/**
 * Recent Cause section
 *
 * This is the template for the content of recent_cause section
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */
if ( ! function_exists( 'raise_charity_add_recent_cause_section' ) ) :
    /**
    * Add recent_cause section
    *
    *@since Raise Charity 1.0.0
    */
    function raise_charity_add_recent_cause_section() {
    	$options = raise_charity_get_theme_options();
        // Check if recent_cause is enabled on frontpage
        $recent_cause_enable = apply_filters( 'raise_charity_section_status', true, 'recent_cause_section_enable' );

        if ( true !== $recent_cause_enable ) {
            return false;
        }
        // Get recent_cause section details
        $section_details = array();
        $section_details = apply_filters( 'raise_charity_filter_recent_cause_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render recent_cause section now.
        raise_charity_render_recent_cause_section( $section_details );
    }
endif;

if ( ! function_exists( 'raise_charity_get_recent_cause_section_details' ) ) :
    /**
    * recent_cause section details.
    *
    * @since Raise Charity 1.0.0
    * @param array $input recent_cause section details.
    */
    function raise_charity_get_recent_cause_section_details( $input ) {
        $options = raise_charity_get_theme_options();

        $content = array();
        $post_ids = array();

        for ( $i = 1; $i <= 3; $i++ ) {
            if ( ! empty( $options['recent_cause_content_post_' . $i] ) )
                $post_ids[] = $options['recent_cause_content_post_' . $i];
        }
        $args = array(
            'post_type'         => 'post',
            'post__in'          => ( array ) $post_ids,
            'posts_per_page'    => absint( 3 ),
            'orderby'           => 'post__in',
            'ignore_sticky_posts'   => true,
        );   


        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = raise_charity_trim_content( 20 );
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
// recent_cause section content details.
add_filter( 'raise_charity_filter_recent_cause_section_details', 'raise_charity_get_recent_cause_section_details' );


if ( ! function_exists( 'raise_charity_render_recent_cause_section' ) ) :
  /**
   * Start recent_cause section
   *
   * @return string recent_cause content
   * @since Raise Charity 1.0.0
   *
   */
   function raise_charity_render_recent_cause_section( $content_details = array() ) {
        $options = raise_charity_get_theme_options();
        $section_title = ! empty( $options['recent_cause_title'] ) ? $options['recent_cause_title'] : '';
        $section_sub_title = ! empty( $options['recent_cause_sub_title'] ) ? $options['recent_cause_sub_title'] : '';
        $btn_label = ! empty( $options['recent_cause_btn_label'] ) ? $options['recent_cause_btn_label'] : '';

        if ( empty( $content_details ) ) {
            return;
        } ?>
        
        <div id="recent-cause-section" class="relative page-section">
            <div class="wrapper">
            <?php if ( is_customize_preview()):
                    raise_charity_section_tooltip( 'recent-cause-section' );
                    endif; ?>
                <div class="section-header">
                    <?php if( !empty( $section_title ) ): ?>
                        <h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
                    <?php endif;
                    if( !empty( $section_sub_title ) ):
                        ?>
                    <p class="section-subtitle"><?php echo esc_html( $section_sub_title ); ?></p>
                <?php endif; ?>
            </div><!-- .section-header -->

            <div class="section-content col-3 clear">

                <?php foreach ($content_details as $content ) : ?>

                    <article>
                        <div class="recent-cause-item">
                            <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
                                <a href="<?php echo esc_url( $content['url'] ); ?>" class="post-thumbnail-link"></a>
                            </div><!-- .featured-image -->

                            <div class="entry-container">
                                <span class="cat-links">
                                    <?php the_category( '', '', $content['id'] ); ?>
                                </span><!-- .cat-links -->

                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                </header>

                                <div class="entry-content">
                                    <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                </div><!-- .entry-content -->

                                <?php if( !empty( $btn_label ) ): ?>
                                    <div class="read-more">
                                        <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn"><?php echo esc_html( $btn_label ); ?></a>
                                    </div><!-- .read-more -->
                                <?php endif; ?>
                            </div><!-- .entry-container -->
                        </div><!-- .recent-cause-item -->
                    </article>

                <?php endforeach; ?>

            </div><!-- .col-3 -->
        </div><!-- .wrapper -->
    </div><!-- #recent-cause-section -->

    <?php }
endif;