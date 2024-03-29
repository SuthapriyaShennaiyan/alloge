<?php

if ( ! function_exists( 'alloggio_core_add_blog_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function alloggio_core_add_blog_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'post' ),
				'type'  => 'meta',
				'slug'  => 'blog-single',
				'title' => esc_html__( 'Blog Single', 'alloggio-core' )
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_blog_list_image',
					'title'       => esc_html__( 'Blog List Image', 'alloggio-core' ),
					'description' => esc_html__( 'Upload image to be displayed on blog list instead of featured image', 'alloggio-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_masonry_image_dimension_post',
					'title'       => esc_html__( 'Image Dimension', 'alloggio-core' ),
					'description' => esc_html__( 'Choose an image layout for blog list. If you are using fixed image proportions on the list, choose an option other than default', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'masonry_image_dimension' )
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_blog_single_enable_page_padding',
					'title'         => esc_html__( 'Enable Padding', 'alloggio-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable content padding left/right on blog single', 'alloggio-core' ),
					'options'       => alloggio_core_get_select_type_options_pool( 'no_yes' )
				)
			);

			// Hook to include additional options after module options
			do_action( 'alloggio_core_action_after_blog_single_meta_box_map', $page );
		}
	}

	add_action( 'alloggio_core_action_default_meta_boxes_init', 'alloggio_core_add_blog_single_meta_box', 1 ); // Permission 1 is set in order to this module be at the first place
}