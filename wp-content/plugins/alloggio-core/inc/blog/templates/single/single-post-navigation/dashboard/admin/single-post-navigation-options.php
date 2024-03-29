<?php

if ( ! function_exists( 'alloggio_core_add_blog_single_post_navigation_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function alloggio_core_add_blog_single_post_navigation_options( $page ) {
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_blog_single_enable_single_post_navigation',
					'title'         => esc_html__( 'Enable Single Post Navigation', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will show single post navigation section below post content on blog single', 'alloggio-core' ),
					'default_value' => 'yes'
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_blog_single_post_navigation_through_same_category',
					'title'         => esc_html__( 'Set Navigation Through Current Category', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will set your post navigation only through current category', 'alloggio-core' ),
					'default_value' => 'yes',
					'dependency'    => array(
						'show' => array(
							'qodef_blog_single_enable_single_post_navigation' => array(
								'values'        => 'yes',
								'default_value' => ''
							)
						)
					)
				)
			);
		}
	}
	
	add_action( 'alloggio_core_action_after_blog_single_options_map', 'alloggio_core_add_blog_single_post_navigation_options' );
}