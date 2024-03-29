<?php
if ( ! function_exists( 'alloggio_core_filter_clients_list_image_only_fade_in' ) ) {
	function alloggio_core_filter_clients_list_image_only_fade_in( $variations ) {
		
		$variations['fade-in'] = esc_html__( 'Fade In', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_clients_list_image_only_animation_options', 'alloggio_core_filter_clients_list_image_only_fade_in' );
}