<?php

if ( ! function_exists( 'alloggio_core_add_room_list_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function alloggio_core_add_room_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'AlloggioCoreRoomListShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'alloggio_core_filter_register_shortcodes', 'alloggio_core_add_room_list_shortcode' );
}

if ( class_exists( 'AlloggioCoreListShortcode' ) ) {
	class AlloggioCoreRoomListShortcode extends AlloggioCoreListShortcode {
		
		public function __construct() {
			$this->set_post_type( 'room' );
			$this->set_post_type_additional_taxonomies( array( 'location', 'room-type', 'amenity' ) );
			$this->set_layouts( apply_filters( 'alloggio_core_filter_room_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'alloggio_core_filter_room_list_extra_options', array() ) );
		
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( ALLOGGIO_CORE_CPT_URL_PATH . '/room/shortcodes/room-list' );
			$this->set_base( 'alloggio_core_room_list' );
			$this->set_name( esc_html__( 'Room List', 'alloggio-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of room', 'alloggio-core' ) );
			$this->set_category( esc_html__( 'Alloggio Core', 'alloggio-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'alloggio-core' )
			) );
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_list_options( array(
				'exclude_behavior' => array( 'justified-gallery' ),
			));
			$this->map_layout_options( array( 'layouts' => $this->get_layouts()));
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'excerpt_length',
				'title'      => esc_html__( 'Excerpt Length', 'alloggio-core' ),
				'group'      => esc_html__( 'Layout', 'alloggio-core' )
			) );
			$this->map_additional_options( array( 'exclude_filter' => true ) );
			$this->set_option( array(
				'field_type' => 'hidden',
				'name'       => 'query_options',
				'title'      => esc_html__( 'Query Options', 'alloggio-core' )
			) );
			$this->map_extra_options();
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'alloggio_core_room_list', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
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
			$atts['query_result']   = new \WP_Query( alloggio_core_get_query_params( $atts ) );
			$atts['slider_attr']    = $this->get_slider_data( $atts, $atts['columns'] != '1' ? array( 'unique' => $atts['unique'], 'outsideNavigation' => 'yes' ) : array());
			$atts['data_attr']      = alloggio_core_get_pagination_data( ALLOGGIO_CORE_REL_PATH, 'post-types/room/shortcodes', 'room-list', 'room', $atts );

			$atts['this_shortcode'] = $this;
			
			return alloggio_core_get_template_part( 'post-types/room/shortcodes/room-list', 'templates/content', $atts['behavior'], $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-room-list';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = $atts['behavior'] === 'slider' && $atts['columns'] == '1' ? 'qodef--simple-slider' : '';
			$holder_classes[] = $atts['behavior'] === 'slider' && $atts['columns'] == '1' && $atts['layout'] === 'gallery' ? 'qodef--swiper-parallax' : '';
			
			if ( isset( $atts['visible_info'] ) && $atts['visible_info'] == 'yes' ) {
				$holder_classes[] = 'qodef-visible-info';
			}
			
			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );
			
			return implode( ' ', $holder_classes );
		}
		
		public function get_item_classes( $atts ) {
			$item_classes   = $this->init_item_classes();
			$item_classes[] = 'qodef-room-list-item';
			
			$list_item_classes = $this->get_list_item_classes( $atts );
			
			$item_classes = array_merge( $item_classes, $list_item_classes );
			
			return implode( ' ', $item_classes );
		}
		
		public function get_additional_query_args( $atts ) {
			$args = parent::get_additional_query_args( $atts );
			
			$query_options = $atts['query_options'];
			if ( isset( $query_options ) && ! empty( $query_options ) ) {
				$check_in  = isset( $query_options['check_in'] ) && ! empty( $query_options['check_in'] ) ? esc_attr( $query_options['check_in'] ) : '';
				$check_out = isset( $query_options['check_out'] ) && ! empty( $query_options['check_out'] ) ? esc_attr( $query_options['check_out'] ) : '';
				$type      = isset( $query_options['type'] ) && ! empty( $query_options['type'] ) ? esc_attr( $query_options['type'] ) : '';
				$amount    = isset( $query_options['amount'] ) && ! empty( $query_options['amount'] ) ? intval( $query_options['amount'] ) : 1;
				$adult     = isset( $query_options['adult'] ) && ! empty( $query_options['adult'] ) ? intval( $query_options['adult'] ) : 1;
				$children  = isset( $query_options['children'] ) && ! empty( $query_options['children'] ) ? intval( $query_options['children'] ) : 0;
				$infant    = isset( $query_options['infant'] ) && ! empty( $query_options['infant'] ) ? intval( $query_options['infant'] ) : 0;
				
				$persons        = $adult + $children + $infant;
				$reserved_dates = array();
				
				// Custom post type dates check
				if ( ! empty( $check_in ) && ! empty( $check_out ) ) {
					$rooms_id       = get_posts( array(
						'post_type'      => 'room',
						'fields'         => 'ids',
						'posts_per_page' => -1
					) );
					
					// Get real dates range for the forward dates
					$dates_range = qode_framework_get_dates_from_date_range( $check_in, $check_out, alloggio_core_get_default_room_variables( 'datepick-date-format' ) );

					// Loop through all custom post type items and collect all reserved dates
					if ( ! empty( $rooms_id ) ) {
						foreach ( $rooms_id as $room_id ) {
							$reserved_dates[ $room_id ] = alloggio_core_get_room_reserved_dates( $room_id, false, $amount );
						}
					}
					
					// Loop through custom post type reserved dates and check is "check in" and "check out" date are available
					if ( ! empty( $reserved_dates ) ) {
						foreach ( $reserved_dates as $post_id => $post_reserved_dates ) {
							$check_reservation = array_intersect( $dates_range, $post_reserved_dates );
							
							// If item is available add it into the list
							if ( empty( $check_reservation ) ) {
								$args['post__in'] = isset( $args['post__in'] ) ? array_merge( $args['post__in'], array( $post_id ) ) : array( $post_id );
							}
						}

						// If dates are not available set a random post ID in order to prevent rooms from displaying
						if ( ! isset( $args['post__in'] ) ) {
							$args['post__in'] = array( 99999999 );
						}
					}
				}
			
				// Custom post type taxonomy check
				if ( ! empty( $type ) ) {
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'room-type',
							'field'    => 'slug',
							'terms'    => $type,
						),
					);
				}
				
				// Custom post type capacity check
				$args['meta_query'] = array(
					'relation' => 'AND',
					array(
						'key'     => 'qodef_room_single_room_amount',
						'value'   => $amount,
						'compare' => '>=',
						'type'    => 'numeric',
					),
					array(
						'key'     => 'qodef_room_single_min_capacity',
						'value'   => $persons,
						'compare' => '<=',
						'type'    => 'numeric',
					),
					array(
						'key'     => 'qodef_room_single_max_capacity',
						'value'   => $persons,
						'compare' => '>=',
						'type'    => 'numeric',
					),
				);
			}

			return $args;
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
