<?php

if ( ! function_exists( 'alloggio_core_extend_room_google_maps_extensions' ) ) {
	/**
	 * Set additional extension for custom post type meta options
	 */
	function alloggio_core_extend_room_google_maps_extensions( $ext ) {
		$ext[] = 'places';
		
		return $ext;
	}
	
	add_filter( 'alloggio_core_filter_google_maps_extensions', 'alloggio_core_extend_room_google_maps_extensions' );
}

if ( ! function_exists( 'alloggio_core_set_room_scripts_global_variables' ) ) {
	/**
	 * Set additional global variables into global script object
	 */
	function alloggio_core_set_room_scripts_global_variables( $global_vars ) {
		$global_vars['roomCalendarDateFormat'] = alloggio_core_get_default_room_variables( 'date-format-js' );
		$global_vars['roomCalendarPrevText']   = '<svg class="qodef-e-calendar-icon qodef--prev" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 6.9 12.5" xml:space="preserve"><polyline points="6.3,0.6 0.6,6.3 6.3,11.9 "/></svg>';
		$global_vars['roomCalendarNextText']   = '<svg class="qodef-e-calendar-icon qodef--next" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 6.9 12.5" xml:space="preserve"><polyline points="0.6,0.6 6.3,6.3 0.6,11.9 "/></svg>';
		
		return $global_vars;
	}
	
	add_action( 'alloggio_filter_localize_main_js', 'alloggio_core_set_room_scripts_global_variables' );
}

if ( ! function_exists( 'alloggio_core_is_room_single' ) ) {
	/**
	 * Check is custom post type single page
	 */
	function alloggio_core_is_room_single() {
		return is_singular( 'room' );
	}
}

if ( ! function_exists( 'alloggio_core_include_room_single_scripts' ) ) {
	/**
	 * Enqueue 3rd party scripts for current module single page
	 */
	function alloggio_core_include_room_single_scripts() {
		
		if ( alloggio_core_is_room_single() ) {
			// Include global calendar scripts
			wp_enqueue_style( 'datepick', ALLOGGIO_CORE_ASSETS_URL_PATH . '/plugins/datepick/jquery.datepick.css' );
			
			wp_enqueue_script( 'jquery-plugin', ALLOGGIO_CORE_ASSETS_URL_PATH . '/plugins/datepick/jquery.plugin.min.js', array( 'jquery' ), true );
			wp_enqueue_script( 'datepick', ALLOGGIO_CORE_ASSETS_URL_PATH . '/plugins/datepick/jquery.datepick.min.js', array( 'jquery-plugin' ), true );
		}
	}
	
	add_action( 'alloggio_core_action_before_main_js', 'alloggio_core_include_room_single_scripts' );
}

if ( ! function_exists( 'alloggio_core_room_set_admin_options_map_position' ) ) {
	/**
	 * Set dashboard admin options map position for this module
	 *
	 * @param int $position
	 * @param string $map
	 *
	 * @return int
	 */
	function alloggio_core_room_set_admin_options_map_position( $position, $map ) {
		
		if ( $map === 'room' ) {
			$position = 58;
		}
		
		return $position;
	}
	
	add_filter( 'alloggio_core_filter_admin_options_map_position', 'alloggio_core_room_set_admin_options_map_position', 10, 2 );
}

if ( ! function_exists( 'alloggio_core_get_original_room_page_id' ) ) {
	/**
	 * Get original room page ID if WPML plugin is installed
	 *
	 * @param int $page_id
	 *
	 * @return int
	 */
	function alloggio_core_get_original_room_page_id( $page_id ) {

		if ( qode_framework_is_installed( 'wpml' ) ) {
			global $sitepress;

			if ( ! empty( $sitepress ) && ! empty( $sitepress->get_default_language() ) ) {
				$page_id = apply_filters( 'wpml_object_id', $page_id, 'room', true, $sitepress->get_default_language() );
			}
		}

		return $page_id;
	}
}

if ( ! function_exists( 'alloggio_core_generate_room_archive_with_shortcode' ) ) {
	/**
	 * Executes room list shortcode with params on archive pages
	 *
	 * @param string $tax - type of taxonomy
	 * @param string $tax_slug - slug of taxonomy
	 * @param array $search_params
	 */
	function alloggio_core_generate_room_archive_with_shortcode( $tax, $tax_slug, $search_params = array() ) {
		$params = array(
			'additional_params' => 'tax',
			'tax'               => $tax,
			'tax_slug'          => $tax_slug,
		);
		
		$params['posts_per_page']     = get_option( 'posts_per_page' );
		$params['layout']             = alloggio_core_get_post_value_through_levels( 'qodef_room_archive_item_layout' );
		$params['behavior']           = alloggio_core_get_post_value_through_levels( 'qodef_room_archive_behavior' );
		$params['columns']            = alloggio_core_get_post_value_through_levels( 'qodef_room_archive_columns' );
		$params['space']              = alloggio_core_get_post_value_through_levels( 'qodef_room_archive_space' );
		$params['columns_responsive'] = alloggio_core_get_post_value_through_levels( 'qodef_room_archive_columns_responsive' );
		$params['columns_1440']       = alloggio_core_get_post_value_through_levels( 'qodef_room_archive_columns_1440' );
		$params['columns_1366']       = alloggio_core_get_post_value_through_levels( 'qodef_room_archive_columns_1366' );
		$params['columns_1024']       = alloggio_core_get_post_value_through_levels( 'qodef_room_archive_columns_1024' );
		$params['columns_768']        = alloggio_core_get_post_value_through_levels( 'qodef_room_archive_columns_768' );
		$params['columns_680']        = alloggio_core_get_post_value_through_levels( 'qodef_room_archive_columns_680' );
		$params['columns_480']        = alloggio_core_get_post_value_through_levels( 'qodef_room_archive_columns_480' );
		$params['title_tag']          = alloggio_core_get_post_value_through_levels( 'qodef_room_archive_title_tag' );
		$params['excerpt_length']     = '180';
		$params['pagination_type']    = 'load-more';
		
		if ( ! empty( $search_params ) && is_array( $search_params ) ) {
			foreach ( $search_params as $key => $value ) {
				$params[ $key ] = $value;
			}
		}
		
		echo AlloggioCoreRoomListShortcode::call_shortcode( $params );
	}
}

if ( ! function_exists( 'alloggio_core_generate_room_single_layout' ) ) {
	/**
	 * Set template layout for single page
	 */
	function alloggio_core_generate_room_single_layout() {
		$template = alloggio_core_get_post_value_through_levels( 'qodef_room_single_layout' );
		
		return ! empty( $template ) ? $template : 'standard';
	}
	
	add_filter( 'alloggio_core_filter_room_single_layout', 'alloggio_core_generate_room_single_layout' );
}

if ( ! function_exists( 'alloggio_core_get_room_holder_classes' ) ) {
	/**
	 * Return classes for the main room holder
	 *
	 * @return string
	 */
	function alloggio_core_get_room_holder_classes() {
		$classes = array( 'qodef-room-single' );
		
		$item_layout = alloggio_core_generate_room_single_layout();
		if ( ! empty( $item_layout ) ) {
			$classes[] = 'qodef-item-layout--' . $item_layout;
		}
		
		return implode( ' ', $classes );
	}
}

if ( ! function_exists( 'alloggio_core_set_room_single_holder_width' ) ) {
	/**
	 * Function that return classes for the page inner div from header.php
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function alloggio_core_set_room_single_holder_width( $classes ) {
		
		if ( alloggio_core_is_room_single() ) {
			$classes = 'qodef-content-full-width';
		}
		
		return $classes;
	}
	
	add_filter( 'alloggio_filter_page_inner_classes', 'alloggio_core_set_room_single_holder_width' );
}

if ( ! function_exists( 'alloggio_core_set_room_single_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function alloggio_core_set_room_single_sidebar_grid_gutter_classes( $classes ) {
		
		if ( alloggio_core_is_room_single() ) {
			$option = alloggio_core_get_post_value_through_levels( 'qodef_room_single_sidebar_grid_gutter' );
			
			if ( ! empty( $option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $option );
			}
			
			$meta_option = get_post_meta( get_the_ID(), 'qodef_page_sidebar_grid_gutter', true );
			
			if ( ! empty( $meta_option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $meta_option );
			}
		}
		
		return $classes;
	}
	
	add_filter( 'alloggio_filter_grid_gutter_classes', 'alloggio_core_set_room_single_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'alloggio_core_disable_page_title_for_room_single' ) ) {
	/**
	 * Disable page title area for this module
	 *
	 * @param bool $enable_page_title
	 *
	 * @return bool
	 */
	function alloggio_core_disable_page_title_for_room_single( $enable_page_title ) {
		
		if ( alloggio_core_is_room_single() ) {
			$enable_page_title = false;
		}
		
		return $enable_page_title;
	}
	
	add_filter( 'alloggio_filter_enable_page_title', 'alloggio_core_disable_page_title_for_room_single' );
}

if ( ! function_exists( 'alloggio_core_set_room_archives_page_title_text' ) ) {
	/**
	 * Function that override current page title text for custom post type archive pages
	 *
	 * @param string $title
	 *
	 * @return string
	 */
	function alloggio_core_set_room_archives_page_title_text( $title ) {
		
		if ( is_tax( 'room-type' ) ) {
			$title = sprintf( esc_html__( 'Room Type: %s', 'alloggio-core' ), single_cat_title( '', false ) );
		} elseif ( is_tax( 'amenity' ) ) {
			$title = sprintf( esc_html__( 'Amenity: %s', 'alloggio-core' ), single_cat_title( '', false ) );
		} elseif ( is_post_type_archive( 'room' ) ) {
			$title = esc_html__( 'Rooms', 'alloggio-core' );
		}
		
		return $title;
	}
	
	add_filter( 'alloggio_filter_page_title_text', 'alloggio_core_set_room_archives_page_title_text' );
}

if ( ! function_exists( 'alloggio_core_room_breadcrumbs_title' ) ) {
	/**
	 * Improve main breadcrumbs template with additional cases
	 *
	 * @param string|html $wrap_child
	 * @param array $settings
	 *
	 * @return string|html
	 */
	function alloggio_core_room_breadcrumbs_title( $wrap_child, $settings ) {
		if ( is_tax( 'room-type' ) ) {
			$wrap_child = '';
			$term_object = get_term( get_queried_object_id(), 'room-type' );
			
			if ( isset( $term_object->parent ) && $term_object->parent !== 0 ) {
				$parent     = get_term( $term_object->parent );
				$wrap_child .= sprintf( $settings['link'], get_term_link( $parent->term_id ), $parent->name ) . $settings['separator'];
			}
			
			$wrap_child .= sprintf( $settings['current_item'], single_cat_title( '', false ) );
		} elseif ( is_tax( 'amenity' ) ) {
			$wrap_child = '';
			$term_object = get_term( get_queried_object_id(), 'amenity' );
			
			if ( isset( $term_object->parent ) && $term_object->parent !== 0 ) {
				$parent     = get_term( $term_object->parent );
				$wrap_child .= sprintf( $settings['link'], get_term_link( $parent->term_id ), $parent->name ) . $settings['separator'];
			}
			
			$wrap_child .= sprintf( $settings['current_item'], single_cat_title( '', false ) );
		} elseif ( is_singular( 'room' ) ) {
			$wrap_child = '';
			$post_terms = wp_get_post_terms( get_the_ID(), 'room-type' );
			
			if ( ! empty ( $post_terms ) ) {
				$post_term = $post_terms[0];
				if ( isset( $post_term->parent ) && $post_term->parent !== 0 ) {
					$parent     = get_term( $post_term->parent );
					$wrap_child .= sprintf( $settings['link'], get_term_link( $parent->term_id ), $parent->name ) . $settings['separator'];
				}
				$wrap_child .= sprintf( $settings['link'], get_term_link( $post_term ), $post_term  ->name ) . $settings['separator'];
			}
			
			$wrap_child .= sprintf( $settings['current_item'], get_the_title() );
		}
		
		return $wrap_child;
	}
	
	add_filter( 'alloggio_core_filter_breadcrumbs_content', 'alloggio_core_room_breadcrumbs_title', 10, 2 );
}

if ( ! function_exists( 'alloggio_core_get_default_room_variables' ) ) {
	/**
	 * Get default room variables
	 *
	 * @param string $type
	 *
	 * @return string
	 */
	function alloggio_core_get_default_room_variables( $type ) {
		$variable = '';
		
		switch ( $type ) {
			case 'currency':
				$variable = qode_framework_is_installed( 'woocommerce' ) ? get_woocommerce_currency_symbol( get_woocommerce_currency() ) : '$';
				break;
			case 'date-format':
				$variable = 'D, d M Y';  // Same date format needs to be set for date-format-js
				break;
			case 'date-format-js':
				$variable = 'D, dd M yyyy';  // dd and yyyy was intentionally placed because the script required such a format for dates and years
				break;
			case 'meta-date-format':
				$variable = 'Y-m-d'; // This date format is required because datepicker meta box filed is saved with it
				break;
			case 'datepick-date-format':
				$variable = 'M j, Y'; // This date format is required because datepick js script use it inside datepicker modal
				break;
		}
		
		return apply_filters( 'alloggio_core_filter_default_room_variables', $variable, $type );
	}
}

if ( ! function_exists( 'alloggio_core_print_room_button_element' ) ) {
	/**
	 * Print default room button element
	 *
	 * @param array $button_params
	 */
	function alloggio_core_print_room_button_element( $button_params = array() ) {
		$custom_class = isset( $button_params['custom_class'] ) && ! empty( $button_params['custom_class'] ) ? esc_attr( $button_params['custom_class'] ) : '';
		$button_label = isset( $button_params['text'] ) && ! empty( $button_params['text'] ) ? esc_html( $button_params['text'] ) : esc_html__( 'Check Availability', 'alloggio-core' );
		
		if ( class_exists( 'AlloggioCoreButtonShortcode' ) ) {
			$params = array(
				'custom_class'  => $custom_class,
				'html_type'     => 'submit',
				'button_layout' => 'outlined',
				'text'          => $button_label,
				'size'          => 'full',
			);
			
			if ( isset( $button_params['html_type'] ) && ! empty( $button_params['html_type'] ) ) {
				$params['html_type'] = esc_attr( $button_params['html_type'] );
			}
			
			if ( isset( $button_params['button_layout'] ) && ! empty( $button_params['button_layout'] ) ) {
				$params['button_layout'] = esc_attr( $button_params['button_layout'] );
			}
			
			if ( isset( $button_params['size'] ) && ! empty( $button_params['size'] ) ) {
				$params['size'] = esc_attr( $button_params['size'] );
			}
			
			if ( isset( $button_params['link'] ) && ! empty( $button_params['link'] ) ) {
				$params['link'] = esc_url( $button_params['link'] );
			}
			
			echo AlloggioCoreButtonShortcode::call_shortcode( $params );?>
		<?php } else { ?>
			<button type="submit" class="<?php echo esc_attr( $custom_class ); ?>"><?php echo esc_attr( $button_label ); ?></button>
		<?php }
	}
}

if ( ! function_exists( 'alloggio_core_get_room_amenity_svg_icons' ) ) {
	/**
	 * Returns svg icons for room amenities
	 *
	 * @param bool $enable_default - add first element empty for default value
	 *
	 * @return array
	 */
	function alloggio_core_get_room_amenity_svg_icons( $enable_default = true ) {
		$options = array(
			'air-condition' => esc_html__( 'Air Condition', 'alloggio-core' ),
			'airport'       => esc_html__( 'Airport', 'alloggio-core' ),
			'bar'           => esc_html__( 'Bar', 'alloggio-core' ),
			'bath'          => esc_html__( 'Bath', 'alloggio-core' ),
			'breakfast'     => esc_html__( 'Breakfast', 'alloggio-core' ),
			'cleaning'      => esc_html__( 'Cleaning', 'alloggio-core' ),
			'crib'          => esc_html__( 'Crib', 'alloggio-core' ),
			'elevator'      => esc_html__( 'Elevator', 'alloggio-core' ),
			'gym'           => esc_html__( 'Gym', 'alloggio-core' ),
			'hair-dryer'    => esc_html__( 'Hair Dryer', 'alloggio-core' ),
			'iron'          => esc_html__( 'Iron', 'alloggio-core' ),
			'king-bed'      => esc_html__( 'King Bed', 'alloggio-core' ),
			'luggage'       => esc_html__( 'Luggage', 'alloggio-core' ),
			'map'           => esc_html__( 'Map', 'alloggio-core' ),
			'minibar'       => esc_html__( 'Minibar', 'alloggio-core' ),
			'no-smoking'    => esc_html__( 'No Smoking', 'alloggio-core' ),
			'parking'       => esc_html__( 'Parking', 'alloggio-core' ),
			'pet'           => esc_html__( 'Pet', 'alloggio-core' ),
			'pool'          => esc_html__( 'Pool', 'alloggio-core' ),
			'ramp'          => esc_html__( 'Ramp', 'alloggio-core' ),
			'rent-a-car'    => esc_html__( 'Rent a Car', 'alloggio-core' ),
			'restaurant'    => esc_html__( 'Restaurant', 'alloggio-core' ),
			'room-service'  => esc_html__( 'Room Service', 'alloggio-core' ),
			'safe'          => esc_html__( 'Safe', 'alloggio-core' ),
			'single-bed'    => esc_html__( 'Single Bed', 'alloggio-core' ),
			'shop'          => esc_html__( 'Shop', 'alloggio-core' ),
			'shower'        => esc_html__( 'Shower', 'alloggio-core' ),
			'tea-cup'       => esc_html__( 'Tea Cup', 'alloggio-core' ),
			'towel'         => esc_html__( 'Towel', 'alloggio-core' ),
			'tv'            => esc_html__( 'TV', 'alloggio-core' ),
			'washing'       => esc_html__( 'Washing', 'alloggio-core' ),
			'wifi'          => esc_html__( 'WiFi', 'alloggio-core' ),
		);
		
		if ( $enable_default ) {
			array_unshift( $options, esc_html__( 'Default', 'alloggio-core' ) );
		}
		
		return apply_filters( 'alloggio_core_filter_room_amenity_svg_icons', $options );
	}
}

if ( ! function_exists( 'alloggio_core_add_rest_api_room_global_variables' ) ) {
	/**
	 * Extend main rest api variables with new case
	 *
	 * @param array $global - list of variables
	 * @param string $namespace - rest namespace url
	 *
	 * @return array
	 */
	function alloggio_core_add_rest_api_room_global_variables( $global, $namespace ) {
		$global['getRoomReservationRestRoute'] = $namespace . '/room-reservation';
		
		return $global;
	}
	
	add_filter( 'alloggio_filter_rest_api_global_variables', 'alloggio_core_add_rest_api_room_global_variables', 10, 2 );
}

if ( ! function_exists( 'alloggio_core_add_rest_api_room_route' ) ) {
	/**
	 * Extend main rest api routes with new case
	 *
	 * @param array $routes - list of rest routes
	 *
	 * @return array
	 */
	function alloggio_core_add_rest_api_room_route( $routes ) {
		$routes['room-reservation'] = array(
			'route'    => 'room-reservation',
			'methods'  => WP_REST_Server::READABLE,
			'callback' => 'alloggio_core_add_new_room_reservation',
			'args'     => array(
				'options' => array(
					'required'          => true,
					'validate_callback' => function ( $param, $request, $key ) {
						return is_array( $param ) ? $param : (array) $param;
					},
					'description'       => esc_html__( 'Options is required parameter', 'alloggio-core' ),
				),
			)
		);
		
		return $routes;
	}
	
	add_filter( 'alloggio_filter_rest_api_routes', 'alloggio_core_add_rest_api_room_route' );
}

if ( ! function_exists( 'alloggio_core_calculate_room_price' ) ) {
	/**
	 * Get room real price
	 *
	 * @param int $room_id
	 * @param array $query_options
	 *
	 * @return int
	 */
	function alloggio_core_calculate_room_price( $room_id, $query_options = array() ) {
		$full_price    = 0;
		$initial_price = 0;
		
		if ( ! empty( $room_id ) ) {
			$price_meta = get_post_meta( $room_id, 'qodef_room_single_price', true );
			
			if ( $price_meta !== '' ) {
				$full_price += floatval( $price_meta );
				$initial_price = floatval( $price_meta );
			}
			
			if ( ! empty( $query_options ) ) {
				$min_capacity_meta   = get_post_meta( $room_id, 'qodef_room_single_min_capacity', true );
				$min_capacity        = ! empty( $min_capacity_meta ) ? intval( $min_capacity_meta ) : 1;
				$adult_price_meta    = get_post_meta( $room_id, 'qodef_room_single_adult_price', true );
				$adult_price         = ! empty( $adult_price_meta ) ? floatval( $adult_price_meta ) : 0;
				$children_price_meta = get_post_meta( $room_id, 'qodef_room_single_children_price', true );
				$children_price      = ! empty( $children_price_meta ) ? floatval( $children_price_meta ) : 0;
				$days_number         = round( abs( strtotime( $query_options['check_out'] ) - strtotime( $query_options['check_in'] ) ) / ( 60 * 60 * 24 ) );
				
				// Price - capacity calculation
				if ( $query_options['adult'] + $query_options['children'] > $min_capacity ) {
					
					if ( $query_options['adult'] > $min_capacity ) {
						$full_price += $adult_price * ( $query_options['adult'] - $min_capacity );
					}
					
					if ( $query_options['children'] > 0 ) {
						
						if ( $query_options['adult'] < $min_capacity ) {
							$full_price += $children_price * ( $query_options['children'] - $min_capacity + $query_options['adult'] );
						} else {
							$full_price += $children_price * $query_options['children'];
						}
					}
				}
				
				// Price - date calculation
				$full_price *= $days_number;
				
				// Price - seasonal calculation
				$seasonal_data  = array();
				$seasonal_items = get_post_meta( $room_id, 'qodef_room_single_seasonal_items', true );
				
				if ( ! empty( $seasonal_items ) ) {
					$reserved_dates_range = qode_framework_get_dates_from_date_range( $query_options['check_in'], $query_options['check_out'] );
					
					// Remove check-out date from the list, because guests leaving the room
					array_pop( $reserved_dates_range );
					
					foreach ( $seasonal_items as $key => $value ) {
						$seasonal_days_number = 0;
						$seasonal_dates_range = qode_framework_get_dates_from_date_range( $value['qodef_room_single_seasonal_item_beginning'], $value['qodef_room_single_seasonal_item_end'] );
						
						foreach ( $reserved_dates_range as $reserved_date ) {
							
							if ( in_array( $reserved_date, $seasonal_dates_range ) ) {
								$seasonal_days_number++;
								
								$seasonal_data[ $key ] = array(
									'price' => floatval( $value['qodef_room_single_seasonal_item_price'] ),
									'days'  => $seasonal_days_number,
								);
							}
						}
					}
				}
				
				if ( ! empty( $seasonal_data ) ) {
					foreach ( $seasonal_data as $seasonal_value ) {
						// Check if seasonal price larger than the initial price
						if ( $seasonal_value['price'] >= $initial_price ) {
							$full_price += abs( $initial_price - $seasonal_value['price'] ) * $seasonal_value['days'];
						} else {
							$full_price -= abs( $initial_price - $seasonal_value['price'] ) * $seasonal_value['days'];
						}
					}
				}
				
				// Price - extra services calculation
				if ( ! empty( $query_options['extra_services'] ) ) {
					$extra_services = get_post_meta( $room_id, 'qodef_room_single_extra_service', true );
					$extra_price    = 0;
					
					foreach ( $extra_services as $extra_service ) {
						$es_name = $extra_service['qodef_room_single_extra_service_name'];
						$value   = ! empty( $es_name ) ? str_replace( ' ', '-', mb_strtolower( $es_name ) ) : '';
						
						if ( ! empty( $value ) && in_array( $value, $query_options['extra_services'] ) ) {
							$es_price_meta   = $extra_service['qodef_room_single_extra_service_price'];
							$es_price        = ! empty( $es_price_meta ) ? floatval( $es_price_meta ) : 0;
							
							switch ( $extra_service['qodef_room_single_extra_service_price_pack'] ) {
								case 'per-night':
									$extra_price += $days_number * $es_price;
									break;
								case 'per-person':
									$extra_price += ( $query_options['adult'] + $query_options['children'] ) * $es_price;
									break;
								case 'per-person-per-night':
									$extra_price += ( $query_options['adult'] + $query_options['children'] ) * $days_number * $es_price;
									break;
								case 'subtract':
									$extra_price -= $es_price;
									break;
								case 'subtract-per-night':
									$extra_price -= $days_number * $es_price;
									break;
								default:
									$extra_price += $es_price;
									break;
							}
						}
					}
					
					$full_price += $extra_price;
				}
			}
		}
		
		return round($full_price, 6);
	}
}

if ( ! function_exists( 'alloggio_core_add_new_room_reservation' ) ) {
	/**
	 * Function that add a new reservation for room
	 *
	 * @return void
	 */
	function alloggio_core_add_new_room_reservation() {
		
		if ( ! isset( $_GET['options'] ) || empty( $_GET['options'] ) ) {
			qode_framework_get_ajax_status( 'error', esc_html__( 'Get method is invalid', 'alloggio-core' ) );
		} else {
			$options = array_filter( array_map( 'esc_attr', $_GET['options'] ) );
			
			if ( ! empty( $options ) ) {
				// Set variables
				$room_id        = isset( $options['room_id'] ) ? intval( $options['room_id'] ) : 0;
				$check_in       = isset( $options['check_in'] ) ? esc_attr( $options['check_in'] ) : '';
				$check_out      = isset( $options['check_out'] ) ? esc_attr( $options['check_out'] ) : '';
				$room_amount    = isset( $options['room_amount'] ) ? intval( $options['room_amount'] ) : 1;
				$min_capacity   = isset( $options['min_capacity'] ) ? intval( $options['min_capacity'] ) : 1;
				$max_capacity   = isset( $options['max_capacity'] ) ? intval( $options['max_capacity'] ) : 1;
				$adult          = isset( $options['adult'] ) ? intval( $options['adult'] ) : $min_capacity;
				$children       = isset( $options['children'] ) ? intval( $options['children'] ) : 0;
				$infant         = isset( $options['infant'] ) ? intval( $options['infant'] ) : 0;
				$extra_services = isset( $options['extra_services'] ) && ! empty( $options['extra_services'] ) ? explode( ',', $options['extra_services'] ) : array();
				$price          = isset( $options['price'] ) ? floatval( $options['price'] ) : 0;
				
				$price_query = array(
					'check_in'       => $check_in,
					'check_out'      => $check_out,
					'room_amount'    => $room_amount,
					'adult'          => $adult,
					'children'       => $children,
					'extra_services' => $extra_services,
				);
				
				// Get global variables
				$real_price      = alloggio_core_calculate_room_price( $room_id, $price_query );
				$min_nights_meta = get_post_meta( $room_id, 'qodef_room_single_room_min_nights', true );
				$min_nights      = ! empty( $min_nights_meta ) ? intval( $min_nights_meta ) : 1;

				// Variables validation
				if ( empty( $room_id ) ) {
					qode_framework_get_ajax_status( 'error', esc_html__( 'Room ID is invalid.', 'alloggio-core' ) );
				}
				
				// Capacity validation
				if ( empty( $room_amount ) ) {
					qode_framework_get_ajax_status( 'error', esc_html__( 'Room amount must be at least one.', 'alloggio-core' ) );
				}
				
				if ( $adult < 1 ) {
					qode_framework_get_ajax_status( 'error', esc_html__( 'Room capacity is incorrect. Adults number must be at least one.', 'alloggio-core' ) );
				}
				
				if ( $adult + $children < $min_capacity ) {
					qode_framework_get_ajax_status( 'error', sprintf( esc_html__( 'Room capacity is incorrect. Minimum room capacity is %s.', 'alloggio-core' ), $min_capacity ) );
				}
				
				if ( $adult + $children + $infant > $max_capacity ) {
					qode_framework_get_ajax_status( 'error', sprintf( esc_html__( 'Room capacity is incorrect. Maximum room capacity is %s.', 'alloggio-core' ), $max_capacity ) );
				}
			
				// Price validation
				if ( empty( $price ) || $price !== $real_price ) {
					qode_framework_get_ajax_status( 'error', esc_html__( 'Price is incorrect. Please try again to reserve a room.', 'alloggio-core' ) );
				}
				
				// Check date validations
				if ( empty( $check_in ) || empty( $check_out) ) {
					qode_framework_get_ajax_status( 'error', esc_html__( 'Dates are required fields. Please fill it.', 'alloggio-core' ) );
				}
				
				if ( strtotime( date( alloggio_core_get_default_room_variables( 'date-format' ) ) ) > strtotime( $check_in ) ) {
					qode_framework_get_ajax_status( 'error', esc_html__( 'Check-in date needs to be same or larger than current date. Please select another date.', 'alloggio-core' ) );
				}
				
				$dates_range = qode_framework_get_dates_from_date_range( $check_in, $check_out, alloggio_core_get_default_room_variables( 'datepick-date-format' ) );
				
				// Remove check-out date from the list, because guests leaving the room
				array_pop( $dates_range );
				
				$reserved_dates    = alloggio_core_get_room_reserved_dates( $room_id, false, $room_amount );
				$check_reservation = array_intersect( $dates_range, $reserved_dates );
		
				if ( ! empty( $check_reservation ) ) {
					qode_framework_get_ajax_status( 'error', sprintf( esc_html__( 'Dates you selected are not available%s. Please select another date.', 'alloggio-core' ),
						$room_amount > 1 ? esc_html__( ' or there are not enough rooms available', 'alloggio-core' ) : ''
					) );
				}
				
				if ( $min_nights > count( $dates_range ) ) {
					qode_framework_get_ajax_status( 'error', sprintf( esc_html__( 'Minimum nights to stay is %s.', 'alloggio-core' ), $min_nights ) );
				}
				
				// Set guests labels
				$guests_label = array(
					'adult' => sprintf( esc_html__( '%s Adult', 'alloggio-core' ), $adult ),
				);
				
				if ( $children > 0 ) {
					$guests_label['children'] = sprintf( esc_html__( '%s Children', 'alloggio-core' ), $children );
				}
				
				if ( $infant > 0 ) {
					$guests_label['infant'] = sprintf( esc_html__( '%s Infant', 'alloggio-core' ), $infant );
				}
				
				// Clear room reservation data if exists
				delete_transient( "alloggio_core_room_product_reservation_data_{$room_id}" );
				
				// Set a new room reservation data
				set_transient( "alloggio_core_room_product_reservation_data_{$room_id}", array_merge(
					$price_query,
					array(
						'price'  => $real_price,
						'guests' => implode( ', ', $guests_label ),
					)
				), 10800 ); // Save room reservation 3h before clear it

				qode_framework_get_ajax_status( 'success', esc_html__( 'You successfully added a room reservation into cart.', 'alloggio-core' ), array( 'price' => $price ) );
			} else {
				qode_framework_get_ajax_status( 'error', esc_html__( 'You are not authorized.', 'alloggio-core' ) );
			}
		}
	}
}

if ( ! function_exists( 'alloggio_core_get_room_reserved_dates' ) ) {
	/**
	 * Get reserved dates for the room
	 *
	 * @param int  $page_id
	 * @param bool $return_with_last_room_dates
	 * @param int  $requested_room_amount
	 * @param string $date_type - it can be check-in or check-out
	 *
	 * @return array
	 */
	function alloggio_core_get_room_reserved_dates( $page_id, $return_with_last_room_dates = false, $requested_room_amount = 0, $date_type = 'check-out' ) {
		// Meta variables
		$page_id             = alloggio_core_get_original_room_page_id( $page_id );
		$room_amount_meta    = get_post_meta( $page_id, 'qodef_room_single_room_amount', true );
		$reservations        = get_post_meta( $page_id, 'qodef_room_single_reservations', true );
		$custom_reservations = get_post_meta( $page_id, 'qodef_room_single_custom_reserved_dates', true );
		$half_day_booking    = alloggio_core_get_option_value( 'admin', 'qodef_room_single_enable_half_day_booking' );
		
		// Global variables
		$room_amount      = empty( $room_amount_meta ) ? 1 : intval( $room_amount_meta );
		$reserved_dates   = array();
		$last_room_dates  = array();
		
		// Create date matrix
		$date_matrix = array();
		if ( ! empty( $reservations ) ) {
			$current_date = date( alloggio_core_get_default_room_variables( 'meta-date-format' ) );
			
			foreach ( $reservations as $key => $reservation ) {
				
				if ( $reservation['qodef_room_single_reservation_flag'] === 'yes' && strtotime( $reservation['qodef_room_single_reservation_check_out'] ) >= strtotime( $current_date ) ) {
					$dates_range = qode_framework_get_dates_from_date_range( $reservation['qodef_room_single_reservation_check_in'], $reservation['qodef_room_single_reservation_check_out'] );
					
					// Remove check-out date from the list, because guests leaving the room
					array_pop( $dates_range );

					// Remove check-in date from the list, because other guests can check out in the morning
					if ( 'yes' === $half_day_booking && 'check-out' === $date_type ) {
						array_shift( $dates_range );
					}
					
					foreach ( $dates_range as $value ) {
						$date = explode( '-', $value );
						
						// Create three-dimensional matrix (years-months-days)
						$matrix_value = intval( $reservation['qodef_room_single_reservation_room_amount'] );
						
						if ( isset( $date_matrix[ $date[0] ][ $date[1] ][ $date[2] ] ) ) {
							$matrix_value += intval( $date_matrix[ $date[0] ][ $date[1] ][ $date[2] ] );
						}
						
						// Make sure the room is last available
						if ( $matrix_value == $room_amount - 1 ) {
							$last_room_dates[] = date( alloggio_core_get_default_room_variables( 'datepick-date-format' ), strtotime( $value ) );
						}
					
						// If room is fully add it into reserved dates list or if there are not enough rooms on selected days
						if ( $requested_room_amount > 1 && $matrix_value > $room_amount - $requested_room_amount ) {
							$reserved_dates[] = date( alloggio_core_get_default_room_variables( 'datepick-date-format' ), strtotime( $value ) );
						} elseif ( $matrix_value >= $room_amount ) {
							$reserved_dates[] = date( alloggio_core_get_default_room_variables( 'datepick-date-format' ), strtotime( $value ) );
						}
						
						$date_matrix[ $date[0] ][ $date[1] ][ $date[2] ] = $matrix_value;
					}
				}
			}
		}

		// Check custom date reservations
		$custom_reservations = $custom_reservations !== '' ? str_replace( ' ', '', trim( $custom_reservations ) ) : '';
		if ( ! empty( $custom_reservations ) ) {
			$custom_dates = array_filter( explode( ',', $custom_reservations ) );
			
			foreach ( $custom_dates as $custom_date ) {
				
				// Check range dates
				if ( strpos( $custom_date, '|' ) !== false ) {
					$custom_date_range = array_filter( explode( '|', $custom_date ) );
					
					if ( isset( $custom_date_range[0] ) && $custom_date_range[1] ) {
						$custom_date_range_values = qode_framework_get_dates_from_date_range( $custom_date_range[0], $custom_date_range[1] );
						
						// Remove check-out date from the list, because guests leaving the room
						array_pop( $custom_date_range_values );

						// Remove check-in date from the list, because other guests can check out in the morning
						if ( 'yes' === $half_day_booking && 'check-out' === $date_type ) {
							array_shift( $custom_date_range_values );
						}
						
						foreach ( $custom_date_range_values as $custom_date_range_value ) {
							$custom_date_range_value = date( alloggio_core_get_default_room_variables( 'datepick-date-format' ), strtotime( $custom_date_range_value ) );
							
							if ( ! in_array( $custom_date_range_value, $reserved_dates ) ) {
								$reserved_dates[] = $custom_date_range_value;
							}
						}
					}
				} else {
					$custom_date = date( alloggio_core_get_default_room_variables( 'datepick-date-format' ), strtotime( $custom_date ) );

					// Remove check-in date from the list, because other guests can check out in the morning
					if ( 'yes' === $half_day_booking && 'check-out' === $date_type ) {
						$custom_date = '';
					}

					if ( ! empty( $custom_date ) && ! in_array( $custom_date, $reserved_dates, true ) ) {
						$reserved_dates[] = $custom_date;
					}
				}
			}
		}
		
		// Extend default reserved dates with last available room dates and return it
		if ( $return_with_last_room_dates ) {
			$reserved_dates = array(
				'reserved_dates'  => implode( '|', $reserved_dates ),
				'last_room_dates' => implode( '|', $last_room_dates ),
			);
		}
		
		return $reserved_dates;
	}
}

if ( ! function_exists( 'alloggio_core_get_rooms_reserved_dates' ) ) {
	/**
	 * Get real reserved dates for all rooms
	 *
	 * @param bool $return_as_string
	 * @param string $date_type - it can be check-in or check-out
	 *
	 * @return string|array
	 */
	function alloggio_core_get_rooms_reserved_dates( $return_as_string = true, $date_type = 'check-out' ) {
		$reserved_dates = array();
		$rooms_id       = get_posts( array(
			'post_type'      => 'room',
			'fields'         => 'ids',
			'posts_per_page' => -1
		) );
		
		// Loop through all custom post type items and collect all reserved dates
		if ( ! empty( $rooms_id ) ) {
			foreach ( $rooms_id as $room_id ) {
				$room_reserved_dates = alloggio_core_get_room_reserved_dates( $room_id, false, 0, $date_type );
				
				if ( ! empty( $room_reserved_dates ) ) {
					$reserved_dates = array_merge( $reserved_dates, $room_reserved_dates );
				}
			}
		}
		
		// Collect only duplicated values from array
		if ( ! empty( $reserved_dates ) ) {
			$rooms_count          = count( $rooms_id );
			$reserved_dates_count = array_count_values( $reserved_dates );
			
			// Clear array data, because we will fill it below
			$reserved_dates = array();
			
			foreach ( $reserved_dates_count as $reserved_date => $reserved_date_count ) {
				
				// Check is duplicated reserved dates are the same as rooms count
				if ( $reserved_date_count === $rooms_count ) {
					
					// If conditional is correct set date as reserved
					array_push( $reserved_dates, $reserved_date );
				}
			}
		}
		
		return $return_as_string ? implode( '|', $reserved_dates ) : $reserved_dates;
	}
}

if ( ! function_exists( 'alloggio_core_get_room_seasonal_price' ) ) {
	/**
	 * Get seasonal price for the room if the current date between seasonal dates
	 *
	 * @param int $page_id
	 *
	 * @return float
	 */
	function alloggio_core_get_room_seasonal_price( $page_id ) {
		$items = get_post_meta( $page_id, 'qodef_room_single_seasonal_items', true );
		$price = 0;
		
		if ( ! empty( $items ) ) {
			$current_date = date( alloggio_core_get_default_room_variables( 'meta-date-format' ) );
			
			foreach ( $items as $item ) {
				$seasonal_dates_range = qode_framework_get_dates_from_date_range( $item['qodef_room_single_seasonal_item_beginning'], $item['qodef_room_single_seasonal_item_end'] );
				
				if ( ! empty( $item['qodef_room_single_seasonal_item_price'] ) && in_array( $current_date, $seasonal_dates_range ) ) {
					$price = floatval( $item['qodef_room_single_seasonal_item_price'] );
				}
			}
		}
		
		return $price;
	}
}

if ( ! function_exists( 'alloggio_core_get_room_seasonal_dates' ) ) {
	/**
	 * Get seasonal dates for the room
	 *
	 * @param int  $page_id
	 *
	 * @return string
	 */
	function alloggio_core_get_room_seasonal_dates( $page_id ) {
		// Meta variables
		$items = get_post_meta( $page_id, 'qodef_room_single_seasonal_items', true );
		
		// Global variables
		$date_matrix  = array();
		$current_date = date( alloggio_core_get_default_room_variables( 'meta-date-format' ) );
		
		if ( ! empty( $items ) ) {
			foreach ( $items as $seasonal_date ) {
				$seasonal_price = floatval( $seasonal_date['qodef_room_single_seasonal_item_price'] );
				$dates_range    = qode_framework_get_dates_from_date_range( $seasonal_date['qodef_room_single_seasonal_item_beginning'], $seasonal_date['qodef_room_single_seasonal_item_end'] );
				
				foreach ( $dates_range as $key => $date ) {
					if ( strtotime( $date ) < strtotime( $current_date ) ) {
						unset( $dates_range[ $key ] );
					} else {
						$dates_range[ $key ] = date( alloggio_core_get_default_room_variables( 'datepick-date-format' ), strtotime( $date ) );
					}
				}
				
				$date_matrix[] = $seasonal_price . ':' . implode( ';', $dates_range );
			}
		}
		
		return implode( '|', $date_matrix );
	}
}
