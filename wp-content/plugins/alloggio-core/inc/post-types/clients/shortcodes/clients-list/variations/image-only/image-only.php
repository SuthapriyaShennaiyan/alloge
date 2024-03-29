<?php

if ( ! function_exists( 'alloggio_core_add_clients_list_variation_image_only' ) ) {
	function alloggio_core_add_clients_list_variation_image_only( $variations ) {
		
		$variations['image-only'] = esc_html__( 'Image Only', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_clients_list_layouts', 'alloggio_core_add_clients_list_variation_image_only' );
}