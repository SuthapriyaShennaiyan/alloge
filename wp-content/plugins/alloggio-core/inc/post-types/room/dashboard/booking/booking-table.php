<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

if ( ! class_exists( 'AlloggioCoreRoomBookingTable' ) ) {
	class AlloggioCoreRoomBookingTable extends WP_List_Table {
		
		public function __construct() {
			parent::__construct(
				array(
					'singular' => 'booking',
					'plural'   => 'bookings',
					'ajax'     => false,
				)
			);
		}
		
		/**
		 * Required method. Dictates table's columns and titles.
		 *
		 * @return array
		 */
		function get_columns() {
			$columns = array(
				'order_id'         => esc_html__( 'Order ID', 'alloggio-core' ),
				'order_date'       => esc_html__( 'Order Date', 'alloggio-core' ),
				'room'             => esc_html__( 'Room', 'alloggio-core' ),
				'reservation_info' => esc_html__( 'Reservation Info', 'alloggio-core' ),
				'client_info'      => esc_html__( 'Client Info', 'alloggio-core' ),
				'amount'           => esc_html__( 'Amount', 'alloggio-core' ),
				'price'            => esc_html__( 'Price', 'alloggio-core' ),
				'payment_status'   => esc_html__( 'Payment Status', 'alloggio-core' ),
			);
			
			return $columns;
		}
		
		/**
		 * Define sortable columns
		 *
		 * @return array
		 */
		function get_sortable_columns() {
			$sortable_columns = array(
				'order_id'       => array( 'order_id', false ),
				'order_date'     => array( 'order_date', false ),
				'room'           => array( 'room', false ),
				'amount'         => array( 'amount', false ),
				'price'          => array( 'price', false ),
				'payment_status' => array( 'payment_status', false ),
			);
			
			return $sortable_columns;
		}
		
		/**
		 * This method is called when the parent class can't find a method
		 * specifically build for a given column. Generally, it's recommended to include
		 * one method for each column you want to render, keeping your package class
		 * neat and organized. For example, if the class needs to process a column
		 * named 'title', it would first see if a method named $this->column_title()
		 * exists - if it does, that method will be used.
		 *
		 * WP_List_Table::single_row_columns()
		 *
		 * @param object $item
		 * @param string $column_name
		 *
		 * @return mixed
		 */
		public function column_default( $item, $column_name ) {
			return $item[ $column_name ];
		}
		
		/**
		 * Return all bookings
		 *
		 * @return array|null|object
		 */
		public function get_bookings() {
			$result = array();
			$orders = wc_get_orders( array(
				'limit'   => -1,
				'orderby' => 'date',
				'order'   => 'DESC',
			) );
			
			if ( ! empty( $orders ) ) {
				foreach ( $orders as $order ) {
					$order_items = $order->get_items();
					
					if ( ! empty( $order_items ) ) {
						foreach ( $order_items as $item_id => $item ) {
							
							if ( is_a( $item, 'WC_Order_Item_Room' ) ) {
								$order_page_url = admin_url( 'post.php?post=' . absint( $order->get_id() ) ) . '&action=edit';

								$result[ $order->get_id() ] = array(
									'order_id'         => '<a href="' . esc_url( $order_page_url ) . '">#' . esc_html( $order->get_id() ) . '</a>',
									'order_date'       => date( get_option( 'date_format' ), strtotime( $order->get_date_created() ) ),
									'room'             => '<a href="' . esc_url( get_the_permalink( $item->get_product_id() ) ) . '">' . wp_kses_post( $item->get_name() ) . '</a>',
									'reservation_info' => '',
									'client_info'      => sprintf( '<div class="qodef-m-client-info qodef-e">
										<div class="qodef-e-full-name">%s %s</div>
										<div class="qodef-e-email">%s</div>
										<div class="qodef-e-phone">%s</div>
										<div class="qodef-e-location">%s, %s %s</div></div>',
										$order->get_billing_first_name(),
										$order->get_billing_last_name(),
										'<a href="mailto:' . $order->get_billing_email() . '">' . $order->get_billing_email() . '</a>',
										$order->get_billing_phone(),
										$order->get_billing_city(),
										$order->get_billing_postcode(),
										$order->get_billing_country()
									),
									'amount'           => esc_html( $item->get_quantity() ),
									'price'            => wc_price( $item->get_total(), array( 'currency' => $order->get_currency() ) ),
									'payment_status'   => '<a href="' . esc_url( $order_page_url ) . '" class="qodef-m-payment-status qodef--' . esc_attr( strtolower( $order->get_status() ) ) . '">' . esc_html( $order->get_status() ) . '</a>',
								);

								$room_id          = alloggio_core_get_original_room_page_id( $item->get_product_id() );
								$reservations     = get_post_meta( $room_id, 'qodef_room_single_reservations', true );
								$reservation_meta = array();
							
								if ( ! empty( $reservations ) ) {
									foreach ( $reservations as $key => $reservation ) {
										if ( $reservation['qodef_room_single_reservation_order_id'] == $item->get_data()['order_id'] ) {
											
											$reservation_meta = array(
												'check_in'       => $reservation['qodef_room_single_reservation_check_in'],
												'check_out'      => $reservation['qodef_room_single_reservation_check_out'],
												'guests'         => $reservation['qodef_room_single_reservation_guests'],
												'extra_services' => $reservation['qodef_room_single_reservation_extra_services'],
											);
										}
									}
								}
								
								if ( ! empty( $reservation_meta ) ) {
									$result[ $order->get_id() ]['reservation_info'] = alloggio_core_add_reservation_details_template( $item->get_product_id(), $reservation_meta, false );
								}
							}
						}
					}
				}
			}
			
			return $result;
		}
		
		/**
		 * Required function for displaying data. Sort and filter data.
		 */
		function prepare_items() {
			
			/**
			 * Column headers
			 */
			$columns               = $this->get_columns();
			$hidden                = array();
			$sortable              = $this->get_sortable_columns();
			$this->_column_headers = array( $columns, $hidden, $sortable );
			
			/**
			 * Get Data from Database
			 */
			$data = $this->get_bookings();
			
			/**
			 * Required for pagination
			 */
			$per_page     = 10;
			$current_page = $this->get_pagenum();
			$total_items  = count( $data );
			
			/**
			 * Pagination
			 */
			$data = array_slice( $data, ( ( $current_page - 1 ) * $per_page ), $per_page );
			
			/**
			 * Add sorted data to items property, so rest of class can use it
			 */
			$this->items = $data;
			
			/**
			 * REQUIRED. We also have to register our pagination options & calculations.
			 */
			$this->set_pagination_args( array(
				'total_items' => $total_items,
				'per_page'    => $per_page,
				'total_pages' => ceil( $total_items / $per_page )
			) );
		}
		
		/**
		 * Required function for displaying form with datas
		 */
		function display_table() {
			echo '<form id="' . esc_attr( $this->_args['plural'] ) . '-filter" method="get">';
			foreach ( $_GET as $key => $value ) {
				if ( '_' === $key[0] || 'paged' === $key ) {
					continue;
				}
				echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" />';
			}
			parent::display();
			echo '</form>';
		}
	}
}
