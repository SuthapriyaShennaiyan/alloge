<?php

if ( ! function_exists( 'alloggio_core_add_restaurant_menu_info_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function alloggio_core_add_restaurant_menu_info_shortcode( $shortcodes ) {
		$shortcodes[] = 'AlloggioCoreRestaurantMenuInfoShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'alloggio_core_filter_register_shortcodes', 'alloggio_core_add_restaurant_menu_info_shortcode' );
}

if ( class_exists( 'AlloggioCoreListShortcode' ) ) {
	class AlloggioCoreRestaurantMenuInfoShortcode extends AlloggioCoreListShortcode {
		
		public function __construct() {
			$this->set_post_type( 'restaurant-menu' );
			$this->set_post_type_additional_taxonomies( array( 'restaurant-menu-category' ) );
		
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( ALLOGGIO_CORE_CPT_URL_PATH . '/restaurant-menu/shortcodes/restaurant-menu-info' );
			$this->set_base( 'alloggio_core_restaurant_menu_info' );
			$this->set_name( esc_html__( 'Restaurant Menu Info', 'alloggio-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays menu info', 'alloggio-core' ) );
			$this->set_category( esc_html__( 'Alloggio Core', 'alloggio-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'image',
				'title'      => esc_html__( 'Image', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'availability',
				'title'      => esc_html__( 'Availability', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h3'
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'download_link',
				'title'      => esc_html__( 'Download link', 'alloggio-core' )
			) );
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();
			
			$atts['post_type'] = $this->get_post_type();

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['query_result']   = new \WP_Query( alloggio_core_get_query_params( $atts ) );
			
			$atts['this_shortcode'] = $this;
			
			return alloggio_core_get_template_part( 'post-types/restaurant-menu/shortcodes/restaurant-menu-info', 'templates/content', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-restaurant-menu-info';
			$holder_classes = array_merge( $holder_classes );
			
			return implode( ' ', $holder_classes );
		}
	}
}