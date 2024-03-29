<div class="qodef-profile-reserved-rooms qodef-m">
	<?php if ( $rooms_order ) { ?>
		<div class="qodef-m-heading">
			<h3 class="qodef-m-title"><?php esc_html_e( 'Reserved Rooms', 'alloggio-core' ); ?></h3>
			<p class="qodef-m-text"><?php esc_html_e( 'Here\'s an overview of your room reservations', 'alloggio-core' ); ?></p>
		</div>
		<div class="qodef-m-reserved-rooms">
			<?php foreach ( $rooms_order as $room_order ) {
				$room_id = $room_order->get_product_id();
				?>
				<div class="qodef-m-reserved-room qodef-ei">
					<div class="qodef-ei-image">
						<a itemprop="url" href="<?php echo get_the_permalink( $room_id ); ?>">
							<?php echo get_the_post_thumbnail( $room_id, 'medium' ); ?>
						</a>
					</div>
					<div class="qodef-ei-heading">
						<h4 class="qodef-ei-title">
							<a itemprop="url" href="<?php echo get_the_permalink( $room_id ); ?>"><?php echo esc_html( $room_order->get_name() ); ?></a>
						</h4>
						<?php echo alloggio_core_update_order_item_with_additional_room_info( $room_order->get_id(), $room_order ); ?>
						<span class="qodef-ei-price">
							<span class="qodef-ei-price-label"><?php esc_html_e( 'Price:', 'alloggio-core' ); ?></span>
							<span class="qodef-ei-price-value"><?php echo get_woocommerce_currency_symbol( get_woocommerce_currency() ) . esc_html( $room_order->get_total() ); ?></span>
						</span>
					</div>
					<div class="qodef-ei-order">
						<span class="qodef-ei-order-status qodef--<?php echo esc_attr( str_replace( ' ', '-', strtolower( $room_order->get_order()->get_status() ) ) ); ?>"><?php echo esc_html( $room_order->get_order()->get_status() ); ?></span>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php } else { ?>
		<h3 class="qodef-m-not-found"><?php esc_html_e( 'You haven\'t reserve any room yet.', 'alloggio-core' ); ?></h3>
	<?php } ?>
</div>