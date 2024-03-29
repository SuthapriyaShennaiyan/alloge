<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class WC_Product_Room extends WC_Product_Qodef {
	
	/**
	 * Get the product if ID is passed, otherwise the product is new and empty.
	 * This class should NOT be instantiated, but the wc_get_product() function
	 * should be used. It is possible, but the wc_get_product() is preferred.
	 *
	 * @param int|WC_Product|object $product Product to init.
	 */
	public function __construct( $product = 0 ) {
		parent::__construct( $product );
		
		$this->set_status( get_post_status( $this->get_id() ) );
	}
	
	function generate_price() {
		$product_id       = $this->get_id();
		$reservation_data = get_transient( "alloggio_core_room_product_reservation_data_{$product_id}" );
		
		return alloggio_core_calculate_room_price( $this->get_id(), $reservation_data );
	}
	
	function generate_sold_individually() {
		return false;
	}
	
	function generate_stock_status() {
		return 'instock';
	}
	
	function generate_stock_quantity() {
		return null;
	}
}
