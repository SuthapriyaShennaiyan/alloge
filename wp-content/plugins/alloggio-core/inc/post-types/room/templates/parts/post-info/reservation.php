<?php
// Set main variables
$form_classes  = array();
$room_id       = get_the_ID();
$query_options = isset( $_GET ) && ! empty( $_GET ) ? array_filter( $_GET ) : array();

// Set dates variables
$date_format    = alloggio_core_get_default_room_variables( 'date-format' );
$check_in       = '';
$check_in_date  = '';
$check_out      = '';
$check_out_date = '';

// Set room capacity variables
$room_amount_meta  = get_post_meta( $room_id, 'qodef_room_single_room_amount', true );
$min_capacity_meta = get_post_meta( $room_id, 'qodef_room_single_min_capacity', true );
$max_capacity_meta = get_post_meta( $room_id, 'qodef_room_single_max_capacity', true );

$room_amount      = ! empty( $room_amount_meta ) ? intval( $room_amount_meta ) : 1;
$min_capacity     = ! empty( $min_capacity_meta ) ? intval( $min_capacity_meta ) : 1;
$max_capacity     = ! empty( $max_capacity_meta ) ? intval( $max_capacity_meta ) : 1;
$min_max_subtract = $min_capacity < 2 ? 0 : 1;
$person_end_index = $max_capacity > 20 ? $max_capacity : 20;

$rooms    = 1;
$adult    = $min_capacity;
$children = 0;
$infant   = 0;

// Set other variables
$extra_services    = get_post_meta( $room_id, 'qodef_room_single_extra_service', true );
$selected_services = array();

// Override variables with forward query
if ( ! empty( $query_options ) ) {
	
	if ( isset( $query_options['check_in'] ) && ! empty( $query_options['check_in'] ) ) {
		$check_in = date( $date_format, strtotime( $query_options['check_in'] ) );
	}
	
	if ( isset( $query_options['check_out'] ) && ! empty( $query_options['check_out'] ) ) {
		$check_out = date( $date_format, strtotime( $query_options['check_out'] ) );
	}
	
	if ( ! empty( $check_in ) && empty( $check_out ) ) {
		$check_out = date( $date_format, strtotime( $query_options['check_in'] . ' +1 days' ) );
	}
	
	if ( isset( $query_options['amount'] ) && ! empty( $query_options['amount'] ) ) {
		$rooms = intval( $query_options['amount'] );
	}
	
	if ( isset( $query_options['extra_services'] ) && ! empty( $query_options['extra_services'] ) ) {
		$forward_services  = str_replace( ' ', '', esc_attr( urldecode( $query_options['extra_services'] ) ) );
		$selected_services = strpos( $forward_services, ',' ) !== false ? explode( ',', $forward_services ) : array( $forward_services );
	}
	
	if ( isset( $query_options['adult'] ) && ! empty( $query_options['adult'] ) ) {
		$adult = intval( $query_options['adult'] );
	}
	
	if ( isset( $query_options['children'] ) && ! empty( $query_options['children'] ) ) {
		$children = intval( $query_options['children'] );
	}
	
	if ( isset( $query_options['infant'] ) && ! empty( $query_options['infant'] ) ) {
		$infant = intval( $query_options['infant'] );
	}
}

// Set price variables
$price    = alloggio_core_calculate_room_price( $room_id );
$currency = alloggio_core_get_default_room_variables( 'currency' );

$adult_price_meta    = get_post_meta( $room_id, 'qodef_room_single_adult_price', true );
$adult_price         = ! empty( $adult_price_meta ) ? floatval( $adult_price_meta ) : 0;
$children_price_meta = get_post_meta( $room_id, 'qodef_room_single_children_price', true );
$children_price      = ! empty( $children_price_meta ) ? floatval( $children_price_meta ) : 0;

// Set seasonal price variables
$seasonal_dates = alloggio_core_get_room_seasonal_dates( $room_id );
$seasonal_price = alloggio_core_get_room_seasonal_price( $room_id );

// Check query options
if ( isset( $_GET['check_in'] ) && ! empty( $_GET['check_in'] ) && isset( $_GET['check_out'] ) && ! empty( $_GET['check_out'] ) ) {
	$form_classes[] = 'qodef--query-triggered';
}

$check_in_dates  = alloggio_core_get_room_reserved_dates( $room_id, true, 0, 'check-in' );
$check_out_dates = alloggio_core_get_room_reserved_dates( $room_id, true );
?>
<div id="qodef-room-reservation">
	<h4 class="qodef-room-reservation-title"><?php esc_html_e( 'Your Reservation', 'alloggio-core' ); ?></h4>
	<form id="qodef-room-reservation-form" class="qodef-m <?php echo esc_attr( implode( ' ', $form_classes ) ); ?>" method="GET">
		<?php qode_framework_svg_icon( 'spinner', 'qodef-m-spinner qodef--form' ); ?>
		<div class="qodef-m-field qodef--check-in">
			<label class="qodef-m-field-label"><?php esc_html_e( 'Check-in:', 'alloggio-core' ); ?></label>
			<div class="qodef-m-field-input-wrapper">
				<input type="text" class="qodef-m-field-input qodef-datepick-calendar qodef--date qodef--check-in" name="qodef_room_check_in" value="<?php echo esc_attr( $check_in ); ?>" data-reserved-dates="<?php echo esc_attr( $check_in_dates['reserved_dates'] ); ?>" data-last-room-dates="<?php echo esc_attr( $check_in_dates['last_room_dates'] ); ?>" required readonly/>
				<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/icons/calendar', '', array( 'icon_class' => 'qodef-m-field-input-icon' ) ); ?>
			</div>
		</div>
		<div class="qodef-m-field qodef--check-out">
			<label class="qodef-m-field-label"><?php esc_html_e( 'Check-out:', 'alloggio-core' ); ?></label>
			<div class="qodef-m-field-input-wrapper">
				<input type="text" class="qodef-m-field-input qodef-datepick-calendar qodef--date qodef--check-out" name="qodef_room_check_out" value="<?php echo esc_attr( $check_out ); ?>" data-reserved-dates="<?php echo esc_attr( $check_out_dates['reserved_dates'] ); ?>" data-last-room-dates="<?php echo esc_attr( $check_out_dates['last_room_dates'] ); ?>" required readonly/>
				<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/icons/calendar', '', array( 'icon_class' => 'qodef-m-field-input-icon' ) ); ?>
			</div>
		</div>
		<?php if ( ! empty( $room_amount ) && $room_amount > 1 ) { ?>
			<div class="qodef-m-field qodef--room-amount">
				<label class="qodef-m-field-label"><?php esc_html_e( 'Rooms:', 'alloggio-core' ); ?></label>
				<select name="qodef_room_amount" class="qodef-e-input qodef--select2">
					<?php for ( $i = 1; $i <= $room_amount; $i ++ ) { ?>
						<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $rooms, $i ); ?>><?php echo sprintf( _n( '%s Room', '%s Rooms', $i, 'alloggio-core' ), $i ); ?></option>
					<?php } ?>
				</select>
			</div>
		<?php } else { ?>
			<input type="hidden" name="qodef_room_amount" value="1" required />
		<?php } ?>
		<div class="qodef-m-field qodef--guests">
			<label class="qodef-m-field-label"><?php esc_html_e( 'Guests:', 'alloggio-core' ); ?></label>
			<div class="qodef-m-field-input-wrapper">
				<input type="text" class="qodef-m-field-input qodef--guests" name="qodef_room_guests" value="" data-count="<?php echo esc_attr( $min_capacity ); ?>" required readonly />
				<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/icons/arrows-down', '', array( 'icon_class' => 'qodef-m-field-input-icon' ) ); ?>
			</div>
			<div class="qodef-m-field-persons">
				<div class="qodef-m-field-person qodef-e qodef--adult">
					<div class="qodef-e-label-text"><?php esc_html_e( 'Adults', 'alloggio-core' ); ?></div>
					<select name="qodef_room_adult" class="qodef-e-input qodef--select2" data-price="<?php echo esc_attr( $adult_price ); ?>" data-singular-label="<?php esc_attr_e( 'Adult', 'alloggio-core' ); ?>" data-plural-label="<?php esc_attr_e( 'Adults', 'alloggio-core' ); ?>">
						<?php for ( $i = 1; $i <= $person_end_index; $i ++ ) { ?>
							<?php if ( $i >= ( $min_capacity - $min_max_subtract ) && $i <= $max_capacity ) { ?>
								<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $adult, $i ); ?>><?php echo esc_html( $i ); ?></option>
							<?php }	?>
						<?php } ?>
					</select>
				</div>
				<div class="qodef-m-field-person qodef-e qodef--children">
					<div class="qodef-e-label">
						<span class="qodef-e-label-text"><?php esc_html_e( 'Children', 'alloggio-core' ); ?></span>
						<span class="qodef-e-label-description"><?php esc_html_e( '2-12 years old', 'alloggio-core' ); ?></span>
					</div>
					<select name="qodef_room_children" class="qodef-e-input qodef--select2" data-price="<?php echo esc_attr( $children_price ); ?>" data-singular-label="<?php esc_attr_e( 'Children', 'alloggio-core' ); ?>" data-plural-label="<?php esc_attr_e( 'Children', 'alloggio-core' ); ?>">
						<?php for ( $i = 0; $i <= $person_end_index; $i ++ ) { ?>
							<?php if ( $i <= $max_capacity - $min_capacity + $min_max_subtract ) { ?>
								<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $children, $i ); ?>><?php echo esc_html( $i ); ?></option>
							<?php }	?>
						<?php } ?>
					</select>
				</div>
				<div class="qodef-m-field-person qodef-e qodef--infant">
					<div class="qodef-e-label">
						<span class="qodef-e-label-text"><?php esc_html_e( 'Infant\'s', 'alloggio-core' ); ?></span>
						<span class="qodef-e-label-description"><?php esc_html_e( '0-2 years old', 'alloggio-core' ); ?></span>
					</div>
					<select name="qodef_room_infant" class="qodef-e-input qodef--select2" data-singular-label="<?php esc_attr_e( 'Infant', 'alloggio-core' ); ?>" data-plural-label="<?php esc_attr_e( 'Infant\'s', 'alloggio-core' ); ?>">
						<?php for ( $i = 0; $i <= $person_end_index; $i ++ ) { ?>
							<?php if ( $i <= $max_capacity - $min_capacity + $min_max_subtract ) { ?>
								<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $infant, $i ); ?>><?php echo esc_html( $i ); ?></option>
							<?php }	?>
						<?php } ?>
					</select>
				</div>
				<div class="qodef-m-field-person qodef--button">
					<?php alloggio_core_print_room_button_element( array(
						'custom_class' => 'qodef-button',
						'html_type'    => 'default',
						'link'         => '#',
						'text'         => esc_html__( 'Done', 'alloggio-core' ),
					) ); ?>
				</div>
			</div>
		</div>
		<?php if ( ! empty( $extra_services ) ) { ?>
			<div class="qodef-m-field qodef--extra-services">
				<h4 class="qodef-m-field-title"><?php esc_html_e( 'Extra Services', 'alloggio-core' ); ?></h4>
				<div class="qodef-m-field-items">
					<?php foreach ( $extra_services as $extra_service ) {
						$es_name = $extra_service['qodef_room_single_extra_service_name'];
						
						if ( ! empty( $es_name ) ) {
							$es_service_type = $extra_service['qodef_room_single_extra_service_price_pack'];
							$es_price        = $extra_service['qodef_room_single_extra_service_price'] !== '' ? floatval( $extra_service['qodef_room_single_extra_service_price'] ) : 0;
							$es_price_info   = esc_html__( 'free', 'alloggio-core' );
							$es_price_infos  = array(
								'total'              => esc_html__( 'total', 'alloggio-core' ),
								'per-night'          => esc_html__( ' / per night', 'alloggio-core' ),
								'per-person'         => esc_html__( ' / per person', 'alloggio-core' ),
								'per-person-per-night' => esc_html__( ' / per person', 'alloggio-core' ),
								'subtract'             => '',
								'subtract-per-night'   => esc_html__( ' / per night', 'alloggio-core' ),
							);
							$es_price_label  = isset( $es_price_infos[ $es_service_type ] ) ? $es_price_infos[ $es_service_type ] : '';

							if ( ! empty( $es_price ) ) {
								$es_price_info = $currency . $es_price;
								
								if ( strpos( $es_service_type, 'subtract' ) !== false ) {
									$es_price_info = '-' . $es_price_info;

									if ( ! empty( $es_price_label ) ) {
										$es_price_info .= $es_price_label;
									}
								} elseif ( strpos( $es_service_type, 'total' ) !== false ) {
									// Do nothing
								} else {
									$es_price_info .= $es_price_label;
								}
							}
							
							$value       = str_replace( ' ', '-', trim( mb_strtolower( $es_name ) ) );
							$is_checked  = $extra_service['qodef_room_single_extra_service_type'] === 'mandatory' || in_array( $value, $selected_services ) ? 'checked' : '';
							$is_disabled = $extra_service['qodef_room_single_extra_service_type'] === 'mandatory' ? 'disabled' : '';
							
							$field_class = array();
							if ( ! empty( $is_checked ) ) {
								$field_class[] = 'qodef--checked';
							}
							if ( ! empty( $is_disabled ) ) {
								$field_class[] = 'qodef--disabled';
							}
							?>
							<div class="qodef-m-field-item qodef-e <?php echo implode( ' ', $field_class ); ?>">
								<input type="checkbox" class="qodef-e-field-input qodef--<?php echo esc_attr( $value ); ?>" name="qodef_room_extra_service[]" value="<?php echo esc_attr( $value ); ?>" data-price="<?php echo esc_attr( $es_price ); ?>" data-service-type="<?php echo esc_attr( $es_service_type ); ?>" <?php echo esc_attr( $is_checked ); ?> <?php echo esc_attr( $is_disabled ); ?> />
								<span class="qodef-e-field-checkbox"></span>
								<span class="qodef-e-field-label">
									<span class="qodef-e-field-label-name"><?php echo esc_html( $es_name ); ?></span>
									<span class="qodef-e-field-label-line"></span>
									<span class="qodef-e-field-label-price"><?php echo esc_html( $es_price_info ); ?></span>
								</span>
							</div>
						<?php }
					} ?>
				</div>
			</div>
		<?php } ?>
		<?php if ( ! empty( $price ) ) {
			$price_value = ! empty( $seasonal_price ) ? $seasonal_price : $price;
			?>
			<div class="qodef-m-field qodef--price">
				<h4 class="qodef-m-field-title"><?php esc_html_e( 'Your price', 'alloggio-core' ); ?></h4>
				<div class="qodef-m-price">
					<span class="qodef-m-price-currency"><?php echo esc_html( $currency ); ?></span>
					<span class="qodef-m-price-value" data-room-price="<?php echo floatval( $price ); ?>" data-room-seasonal-price="<?php echo floatval( $seasonal_price ); ?>" data-room-seasonal-dates="<?php echo esc_attr( $seasonal_dates ); ?>"><?php echo floatval( $price_value ); ?></span>
					<span class="qodef-m-price-description"><?php esc_html_e( '/ per room', 'alloggio-core' ); ?></span>
					<input type="hidden" name="qodef_room_price" value="<?php echo floatval( $price_value ); ?>"/>
				</div>
			</div>
			<div class="qodef-m-field qodef--booking">
				<?php alloggio_core_get_room_book_now_form( $rooms ); ?>
				<?php qode_framework_svg_icon( 'spinner', 'qodef-m-spinner qodef--button' ); ?>
			</div>
		<?php } ?>
		<div class="qodef-m-response"></div>
		<input type="hidden" name="qodef_room_min_capacity" value="<?php echo esc_attr( $min_capacity ); ?>"/>
		<input type="hidden" name="qodef_room_max_capacity" value="<?php echo esc_attr( $max_capacity ); ?>"/>
	</form>
</div>
