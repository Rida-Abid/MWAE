<?php if ( get_theme_mod('nonprofit_organization_featured_campaigns_section_enable') ) : ?>

<?php $nonprofit_organization_left_args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'category_name' =>  get_theme_mod('nonprofit_organization_featured_campaigns_category'),
  'posts_per_page' => get_theme_mod('nonprofit_organization_featured_campaigns_number'),
); ?>

	<div id="featured-campaigns" class="py-5">
		<div class="container">
			<?php if ( get_theme_mod('nonprofit_organization_featured_campaigns_heading') ) : ?>
    		<h2 class="text-center mb-5"><?php echo esc_html(get_theme_mod('nonprofit_organization_featured_campaigns_heading'));?></h2>
    	<?php endif; ?>
			<div class="row text-center">
				<?php $nonprofit_organization_arr_posts = new WP_Query( $nonprofit_organization_left_args );
			    if ( $nonprofit_organization_arr_posts->have_posts() ) :
			      while ( $nonprofit_organization_arr_posts->have_posts() ) :
			        $nonprofit_organization_arr_posts->the_post();
			        ?>
			        <div class="col-lg-4 col-md-6 col-sm-6">
			        	<div class="featured-box">
					        <?php if ( has_post_thumbnail() ) { ?>
							      <div class="post-thumbnail mb-2">
							      	<?php the_post_thumbnail(); ?>
							      </div>
							    <?php }?>
									<h3><?php the_title(); ?></h3>
									<p class="mb-0"><?php echo wp_trim_words( get_the_content(), 10 ); ?></p>
									<?php if( get_post_meta($post->ID, 'nonprofit_organization_raised_amount', true) || get_post_meta($post->ID, 'nonprofit_organization_goal_amount', true) ) {?>
										<hr>
										<div class="row">
											<div class="col-lg-6 col-md-6 col-6 text-left">
												<p class="mb-0"><?php esc_html_e('Raised','nonprofit-organization'); ?></p>
												<h6><span><?php echo esc_html(get_post_meta($post->ID,'nonprofit_organization_amount_currency',true)); ?></span><?php echo esc_html(get_post_meta($post->ID,'nonprofit_organization_raised_amount',true)); ?></h6>
											</div>
											<div class="col-lg-6 col-md-6 col-6 text-right">
												<p class="mb-0"><?php esc_html_e('Goal','nonprofit-organization'); ?></p>
												<h6><span><?php echo esc_html(get_post_meta($post->ID,'nonprofit_organization_amount_currency',true)); ?></span><?php echo esc_html(get_post_meta($post->ID,'nonprofit_organization_goal_amount',true)); ?></h6>
											</div>
										</div>
									<?php }?>
									<?php if( get_post_meta($post->ID, 'nonprofit_organization_raised_amount',true) || get_post_meta($post->ID, 'nonprofit_organization_goal_amount',true) ) {
											$raised = esc_attr(get_post_meta($post->ID,'nonprofit_organization_raised_amount',true));
											$raised_val = explode('$', $raised);
											$ra = $raised_val[0];
											$goal = esc_attr(get_post_meta($post->ID,'nonprofit_organization_goal_amount',true));
											$goal_val = explode('$', $goal);
											$ga = $goal_val[0];
											$percent = $ra/$ga*100;
										?>
										<div class="progress pink">
											<div class="progress-bar" style="width: <?php echo esc_attr($percent); ?>%;">
												<div class="progress-value"><?php echo esc_html($percent); ?>%</div>
											</div>
										</div>
									<?php }?>
									<p class="slider-button mt-4 mb-0">
		                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('DONATE NOW','nonprofit-organization'); ?></a>
		              </p>
		            </div>
    					</div>
			      <?php
			    endwhile;
			    wp_reset_postdata();
		    endif; ?>
			</div>
		</div>
	</div>

<?php endif; ?>
