<?php

if ( ! function_exists( 'alloggio_core_add_logo_options' ) ) {
	function alloggio_core_add_logo_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => ALLOGGIO_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'logo',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Logo', 'alloggio-core' ),
				'description' => esc_html__( 'Global Logo Options', 'alloggio-core' ),
				'layout'      => 'tabbed'
			)
		);

		if ( $page ) {

			$header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Header Logo Options', 'alloggio-core' ),
					'description' => esc_html__( 'Set options for initial headers', 'alloggio-core' )
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_height',
					'title'       => esc_html__( 'Logo Height', 'alloggio-core' ),
					'description' => esc_html__( 'Enter logo height', 'alloggio-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'alloggio-core' )
					)
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_logo_main',
					'title'         => esc_html__( 'Logo - Main', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose main logo image', 'alloggio-core' ),
					'default_value' => defined( 'ALLOGGIO_ASSETS_ROOT' ) ? ALLOGGIO_ASSETS_ROOT . '/img/logo.png' : '',
					'multiple'      => 'no'
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_dark',
					'title'       => esc_html__( 'Logo - Dark', 'alloggio-core' ),
					'description' => esc_html__( 'Choose dark logo image', 'alloggio-core' ),
					'multiple'    => 'no'
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_light',
					'title'       => esc_html__( 'Logo - Light', 'alloggio-core' ),
					'description' => esc_html__( 'Choose light logo image', 'alloggio-core' ),
					'multiple'    => 'no'
				)
			);

			// Hook to include additional options after module options
			do_action( 'alloggio_core_action_after_header_logo_options_map', $page, $header_tab );
		}
	}

	add_action( 'alloggio_core_action_default_options_init', 'alloggio_core_add_logo_options', alloggio_core_get_admin_options_map_position( 'logo' ) );
}