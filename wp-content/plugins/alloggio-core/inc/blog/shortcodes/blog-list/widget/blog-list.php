<?php

if ( ! function_exists( 'alloggio_core_add_blog_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function alloggio_core_add_blog_list_widget( $widgets ) {
		$widgets[] = 'AlloggioCoreBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'alloggio_core_filter_register_widgets', 'alloggio_core_add_blog_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class AlloggioCoreBlogListWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'alloggio-core' )
				)
			);
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'alloggio_core_blog_list',
				'exclude'        => array( 'enable_filter', 'pagination_type', 'pagination_type_load_more_top_margin' ),
			) );
			
			if ( $widget_mapped ) {
				$this->set_base( 'alloggio_core_blog_list' );
				$this->set_name( esc_html__( 'Alloggio Blog List', 'alloggio-core' ) );
				$this->set_description( esc_html__( 'Display a list of blog posts', 'alloggio-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[alloggio_core_blog_list $params]" ); // XSS OK
		}
	}
}
