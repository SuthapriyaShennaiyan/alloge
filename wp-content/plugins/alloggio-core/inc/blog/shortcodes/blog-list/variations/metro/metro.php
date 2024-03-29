<?php

if ( ! function_exists( 'alloggio_core_add_blog_list_variation_metro' ) ) {
	function alloggio_core_add_blog_list_variation_metro( $variations ) {
		$variations['metro'] = esc_html__( 'Metro', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_blog_list_layouts', 'alloggio_core_add_blog_list_variation_metro' );
}