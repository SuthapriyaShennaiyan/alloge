<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class WC_Order_Item_Room extends WC_Order_Item_Qodef {
	
	public function __construct( $product = 0 ) {
		$this->set_post_type();
		parent::__construct( $product );
	}
	
	function set_post_type() {
		$this->custom_post_type = 'room';
	}
}
