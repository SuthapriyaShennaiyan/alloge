<?php

if ( ! function_exists( 'alloggio_core_add_fonts_options' ) ) {
	/**
	 * Function that add options for this module
	 */
	function alloggio_core_add_fonts_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => ALLOGGIO_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'fonts',
				'title'       => esc_html__( 'Fonts', 'alloggio-core' ),
				'description' => esc_html__( 'Global Fonts Options', 'alloggio-core' ),
				'icon'        => 'fa fa-cog'
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_google_fonts',
					'title'         => esc_html__( 'Enable Google Fonts', 'alloggio-core' ),
					'default_value' => 'yes',
					'args'          => array(
						'custom_class' => 'qodef-enable-google-fonts'
					)
				)
			);

			$google_fonts_section = $page->add_section_element(
				array(
					'name'       => 'qodef_google_fonts_section',
					'title'      => esc_html__( 'Google Fonts Options', 'alloggio-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_google_fonts' => array(
								'values'        => 'yes',
								'default_value' => ''
							)
						)
					)
				)
			);

			$page_repeater = $google_fonts_section->add_repeater_element(
				array(
					'name'        => 'qodef_choose_google_fonts',
					'title'       => esc_html__( 'Google Fonts to Include', 'alloggio-core' ),
					'description' => esc_html__( 'Choose Google Fonts which you want to use on your website', 'alloggio-core' ),
					'button_text' => esc_html__( 'Add New Google Font', 'alloggio-core' )
				)
			);

			$page_repeater->add_field_element( array(
				'field_type'  => 'googlefont',
				'name'        => 'qodef_choose_google_font',
				'title'       => esc_html__( 'Google Font', 'alloggio-core' ),
				'description' => esc_html__( 'Choose Google Font', 'alloggio-core' ),
				'args'        => array(
					'include' => 'google-fonts'
				)
			) );

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_weight',
					'title'       => esc_html__( 'Google Fonts Weight', 'alloggio-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts weights for your website. Impact on page load time', 'alloggio-core' ),
					'options'     => array(
						'100'  => esc_html__( '100 Thin', 'alloggio-core' ),
						'100i' => esc_html__( '100 Thin Italic', 'alloggio-core' ),
						'200'  => esc_html__( '200 Extra-Light', 'alloggio-core' ),
						'200i' => esc_html__( '200 Extra-Light Italic', 'alloggio-core' ),
						'300'  => esc_html__( '300 Light', 'alloggio-core' ),
						'300i' => esc_html__( '300 Light Italic', 'alloggio-core' ),
						'400'  => esc_html__( '400 Regular', 'alloggio-core' ),
						'400i' => esc_html__( '400 Regular Italic', 'alloggio-core' ),
						'500'  => esc_html__( '500 Medium', 'alloggio-core' ),
						'500i' => esc_html__( '500 Medium Italic', 'alloggio-core' ),
						'600'  => esc_html__( '600 Semi-Bold', 'alloggio-core' ),
						'600i' => esc_html__( '600 Semi-Bold Italic', 'alloggio-core' ),
						'700'  => esc_html__( '700 Bold', 'alloggio-core' ),
						'700i' => esc_html__( '700 Bold Italic', 'alloggio-core' ),
						'800'  => esc_html__( '800 Extra-Bold', 'alloggio-core' ),
						'800i' => esc_html__( '800 Extra-Bold Italic', 'alloggio-core' ),
						'900'  => esc_html__( '900 Ultra-Bold', 'alloggio-core' ),
						'900i' => esc_html__( '900 Ultra-Bold Italic', 'alloggio-core' )
					)
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_subset',
					'title'       => esc_html__( 'Google Fonts Style', 'alloggio-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts style for your website. Impact on page load time', 'alloggio-core' ),
					'options'     => array(
						'latin'        => esc_html__( 'Latin', 'alloggio-core' ),
						'latin-ext'    => esc_html__( 'Latin Extended', 'alloggio-core' ),
						'cyrillic'     => esc_html__( 'Cyrillic', 'alloggio-core' ),
						'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'alloggio-core' ),
						'greek'        => esc_html__( 'Greek', 'alloggio-core' ),
						'greek-ext'    => esc_html__( 'Greek Extended', 'alloggio-core' ),
						'vietnamese'   => esc_html__( 'Vietnamese', 'alloggio-core' )
					)
				)
			);

			$page_repeater = $page->add_repeater_element(
				array(
					'name'        => 'qodef_custom_fonts',
					'title'       => esc_html__( 'Custom Fonts', 'alloggio-core' ),
					'description' => esc_html__( 'Add custom fonts', 'alloggio-core' ),
					'button_text' => esc_html__( 'Add New Custom Font', 'alloggio-core' )
				)
			);

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_ttf',
				'title'      => esc_html__( 'Custom Font TTF', 'alloggio-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_otf',
				'title'      => esc_html__( 'Custom Font OTF', 'alloggio-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_woff',
				'title'      => esc_html__( 'Custom Font WOFF', 'alloggio-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_woff2',
				'title'      => esc_html__( 'Custom Font WOFF2', 'alloggio-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'text',
				'name'       => 'qodef_custom_font_name',
				'title'      => esc_html__( 'Custom Font Name', 'alloggio-core' ),
			) );

			// Hook to include additional options after module options
			do_action( 'alloggio_core_action_after_page_fonts_options_map', $page );
		}
	}

	add_action( 'alloggio_core_action_default_options_init', 'alloggio_core_add_fonts_options', alloggio_core_get_admin_options_map_position( 'fonts' ) );
}