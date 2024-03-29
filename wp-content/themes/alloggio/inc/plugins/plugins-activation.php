<?php

if ( ! function_exists( 'alloggio_register_required_plugins' ) ) {
	/**
	 * Function that registers theme required and optional plugins. Hooks to tgmpa_register hook
	 */
	function alloggio_register_required_plugins() {
		$plugins = array(
			array(
				'name'               => esc_html__( 'Qode Framework', 'alloggio' ),
				'slug'               => 'qode-framework',
				'source'             => ALLOGGIO_INC_ROOT_DIR . '/plugins/qode-framework.zip',
				'version'            => '1.2.1',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'               => esc_html__( 'Alloggio Core', 'alloggio' ),
				'slug'               => 'alloggio-core',
				'source'             => ALLOGGIO_INC_ROOT_DIR . '/plugins/alloggio-core.zip',
				'version'            => '1.2',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'               => esc_html__( 'Alloggio Membership', 'alloggio' ),
				'slug'               => 'alloggio-membership',
				'source'             => ALLOGGIO_INC_ROOT_DIR . '/plugins/alloggio-membership.zip',
				'version'            => '1.0.2',
				'required'           => false,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'               => esc_html__( 'Revolution Slider', 'alloggio' ),
				'slug'               => 'revslider',
				'source'             => ALLOGGIO_INC_ROOT_DIR . '/plugins/revslider.zip',
				'version'            => '6.6.11',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'     => esc_html__( 'Elementor Page Builder', 'alloggio' ),
				'slug'     => 'elementor',
				'required' => true,
			),
			array(
				'name'     => esc_html__( 'Qi Addons for Elementor', 'alloggio' ),
				'slug'     => 'qi-addons-for-elementor',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Qi Blocks', 'alloggio' ),
				'slug'     => 'qi-blocks',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'WooCommerce Plugin', 'alloggio' ),
				'slug'     => 'woocommerce',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Contact Form 7', 'alloggio' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Instagram Feed', 'alloggio' ),
				'slug'     => 'instagram-feed',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Envato Market', 'alloggio' ),
				'slug'     => 'envato-market',
				'source'   => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
				'required' => false,
			)
		);
		
		$config = array(
			'domain'       => 'alloggio',
			'default_path' => '',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'menu'         => 'install-required-plugins',
			'has_notices'  => true,
			'is_automatic' => false,
			'message'      => '',
			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'alloggio' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'alloggio' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'alloggio' ),
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'alloggio' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'alloggio' ),
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'alloggio' ),
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this website for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'alloggio' ),
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'alloggio' ),
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'alloggio' ),
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this website for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'alloggio' ),
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'alloggio' ),
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this website for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'alloggio' ),
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'alloggio' ),
				'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'alloggio' ),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'alloggio' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'alloggio' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'alloggio' ),
				'nag_type'                        => 'updated'
			),
		);
		
		tgmpa( $plugins, $config );
	}
	
	add_action( 'tgmpa_register', 'alloggio_register_required_plugins' );
}
