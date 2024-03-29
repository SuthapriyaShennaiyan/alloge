<?php
$page_id        = get_the_ID();
$seasonal_items = get_post_meta( $page_id, 'qodef_room_single_seasonal_items', true );

if ( ! empty( $seasonal_items ) ) {
	$title_meta       = get_post_meta( $page_id, 'qodef_room_single_seasonal_items_title', true );
	$description_meta = get_post_meta( $page_id, 'qodef_room_single_seasonal_items_description', true );
	$price_meta       = get_post_meta( $page_id, 'qodef_room_single_price', true );
	$price            = ! empty( $price_meta ) ? floatval( $price_meta ) : 0;
	$currency         = alloggio_core_get_default_room_variables( 'currency' );
	?>
	<div class="qodef-e-seasonal">
		<h4 class="qodef-e-seasonal-title"><?php echo ! empty( $title_meta ) ? esc_html( $title_meta ) : esc_html__( 'Seasonal Pricing', 'alloggio-core' ); ?></h4>
		<p class="qodef-e-seasonal-description"><?php echo ! empty( $description_meta ) ? esc_html( $description_meta ) : esc_html__( 'Get ahead of everyone else and book your room during one of our special promotional periods. Check out the seasonal offers for this room and pick the one that suits you best.', 'alloggio-core' ); ?></p>
		<div class="qodef-e-seasonal-items">
			<?php foreach ( $seasonal_items as $key => $value ) {
				$seasonal_price = floatval( $value['qodef_room_single_seasonal_item_price'] );
				?>
				<?php if ( ! empty( $value['qodef_room_single_seasonal_item_beginning'] ) && ! empty( $value['qodef_room_single_seasonal_item_end'] ) ) { ?>
					<div class="qodef-e-seasonal-item qodef-ei">
						<span class="qodef-ei-date">
							<span class="qodef-ei-date-begin"><?php echo date( alloggio_core_get_default_room_variables( 'date-format' ), strtotime( $value['qodef_room_single_seasonal_item_beginning'] ) ); ?></span>
							<span class="qodef-ei-date-end"><?php echo date( alloggio_core_get_default_room_variables( 'date-format' ), strtotime( $value['qodef_room_single_seasonal_item_end'] ) ); ?></span>
						</span>
						<span class="qodef-ei-line"></span>
						<span class="qodef-ei-price">
							<?php if ( $price !== $seasonal_price ) { ?>
								<span class="qodef-ei-price-label"><?php echo sprintf( '%s', $price > $seasonal_price ? esc_html__( 'Low rate price', 'alloggio-core' ) : esc_html__( 'High rate price', 'alloggio-core' ) ); ?></span>
							<?php } ?>
							<span class="qodef-ei-price-value"><?php echo sprintf( '%s%s', esc_attr( $currency ), esc_html( $value['qodef_room_single_seasonal_item_price'] ) ); ?></span>
						</span>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
<?php } ?>