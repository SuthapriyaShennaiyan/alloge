<?php

if ( ! function_exists( 'alloggio_core_add_social_share_variation_text' ) ) {
	function alloggio_core_add_social_share_variation_text( $variations ) {
		
		$variations['text'] = esc_html__( 'Text', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_social_share_layouts', 'alloggio_core_add_social_share_variation_text' );
}
