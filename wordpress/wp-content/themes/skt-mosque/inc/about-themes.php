<?php
//about theme info
add_action( 'admin_menu', 'skt_mosque_abouttheme' );
function skt_mosque_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'skt-mosque'), esc_html__('About Theme', 'skt-mosque'), 'edit_theme_options', 'skt_mosque_guide', 'skt_mosque_mostrar_guide');   
} 
//guidline for about theme
function skt_mosque_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div class="col-left-area">
			  <?php esc_html_e('Theme Information', 'skt-mosque'); ?>
		   </div>
          <p><?php esc_html_e('SKT Mosque is an islamic centre for prayers, offerings, donation, charity, NGO, kids learning centre, meditation, nonprofit, fundraising, foster home, caretaker, Humanitarian, food trust, welfare schemes, volunteer programs, relief fund, church, disaster, peace, amnesty, blood donation camps, child education.  PayPal donation plugins compatible.','skt-mosque'); ?></p>
          <a href="<?php echo esc_url(SKT_MOSQUE_SKTTHEMES_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	<div class="col-right">			
			<div class="centerbold">
				<hr />
				<a href="<?php echo esc_url(SKT_MOSQUE_SKTTHEMES_LIVE_DEMO); ?>" target="_blank"><?php esc_html_e('Live Demo', 'skt-mosque'); ?></a> | 
				<a href="<?php echo esc_url(SKT_MOSQUE_SKTTHEMES_PRO_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'skt-mosque'); ?></a> | 
				<a href="<?php echo esc_url(SKT_MOSQUE_SKTTHEMES_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'skt-mosque'); ?></a>
                <div class="space5"></div>
				<hr />                
                <a href="<?php echo esc_url(SKT_MOSQUE_SKTTHEMES_THEMES); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>