<?php

add_action( 'admin_menu', 'nonprofit_organization_getting_started' );
function nonprofit_organization_getting_started() {
	add_theme_page( esc_html__('Get Started', 'nonprofit-organization'), esc_html__('Get Started', 'nonprofit-organization'), 'edit_theme_options', 'nonprofit-organization-guide-page', 'nonprofit_organization_test_guide');
}

function nonprofit_organization_admin_enqueue_scripts() {
	wp_enqueue_style( 'nonprofit-organization-admin-style', esc_url( get_template_directory_uri() ).'/css/main.css' );
}
add_action( 'admin_enqueue_scripts', 'nonprofit_organization_admin_enqueue_scripts' );

if ( ! defined( 'NONPROFIT_ORGANIZATION_DOCS_FREE' ) ) {
define('NONPROFIT_ORGANIZATION_DOCS_FREE',__('https://www.misbahwp.com/docs/nonprofit-organization-free-docs/','nonprofit-organization'));
}
if ( ! defined( 'NONPROFIT_ORGANIZATION_DOCS_PRO' ) ) {
define('NONPROFIT_ORGANIZATION_DOCS_PRO',__('https://www.misbahwp.com/docs/nonprofit-organization-pro-docs','nonprofit-organization'));
}
if ( ! defined( 'NONPROFIT_ORGANIZATION_BUY_NOW' ) ) {
define('NONPROFIT_ORGANIZATION_BUY_NOW',__('https://www.misbahwp.com/themes/nonprofit-organization-wordpress-theme/','nonprofit-organization'));
}
if ( ! defined( 'NONPROFIT_ORGANIZATION_SUPPORT_FREE' ) ) {
define('NONPROFIT_ORGANIZATION_SUPPORT_FREE',__('https://wordpress.org/support/theme/nonprofit-organization','nonprofit-organization'));
}
if ( ! defined( 'NONPROFIT_ORGANIZATION_REVIEW_FREE' ) ) {
define('NONPROFIT_ORGANIZATION_REVIEW_FREE',__('https://wordpress.org/support/theme/nonprofit-organization/reviews/#new-post','nonprofit-organization'));
}
if ( ! defined( 'NONPROFIT_ORGANIZATION_DEMO_PRO' ) ) {
define('NONPROFIT_ORGANIZATION_DEMO_PRO',__('https://www.misbahwp.com/demo/nonprofit-organization/','nonprofit-organization'));
}

function nonprofit_organization_test_guide() { ?>
	<?php $nonprofit_organization_theme = wp_get_theme(); ?>

	<div class="wrap" id="main-page">
		<div id="lefty">
			<div id="admin_links">
				<a href="<?php echo esc_url( NONPROFIT_ORGANIZATION_DOCS_FREE ); ?>" target="_blank" class="blue-button-1"><?php esc_html_e( 'Documentation', 'nonprofit-organization' ) ?></a>
				<a href="<?php echo esc_url( admin_url('customize.php') ); ?>" id="customizer" target="_blank"><?php esc_html_e( 'Customize', 'nonprofit-organization' ); ?> </a>
				<a class="blue-button-1" href="<?php echo esc_url( NONPROFIT_ORGANIZATION_SUPPORT_FREE ); ?>" target="_blank" class="btn3"><?php esc_html_e( 'Support', 'nonprofit-organization' ) ?></a>
				<a class="blue-button-2" href="<?php echo esc_url( NONPROFIT_ORGANIZATION_REVIEW_FREE ); ?>" target="_blank" class="btn4"><?php esc_html_e( 'Review', 'nonprofit-organization' ) ?></a>
			</div>
			<div id="description">
				<h3><?php esc_html_e('Welcome! Thank you for choosing ','nonprofit-organization'); ?><?php echo esc_html( $nonprofit_organization_theme ); ?>  <span><?php esc_html_e('Version: ', 'nonprofit-organization'); ?><?php echo esc_html($nonprofit_organization_theme['Version']);?></span></h3>
				<img class="img_responsive" style="width:100%;" src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png">
				<div id="description-inside">
					<?php
						$nonprofit_organization_theme = wp_get_theme();
						echo wp_kses_post( apply_filters( 'misbah_theme_description', esc_html( $nonprofit_organization_theme->get( 'Description' ) ) ) );
					?>
				</div>
			</div>
		</div>

		<div id="righty">
			<div class="postbox donate">
				<div class="d-table">
			    <ul class="d-column">
			      <li class="feature"><?php esc_html_e('Features','nonprofit-organization'); ?></li>
			      <li class="free"><?php esc_html_e('Pro','nonprofit-organization'); ?></li>
			      <li class="plus"><?php esc_html_e('Free','nonprofit-organization'); ?></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('24hrs Priority Support','nonprofit-organization'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Kirki Framework','nonprofit-organization'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Posttype','nonprofit-organization'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('One Click Demo Import','nonprofit-organization'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Section Reordering','nonprofit-organization'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Enable / Disable Option','nonprofit-organization'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Multiple Sections','nonprofit-organization'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Color Pallete','nonprofit-organization'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Widgets','nonprofit-organization'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Page Templates','nonprofit-organization'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Typography','nonprofit-organization'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Section Background Image / Color ','nonprofit-organization'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
	  		</div>
				<h3 class="hndle"><?php esc_html_e( 'Upgrade to Premium', 'nonprofit-organization' ); ?></h3>
				<div class="inside">
					<p><?php esc_html_e('Discover upgraded pro features with premium version click to upgrade.','nonprofit-organization'); ?></p>
					<div id="admin_pro_links">
						<a class="blue-button-2" href="<?php echo esc_url( NONPROFIT_ORGANIZATION_BUY_NOW ); ?>" target="_blank"><?php esc_html_e( 'Go Pro', 'nonprofit-organization' ); ?></a>
						<a class="blue-button-1" href="<?php echo esc_url( NONPROFIT_ORGANIZATION_DEMO_PRO ); ?>" target="_blank"><?php esc_html_e( 'Live Demo', 'nonprofit-organization' ) ?></a>
						<a class="blue-button-2" href="<?php echo esc_url( NONPROFIT_ORGANIZATION_DOCS_PRO ); ?>" target="_blank"><?php esc_html_e( 'Pro Docs', 'nonprofit-organization' ) ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } ?>
