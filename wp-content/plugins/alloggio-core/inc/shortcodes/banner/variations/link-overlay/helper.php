<?php

if ( ! function_exists( 'alloggio_core_add_banner_variation_link_overlay' ) ) {
	function alloggio_core_add_banner_variation_link_overlay( $variations ) {
		$variations['link-overlay'] = esc_html__( 'Link Overlay', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_banner_layouts', 'alloggio_core_add_banner_variation_link_overlay' );
}
