<?php

if ( ! function_exists( 'alloggio_core_add_masonry_gallery_meta_box' ) ) {
	/**
	 * Function that adds fields for masonry gallery
	 */
	function alloggio_core_add_masonry_gallery_meta_box() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'masonry-gallery' ),
				'type'  => 'meta',
				'slug'  => 'masonry-gallery',
				'title' => esc_html__( 'Masonry Gallery Parameters', 'alloggio-core' ),
			)
		);
		
		if ( $page ) {
			
			$page->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_masonry_gallery_item_layout',
				'title'         => esc_html__( 'Item Layout', 'alloggio-core' ),
				'description'   => esc_html__( 'Choose default layout for masonry gallery item', 'alloggio-core' ),
				'options'       => array(
					'standard' => esc_html__( 'Standard', 'alloggio-core' ),
					'simple'   => esc_html__( 'Simple', 'alloggio-core' ),
					'textual'  => esc_html__( 'Textual', 'alloggio-core' ),
				),
				'default_value' => 'standard'
			) );
			
			$page->add_field_element( array(
				'field_type'  => 'select',
				'name'        => 'qodef_masonry_gallery_item_dimension',
				'title'       => esc_html__( 'Masonry Item Dimension', 'alloggio-core' ),
				'description' => esc_html__( 'Choose an item dimension layout "masonry behavior" for masonry gallery list.', 'alloggio-core' ),
				'options'     => alloggio_core_get_select_type_options_pool( 'masonry_image_dimension' ),
			) );
			
			$page->add_field_element( array(
				'field_type' => 'select',
				'name'       => 'qodef_masonry_gallery_item_title_tag',
				'title'      => esc_html__( 'Title Tag', 'alloggio-core' ),
				'options'    => alloggio_core_get_select_type_options_pool( 'title_tag' ),
				'dependency' => array(
					'hide' => array(
						'qodef_masonry_gallery_item_layout' => array(
							'values'        => array( 'simple' ),
							'default_value' => 'standard'
						)
					)
				),
			) );
			
			$page->add_field_element(
				array(
					'field_type' => 'textarea',
					'name'       => 'qodef_masonry_gallery_item_text',
					'title'      => esc_html__( 'Text', 'alloggio-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_masonry_gallery_item_layout' => array(
								'values'        => array( 'textual' ),
								'default_value' => 'standard'
							)
						)
					),
				)
			);
			
			$page->add_field_element( array(
				'field_type' => 'select',
				'name'       => 'qodef_masonry_gallery_item_text_tag',
				'title'      => esc_html__( 'Text Tag', 'alloggio-core' ),
				'options'    => alloggio_core_get_select_type_options_pool( 'title_tag' ),
				'dependency' => array(
					'show' => array(
						'qodef_masonry_gallery_item_layout' => array(
							'values'        => array( 'textual' ),
							'default_value' => 'standard'
						)
					)
				),
			) );
			
			$page->add_field_element( array(
				'field_type' => 'text',
				'name'       => 'qodef_masonry_gallery_item_button_label',
				'title'      => esc_html__( 'Button Label', 'alloggio-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_masonry_gallery_item_layout' => array(
							'values'        => array( 'textual' ),
							'default_value' => 'standard'
						)
					)
				),
			) );
			
			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_masonry_gallery_item_link',
					'title'      => esc_html__( 'Link', 'alloggio-core' ),
				)
			);
			
			$page->add_field_element( array(
				'field_type' => 'select',
				'name'       => 'qodef_masonry_gallery_item_link_target',
				'title'      => esc_html__( 'Target', 'alloggio-core' ),
				'options'    => alloggio_core_get_select_type_options_pool( 'link_target', false ),
			) );
			
			// Hook to include additional options after module options
			do_action( 'alloggio_core_action_after_masonry_gallery_meta_box_map', $page );
		}
	}
	
	add_action( 'alloggio_core_action_default_meta_boxes_init', 'alloggio_core_add_masonry_gallery_meta_box' );
}