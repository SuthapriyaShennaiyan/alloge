<?php

if ( ! function_exists( 'alloggio_core_add_blog_list_variation_minimal' ) ) {
	function alloggio_core_add_blog_list_variation_minimal( $variations ) {
		$variations['minimal'] = esc_html__( 'Minimal', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_blog_list_layouts', 'alloggio_core_add_blog_list_variation_minimal' );
}