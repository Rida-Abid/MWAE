<?php
/**
 * Latest Posts section
 *
 * This is the template for the content of latest_posts section
 *
 * @package Theme Palace
 * @subpackage Raise Charity
 * @since Raise Charity 1.0.0
 */
if ( ! function_exists( 'raise_charity_add_latest_posts_section' ) ) :
    /**
    * Add latest_posts section
    *
    *@since Raise Charity 1.0.0
    */
    function raise_charity_add_latest_posts_section() {
        $options = raise_charity_get_theme_options();
        // Check if latest_posts is enabled on frontpage
        $latest_posts_enable = apply_filters( 'raise_charity_section_status', true, 'latest_posts_section_enable' );

        if ( true !== $latest_posts_enable ) {
            return false;
        }
        // Get latest_posts section details
        $section_details = array();
        $section_details = apply_filters( 'raise_charity_filter_latest_posts_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render latest_posts section now.
        raise_charity_render_latest_posts_section( $section_details );
    }
endif;

if ( ! function_exists( 'raise_charity_get_latest_posts_section_details' ) ) :
    /**
    * latest_posts section details.
    *
    * @since Raise Charity 1.0.0
    * @param array $input latest_posts section details.
    */
    function raise_charity_get_latest_posts_section_details( $input ) {
        $options = raise_charity_get_theme_options();

        // Content type.
        $latest_posts_content_type  = $options['latest_posts_content_type'];
        $content = array();
        switch ( $latest_posts_content_type ) {

            case 'post':
                $post_ids = array();
                $author = array();

                for ( $i = 1; $i <= 3; $i++ ) {
                    if ( ! empty( $options['latest_posts_content_post_' . $i] ) ) :
                        $post_ids[] = $options['latest_posts_content_post_' . $i];
                    endif;
                }
                
                $args = array(
                    'post_type'         => 'post',
                    'post__in'          => ( array ) $post_ids,
                    'posts_per_page'    => absint( 3 ),
                    'orderby'           => 'post__in',
                    'ignore_sticky_posts'   => true,
                    );                    
            break;

            case 'category':
                $cat_id = ! empty( $options['latest_posts_content_category'] ) ? $options['latest_posts_content_category'] : '';
                $args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => absint( 3 ),
                    'cat'               => absint( $cat_id ),
                    'ignore_sticky_posts'   => true,
                    );                    
            break;
            
            default:
            break;
        }

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = raise_charity_trim_content( 15 );
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
// latest_posts section content details.
add_filter( 'raise_charity_filter_latest_posts_section_details', 'raise_charity_get_latest_posts_section_details' );


if ( ! function_exists( 'raise_charity_render_latest_posts_section' ) ) :
  /**
   * Start latest_posts section
   *
   * @return string latest_posts content
   * @since Raise Charity 1.0.0
   *
   */
   function raise_charity_render_latest_posts_section( $content_details = array() ) {
        $options = raise_charity_get_theme_options();

        $section_title = !empty( $options['latest_posts_title'] ) ? $options['latest_posts_title'] : '';
        $section_sub_title = !empty( $options['latest_posts_sub_title'] ) ? $options['latest_posts_sub_title'] : '';
        $btn = !empty( $options['latest_posts_btn_text'] ) ? $options['latest_posts_btn_text'] : '';

        if ( empty( $content_details ) ) {
            return;
        } ?>
        
        <div id="latest-posts-section" class="relative page-section">
                <div class="wrapper">
                 <?php if ( is_customize_preview()):
                    raise_charity_section_tooltip( 'latest-posts-section' );
                    endif; ?>
                    <div class="section-header">
                    <?php if( !empty( $section_title ) ): ?>
                        <h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
                    <?php endif;
                    if( !empty( $section_sub_title ) ): ?>
                        <p class="section-subtitle"><?php echo esc_html( $section_sub_title ); ?></p>
                    <?php endif; ?>
                    </div><!-- .section-header -->

                    <div class="archive-blog-wrapper col-3 clear">
                        <?php foreach ( $content_details as $content ) : ?>

                        <article>
                            <div class="post-wrapper">
                                <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>" class="post-thumbnail-link"></a>
                                </div><!-- .featured-image -->

                                <div class="entry-container">
                                    <?php raise_charity_posted_on( $content['id'] ); ?>
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                    </header>

                                    <div class="entry-content">
                                        <p><?php echo wp_kses_post( $content['excerpt'] ); ?></p>
                                    </div><!-- .entry-content -->

                                    <?php if( !empty( $btn ) ): ?>
                                        <div class="read-more">
                                            <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn"><?php echo esc_html( $btn ); ?></a>
                                        </div><!-- .read-more -->
                                    <?php endif; ?>

                                </div><!-- .entry-container -->
                            </div><!-- .post-wrapper -->
                        </article>

                        <?php endforeach; ?>
                    </div><!-- .section-content -->
                </div><!-- .wrapper -->
            </div><!-- #latest-posts-section -->

    <?php }
endif;