<?php

if ( ! function_exists( 'alloggio_core_add_blog_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function alloggio_core_add_blog_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope'       => ALLOGGIO_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'blog',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Blog', 'alloggio-core' ),
				'description' => esc_html__( 'Global Blog Options', 'alloggio-core' ),
				'layout'      => 'tabbed'
			)
		);
		
		if ( $page ) {
			$custom_sidebars = alloggio_core_get_custom_sidebars();
			
			$list_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-list',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Blog List', 'alloggio-core' ),
					'description' => esc_html__( 'Settings related to blog list', 'alloggio-core' )
				)
			);
			
			$list_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_blog_list_excerpt_number_of_characters',
					'title'       => esc_html__( 'Number of Characters in Excerpt', 'alloggio-core' ),
					'description' => esc_html__( 'Fill a number of characters in excerpt for post summary. Default value is 180', 'alloggio-core' ),
				)
			);
			
			$list_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_blog_archive_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for blog archive', 'alloggio-core' ),
					'options'       => alloggio_core_get_select_type_options_pool( 'sidebar_layouts' ),
					'default_value' => ''
				)
			);
			
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$list_tab->add_field_element(
					array(
						'field_type'    => 'select',
						'name'          => 'qodef_blog_archive_custom_sidebar',
						'title'         => esc_html__( 'Custom Sidebar', 'alloggio-core' ),
						'description'   => esc_html__( 'Choose a custom sidebar to display on blog archive', 'alloggio-core' ),
						'options'       => $custom_sidebars
					)
				);
			}
			
			$list_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_blog_single_archive_grid_gutter',
					'title'         => esc_html__( 'Set Grid Gutter', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose grid gutter size to set space between content and sidebar for blog archive', 'alloggio-core' ),
					'options'       => alloggio_core_get_select_type_options_pool( 'items_space' ),
					'default_value' => ''
				)
			);
			
			$list_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_blog_archive_hide_info',
					'title'         => esc_html__( 'Hide Info', 'alloggio-core' ),
					'description'   => esc_html__( 'Hide categories, tags and comments on Blog list', 'alloggio-core' ),
					'default_value' => 'no'
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'alloggio_core_action_after_blog_list_options_map', $list_tab );
			
			$single_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-single',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Blog Single', 'alloggio-core' ),
					'description' => esc_html__( 'Settings related to blog single', 'alloggio-core' )
				)
			);

			// Hook to include additional options first in single blog options
			do_action( 'alloggio_core_action_first_blog_single_options_map', $single_tab );
			
			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_blog_single_enable_page_title',
					'title'       => esc_html__( 'Enable Page Title', 'alloggio-core' ),
					'description' => esc_html__( 'Use this option to enable/disable page title on blog single', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'no_yes' )
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_blog_single_set_post_title_in_title_area',
					'title'         => esc_html__( 'Show Post Title in Title Area', 'alloggio-core' ),
					'description'   => esc_html__( 'Enabling this option will show post title in title area on single post pages', 'alloggio-core' ),
					'options'       => alloggio_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'dependency'    => array(
						'hide' => array(
							'qodef_blog_single_enable_page_title' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_blog_single_sidebar_layout',
					'title'       => esc_html__( 'Sidebar Layout', 'alloggio-core' ),
					'description' => esc_html__( 'Choose default sidebar layout for blog single', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'sidebar_layouts' )
				)
			);
			
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$single_tab->add_field_element(
					array(
						'field_type'    => 'select',
						'name'          => 'qodef_blog_single_custom_sidebar',
						'title'         => esc_html__( 'Custom Sidebar', 'alloggio-core' ),
						'description'   => esc_html__( 'Choose a custom sidebar to display on blog single', 'alloggio-core' ),
						'options'       => $custom_sidebars
					)
				);
			}
			
			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_blog_single_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'alloggio-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar for blog single', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'items_space' )
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_blog_single_enable_page_padding',
					'title'         => esc_html__( 'Enable Padding', 'alloggio-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable content padding left/right on blog single', 'alloggio-core' ),
					'default_value' => 'no'
				)
			);
			
			
			// Hook to include additional options after module options
			do_action( 'alloggio_core_action_after_blog_single_options_map', $single_tab );
			
			// Hook to include additional options after module options
			do_action( 'alloggio_core_action_after_blog_options_map', $page );
		}
	}
	
	add_action( 'alloggio_core_action_default_options_init', 'alloggio_core_add_blog_options', alloggio_core_get_admin_options_map_position( 'blog' ) );
}