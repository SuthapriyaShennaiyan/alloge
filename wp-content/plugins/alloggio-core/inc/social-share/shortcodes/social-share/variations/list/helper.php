<?php

if ( ! function_exists( 'alloggio_core_add_social_share_variation_list' ) ) {
	function alloggio_core_add_social_share_variation_list( $variations ) {
		
		$variations['list'] = esc_html__( 'List', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_social_share_layouts', 'alloggio_core_add_social_share_variation_list' );
}
