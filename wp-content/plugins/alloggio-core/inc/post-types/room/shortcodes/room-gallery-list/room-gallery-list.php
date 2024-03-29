<?php

if ( ! function_exists( 'alloggio_core_add_room_gallery_list_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function alloggio_core_add_room_gallery_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'AlloggioCoreRoomGalleryListShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'alloggio_core_filter_register_shortcodes', 'alloggio_core_add_room_gallery_list_shortcode' );
}

if ( class_exists( 'AlloggioCoreListShortcode' ) ) {
	class AlloggioCoreRoomGalleryListShortcode extends AlloggioCoreListShortcode {
		
		public function __construct() {
			$this->set_post_type( 'room' );
			$this->set_post_type_additional_taxonomies( array( 'location', 'room-type', 'amenity' ) );
		
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( ALLOGGIO_CORE_CPT_URL_PATH . '/room/shortcodes/room-gallery-list' );
			$this->set_base( 'alloggio_core_room_gallery_list' );
			$this->set_name( esc_html__( 'Room Gallery List', 'alloggio-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays gallery list of room', 'alloggio-core' ) );
			$this->set_category( esc_html__( 'Alloggio Core', 'alloggio-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'alloggio-core' )
			) );
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();
			
			$atts['post_type'] = $this->get_post_type();
			
			// Predefined options
			$atts['behavior'] = 'gallery';
			$atts['columns']  = '1';
			$atts['space']    = 'no';

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['item_classes']   = $this->get_item_classes( $atts );
			$atts['query_result']   = new \WP_Query( alloggio_core_get_query_params( $atts ) );
			
			$atts['this_shortcode'] = $this;
			
			return alloggio_core_get_template_part( 'post-types/room/shortcodes/room-gallery-list', 'templates/content', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-room-gallery-list';
			
			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );
			
			return implode( ' ', $holder_classes );
		}
		
		public function get_item_classes( $atts ) {
			$item_classes   = $this->init_item_classes();
			$item_classes[] = 'qodef-room-gallery-list-item';
			
			$list_item_classes = $this->get_list_item_classes( $atts );
			
			$item_classes = array_merge( $item_classes, $list_item_classes );
			
			return implode( ' ', $item_classes );
		}
	}
}