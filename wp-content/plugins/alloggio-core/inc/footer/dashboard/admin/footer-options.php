<?php

if ( ! function_exists( 'alloggio_core_add_page_footer_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function alloggio_core_add_page_footer_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope'       => ALLOGGIO_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'footer',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Footer', 'alloggio-core' ),
				'description' => esc_html__( 'Global Footer Options', 'alloggio-core' )
			)
		);
		
		if ( $page ) {
			
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_page_footer',
					'title'         => esc_html__( 'Enable Page Footer', 'alloggio-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable page footer', 'alloggio-core' ),
					'default_value' => 'yes'
				)
			);
			
			$page_footer_section = $page->add_section_element(
				array(
					'name'       => 'qodef_page_footer_section',
					'title'      => esc_html__( 'Footer Area', 'alloggio-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_page_footer' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);
			
			// General Footer Area Options
			
			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_uncovering_footer',
					'title'         => esc_html__( 'Enable Uncovering Footer', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'alloggio-core' ),
					'default_value' => 'no'
				)
			);
			
			$page_footer_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_footer_skin',
					'title'       => esc_html__( 'Footer Skin', 'alloggio-core' ),
					'description' => esc_html__( 'Choose a predefined style for footer elements', 'alloggio-core' ),
					'options'     => array(
						'none'  => esc_html__( 'None', 'alloggio-core' ),
						'light' => esc_html__( 'Light', 'alloggio-core' ),
						'dark'  => esc_html__( 'Dark', 'alloggio-core' )
					)
				)
			);
			
			// Top Footer Area Section
			
			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_top_footer_area',
					'title'         => esc_html__( 'Enable Top Footer Area', 'alloggio-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable top footer area', 'alloggio-core' ),
					'default_value' => 'yes'
				)
			);
			
			$top_footer_area_section = $page_footer_section->add_section_element(
				array(
					'name'       => 'qodef_top_footer_area_section',
					'title'      => esc_html__( 'Top Footer Area', 'alloggio-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_top_footer_area' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);
		
			$top_footer_area_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_set_footer_top_area_in_grid',
					'title'         => esc_html__( 'Top Footer Area In Grid', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will set page top footer area to be in grid', 'alloggio-core' ),
					'default_value' => 'yes'
				)
			);
			
			$top_footer_area_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_footer_top_area_columns',
					'title'         => esc_html__( 'Top Footer Area Columns', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose number of columns for top footer area', 'alloggio-core' ),
					'options'       => alloggio_core_get_select_type_options_pool( 'columns_number', true, array( '5', '6' ) ),
					'default_value' => '4'
				)
			);
			
			$top_footer_area_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_footer_top_area_columns_predefined',
					'title'         => esc_html__( 'Enable Predefined Columns Layout', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will set top footer area columns layout to be 2/5+1/5+1/5+1/5', 'alloggio-core' ),
					'default_value' => 'yes',
					'dependency' => array(
						'show' => array(
							'qodef_set_footer_top_area_columns' => array(
								'values'        => '4',
								'default_value' => '4'
							)
						)
					)
				)
			);
			
			$top_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_top_area_grid_gutter',
					'title'       => esc_html__( 'Top Footer Area Grid Gutter', 'alloggio-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between columns for top footer area', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'items_space' )
				)
			);
			
			$top_footer_area_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_footer_top_area_widgets_margin_bottom',
					'title'      => esc_html__( 'Widgets Margin Bottom', 'alloggio-core' ),
				)
			);
			
			$top_footer_area_styles_section = $top_footer_area_section->add_section_element(
				array(
					'name'       => 'qodef_top_footer_area_styles_section',
					'title'      => esc_html__( 'Top Footer Area Styles', 'alloggio-core' )
				)
			);
			
			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_top_footer_area_background_color',
					'title'      => esc_html__( 'Background Color', 'alloggio-core' )
				)
			);
			
			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_top_footer_area_background_image',
					'title'      => esc_html__( 'Background Image', 'alloggio-core' )
				)
			);
			
			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_top_footer_area_top_border_color',
					'title'      => esc_html__( 'Top Border Color', 'alloggio-core' )
				)
			);
			
			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_top_border_width',
					'title'      => esc_html__( 'Top Border Width', 'alloggio-core' ),
					'args'       => array(
						'suffix' => esc_html__( 'px', 'alloggio-core' )
					)
				)
			);
			
			// Bottom Footer Area Section
			
			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_bottom_footer_area',
					'title'         => esc_html__( 'Enable Bottom Footer Area', 'alloggio-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable bottom footer area', 'alloggio-core' ),
					'default_value' => 'yes'
				)
			);
			
			$bottom_footer_area_section = $page_footer_section->add_section_element(
				array(
					'name'       => 'qodef_bottom_footer_area_section',
					'title'      => esc_html__( 'Bottom Footer Area', 'alloggio-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_bottom_footer_area' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);
			
			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_set_footer_bottom_area_in_grid',
					'title'         => esc_html__( 'Bottom Footer Area In Grid', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will set page bottom footer area to be in grid', 'alloggio-core' ),
					'default_value' => 'yes'
				)
			);
			
			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_footer_bottom_area_columns',
					'title'         => esc_html__( 'Bottom Footer Area Columns', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose number of columns for bottom footer area', 'alloggio-core' ),
					'options'       => alloggio_core_get_select_type_options_pool( 'columns_number', true, array( '3', '4', '5', '6' ) ),
					'default_value' => '2'
				)
			);
			
			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_bottom_area_grid_gutter',
					'title'       => esc_html__( 'Bottom Footer Area Grid Gutter', 'alloggio-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between columns for bottom footer area', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'items_space' )
				)
			);
			
			$bottom_footer_area_styles_section = $bottom_footer_area_section->add_section_element(
				array(
					'name'       => 'qodef_bottom_footer_area_styles_section',
					'title'      => esc_html__( 'Bottom Footer Area Styles', 'alloggio-core' )
				)
			);
			
			$bottom_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_bottom_footer_area_background_color',
					'title'      => esc_html__( 'Background Color', 'alloggio-core' )
				)
			);
			
			$bottom_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_bottom_footer_area_top_border_color',
					'title'      => esc_html__( 'Top Border Color', 'alloggio-core' )
				)
			);
			
			$bottom_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_top_border_width',
					'title'      => esc_html__( 'Top Border Width', 'alloggio-core' ),
					'args'       => array(
						'suffix' => esc_html__( 'px', 'alloggio-core' )
					)
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'alloggio_core_action_after_page_footer_options_map', $page );
		}
	}
	
	add_action( 'alloggio_core_action_default_options_init', 'alloggio_core_add_page_footer_options', alloggio_core_get_admin_options_map_position( 'footer' ) );
}