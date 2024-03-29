<?php

if ( ! function_exists( 'alloggio_core_add_social_share_variation_dropdown' ) ) {
	function alloggio_core_add_social_share_variation_dropdown( $variations ) {
		
		$variations['dropdown'] = esc_html__( 'Dropdown', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_social_share_layouts', 'alloggio_core_add_social_share_variation_dropdown' );
}
