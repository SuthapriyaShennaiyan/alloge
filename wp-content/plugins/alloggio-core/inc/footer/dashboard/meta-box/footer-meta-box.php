<?php

if ( ! function_exists( 'alloggio_core_add_page_footer_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function alloggio_core_add_page_footer_meta_box( $page ) {
		
		if ( $page ) {
			$custom_sidebars = alloggio_core_get_custom_sidebars();
			$footer_columns  = apply_filters( 'alloggio_core_filter_footer_areas_columns_size', array() );
			
			$footer_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-footer',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Footer Settings', 'alloggio-core' ),
					'description' => esc_html__( 'Footer layout settings', 'alloggio-core' )
				)
			);
			
			$footer_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_page_footer',
					'title'       => esc_html__( 'Enable Page Footer', 'alloggio-core' ),
					'description' => esc_html__( 'Use this option to enable/disable page footer', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'no_yes' )
				)
			);
			
			$page_footer_section = $footer_tab->add_section_element(
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
					'field_type'  => 'select',
					'name'        => 'qodef_enable_uncovering_footer',
					'title'       => esc_html__( 'Enable Uncovering Footer', 'alloggio-core' ),
					'description' => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'no_yes' )
				)
			);
			
			$page_footer_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_footer_skin',
					'title'       => esc_html__( 'Footer Skin', 'alloggio-core' ),
					'description' => esc_html__( 'Choose a predefined style for footer elements', 'alloggio-core' ),
					'options'     => array(
						''      => esc_html__( 'Default', 'alloggio-core' ),
						'none'  => esc_html__( 'None', 'alloggio-core' ),
						'light' => esc_html__( 'Light', 'alloggio-core' ),
						'dark'  => esc_html__( 'Dark', 'alloggio-core' )
					)
				)
			);
			
			// Top Footer Area Section
			
			$page_footer_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_top_footer_area',
					'title'       => esc_html__( 'Enable Top Footer Area', 'alloggio-core' ),
					'description' => esc_html__( 'Use this option to enable/disable top footer area', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'no_yes' )
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
					'field_type'    => 'select',
					'name'          => 'qodef_set_footer_top_area_in_grid',
					'title'         => esc_html__( 'Top Footer Area in Grid', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will set page top footer area to be in grid', 'alloggio-core' ),
					'options'       => alloggio_core_get_select_type_options_pool( 'no_yes' )
				)
			);
			
			if ( isset( $footer_columns['footer_top_sidebars_number'] ) && ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				for ( $i = 1; $i <= intval( $footer_columns['footer_top_sidebars_number'] ); $i ++ ) {
					$top_footer_area_section->add_field_element(
						array(
							'field_type'  => 'select',
							'name'        => 'qodef_footer_top_area_custom_widget_' . $i,
							'title'       => sprintf( esc_html__( 'Custom Footer Top Area - Column %s', 'alloggio-core' ), $i ),
							'description' => sprintf( esc_html__( 'Widgets added here will appear in the %s column of top footer area', 'alloggio-core' ), $i ),
							'options'     => $custom_sidebars
						)
					);
				}
			}
			
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
					'title'      => esc_html__( 'Background Image', 'alloggio-core' ),
					'multiple'   => 'no'
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
					'field_type'    => 'select',
					'name'          => 'qodef_enable_bottom_footer_area',
					'title'         => esc_html__( 'Enable Bottom Footer Area', 'alloggio-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable bottom footer area', 'alloggio-core' ),
					'options'       => alloggio_core_get_select_type_options_pool( 'no_yes' )
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
					'field_type'    => 'select',
					'name'          => 'qodef_set_footer_bottom_area_in_grid',
					'title'         => esc_html__( 'Bottom Footer Area in Grid', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will set page bottom footer area to be in grid', 'alloggio-core' ),
					'options'       => alloggio_core_get_select_type_options_pool( 'no_yes' )
				)
			);
			
			if ( isset( $footer_columns['footer_bottom_sidebars_number'] ) && ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				for ( $i = 1; $i <= intval( $footer_columns['footer_bottom_sidebars_number'] ); $i ++ ) {
					$bottom_footer_area_section->add_field_element(
						array(
							'field_type'  => 'select',
							'name'        => 'qodef_footer_bottom_area_custom_widget_' . $i,
							'title'       => sprintf( esc_html__( 'Custom Footer Bottom Area - Column %s', 'alloggio-core' ), $i ),
							'description' => sprintf( esc_html__( 'Widgets added here will appear in the %s column of bottom footer area', 'alloggio-core' ), $i ),
							'options'     => $custom_sidebars
						)
					);
				}
			}
			
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
			do_action( 'alloggio_core_action_after_page_footer_meta_box_map', $footer_tab );
		}
	}
	
	add_action( 'alloggio_core_action_after_general_meta_box_map', 'alloggio_core_add_page_footer_meta_box' );
}