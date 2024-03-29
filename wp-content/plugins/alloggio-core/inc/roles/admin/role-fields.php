<?php

if ( ! function_exists( 'alloggio_core_add_admin_user_options' ) ) {
	function alloggio_core_add_admin_user_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'administrator', 'author' ),
				'type'  => 'user',
				'title' => esc_html__( 'Social Networks', 'alloggio-core' ),
				'slug'  => 'admin-options',
			)
		);
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_facebook',
					'title'       => esc_html__( 'Facebook', 'alloggio-core' ),
					'description' => esc_html__( 'Enter user Facebook profile URL', 'alloggio-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_instagram',
					'title'       => esc_html__( 'Instagram', 'alloggio-core' ),
					'description' => esc_html__( 'Enter user Instagram profile URL', 'alloggio-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_twitter',
					'title'       => esc_html__( 'Twitter', 'alloggio-core' ),
					'description' => esc_html__( 'Enter user Twitter profile URL', 'alloggio-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_linkedin',
					'title'       => esc_html__( 'LinkedIn', 'alloggio-core' ),
					'description' => esc_html__( 'Enter user LinkedIn profile URL', 'alloggio-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_pinterest',
					'title'       => esc_html__( 'Pinterest', 'alloggio-core' ),
					'description' => esc_html__( 'Enter user Pinterest profile URL', 'alloggio-core' ),
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'alloggio_core_action_after_admin_user_options_map', $page );
		}
	}
	
	add_action( 'alloggio_core_action_register_role_custom_fields', 'alloggio_core_add_admin_user_options' );
}