<?php

if ( ! function_exists( 'alloggio_core_add_testimonials_list_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function alloggio_core_add_testimonials_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'AlloggioCoreTestimonialsListShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'alloggio_core_filter_register_shortcodes', 'alloggio_core_add_testimonials_list_shortcode' );
}

if ( class_exists( 'AlloggioCoreListShortcode' ) ) {
	class AlloggioCoreTestimonialsListShortcode extends AlloggioCoreListShortcode {
		
		public function __construct() {
			$this->set_post_type( 'testimonials' );
			$this->set_post_type_additional_taxonomies( array( 'testimonials-category' ) );
			$this->set_layouts( apply_filters( 'alloggio_core_filter_testimonials_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'alloggio_core_filter_testimonials_list_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( ALLOGGIO_CORE_CPT_URL_PATH . '/testimonials/shortcodes/testimonials-list' );
			$this->set_base( 'alloggio_core_testimonials_list' );
			$this->set_name( esc_html__( 'Testimonials List', 'alloggio-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of testimonials', 'alloggio-core' ) );
			$this->set_category( esc_html__( 'Alloggio Core', 'alloggio-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'alloggio-core' )
			) );
			$this->map_list_options( array(
				'exclude_behavior' => array( 'masonry', 'justified-gallery' ),
				'exclude_option'   => array( 'images_proportion' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'show_image',
				'title'      => esc_html__( 'Author\'s image', 'alloggio-core' ),
				'options'    => alloggio_core_get_select_type_options_pool('no_yes', false),
				'dependency' => array(
					'hide' => array(
						'behavior' => array(
							'values'        => 'slider',
							'default_value' => ''
						)
					)
				)
			) );
			
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'icon',
				'title'      => esc_html__( 'Icon', 'alloggio-core' ),
				'options'    => array(
					''      => esc_html__( 'Hidden', 'alloggio-core' ),
					'title' => esc_html__( 'Behind Title', 'alloggio-core' ),
					'text'  => esc_html__( 'Behind Text', 'alloggio-core' )
				)
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
				'field_type' => 'select',
				'name'       => 'content_position',
				'title'      => esc_html__( 'Content Position', 'alloggio-core' ),
				'options'    => array(
					''       => esc_html__( 'Default', 'alloggio-core' ),
					'center' => esc_html__( 'Center', 'alloggio-core' ),
					'right'  => esc_html__( 'Right', 'alloggio-core' )
				)
			) );
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_layout_options( array( 'layouts' => $this->get_layouts() ) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();
			
			$atts['post_type'] = $this->get_post_type();
			
			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );
			
			$atts['unique'] = wp_unique_id();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['item_classes']   = $this->get_item_classes( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts, $atts['columns'] != '1' ? array( 'unique' => $atts['unique'], 'outsideNavigation' => 'yes' ) : array() );
			$atts['query_result']   = new \WP_Query( alloggio_core_get_query_params( $atts ) );
			
			$atts['this_shortcode'] = $this;
			
			return alloggio_core_get_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'templates/content', $atts['behavior'], $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-testimonials-list';
			$holder_classes[] = isset( $atts['skin'] ) && ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';
			$holder_classes[] = isset( $atts['icon'] ) && ! empty( $atts['icon'] ) ? 'qodef-icon-behind--' . $atts['icon'] : '';
			$holder_classes[] = isset( $atts['content_position'] ) && ! empty( $atts['content_position'] ) ? 'qodef-content-position--' . $atts['content_position'] : '';
			
			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();
			
			$list_item_classes = $this->get_list_item_classes( $atts );
			
			$item_classes = array_merge( $item_classes, $list_item_classes );
			
			return implode( ' ', $item_classes );
		}
		
		public function get_title_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}
			
			return $styles;
		}
	}
}