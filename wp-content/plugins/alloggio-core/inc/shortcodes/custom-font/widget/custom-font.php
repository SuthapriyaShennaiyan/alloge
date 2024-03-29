<?php

if ( ! function_exists( 'alloggio_core_add_custom_font_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function alloggio_core_add_custom_font_widget( $widgets ) {
		$widgets[] = 'AlloggioCoreCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'alloggio_core_filter_register_widgets', 'alloggio_core_add_custom_font_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class AlloggioCoreCustomFontWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'alloggio_core_custom_font'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'alloggio_core_custom_font' );
				$this->set_name( esc_html__( 'Alloggio Custom Font', 'alloggio-core' ) );
				$this->set_description( esc_html__( 'Add a custom font element into widget areas', 'alloggio-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[alloggio_core_custom_font $params]" ); // XSS OK
		}
	}
}