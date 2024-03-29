<?php

if ( ! class_exists( 'AlloggioCoreRoomBookingPage' ) ) {
	class AlloggioCoreRoomBookingPage {
		private static $instance;
		
		function __construct() {
			
			// Add submenu page into Dashboard panel
			add_action( 'admin_menu', array( $this, 'register_submenu_page' ) );
			
			// Enqueue page admin styles
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		}
		
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		function register_submenu_page() {
			
			add_submenu_page(
				'edit.php?post_type=room',
				esc_html__( 'Bookings', 'alloggio-core' ),
				esc_html__( 'Bookings', 'alloggio-core' ),
				'manage_options',
				'bookings',
				array( $this, 'render_submenu_page' )
			);
		}
		
		function render_submenu_page() {
			$bookings_table = new AlloggioCoreRoomBookingTable();
			
			echo '<div class="wrap qodef-room-booking qodef-m">';
			$this->display_header();
			if ( ! empty( $bookings_table ) ) {
				$bookings_table->prepare_items();
				$bookings_table->display_table();
			} else {
				esc_html_e( 'Unfortunately you haven\'t any booking at this moment. Please try later to check.' );
			}
			echo '</div>';
		}
		
		function display_header() {
			echo '<h1 class="wp-heading-inline">' . esc_html__( 'Room Bookings', 'alloggio-core' ) . '</h1>';
			echo '<hr class="wp-header-end">';
		}
		
		function enqueue_styles( $hook ) {
			
			if ( $hook === 'room_page_bookings' ) {
				wp_enqueue_style( 'alloggio-core-room-booking-style', ALLOGGIO_CORE_CPT_URL_PATH . '/room/dashboard/booking/assets/css/room-booking.css' );
			}
		}
	}
	
	AlloggioCoreRoomBookingPage::get_instance();
}