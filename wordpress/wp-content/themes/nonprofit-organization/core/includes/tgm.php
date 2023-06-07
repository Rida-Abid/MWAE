<?php
	
require get_template_directory() . '/core/includes/class-tgm-plugin-activation.php';

/**
 * Recommended plugins.
 */
function nonprofit_organization_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Kirki Customizer Framework', 'nonprofit-organization' ),
			'slug'             => 'kirki',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	nonprofit_organization_tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'nonprofit_organization_register_recommended_plugins' );