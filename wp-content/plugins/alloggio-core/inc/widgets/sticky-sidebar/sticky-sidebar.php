<?php

if ( ! function_exists( 'alloggio_core_add_sticky_sidebar_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function alloggio_core_add_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'AlloggioCoreStickySidebarWidget';
		
		return $widgets;
	}
	
	add_filter( 'alloggio_core_filter_register_widgets', 'alloggio_core_add_sticky_sidebar_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class AlloggioCoreStickySidebarWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_base( 'alloggio_core_sticky_sidebar' );
			$this->set_name( esc_html__( 'Alloggio Sticky Sidebar', 'alloggio-core' ) );
			$this->set_description( esc_html__( 'Use this widget to make the sidebar sticky. Drag it into the sidebar above the widget which you want to be the first element in the sticky sidebar', 'alloggio-core' ) );
		}
		
		public function render( $atts ) {
		}
	}
}
