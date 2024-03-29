<?php

if ( ! function_exists( 'alloggio_core_add_listing_profile_navigation_item' ) ) {
	/**
	 * Function that extend main dashboard page navigation items
	 *
	 * @return array
	 */
	function alloggio_core_add_listing_profile_navigation_item( $items, $dashboard_url ) {
		if ( post_type_exists( 'room' ) ) {
			$items['reserved-rooms'] = array(
				'url'         => esc_url( add_query_arg( array( 'user-action' => 'reserved-rooms' ), $dashboard_url ) ),
				'text'        => esc_html__( 'Reserved Rooms', 'alloggio-core' ),
				'user_action' => 'reserved-rooms',
				'icon'        => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"><g><line x1="46" y1="10" x2="18" y2="10"/><polyline points="12,10 1,10 1,58 63,58 63,10 52,10"/><rect x="12" y="6"  width="6" height="8"/><rect x="46" y="6"  width="6" height="8"/><rect x="10" y="24" width="10" height="10"/><rect x="10" y="42" width="10" height="10"/><rect x="44" y="24" width="10" height="10"/><rect x="44" y="42" width="10" height="10"/><rect x="27" y="24" width="10" height="10"/><rect x="27" y="42" width="10" height="10"/></g><line x1="1" y1="18" x2="63" y2="18"/></svg>'
			);
		}
		
		return $items;
	}
	
	add_filter( 'alloggio_membership_filter_dashboard_navigation_pages_before_logged_out', 'alloggio_core_add_listing_profile_navigation_item', 10, 2 );
}

if ( ! function_exists( 'alloggio_core_add_listing_profile_navigation_pages' ) ) {
	/**
	 * Function that extend content for main dashboard page item
	 *
	 * @return string that contains html of content
	 */
	function alloggio_core_add_listing_profile_navigation_pages( $html, $action ) {
		
		if ( qode_framework_is_installed( 'woocommerce' ) ) {
			switch ( $action ) {
				case 'reserved-rooms':
					$customer_orders = wc_get_orders( array(
						'customer'  => get_current_user_id(),
					) );
					
					$rooms_order = array();
					if ( ! empty( $customer_orders ) ) {
						foreach ( $customer_orders as $customer_order ) {
							$order       = wc_get_order( $customer_order->get_id() );
							$order_items = ! empty( $order ) ? $order->get_items() : array();
							
							if ( ! empty( $order_items ) ) {
								foreach ( $order_items as $order_item ) {
									
									if ( $order_item->get_type() === 'room' ) {
										$rooms_order[] = $order_item;
									}
								}
							}
						}
					}
					
					$html = alloggio_core_get_template_part( 'post-types/room/profile', 'templates/reserved-rooms', '', array( 'rooms_order' => $rooms_order ) );
					break;
			}
		}

		return $html;
	}
	
	add_filter( 'alloggio_membership_filter_dashboard_page', 'alloggio_core_add_listing_profile_navigation_pages', 10, 2 );
}