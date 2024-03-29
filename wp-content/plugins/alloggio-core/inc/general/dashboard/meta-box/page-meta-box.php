<?php

if ( ! function_exists( 'alloggio_core_add_general_page_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function alloggio_core_add_general_page_meta_box( $page ) {

		$general_tab = $page->add_tab_element(
			array(
				'name'        => 'tab-page',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Page Settings', 'alloggio-core' ),
				'description' => esc_html__( 'General page layout settings', 'alloggio-core' )
			)
		);
		
		$general_tab->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_main_color',
				'title'       => esc_html__( 'Main Color', 'alloggio-core' ),
				'description' => esc_html__( 'Choose the most dominant theme color', 'alloggio-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_page_background_color',
				'title'       => esc_html__( 'Page Background Color', 'alloggio-core' ),
				'description' => esc_html__( 'Set background color', 'alloggio-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_page_background_image',
				'title'       => esc_html__( 'Page Background Image', 'alloggio-core' ),
				'description' => esc_html__( 'Set background image', 'alloggio-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_repeat',
				'title'       => esc_html__( 'Page Background Image Repeat', 'alloggio-core' ),
				'description' => esc_html__( 'Set background image repeat', 'alloggio-core' ),
				'options'     => array(
					''          => esc_html__( 'Default', 'alloggio-core' ),
					'no-repeat' => esc_html__( 'No Repeat', 'alloggio-core' ),
					'repeat'    => esc_html__( 'Repeat', 'alloggio-core' ),
					'repeat-x'  => esc_html__( 'Repeat-x', 'alloggio-core' ),
					'repeat-y'  => esc_html__( 'Repeat-y', 'alloggio-core' )
				)
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_size',
				'title'       => esc_html__( 'Page Background Image Size', 'alloggio-core' ),
				'description' => esc_html__( 'Set background image size', 'alloggio-core' ),
				'options'     => array(
					''        => esc_html__( 'Default', 'alloggio-core' ),
					'contain' => esc_html__( 'Contain', 'alloggio-core' ),
					'cover'   => esc_html__( 'Cover', 'alloggio-core' )
				)
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_attachment',
				'title'       => esc_html__( 'Page Background Image Attachment', 'alloggio-core' ),
				'description' => esc_html__( 'Set background image attachment', 'alloggio-core' ),
				'options'     => array(
					''       => esc_html__( 'Default', 'alloggio-core' ),
					'fixed'  => esc_html__( 'Fixed', 'alloggio-core' ),
					'scroll' => esc_html__( 'Scroll', 'alloggio-core' )
				)
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding',
				'title'       => esc_html__( 'Page Content Padding', 'alloggio-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'alloggio-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding_mobile',
				'title'       => esc_html__( 'Page Content Padding Mobile', 'alloggio-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'alloggio-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_boxed',
				'title'         => esc_html__( 'Boxed Layout', 'alloggio-core' ),
				'description'   => esc_html__( 'Set boxed layout', 'alloggio-core' ),
				'default_value' => '',
				'options'       => alloggio_core_get_select_type_options_pool( 'yes_no' )
			)
		);

		$boxed_section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_boxed_section',
				'title'      => esc_html__( 'Boxed Layout Section', 'alloggio-core' ),
				'dependency' => array(
					'hide' => array(
						'qodef_boxed' => array(
							'values'        => 'no',
							'default_value' => ''
						)
					)
				)
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_boxed_background_color',
				'title'       => esc_html__( 'Boxed Background Color', 'alloggio-core' ),
				'description' => esc_html__( 'Set boxed background color', 'alloggio-core' )
			)
		);

        $boxed_section->add_field_element(
            array(
                'field_type'  => 'image',
                'name'        => 'qodef_boxed_background_pattern',
                'title'       => esc_html__( 'Boxed Background Pattern', 'alloggio-core' ),
                'description' => esc_html__( 'Set boxed background pattern', 'alloggio-core' )
            )
        );

        $boxed_section->add_field_element(
            array(
                'field_type'  => 'select',
                'name'        => 'qodef_boxed_background_pattern_behavior',
                'title'       => esc_html__( 'Boxed Background Pattern Behavior', 'alloggio-core' ),
                'description' => esc_html__( 'Set boxed background pattern behavior', 'alloggio-core' ),
                'options'     => array(
                    ''       => esc_html__( 'Default', 'alloggio-core' ),
                    'fixed'  => esc_html__( 'Fixed', 'alloggio-core' ),
                    'scroll' => esc_html__( 'Scroll', 'alloggio-core' )
                ),
            )
        );

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_passepartout',
				'title'         => esc_html__( 'Passepartout', 'alloggio-core' ),
				'description'   => esc_html__( 'Enabling this option will display a passepartout around website content', 'alloggio-core' ),
				'default_value' => '',
				'options'       => alloggio_core_get_select_type_options_pool( 'yes_no' )
			)
		);

		$passepartout_section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_passepartout_section',
				'dependency' => array(
					'hide' => array(
						'qodef_passepartout' => array(
							'values'        => 'no',
							'default_value' => ''
						)
					)
				)
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_passepartout_color',
				'title'       => esc_html__( 'Passepartout Color', 'alloggio-core' ),
				'description' => esc_html__( 'Choose background color for passepartout', 'alloggio-core' )
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_passepartout_image',
				'title'       => esc_html__( 'Passepartout Background Image', 'alloggio-core' ),
				'description' => esc_html__( 'Set background image for passepartout', 'alloggio-core' )
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_passepartout_size',
				'title'       => esc_html__( 'Passepartout Size', 'alloggio-core' ),
				'description' => esc_html__( 'Enter size amount for passepartout', 'alloggio-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'alloggio-core' )
				)
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_passepartout_size_responsive',
				'title'       => esc_html__( 'Passepartout Responsive Size', 'alloggio-core' ),
				'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (1024px and below)', 'alloggio-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'alloggio-core' )
				)
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_content_width',
				'title'       => esc_html__( 'Initial Width of Content', 'alloggio-core' ),
				'description' => esc_html__( 'Choose the initial width of content which is in grid (applies to pages set to "Default Template" and rows set to "In Grid")', 'alloggio-core' ),
				'options'     => alloggio_core_get_select_type_options_pool( 'content_width' )
			)
		);

		$general_tab->add_field_element( array(
			'field_type'    => 'yesno',
			'default_value' => 'no',
			'name'          => 'qodef_content_behind_header',
			'title'         => esc_html__( 'Always put content behind header', 'alloggio-core' ),
			'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'alloggio-core' ),
		) );

		// Hook to include additional options after module options
		do_action( 'alloggio_core_action_after_general_page_meta_box_map', $general_tab );
	}

	add_action( 'alloggio_core_action_after_general_meta_box_map', 'alloggio_core_add_general_page_meta_box', 9 );
}

if ( ! function_exists( 'alloggio_core_add_general_page_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function alloggio_core_add_general_page_meta_box_callback( $callbacks ) {
		$callbacks['page'] = 'alloggio_core_add_general_page_meta_box';
		
		return $callbacks;
	}
	
	add_filter( 'alloggio_core_filter_general_meta_box_callbacks', 'alloggio_core_add_general_page_meta_box_callback' );
}