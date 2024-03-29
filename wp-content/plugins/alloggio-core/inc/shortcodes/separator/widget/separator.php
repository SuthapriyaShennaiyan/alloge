<?php

if ( ! function_exists( 'alloggio_core_add_separator_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function alloggio_core_add_separator_widget( $widgets ) {
		$widgets[] = 'AlloggioCoreSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'alloggio_core_filter_register_widgets', 'alloggio_core_add_separator_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class AlloggioCoreSeparatorWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'alloggio_core_separator'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'alloggio_core_separator' );
				$this->set_name( esc_html__( 'Alloggio Separator', 'alloggio-core' ) );
				$this->set_description( esc_html__( 'Add a separator element into widget areas', 'alloggio-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[alloggio_core_separator $params]" ); // XSS OK
		}
	}
}