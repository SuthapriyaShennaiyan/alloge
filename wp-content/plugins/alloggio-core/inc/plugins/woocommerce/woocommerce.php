<?php

if ( ! class_exists( 'AlloggioCoreWooCommerce' ) ) {
	class AlloggioCoreWooCommerce {
		private static $instance;
		
		public function __construct() {
			
			if ( qode_framework_is_installed( 'woocommerce' ) ) {
				// Include files
				$this->include_files();
			}
		}
		
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		function include_files() {
			
			// Include helper functions
			include_once ALLOGGIO_CORE_PLUGINS_PATH . '/woocommerce/helper.php';
			
			// Include options
			include_once ALLOGGIO_CORE_PLUGINS_PATH . '/woocommerce/dashboard/admin/woocommerce-options.php';
			
			// Include meta boxes
			include_once ALLOGGIO_CORE_PLUGINS_PATH . '/woocommerce/dashboard/meta-box/product-meta-box.php';
			
			// Include shortcodes
			add_action( 'qode_framework_action_before_shortcodes_register', array( $this, 'include_shortcodes' ) );
			
			// Include widgets
			add_action( 'qode_framework_action_before_widgets_register', array( $this, 'include_widgets' ) );
			
			// Set product list layout
			add_action( 'qode_framework_action_after_options_init_' . ALLOGGIO_CORE_OPTIONS_NAME, array( $this, 'set_product_list_layout' ) );
		}
		
		function include_shortcodes() {
			foreach ( glob( ALLOGGIO_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/*/include.php' ) as $shortcode ) {
				include_once $shortcode;
			}
		}
		
		function include_widgets() {
			foreach ( glob( ALLOGGIO_CORE_PLUGINS_PATH . '/woocommerce/widgets/*/include.php' ) as $widget ) {
				include_once $widget;
			}
		}
		
		function set_product_list_layout() {
			/**
			 * Shop page templates hooks
			 */
			$list_item_layouts = apply_filters( 'alloggio_core_filter_product_list_layouts', array() );
			$options_map       = alloggio_core_get_variations_options_map( $list_item_layouts );
			
			if ( $options_map['visibility'] ) {
				$options_map['default_value'] = alloggio_core_get_option_value( 'admin', 'qodef_product_list_item_layout', $options_map['default_value'] );
			}
			
			// This conditional can't be inside constructor because Elementor doesn't recognize it
			if ( qode_framework_is_installed( 'theme' ) ) {
				do_action ( 'alloggio_core_action_shop_list_item_layout_' . $options_map[ 'default_value' ] );
			}
		}
	}
	
	AlloggioCoreWooCommerce::get_instance();
}