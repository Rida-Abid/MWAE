<?php

function Charity_Wedding_customize_register( $wp_customize ) {

	class Charity_Wedding_Switch_Control extends WP_Customize_Control{

		public $type = 'switch';

		public $on_off_label = array();

		public function __construct( $manager, $id, $args = array() ){
	        $this->on_off_label = $args['on_off_label'];
	        parent::__construct( $manager, $id, $args );
	    }

		public function render_content(){
	    ?>
		    <span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>

			<?php if( $this->description ){ ?>
				<span class="description customize-control-description">
				<?php echo wp_kses_post( $this->description ); ?>
				</span>
			<?php } ?>

			<?php
				$switch_class = ( $this->value() == 'true' ) ? 'switch-on' : '';
				$on_off_label = $this->on_off_label;
			?>
			<div class="onoffswitch <?php echo esc_attr( $switch_class ); ?>">
				<div class="onoffswitch-inner">
					<div class="onoffswitch-active">
						<div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['on'] ) ?></div>
					</div>

					<div class="onoffswitch-inactive">
						<div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['off'] ) ?></div>
					</div>
				</div>	
			</div>
			<input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr( $this->value() ); ?>"/>
			<?php
	    }
	}

	class Charity_Wedding_Dropdown_Chooser extends WP_Customize_Control{

		public $type = 'dropdown_chooser';

		public function render_content(){
			if ( empty( $this->choices ) )
	                return;
			?>
	            <label>
	                <span class="customize-control-title">
	                	<?php echo esc_html( $this->label ); ?>
	                </span>

	                <?php if($this->description){ ?>
		            <span class="description customize-control-description">
		            	<?php echo wp_kses_post($this->description); ?>
		            </span>
		            <?php } ?>

	                <select class="charity-wedding-chosen-select" <?php $this->link(); ?>>
	                    <?php
	                    foreach ( $this->choices as $value => $label )
	                        echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html( $label ) . '</option>';
	                    ?>
	                </select>
	            </label>
			<?php
		}
	}

	class Charity_Wedding_Dropdown_Taxonomies_Control extends WP_Customize_Control {

		/**
		 * Control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'dropdown-taxonomies';

		/**
		 * Taxonomy.
		 *
		 * @access public
		 * @var string
		 */
		public $taxonomy = '';

		/**
		 * Constructor.
		 *
		 * @since Raise Charity 1.0.0
		 *
		 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
		 * @param string               $id      Control ID.
		 * @param array                $args    Optional. Arguments to override class property defaults.
		 */
		public function __construct( $manager, $id, $args = array() ) {

			$taxonomy = 'category';
			if ( isset( $args['taxonomy'] ) ) {
				$taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
				if ( true === $taxonomy_exist ) {
					$taxonomy = esc_attr( $args['taxonomy'] );
				}
			}
			$args['taxonomy'] = $taxonomy;
			$this->taxonomy = esc_attr( $taxonomy );

			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Render content.
		 *
		 * @since Raise Charity 1.0.0
		 */
		public function render_content() {

			$tax_args = array(
				'hierarchical' => 0,
				'taxonomy'     => $this->taxonomy,
			);
			$taxonomies = get_categories( $tax_args );

		?>
		<label>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		<?php endif; ?>
		<select <?php $this->link(); ?>>
				<?php
				printf( '<option value="%s" %s>%s</option>', '', selected( $this->value(), '', false ), '--None--' );
				?>
				<?php if ( ! empty( $taxonomies ) ) :  ?>
				<?php foreach ( $taxonomies as $key => $tax ) :  ?>
					<?php
					printf( '<option value="%s" %s>%s</option>', esc_attr( $tax->term_id ), selected( $this->value(), $tax->term_id, false ), esc_html( $tax->name ) );
					?>
				<?php endforeach ?>
				<?php endif ?>
		</select>
		</label>
		<?php
		}
	}

	$wp_customize->remove_section( 'colors' );

	// Add Topbar section
	$wp_customize->add_section( 'charity_wedding_topbar_section',
		array(
			'title'             => esc_html__( 'Topbar','charity-wedding' ),
			'description'       => esc_html__( 'Topbar Section options.', 'charity-wedding' ),
			'panel'             => 'raise_charity_front_page_panel',
			'priority' 			=> 5,

		)
	);

	// topbar enable/disable control and setting
	$wp_customize->add_setting( 'topbar_section_enable',
		array(
			'default'			=> 	false,
			'sanitize_callback' => 'raise_charity_sanitize_switch_control',
		)
	);

	$wp_customize->add_control( new Charity_Wedding_Switch_Control( $wp_customize,
		'topbar_section_enable',
			array(
				'label'             => esc_html__( 'Topbar Section Enable', 'charity-wedding' ),
				'section'           => 'charity_wedding_topbar_section',
				'on_off_label' 		=> raise_charity_switch_options(),
			)
		)
	);

	$wp_customize->add_section( 'raise_charity_featured_posts_section',
		array(
			'title'             => esc_html__( 'Featured Posts','charity-wedding' ),
			'description'       => esc_html__( 'Featured Posts Section options.', 'charity-wedding' ),
			'panel'             => 'raise_charity_front_page_panel',
			'priority' 			=> 15,
		)
	);
	
	// Featured Posts content enable control and setting
	$wp_customize->add_setting( 'featured_posts_section_enable',
		array(
			'sanitize_callback' => 'raise_charity_sanitize_switch_control',
		)
	);
		
	$wp_customize->add_control( new Charity_Wedding_Switch_Control( $wp_customize,
		'featured_posts_section_enable',
			array(
				'label'             => esc_html__( 'Featured Posts Section Enable', 'charity-wedding' ),
				'section'           => 'raise_charity_featured_posts_section',
				'on_off_label' 		=> raise_charity_switch_options(),
			)
		)
	);
	
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'featured_posts_section_enable',
			array(
				'selector'            => '#featured-posts-section .tooltiptext',
				'settings'            => 'featured_posts_section_enable',
			)
		);
	}
	
	for ( $i = 1; $i <= 2; $i++ ) :

		// latest_posts pages drop down chooser control and setting
		$wp_customize->add_setting( 'featured_posts_content_page_' . $i . '',
			array(
				'sanitize_callback' => 'raise_charity_sanitize_page',
			)
		);
	
		$wp_customize->add_control( new Charity_Wedding_Dropdown_Chooser( $wp_customize,
			'featured_posts_content_page_' . $i . '',
				array(
					'label'             => sprintf( esc_html__( 'Select Page %d', 'charity-wedding' ), $i ),
					'section'           => 'raise_charity_featured_posts_section',
					'choices'			=> raise_charity_page_choices(),
					'active_callback'	=> 'charity_wedding_is_featured_posts_section_enable',
				)
			)
		);
	
	endfor;
	
	// Add Gallery section
	$wp_customize->add_section( 'charity_wedding_gallery_section',
		array(
			'title'             => esc_html__( 'Gallery Posts','charity-wedding' ),
			'description'       => esc_html__( 'Gallery Section options.', 'charity-wedding' ),
			'panel'             => 'raise_charity_front_page_panel',
			'priority' 			=> 35,
		)
	);

	// Gallery content enable control and setting
	$wp_customize->add_setting( 'gallery_section_enable',
		array(
			'default'			=> 	false,
			'sanitize_callback' => 'raise_charity_sanitize_switch_control',
		)
	);

	$wp_customize->add_control( new Charity_Wedding_Switch_Control( $wp_customize,
		'gallery_section_enable',
			array(
				'label'             => esc_html__( 'Gallery Section Enable', 'charity-wedding' ),
				'section'           => 'charity_wedding_gallery_section',
				'on_off_label' 		=> raise_charity_switch_options(),
			)
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'gallery_section_enable', array(
			'selector'            => '#gallery-section .tooltiptext',
			'settings'            => 'gallery_section_enable',
		) );
	}

	// gallery title setting and control
	$wp_customize->add_setting( 'gallery_title',
		array(
			'sanitize_callback'		=> 'sanitize_text_field',
			'transport'				=> 'postMessage',
			'default'				=> esc_html__( 'Pre-Wedding', 'charity-wedding' )
		)
	);

	$wp_customize->add_control( 'gallery_title',
		array(
			'label'      			=> esc_html__( 'Section Title', 'charity-wedding' ),
			'section'    			=> 'charity_wedding_gallery_section',
			'type'		 			=> 'text',
			'active_callback'		=> 'charity_wedding_is_gallery_section_enable',
		)
	);

	// Abort if selective refresh is not available.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'gallery_title',
			array(
				'selector'            => '#gallery-section h2.section-title',
				'settings'            => 'gallery_title',
				'container_inclusive' => false,
				'fallback_refresh'    => true,
				'render_callback'     => 'charity_wedding_gallery_title_partial',
			)
		);
	}

	// Gallery btn label setting and control
	$wp_customize->add_setting( 'gallery_subtitle',
		array(
			'default'			=> esc_html__( 'Designs the experience in 3 steps, each increasing in detail, from the flow to the wireframes.', 'charity-wedding' ),
			'sanitize_callback' => 'wp_kses_post',
			'transport'			=> 'postMessage',
		)
	);

	$wp_customize->add_control( 'gallery_subtitle',
		array(
			'label'           	=> esc_html__( 'Subtitle', 'charity-wedding' ),
			'section'        	=> 'charity_wedding_gallery_section',
			'active_callback' 	=> 'charity_wedding_is_gallery_section_enable',
			'type'				=> 'textarea',
		)
	);

	// Abort if selective refresh is not available.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'gallery_subtitle',
			array(
				'selector'            => '#gallery-section p.section-subtitle',
				'settings'            => 'gallery_subtitle',
				'container_inclusive' => false,
				'fallback_refresh'    => true,
				'render_callback'     => 'charity_wedding_gallery_subtitle_partial',
			)
		);
	}

	// Add dropdown category setting and control.
	$wp_customize->add_setting(  'gallery_content_category',
		array(
			'sanitize_callback' => 'raise_charity_sanitize_single_category',
		)
	);

	$wp_customize->add_control( new Charity_Wedding_Dropdown_Taxonomies_Control( $wp_customize,
		'gallery_content_category',
			array(
				'label'             => esc_html__( 'Select Category', 'charity-wedding' ),
				'description'      	=> esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'charity-wedding' ),
				'section'           => 'charity_wedding_gallery_section',
				'type'              => 'dropdown-taxonomies',
				'active_callback'	=> 'charity_wedding_is_gallery_section_enable'
			)
		)
	);
		
	// Add Event section
	$wp_customize->add_section( 'charity_wedding_event_section',
		array(
			'title'             => esc_html__( 'Events','charity-wedding' ),
			'description'       => esc_html__( 'Events Section options.', 'charity-wedding' ),
			'panel'             => 'raise_charity_front_page_panel',
			'priority' 			=> 56,

		)
	);

	// Event content enable control and setting
	$wp_customize->add_setting( 'event_section_enable',
		array(
			'default'			=> 	false,
			'sanitize_callback' => 'raise_charity_sanitize_switch_control',
		)
	);

	$wp_customize->add_control( new Charity_Wedding_Switch_Control( $wp_customize,
		'event_section_enable',
			array(
				'label'             => esc_html__( 'Event Section Enable', 'charity-wedding' ),
				'section'           => 'charity_wedding_event_section',
				'on_off_label' 		=> raise_charity_switch_options(),
			)
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'event_section_enable',
			array(
				'selector'            => '#event-section .tooltiptext',
				'settings'            => 'event_section_enable',
			)
		);
	}

	// event title setting and control
	$wp_customize->add_setting( 'event_title',
		array(
			'default'				=> esc_html__( 'Wedding Timeline', 'charity-wedding' ),
			'sanitize_callback'		=> 'sanitize_text_field',
			'transport'				=> 'postMessage',
		)
	);

	$wp_customize->add_control( 'event_title',
		array(
			'label'      			=> esc_html__( 'Section Title', 'charity-wedding' ),
			'section'    			=> 'charity_wedding_event_section',
			'type'		 			=> 'text',
			'active_callback'		=> 'charity_wedding_is_event_section_enable',
		)
	);

	// Abort if selective refresh is not available.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'event_title',
			array(
				'selector'            => '#event-section h2.section-title',
				'settings'            => 'event_title',
				'container_inclusive' => false,
				'fallback_refresh'    => true,
				'render_callback'     => 'charity_wedding_event_title_partial',
			)
		);
	}

	// event title setting and control
	$wp_customize->add_setting( 'event_subtitle',
		array(
			'default'				=> esc_html__( 'Children and poor people are at high risk of severe malnutrition & no education.', 'charity-wedding' ),
			'sanitize_callback'		=> 'wp_kses_post',
			'transport'				=> 'postMessage',
		)
	);

	$wp_customize->add_control( 'event_subtitle',
		array(
			'label'      			=> esc_html__( 'Section Sub Title', 'charity-wedding' ),
			'section'    			=> 'charity_wedding_event_section',
			'type'		 			=> 'textarea',
			'active_callback'		=> 'charity_wedding_is_event_section_enable',
		)
	);

	// Abort if selective refresh is not available.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'event_subtitle',
			array(
				'selector'            => '#event-section p.section-subtitle',
				'settings'            => 'event_subtitle',
				'container_inclusive' => false,
				'fallback_refresh'    => true,
				'render_callback'     => 'charity_wedding_event_subtitle_partial',
			)
		);
	}

	for ( $i = 1; $i <= 4; $i++ ) :

		// event pages drop down chooser control and setting
		$wp_customize->add_setting( 'event_content_page_' . $i . '',
			array(
				'sanitize_callback' => 'raise_charity_sanitize_page',
			)
		);

		$wp_customize->add_control( new Charity_Wedding_Dropdown_Chooser( $wp_customize, 
			'event_content_page_' . $i . '',
				array(
					'label'             => sprintf( esc_html__( 'Select Page %d', 'charity-wedding' ), $i ),
					'section'           => 'charity_wedding_event_section',
					'choices'			=> raise_charity_page_choices(),
					'active_callback'	=> 'charity_wedding_is_event_section_enable',
				)
			)
		);

	endfor;
		
	// Add CTA section
	$wp_customize->add_section( 'charity_wedding_cta_section',
		array(
			'title'             => esc_html__( 'CTA','charity-wedding' ),
			'description'       => esc_html__( 'CTA Section options.', 'charity-wedding' ),
			'panel'             => 'raise_charity_front_page_panel',
		)
	);

	// CTA content enable control and setting
	$wp_customize->add_setting( 'cta_section_enable',
		array(
			'default'			=> 	false,
			'sanitize_callback' => 'raise_charity_sanitize_switch_control',
		)
	);

	$wp_customize->add_control( new Charity_Wedding_Switch_Control( $wp_customize,
		'cta_section_enable',
			array(
				'label'             => esc_html__( 'CTA Section Enable', 'charity-wedding' ),
				'section'           => 'charity_wedding_cta_section',
				'on_off_label' 		=> raise_charity_switch_options(),
			)
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'cta_section_enable',
			array(
				'selector'            => '#call-to-action .tooltiptext',
				'settings'            => 'cta_section_enable',
			)
		);
	}

	// cta pages drop down chooser control and setting
	$wp_customize->add_setting( 'cta_content_page',
		array(
			'sanitize_callback' => 'raise_charity_sanitize_page',
		)
	);

	$wp_customize->add_control( new Charity_Wedding_Dropdown_Chooser( $wp_customize,
		'cta_content_page',
			array(
				'label'             => esc_html__( 'Select Page', 'charity-wedding' ),
				'section'           => 'charity_wedding_cta_section',
				'choices'			=> raise_charity_page_choices(),
				'active_callback'	=> 'charity_wedding_is_cta_section_enable',
			)
		)
	);


	// cta btn title setting and control
	$wp_customize->add_setting( 'cta_btn_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'			=> esc_html__( 'Christin & Thomas', 'charity-wedding'),
			'transport'			=> 'postMessage',
		)
	);

	$wp_customize->add_control( 'cta_btn_title',
		array(
			'label'           	=> esc_html__( 'Button Label', 'charity-wedding' ),
			'section'        	=> 'charity_wedding_cta_section',
			'active_callback' 	=> 'charity_wedding_is_cta_section_enable',
			'type'				=> 'text',
		)
	);

	// Abort if selective refresh is not available.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'cta_btn_title',
			array(
				'selector'            => '#call-to-action div.read-more a',
				'settings'            => 'cta_btn_title',
				'container_inclusive' => false,
				'fallback_refresh'    => true,
				'render_callback'     => 'charity_wedding_cta_btn_title_partial',
			)
		);
	}

	// top description setting and control
	$wp_customize->add_setting( 'contact_map_shortcode',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'			=> '[wpgmza id="1"]',
		)
	);

	$wp_customize->add_control( 'contact_map_shortcode',
		array(
			'label'           	=> esc_html__( 'Map Shortcode', 'raise-charity' ),
			'description'		=> esc_html__( 'Get the form shortcode from WP Google Maps plugin example [wpgmza id="1"] :', 'raise-charity' ),
			'section'        	=> 'raise_charity_contact_section',
			'active_callback' 	=> 'raise_charity_is_contact_section_enable',
			'type'				=> 'text',
			'priority'			=> 60
		)
	);

	// event title setting and control
	$wp_customize->add_setting( 'contact_us_number',
		array(
			'default'				=> esc_html__( '+977-123456789', 'charity-wedding' ),
			'sanitize_callback'		=> 'sanitize_text_field',
			'transport'				=> 'postMessage',
			)
		);
		
		$wp_customize->add_control( 'contact_us_number',
		array(
			'label'      			=> esc_html__( 'Phone Number', 'charity-wedding' ),
			'section'    			=> 'raise_charity_contact_section',
			'type'		 			=> 'text',
			'active_callback'		=> 'raise_charity_is_contact_section_enable',
			'priority'				=> 65
		)
	);

	// Abort if selective refresh is not available.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'contact_us_number',
			array(
				'selector'            => '#contact-section div.contact-information li p#number',
				'settings'            => 'contact_us_number',
				'container_inclusive' => false,
				'fallback_refresh'    => true,
				'render_callback'     => 'charity_wedding_contact_us_number_partial',
			)
		);
	}

	// event title setting and control
	$wp_customize->add_setting( 'contact_us_email',
		array(
			'default'				=> esc_html__( 'info@teachkiddo.com', 'charity-wedding' ),
			'sanitize_callback'		=> 'sanitize_text_field',
			'transport'				=> 'postMessage',
			)
		);
		
		$wp_customize->add_control( 'contact_us_email',
		array(
			'label'      			=> esc_html__( 'Email', 'charity-wedding' ),
			'section'    			=> 'raise_charity_contact_section',
			'type'		 			=> 'email',
			'active_callback'		=> 'raise_charity_is_contact_section_enable',
			'priority'				=> 70
		)
	);

	// Abort if selective refresh is not available.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'contact_us_email',
			array(
				'selector'            => '#contact-section div.contact-information li p#email',
				'settings'            => 'contact_us_email',
				'container_inclusive' => false,
				'fallback_refresh'    => true,
				'render_callback'     => 'charity_wedding_contact_us_email_partial',
			)
		);
	}

	// event title setting and control
	$wp_customize->add_setting( 'contact_us_address',
		array(
			'default'				=> esc_html__( '1258 Kapurdhara, Kathmandu', 'charity-wedding' ),
			'sanitize_callback'		=> 'sanitize_text_field',
			'transport'				=> 'postMessage',
			)
		);
		
		$wp_customize->add_control( 'contact_us_address',
		array(
			'label'      			=> esc_html__( 'Address', 'charity-wedding' ),
			'section'    			=> 'raise_charity_contact_section',
			'type'		 			=> 'text',
			'active_callback'		=> 'raise_charity_is_contact_section_enable',
			'priority'				=> 75
		)
	);

	// Abort if selective refresh is not available.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'contact_us_address',
			array(
				'selector'            => '#contact-section div.contact-information li p#address',
				'settings'            => 'contact_us_address',
				'container_inclusive' => false,
				'fallback_refresh'    => true,
				'render_callback'     => 'charity_wedding_contact_us_address_partial',
			)
		);
	}

	// Add Sponsor section
	$wp_customize->add_section( 'charity_wedding_sponsor_section',
		array(
			'title'             => esc_html__( 'Sponsor','charity-wedding' ),
			'description'       => esc_html__( 'Sponsor Section options.', 'charity-wedding' ),
			'panel'             => 'raise_charity_front_page_panel',
			'priority'			=> 85
		)
	);

	// Sponsor content enable control and setting
	$wp_customize->add_setting( 'sponsor_section_enable',
		array(
			'default'			=> 	false,
			'sanitize_callback' => 'raise_charity_sanitize_switch_control',
		)
	);

	$wp_customize->add_control( new Charity_Wedding_Switch_Control( $wp_customize,
		'sponsor_section_enable',
			array(
				'label'             => esc_html__( 'Sponsor Section Enable', 'charity-wedding' ),
				'section'           => 'charity_wedding_sponsor_section',
				'on_off_label' 		=> raise_charity_switch_options(),
			)
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'sponsor_section_enable',
			array(
				'selector'            => '#sponsor-section .tooltiptext',
				'settings'            => 'sponsor_section_enable',
			)
		);
	}

	// sponsor title setting and control
	$wp_customize->add_setting( 'sponsor_title',
		array(
			'default'       		=> esc_html__( 'Our Sponsors', 'charity-wedding' ),
			'sanitize_callback'		=> 'sanitize_text_field',
			'transport'				=> 'postMessage',
		)
	);

	$wp_customize->add_control( 'sponsor_title',
		array(
			'label'      			=> esc_html__( 'Section Title', 'charity-wedding' ),
			'section'    			=> 'charity_wedding_sponsor_section',
			'type'		 			=> 'text',
			'active_callback'		=> 'charity_wedding_is_sponsor_section_enable',
		)
	);

	// Abort if selective refresh is not available.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'sponsor_title',
			array(
				'selector'            => '#sponsor-section h2.section-title',
				'settings'            => 'sponsor_title',
				'container_inclusive' => false,
				'fallback_refresh'    => true,
				'render_callback'     => 'charity_wedding_sponsor_title_partial',
			)
		);
	}

	// Gallery btn label setting and control
	$wp_customize->add_setting( 'sponsor_sub_title',
		array(
			'sanitize_callback' => 'wp_kses_post',
			'default'			=> esc_html__( 'Children and poor people are at high risk of severe malnutrition & no education.', 'charity-wedding' ),
			'transport'			=> 'postMessage',
		)
	);

	$wp_customize->add_control( 'sponsor_sub_title',
		array(
			'label'           	=> esc_html__( 'Subtitle', 'charity-wedding' ),
			'section'        	=> 'charity_wedding_sponsor_section',
			'active_callback' 	=> 'charity_wedding_is_sponsor_section_enable',
			'type'				=> 'textarea',
		)
	);

	// Abort if selective refresh is not available.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'sponsor_sub_title',
			array(
				'selector'            => '#sponsor-section p.section-subtitle',
				'settings'            => 'sponsor_sub_title',
				'container_inclusive' => false,
				'fallback_refresh'    => true,
				'render_callback'     => 'charity_wedding_sponsor_sub_title_partial',
			)
		);
	}

	for ( $i = 1; $i <= 5; $i++ ) :
		// Sponsor image setting and control.
		$wp_customize->add_setting( 'sponsor_image_' . $i . '',
			array(
				'sanitize_callback' => 'raise_charity_sanitize_image',
			)
		);

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
			'sponsor_image_' . $i . '',
				array(
					'label'       		=> sprintf( esc_html__( 'Image %d', 'charity-wedding' ), $i),
					'section'     		=> 'charity_wedding_sponsor_section',
					'active_callback'	=> 'charity_wedding_is_sponsor_section_enable',
				)
			)
		);

		// Sponsor url setting and control
		$wp_customize->add_setting( 'sponsor_url_' . $i . '',
			array(
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control( 'sponsor_url_' . $i . '',
			array(
				'label'           	=> sprintf( esc_html__( 'Sponsor Url %d', 'charity-wedding' ), $i),
				'section'        	=> 'charity_wedding_sponsor_section',
				'active_callback' 	=> 'charity_wedding_is_sponsor_section_enable',
				'type'				=> 'url',
			)
		);

	endfor;

}
add_action( 'customize_register', 'Charity_Wedding_customize_register' );


function raise_charity_is_topbar_section_enable( $control ) {
	return ( $control->manager->get_setting( 'topbar_section_enable' )->value() );
}

function charity_wedding_is_featured_posts_section_enable( $control ) {
	return ( $control->manager->get_setting( 'featured_posts_section_enable' )->value() );
}

function charity_wedding_is_gallery_section_enable( $control ) {
	return ( $control->manager->get_setting( 'gallery_section_enable' )->value() );
}

function charity_wedding_is_event_section_enable( $control ) {
	return ( $control->manager->get_setting( 'event_section_enable' )->value() );
}

function charity_wedding_is_cta_section_enable( $control ) {
	return ( $control->manager->get_setting( 'cta_section_enable' )->value() );
}

function charity_wedding_is_sponsor_section_enable( $control ) {
	return ( $control->manager->get_setting( 'sponsor_section_enable' )->value() );
}


// gallery_title selective refresh
if ( ! function_exists( 'charity_wedding_gallery_title_partial' ) ) :
    function charity_wedding_gallery_title_partial() {
        return esc_html( get_theme_mod( 'gallery_title' ) );
    }
endif;

// gallery_subtitle selective refresh
if ( ! function_exists( 'charity_wedding_gallery_subtitle_partial' ) ) :
    function charity_wedding_gallery_subtitle_partial() {
        return esc_html( get_theme_mod( 'gallery_subtitle' ) );
    }
endif;

// event_title selective refresh
if ( ! function_exists( 'charity_wedding_event_title_partial' ) ) :
    function charity_wedding_event_title_partial() {
        return esc_html( get_theme_mod( 'event_title' ) );
    }
endif;

// event_subtitle selective refresh
if ( ! function_exists( 'charity_wedding_event_subtitle_partial' ) ) :
    function charity_wedding_event_subtitle_partial() {
        return esc_html( get_theme_mod( 'event_subtitle' ) );
    }
endif;

// cta_btn_title selective refresh
if ( ! function_exists( 'charity_wedding_cta_btn_title_partial' ) ) :
    function charity_wedding_cta_btn_title_partial() {
        return esc_html( get_theme_mod( 'cta_btn_title' ) );
    }
endif;

// sponsor_title selective refresh
if ( ! function_exists( 'charity_wedding_sponsor_title_partial' ) ) :
    function charity_wedding_sponsor_title_partial() {
        return esc_html( get_theme_mod( 'sponsor_title' ) );
    }
endif;

// sponsor_sub_title selective refresh
if ( ! function_exists( 'charity_wedding_sponsor_sub_title_partial' ) ) :
    function charity_wedding_sponsor_sub_title_partial() {
        return esc_html( get_theme_mod( 'sponsor_sub_title' ) );
    }
endif;