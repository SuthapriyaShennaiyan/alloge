<?php

if ( ! function_exists( 'alloggio_core_add_room_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function alloggio_core_add_room_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope'       => ALLOGGIO_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'room',
				'layout'      => 'tabbed',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Room', 'alloggio-core' ),
				'description' => esc_html__( 'Global Room Options', 'alloggio-core' ),
			)
		);
		
		if ( $page ) {
			
			// Hook to include additional options before module options
			do_action( 'alloggio_core_action_before_room_options_map', $page );
			
			$archive_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-archive',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'List Settings', 'alloggio-core' ),
					'description' => esc_html__( 'Settings related to room archive pages', 'alloggio-core' ),
				)
			);
			
			$list_item_layouts = apply_filters( 'alloggio_core_filter_room_list_layouts', array() );
			$options_map       = alloggio_core_get_variations_options_map( $list_item_layouts );
			
			$archive_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_room_archive_item_layout',
					'title'         => esc_html__( 'Item Layout', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose layout for list item on archive pages', 'alloggio-core' ),
					'options'       => $list_item_layouts,
					'default_value' => $options_map['default_value'],
				)
			);
			
			$archive_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_room_archive_behavior',
					'title'       => esc_html__( 'List Appearance', 'alloggio-core' ),
					'description' => esc_html__( 'Choose an appearance style for archive lists', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'list_behavior', false, array( 'slider', 'justified-gallery' ) ),
				)
			);
			
			$archive_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_room_archive_columns',
					'title'         => esc_html__( 'Number of Columns', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose number of columns for archive lists', 'alloggio-core' ),
					'options'       => alloggio_core_get_select_type_options_pool( 'columns_number' ),
					'default_value' => '1',
				)
			);
			
			$archive_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_room_archive_space',
					'title'       => esc_html__( 'Space Between Items', 'alloggio-core' ),
					'description' => esc_html__( 'Choose space between items for archive lists', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'items_space' ),
				)
			);
			
			$archive_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_room_archive_columns_responsive',
					'title'       => esc_html__( 'Columns Responsive', 'alloggio-core' ),
					'description' => esc_html__( 'Choose whether you wish to use predefined column number responsive settings, or to set column numbers for each responsive stage individually', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'columns_responsive' ),
				)
			);
			
			$archive_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_room_archive_columns_1440',
					'title'         => esc_html__( 'Number of Columns 1367px - 1440px', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose number of columns for screens between 1367 and 1440 px for archive lists', 'alloggio-core' ),
					'default_value' => '3',
					'options'       => alloggio_core_get_select_type_options_pool( 'columns_number' ),
					'dependency'    => array(
						'show' => array(
							'qodef_room_archive_columns_responsive' => array(
								'values'        => 'custom',
								'default_value' => '',
							)
						),
					),
				)
			);
			
			$archive_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_room_archive_columns_1366',
					'title'         => esc_html__( 'Number of Columns 1025px - 1366px', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose number of columns for screens between 1025 and 1366 px for archive lists', 'alloggio-core' ),
					'default_value' => '3',
					'options'       => alloggio_core_get_select_type_options_pool( 'columns_number' ),
					'dependency'    => array(
						'show' => array(
							'qodef_room_archive_columns_responsive' => array(
								'values'        => 'custom',
								'default_value' => '',
							)
						),
					),
				)
			);
			
			$archive_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_room_archive_columns_1024',
					'title'         => esc_html__( 'Number of Columns 769px - 1024px', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose number of columns for screens between 769 and 1024 px for archive lists', 'alloggio-core' ),
					'default_value' => '3',
					'options'       => alloggio_core_get_select_type_options_pool( 'columns_number' ),
					'dependency'    => array(
						'show' => array(
							'qodef_room_archive_columns_responsive' => array(
								'values'        => 'custom',
								'default_value' => '',
							)
						),
					),
				)
			);
			
			$archive_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_room_archive_columns_768',
					'title'         => esc_html__( 'Number of Columns 681px - 768px', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose number of columns for screens between 681 and 768 px for archive lists', 'alloggio-core' ),
					'default_value' => '3',
					'options'       => alloggio_core_get_select_type_options_pool( 'columns_number' ),
					'dependency'    => array(
						'show' => array(
							'qodef_room_archive_columns_responsive' => array(
								'values'        => 'custom',
								'default_value' => '',
							)
						),
					),
				)
			);
			
			$archive_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_room_archive_columns_680',
					'title'         => esc_html__( 'Number of Columns 481px - 680px', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose number of columns for screens between 481 and 680 px for archive lists', 'alloggio-core' ),
					'default_value' => '3',
					'options'       => alloggio_core_get_select_type_options_pool( 'columns_number' ),
					'dependency'    => array(
						'show' => array(
							'qodef_room_archive_columns_responsive' => array(
								'values'        => 'custom',
								'default_value' => '',
							)
						),
					),
				)
			);
			
			$archive_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_room_archive_columns_480',
					'title'         => esc_html__( 'Number of Columns 0 - 480px', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose number of columns for screens between 0 and 480 px for archive lists', 'alloggio-core' ),
					'default_value' => '3',
					'options'       => alloggio_core_get_select_type_options_pool( 'columns_number' ),
					'dependency'    => array(
						'show' => array(
							'qodef_room_archive_columns_responsive' => array(
								'values'        => 'custom',
								'default_value' => '',
							)
						),
					),
				)
			);
			
			$archive_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_room_archive_title_tag',
					'title'       => esc_html__( 'Title Tag', 'alloggio-core' ),
					'description' => esc_html__( 'Choose title tag for room list item', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'title_tag' ),
				)
			);
			
			// Hook to include additional options after single module options
			do_action( 'alloggio_core_action_after_room_options_archive', $archive_tab );
			
			$single_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-single',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Single Settings', 'alloggio-core' ),
					'description' => esc_html__( 'Settings related to room single pages', 'alloggio-core' ),
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_room_single_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'alloggio-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar for room single', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'items_space' )
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_room_single_enable_half_day_booking',
					'title'         => esc_html__( 'Enable Half Day Booking', 'alloggio-core' ),
					'description'   => esc_html__( 'Enable this option to allow users to check in on the same day when other guests checked out that very day in the morning', 'alloggio-core' ),
					'default_value' => 'no',
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_room_single_enable_availability',
					'title'         => esc_html__( 'Enable Availability', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will display room availability section', 'alloggio-core' ),
					'default_value' => 'yes',
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_room_single_enable_amenity',
					'title'         => esc_html__( 'Enable Amenity', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will display room amenity section', 'alloggio-core' ),
					'default_value' => 'yes',
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_room_single_enable_weather',
					'title'         => esc_html__( 'Enable Weather', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will display weather section on room single page', 'alloggio-core' ),
					'default_value' => 'yes',
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_room_single_weather_api_key',
					'title'       => esc_html__( 'Weather API Key', 'alloggio-core' ),
					'description' => sprintf( esc_html__( 'Enter a weather location api key. How to get API key - %s', 'alloggio-core' ), esc_url( 'https://openweathermap.org/appid#get' ) ),
					'dependency'  => array(
						'show' => array(
							'qodef_room_single_enable_weather' => array(
								'values'        => 'yes',
								'default_value' => 'yes',
							)
						),
					),
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_room_single_enable_ads',
					'title'         => esc_html__( 'Enable Ads', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will display ads section on room single page', 'alloggio-core' ),
					'default_value' => 'no',
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_room_single_ads_image',
					'title'       => esc_html__( 'Ads Image', 'alloggio-core' ),
					'description' => esc_html__( 'Choose ads image that will be displayed on all room single pages', 'alloggio-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_room_single_enable_ads' => array(
								'values'        => 'yes',
								'default_value' => 'no',
							)
						),
					),
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_room_single_ads_link',
					'title'       => esc_html__( 'Ads Link', 'alloggio-core' ),
					'description' => esc_html__( 'Fill ads image link', 'alloggio-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_room_single_enable_ads' => array(
								'values'        => 'yes',
								'default_value' => 'no',
							)
						),
					),
				)
			);
			
			// Hook to include additional options after single module options
			do_action( 'alloggio_core_action_after_room_options_single', $single_tab );
			
			// Hook to include additional options after module options
			do_action( 'alloggio_core_action_after_room_options_map', $page );
		}
	}
	
	add_action( 'alloggio_core_action_default_options_init', 'alloggio_core_add_room_options', alloggio_core_get_admin_options_map_position( 'room' ) );
}
