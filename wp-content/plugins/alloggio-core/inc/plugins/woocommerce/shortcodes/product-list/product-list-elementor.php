<?php

class AlloggioCoreElementorProductList extends AlloggioCore_Elementor_Widget_Base {

	public function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'alloggio_core_product_list' );

		parent::__construct( $data, $args );
	}
}

if ( qode_framework_is_installed( 'woocommerce' ) ) {
	alloggio_core_register_new_elementor_widget( new AlloggioCoreElementorProductList() );
}
