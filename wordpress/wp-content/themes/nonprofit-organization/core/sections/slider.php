<?php if ( get_theme_mod('nonprofit_organization_blog_box_enable') ) : ?>

<?php $args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'category_name' =>  get_theme_mod('nonprofit_organization_blog_slide_category'),
  'posts_per_page' => get_theme_mod('nonprofit_organization_blog_slide_number'),
); ?>

<div class="slider">
  <div class="owl-carousel">
    <?php $nonprofit_organization_arr_posts = new WP_Query( $args );
    if ( $nonprofit_organization_arr_posts->have_posts() ) :
      while ( $nonprofit_organization_arr_posts->have_posts() ) :
        $nonprofit_organization_arr_posts->the_post();
        ?>
        <div class="blog_inner_box">
          <?php
            if ( has_post_thumbnail() ) :
              the_post_thumbnail();
            endif;
          ?>
          <div class="blog_box pt-3 pt-md-0">
            <?php if ( get_theme_mod('nonprofit_organization_extra_text') ) : ?>
              <h6><?php echo esc_html(get_theme_mod('nonprofit_organization_extra_text'));?></h6>
            <?php endif; ?>
            <?php if ( get_theme_mod('nonprofit_organization_title_unable_disable') ) : ?>
              <h3><?php the_title(); ?></h3>
            <?php endif; ?>
            <?php if ( get_theme_mod('nonprofit_organization_button_unable_disable') ) : ?>
              <p class="slider-button mt-4">
                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('GET IN TOUCH','nonprofit-organization'); ?></a>
              </p>
            <?php endif; ?>
          </div>
        </div>
      <?php
    endwhile;
    wp_reset_postdata();
    endif; ?>
  </div>
</div>

<?php endif; ?>
