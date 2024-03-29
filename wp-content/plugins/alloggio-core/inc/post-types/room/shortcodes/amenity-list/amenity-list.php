<?php

if ( ! function_exists( 'alloggio_core_add_amenity_list_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function alloggio_core_add_amenity_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'AlloggioCoreAmenityListShortcode';

		return $shortcodes;
	}

	add_filter( 'alloggio_core_filter_register_shortcodes', 'alloggio_core_add_amenity_list_shortcode' );
}

if ( class_exists( 'AlloggioCoreListShortcode' ) ) {
	class AlloggioCoreAmenityListShortcode extends AlloggioCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( ALLOGGIO_CORE_CPT_URL_PATH . '/room/shortcodes/amenity-list' );
			$this->set_base( 'alloggio_core_amenity_list' );
			$this->set_name( esc_html__( 'Amenity List', 'alloggio-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of amenities', 'alloggio-core' ) );
			$this->set_category( esc_html__( 'Alloggio Core', 'alloggio-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns',
				'title'         => esc_html__( 'Number of Columns', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'columns_number', true, array(), array( '7' => esc_html__( 'Seven', 'alloggio-core' ), '8' => esc_html__( 'Eight', 'alloggio-core' ) ) ),
				'default_value' => '3',
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_responsive',
				'title'         => esc_html__( 'Columns Responsive', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'columns_responsive' ),
				'default_value' => 'predefined',
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_1440',
				'title'         => esc_html__( 'Number of Columns 1367px - 1440px', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_1366',
				'title'         => esc_html__( 'Number of Columns 1025px - 1366px', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_1024',
				'title'         => esc_html__( 'Number of Columns 769px - 1024px', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_768',
				'title'         => esc_html__( 'Number of Columns 681px - 768px', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_680',
				'title'         => esc_html__( 'Number of Columns 481px - 680px', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_480',
				'title'         => esc_html__( 'Number of Columns 0 - 480px', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'space',
				'title'         => esc_html__( 'Space Between Items', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'items_space' ),
				'default_value' => 'normal',
			) );
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'posts_per_page',
				'title'         => esc_html__( 'Posts per Page', 'alloggio-core' ),
				'default_value' => '6',
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'orderby',
				'title'         => esc_html__( 'Order By', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'order_by', true, array(), array( 'include' => esc_html__( 'Taxonomy IDs', 'alloggio-core' ) ) ),
				'default_value' => 'date',
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'order',
				'title'         => esc_html__( 'Order', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'order' ),
				'default_value' => 'DESC',
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'taxonomy_ids',
				'title'       => esc_html__( 'Taxonomy IDs', 'alloggio-core' ),
				'description' => esc_html__( 'Separate taxonomy IDs with commas', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'hide_empty',
				'title'      => esc_html__( 'Hide Empty', 'alloggio-core' ),
				'options'    => alloggio_core_get_select_type_options_pool( 'no_yes', false ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title_margin_top',
				'title'      => esc_html__( 'Title Margin Top', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'skin',
				'title'      => esc_html__( 'Skin', 'alloggio-core' ),
				'options'    => array(
					''      => esc_html__( 'Default', 'alloggio-core' ),
					'light' => esc_html__( 'Light', 'alloggio-core' )
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'enable_animation',
				'title'         => esc_html__( 'Enable Animation', 'alloggio-core' ),
				'default_value' => 'yes',
				'options'       => alloggio_core_get_select_type_options_pool( 'yes_no', false ),
			) );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['item_classes']   = $this->get_item_classes( $atts );
			$atts['taxonomy_items'] = get_terms( alloggio_core_get_custom_post_type_taxonomy_query_args( $atts, array( 'taxonomy' => 'amenity' ) ) );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			
			return alloggio_core_get_template_part( 'post-types/room/shortcodes/amenity-list', 'templates/holder', '', $atts );
		}
		
		function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-amenity-list';
			
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';
			
			$holder_classes[] = 'qodef-grid';
			$holder_classes[] = 'qodef-layout--columns';
			$holder_classes[] = ! empty( $atts['space'] ) ? 'qodef-gutter--' . $atts['space'] : '';
			$holder_classes[] = ! empty( $atts['columns'] ) ? 'qodef-col-num--' . $atts['columns'] : '';
			$holder_classes[] = ( $atts['enable_animation'] == 'yes' ) ? 'qodef--has-animation': '';
			
			
			if ( ! empty( $atts['columns_responsive'] ) && $atts['columns_responsive'] === 'custom' ) {
				$holder_classes[] = 'qodef-responsive--custom';
				$holder_classes[] = ! empty( $atts['columns_1440'] ) ? 'qodef-col-num--1440--' . $atts['columns_1440'] : 'qodef-col-num--1440--' . $atts['columns'];
				$holder_classes[] = ! empty( $atts['columns_1366'] ) ? 'qodef-col-num--1366--' . $atts['columns_1366'] : 'qodef-col-num--1366--' . $atts['columns'];
				$holder_classes[] = ! empty( $atts['columns_1024'] ) ? 'qodef-col-num--1024--' . $atts['columns_1024'] : 'qodef-col-num--1024--' . $atts['columns'];
				$holder_classes[] = ! empty( $atts['columns_768'] ) ? 'qodef-col-num--768--' . $atts['columns_768'] : 'qodef-col-num--768--' . $atts['columns'];
				$holder_classes[] = ! empty( $atts['columns_680'] ) ? 'qodef-col-num--680--' . $atts['columns_680'] : 'qodef-col-num--680--' . $atts['columns'];
				$holder_classes[] = ! empty( $atts['columns_480'] ) ? 'qodef-col-num--480--' . $atts['columns_480'] : 'qodef-col-num--480--' . $atts['columns'];
			} else {
				$holder_classes[] = 'qodef-responsive--predefined';
			}
			
			return implode( ' ', $holder_classes );
		}
		
		function get_item_classes( $atts ) {
			$item_classes   = $this->init_item_classes();
			$item_classes[] = 'qodef-amenity-item';
			$item_classes[] = 'qodef-grid-item';
			
			return implode( ' ', $item_classes );
		}
		
		private function get_title_styles( $atts ) {
			$styles = array();
			
			if ( $atts['title_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['title_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['title_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['title_margin_top'] ) . 'px';
				}
			}
			
			return $styles;
		}
	}
}