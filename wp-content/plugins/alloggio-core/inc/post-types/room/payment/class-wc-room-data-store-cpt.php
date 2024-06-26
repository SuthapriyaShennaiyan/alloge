<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * WC Product Data Store: Stored in CPT.
 *
 * @version  3.0.0
 * @category Class
 * @author   WooThemes
 */
class WC_Room_Data_Store_CPT extends WC_Qodef_Data_Store_CPT {
	
	public function __construct() {
		$this->set_post_type();
	}
	
	function set_post_type() {
		$this->custom_post_type = 'room';
	}
}
