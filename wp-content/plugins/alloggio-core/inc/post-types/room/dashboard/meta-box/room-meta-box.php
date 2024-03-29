<?php

if ( ! function_exists( 'alloggio_core_add_room_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function alloggio_core_add_room_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope'  => array( 'room' ),
				'type'   => 'meta',
				'slug'   => 'room',
				'title'  => esc_html__( 'Room', 'alloggio-core' ),
				'layout' => 'tabbed',
			)
		);
		
		if ( $page ) {
			
			/* General sections */
			
			$general_section = $page->add_tab_element(
				array(
					'name'        => 'tab-general',
					'title'       => esc_html__( 'General Settings', 'alloggio-core' ),
					'description' => esc_html__( 'General information about room', 'alloggio-core' ),
				)
			);
			
			$general_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_room_single_gallery',
					'title'       => esc_html__( 'Room Gallery Images', 'alloggio-core' ),
					'description' => esc_html__( 'Set images which will display as a gallery on room single page', 'alloggio-core' ),
					'multiple'    => 'yes',
				)
			);
			
			$general_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_room_single_gallery_nav_skin',
					'title'       => esc_html__( 'Room Gallery Navigation Skin', 'alloggio-core' ),
					'description' => esc_html__( 'Choose a predefined slider navigation style for room gallery', 'alloggio-core' ),
					'options'     => array(
						''      => esc_html__( 'Default', 'alloggio-core' ),
						'light' => esc_html__( 'Light', 'alloggio-core' ),
					)
				)
			);
			
			/* General capacity sections */
			
			$capacity_section = $general_section->add_section_element(
				array(
					'name'  => 'qodef_capacity_section',
					'title' => esc_html__( 'Capacity And Prices', 'alloggio-core' ),
				)
			);
			
			$capacity_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_room_single_room_amount',
					'title'       => esc_html__( 'Room Amount', 'alloggio-core' ),
					'description' => esc_html__( 'Enter the number of rooms available on the same period of time. Fill only the number value', 'alloggio-core' ),
				)
			);
			
			$capacity_row_size = $capacity_section->add_row_element(
				array(
					'name' => 'qodef_capacity_row_size',
				)
			);
			
			$capacity_row_size->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_room_single_room_size',
					'title'       => esc_html__( 'Room Size', 'alloggio-core' ),
					'description' => esc_html__( 'Enter the the room size. For example 48m2', 'alloggio-core' ),
					'args'        => array(
						'col_width' => 4,
					),
				)
			);
			
			$capacity_row_size->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_room_single_room_min_nights',
					'title'       => esc_html__( 'Min Nights', 'alloggio-core' ),
					'description' => esc_html__( 'Enter the minimum nights that guests need to stay for this room. Fill only the number value', 'alloggio-core' ),
					'args'        => array(
						'col_width' => 4,
					),
				)
			);
			
			$capacity_row_base = $capacity_section->add_row_element(
				array(
					'name' => 'qodef_capacity_row_base',
				)
			);
			
			$capacity_row_base->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_room_single_price',
					'title'       => esc_html__( 'Room Price', 'alloggio-core' ),
					'description' => esc_html__( 'Enter the room price per night. Additional guests will be charged by below pricing option.', 'alloggio-core' ),
					'args'        => array(
						'col_width' => 4,
						'suffix'    => alloggio_core_get_default_room_variables( 'currency' ),
					),
				)
			);
			
			$capacity_row_base->add_field_element(
				array(
					'field_type'    => 'text',
					'name'          => 'qodef_room_single_min_capacity',
					'title'         => esc_html__( 'Min People', 'alloggio-core' ),
					'description'   => esc_html__( 'Enter the minimum number of people that can stay in this room. Fill only the number value', 'alloggio-core' ),
					'default_value' => 1,
					'args'          => array(
						'col_width' => 4,
					),
				)
			);
			
			$capacity_row_base->add_field_element(
				array(
					'field_type'    => 'text',
					'name'          => 'qodef_room_single_max_capacity',
					'title'         => esc_html__( 'Max People', 'alloggio-core' ),
					'description'   => esc_html__( 'Enter the maximum number of people that can stay in this room. Fill only the number value', 'alloggio-core' ),
					'default_value' => 4,
					'args'          => array(
						'col_width' => 4,
					),
				)
			);
			
			$capacity_row_additional = $capacity_section->add_row_element(
				array(
					'name' => 'qodef_capacity_row_adult',
				)
			);
			
			$capacity_row_additional->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_room_single_adult_price',
					'title'       => esc_html__( 'Adult Price', 'alloggio-core' ),
					'description' => esc_html__( 'Enter the room price per night for adult', 'alloggio-core' ),
					'args'        => array(
						'col_width' => 4,
						'suffix'    => alloggio_core_get_default_room_variables( 'currency' ),
					),
				)
			);
			
			$capacity_row_additional->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_room_single_children_price',
					'title'       => esc_html__( 'Children Price', 'alloggio-core' ),
					'description' => esc_html__( 'Enter the room price per night for children', 'alloggio-core' ),
					'args'        => array(
						'col_width' => 4,
						'suffix'    => alloggio_core_get_default_room_variables( 'currency' ),
					),
				)
			);
			
			$seasonal_row_additional = $capacity_section->add_row_element(
				array(
					'name'  => 'qodef_seasonal_row_section',
					'title' => esc_html__( 'Seasonal Section', 'alloggio-core' ),
				)
			);
			
			$seasonal_row_additional->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_room_single_seasonal_items_title',
					'title'       => esc_html__( 'Seasonal Items Title', 'alloggio-core' ),
					'description' => esc_html__( 'Fill the seasonal items title for this item', 'alloggio-core' ),
				)
			);
			
			$seasonal_row_additional->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_room_single_seasonal_items_description',
					'title'       => esc_html__( 'Seasonal Items Description', 'alloggio-core' ),
					'description' => esc_html__( 'Fill the seasonal items description for this item', 'alloggio-core' ),
				)
			);
			
			$seasonal_settings_repeater = $seasonal_row_additional->add_repeater_element(
				array(
					'name'        => 'qodef_room_single_seasonal_items',
					'title'       => esc_html__( 'Seasonal Items', 'alloggio-core' ),
					'description' => esc_html__( 'Define a price for the special seasonal period for this item', 'alloggio-core' ),
					'button_text' => esc_html__( 'Add New Item', 'alloggio-core' ),
				)
			);
			
			$seasonal_settings_repeater->add_field_element(
				array(
					'field_type' => 'date',
					'name'       => 'qodef_room_single_seasonal_item_beginning',
					'title'      => esc_html__( 'Beginning Date', 'alloggio-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			
			$seasonal_settings_repeater->add_field_element(
				array(
					'field_type' => 'date',
					'name'       => 'qodef_room_single_seasonal_item_end',
					'title'      => esc_html__( 'End Date', 'alloggio-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			
			$seasonal_settings_repeater->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_room_single_seasonal_item_price',
					'title'       => esc_html__( 'Room Price', 'alloggio-core' ),
					'args'        => array(
						'col_width' => 4,
						'suffix'    => alloggio_core_get_default_room_variables( 'currency' ),
					),
				)
			);
			
			/* General shortcode sections */
			
			$gallery_list_section = $general_section->add_section_element(
				array(
					'name'  => 'qodef_gallery_list_section',
					'title' => esc_html__( 'Shortcode Settings', 'alloggio-core' ),
				)
			);
			
			$gallery_list_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_room_list_gallery',
					'title'       => esc_html__( 'Room Gallery List Images', 'alloggio-core' ),
					'description' => esc_html__( 'Set images which will display as a gallery on room gallery list or room list shortcode', 'alloggio-core' ),
					'multiple'    => 'yes',
				)
			);
			
			$gallery_list_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_room_list_gallery',
					'title'       => esc_html__( 'Enable Room List Gallery', 'alloggio-core' ),
					'description' => esc_html__( 'Enabling this option will display gallery images instead of featured image for this item on room list pages', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'no_yes' ),
				)
			);
			
			/* Address sections */
			
			$address_section = $page->add_tab_element(
				array(
					'name'        => 'tab-address',
					'title'       => esc_html__( 'Address Settings', 'alloggio-core' ),
					'description' => esc_html__( 'Populate address information for room', 'alloggio-core' ),
				)
			);
			
			$address_section->add_field_element(
				array(
					'field_type' => 'address',
					'name'       => 'qodef_room_single_full_address',
					'title'      => esc_html__( 'Full Address', 'alloggio-core' ),
					'args'       => array(
						'latitude_field'  => 'qodef_room_single_address_latitude',
						'longitude_field' => 'qodef_room_single_address_longitude',
					),
				)
			);
			
			$address_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_room_single_address_latitude',
					'title'      => esc_html__( 'Latitude', 'alloggio-core' ),
					'args'       => array(
						'custom_class' => 'qodef-address-elements',
					),
					'data_attrs' => array(
						'data-geo' => 'lat',
					),
				)
			);
			
			$address_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_room_single_address_longitude',
					'title'      => esc_html__( 'Longitude', 'alloggio-core' ),
					'args'       => array(
						'custom_class' => 'qodef-address-elements',
					),
					'data_attrs' => array(
						'data-geo' => 'lng',
					),
				)
			);
			
			/* Extra service sections */
			
			$extra_service_section = $page->add_tab_element(
				array(
					'name'        => 'tab-extra-service',
					'title'       => esc_html__( 'Extra Service Settings', 'alloggio-core' ),
					'description' => esc_html__( 'Define room extra services', 'alloggio-core' ),
				)
			);
			
			$extra_service_repeater = $extra_service_section->add_repeater_element(
				array(
					'name'        => 'qodef_room_single_extra_service',
					'title'       => esc_html__( 'Extra Service Items', 'alloggio-core' ),
					'button_text' => esc_html__( 'Add New Item', 'alloggio-core' ),
				)
			);
			
			$extra_service_repeater->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_room_single_extra_service_type',
					'title'         => esc_html__( 'Type', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose a extra service type', 'alloggio-core' ),
					'options'       => array(
						'optional'  => esc_html__( 'Optional', 'alloggio-core' ),
						'mandatory' => esc_html__( 'Mandatory', 'alloggio-core' ),
					),
					'default_value' => 'optional',
				)
			);
			
			$extra_service_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_room_single_extra_service_name',
					'title'      => esc_html__( 'Name', 'alloggio-core' ),
				)
			);
			
			$extra_service_repeater->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_room_single_extra_service_price_pack',
					'title'       => esc_html__( 'Service Pack', 'alloggio-core' ),
					'description' => esc_html__( 'Choose how the extra service will be calculated. Infant\'s are excluded from "Add to Price per Person" option', 'alloggio-core' ),
					'options'     => array(
						'total'              => esc_html__( 'Add to Price', 'alloggio-core' ),
						'per-night'          => esc_html__( 'Add to Price per Night', 'alloggio-core' ),
						'per-person'         => esc_html__( 'Add to Price per Person', 'alloggio-core' ),
						'per-person-per-night' => esc_html__( 'Add to Price per Person per Night', 'alloggio-core' ),
						'subtract'           => esc_html__( 'Subtract from Price', 'alloggio-core' ),
						'subtract-per-night' => esc_html__( 'Subtract from Price per Night', 'alloggio-core' ),
					),
				)
			);
			
			$extra_service_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_room_single_extra_service_price',
					'title'      => esc_html__( 'Price', 'alloggio-core' ),
					'args'       => array(
						'suffix'    => alloggio_core_get_default_room_variables( 'currency' ),
					),
				)
			);
			
			/* Additional info sections */
			
			$additional_info_section = $page->add_tab_element(
				array(
					'name'        => 'tab-additional-info',
					'title'       => esc_html__( 'Additional Info Settings', 'alloggio-core' ),
					'description' => esc_html__( 'Populate room additional information', 'alloggio-core' ),
				)
			);
			
			$additional_info_repeater = $additional_info_section->add_repeater_element(
				array(
					'name'        => 'qodef_room_single_additional_info',
					'title'       => esc_html__( 'Additional Info Items', 'alloggio-core' ),
					'button_text' => esc_html__( 'Add New Item', 'alloggio-core' ),
				)
			);
			
			$additional_info_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_room_single_additional_info_title',
					'title'      => esc_html__( 'Title', 'alloggio-core' ),
				)
			);
			
			$additional_info_repeater->add_field_element(
				array(
					'field_type' => 'textareahtml',
					'name'       => 'qodef_room_single_additional_info_content',
					'title'      => esc_html__( 'Content', 'alloggio-core' ),
				)
			);
			
			/* Reservation sections */
			
			$reservation_section = $page->add_tab_element(
				array(
					'name'        => 'tab-reservation',
					'title'       => esc_html__( 'Reservation Settings', 'alloggio-core' ),
					'description' => esc_html__( 'General settings and information about room reservations', 'alloggio-core' ),
				)
			);
			
			$reservation_section->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_room_single_custom_reserved_dates',
					'title'       => esc_html__( 'Custom Reserved Dates', 'alloggio-core' ),
					'description' => esc_html__( 'Fill custom reserved dates when the room will be not available. Date format needs to be YYYY-mm-dd. Separate dates with commas mark (example 2020-05-01, 2020-05-23 etc.). If you want to add dates range you can do that with | mark (example 2020-05-01|2020-05-23).', 'alloggio-core' ),
				)
			);
			
			$reservation_repeater = $reservation_section->add_repeater_element(
				array(
					'name'        => 'qodef_room_single_reservations',
					'title'       => esc_html__( 'Reservations', 'alloggio-core' ),
					'button_text' => esc_html__( 'Add New Reservation', 'alloggio-core' ),
					'args'        => array(
						'custom_class' => 'qodef-repeater-columns-layout'
					)
				)
			);
			
			$reservation_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_room_single_reservation_order_id',
					'title'      => esc_html__( 'Order ID', 'alloggio-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			
			$reservation_repeater->add_field_element(
				array(
					'field_type' => 'date',
					'name'       => 'qodef_room_single_reservation_check_in',
					'title'      => esc_html__( 'Check In', 'alloggio-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			
			$reservation_repeater->add_field_element(
				array(
					'field_type' => 'date',
					'name'       => 'qodef_room_single_reservation_check_out',
					'title'      => esc_html__( 'Check Out', 'alloggio-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			
			$reservation_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_room_single_reservation_room_amount',
					'title'      => esc_html__( 'Room Amount', 'alloggio-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			
			$reservation_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_room_single_reservation_guests',
					'title'      => esc_html__( 'Guests', 'alloggio-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			
			$reservation_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_room_single_reservation_extra_services',
					'title'      => esc_html__( 'Extra Services', 'alloggio-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			
			$reservation_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_room_single_reservation_price',
					'title'      => esc_html__( 'Price', 'alloggio-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			
			$reservation_repeater->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_room_single_reservation_flag',
					'title'      => esc_html__( 'Order Flag - Completed', 'alloggio-core' ),
					'options'    => alloggio_core_get_select_type_options_pool( 'no_yes', false ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			
			/* Features sections */
			
			$features_section = $page->add_tab_element(
				array(
					'name'        => 'tab-features',
					'title'       => esc_html__( 'Features Settings', 'alloggio-core' ),
					'description' => esc_html__( 'General settings for room features', 'alloggio-core' ),
				)
			);
			
			$features_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_room_single_enable_amenity',
					'title'         => esc_html__( 'Enable Amenity', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will display room amenity section', 'alloggio-core' ),
					'options'       => alloggio_core_get_select_type_options_pool( 'no_yes' ),
				)
			);
			
			$features_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_room_single_enable_availability',
					'title'         => esc_html__( 'Enable Availability', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will display room availability section', 'alloggio-core' ),
					'options'       => alloggio_core_get_select_type_options_pool( 'no_yes' ),
				)
			);
			
			$features_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_room_single_enable_related_posts',
					'title'         => esc_html__( 'Enable Related Posts', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will display related room items', 'alloggio-core' ),
					'options'       => alloggio_core_get_select_type_options_pool( 'no_yes' ),
				)
			);
			
			$features_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_room_single_enable_weather',
					'title'         => esc_html__( 'Enable Weather', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will display weather section', 'alloggio-core' ),
					'options'       => alloggio_core_get_select_type_options_pool( 'no_yes' ),
				)
			);
			
			$features_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_room_single_enable_weather_location',
					'title'       => esc_html__( 'Weather Location', 'alloggio-core' ),
					'description' => sprintf( esc_html__( 'Enter a location where you want to display weather info. Default value is room Locations taxonomy value. Find Your Location (i.e: London, UK or New York City) - %s', 'alloggio-core' ), esc_url( 'https://openweathermap.org/find' ) ),
					'dependency'  => array(
						'show' => array(
							'qodef_room_single_enable_weather' => array(
								'values'        => 'yes',
								'default_value' => '',
							)
						),
					),
				)
			);
			
			$features_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_room_single_enable_ads',
					'title'       => esc_html__( 'Enable Ads', 'alloggio-core' ),
					'description' => esc_html__( 'Enabling this option will display ads section on room single page', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'no_yes' ),
				)
			);
			
			$features_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_room_single_ads_image',
					'title'       => esc_html__( 'Ads Image', 'alloggio-core' ),
					'description' => esc_html__( 'Choose ads image that will be displayed on all room single pages', 'alloggio-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_room_single_enable_ads' => array(
								'values'        => 'yes',
								'default_value' => '',
							)
						),
					),
				)
			);
			
			$features_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_room_single_ads_link',
					'title'       => esc_html__( 'Ads Link', 'alloggio-core' ),
					'description' => esc_html__( 'Fill ads image link', 'alloggio-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_room_single_enable_ads' => array(
								'values'        => 'yes',
								'default_value' => '',
							)
						),
					),
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'alloggio_core_action_after_room_single_meta_box_map', $page );
		}
	}
	
	add_action( 'alloggio_core_action_default_meta_boxes_init', 'alloggio_core_add_room_single_meta_box' );
}

if ( ! function_exists( 'alloggio_core_include_general_meta_boxes_for_album_single' ) ) {
	/**
	 * Function that add general meta box options for this module
	 */
	function alloggio_core_include_general_meta_boxes_for_album_single() {
		$callbacks = alloggio_core_general_meta_box_callbacks();
		
		if ( ! empty( $callbacks ) ) {
			foreach ( $callbacks as $module => $callback ) {
				
				if ( $module === 'header' ) {
					add_action( 'alloggio_core_action_after_room_single_meta_box_map', $callback );
				}
			}
		}
	}
	
	add_action( 'alloggio_core_action_default_meta_boxes_init', 'alloggio_core_include_general_meta_boxes_for_album_single', 8 ); // Permission 8 is set in order to load it before default meta box function
}