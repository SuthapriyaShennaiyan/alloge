<?php

if ( ! function_exists( 'alloggio_core_add_room_single_related_posts_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function alloggio_core_add_room_single_related_posts_options( $page ) {
		
		if ( $page ) {
			
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_room_single_enable_related_posts',
					'title'         => esc_html__( 'Related Posts', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will show related posts section below post content on room single', 'alloggio-core' ),
					'default_value' => 'yes'
				)
			);
		}
	}
	
	add_action( 'alloggio_core_action_after_room_options_single', 'alloggio_core_add_room_single_related_posts_options' );
}