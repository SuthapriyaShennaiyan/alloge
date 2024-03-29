<?php

if ( ! function_exists( 'alloggio_core_include_room_payment_class' ) ) {
	/**
	 * Include custom post type payment classes
	 */
	function alloggio_core_include_room_payment_class() {
		if ( qode_framework_is_installed( 'checkout' ) ) {
			require_once ALLOGGIO_CORE_CPT_PATH . '/room/payment/class-wc-product-room.php';
			require_once ALLOGGIO_CORE_CPT_PATH . '/room/payment/class-wc-order-item-room.php';
			require_once ALLOGGIO_CORE_CPT_PATH . '/room/payment/class-wc-order-item-room-store.php';
			require_once ALLOGGIO_CORE_CPT_PATH . '/room/payment/class-wc-room-data-store-cpt.php';
		}
	}
	
	add_action( 'wp_loaded', 'alloggio_core_include_room_payment_class' );
}

if ( ! function_exists( 'alloggio_core_add_room_to_post_types_payment' ) ) {
	/**
	 * Add custom post type into payment list
	 *
	 * @param array $post_types
	 *
	 * @return array
	 */
	function alloggio_core_add_room_to_post_types_payment( $post_types ) {
		
		if ( qode_framework_is_installed( 'checkout' ) ) {
			$post_types[] = 'room';
		}
		
		return $post_types;
	}
	
	add_filter( 'alloggio_core_filter_checkout_integration_post_types', 'alloggio_core_add_room_to_post_types_payment', 100 );
}

if ( ! function_exists( 'alloggio_core_set_notice_for_room_page' ) ) {
	/**
	 * Include default WooCommerce notice template into custom post type content
	 */
	function alloggio_core_set_notice_for_room_page() {
		
		if ( qode_framework_is_installed( 'checkout' ) ) {
			add_action( 'alloggio_core_action_before_room_post_content', 'wc_print_notices', 10 );
		}
	}
	
	add_action( 'wp', 'alloggio_core_set_notice_for_room_page' );
}

if ( ! function_exists( 'alloggio_core_get_room_book_now_form' ) ) {
	/**
	 * Add reservation form button trigger
	 *
	 * @param int $quantity_value
	 */
	function alloggio_core_get_room_book_now_form( $quantity_value ) {
		if ( qode_framework_is_installed( 'checkout' ) ) {
			alloggio_core_get_checkout_buy_item_form(
				array(
					'layout'         => 'content',
					'quantity_value' => $quantity_value,
				),
				array(
					'button_layout' => 'outlined',
					'size'          => 'full',
					'input_text'    => esc_html__( 'Book Now', 'alloggio-core' ),
				)
			);
		} else {
			esc_html_e( 'Please install a WooCommerce plugin in order to enable booking functionality.');
		}
	}
}

if ( ! function_exists( 'alloggio_core_add_to_cart_room_action' ) ) {
	/**
	 * Collect required information about custom post type and add it item into the cart
	 */
	function alloggio_core_add_to_cart_room_action() {
		$product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_REQUEST['add-to-cart'] ) );
		$quantity          = empty( $_REQUEST['quantity'] ) ? 1 : wc_stock_amount( $_REQUEST['quantity'] );
		$passed_validation = true;
		
		if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity ) !== false ) {
			
			if ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
				wc_add_to_cart_message( array( $product_id => $quantity ), true );
			}
			
			wp_safe_redirect( wc_get_cart_url() );
			exit;
		}
	}
	
	add_action( 'woocommerce_add_to_cart_handler_room', 'alloggio_core_add_to_cart_room_action' );
}

if ( ! function_exists( 'alloggio_core_override_empty_cart_link_room' ) ) {
	/**
	 * Override empty cart link to redirect to room archive
	 *
	 * @param string $url
	 *
	 * @return string
	 */
	function alloggio_core_override_empty_cart_link_room( $url ) {
		return esc_url( get_post_type_archive_link( 'room' ) );
	}
	
	add_action( 'woocommerce_return_to_shop_redirect', 'alloggio_core_override_empty_cart_link_room' );
}

if ( ! function_exists( 'alloggio_core_validate_room_reservation_data_before_cart_loaded' ) ) {
	/**
	 * Check that custom post type exists in the cart and if exists check is reservation data validate before loading the cart table
	 */
	function alloggio_core_validate_room_reservation_data_before_cart_loaded() {
		$items = WC()->cart->get_cart();

		if ( ! empty( $items ) ) {
			foreach ( $items as $item ) {
				$product_id = $item['data']->get_id();
				
				if ( get_post_type( $product_id ) === 'room' ) {
					$reservation_data = get_transient( "alloggio_core_room_product_reservation_data_{$product_id}" );
					
					if ( empty( $reservation_data ) ) {
						// If transient is expired remove item from the cart in order to prevent potential hack
						WC()->cart->remove_cart_item( $item['key'] );
					}
				}
			}
		}
	}
	
	add_action( 'woocommerce_before_cart', 'alloggio_core_validate_room_reservation_data_before_cart_loaded' );
	add_action( 'alloggio_core_action_woocommerce_before_side_area_cart_content', 'alloggio_core_validate_room_reservation_data_before_cart_loaded' );
}

if ( ! function_exists( 'alloggio_core_add_reservation_details_template' ) ) {
	/**
	 * Add custom post type reservation details content
	 *
	 * @param int  $product_id
	 * @param array $reservation_items
	 * @param bool $print
	 *
	 * @return void|string|html
	 */
	function alloggio_core_add_reservation_details_template( $product_id, $reservation_items = array(), $print = true ) {
		
		if ( ! empty( $product_id ) && get_post_type( $product_id ) === 'room' ) {
			$reservation_data = ! empty( $reservation_items ) ? $reservation_items : get_transient( "alloggio_core_room_product_reservation_data_{$product_id}" );
			
			if ( ! empty( $reservation_data ) ) {
				
				if ( $print ) {
					alloggio_core_template_part( 'post-types/room', 'templates/cart/reservation-info', '', $reservation_data );
				} else {
					return alloggio_core_get_template_part( 'post-types/room', 'templates/cart/reservation-info', '', $reservation_data );
				}
			}
		}
		
		return '';
	}
}

if ( ! function_exists( 'alloggio_core_add_additional_cart_info_room_product' ) ) {
	/**
	 * Add custom post type reservation details content inside cart table
	 *
	 * @param array $cart_item
	 *
	 * @return void|string|html
	 */
	function alloggio_core_add_additional_cart_info_room_product( $cart_item ) {
		alloggio_core_add_reservation_details_template( $cart_item['product_id'] );
	}
	
	add_action( 'woocommerce_after_cart_item_name', 'alloggio_core_add_additional_cart_info_room_product' );
}

if ( ! function_exists( 'alloggio_core_add_additional_checkout_info_room_product' ) ) {
	/**
	 * Add custom post type reservation details content inside order table
	 *
	 * @param string|html $quantity_content
	 * @param array $cart_item
	 *
	 * @return string|html
	 */
	function alloggio_core_add_additional_checkout_info_room_product( $quantity_content, $cart_item ) {
		$additional_content = alloggio_core_add_reservation_details_template( $cart_item['product_id'], array(), false );
		
		return $quantity_content . $additional_content;
	}
	
	add_filter( 'woocommerce_checkout_cart_item_quantity', 'alloggio_core_add_additional_checkout_info_room_product', 10, 2 );
}

if ( ! function_exists( 'alloggio_core_checkout_add_room_reservation_item' ) ) {
	/**
	 * Add reservation item meta for custom post type
	 *
	 * @param int $item_id
	 * @param object $item
	 */
	function alloggio_core_checkout_add_room_reservation_item( $item_id, $item ) {
		$product_id = $item->get_product_id();
		
		if ( ! empty( $product_id ) && get_post_type( $product_id ) === 'room' ) {
			$reservation_data = get_transient( "alloggio_core_room_product_reservation_data_{$product_id}" );
			
			if ( ! empty( $reservation_data ) ) {
				$room_id      = alloggio_core_get_original_room_page_id( $product_id );
				$reservations = get_post_meta($room_id, 'qodef_room_single_reservations', true );
				
				if ( empty( $reservations ) ) {
					$reservations = array();
				}
				
				$current_reservation = array();
				$reservation_data    = array_merge( array( 'order_id' => wc_get_order_id_by_order_item_id( $item_id ) ), $reservation_data );
				
				foreach ( $reservation_data as $key => $value ) {
					if ( strpos( $key, 'check_' ) !== false ) {
						$current_reservation[ 'qodef_room_single_reservation_' . esc_attr( $key ) ] = date( alloggio_core_get_default_room_variables( 'meta-date-format' ), strtotime( $value ) );
					} elseif ( strpos( $key, 'extra_services' ) !== false ) {
						$current_reservation[ 'qodef_room_single_reservation_' . esc_attr( $key ) ] = implode( ', ', $value );
					} else {
						$current_reservation[ 'qodef_room_single_reservation_' . esc_attr( $key ) ] = $value;
					}
				}
				
				$current_reservation['qodef_room_single_reservation_flag'] = 'no';
				
				$reservations[] = $current_reservation;
				
				// Update custom post type reservation meta
				update_post_meta( $room_id, 'qodef_room_single_reservations', $reservations );
				
				// Remove reservation data transient
				delete_transient( "alloggio_core_room_product_reservation_data_{$product_id}" );
			}
		}
	}
	
	add_action( 'woocommerce_order_item_meta_start', 'alloggio_core_checkout_add_room_reservation_item', 10, 2 );
}

if ( ! function_exists( 'alloggio_core_add_additional_order_info_room_product' ) ) {
	/**
	 * Add custom post type reservation details content inside checkout table
	 *
	 * @param int $item_id
	 * @param object $item
	 *
	 * @return void|string|html
	 */
	function alloggio_core_add_additional_order_info_room_product( $item_id, $item ) {
		$room_id      = alloggio_core_get_original_room_page_id( $item->get_product_id() );
		$reservations = get_post_meta( $room_id, 'qodef_room_single_reservations', true );
		
		if ( ! empty( $reservations ) ) {
			foreach ( $reservations as $reservation ) {
				if ( $reservation['qodef_room_single_reservation_order_id'] == $item->get_data()['order_id'] ) {
					$reservation_details = array(
						'check_in'       => $reservation['qodef_room_single_reservation_check_in'],
						'check_out'      => $reservation['qodef_room_single_reservation_check_out'],
						'guests'         => $reservation['qodef_room_single_reservation_guests'],
						'extra_services' => $reservation['qodef_room_single_reservation_extra_services'],
					);
					
					alloggio_core_add_reservation_details_template( $item->get_product_id(), $reservation_details );
				}
			}
		}
	}
	
	add_action( 'woocommerce_order_item_meta_start', 'alloggio_core_add_additional_order_info_room_product', 20, 2 ); // Permission 20 is set in order to set temporary data inside template after alloggio_core_checkout_add_room_reservation_item clear it
}

if ( ! function_exists( 'alloggio_core_update_room_product_reservation_data' ) ) {
	/**
	 * Update custom post type reservation item meta on order status changed
	 *
	 * @param int $order_id
	 * @param string $status_from
	 * @param string $status_to
	 * @param WC_Order $order
	 */
	function alloggio_core_update_room_product_reservation_data( $order_id, $status_from, $status_to, $order ) {
		$items = $order->get_items();
		
		if ( empty( $items ) ) {
			__return_empty_string();
		}
		
		if ( in_array( $status_to, array( 'processing', 'completed' ) ) ) {
			
			foreach ( $items as $item ) {
				if ( is_a( $item, 'WC_Order_Item_Room' ) ) {
					$room_id      = alloggio_core_get_original_room_page_id( $item->get_product_id() );
					$reservations = get_post_meta( $room_id, 'qodef_room_single_reservations', true );
					
					if ( ! empty( $reservations ) ) {
						foreach ( $reservations as $key => $reservation ) {
							if ( $reservation['qodef_room_single_reservation_order_id'] == $order_id && $reservation['qodef_room_single_reservation_flag'] !== 'yes' ) {
								// Change flag to active
								$reservation['qodef_room_single_reservation_flag'] = 'yes';
								
								$reservations[ $key ] = $reservation;
								
								// Update custom post type reservations
								update_post_meta( $room_id, 'qodef_room_single_reservations', $reservations );
							}
						}
					}
				}
			}
		} elseif ( in_array( $status_to, array( 'pending', 'on-hold' ) ) ) {
			
			foreach ( $items as $item ) {
				if ( is_a( $item, 'WC_Order_Item_Room' ) ) {
					$room_id      = alloggio_core_get_original_room_page_id( $item->get_product_id() );
					$reservations = get_post_meta( $room_id, 'qodef_room_single_reservations', true );
					
					if ( ! empty( $reservations ) ) {
						foreach ( $reservations as $key => $reservation ) {
							if ( $reservation['qodef_room_single_reservation_order_id'] == $order_id && $reservation['qodef_room_single_reservation_flag'] === 'yes' ) {
								// Change flag to active
								$reservation['qodef_room_single_reservation_flag'] = 'no';
								
								$reservations[ $key ] = $reservation;
								
								// Update custom post type reservations
								update_post_meta( $room_id, 'qodef_room_single_reservations', $reservations );
							}
						}
					}
				}
			}
		} elseif ( in_array( $status_to, array( 'cancelled', 'refunded', 'failed' ) ) ) {
			
			foreach ( $items as $item ) {
				if ( is_a( $item, 'WC_Order_Item_Room' ) ) {
					$room_id      = alloggio_core_get_original_room_page_id( $item->get_product_id() );
					$reservations = get_post_meta( $room_id, 'qodef_room_single_reservations', true );
					
					if ( ! empty( $reservations ) ) {
						foreach ( $reservations as $key => $reservation ) {
							if ( $reservation['qodef_room_single_reservation_order_id'] == $order_id ) {
								// Remove reservation details from custom post type
								unset( $reservations[ $key ] );
								
								// Update custom post type reservations
								update_post_meta( $room_id, 'qodef_room_single_reservations', $reservations );
							}
						}
					}
				}
			}
		}
	}
	
	add_action( 'woocommerce_order_status_changed', 'alloggio_core_update_room_product_reservation_data', 10, 4 );
}

if ( ! function_exists( 'alloggio_core_update_order_item_with_additional_room_info' ) ) {
	/**
	 * Add custom post type reservation details for orders panel
	 *
	 * @param int $item_id
	 * @param object $item
	 *
	 * @return void|string|html
	 */
	function alloggio_core_update_order_item_with_additional_room_info( $item_id, $item ) {
		$product_id = $item->get_product_id();
		
		if ( ! empty( $product_id ) && get_post_type( $product_id ) === 'room' ) {
			$room_id      = alloggio_core_get_original_room_page_id( $product_id );
			$reservations = get_post_meta( $room_id, 'qodef_room_single_reservations', true );
		
			if ( ! empty( $reservations ) ) {
				foreach ( $reservations as $reservation ) {
					if ( $reservation['qodef_room_single_reservation_order_id'] == $item->get_data()['order_id'] ) {
						$reservation_details = array(
							'check_in'       => $reservation['qodef_room_single_reservation_check_in'],
							'check_out'      => $reservation['qodef_room_single_reservation_check_out'],
							'guests'         => $reservation['qodef_room_single_reservation_guests'],
							'extra_services' => $reservation['qodef_room_single_reservation_extra_services'],
						);
						
						alloggio_core_add_reservation_details_template( $product_id, $reservation_details );
					}
				}
			}
		}
	}
	
	add_action( 'woocommerce_after_order_itemmeta', 'alloggio_core_update_order_item_with_additional_room_info', 10, 2 );
}
